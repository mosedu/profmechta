<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\subscribe\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subscr_email')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'subscr_status')->textInput() ?>

    <?= '' // $form->field($model, 'subscr_created_ip')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'subscr_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('subscribe', 'BUTTON_CREATE') : Module::t('subscribe', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
