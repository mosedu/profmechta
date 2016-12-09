<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */

$this->title = $model->les_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if( !isset($isajax) ) {
    $isajax = false;
}

?>
<div class="lesson-view">

    <?php
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
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'les_id',
            'les_active',
            'les_title',
            'les_description:ntext',
            'les_created',
        ],
    ]) ?>

</div>
