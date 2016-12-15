<?php

use yii\helpers\ArrayHelper;

$sfCommon = __DIR__ . DIRECTORY_SEPARATOR . 'common.php';
$sfCommonLocal = __DIR__ . DIRECTORY_SEPARATOR . 'common-local.php';
$sfWebLocal = __DIR__ . DIRECTORY_SEPARATOR . 'web-local.php';


$webconfig = [
    'id' => 'basic-web',
    'language' => 'ru-RU',
    'name' => 'Профессия мечты',
    'components' => [
        'request' => [],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
//            'errorAction' => 'error',
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],

        'view' => [
            'theme' => [
                'basePath' => '@app/themes/v01',
                'baseUrl' => '@web/themes/v01',
                'pathMap' => [
                    '@app/views' => '@app/themes/v01',
                ],
            ],
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
                '' => 'main/site/index',
                '<_a:(login|logout|contact|emailsubscribe|about|error)>' => 'main/site/<_a>',
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
        'lessons' => [
            'class' => 'app\modules\lessons\Module',
            'controllerNamespace' => 'app\modules\lessons\controllers\frontend',
            'viewPath' => '@app/modules/lessons/views/frontend',
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
            'layout' => '@app/themes/v01/layouts/pages',
            'viewPath' => '@app/themes/v01',
        ],
        'subscribe' => [
            'class' => 'app\modules\subscribe\Module',
            'controllerNamespace' => 'app\modules\subscribe\controllers\frontend',
            'viewPath' => '@app/modules/subscribe/views/frontend',
        ],
        'usertalk' => [ // обратная связь
            'class' => 'app\modules\usertalk\Module',
            'controllerNamespace' => 'app\modules\usertalk\controllers\frontend',
            'viewPath' => '@app/modules/usertalk/views/frontend',
        ],
        'talks' => [ // отзывы
            'class' => 'app\modules\talks\Module',
            'controllerNamespace' => 'app\modules\talks\controllers\frontend',
            'viewPath' => '@app/modules/talks/views/frontend',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/themes/v01/layouts/admin',
            'modules' => [
                'lectors' => [
                    'class' => 'app\modules\lectors\Module',
                    'controllerNamespace' => 'app\modules\lectors\controllers\backend',
                    'viewPath' => '@app/modules/lectors/views/backend',
                ],
                'lessons' => [
                    'class' => 'app\modules\lessons\Module',
                    'controllerNamespace' => 'app\modules\lessons\controllers\backend',
                    'viewPath' => '@app/modules/lessons/views/backend',
                ],
                'subscribe' => [
                    'class' => 'app\modules\subscribe\Module',
                    'controllerNamespace' => 'app\modules\subscribe\controllers\backend',
                    'viewPath' => '@app/modules/subscribe/views/backend',
                ],
                'usertalk' => [
                    'class' => 'app\modules\usertalk\Module',
                    'controllerNamespace' => 'app\modules\usertalk\controllers\backend',
                    'viewPath' => '@app/modules/usertalk/views/backend',
                ],
                'talks' => [ // отзывы
                    'class' => 'app\modules\talks\Module',
                    'controllerNamespace' => 'app\modules\talks\controllers\backend',
                    'viewPath' => '@app/modules/talks/views/backend',
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
