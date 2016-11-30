<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lessons\models\LeslectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lesson', 'Leslects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leslect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lesson', 'Create Leslect'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
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
    ]); ?>
</div>
