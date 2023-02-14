<?php

namespace frontend\modules\village\controllers;

use yii\web\Controller;
use Yii;
/**
 * Default controller for the `village` module
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
