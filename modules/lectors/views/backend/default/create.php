<?php

use yii\helpers\Html;
use app\modules\lectors\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\lectors\models\Lector */

$this->title = Module::t('lector', 'TITLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('lector', 'TITLE_LECTORS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
