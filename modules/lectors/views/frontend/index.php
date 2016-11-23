<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lectors\models\LectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lectors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lector-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lector', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lec_id',
            'lec_group',
            'lec_active',
            'lec_email:email',
            'lec_fam',
            // 'lec_profession',
            // 'lec_description:ntext',
            // 'lec_pass',
            // 'lec_created',
            // 'lec_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
