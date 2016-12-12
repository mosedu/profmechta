<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-team
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

// hidden-sm

?>

<div class="index-team">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'КОМАНДА']) ?>

    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-1 hidden-xs"></div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
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

