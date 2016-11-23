<?php

namespace app\modules\lectors\controllers\backend;

use yii\web\Controller;

/**
 * Default controller for the `lectors` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
