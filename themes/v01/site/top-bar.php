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
                    'class' => 'floatleft hidden-sm',
                ]
            )
            . ' '
            . Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-ptichka.png'),
                [
                    'alt' => Yii::$app->name,
                    'class' => 'floatleft ptichka hidden-sm',
                ]
            )
//            . Html::encode('Профессия мечты'),
            . Html::tag('span', Html::encode('Профессия мечты'), ['class' => 'hidden-md hidden-sm']), // Yii::$app->name, 'class' => ' hidden-sm hidden-xs',
//            . Html::tag('div', Html::encode('Профессия мечты'), ['class' => 'floatleft']), // Yii::$app->name, 'class' => ' hidden-sm hidden-xs',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-white navbar-fixed-top', //  navbar-transparent
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'МИССИЯ', 'url' => ['#mission-block']],
            ['label' => 'АФИША', 'url' => ['#afisha-block']],
            ['label' => 'О ПРОЕКТЕ', 'url' => ['#about-block']],
            ['label' => 'СПИКЕРЫ', 'url' => ['#speaker-block']],
            ['label' => 'КОМАНДА', 'url' => ['#team-block']],
            ['label' => 'ОТЗЫВЫ', 'url' => ['#reply-block']],
            ['label' => 'КОНТАКТЫ', 'url' => ['#adress-block']],
            ['label' => Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-vk.png'),
                [
                    'alt' => '',
                    'class' => 'floatleft ptichka hidden-lg hidden-md hidden-sm hidden-xs',
                ]
            ), 'url' => ['#'], 'encode' => false],
        ],
    ]);
    NavBar::end();
