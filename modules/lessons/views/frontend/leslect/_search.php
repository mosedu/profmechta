<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\LeslectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leslect-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'll_id') ?>

    <?= $form->field($model, 'll_lesson_id') ?>

    <?= $form->field($model, 'll_lector_id') ?>

    <?= $form->field($model, 'll_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lesson', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('lesson', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
