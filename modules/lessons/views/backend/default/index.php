<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\lessons\Module;
use app\modules\lessons\models\Lesson;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lessons\models\LessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('lesson', 'TITLE_LESSONS');
$this->params['breadcrumbs'][] = $this->title;
$buttonOptions = [
    'class' => 'btn btn-default',
    'style' => 'white-space: nowrap;',
];
?>
<div class="lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('lesson', 'BUTTON_TITLE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'les_id',
            'les_title',
            'les_description:ntext',
//            'les_active',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'les_active',
                'filter' => Lesson::getAllStatuses(),
                'content' => function ($model, $key, $index, $column) {
                    return Html::encode($model->status);
                },
            ],

//            'les_created',

            [
                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view}'
                'contentOptions' => $buttonOptions,
                'buttons' => [
                    'view' => function ($url, $model, $key) use($buttonOptions) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ], $buttonOptions);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) use($buttonOptions) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ], $buttonOptions);
                        return ($model->les_active == Lesson::LESSON_STATUS_ACTIVE) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options) : '';
                    },
                    'delete' => function ($url, $model, $key) use($buttonOptions) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ], $buttonOptions);
                        return ($model->les_active == Lesson::LESSON_STATUS_ACTIVE) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options) : '';
                    },

    ],
            ],
        ],
    ]); ?>
</div>
