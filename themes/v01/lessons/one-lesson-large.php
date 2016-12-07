<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Leslect */
/* @var $bTopBlock boolean блок показывается сверху страницы (там надпись "Ближайшая лекция" ) */

if( !isset($bTopBlock) ) {
    $bTopBlock = false;
}
if( $nearestLesson !== null ) {
    ?>

    <div class="col-sm-3">
        <div class="top-banner-block">
            <?php
                if( $bTopBlock ) {
            ?>
            <p style="text-align: center; font-weight: bold;">Ближайшая лекция</p>
            <?php
                }
            ?>
            <?= '' // nl2br(print_r($nearestLesson->attributes, true))  ?>
            <div class="image-relative-block">
                <div class="date-block">
                    <?= date('d.m.Y', strtotime($nearestLesson->ll_date)) ?>
                </div>
                <img class="lesson-large-image" src="<?php
                    $sf = $nearestLesson->lector->getImage('base');
                    if( empty($sf) ) {
                        $sf = '/themes/v01/images/placeholder-240x240.gif';
                    }
                    echo $sf;
                ?>"/>
            </div>

<!--            <h1 style="text-align: center;">--><?= '' // Html::encode($nearestLesson->lesson->les_title) ?><!--</h1>-->
            <div style="margin: 0; padding: 0;<?=  $bTopBlock ? '' : ' height: 240px;' ?>">
                <p style="text-align: center; margin-top: 18px; margin-bottom: 0; font-size: 15px;"><strong><?= Html::encode($nearestLesson->lector->lec_fam) ?></strong></p>

                <p style="text-align: center; margin-bottom: 0px; font-size: 15px;"><?= Html::encode($nearestLesson->lector->lec_profession) ?></p>

                <p style="text-align: center; margin: 0; font-size: 0px; margin-bottom: 10px; margin-top: 6px;"><span class="thin-border"></span></p>

                <p style="text-align: center; font-size: 13px;"><?= Html::encode($nearestLesson->lesson->les_description) ?></p>
            </div>

            <p style="text-align: center;"><?= Html::a('Участвуй', '#', ['class' => 'btn btn-success']) ?></p>
        </div>
    </div>

<?php
}
else {
    echo '';
}
