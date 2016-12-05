<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

if( $nearestLesson !== null ) {
    ?>

    <div class="col-sm-3">
        <div class="top-banner-block">
            <?= '' // nl2br(print_r($nearestLesson->attributes, true))  ?>
            <img class="lesson-large-image" src="/themes/v01/images/placeholder-240x240.gif"/>

            <h1 style="text-align: center;"><?= Html::encode($nearestLesson->lesson->les_title) ?></h1>

            <p style="text-align: center;"><strong><?= Html::encode($nearestLesson->lector->lec_fam) ?></strong></p>

            <p style="text-align: center; margin-bottom: 0px;"><?= Html::encode($nearestLesson->lector->lec_profession) ?></p>

            <p style="text-align: center; margin: 0;"><span class="thin-border"></span></p>

            <p style="text-align: center;"><?= Html::encode($nearestLesson->lesson->les_description) ?></p>

            <p style="text-align: center;"><?= Html::a('Участвуй', '#', ['class' => 'btn btn-success']) ?></p>
        </div>
    </div>

<?php
}
else {
    echo '';
}
