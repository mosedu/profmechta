<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\lectors\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lectors\models\LectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('lector', 'TITLE_LECTORS');
$this->params['breadcrumbs'][] = $this->title;
$buttonOptions = [
    'class' => 'btn btn-default',
];

?>
<div class="lector-index">

<!--    <h1>--><?= '' // Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('lector', 'BUTTON_TITLE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'lec_id',
//            'lec_group',
//            'lec_email:email',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'lec_fam',
//                'filter' => false,
                'contentOptions' => [
                    'style' => 'vertical-align: top;',
                ],
                'content' => function ($model, $key, $index, $column) {
                    return Html::encode($model->lec_fam) . "<br />" . '<span style="display: block; font-size: 0.8em; color: #777777;">'.Html::encode($model->lec_profession).'</span>';
                },
//                'contentOptions' => [
//                    'class' => 'griddate',
//                ],
            ],
//            'lec_fam',
//            'lec_profession',
//            'lec_description:ntext',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'lec_description',
                'filter' => false,
                'header' => 'Изображение',
                'contentOptions' => [
                    'style' => 'vertical-align: top;',
                ],
                'content' => function ($model, $key, $index, $column) {
                    $sImg = '';
                    $sf = $model->getImage('base');
                    if( !empty($sf) ) {
                        $sImg = Html::img($sf, ['style' => 'max-width: 120px; float: left; margin: 0 16px 16px 0;']);
                    }
                    return $sImg . Html::encode($model->lec_description); // . '<span style="display: block; font-size: 0.8em; color: #777777;">'.Html::encode($model->lec_profession).'</span>';
                },
//                'contentOptions' => [
//                    'class' => 'griddate',
//                ],
            ],
//            'lec_active',
            // 'lec_pass',
            // 'lec_created',
            // 'lec_key',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => [
                    'style' => 'white-space: nowrap;',
                ],
                'buttonOptions' => $buttonOptions,
            ],
        ],
    ]); ?>
</div>
