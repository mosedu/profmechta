<?php

use yii\helpers\Html;
use app\modules\lessons\Module;
use app\modules\lessons\models\Lesson;


/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */

$this->title = Module::t('lesson', 'TITLE_CREATE_DATE');
if( $model->ll_lesson_id != 0 ) {
    /** @var Lesson $oLesson */
    $oLesson = $model->lesson;
    $this->params['breadcrumbs'][] = ['label' => Module::t('lesson', 'TITLE_LESSONS'), 'url' => ['default/index']];
    $this->params['breadcrumbs'][] = ['label' => $oLesson->les_title, 'url' => ['default/view', 'id' => $model->ll_lesson_id]];
}
else {
    $this->params['breadcrumbs'][] = ['label' => Module::t('lesson', 'TITLE_DATES'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="leslect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
