<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\lessons\Module;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */
/* @var $searchModel app\modules\lessons\models\LeslectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->les_title;
$this->params['breadcrumbs'][] = ['label' => Module::t('lesson', 'TITLE_LESSONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$buttonOptions = [
    'class' => 'btn btn-default'
];
Url::remember();

?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('lesson', 'BUTTON_TITLE_CREATE_DATE'), ['leslect/create', 'id' => $model->les_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null, // $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'll_id',
//            'll_lesson_id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'll_lector_id',
                'filter' => false,
//                'filter' => ArrayHelper::map(Msgflags::getStateData(), 'fl_id', 'fl_sname'),
//                'filterOptions' => ['class' => 'gridwidth7'],
                'content' => function ($model, $key, $index, $column) {
                    return Html::encode($model->lector->lec_fam) . '<span style="display: block; font-size: 0.8em; color: #777777;">'.Html::encode($model->lector->lec_profession).'</span>';
                },
//                'contentOptions' => [
//                    'class' => 'griddate',
//                ],
            ],
//            'll_lector_id',
            'll_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => $buttonOptions,
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) use($buttonOptions) {
                        $url = Url::to(['leslect/update', 'id' => $model->ll_id]);
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ], $buttonOptions);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) use($buttonOptions) {
                        $url = Url::to(['leslect/delete', 'id' => $model->ll_id]);
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ], $buttonOptions);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>

    <!-- p>
        <?= '' /* Html::a(Yii::t('lesson', 'Update'), ['update', 'id' => $model->les_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lesson', 'Delete'), ['delete', 'id' => $model->les_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lesson', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */ ?>
    </p -->

    <?= '' /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'les_id',
            'les_active',
            'les_title',
            'les_description:ntext',
            'les_created',
        ],
    ]) */ ?>

</div>
