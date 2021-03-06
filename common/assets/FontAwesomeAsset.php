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

namespace common\assets;

use yii\web\AssetBundle;
/**
 * Description of FontAwesomeAsset
 *
 * @author vistart <i@vistart.name>
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = "@bower/font-awesome";
    public $css = [
        'css' => 'css/font-awesome.min.css',
    ];
}
