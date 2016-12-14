<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\talks\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\talks\models\Reply */

$this->title = $model->reply_id;
$this->params['breadcrumbs'][] = ['label' => Module::t('talks', 'TITLE_REPLIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('talks', 'BUTTON_UPDATE'), ['update', 'id' => $model->reply_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('talks', 'BUTTON_DELETE'), ['delete', 'id' => $model->reply_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('talks', 'CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reply_id',
            'reply_fio',
            'reply_text:ntext',
            'reply_status',
            'reply_created',
        ],
    ]) ?>

</div>
