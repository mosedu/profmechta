<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\lectors\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */

$this->title = $model->lec_fam;
$this->params['breadcrumbs'][] = ['label' => Module::t('lector', 'TITLE_LECTORS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lector-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->lec_id], ['class' => 'btn btn-primary']) ?>
        <?= '' /* Html::a('Delete', ['delete', 'id' => $model->lec_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'lec_id',
//            'lec_group',
            'lec_active',
//            'lec_email:email',
            'lec_fam',
            'lec_profession',
            'lec_description:ntext',
//            'lec_pass',
            'lec_created',
//            'lec_key',
        ],
    ]) ?>

</div>
