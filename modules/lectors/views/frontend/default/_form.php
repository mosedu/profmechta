<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\lectors\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lector-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= '' // $form->field($model, 'lec_group')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'lec_active')->textInput() ?>

    <?= '' // $form->field($model, 'lec_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_fam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lec_description')->textarea(['rows' => 6]) ?>

    <?= '' // $form->field($model, 'lec_pass')->textInput(['maxlength' => true]) ?>

    <?= '' // $form->field($model, 'lec_created')->textInput() ?>

    <?= '' // $form->field($model, 'lec_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('lector', 'BUTTON_CREATE') : Module::t('lector', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
