<?php
/* @var $this yii\web\View */

$this->title = 'Search in one';
?>
<div class="site-index">
    <div class="row">
        <div id="search_area" class="col-md-12">
            <?= \rhoone\widgets\SearchWidget::widget() ?>
        </div>
    </div>
</div>