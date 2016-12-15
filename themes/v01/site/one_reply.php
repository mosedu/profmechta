<?php

use yii\helpers\Html;
use app\modules\lectors\models\Lector;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/** @var $model app\modules\lectors\models\Lesson */
/** @var $aData array */

?>

<div style="margin-right: 12px; margin-left: 12px;">
    <?php
/*
    <p style="width: 112px; height: 112px; border: 4px solid #4ecc66; border-radius: 56px; background-color: #eeeeee; float: left; overflow: hidden;">
        <?php
        if( isset($aData['src']) ) {
        ?>
        <img src="<?= $aData['src'] ?>" style="width: 100%;">
        <?php
        }
        ?>
    </p>
*/    ?>
<!--    <div style="padding-left: 180px;">-->
        <p style="font-size: 14px; font-weight: normal; font-style: italic; color: #444444;"><?= nl2br(Html::encode($aData['text'])) ?></p>
        <p style="font-size: 14px; font-weight: bold; font-style: italic;"><?= Html::encode($aData['name']) ?></p>
<!--    </div>-->
</div>
