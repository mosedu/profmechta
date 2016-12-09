<?php

// block-about
/* @var $this yii\web\View */

?>

<div class="index-about">
    <a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
    <?= $this->render('block_title_green_margin', ['title' => 'О ПРОЕКТЕ']) ?>

    <div class="row" style="margin: 0 0 48px;">
        <div class="col-sm-6 col-sm-offset-3">
            <h4>
                Цели данного проекта перекликаются  профессионально-ориентационными целями программы воспитания и социализации в рамках ФГОС:
            </h4>
        </div>
    </div>

    <div class="row" style="margin-bottom: 18px;">
        <div class="col-sm-3 col-sm-offset-3 list-ok">
            Формирование у учащихся мотивации к труду, потребности к приобретению потребности;
        </div>
        <div class="col-sm-3 list-ok">
            Приобретение практического опыта, соответствующего интересам и потребностям детей;
        </div>
    </div>

    <div class="row" style="margin-bottom: 18px;">
        <div class="col-sm-3 col-sm-offset-3 list-ok">
            Развитие у учащихся представлений о перспективах профессионального образования и будущей профессиональной деятельности;
        </div>
        <div class="col-sm-3 list-ok">
            Информирование обучающихся об особенностях различных сфер профессиональной деятельности.
        </div>
    </div>

</div>

