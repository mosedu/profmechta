<?php

use yii\helpers\Html;
use app\modules\talks\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\talks\models\Reply */

//$this->title = Yii::t('talks', 'Update {modelClass}: ', [
//    'modelClass' => 'Reply',
//]) . $model->reply_id;
$this->title = Module::t('talks', 'TITLE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('talks', 'TITLE_REPLIES'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->reply_fio, 'url' => ['view', 'id' => $model->reply_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
