<?php

namespace frontend\controllers;

use common\models\AppealQuestionGroup;
use common\models\search\ReportSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],

                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){

        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->searchLeader(Yii::$app->request->queryParams);


        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2(){
        $quest = AppealQuestionGroup::find()->all();
        
        return $this->render('index2',[
            'quest'=>$quest
        ]);
    }

}
