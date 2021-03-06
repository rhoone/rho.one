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
 * Date: 2018/12/21
 * Time: 0:12
 */

namespace common\rhoone\library\widgets;


use yii\base\Widget;

/**
 * Class SearchResultItem
 * @package common\rhoone\library\widgets
 */
class SearchResultItem extends Widget
{
    /**
     * @var 检索结果条目。
     */
    public $item;

    public function run()
    {
        return $this->render('search-result-item', [
            'item' => $this->item,
        ]);
    }
}