<?php

namespace app\modules\lectors;

use Yii;

/**
 * lectors module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\lectors\controllers';

    /**
     * @var string
     */
    public $defaultRole = 'lectors';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/lectors/' . $category, $message, $params, $language);
    }
}
