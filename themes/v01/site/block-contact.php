<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use app\modules\usertalk\models\Usertalk;

// block-contact
/* @var $this yii\web\View */
/* @var $model app\modules\main\models\ContactForm */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

$aLabels = $model->attributeLabels();
?>

<div class="index-contact">
    <h3 id="messagetitle">Поделись с нами своей мечтой</h3>
    <h3 id="okmessagesend" style="display: none;">Спасибо за Ваше сообщение.</h3>


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
                <div class="col-sm-12"><?= $form->field($model, 'usertalk_text', ['options' => ['style' => "position: relative;", 'id' =>"idtextareablock", ]])->textarea(['rows' => 5, 'placeholder' => 'Введите свой текст', ]) ?></div>
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

$sTextId = Html::getInputId($model, 'usertalk_text');
$nMaxLength = Usertalk::USER_TALK_MAX_TEXT_LENGTH;
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
//    console.log("afterValidate()", event);
//    console.log(messages);
//    console.log(hasErrors(messages) ? 'error+' : 'error-');
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

var oTextArea = jQuery("#{$sTextId}"),
    oAbsTextBlock = jQuery("#idtextareablock"),
    oPos = oTextArea.position(),
    oSize = {w: oTextArea.width(), h: oTextArea.height()},
    oNewBlockSize = {w: 80, h: 20},
    oNewBlock = jQuery('<div style="position: absolute; text-align: right; padding: 3px; font-size: 16px; width: '+oNewBlockSize.w+'px; background-color: #ffffff;"></div>'); // left: '+(oPos.left + oSize.w - oNewBlockSize.w)+'px; top: '+(oPos.top + oSize.h - oNewBlockSize.h)+'px;
    oNewBlock.appendTo(oAbsTextBlock),
    fMoveDopArea = function() {
        var oTextAreaSize = {w: oTextArea.width(), h: oTextArea.height()},
            oTextAreaPos = oTextArea.position(),
            oAbsTextBlockSize = {w: oAbsTextBlock.width(), h: oAbsTextBlock.height()},
            oDopAreaSize = {w: oNewBlock.width(), h: oNewBlock.height()};
//        console.log("oTextAreaSize = ", oTextAreaSize);
//        console.log("oTextAreaPos = ", oTextAreaPos);
//        console.log("oAbsTextBlockSize = ", oAbsTextBlockSize);
//        console.log("oDopAreaSize = ", oDopAreaSize);
        oNewBlock.css({
            top: (oTextAreaPos.top + oTextAreaSize.h - oDopAreaSize.h + parseInt(oTextArea.css("padding-top")) + parseInt(oTextArea.css("padding-bottom")) - parseInt(oNewBlock.css("padding-top")) - parseInt(oNewBlock.css("padding-bottom"))) + "px",
            left: (oTextAreaPos.left + oTextAreaSize.w - oDopAreaSize.w + parseInt(oTextArea.css("padding-left")) + parseInt(oTextArea.css("padding-right")) - parseInt(oNewBlock.css("padding-left")) - parseInt(oNewBlock.css("padding-right")) - 1) + "px"}
        );
//        oNewBlock.css({top: (oAbsTextBlockSize.h - oDopAreaSize.h - parseInt(oNewBlock.css("padding-top")) - parseInt(oNewBlock.css("padding-bottom")) - 2) + "px", left: (oAbsTextBlockSize.w - oDopAreaSize.w - parseInt(oNewBlock.css("padding-left")) - parseInt(oNewBlock.css("padding-right")) - 2) + "px"});
//        oNewBlock.css({bottom: "2px", right: "2px"});
    },
    fTestTextLength = function() {
        var sText = oTextArea.val(),
            curLength = sText.length,
            nMaxLength = {$nMaxLength};

        console.log("sText: " + sText);
        if( curLength > nMaxLength ) {
            sText = sText.substr(0, {$nMaxLength});
            curLength = {$nMaxLength};
            oTextArea.val(sText);
        }
        oNewBlock.text(curLength + " / " + nMaxLength).css("color", curLength < nMaxLength ? "#00cc00" : "#ff0000");
    };
    // setTimeout(function() { fMoveDopArea(); }, 5000);

    fTestTextLength();
    fMoveDopArea();
    jQuery(window).on("resize", function(event){fMoveDopArea();});
    oTextArea.on("keyup", function(event){ fTestTextLength(); });
    oTextArea.on( "blur", function(event){ fTestTextLength(); })

EOT;

$this->registerJs($sJs, View::POS_READY, 'submit_user_form');

