<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 23.11.2016
 * Time: 14:01
 */

namespace app\modules\lectors;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/lectors/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/lectors/messages',
            'fileMap' => [
                'modules/lectors/lector' => 'module.php',
            ],
        ];
    }
}