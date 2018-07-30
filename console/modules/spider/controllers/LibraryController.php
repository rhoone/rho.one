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
        echo "$result primary record(s) done (at $datetime). Elapsed: $duration (seconds).\r\n";
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
}
