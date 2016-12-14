<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\talks\Module;
use app\modules\talks\models\Reply;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\talks\models\ReplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Module::t('talks', 'TITLE_REPLIES');
$this->params['breadcrumbs'][] = $this->title;

$buttonOptions = [
    'class' => 'btn btn-default',
];

?>
<div class="reply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('talks', 'BUTTON_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'reply_id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'reply_fio',
//                'filter' => Reply::getAllStatuses(),
//                'filter' => Lesson::getAllStatuses(),
//                'contentOptions' => [
//                    'style' => 'white-space: nowrap;'
//                ],
                'content' => function ($model, $key, $index, $column) {
                    /** @var Reply $model */
                    $sImg =  $model->generateImageFileUrl('base');
                    if( !empty($sImg) ) {
                        $sImg = Html::img($sImg, ['style' => 'width: 100%;']);
                        $sImg =  Html::tag('div', $sImg, ['style' => 'width: 150px;']);
                    }
                    return $sImg
                        . Html::encode($model->reply_fio);
                },
            ],

            'reply_text:ntext',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'reply_status',
                'filter' => Reply::getAllStatuses(),
//                'filter' => Lesson::getAllStatuses(),
                'contentOptions' => [
                    'style' => 'white-space: nowrap;'
                ],
                'content' => function ($model, $key, $index, $column) {
                    /** @var Reply $model */
                    return Html::encode($model->getStatusTitle());
                },
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'reply_created',
                'filter' => false,
//                'filter' => Lesson::getAllStatuses(),
                'contentOptions' => [
                    'style' => 'white-space: nowrap;'
                ],
                'content' => function ($model, $key, $index, $column) {
                    return date('d.m.Y H:i:s', strtotime($model->reply_created));
                },
            ],

//            'reply_created',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}', // {delete}
                'buttonOptions' => $buttonOptions,
                'contentOptions' => [
                    'style' => 'white-space: nowrap;',
                ],
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
