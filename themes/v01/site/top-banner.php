<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 01.12.2016
 * Time: 14:42
 */

/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<nav id="w1" class="navbar-default navbar-transparent navbar top-banner-pos" role="navigation" style="margin-bottom: 0;">
<!--    <div class="container topbackground">-->
        <div class="col-lg-6 col-lg-offset-2 col-md-7 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-11 col-xs-offset-1">
            <div class="top-block-title">
                <h2 class="title-1">Выбери</h2>
                <h2 class="title-1">профессию мечты</h2>
                <h2 class="title-2">Учись у лучших!</h2>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 hidden-sm hidden-xs">
            <?= $this->render('//lessons/one-lesson-large', ['nearestLesson' => $nearestLesson, 'bTopBlock' => true, ]) ?>
        </div>
<!--    </div>-->
</nav>

<?php

//        <div class="navbar-header">
//            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
//                <span class="sr-only">Toggle navigation</span>
//                <span class="icon-bar"></span>
//                <span class="icon-bar"></span>
//                <span class="icon-bar"></span>
//            </button>
//            <a class="navbar-brand" href="/"><img class="floatleft" src="/themes/v01/images/page-1-temo.png" alt="Профмечта"> <img class="floatleft ptichka" src="/themes/v01/images/page-1-ptichka.png" alt="Профмечта">Профессия мечты</a>
//        </div>
//        <div id="w0-collapse" class="collapse navbar-collapse">
//            <ul id="w1" class="navbar-nav navbar-right nav">
//                <li><a href="/site/#">МИССИЯ</a></li>
//                <li><a href="/site/#">АФИША</a></li>
//                <li><a href="/site/#">О ПРОЕКТЕ</a></li>
//                <li><a href="/site/#">СПИКЕРЫ</a></li>
//                <li><a href="/site/#">КОМАНДА</a></li>
//                <li><a href="/site/#">ОТЗЫВЫ</a></li>
//                <li><a href="/site/#">КОНТАКТЫ</a></li>
//                <li><a href="/site/#"><img class="floatleft ptichka" src="/themes/v01/images/page-1-vk.png" alt=""></a></li>
//            </ul>
//        </div>
