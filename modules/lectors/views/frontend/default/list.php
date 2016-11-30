<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use app\modules\lectors\Module;
use yii\widgets\ListView;
use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\lectors\models\LectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('lector', 'TITLE_LECTORS');
$this->params['breadcrumbs'][] = $this->title;

$obView = $this;
?>
<div class="lector-index">
    <?= '' /*
        ListView::widget([
            'layout' => "{items}", // "{summary}\n{items}\n{pager}",
            'itemView' => 'one_lector',
            'itemOptions' => ['class' => "one_lector", ],
            'dataProvider' => $dataProvider,
        ]) */
    ?>

    <?= Slick::widget([

        // HTML tag for container. Div is default.
        'itemContainer' => 'div',

        // HTML attributes for widget container
        'containerOptions' => ['class' => 'lector-slider col-xs-8 col-xs-offset-2'],

        // Items for carousel. Empty array not allowed, exception will be throw, if empty
        'items' => ArrayHelper::map(
            $dataProvider->getModels(),
            'lec_id',
            function($el) use($obView) {
                return $obView->render('one_lector', ['model' => $el,]);
            }
        ),

        // HTML attribute for every carousel item
        'itemOptions' => ['class' => 'one-lector'],

        // settings for js plugin
        // @see http://kenwheeler.github.io/slick/#settings
        'clientOptions' => [
//            'autoplay' => true,
            'prevArrow' => '<div><a>&lt;</a></div>',
            'nextArrow' => '<div><a>&gt;</a></div>',
            'dots'     => false,
            'infinite' => true,
            'slidesToShow' => 4,
            'slidesToScroll' => 1,
            // note, that for params passing function you should use JsExpression object
            'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
        ],

    ])
    ?>


    <!--    <h1>--><?= '' // Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- p>
        <?= '' // Html::a('Create Lector', ['create'], ['class' => 'btn btn-success']) ?>
    </p -->

    <?= '' /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'lec_id',
//            'lec_group',
//            'lec_active',
//            'lec_email:email',
            'lec_fam',
            'lec_profession',
            'lec_description:ntext',
            // 'lec_pass',
            // 'lec_created',
            // 'lec_key',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  */ ?>
</div>
