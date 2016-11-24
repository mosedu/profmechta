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

    ],
];

$testConfig = ArrayHelper::merge(
    $testConfig,
    file_exists($sfTestLocal) ? require($sfTestLocal) : []
);

return $testConfig;
