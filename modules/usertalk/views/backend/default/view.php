<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\usertalk\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\usertalk\models\Usertalk */

$this->title = $model->usertalk_fio . ' ' . $model->usertalk_email . ' ' . date('d.m.Y H:i:s', strtotime($model->usertalk_created));
$this->params['breadcrumbs'][] = ['label' => Module::t('usertalk', 'TITLE_USERTALKS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertalk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- p>
        <?= '' // Html::a(Yii::t('lesson', 'Update'), ['update', 'id' => $model->usertalk_id], ['class' => 'btn btn-primary']) ?>
        <?= '' /* Html::a(Yii::t('lesson', 'Delete'), ['delete', 'id' => $model->usertalk_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lesson', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */ ?>
    </p -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'usertalk_id',
            'usertalk_fio',
            'usertalk_email:email',
            'usertalk_text:ntext',
//            'usertalk_status',
            [
                'attribute' => 'usertalk_created_ip',
                'value' => long2ip($model->usertalk_created_ip),
            ],
            'usertalk_created',
        ],
    ]) ?>

</div>
