<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 23.11.2016
 * Time: 14:01
 */

namespace app\modules\subscribe;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/subscribe/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/subscribe/messages',
            'fileMap' => [
                'modules/subscribe/subscribe' => 'subscribe.php',
            ],
        ];
    }
}