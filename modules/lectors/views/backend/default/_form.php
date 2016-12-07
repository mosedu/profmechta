<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\lectors\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lector-form">

    <?php $form = ActiveForm::begin([
        'id' => 'lector-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
//        'layout' => 'horizontal',
        'options'=>[
            'enctype'=>'multipart/form-data'
        ],
//        'fieldConfig' => [
////                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
//            'horizontalCssClasses' => [
//                'label' => 'col-sm-3',
//                'offset' => 'col-sm-offset-3',
//                'wrapper' => 'col-sm-9',
////                    'error' => '',
//                'hint' => 'col-sm-9 col-sm-offset-3',
//            ],
//        ],
    ]); ?>

    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'lec_fam')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'lec_profession')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'lec_description')->textarea(['rows' => 4]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <?php
                        $sf = $model->getOriginalImageFileName('base', '');
                        if( file_exists($sf) ) {
                            echo Html::img(substr($sf, strlen($_SERVER['DOCUMENT_ROOT'])), ['style' => 'width: 100%;']);
                        }
                    ?>

                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'image')->fileInput() ?>
                </div>
            </div>
        </div>
    </div>
    <?= '' // $form->field($model, 'lec_group')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'lec_active')->textInput() ?>

    <?= '' // $form->field($model, 'lec_email')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'lec_pass')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'lec_created')->textInput() ?>

    <?= '' // $form->field($model, 'lec_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('lector', 'BUTTON_CREATE') : Module::t('lector', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
