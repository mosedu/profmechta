<?php
/*
DROP DATABASE IF EXISTS profmechta;
CREATE DATABASE profmechta;
GRANT ALL PRIVILEGES ON profmechta.* TO 'uprofmechta'@'%' IDENTIFIED BY 'pprofmechta' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON profmechta.* TO 'uprofmechta'@'localhost' IDENTIFIED BY 'pprofmechta' WITH GRANT OPTION;
*/

return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=profmechta',
            'username' => 'uprofmechta',
            'password' => 'pprofmechta',
            'tablePrefix' => 'profmechta_',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 24 * 3600,
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
]; 