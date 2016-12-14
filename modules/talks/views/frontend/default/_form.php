<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\talks\Module;
use app\modules\talks\models\Reply;

/* @var $this yii\web\View */
/* @var $model app\modules\talks\models\Reply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-form">

    <?php $form = ActiveForm::begin([
        'id' => 'reply-form',
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
//        'fieldConfig' => [
//            'template' => "{input}\n{error}",
//        ],
    ]); ?>

    <?= '' // $form->field($model, 'reply_created')->textInput() ?>

    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'reply_fio')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'reply_status')->dropDownList(Reply::getAllStatuses()) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'reply_text')->textarea(['rows' => 4]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    $sf = $model->generateImageFileUrl('base');
                    if( !empty($sf) ) {
                        echo Html::img($sf, ['style' => 'width: 100%;']);
                    }
                    ?>

                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'image')->fileInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Module::t('talks', $model->isNewRecord ? 'BUTTON_CREATE' : 'BUTTON_SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
