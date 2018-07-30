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
 * @author vistart <i@vistart.name>
 * @since 2.0
 */
class CommonAsset extends AssetBundle
{

    public $sourcePath = "@common/assets/common";
    public $css = [
        'css/site.css',
        'css/style.css',
        'css/theme.css',
        'css/Lato.woff2',
    ];
    public $js = [
        //'rho' => 'js/rho.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesomeAsset',
        'common\assets\OpenSansAsset',
        'common\assets\HolderAsset',
    ];

}
