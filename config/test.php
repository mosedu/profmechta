<?php

/**
 * Application configuration shared by all test types
 */
use yii\helpers\ArrayHelper;

$sfTestLocal = __DIR__ . DIRECTORY_SEPARATOR . 'test-local.php';

$testConfig = [
    'id' => 'basic-tests',
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//        ],
//        'urlManager' => [
//            'showScriptName' => true,
//            'enablePrettyUrl' => false,
//            'cache' => false,
//        ],

//        'request' => [
//            'cookieValidationKey' => 'test',
//            'enableCsrfValidation' => false,
//            // but if you absolutely need it set cookie domain to localhost
//            /*
//            'csrfCookie' => [
//                'domain' => 'localhost',
//            ],
//            */
//        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info', 'trace', ],
                    'logFile' => '@app/runtime/logs/testdev.log',
                    'maxFileSize' => 300,
                    'maxLogFiles' => 3,
                ],
            ],
        ],

    ],
];

$testConfig = ArrayHelper::merge(
    $testConfig,
    file_exists($sfTestLocal) ? require($sfTestLocal) : []
);

return $testConfig;
