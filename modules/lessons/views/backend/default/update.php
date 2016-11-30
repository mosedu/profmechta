<?php

use yii\helpers\Html;
use app\modules\lessons\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */

$this->title = Module::t('lesson', 'TITLE_UPDATE'); // , ['modelClass' => 'Lesson',]  // . $model->les_id
$this->params['breadcrumbs'][] = ['label' => Module::t('lesson', 'TITLE_LESSONS'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->les_id, 'url' => ['view', 'id' => $model->les_id]];
$this->params['breadcrumbs'][] = Module::t('lesson', 'Update');
?>
<div class="lesson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
