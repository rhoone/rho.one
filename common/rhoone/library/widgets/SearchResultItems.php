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
 * Time: 16:21
 */

namespace common\rhoone\library\widgets;


use yii\base\Widget;
use yii\elasticsearch\ActiveDataProvider;

/**
 * Class SearchResultItems
 * @package common\rhoone\library\widgets
 */
class SearchResultItems extends Widget
{
    public $paginationConfig = [
        //'page' => 0,
        'pageParam' => 'library-page',
        //'pageSize' => 10,
        'pageSizeParam' => 'library-per-page',
    ];
    /**
     * @var ActiveDataProvider
     */
    public $provider;

    public function run()
    {
        return $this->render('search-result-items', [
            'provider' => $this->provider,
            'paginationConfig' => $this->paginationConfig,
        ]);
    }
}