<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */

$this->title = Yii::t('lesson', 'Update {modelClass}: ', [
    'modelClass' => 'Lesson',
]) . $model->les_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->les_id, 'url' => ['view', 'id' => $model->les_id]];
$this->params['breadcrumbs'][] = Yii::t('lesson', 'Update');
?>
<div class="lesson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
