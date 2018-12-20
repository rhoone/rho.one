<?php
/**
 * *
 *  *  _   __ __ _____ _____ ___  ____  _____
 *  * | | / // // ___//_  _//   ||  __||_   _|
 *  * | |/ // /(__  )  / / / /| || |     | |
 *  * |___//_//____/  /_/ /_/ |_||_|     |_|
 *  * @link https://vistart.name/
 *  * @copyright Copyright (c) 2016 vistart
 *  * @license https://vistart.name/license/
 *
 */

/**
 * Created by PhpStorm.
 * User: i
 * Date: 2018/12/19
 * Time: 18:52
 */

namespace common\rhoone\library;

use console\modules\spider\target\library\TongjiUniversity\models\search\Book;
use rhoone\extension\Extension as ExternalExt;

class Extension extends ExternalExt
{
    public $libraryClass = \console\modules\spider\target\library\TongjiUniversity::class;
    public static function id()
    {
        return 'tongji-library';
    }

    public static function name()
    {
        return '同济大学图书馆';
    }

    public function search($keywords)
    {
        $library = new $this->libraryClass;
        $results = [];
        foreach ($library->search($keywords) as $item)
        {
            /* @var Book $item */
            $results[] = ($item->title . " | " . next($item->authors) . " | " . $item->call_no . " | " . $item->marc_no . "<br/>");
        }
        return implode(" ", $results);
    }

    /**
     * Get module configuration array.
     * @return array module configuration array.
     */
    public static function getModule()
    {
        return [
            'class' => Module::class,
            'id' => 'tongji-library',
        ];
    }
}