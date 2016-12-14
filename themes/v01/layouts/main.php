<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppV01Asset;
use yii\bootstrap\Modal;
use yii\web\View;

AppV01Asset::register($this);
/*
    <link href="http://<?= $sHost ?>/apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-76.png" rel="apple-touch-icon" sizes="76x76" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-120.png" rel="apple-touch-icon" sizes="120x120" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-152.png" rel="apple-touch-icon" sizes="152x152" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-180.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-precomposed.png" rel="apple-touch-icon-precomposed" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-76-precomposed.png" rel="apple-touch-icon-precomposed" sizes="76x76" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-120-precomposed.png" rel="apple-touch-icon-precomposed" sizes="120x120" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-152-precomposed.png" rel="apple-touch-icon-precomposed" sizes="152x152" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-180-precomposed.png" rel="apple-touch-icon-precomposed" sizes="180x180" />
    <link href="http://<?= $sHost ?>/icon-hires.png" rel="icon" sizes="192x192" />
    <link href="http://<?= $sHost ?>/icon-normal.png" rel="icon" sizes="128x128" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
*/
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= '/favicon.ico' ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

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
