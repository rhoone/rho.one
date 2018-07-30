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

namespace common\rhoone\curriculum;

use rhoone\extension\Extension as ExternalExt;

/**
 * Description of Extension
 *
 * @author vistart <i@vistart.name>
 */
class Extension extends ExternalExt
{

    public static function name()
    {
        return '同济大学课程';
    }

    public function search($keywords)
    {
        return null;
    }

    /**
     * Get module configuration array.
     * @return array module configuration array.
     */
    public static function getModule()
    {
        return [
            'class' => Module::className(),
            'id' => 'tongji-curriculum',
        ];
    }
}
