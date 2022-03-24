<?php

namespace frontend\controllers;

use common\models\Appeal;
use common\models\AppealSend;
use common\models\Register;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/**
 * Site controller
 */
class AppealController extends Controller
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
        ];
    }

    public function actionIndex(){

        return $this->render('index');
    }

    public function actionCreate(){
        $model = new Appeal();
        $send = new AppealSend();
        $register = new Register();
        $model->number = Appeal::find()->filterWhere(['like','date',date('Y')])->andWhere(['company_id'=>Yii::$app->user->identity->company_id])->max('number');
        $model->number = intval($model->number)+1;
        $model->date = date('Y-m-d');
        $model->region_id = Yii::$app->user->identity->company->region_id;
        $model->district_id = Yii::$app->user->identity->company->district_id;
        $model->count_page = 1;

        if($model->load(Yii::$app->request->post())){

        }
        return $this->render('create',[
            'model'=>$model,
            'send'=>$send,
            'register'=>$register
        ]);
    }
}
