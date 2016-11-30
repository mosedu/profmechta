<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */

$this->title = $model->ll_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Leslects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leslect-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lesson', 'Update'), ['update', 'id' => $model->ll_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lesson', 'Delete'), ['delete', 'id' => $model->ll_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lesson', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'll_id',
            'll_lesson_id',
            'll_lector_id',
            'll_date',
        ],
    ]) ?>

</div>
