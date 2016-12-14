<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\talks\models\ReplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'reply_id') ?>

    <?= $form->field($model, 'reply_fio') ?>

    <?= $form->field($model, 'reply_text') ?>

    <?= $form->field($model, 'reply_status') ?>

    <?= $form->field($model, 'reply_created') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('talks', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('talks', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
