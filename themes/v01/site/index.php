<?php

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
    <?= $this->render('//site/block-mission', []) ?>
    <?= $this->render('//site/block-afisha', ['nextLessons' => $nextLessons]) ?>
    <?= $this->render('//site/block-about', []) ?>
    <?= $this->render('//site/block-subscribe', []) ?>
    <?= $this->render('//site/block-speaker', ['nextLessons' => $nextLessons]) ?>
    <?= $this->render('//site/block-team') ?>
    <?= $this->render('//site/block-contact') ?>
    <?= $this->render('//site/block-reply') ?>
    <?= $this->render('//site/block-adress') ?>
</div>
