<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\lessons\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lessons\models\LessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('lesson', 'TITLE_LESSONS');
$this->params['breadcrumbs'][] = $this->title;
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
            'les_active',
//            'les_created',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [
                    'style' => 'white-space: nowrap;',
                ]
            ],
        ],
    ]); ?>
</div>
