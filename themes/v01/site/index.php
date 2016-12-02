<?php

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */



$this->title = Yii::$app->name;

?>
<div class="wrap" style="max-width: 1800px;">
    <?= $this->render('//site/top-bar') ?>
    <?= $this->render('//site/top-banner', ['nearestLesson' => $nearestLesson]) ?>
    <?= $this->render('//site/block-mission', []) ?>
    <?= $this->render('//site/block-afisha', ['nearestLesson' => $nearestLesson]) ?>
    <?= $this->render('//site/block-about', []) ?>
    <?= $this->render('//site/block-subscribe', []) ?>
    <?= $this->render('//site/block-speaker', ['nearestLesson' => $nearestLesson]) ?>
    <?= $this->render('//site/block-team') ?>
    <?= $this->render('//site/block-contact') ?>
    <?= $this->render('//site/block-reply') ?>
    <?= $this->render('//site/block-adress') ?>
</div>
