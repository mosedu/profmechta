<?php

// block-mission
/* @var $this yii\web\View */

?>

<a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
<div class="index-mission">
    <?= $this->render('block_title_green_margin', ['title' => 'МИССИЯ']) ?>

    <div class="row">
<!--        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>-->
        <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <?= $this->render(
                'mission-part',
                [
                    'isUp' => true,
                    'imagesrc' => '/themes/v01/images/mission-flag.png',
                    'text' => 'Мы знаем, что выбор профессии порой становится очень сложной задачей, ведь в наше время их так много и выбрать ту, что по душе очень непросто.',
                ]
            ) ?>
        </div>
        <div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-11 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <?= $this->render(
                'mission-part',
                [
                    'isUp' => true,
                    'imagesrc' => '/themes/v01/images/mission-talk.png',
                    'text' => 'На наших лекциях продюсеры, дизайнеры, журналисты и другие профессионалы поделятся с тобой секретами успеха и мастерства.',
                ]
            ) ?>
        </div>
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 hidden-sm hidden-xs mission-line">
        </div>
<!--        <div class="col-lg-2 col-md-2"></div>-->
        <div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-11 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <?= $this->render(
            'mission-part',
            [
                'isUp' => false,
                'imagesrc' => '/themes/v01/images/mission-cloud.png',
                'text' => 'Для того, чтобы помочь тебе определиться, мы создали проект «Профессия мечты».',
            ]
        ) ?>
        </div>
        <div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-11 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <?= $this->render(
                'mission-part',
                [
                    'isUp' => false,
                    'imagesrc' => '/themes/v01/images/mission-ok.png',
                    'text' => 'Мы надеемся, что проект «Профессия мечты» поможет тебе выбрать самую лучшую в мире профессию и найти работу своей мечты!',
                ]
            ) ?>
        </div>

    </div>
</div>

