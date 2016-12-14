<?php

use app\modules\main\models\ContactForm;
//use app\modules\main\models\SubscribeForm;
use yii\web\View;
use app\modules\subscribe\models\Subscribe;
use app\modules\usertalk\models\Usertalk;

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
    <div class="container container-top">

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
    //            'model' => new ContactForm(),
                'model' => new Usertalk(),
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
</div>

<?php

