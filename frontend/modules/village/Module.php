<?php

namespace frontend\modules\village;

use yii\filters\AccessControl;
use Yii;
/**
 * village module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\village\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            if(Yii::$app->user->identity->access(3) or Yii::$app->user->identity->access(4)){
                                return true;
                            }
                            header('Location: '.Yii::$app->urlManager->createUrl(['/site/index']));
                            exit;
                        }
                    ],

                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->viewPath = "@frontend/modules/village/views";

        // custom initialization code goes here
    }
}
