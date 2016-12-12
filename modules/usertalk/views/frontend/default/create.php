<?php

use yii\helpers\Html;
use app\modules\usertalk\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\usertalk\models\Usertalk */

$this->title = Module::t('usertalk', 'TITLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('usertalk', 'TITLE_USERTALKS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertalk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
