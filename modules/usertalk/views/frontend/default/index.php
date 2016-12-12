<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\usertalk\models\UsertalkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lesson', 'Usertalks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertalk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lesson', 'Create Usertalk'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usertalk_id',
            'usertalk_fio',
            'usertalk_email:email',
            'usertalk_text:ntext',
            'usertalk_status',
            // 'usertalk_created_ip',
            // 'usertalk_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
