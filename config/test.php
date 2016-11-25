<?php

/**
 * Application configuration shared by all test types
 */
use yii\helpers\ArrayHelper;

$sfBaseParams = __DIR__ . '/params.php';
$sfTestParams = __DIR__ . '/test-params.php';

$testParams = ArrayHelper::merge(
    require($sfParams),
    file_exists($sfTestParams) ? require($sfTestParams) : []
);


$sfTestLocal = __DIR__ . DIRECTORY_SEPARATOR . 'test-local.php';

$testConfig = [
    'id' => 'basic-tests',
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],

    ],
    'params' => $testParams,
];

$testConfig = ArrayHelper::merge(
    $testConfig,
    file_exists($sfTestLocal) ? require($sfTestLocal) : []
);

return $testConfig;
