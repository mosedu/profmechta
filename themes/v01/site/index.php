<?php

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>
<div class="wrap" style="max-width: 1800px;">
    <?= $this->render('//site/top-bar') ?>
    <?= $this->render('//site/top-banner', ['nearestLesson' => $nearestLesson]) ?>
    <?= $this->render('//site/block-mission', []) ?>
    <?= $this->render('//site/block-afisha', ['nearestLesson' => $nearestLesson]) ?>
    <?= $this->render('//site/block-about', []) ?>
</div>
