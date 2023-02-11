<?php

namespace frontend\modules\village\controllers;

use common\models\VPersonMigrant;
use common\models\VVillage;
use common\models\search\VVillageSearch;
use common\models\VVillageProblem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * VVillageController implements the CRUD actions for VVillage model.
 */
class VVillageController extends Controller
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
     * Lists all VVillage models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VVillageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VVillage model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VVillage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VVillage();
        $model->soato_id = Yii::$app->user->identity->company->soato_id;
        $model->user_id = Yii::$app->user->id;

        if ($this->request->isPost) {

            if ($model->load($this->request->post()) ) {

                    if($model->save()){
                        foreach ($model->mig as $item){
                            if($item['name'] and $item['birthday']){
                                $mig = new VPersonMigrant();
                                if($id = VPersonMigrant::find()->where(['village_id'=>$model->id])->max('id')){
                                    $id++;
                                }else{
                                    $id = 1;
                                }
                                $mig->id = $id;
                                $mig->village_id = $model->id;
                                $mig->person_name = $item['name'];
                                $mig->birthday = date('Y-m-d',strtotime($item['birthday']));
                                $mig->save();
                            }
                        }
                        foreach ($model->problems as $item){
                            if($item['kinship'] and $item['year'] and $item['detail']){
                                $mig = new VVillageProblem();
                                if($id = VVillageProblem::find()->where(['village_id'=>$model->id])->max('id')){
                                    $id++;
                                }else{
                                    $id = 1;
                                }
                                $mig->id = $id;
                                $mig->village_id = $model->id;
                                $mig->kinship = $item['kinship'];
                                $mig->year = $item['year'];
//                                $mig->name = $item['name']';
                                $mig->detail = $item['detail'];
                                $mig->save();
                            }
                        }
                    }

                Yii::$app->session->setFlash('success','Сўровнома мувофаққиятли сақланди');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VVillage model.
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
     * Deletes an existing VVillage model.
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
     * Finds the VVillage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VVillage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VVillage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
