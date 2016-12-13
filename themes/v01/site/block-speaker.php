<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-speaker
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */
/* @var $nextLessons array */

?>

<div class="index-speaker">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'СПИКЕРЫ']) ?>

    <div class="row">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1"><div class="prev-speaker">&lt;</div></div>
                <?php
                    $aSpeaker = [];
//                    for($i=0; $i<6; $i++) {
                    foreach($nextLessons As $nearestLesson) {
//                        $aSpeaker[] = $this->render('one_lector', ['model' => $nearestLesson]);
                        $aSpeaker[] = $this->render('one_lector', ['model' => $nearestLesson]);
                    }
//                    $nCou = count($aSpeaker);
//                    while( count($aSpeaker) < 6 ) {
//                        $aSpeaker[] = $aSpeaker[count($aSpeaker)%$nCou];
//                    }
                ?>
                <?= Slick::widget([

                    // HTML tag for container. Div is default.
                    'itemContainer' => 'div',

                    // HTML attributes for widget container
                    'containerOptions' => ['class' => 'lector-slider col-md-10 col-sm-8 col-xs-8'],

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
                        'respondTo' => 'slider',
                        'responsive' => [
                            [
                                'breakpoint' => 500,
                                'settings' => [
                                    'slidesToShow' => 3,
                                    'slidesToScroll' => 1,
//                                    'infinite' => true,
//                                    'dots' => true,
                                ]
                            ],
                            [
                                'breakpoint' => 360,
                                'settings' => [
                                    'slidesToShow' => 2,
                                    'slidesToScroll' => 1,
//                                    'infinite' => true,
//                                    'dots' => true,
                                ]
                            ],
                        ],
                        // note, that for params passing function you should use JsExpression object
                        'onAfterChange' => new JsExpression('function() {console.log("The speaker has shown")}'),
                    ],

                ])
                ?>
                <div class="col-xs-1 col-sm-1 col-md-1"><div class="next-speaker">&gt;</div></div>
            </div>
        </div>
    </div>

</div>

