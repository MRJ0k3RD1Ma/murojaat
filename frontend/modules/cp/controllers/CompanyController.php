<?php

namespace frontend\modules\cp\controllers;

use common\models\Company;
use common\models\CompanyOld;
use common\models\search\CompanySearch;
use common\models\Token;
use common\models\User;
use common\models\UserAccesItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionToken($id){
        $model = new Token();
        if($m = Token::findOne(['company_id'=>$id])){
            $model = $m;
        }
        $model->company_id = $id;
        $model->status = 1;
        $model->type_id = 1;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->token = \Yii::$app->security->generateRandomString(30);
                while (Token::findOne(['token'=>$model->token])){
                    $model->token = \Yii::$app->security->generateRandomString(30);
                }
                if($model->save()){
                    Yii::$app->session->setFlash('success','Token yaratildi');
                }else{
                    Yii::$app->session->setFlash('error','Saqlashda xatolik');
                }
            }
            return $this->redirect(['view', 'id' => $model->company_id]);

        }

        return $this->renderAjax('createtoken', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all Company models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPaid($id,$url=0){

        $model = Company::findOne($id);
        $model->scenario = 'paidtime';
        $model->redirect = $url;
        $model->paid_date = "";
        $model->paid = 1;
        if($model->load(Yii::$app->request->post())){

            if($model->save()){
                if($url){
                    return $this->redirect([$url]);
                }else{
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->renderAjax('_paid',['model'=>$model]);


    }

    public function actionChild($id){
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = Company::findOne($id);
        return $this->render('child', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
    /**
     * Displays a single Company model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new CompanySearch();
        $searchModel->parent_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddchild($id,$child_id){
        if($model = Company::findOne($child_id)){
            $model->parent_id = $id;
            $model->save();
            return 1;
        }else{
            return 0;
        }
    }

    public function actionRemovechild($id,$child_id){
        if($model = Company::findOne($child_id)){
            $model->parent_id = null;
            $model->save();
        }
        return $this->redirect(['view','id'=>$id]);
    }


    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdateuser($id)
    {
        $model = User::findOne($id);
        $password = $model->password;
        $company = Company::findOne($model->company_id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->password) {
                $model->setPassword($model->password);
            } else {
                $model->password = $password;
            }
            if ($model->save()) {
                if(is_array($model->access)){
                    foreach ($model->access as $key => $item){
                        if($item == 1){
                            $acc = new UserAccesItem();
                            $acc->user_id = $model->id;
                            $acc->access_id = $key;
                            $acc->status = 1;
                            $acc->save();
                        }else{
                            if($acc = UserAccesItem::findOne(['user_id'=>$model->id,'access_id'=>$key])){
                                $acc->delete();
                            }
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->company_id]);
            } else {
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }
        $model->password = "";

        return $this->render('adduser', [
            'model' => $model,
            'company'=>$company
        ]);
    }

    public function actionDeleteuser($id,$com){

        if($user = User::findOne($id)){
            $user->delete();
        }
        return $this->redirect(['view','id'=>$com]);
    }
    public function actionAdduser($id)
    {
        $model = new User();
        $model->scenario = 'insert';
        $company = Company::findOne($id);
        $model->company_id = $company->id;
        if ($model->load(Yii::$app->request->post())) {

            $model->setPassword($model->password);
            if($model->save()){
                if(is_array($model->access)){
                    foreach ($model->access as $key => $item){
                        if($item == 1){
                            $acc = new UserAccesItem();
                            $acc->user_id = $model->id;
                            $acc->access_id = $key;
                            $acc->status = 1;
                            $acc->save();
                        }
                    }
                }else{
                    exit;
                }
                return $this->redirect(['view', 'id' => $id]);
            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }

        return $this->render('adduser', [
            'model' => $model,
            'company'=>$company
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->region_id = $model->soato->region_id;
        $model->district_id = $model->soato->district_id;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if(!$model->soato_id){
                $model->soato_id = "17".$model->region_id.$model->district_id;
            }
            if($model->save()){
                $child = Company::find()->where(['parent_id'=>$model->id])->all();
                foreach ($child as $item){
                    $item->complex_id = $model->complex_id;
                    $item->type_id = $model->type_id;
                    $item->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
