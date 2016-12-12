<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\subscribe\models\Subscribe */

$this->title = Yii::t('lesson', 'Create Subscribe');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
