<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subscr_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscr_status')->textInput() ?>

    <?= $form->field($model, 'subscr_created_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscr_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('lesson', 'Create') : Yii::t('lesson', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
