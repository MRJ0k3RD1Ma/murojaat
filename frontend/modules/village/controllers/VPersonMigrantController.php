<?php

namespace frontend\modules\village\controllers;

use common\models\VPersonMigrant;
use common\models\search\VPersonMigrantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VPersonMigrantController implements the CRUD actions for VPersonMigrant model.
 */
class VPersonMigrantController extends Controller
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
     * Lists all VPersonMigrant models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VPersonMigrantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VPersonMigrant model.
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
     * Creates a new VPersonMigrant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VPersonMigrant();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing VPersonMigrant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $village_id Village ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $village_id)
    {
        $model = $this->findModel($id, $village_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'village_id' => $model->village_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VPersonMigrant model.
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
     * Finds the VPersonMigrant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $village_id Village ID
     * @return VPersonMigrant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $village_id)
    {
        if (($model = VPersonMigrant::findOne(['id' => $id, 'village_id' => $village_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
