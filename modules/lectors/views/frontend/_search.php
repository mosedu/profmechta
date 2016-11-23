<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\LectorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lector-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lec_id') ?>

    <?= $form->field($model, 'lec_group') ?>

    <?= $form->field($model, 'lec_active') ?>

    <?= $form->field($model, 'lec_email') ?>

    <?= $form->field($model, 'lec_fam') ?>

    <?php // echo $form->field($model, 'lec_profession') ?>

    <?php // echo $form->field($model, 'lec_description') ?>

    <?php // echo $form->field($model, 'lec_pass') ?>

    <?php // echo $form->field($model, 'lec_created') ?>

    <?php // echo $form->field($model, 'lec_key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
