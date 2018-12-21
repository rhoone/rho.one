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

use common\rhoone\library\widgets\SearchResultItems;
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

    /**
     * @param mixed $keywords
     * @param mixed $config
     * @return string
     * @throws \Exception
     */
    public function search($keywords, $config = [])
    {
        $library = new $this->libraryClass;
        $provider = $library->search($keywords, $config);
        return SearchResultItems::widget(['provider' => $provider]);
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