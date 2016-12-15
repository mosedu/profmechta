<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

// block-subscribe
/* @var $this yii\web\View */
/* @var $model app\modules\main\models\SubscribeForm */

?>

<div class="index-subscribe">
    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h3 id="oksubscribesend" style="display: none; text-align: center;">О, Вы только что подписались на рассылку!</h3>
            <div class="row">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'subscribe-form',
//                    'action' => Url::to('emailsubscribe'),
                    'action' => Url::to('subscribe/default/newsubscriber'),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'options'=>[
                        'enctype'=>'multipart/form-data'
                    ],
                    'fieldConfig' => [
                        'template' => "{input}\n{error}",
                    ],
                ]);
                //                echo $form->field($model, 'username', ['enableAjaxValidation' => true]);
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Хотите быть в курсе?</h3>
                    <h3 style="margin-bottom: 12px;">Подпишитесь на уведомления о лекциях!</h3>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-10">
<!--                    <input name="email" type="text" placeholder="Введите E-mail">-->
                    <?= '' // $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Введите E-mail', ]) ?>
                    <?= $form->field($model, 'subscr_email')->textInput(['maxlength' => true, 'placeholder' => 'Введите E-mail', ]) ?>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-2">
                    <button class="arrow-button" type="submit" style="border: transparent none 0px; background-color: transparent;">
                        <img src="/themes/v01/images/right-arrow-circle.png">
                    </button>
                </div>
                <?php
                    ActiveForm::end();
                ?>
            </div>
        </div>
    </div>

</div>

<?php

$sJs = <<<EOT
var oSubscribeForm = jQuery('#{$form->options['id']}');

oSubscribeForm
.on('afterValidate', function (event, messages) {
    console.log("afterValidate()", event);
    console.log(messages);
    console.log(hasErrors(messages) ? 'error+' : 'error-');
    if( !hasErrors(messages) ) {
        jQuery("#oksubscribesend").show();
        oSubscribeForm.hide();
    }
})
.on('submit', function (event) {
//    console.log("submit()");
    var formdata = oSubscribeForm.data().yiiActiveForm,
        oRes = jQuery("#formresultarea");

    event.preventDefault();
    if( formdata.validated ) {
        // имитация отправки
        formdata.validated = false;
        formdata.submitting = true;

        // показываем подтверждение
        oRes
            .text("Данные сохранены")
            .fadeIn(800, function(){
                setTimeout(
                    function(){
                        oRes.fadeOut(function(){ window.location.reload(); });
                    },
                    1000
                );
            });
    }
    return false;
});

EOT;

$this->registerJs($sJs, View::POS_READY, 'subscribe_user_form');

