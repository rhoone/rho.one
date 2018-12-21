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

use common\rhoone\library\widgets\SearchResultItem;
use yii\data\Pagination;
use yii\elasticsearch\ActiveDataProvider;
use yii\widgets\LinkPager;

/* @var ActiveDataProvider $provider */
/* @var array $paginationConfig */
$pagination = new Pagination($paginationConfig);
$provider->pagination = $pagination;
$items = $provider->getModels();
?>
<ul class="media-list">
    <?php if (empty($items)): ?>
    <p>没有找到您想要的内容。</p>
    <p>建议您更换关键词。</p>
    <?php else: ?>
    <?php
        $start = $pagination->page * $pagination->pageSize + 1;
        $end = $start + $pagination->pageSize - 1;
        if ($end > $pagination->totalCount) {
            $end = $pagination->totalCount;
        } ?>
    <p>共 <?= $pagination->totalCount ?> 条结果，本页显示第 <?= $start . ' - ' . $end ?> 条。</p>
    <?php foreach ($items as $item): ?>
    <?= SearchResultItem::widget(['item' => $item]) ?>
    <?php endforeach; ?>
    <?php endif; ?>
</ul>

<?php
echo LinkPager::widget([
        'pagination' => $pagination,
])
?>
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="关闭"><span aria-hidden="true">&times;</span></button>
    <strong>注意！</strong> 检索内容基于<a href="http://webpac.lib.tongji.edu.cn">同济大学图书馆</a>2018年12月10日的数据。因此，图书的“借阅状态”仅供参考；在此之后新入藏的书籍可能无法被检索到。
</div>

