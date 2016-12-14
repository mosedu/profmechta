<?php

use evgeniyrru\yii2slick\Slick;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use app\modules\talks\models\ReplySearch;

// block-reply
/* @var $this yii\web\View */
/* @var $nearestLesson app\modules\lessons\models\Lesson */

$aReplyArray = ReplySearch::searchSome(4);
$aSpeaker = ArrayHelper::map(
    $aReplyArray,
    'reply_id',
    function($ob) {
        /** @var app\modules\talks\models\Reply $ob */
        return [
            'name' => $ob->reply_fio,
            'text' => $ob->reply_text,
            'src' => $ob->getImage('base'),
        ];
    }
);

$aReply = [];
foreach($aSpeaker As $data) {
    $aReply[] = $this->render(
        'one_reply',
        [
            'aData' => $data,
        ]
    );
}

if( count($aReply) > 0 ) {
?>

<a name="<?= isset($name) ? $name : mt_rand(1000, 10000) ?>"></a>
<div class="index-speaker">
    <?= $this->render('block_title_green_margin', ['title' => 'ОТЗЫВЫ']) ?>

    <div class="row">
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-0 col-xs-1 col-xs-offset-0">
                    <div class="prev-reply">&lt;</div>
                </div>
                <?= Slick::widget([

                    // HTML tag for container. Div is default.
                    'itemContainer' => 'div',

                    // HTML attributes for widget container
                    'containerOptions' => ['class' => 'reply-slider col-md-10 col-sm-10 col-xs-10'],

                    // Items for carousel. Empty array not allowed, exception will be throw, if empty
                    'items' => $aReply,

                    // HTML attribute for every carousel item
                    'itemOptions' => ['class' => 'one-lector'],

                    // settings for js plugin
                    // @see http://kenwheeler.github.io/slick/#settings
                    'clientOptions' => [
//            'autoplay' => true,
//                        'prevArrow' => '<div class="slick-prev slick-arrow"><a>&lt;</a></div>',
//                        'nextArrow' => '<div class="slick-next slick-arrow"><a>&gt;</a></div>',
                        'prevArrow' => '.prev-reply',
                        'nextArrow' => '.next-reply',
                        'dots' => true,
                        'infinite' => true,
                        'slidesToShow' => 1,
                        'slidesToScroll' => 1,
                        // note, that for params passing function you should use JsExpression object
                        'onAfterChange' => new JsExpression('function() {console.log("The speaker has shown")}'),
                    ],

                ])

                ?>
                <div class="col-md-1 col-sm-1 col-xs-1">
                    <div class="next-reply">&gt;</div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
}
