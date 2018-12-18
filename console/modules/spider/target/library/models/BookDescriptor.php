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
 * Time: 16:27
 */
namespace console\modules\spider\target\library\models;

/**
 * BookDescription Template.
 * DO NOT INSTANCIATE IT.
 * @package console\modules\spider\target\library\models
 */
class BookDescriptor extends \yii\base\Model
{
    public $marc_no = "";
    public $title = "";
    public $authors = [];
    public $presses = [];
    public $forms = [];
    public $prices = [];
    public $ISBNs = [];
    public $subjects = [];
    public $classes = [];
    public $call_no = "";
    public $abstract = "";
    public $target_readers = [];
    public $status = "";

    public $type = "";
    public $page_visit = "";

    /**
     * @var Book[]
     */
    public $books = [];
}