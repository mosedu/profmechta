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
                    'title' => Yii::$app->name,
                ]
            )
            . ' '
            . Html::img(
                Yii::getAlias($this->theme->baseUrl . '/images/page-1-ptichka-blue.png'), // page-1-ptichka.png
                [
                    'alt' => Yii::$app->name,
                    'class' => 'floatleft ptichka hidden-sm',
                    'title' => Yii::$app->name,
                ]
            )
//            . Html::encode('Профессия мечты'),
            . Html::tag('span', Html::encode('Профессия мечты'), ['class' => 'hidden-md hidden-sm project-name']), // Yii::$app->name, 'class' => ' hidden-sm hidden-xs',
//            . Html::tag('div', Html::encode('Профессия мечты'), ['class' => 'floatleft']), // Yii::$app->name, 'class' => ' hidden-sm hidden-xs',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-white navbar-fixed-top', //  navbar-transparent
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'МИССИЯ', 'url' => '/#mission-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
            ['label' => 'АФИША', 'url' => '/#afisha-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
            ['label' => 'О ПРОЕКТЕ', 'url' => '/#about-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
            ['label' => 'СПИКЕРЫ', 'url' => '/#speaker-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
//            ['label' => 'КОМАНДА', 'url' => '/#team-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
            ['label' => 'ОТЗЫВЫ', 'url' => '/#reply-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
            ['label' => 'КОНТАКТЫ', 'url' => '/#adress-block', 'linkOptions' => ['class' => 'prettyscroll', ], ],
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
