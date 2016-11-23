<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */

$this->title = 'Update Lector: ' . $model->lec_id;
$this->params['breadcrumbs'][] = ['label' => 'Lectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lec_id, 'url' => ['view', 'id' => $model->lec_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
