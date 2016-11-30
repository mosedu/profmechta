<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 23.11.2016
 * Time: 14:01
 */

namespace app\modules\lessons;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/lessons/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/lessons/messages',
            'fileMap' => [
                'modules/lessons/lesson' => 'lesson.php',
            ],
        ];
        $app->i18n->translations['lesson'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/lessons/messages',
            'fileMap' => [
                'modules/lessons/lesson' => 'lesson.php',
            ],
        ];
    }
}