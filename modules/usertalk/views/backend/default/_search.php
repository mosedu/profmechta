<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\usertalk\models\UsertalkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usertalk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usertalk_id') ?>

    <?= $form->field($model, 'usertalk_fio') ?>

    <?= $form->field($model, 'usertalk_email') ?>

    <?= $form->field($model, 'usertalk_text') ?>

    <?= $form->field($model, 'usertalk_status') ?>

    <?php // echo $form->field($model, 'usertalk_created_ip') ?>

    <?php // echo $form->field($model, 'usertalk_created') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lesson', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('lesson', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
