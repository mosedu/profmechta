<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

// block-contact
/* @var $this yii\web\View */
/* @var $model app\modules\main\models\ContactForm */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

$aLabels = $model->attributeLabels();
?>

<div class="index-contact">
    <h3 id="messagetitle">Поделись с нами своей мечтой</h3>
    <h3 id="okmessagesend" style="display: none;">Спасибо за поделение мечтой!</h3>


    <div class="row">
        <div class="col-md-3 col-sm-1 col-xs-1"></div>
        <div class="col-md-6 col-sm-10 col-xs-10">
            <?php
//                $form = ActiveForm::begin([
//                    'id' => 'contact-form',
//                    'action' => Url::to('contact'),
//                    'enableAjaxValidation' => true,
//                    'enableClientValidation' => false,
//                    'validateOnSubmit' => true,
//                    'validateOnChange' => false,
//                    'validateOnBlur' => false,
//                    'validateOnType' => false,
//                    'options'=>[
//                        'enctype'=>'multipart/form-data'
//                    ],
//                    'fieldConfig' => [
//                        'template' => "{input}\n{error}",
//                    ],
//                ]);
                $form = ActiveForm::begin([
                    'id' => 'usertalk-form',
                    'action' => Url::to('usertalk/default/create'),
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
            <div class="row">
<!--                <div class="col-sm-6"><input name="email" type="text" placeholder="Ф.И.О." style="width: 100%;"></div>-->
                <!-- div class="col-sm-6"><?= '' // $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $aLabels['name'], ]) ?></div -->
                <div class="col-sm-6"><?= $form->field($model, 'usertalk_fio')->textInput(['maxlength' => true, 'placeholder' => $aLabels['usertalk_fio'], ]) ?></div>
<!--                <div class="col-sm-6"><input name="email" type="text" placeholder="E-mail" style="width: 100%;"></div>-->
                <!-- div class="col-sm-6"><?= '' // $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $aLabels['email'], ]) ?></div -->
                <div class="col-sm-6"><?= $form->field($model, 'usertalk_email')->textInput(['maxlength' => true, 'placeholder' => $aLabels['usertalk_email'], ]) ?></div>
            </div>
            <div class="row">
<!--                <div class="col-sm-12"><textarea name="email" placeholder="Введите свой текст" style="width: 100%;" rows="4"></textarea></div>-->
                <!-- div class="col-sm-12"><?= '' // $form->field($model, 'body')->textarea(['rows' => 5, 'placeholder' => 'Введите свой текст', ]) ?></div -->
                <div class="col-sm-12"><?= $form->field($model, 'usertalk_text')->textarea(['rows' => 5, 'placeholder' => 'Введите свой текст', ]) ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4 col-sm-offset-4 col-md-offset-4 col-xs-offset-4" style="text-align: center;">
                    <input type="submit" name="submit" class="btn btn-default subscribe" style="border-color: #ffffff; color: #ffffff; background-color: transparent; " value="Отправить">
                </div>
            </div>
            <?php
                ActiveForm::end();
            ?>
        </div>
    </div>

</div>

<?php

$sJs = <<<EOT
var oContactForm = jQuery('#{$form->options['id']}'),
    hasErrors = function(messages) {
        var hasError = false;
        for(var i in messages) {
            if( messages[i].length > 0 ) {
                hasError = true;
                break;
            }
        }
        return hasError;
    };

oContactForm
.on('beforeSubmit', function(e) {
//   var \$form = $(this);
//   console.log("beforeSubmit()");
})
.on('afterValidate', function (event, messages) {
    console.log("afterValidate()", event);
    console.log(messages);
    console.log(hasErrors(messages) ? 'error+' : 'error-');
    if( !hasErrors(messages) ) {
        jQuery("#messagetitle").hide();
        jQuery("#okmessagesend").show();
        oContactForm.hide();
    }
//    console.log(oContactForm);

//    if( "result" in messages ) {
//    }
})
.on('submit', function (event) {
//    console.log("submit()");
    var formdata = oContactForm.data().yiiActiveForm,
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
//console.log("oContactForm = ", oContactForm);
EOT;

$this->registerJs($sJs, View::POS_READY, 'submit_user_form');

