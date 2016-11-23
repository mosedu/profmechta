<?php

use yii\helpers\ArrayHelper;

$sfParams = __DIR__ . '/params.php';
$sfParamsLocal = __DIR__ . '/params-local.php';

$params = ArrayHelper::merge(
    require($sfParams),
    file_exists($sfParamsLocal) ? require($sfParamsLocal) : []
);

return [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\lectors\Bootstrap',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'dsn' => '',
        ],
    ],
    'params' => $params,
];

