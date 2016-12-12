<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-adress
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<div class="index-adress">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'КОНТАКТЫ']) ?>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="margin-bottom: 24px; font-size: 16px; font-weight: 600; font-style: normal; text-align: center;">Наши лекции проводятся по адресам:</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div style="padding: 0; margin: 0; border: 0px none transparent; float: right;">
                    <p class="adress-street">1-й Зборовский переулок, д. 3</p>
                    <p class="adress-phone">+7 495 333-33-33</p>
                    <p class="adress-email">ssddd@adfs.ru</p>
                    <p class="adress-map">Посмотреть на карте</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p class="adress-street">1-й Зборовский переулок, д. 3</p>
                    <p class="adress-phone">+7 495 333-33-33</p>
                    <p class="adress-email">ssddd@adfs.ru</p>
                    <p class="adress-map">Посмотреть на карте</p>
                </div>
            </div>
        </div>
    </div>

</div>

