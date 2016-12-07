<?php

// block-afisha
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */
/* @var $nextLessons array app\modules\lessons\models\Lesson */

?>

<div class="index-afisha">
    <?= $this->render('block_title_green_margin', ['title' => 'АФИША СОБЫТИЙ']) ?>

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div class="row">
                <?php
                foreach($nextLessons As $nearestLesson) {
//                for($i=0; $i<4; $i++) {
                    echo $this->render('//lessons/one-lesson-large', ['nearestLesson' => $nearestLesson]);
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
            <a class="btn btn-default" href="#" style="width: 130px; border: 2px solid #4ecd66; color: #4ecd66; font-weight: bold; background-color: transparent;">Еще</a>
            <?php
                }
            ?>
        </div>
    </div>
</div>

