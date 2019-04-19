<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license https://vistart.name/license/
 */

namespace console\modules\spider\controllers;

use console\modules\spider\target\library\LibraryTarget;
use console\modules\spider\target\library\TongjiUniversity\models\search\Book;
use rhoone\library\providers\huiwen\targets\tongjiuniversity\models\elasticsearch\Marc;
use rhoone\library\providers\huiwen\targets\tongjiuniversity\models\mongodb\DownloadedContent;
use rhoone\library\providers\huiwen\targets\tongjiuniversity\models\mongodb\MarcNo;

/**
 * Library Spider
 *
 * @author vistart <i@vistart.name>
 */
class LibraryController extends \yii\console\Controller
{

    /**
     * 
     * @param string $target
     * @return LibraryTarget
     */
    public static function getTarget($target)
    {
        $className = 'console\modules\spider\target\library\\' . $target;
        try {
            $library = new $className();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return $library;
    }

    /**
     * List the statistics.
     */
    public function actionIndex($target)
    {
        $library = static::getTarget($target);
        /* @var $library LibraryTarget */
    }

    /**
     * Crawl the target.
     * @param $target the target that will be crawled.
     * @param $start
     * @param $count
     */
    public function actionCrawl($target, $start = null, $count = null)
    {
        $library = static::getTarget($target);
        /* @var $library LibraryTarget */
        $timestamp = time();
        $result = 0;
        if ($start === null && $count === null) {
            $result = $library->crawl();
        } else {
            $result = $library->crawl(['start' => $start, 'count' => $count]);
        }
        $duration = time() - $timestamp;
        $datetime = date('Y-m-d, H:i:s');
        $this->printResult($result, $datetime, $duration);
    }

    public function actionFind($target, $identity)
    {
        $library = static::getTarget($target);
        /* @var $library LibraryTarget */
        $model = $library->find($identity);
        if (!$model) {
            echo "No model found.";
            return 0;
        }
    }

    public function actionDownload($target, $start = null, $count = null)
    {
        $library = static::getTarget($target);
        /* @var $library LibraryTarget */
        $params = null;
        if ($start !== null || $count !== null) {
            $params = ['start' => $start, 'count' => $count];
        }
        $timestamp = time();
        $result = $library->download($params);
        $duration = time() - $timestamp;
        $datetime = date('Y-m-d, H:i:s');
        $this->printResult($result, $datetime, $duration);
    }

    private function printResult($result, $datetime, $duration)
    {
        echo "$result primary record(s) done (at $datetime, GMT). Elapsed: $duration (seconds).\r\n";
        return 0;
    }

    public function actionTransfer($target, $start = 0, $count = 1, $skip_error = true)
    {
        $library = static::getTarget($target);
        $class = get_class($library);
        $start = (int)$start;
        $count = (int)$count;
        echo "Begin from $start...\r\n";
        $timestamp = time();
        $i = 0;
        foreach ($library->marcClass::find()->page($count, $start / $count)->orderBy(['marc_no' => SORT_ASC])->all() as $marc)
        {
            $bookDesc = $class::getBookDescriptor($marc->marc_no);
            $bookSearch = new Book();
            $bookSearch->refreshAttributes($bookDesc);
            $result = 0;
            try {
                $result = $bookSearch->save();
            } catch (\Exception $ex) {
                file_put_contents("php://stderr", "MarcNo: " . $marc->marc_no);
                file_put_contents("php://stderr", print_r($bookSearch->getErrors()));
                if (!$skip_error) {
                    throw $ex;
                }
            }
            if (!$result)
            {
                file_put_contents("php://stderr", print_r($bookSearch->getErrors()));
            }
            printf("progress: [%-50s] %d%% Done.\r", str_repeat('#', $i / $count * 50), $i / $count * 100);
            $i++;
        }
        $duration = time() - $timestamp;
        $datetime = date('Y-m-d, H:i:s');
        $this->printResult($i, $datetime, $duration);
        return 0;
    }

    public function actionResetSearchMapping($target)
    {
        $library = self::getTarget($target);
        $library->bookSearchClass::updateMapping();
    }

    public function actionClearDocuments()
    {
        $result = 0;
        while (Marc::find()->one()) {
            $result += Marc::find()->one()->delete();
            if ($result % 100 == 0) {
                file_put_contents("php://stdout", "$result deleted.\n");
            }
        }
        file_put_contents("php://stdout", $result . " document(s) deleted.\n");
        return true;
    }

    public function actionCreateSearchIndex()
    {
        return Marc::createIndex();
    }

    public function actionDeleteSearchIndex()
    {
        return Marc::deleteIndex();
    }

    public function actionSearch($target)
    {
        $library = self::getTarget($target);

    }

    /**
     * Push job(s) to the queue.
     * @param int $start
     * @param int $end
     * @param int $min The minimum number of each batch.
     * @param int $max The maximum number of each batch.
     */
    public function actionPushDownload(int $start, int $end = 1, int $min = 20, int $max = 50)
    {
        /* @var $queue \yii\queue\redis\Queue \ */
        $queue = \Yii::$app->queue_downloading;
        /*
        for ($i = $start; $i <= $start + $end - 1; $i++) {
            $queue->push(new \rhoone\spider\job\DownloadToMongoDBJob([
                'urlTemplate' => 'http://webpac.lib.tongji.edu.cn/opac/item.php?marc_no={%marc_no}',
                'urlParameters' => [
                    '{%marc_no}' => sprintf('%010s', (string) $i),
                ],
                'key' => sprintf('%010s', (string) $i),
                'keyAttribute' => 'marc_no',
                'modelClass' => \rhoone\library\providers\huiwen\targets\tongjiuniversity\models\mongodb\DownloadedContent::class
            ]));
        }
        */
        for ($i = $start; $batch = rand($min, $max), $batch = ($batch < $end - $i + 1) ? $batch : ($end - $i + 1), $i <= $end; $i += $batch)
        {
            $urlParameters = [];
            for ($j = 0; $j < $batch; $j++)
            {
                $urlParameters[sprintf('%010s', (string) $i + $j)] = [];
                $urlParameters[sprintf('%010s', (string) $i + $j)]['{%marc_no}'] = sprintf('%010s', (string) $i + $j);
            }
            /*
             * $urlParameters['0000000001']['{%marc_no}'] = ['0000000001']
             * The first dimension of the array is the key of the download task.
             * The second dimension of the array is the list of parameters for the download task, and the array value is
             * the value of the parameter.
             *
             */
            $queue->push(new \rhoone\library\providers\huiwen\targets\tongjiuniversity\job\BatchDownloadToMongoDBJob([
                'urlParameters' => $urlParameters,
            ]));
        }

        /*
        $queue->push(new \rhoone\spider\job\BatchDownloadToFileJob([
            'urlTemplate' => 'http://webpac.lib.tongji.edu.cn/asord/asord_hist.php?page={%page}',
            'urlParameters' => $this->getPages(),
            'filenameTemplate' => 'page_{%key}.html',
            'destination' => [
                'class' => \rhoone\spider\destinations\file\Destination::class,
            ],
        ]));*/
    }

    /**
     * Check the continuity of downloaded content.
     * @param int $start
     * @param int $end
     * @return int
     */
    public function actionCheckContinuityDownload(int $start, int $end)
    {
        $list = [];
        for ($i = $start; $i <= $end; $i++)
        {
            $marc_no = sprintf('%010s', (string) $i);
            if (!DownloadedContent::find()->where(['marc_no' => $marc_no])->exists())
            {
                $list[] = $marc_no;
            }
            printf("progress: [%-50s] %d%% Done.\r", str_repeat('#', ($i - $start + 1) / ($end - $start + 1) * 50), ($i - $start + 1) / ($end - $start + 1) * 100);
        }
        file_put_contents("php://stdout", "\n");
        if (empty($list)) {
            file_put_contents("php://stdout", "No omissions.\n");
            return 0;
        }
        $count = count($list);
        file_put_contents("php://stdout", "$count omission(s). The list is as follows:\n");
        foreach ($list as $marc_no)
        {
            file_put_contents("php://stdout", $marc_no . "\n");
        }
        return 0;
    }

    /**
     * @param int $start
     * @param int $end
     * @return int
     */
    public function actionPushAnalyze(int $start, int $end, int $min = 1000, int $max = 3000)
    {
        /* @var $queue \yii\queue\redis\Queue */
        $queue = \Yii::$app->queue_analyzing;
        for ($i = $start; $batch = rand($min, $max), $batch = ($batch < $end - $i + 1) ? $batch : ($end - $i + 1), $i <= $end; $i += $batch)
        {
            $marcNos = [];
            for ($j = 0; $j < $batch; $j++)
            {
                $marcNos[$i + $j] = sprintf('%010s', (string) $i + $j);
            }
            $queue->push(new \rhoone\library\providers\huiwen\targets\tongjiuniversity\job\BatchAnalyzeToMongoDBJob([
                'marcNos' => $marcNos
            ]));
            file_put_contents("php://stdout", count($marcNos) . " pushed, start from $i.\n");
        }
        return 0;
    }

    public function actionCheckContinuityAnalyze(int $start, int $end)
    {
        $list = [];
        for ($i = $start; $i<= $end; $i++)
        {
            $marc_no = sprintf('%010s', (string) $i);
            if (!MarcNo::find()->marcNo($marc_no)->exists()) {
                $list[] = $marc_no;
            }
            printf("progress: [%-50s] %d%% Done.\r", str_repeat('#', ($i - $start + 1) / ($end - $start + 1) * 50), ($i - $start + 1) / ($end - $start + 1) * 100);
        }
        file_put_contents("php://stdout", "\n");
        if (empty($list)) {
            file_put_contents("php://stdout", "No omissions.\n");
            return 0;
        }
        $count = count($list);
        file_put_contents("php://stdout", "$count omission(s). The list is as follows:\n");
        foreach ($list as $marc_no)
        {
            file_put_contents("php://stdout", $marc_no . "\n");
        }
        return 0;
    }

    public function actionPushIndex(int $start, int $end, int $min = 1000, int $max = 3000)
    {
        /* @var $queue \yii\queue\redis\Queue */
        $queue = \Yii::$app->queue_indexing;
        for ($i = $start; $batch = rand($min, $max), $batch = ($batch < $end - $i + 1) ? $batch : ($end - $i + 1), $i <= $end; $i += $batch)
        {
            $marcNos = [];
            for ($j = 0; $j < $batch; $j++)
            {
                $marcNos[$i + $j] = sprintf('%010s', (string) $i + $j);
            }
            $queue->push(new \rhoone\library\providers\huiwen\targets\tongjiuniversity\job\BatchIndexToElasticSearchJob([
                'marcNos' => $marcNos
            ]));
            file_put_contents("php://stdout", count($marcNos) . " pushed, start from $i.\n");
        }
        return 0;
    }

    public function actionCheckContinuityIndex(int $start, int $end)
    {
        $list = [];
        for ($i = $start; $i<= $end; $i++)
        {
            $marc_no = sprintf('%010s', (string) $i);
            if (!Marc::find()->marcNo($marc_no)->exists() && !(MarcNo::find()->marcNo($marc_no)->exists() && MarcNo::find()->marcNo($marc_no)->one()->isEmpty)) {
                $list[] = $marc_no;
            }
            printf("progress: [%-50s] %d%% Done.\r", str_repeat('#', ($i - $start + 1) / ($end - $start + 1) * 50), ($i - $start + 1) / ($end - $start + 1) * 100);
        }
        file_put_contents("php://stdout", "\n");
        if (empty($list)) {
            file_put_contents("php://stdout", "No omissions.\n");
            return 0;
        }
        $count = count($list);
        file_put_contents("php://stdout", "$count omission(s). The list is as follows:\n");
        foreach ($list as $marc_no)
        {
            file_put_contents("php://stdout", $marc_no . "\n");
        }
        return 0;
    }

    public function actionTest()
    {
        $marcNo = MarcNo::getOneOrCreate('0000000001');
        var_dump($marcNo->error_indexing);
        $marcNo->error_indexing = false;
        var_dump($marcNo->error_indexing);
        if (!$marcNo->save()) {
            var_dump($marcNo->errors);
        }
        var_dump($marcNo->error_indexing);
        return 0;
    }

    /**
     * @return array
     */
    private function getPages()
    {
        $pages = [];
        foreach (range(1, 3) as $i)
        {
            $pages[$i] = ['{%page}' => $i];
        }
        return $pages;
    }
}
