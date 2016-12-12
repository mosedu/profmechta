<?php

use app\modules\main\models\ContactForm;
//use app\modules\main\models\SubscribeForm;
use yii\bootstrap\Modal;
use yii\web\View;
use app\modules\subscribe\models\Subscribe;

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */
/* @var $nextLessons array of app\modules\lessons\models\Lesson */

if( !isset($nextLessons) ) {
    $nextLessons = [];
}


$this->title = Yii::$app->name;

?>
<div class="wrap" style="max-width: 1800px;">
    <?= $this->render('//site/top-bar') ?>
    <?= $this->render('//site/top-banner', ['nearestLesson' => $nearestLesson, ]) ?>
    <?= $this->render(
        '//site/block-mission',
        [
            'name' => 'mission-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-afisha',
        [
            'nextLessons' => $nextLessons,
            'name' => 'afisha-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-about',
        [
            'name' => 'about-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-subscribe',
        [
            'name' => 'subscribe-block',
//            'model' => new SubscribeForm(),
            'model' => new Subscribe(),
        ]
    ) ?>
    <?= $this->render(
        '//site/block-speaker',
        [
            'nextLessons' => $nextLessons,
            'name' => 'speaker-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-team',
        [
            'name' => 'team-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-contact',
        [
            'name' => 'contact-block',
            'model' => new ContactForm(),
        ]
    ) ?>
    <?= $this->render(
        '//site/block-reply',
        [
            'name' => 'reply-block',
        ]
    ) ?>
    <?= $this->render(
        '//site/block-adress',
        [
            'name' => 'adress-block',
        ]
    ) ?>
    <?= $this->render('//site/block-footer') ?>
</div>

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

