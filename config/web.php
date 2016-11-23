<?php

use yii\helpers\ArrayHelper;

$sfCommon = __DIR__ . DIRECTORY_SEPARATOR . 'common.php';
$sfCommonLocal = __DIR__ . DIRECTORY_SEPARATOR . 'common-local.php';
$sfWebLocal = __DIR__ . DIRECTORY_SEPARATOR . 'web-local.php';


$webconfig = [
    'id' => 'basic-web',
    'language' => 'ru-RU',
    'components' => [
        'request' => [],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'cache' => false,
            'rules' => [
                [
                    'class' => 'yii\web\GroupUrlRule',
                    'prefix' => 'admin',
                    'routePrefix' => 'admin',
                    'rules' => [
                        '' => 'default/index',
                        '<_m:[\w\-]+>' => '<_m>/default/index',
                        '<_m:[\w\-]+>/<id:\d+>' => '<_m>/default/view',
                        '<_m:[\w\-]+>/<id:\d+>/<_a:[\w-]+>' => '<_m>/default/<_a>',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                        '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                    ],
                ],
//                '' => 'main/default/index',
//                'contact' => 'main/contact/index',
//                '<_a:error>' => 'main/default/<_a>',
//                '<_a:(login|logout|signup|email-confirm|password-reset-request|password-reset)>' => 'user/default/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
/* -------------------------------------------------------------------------------- */
//                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
//                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
//                '<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_c>/<_a>',
//                '<_c:[\w\-]+>' => '<_c>/index',
            ],
        ],
    ],
    'modules' => [
        'lectors' => [
            'class' => 'app\modules\lectors\Module',
            'controllerNamespace' => 'app\modules\lectors\controllers\frontend',
            'viewPath' => '@app/modules/lectors/views/frontend',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'modules' => [
                'lectors' => [
                    'class' => 'app\modules\lectors\Module',
                    'controllerNamespace' => 'app\modules\lectors\controllers\backend',
                    'viewPath' => '@app/modules/lectors/views/backend',
                ],
            ]
        ],

    ],
];

$webconfig = ArrayHelper::merge(
    require($sfCommon),
    file_exists($sfCommonLocal) ? require($sfCommonLocal) : [],
    $webconfig,
    file_exists($sfWebLocal) ? require($sfWebLocal) : []
);

return $webconfig;
