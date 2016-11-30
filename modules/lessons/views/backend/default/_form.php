<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\lessons\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= '' // $form->field($model, 'les_active')->textInput() ?>

    <?= $form->field($model, 'les_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'les_description')->textarea(['rows' => 3]) ?>

    <?= '' //  $form->field($model, 'les_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('lesson', $model->isNewRecord ? 'BUTTON_CREATE' : 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
