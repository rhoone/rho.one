<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <div id="search_area" class="col-md-12">
            <?= \rhoone\widgets\SearchWidget::widget() ?>
        </div>
    </div>
</div>