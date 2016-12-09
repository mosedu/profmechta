<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

// block-contact
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

?>

<div class="index-contact">
    <h3>Поделись с нами своей мечтой</h3>

    <div class="row">
        <div class="col-md-3 col-sm-1 col-xs-1"></div>
        <div class="col-md-6 col-sm-10 col-xs-10">
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6"><input name="email" type="text" placeholder="Ф.И.О." style="width: 100%;"></div>
                <div class="col-sm-6"><input name="email" type="text" placeholder="E-mail" style="width: 100%;"></div>
            </div>
            <div class="row">
                <div class="col-sm-12"><textarea name="email" placeholder="Введите свой текст" style="width: 100%;" rows="4"></textarea></div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4" style="text-align: center;">
                    <input type="submit" name="submit" class="btn btn-default" style="border-color: #ffffff; color: #ffffff; background-color: transparent; " value="Отправить">
                </div>
            </div>
            </form>
        </div>
    </div>

</div>

