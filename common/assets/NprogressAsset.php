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
use yii\web\View;

/**
 * Description of NprogressAsset
 *
 * @author vistart <i@vistart.name>
 */
class NprogressAsset extends AssetBundle
{

    public $sourcePath = "@bower/nprogress";
    public $js = [
        'nprogress' => 'nprogress.js',
    ];
    public $jsOptions = [
        //'position' => View::POS_HEAD,
    ];
    public $css = [
        'nprogress' => 'nprogress.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
