<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */

$this->title = Yii::t('lesson', 'Update {modelClass}: ', [
    'modelClass' => 'Leslect',
]) . $model->ll_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Leslects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ll_id, 'url' => ['view', 'id' => $model->ll_id]];
$this->params['breadcrumbs'][] = Yii::t('lesson', 'Update');
?>
<div class="leslect-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
