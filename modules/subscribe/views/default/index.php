<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\subscribe\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lesson', 'Subscribes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lesson', 'Create Subscribe'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subscr_id',
            'subscr_email:email',
            'subscr_status',
            'subscr_created_ip',
            'subscr_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
