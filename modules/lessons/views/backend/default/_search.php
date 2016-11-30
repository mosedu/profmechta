<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\LessonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'les_id') ?>

    <?= $form->field($model, 'les_active') ?>

    <?= $form->field($model, 'les_title') ?>

    <?= $form->field($model, 'les_description') ?>

    <?= $form->field($model, 'les_created') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lesson', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('lesson', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
