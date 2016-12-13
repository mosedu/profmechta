<?php
/**
 * lessons-filter
 *
 * @var app\modules\lessons\models\LeslectSearch $model
 *
 */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use app\modules\lectors\models\Lector;
use app\modules\lessons\models\LeslectSearch;

?>
<div class="row lesson-search" style="padding-top: 12px;">
    <?php $form = ActiveForm::begin([
        'id' => 'lesson-filter-form',
//    'action' => ['index'],
        'method' => 'post',
        'fieldConfig' => [
            'template' => '{input}',
        ],
]);

    $sFioId = Html::getInputId($model, 'lectorfio');
    $sFio = empty($model->lectorfio) ? 'Все спикеры' : Lector::findOne($model->lectorfio)->lec_fam;

    $url = Url::toRoute('//lectors/default/list');

    $resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items,
        pagination: {
            more: (params.page * 3) < data.total_count
        }
    };
}
JS;
//    echo $sFio . ' + ' . $model->lectorfio;
    $sInitVal = empty($model->lectorfio) ? 0 : $model->lectorfio;
    $initScript = <<<EOT
function (element, callback) {
    var search = {$sInitVal},
        stackTrace = function() {
            var err = new Error();
            return err.stack;
        };
//    console.log('search = ', search, element);
//    console.log('callback = ', callback);
//    console.log(stackTrace());

//    if (search != null) {
//        \$.ajax("{$url}?search=" + search, {
//            dataType: "json"
//        }).done(function(data) {
//            callback(data.results[0]);
            callback({id: {$sInitVal}, lec_fam: "{$sFio}"});
//        });
//    }
}
EOT;

    $aLectorConf = [
//        'data' => ['id' => $model->lectorfio, 'lec_fam' => $sFio], // Html::encode($sFio), // set the initial display text
//        'initValueText' => $sFio,
        'theme' => Select2::THEME_BOOTSTRAP,
        'language' => 'ru',
        'options' => [
            'placeholder' => $sFio, // 'Все спикеры',
            'multiple' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0,
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return params; /* {q:params.term};*/ }'),
                'processResults' => new JsExpression($resultsJs),
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(city) { return city.lec_fam; }'), // console.log("templateResult: ");
            'templateSelection' => new JsExpression('function (city) { return city.text || city.lec_fam; }'), // console.log("templateSelection: ", city);
            'initSelection' => new JsExpression($initScript),
        ],
        'pluginEvents' => [
            "select2:select" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
            "select2:unselect" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
        ],
    ];

    $aProfConf = [
        'theme' => Select2::THEME_BOOTSTRAP,
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Все темы',
            'multiple' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => Lector::getLectorProf(),
//            'minimumResultsForSearch' => new JsExpression('Infinity'),
        ],
        'pluginEvents' => [
            "select2:select" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
            "select2:unselect" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
        ],
    ];

    $aYearConf = [
        'data' => $model->getLessonYears(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'language' => 'ru',
        'pluginOptions' => [
            'minimumResultsForSearch' => new JsExpression('Infinity'),
        ],
        'pluginEvents' => [
            "select2:select" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
            "select2:unselect" => "function(event) { jQuery('#".$form->id."').submit(); }", // console.log('select', event); console.log( jQuery('#{$sFioId}').val());
        ],
    ];

    ?>

    <div class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1" style="text-align: left;">
        <?= $form->field($model, 'lectorfio')->widget(Select2::classname(), $aLectorConf); ?>
    </div>

    <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-4  col-sm-offset-0 col-xs-10 col-xs-offset-1" style="text-align: left;">
        <?= $form->field($model, 'lectorprof')->widget(Select2::classname(), $aProfConf) ?>
    </div>

    <div class="col-lg-2 col-lg-offset-0 col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="text-align: left;">
        <?= $form->field($model, 'year')->widget(Select2::classname(), $aYearConf); ?>
    </div>


<?php ActiveForm::end(); ?>

</div>
