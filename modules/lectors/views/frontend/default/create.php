<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */

$this->title = 'Create Lector';
$this->params['breadcrumbs'][] = ['label' => 'Lectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
