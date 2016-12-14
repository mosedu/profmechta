<?php

use yii\helpers\Html;
use app\modules\talks\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\talks\models\Reply */

$this->title = Module::t('talks', 'TITLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('talks', 'TITLE_REPLIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
