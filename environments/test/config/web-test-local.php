<?php

use yii\helpers\ArrayHelper;

$sfCommonWeb = __DIR__ . DIRECTORY_SEPARATOR . 'web.php';
$sfCommonTest = __DIR__ . DIRECTORY_SEPARATOR . 'test.php';

$testWebConfig = [
    'components' => [
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'urlManager' => [
            'showScriptName' => true,
            'enablePrettyUrl' => false,
            'cache' => false,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],

    ],
];

$testWebConfig = ArrayHelper::merge(
    require($sfCommonWeb),
    require($sfCommonTest),
    $testWebConfig
);

return $testWebConfig;
