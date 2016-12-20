<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\lectors\models\Lector;
use app\modules\lessons\models\Lesson;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */

//$this->title = $model->les_id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Lessons'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

if( !isset($isajax) ) {
    $isajax = false;
}

/** @var Lesson $lesson */
$lesson = $model->lesson;
/** @var Lector $lector */
$lector = $model->lector;

$sImg = $lector->getImage('base');

?>
<div class="lesson-view">

    <?php
    /*
        if( !$isajax ) {
    ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lesson', 'Update'), ['update', 'id' => $model->les_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lesson', 'Delete'), ['delete', 'id' => $model->les_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lesson', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        }
*/
    ?>

    <?= '' /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'les_id',
            'les_active',
            'les_title',
            'les_description:ntext',
            'les_created',
        ],
    ]) */
    ?>
    <div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <?= empty($sImg) ?
                    '' :
                    Html::img($sImg, ['alt' => $lector->lec_fam, 'width' => '100%', ])
                ?>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                <h3><?= date('Дата: d.m.Y', strtotime($model->ll_date)) ?><br />
                    <?= date('Время: H:i', strtotime($model->ll_date)) ?></h3>
                <!-- p><strong><?= date('d.m.Y H:i', strtotime($model->ll_date)) ?></strong></p -->
                <p><?= Html::encode($lesson->les_description) ?></p>
                <h3>Лектор:</h3>
                <p><?= Html::encode($lector->lec_fam) ?></p>
                <p><?= Html::encode($lector->lec_profession) ?></p>
                <p><?= empty($model->ll_reglink) ? '' : Html::a('Страница регистрации', $model->ll_reglink, ['class' => 'btn btn-success', 'target' => 'blank',]) ?></p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

</div>
