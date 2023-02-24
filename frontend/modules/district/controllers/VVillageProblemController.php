<?php

namespace frontend\modules\district\controllers;

use common\models\VAppeal;
use Yii;
use common\models\VVillageProblem;
use common\models\search\VVillageProblemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VVillageProblemController implements the CRUD actions for VVillageProblem model.
 */
class VVillageProblemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VVillageProblem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VVillageProblemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VVillageProblem model.
     * @param integer $id
     * @param integer $village_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $village_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $village_id),
            'id'=>$id,
        ]);
    }

    public function actionTask($id,$village_id,$cid){
        if(VAppeal::findOne(['id'=>$id,'village_id'=>$cid])){

        }
    }

    /**
     * Creates a new VVillageProblem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VVillageProblem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'village_id' => $model->village_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VVillageProblem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $village_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $village_id)
    {
        $model = $this->findModel($id, $village_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'village_id' => $model->village_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VVillageProblem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $village_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $village_id)
    {
        $this->findModel($id, $village_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VVillageProblem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $village_id
     * @return VVillageProblem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $village_id)
    {
        if (($model = VVillageProblem::findOne(['id' => $id, 'village_id' => $village_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
