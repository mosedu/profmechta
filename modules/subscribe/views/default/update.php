<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */

$this->title = Yii::t('lesson', 'Update {modelClass}: ', [
    'modelClass' => 'Subscribe',
]) . $model->subscr_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subscr_id, 'url' => ['view', 'id' => $model->subscr_id]];
$this->params['breadcrumbs'][] = Yii::t('lesson', 'Update');
?>
<div class="subscribe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
