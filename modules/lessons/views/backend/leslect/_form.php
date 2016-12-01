<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\lessons\Module;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\modules\lessons\models\Leslect */
/* @var $form yii\widgets\ActiveForm */

if( !empty($model->ll_date) ) {
    $model->ll_date = date('d.m.Y H:i', strtotime($model->ll_date));
}
$aPluginDateOptions = [
    'autoclose' => true,
    'format' => 'dd.mm.yyyy hh:ii',
    'todayHighlight' => true,
    'minuteStep' => 15,
    'weekStart' => 1,
//    'minutesDisabled' => [0, 30],
];

$sObLector = '';
if( !$model->isNewRecord ) {
    $sObLector = [
        'id' => $model->lector->lec_id,
        'text' => $model->lector->lec_fam,
        'profession' => $model->lector->lec_profession,
        'description' => $model->lector->lec_description,
    ];
}

$aPluginLectorOptions = [
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true,
//        'initValueText' => '654654654', // $model->isNewRecord ? '' : $model->lector->lec_fam,
        'initSelection' => new JsExpression('function (element, callback) {
            callback(' . json_encode($sObLector) . ');
//                    if( element.val() > 0 ) {
//                        $.ajax({
//                            method: "POST",
//                            url: "http://hastur.temocenter.ru/task/eo.search/",
//                            dataType: "json",
//                            data: {
//                                filters: {
//                                    eo_id: element.val(),
//                                },
//                                maskarade: {
//                                    eo_id: "id",
//                                    eo_short_name: "text"
//                                },
//                                fields: ["eo_id", "eo_short_name", "eo_district_name_id"].join(";")
//                            },
//                            success: function (data) {
//                                callback(data.list.pop());
//                            }
//                        });
//                    }
                }'),
        'ajax' =>[
            'method' => 'POST',
            'url' => \yii\helpers\Url::to(["/admin/lectors/default/list"]),
            'dataType' => 'json',
            'withCredentials' => true,
            'data' => new JsExpression('function (params) {
                var pagesize = 3;
                console.log("data("+params.term+")", params);
                return {
                    term: params.term,
                    limit: pagesize,
                    start: ("page" in params) ? (params.page - 1) * pagesize : 0,
                    "_": (new Date()).getSeconds()
                };
            }'),

//            'processResults' => new JsExpression('function (data, params) {
//                var pagesize = 3;
//                params.page = params.page || 1;
//                console.log("results() data = ", data , "params = ", params);
//
//                return {
//                    results: data.results,
//                    pagination: {
//                        more: (params.page * pagesize) < parseInt(data.total)
//                    }
//                };
//             }'),
//            'id' => new JsExpression(
//                'function(item){return item.id;}'
//            ),
        ],
//        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (item) { return item.text; }'),
        'templateResult' => new JsExpression(
            'function (item) {
                        if (item.loading) {
                            return item.text;
                        }
                        return item.text + "<span class=\\"description\\" style=\\"display: block; font-size: 0.9em;\\">" + item.profession + "</span>"; //  color: #777777;
                        return formatSelect(item, "text", "district");
/*
                        console.log("formatResult() item = ", item);
                        var markup = \'<div class="row-fluid">\'
                            + item.text
                            + \'<div class="span3"><i class="fa fa-star"></i>\' + item.district + \'</div>\'
                            + \'</div>\';
                        return markup; // item.text;
*/
                    }'
        ),
        'escapeMarkup' => new JsExpression('function (m) { return m; }'),
    ],

//    'pluginEvents' => [
//        'change' => 'function(event) {
//                    var sIdReg = "'.Html::getInputId($model, 'msg_pers_region').'";
//                    jQuery("#'.Html::getInputId($model, 'msg_pers_org').'").val(event.added.text);
//                    jQuery("#"+sIdReg).val(event.added.area_id);
////                    console.log("change", event);
////                    console.log("set " + sIdReg + " = " + event.added.area_id);
//                }',
//    ],

    'options' => [
//                    'multiple' => true,
        'placeholder' => 'Выберите лектора ...',
    ],
];
?>

<div class="leslect-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= '' // $form->field($model, 'll_lesson_id')->textInput() ?>
    <?= $form->field($model, 'll_lesson_id', ['template' => "{input}"])->hiddenInput() ?>
    <div class="row">
        <div class="col-xs-8">
            <?= '' // $form->field($model, 'll_lector_id')->textInput() ?>
            <?= $form->field($model, 'll_lector_id')->widget(
                Select2::className(),
                $aPluginLectorOptions
            ) ?>
        </div>
        <div class="col-xs-4">
            <?= '' // $form->field($model, 'll_date')->textInput() ?>
            <?= $form->field($model, 'll_date')->widget(
                DateTimePicker::classname(),
                [
                    'options' => ['placeholder' => $model->getAttributeLabel('ll_date')],
                    'language' => 'ru',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'pluginOptions' => $aPluginDateOptions,
                ]
            ) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton(Module::t('lesson', $model->isNewRecord ? 'BUTTON_CREATE' : 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
