<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\assets\CommonAsset;
use common\widgets\Alert;

CommonAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script>
            var _czc = _czc || [];
            // _czc.push(["_setAccount", "<?= isset(Yii::$app->params['cnzz']['siteId']) ? Yii::$app->params['cnzz']['siteId'] : 0 ?>"]);
        </script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Search in one',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; vistart <?= date('Y') ?></p>

                <p class="pull-right">
                    <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31011402005634"><img src="<?= Yii::$app->assetManager->getPublishedUrl("@common/assets/common") ?>/img/public-security.png" style="float:left;"/>沪公网安备 31011402005634号</a>
                    &nbsp;
                    <a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备14009001号-5</a>
                </p>
            </div>
        </footer>
        <?php if (isset(Yii::$app->params['cnzz']['code'])): ?>
        <div class="hidden">
            <?= Yii::$app->params['cnzz']['code'] ?>
        </div>
        <?php endif; ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
