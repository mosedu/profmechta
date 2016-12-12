<?php

use yii\helpers\Html;
use app\modules\usertalk\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\usertalk\models\Usertalk */

//$this->title = Yii::t('lesson', 'Update {modelClass}: ', [
//    'modelClass' => 'Usertalk',
//]) . $model->usertalk_id;
$this->title = Module::t('usertalk', 'TITLE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('usertalk', 'TITLE_USERTALKS'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->usertalk_id, 'url' => ['view', 'id' => $model->usertalk_id]];
$this->params['breadcrumbs'][] = Module::t('usertalk', 'TITLE_UPDATE');
?>
<div class="usertalk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
