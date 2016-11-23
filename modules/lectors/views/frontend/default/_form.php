<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lector-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lec_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_active')->textInput() ?>

    <?= $form->field($model, 'lec_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_fam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lec_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_created')->textInput() ?>

    <?= $form->field($model, 'lec_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
