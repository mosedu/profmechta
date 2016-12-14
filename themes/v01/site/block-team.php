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
        <div class="col-lg-2 col-md-2 col-sm-1 hidden-xs"></div>
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
            <div class="row">
                <?php
                    $aSpeaker = [
                        [
                            'src' => '/img/team/woman-437x437.jpg',
                            'name' => 'Анастасия Горчакова',
                            'prof' => 'Руководитель проекта',
                        ],
                        [
                            'src' => '/img/team/man-300x300.jpg',
                            'name' => 'Сергей Дробышев',
                            'prof' => 'Координатор проекта',
                        ],
                        [
                            'src' => '/img/team/woman-251x251.jpg',
                            'name' => 'Ольга Кондратенко',
                            'prof' => 'Пресс-служба',
                        ],
                        [
                            'src' => '/img/team/woman-310x310.jpg',
                            'name' => 'Анастасия Горчакова',
                            'prof' => 'Руководитель проекта',
                        ],
                        [
                            'src' => '/img/team/man-267x267.jpg',
                            'name' => 'Анастасия Горчакова',
                            'prof' => 'Руководитель проекта',
                        ],




                    ];
                    for($i=0; $i<3; $i++) {
                        echo $this->render(
                            'one_team',
                            [
                                'aPerson' => $aSpeaker[$i],
                            ]
                        );
//                        break;
                    }
                ?>
            </div>
        </div>
    </div>

</div>

