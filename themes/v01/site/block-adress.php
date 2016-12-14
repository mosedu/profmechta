<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-adress
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
<div class="index-adress">
    <?= $this->render('block_title_green_margin', ['title' => 'КОНТАКТЫ']) ?>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-12" style="margin-bottom: 24px; font-size: 16px; font-weight: 600; font-style: normal; text-align: center;">Наши лекции проводятся по адресам:</div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-0 col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-5 col-xs-offset-1">
                    <div style="padding: 0; margin: 0; border: 0px none transparent; float: right;">
                        <p class="adress-street">1-й Зборовский переулок, д. 3</p>
                        <p class="adress-phone">+7 495 333-33-33</p>
                        <p class="adress-email">ssddd@adfs.ru</p>
                        <p class="adress-map">Посмотреть на карте</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                    <p class="adress-street">1-й Зборовский переулок, д. 3</p>
                    <p class="adress-phone">+7 495 333-33-33</p>
                    <p class="adress-email">ssddd@adfs.ru</p>
                    <p class="adress-map">Посмотреть на карте</p>
                </div>
            </div>
        </div>
    </div>

</div>

