<?php

namespace frontend\modules\region;

use yii\filters\AccessControl;
use Yii;
/**
 * district module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\region\controllers';
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
                            if(Yii::$app->user->identity->access(6)){
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
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            header('Location: '.Yii::$app->urlManager->createUrl(['/site/login']));
            exit;
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->viewPath = "@frontend/modules/region/views";

        // custom initialization code goes here
    }
}