<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\usertalk\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\usertalk\models\UsertalkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('usertalk', 'TITLE_USERTALKS');
$this->params['breadcrumbs'][] = $this->title;

$buttonOptions = [
    'class' => 'btn btn-default',
];

?>
<div class="usertalk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- p>
        <?= '' // Html::a(Module::t('usertalk', 'BUTTON_TITLE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'usertalk_id',
            'usertalk_fio',
            'usertalk_email:email',
            'usertalk_text:ntext',
            'usertalk_created',
//            'usertalk_status',
            // 'usertalk_created_ip',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}', // {delete}
                'buttonOptions' => $buttonOptions,
                'contentOptions' => [
                    'style' => 'white-space: nowrap;',
                ],
            ],
        ],
    ]); ?>
</div>
