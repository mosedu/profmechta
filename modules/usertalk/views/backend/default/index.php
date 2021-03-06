<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\modules\usertalk\Module;
use app\modules\usertalk\models\Usertalk;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\usertalk\models\UsertalkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('usertalk', 'TITLE_USERTALKS');
$this->params['breadcrumbs'][] = $this->title;

$buttonOptions = [
    'class' => 'btn btn-default',
];

$sJs = <<<EOT
jQuery(".toggleusertalk")
    .on(
        "click",
        function(event) {
            event.preventDefault();
            var oLink = jQuery(this),
                sLink = oLink.attr("href");
            jQuery.post({
                type: "POST",
                url: sLink,
                data: {},
                success: function(data, textStatus, jqXHR ) {
                    console.log("Ok: " + textStatus, data);
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error: " + textStatus, errorThrown);
                },
                dataType: "html"
            });
            return false;
        }
    );
EOT;

$this->registerJs($sJs, View::POS_READY);

?>
<div class="usertalk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- p>
        <?= '' // Html::a(Module::t('usertalk', 'BUTTON_TITLE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'usertalk_id',
            'usertalk_fio',
            'usertalk_email:email',
            'usertalk_text:ntext',
            'usertalk_created',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'usertalk_status',
                'filter' => Usertalk::getAllStatuses(),
                'contentOptions' => [
                    'style' => 'white-space: nowrap;'
                ],
                'content' => function ($model, $key, $index, $column) {
                    return Html::encode($model->status);
                },
            ],
//            'usertalk_status',
            // 'usertalk_created_ip',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {setflag} {delete}', // {delete}
                'buttonOptions' => $buttonOptions,
                'contentOptions' => [
                    'style' => 'white-space: nowrap;',
                ],
                'buttons' => [
                    'setflag' => function ($url, $model, $key) {
                        /** @var Usertalk $model */
                        $aButtondata = [
                            Usertalk::USER_TALK_STATUS_ACTIVE => [
                                'title' => 'Убрать с публикации',
                                'icon' => 'remove',
                            ],
                            Usertalk::USER_TALK_STATUS_VISIBLE => [
                                'title' => 'Опубликовать',
                                'icon' => 'ok',
                            ],
                        ];

//                        $aStatus = Usertalk::getStatuses();
                        $aOut = [];

//                        foreach($aButtondata As $k => $v) {
//                            if( $model->ask_flag == $k ) {
//                                continue;
//                            }
                        $sKey = Usertalk::USER_TALK_STATUS_VISIBLE;
                        if( $model->usertalk_status != Usertalk::USER_TALK_STATUS_ACTIVE ) {
                            $sKey = Usertalk::USER_TALK_STATUS_ACTIVE;
                        }
                        $v = $aButtondata[$sKey];
                        $options = [
                            'title' => $v['title'],
                            'aria-label' => $v['title'],
                            'data-confirm' => 'Вы уверены, что хотите данное сообщение ' . $v['title'],
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => 'toggleusertalk btn btn-default',
                        ];
                        $aOut[] = Html::a('<span class="glyphicon glyphicon-'.$v['icon'].'"></span>', $url . '?flag=' . $sKey, $options);
//                        }
                        return implode(' ', $aOut);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
