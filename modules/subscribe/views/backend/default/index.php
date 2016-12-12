<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\subscribe\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\subscribe\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('subscribe', 'TITLE_SUBSCRIBERS');
$this->params['breadcrumbs'][] = $this->title;

$buttonOptions = [
    'class' => 'btn btn-default',
    'style' => 'white-space: nowrap;',
];

?>
<div class="subscribe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('subscribe', 'BUTTON_TITLE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'subscr_id',
            'subscr_email:email',
//            'subscr_status',
//            'subscr_created_ip',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'subscr_created',
                'filter' => false,
//                'filter' => Lesson::getAllStatuses(),
                'contentOptions' => [
                    'style' => 'white-space: nowrap;'
                ],
                'content' => function ($model, $key, $index, $column) {
                    return date('d.m.Y H:i:s', strtotime($model->subscr_created)) . '<br />' . long2ip($model->subscr_created_ip);
                },
            ],

//            'subscr_created',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttonOptions' => $buttonOptions,
            ],
        ],
    ]); ?>
</div>
