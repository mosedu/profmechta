<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'les_active')->textInput() ?>

    <?= $form->field($model, 'les_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'les_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'les_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('lesson', 'Create') : Yii::t('lesson', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
