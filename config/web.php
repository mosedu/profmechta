<?php

use yii\helpers\ArrayHelper;

$sfCommon = __DIR__ . DIRECTORY_SEPARATOR . 'common.php';
$sfCommonLocal = __DIR__ . DIRECTORY_SEPARATOR . 'common-local.php';
$sfWebLocal = __DIR__ . DIRECTORY_SEPARATOR . 'web-local.php';


$webconfig = [
    'id' => 'basic-web',
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
