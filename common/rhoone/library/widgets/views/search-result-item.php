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
 * Time: 16:22
 */

/* @var Book $item */
$baseUrl = 'http://webpac.lib.tongji.edu.cn/opac/item.php?marc_no=';
$bundle = \common\assets\CommonAsset::register($this);
?>

<li>
    <div class="media">
        <div class="pull-right memberActions">
            <a class="btn btn-primary btn-sm followButton" href="<?= $baseUrl . $item->marc_no ?>" target="_blank">前往</a>
        </div>

        <span class="pull-left"><a href="#"><img class="img-rounded" src="<?= $bundle->baseUrl ?>/img/book.jpg" alt="#" style="width: 50px; height: 50px"></a></span>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?= $baseUrl . $item->marc_no ?>" target="_blank"><?= $item->title ?></a>
                <small><?= implode(', ', $item->authors) ?></small>
            </h4>
            <h5><?= implode(', ', $item->presses) ?></h5>
            <h5><?= implode(', ', $item->ISBNs) ?></h5>
            <?php if(!empty($item->abstract)): ?>
            <p><?= $item->abstract ?></p>
            <?php endif; ?>
            <?php if (!empty($item->subjects)): ?>
            <a class="label label-default" href="#"><?= $item->call_no ?></a>
            <?php $subjects = array_unique(explode(',', implode(',', explode('-', implode('-', $item->subjects))))); ?>
            <?php foreach ($subjects as $subject): ?>
            <a class="label label-default" href="#"><?= $subject ?></a>&nbsp;
            <?php endforeach; ?>
            <?php endif; ?>
            <div class="well well-small comment-container">
            <?php if (!empty($item->books)): ?>
                <?php foreach ($item->books as $book): ?>
                    <div class="comment">
                        <div class="media">
                            <div class="content comment_edit_content">
                                <div class="comment-message row">
                                    <div class="col-md-3"><?= $book['barcode'] ?></div>
                                    <div class="col-md-3"><?= $book['position'] ?></div>
                                    <div class="col-md-3"><?= $book['volume_period'] ?></div>
                                    <div class="col-md-3"
                                         <?php if ($book['status'] == '可借'): ?>
                                         style="color: green"
                                         <?php endif; ?>
                                         <?php if (strpos($book['status'], '借出') === 0): ?>
                                         style="color: red"
                                         <?php endif; ?>
                                    ><?= $book['status'] ?></div>
                                </div>
                            </div>
                            <?php if ($book != end($item->books)):?>
                            <hr>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>此书刊没有副本。</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</li>
