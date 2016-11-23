<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

use yii\helpers\ArrayHelper;

$sfCommon = __DIR__ . DIRECTORY_SEPARATOR . 'common.php';
$sfCommonLocal = __DIR__ . DIRECTORY_SEPARATOR . 'common-local.php';
$sfConLocal = __DIR__ . DIRECTORY_SEPARATOR . 'console-local.php';

$consoleconfig = [
    'id' => 'basic-console',
//    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::className(),
            'templateFile' => '@app/views/migration.php',
        ],
    ],
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
//        'log' => [
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
//        'db' => $db,
    ],
//    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $consoleconfig['bootstrap'][] = 'gii';
    $consoleconfig['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

$consoleconfig = ArrayHelper::merge(
    require($sfCommon),
    file_exists($sfCommonLocal) ? require($sfCommonLocal) : [],
    $consoleconfig,
    file_exists($sfConLocal) ? require($sfConLocal) : []
);


return $consoleconfig;
