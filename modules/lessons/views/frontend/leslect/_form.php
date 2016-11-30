<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leslect-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'll_lesson_id')->textInput() ?>

    <?= $form->field($model, 'll_lector_id')->textInput() ?>

    <?= $form->field($model, 'll_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('lesson', 'Create') : Yii::t('lesson', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
