<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppV01Asset;

AppV01Asset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap" style="max-width: 1800px;">
    <?= $this->render('//site/top-bar') ?>
    <div class="container container-top">
        <?= $content ?>
    </div>
    <?= $this->render('//site/block-footer') ?>
</div>


<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; --><?//= Yii::$app->name ?><!-- --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= '' // Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
