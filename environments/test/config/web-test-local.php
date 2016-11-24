<?php

return [
    'components' => [
        'db' => [
            'dsn' => 'sqlite:' . dirname(__DIR__) . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . '/sqlite.db',
            'enableSchemaCache' => false,
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
