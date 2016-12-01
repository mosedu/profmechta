<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<div class="top-banner-block col-xs-3">
    <?= '' // nl2br(print_r($nearestLesson->attributes, true)) ?>
    <h1 style="text-align: center;"><?= Html::encode($nearestLesson->lesson->les_title) ?></h1>
    <p style="text-align: center;"><strong><?= Html::encode($nearestLesson->lector->lec_fam) ?></strong></p>
    <p style="text-align: center;"><?= Html::encode($nearestLesson->lector->lec_profession) ?></p>
    <p style="text-align: center;"><?= Html::encode($nearestLesson->lesson->les_description) ?></p>
    <p style="text-align: center;"><?= Html::a('Участвуй', '#', ['class' => 'btn btn-success']) ?></p>
</div>