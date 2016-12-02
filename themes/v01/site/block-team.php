<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-team
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<div class="index-team">
    <?= $this->render('block_title_green_margin', ['title' => 'КОМАНДА']) ?>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="row">
                <?php
                    $aSpeaker = [];
                    for($i=0; $i<3; $i++) {
                        echo $this->render('one_team');
                    }
                ?>
            </div>
        </div>
    </div>

</div>

