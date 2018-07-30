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

namespace rho_one\controllers\site;

use Yii;

/**
 * Description of SearchAction
 *
 * @author vistart <i@vistart.name>
 */
class SearchAction extends \yii\base\Action
{

    public function run()
    {
        $keywords = Yii::$app->request->post();
        if ($keywords === null) {
            return "empty keywords.";
        }
        return print_r($keywords);
    }
}
