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

    public function actionClearSearchIndex($target)
    {
        $library = self::getTarget($target);
        $bookSearch = $library->bookSearchClass::deleteAll();
    }

    public function actionCreateSearchIndex($target)
    {
        $library = self::getTarget($target);
        $library->bookSearchClass::createIndex();
    }

    public function actionSearch($target)
    {
        $library = self::getTarget($target);

    }
}
