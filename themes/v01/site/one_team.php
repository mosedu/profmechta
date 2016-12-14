<?php

use yii\helpers\Html;
use app\modules\lectors\models\Lector;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/** @var $model app\modules\lectors\models\Lesson */
/** @var $aPerson array */

//echo nl2br(print_r($aPerson, true));
//return;

?>

<div class="col-sm-4" style="text-align: center; padding-right: 24px; padding-left: 24px;">
    <p style="width: 180px; height: 180px; border: 4px solid #ffffff; border-radius: 90px; background-color: #eeeeee; display: inline-block; overflow: hidden;">
        <img src="<?= $aPerson['src'] ?>" style="width: 100%;" />
    </p>

    <h1 style="font-size: 15px; font-weight: bold;"><?= Html::encode($aPerson['name']) ?></h1>
    <p style="font-size: 15px;"><?= Html::encode($aPerson['prof']) ?></p>
</div>
