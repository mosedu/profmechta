<?php

use yii\helpers\Html;
use app\modules\subscribe\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */

$this->title = Module::t('subscribe', 'TITLE_UPDATE' /*'Update {modelClass}: ', [
    'modelClass' => 'Subscribe',
] */); //  . $model->subscr_id;
$this->params['breadcrumbs'][] = ['label' => Module::t('subscribe', 'TITLE_SUBSCRIBERS'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->subscr_email, 'url' => ['view', 'id' => $model->subscr_id]];
$this->params['breadcrumbs'][] = $this->title; // Module::t('subscribe', 'TITLE_UPDATE');
?>
<div class="subscribe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
