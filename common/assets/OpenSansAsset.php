<?php

/**
 *   _   __ __ _____ _____ ___  ____  _____
 *  | | / // // ___//_  _//   ||  __||_   _|
 *  | |/ // /(__  )  / / / /| || |     | |
 *  |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license http://vistart.name/license/
 */

namespace common\assets;

use yii\web\AssetBundle;
/**
 * Description of OpenSansAsset
 *
 * @author vistart <i@vistart.name>
 */
class OpenSansAsset extends AssetBundle {
    public $sourcePath = '@bower/open-sans';
    public $css = [
        'css/open-sans.min.css',
    ];
}
