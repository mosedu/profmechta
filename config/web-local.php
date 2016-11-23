<?php

$weblocalconfig = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'ZE_L8aEuNl8ZXZWKKYr58P4c3T3IaR4p',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@app/runtime/logs/web-error.log',
                    'maxFileSize' => 100,
                    'maxLogFiles' => 2,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning', 'info', 'trace', ],
                    'logFile' => '@app/runtime/logs/web-warning.log',
                    'maxFileSize' => 300,
                    'maxLogFiles' => 3,
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $weblocalconfig['bootstrap'][] = 'debug';
    $weblocalconfig['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $weblocalconfig['bootstrap'][] = 'gii';
    $weblocalconfig['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $weblocalconfig;
