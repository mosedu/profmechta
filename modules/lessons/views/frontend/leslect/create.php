<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */

$this->title = Yii::t('lesson', 'Create Leslect');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lesson', 'Leslects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leslect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
