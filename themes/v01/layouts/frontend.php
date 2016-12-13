<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppV01Asset;
use yii\bootstrap\Modal;
use yii\web\View;

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
    <div class="container container-frontend">
        <div class="page-title-block">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php
            if( isset($this->blocks['title-block']) ) {
                echo $this->blocks['title-block'];
            }
            ?>
        </div>
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
<?php
Modal::begin([
    'header' => '<span></span>',
    'id' => 'messagedata',
    'size' => Modal::SIZE_LARGE,
]);
Modal::end();

$sJs = <<<EOT
var params = {};
params[$('meta[name=csrf-param]').prop('content')] = $('meta[name=csrf-token]').prop('content');

jQuery('.showinmodal').on("click", function (event){
    event.preventDefault();

    var ob = jQuery('#messagedata'),
        oBody = ob.find('.modal-body'),
        oLink = $(this);

    oBody.text("");
    oBody.load(
        oLink.attr('href'),
        params,
        function(responseText, textStatus, jqXHR){
            ob.find('.modal-header span').text(oLink.attr('title'));
            ob.modal('show');
        }
    );
//    ob.find('.modal-header span').text(oLink.attr('title'));
//    ob.modal('show');

    return false;
});
EOT;

$this->registerJs($sJs, View::POS_READY, 'showmodalmessage');

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
