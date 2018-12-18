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
 * User: vistart
 * Date: 2018/12/17
 * Time: 16:12
 */

namespace console\modules\spider\target\library\TongjiUniversity\models;

/**
 * Class Book
 * @package console\modules\spider\target\library\TongjiUniversity\models
 */
class Book extends \console\modules\spider\target\library\models\Book
{
    public function attributes()
    {
        return ['status', 'position', 'barcode', 'volume_period'];
    }
    /**
     * @param Marc $item
     */
    public function refreshAttributes($item)
    {
        $this->status = $item->status;
        $this->position = $item->position;
        $this->barcode = $item->barcode;
        $this->volume_period = $item->volume_period;
    }
}