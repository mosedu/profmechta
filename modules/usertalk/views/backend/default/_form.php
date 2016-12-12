<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\usertalk\Module;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\usertalk\models\Usertalk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usertalk-form">

    <?php $form = ActiveForm::begin([
        'id' => 'usertalk-form',
//        'action' => Url::to('usertalk/default/create'),
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
        'options'=>[
            'enctype'=>'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => "{input}\n{error}",
        ],

    ]); ?>

    <?= $form->field($model, 'usertalk_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usertalk_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usertalk_text')->textarea(['rows' => 6]) ?>

    <?= '' // $form->field($model, 'usertalk_status')->textInput() ?>

    <?= '' // $form->field($model, 'usertalk_created_ip')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'usertalk_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('usertalk', 'BUTTON_CREATE') : Module::t('usertalk', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
