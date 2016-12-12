<?php

use yii\helpers\Html;
use yii\helpers\Url;

// block-afisha
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */
/* @var $nextLessons array app\modules\lessons\models\Lesson */

?>

<div class="index-afisha">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'АФИША СОБЫТИЙ']) ?>

    <div class="row">
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                <?php
                foreach($nextLessons As $nearestLesson) {
//                for($i=0; $i<4; $i++) {
                ?>
                <div class="col-md-3 col-sm-3 col-xs-6">
                <?php
                    echo $this->render('//lessons/one-lesson-large', ['nearestLesson' => $nearestLesson]);
                ?>
                </div>
                <?php
                }
                if( count($nextLessons) == 0 ) {
                ?>
                    <div class="col-sm-6 col-sm-offset-3" style="text-align: center;">
                        В ближайшем будущем не будет никаких событий.
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 32px;">
        <div class="col-sm-4 col-sm-offset-4" style="text-align: center;">
            <?php
                if( count($nextLessons) > 3 ) {
            ?>
            <?= Html::a(
                'Еще',
                Url::toRoute('/lessons/leslect/index'),
                [
                    'class' => "btn btn-default",
                    'style' => "width: 130px; border: 2px solid #4ecd66; color: #4ecd66; font-weight: bold; background-color: transparent;",
                ])
            ?>
<!--            <a class="btn btn-default" href="#" style="width: 130px; border: 2px solid #4ecd66; color: #4ecd66; font-weight: bold; background-color: transparent;">Еще</a>-->
            <?php
                }
            ?>
        </div>
    </div>
</div>

