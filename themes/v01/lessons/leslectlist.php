<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\ListView;
use app\modules\lessons\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lessons\models\LeslectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('lesson', 'TITLE_AFISHA');
$this->params['breadcrumbs'][] = $this->title;

$oView = $this;

?>
<div class="leslect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}<div class="clearfix"></div>{pager}',
//            'filterModel' => $searchModel,
            'itemView' => function ($model, $key, $index, $widget) use ($oView) {
                return '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">' . $oView->render(
                    '//lessons/one-lesson-large',
                    [
                        'bTopBlock' => false,
                        'nearestLesson' => $model,
                    ]
                )
                    . '</div>';
                // '//lessons/one-lesson-large'
            },

        ])
    ?>
    <!-- p>
        <?= '' // Html::a(Yii::t('lesson', 'Create Leslect'), ['create'], ['class' => 'btn btn-success']) ?>
    </p -->
    <?= '' /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'll_id',
            'll_lesson_id',
            'll_lector_id',
            'll_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */ ?>
</div>
