<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
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

$sJs = <<<EOT
jQuery(".togglelesson")
    .on(
        "click",
        function(event) {
            event.preventDefault();
            var oLink = jQuery(this),
                sLink = oLink.attr("href");
            jQuery.post({
                type: "POST",
                url: sLink,
                data: {},
                success: function(data, textStatus, jqXHR ) {
                    console.log("Ok: " + textStatus, data);
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error: " + textStatus, errorThrown);
                },
                dataType: "html"
            });
            return false;
        }
    );
EOT;

$this->registerJs($sJs, View::POS_READY);

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
                'contentOptions' => [
                    'style' => 'white-space: nowrap;'
                ],
                'content' => function ($model, $key, $index, $column) {
                    $bHidden = $model->isHidden();
                    return Html::encode($model->status)
                        . ' '
                        . Html::a(
                            '<span class="glyphicon glyphicon-'.($bHidden ? 'ok' : 'remove').'"></span>',
                            ['default/toggle', 'id'=>$model->les_id],
                            [
                                'class' => 'togglelesson btn ' . ($bHidden ? 'btn-success' : 'btn-default'),
                                'title' => Module::t('lesson', $bHidden ? 'BUTTON_TITLE_SHOW' : 'BUTTON_TITLE_HIDE'),
                            ]
                        );
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
