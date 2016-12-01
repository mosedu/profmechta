<?php

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */


?>
<div class="wrap">
    <?= $this->render('//site/top-bar') ?>
    <?= $this->render('//site/top-banner', ['nearestLesson' => $nearestLesson]) ?>
</div>
