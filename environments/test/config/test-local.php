<?php

return [
    'components' => [
        'db' => [
//            'dsn' => 'sqlite:' . dirname(__DIR__) . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'sqlite.db',
            'dsn' => 'sqlite:@app/runtime/sqlite.db',
            'enableSchemaCache' => false,
            'tablePrefix' => 'profmechta_',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
