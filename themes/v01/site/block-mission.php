<?php

// block-mission
/* @var $this yii\web\View */

?>

<div class="index-mission">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'МИССИЯ']) ?>

    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-4 col-md-4">
            <?= $this->render(
                'mission-part',
                [
                    'isUp' => true,
                    'imagesrc' => '/themes/v01/images/mission-flag.png',
                    'text' => 'Мы знаем, что выбор профессии порой становится очень сложной задачей, ведь в наше время их так много и выбрать ту, что по душе очень непросто.',
                ]
            ) ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $this->render(
                'mission-part',
                [
                    'isUp' => true,
                    'imagesrc' => '/themes/v01/images/mission-talk.png',
                    'text' => 'На наших лекциях продюсеры, дизайнеры, журналисты и другие профессионалы поделятся с тобой секретами успеха и мастерства.',
                ]
            ) ?>
        </div>
        <div class="col-lg-8 col-lg-offset-2  col-md-8  col-md-offset-2 hidden-sm hidden-xs mission-line">
        </div>
        <div class="col-lg-3  col-md-3"></div>
        <div class="col-lg-4  col-md-4">
        <?= $this->render(
            'mission-part',
            [
                'isUp' => false,
                'imagesrc' => '/themes/v01/images/mission-cloud.png',
                'text' => 'Для того, чтобы помочь тебе определиться, мы создали проект «Профессия мечты».',
            ]
        ) ?>
        </div>
        <div class="col-lg-4 col-md-4">
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

