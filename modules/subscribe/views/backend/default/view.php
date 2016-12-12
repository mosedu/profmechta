<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */

$this->title = $model->subscr_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lesson', 'Update'), ['update', 'id' => $model->subscr_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lesson', 'Delete'), ['delete', 'id' => $model->subscr_id], [
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
            'subscr_id',
            'subscr_email:email',
            'subscr_status',
            'subscr_created_ip',
            'subscr_created',
        ],
    ]) ?>

</div>
