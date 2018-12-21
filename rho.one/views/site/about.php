<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '关于';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This website for searching Tongji University Library is the first practical website developed by our team.</p>

    <p>You can enter the keywords you want in the search box without having to manually specify the search category.</p>

    <p>Waiting for one second after the input is completed will automatically initiate the search without clicking
        the "Search" button or pressing the Enter key.</p>

    <p>We hope that our services will bring great convenience to your work.</p>

    <p>We will do our utmost to improve the user experience and improve the search quality.</p>
    <p>Have fun! :)</p>
</div>
