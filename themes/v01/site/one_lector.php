<?php

use yii\helpers\Html;
use app\modules\lectors\models\Lector;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/** @var $model app\modules\lectors\models\Lesson */

if( $model !== null ) {
    $sImage = $model->lector->getImage('base');
?>

    <div style="text-align: center; margin-right: 12px; margin-left: 12px;">
        <p style="width: 112px; height: 112px; border: 4px solid #4ecc66; border-radius: 56px; background-color: #eeeeee; display: inline-block; overflow: hidden;"><?=
            empty($sImage) ? $sImage : Html::img($sImage, ['style' => 'width: 100%;', ])
        ?></p>

        <p style="font-size: 15px; font-weight: bold; color: #444444; line-height: 1.4;"><?= Html::encode($model->lector->lec_fam) ?></p>

        <p style="font-size: 15px; font-weight: normal; color: #444444; line-height: 1.4;"><?= Html::encode($model->lector->lec_profession) ?></p>
    </div>

<?php
}
else {
    echo '';
}
