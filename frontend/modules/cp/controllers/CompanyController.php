<?php

namespace frontend\modules\cp\controllers;

use common\models\Company;
use common\models\search\CompanySearch;
use common\models\User;
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
        $model->password = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->password) {
                $model->encrypt();
            } else {
                $model->password = $password;
            }
            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->company_id]);
            } else {
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
            $model->encrypt();
            if($model->save()){
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
