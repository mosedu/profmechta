<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-speaker
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<div class="index-speaker">
    <?= $this->render('block_title_green_margin', ['title' => 'СПИКЕРЫ']) ?>

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-1 col-sm-offset-1 prev-speaker">&lt;</div>
                <?php
                    $aSpeaker = [];
                    for($i=0; $i<6; $i++) {
                        $aSpeaker[] = $this->render('one_lector', ['model' => $nearestLesson]);
                    }
                ?>
                <?= Slick::widget([

                    // HTML tag for container. Div is default.
                    'itemContainer' => 'div',

                    // HTML attributes for widget container
                    'containerOptions' => ['class' => 'lector-slider col-sm-8'],

                    // Items for carousel. Empty array not allowed, exception will be throw, if empty
                    'items' => $aSpeaker,

                    // HTML attribute for every carousel item
                    'itemOptions' => ['class' => 'one-lector'],

                    // settings for js plugin
                    // @see http://kenwheeler.github.io/slick/#settings
                    'clientOptions' => [
//            'autoplay' => true,
//                        'prevArrow' => '<div class="slick-prev slick-arrow"><a>&lt;</a></div>',
//                        'nextArrow' => '<div class="slick-next slick-arrow"><a>&gt;</a></div>',
                        'prevArrow' => '.prev-speaker',
                        'nextArrow' => '.next-speaker',
                        'dots'     => false,
                        'infinite' => true,
                        'slidesToShow' => 4,
                        'slidesToScroll' => 1,
                        // note, that for params passing function you should use JsExpression object
                        'onAfterChange' => new JsExpression('function() {console.log("The speaker has shown")}'),
                    ],

                ])
                ?>
                <div class="col-sm-1 next-speaker">&gt;</div>
            </div>
        </div>
    </div>

</div>

