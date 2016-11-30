<?php

use yii\helpers\Html;
use app\modules\lessons\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Lesson */

$this->title = Module::t('lesson', 'TITLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('lesson', 'TITLE_LESSONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
