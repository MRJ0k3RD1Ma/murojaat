<?php

namespace frontend\modules\village\controllers;

use common\models\VVillageProblem;
use common\models\search\VVillageProblemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * VVillageProblemController implements the CRUD actions for VVillageProblem model.
 */
class VVillageProblemController extends Controller
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
     * Lists all VVillageProblem models.
     *
     * @return string
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
     * @param int $id ID
     * @param int $village_id Village ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $village_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $village_id),
        ]);
    }

    /**
     * Creates a new VVillageProblem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VVillageProblem();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'village_id' => $model->village_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VVillageProblem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $village_id Village ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $village_id)
    {
        $model = $this->findModel($id, $village_id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'village_id' => $model->village_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VVillageProblem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $village_id Village ID
     * @return \yii\web\Response
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
     * @param int $id ID
     * @param int $village_id Village ID
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
