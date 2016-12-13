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
<div class="leslect-frontend-index">
    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}<div class="clearfix"></div>{pager}',
            'emptyText' => Html::tag(
                'div',
                'Не найдено ни одного события.',
                [
                    'class' => 'col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2',
                    'style' => 'text-align: center; font-size: 24px;',
                ]
            ),
            'emptyTextOptions' => [
                'class' => 'row',
            ],
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
</div>
<?php

$this->beginBlock('title-block', false);
?>
<?php
echo $this->render(
    '//lessons/lessons-filter',
    [
        'model' => $searchModel,
    ]
);
?>
<?php
$this->endBlock();
