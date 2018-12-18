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
 * Date: 2018/12/17
 * Time: 16:33
 */

namespace console\modules\spider\target\library\models;

/**
 * Book Template.
 * DO NOT INSTANCIATE IT.
 * @package console\modules\spider\target\library\models
 */
class Book extends \yii\base\Model
{
    public $barcode = "";
    public $volume_period = "";
    public $position = "";
    public $status = "";
}