<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\SubscribeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'subscr_id') ?>

    <?= $form->field($model, 'subscr_email') ?>

    <?= $form->field($model, 'subscr_status') ?>

    <?= $form->field($model, 'subscr_created_ip') ?>

    <?= $form->field($model, 'subscr_created') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lesson', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('lesson', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
