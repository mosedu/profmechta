<?php

use yii\helpers\Html;
use app\modules\subscribe\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */

$this->title = Module::t('subscribe', 'TITLE_CREATE');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
