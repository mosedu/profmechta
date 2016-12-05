<?php

use yii\helpers\Html;
use app\modules\lectors\models\Lector;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/** @var $model app\modules\lectors\models\Lesson */

if( $model !== null ) {
?>

    <div style="text-align: center; margin-right: 12px; margin-left: 12px;">
        <p style="width: 112px; height: 112px; border: 4px solid #4ecc66; border-radius: 56px; background-color: #eeeeee; display: inline-block;"></p>

        <h1 style="font-size: 16px;"><?= Html::encode($model->lector->lec_fam) ?></h1>

        <p><?= Html::encode($model->lector->lec_profession) ?></p>
    </div>

<?php
}
else {
    echo '';
}
