<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 01.12.2016
 * Time: 14:42
 */

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

    NavBar::begin([
        'brandLabel' => Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-temo.png'),
                [
                    'alt' => Yii::$app->name,
                    'class' => 'floatleft',
                ]
            )
            . ' '
            . Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-ptichka.png'),
                [
                    'alt' => Yii::$app->name,
                    'class' => 'floatleft ptichka',
                ]
            )
            . Html::encode('Профессия мечты'), // Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-transparent', //  navbar-fixed-top
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'МИССИЯ', 'url' => ['#']],
            ['label' => 'АФИША', 'url' => ['#']],
            ['label' => 'О ПРОЕКТЕ', 'url' => ['#']],
            ['label' => 'СПИКЕРЫ', 'url' => ['#']],
            ['label' => 'КОМАНДА', 'url' => ['#']],
            ['label' => 'ОТЗЫВЫ', 'url' => ['#']],
            ['label' => 'КОНТАКТЫ', 'url' => ['#']],
            ['label' => Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-vk.png'),
                [
                    'alt' => '',
                    'class' => 'floatleft ptichka',
                ]
            ), 'url' => ['#'], 'encode' => false],
        ],
    ]);
    NavBar::end();
