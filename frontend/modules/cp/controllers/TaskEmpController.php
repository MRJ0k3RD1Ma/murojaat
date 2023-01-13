<?php

namespace frontend\modules\cp\controllers;

use common\models\TaskEmp;
use common\models\search\TaskEmpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskEmpController implements the CRUD actions for TaskEmp model.
 */
class TaskEmpController extends Controller
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
     * Lists all TaskEmp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskEmpSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskEmp model.
     * @param int $sender_id Sender ID
     * @param int $reciever_id Reciever ID
     * @param int $register_id Register ID
     * @param int $appeal_id Appeal ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sender_id, $reciever_id, $register_id, $appeal_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sender_id, $reciever_id, $register_id, $appeal_id),
        ]);
    }

    /**
     * Creates a new TaskEmp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TaskEmp();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaskEmp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sender_id Sender ID
     * @param int $reciever_id Reciever ID
     * @param int $register_id Register ID
     * @param int $appeal_id Appeal ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sender_id, $reciever_id, $register_id, $appeal_id)
    {
        $model = $this->findModel($sender_id, $reciever_id, $register_id, $appeal_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaskEmp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sender_id Sender ID
     * @param int $reciever_id Reciever ID
     * @param int $register_id Register ID
     * @param int $appeal_id Appeal ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sender_id, $reciever_id, $register_id, $appeal_id)
    {
        $this->findModel($sender_id, $reciever_id, $register_id, $appeal_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskEmp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sender_id Sender ID
     * @param int $reciever_id Reciever ID
     * @param int $register_id Register ID
     * @param int $appeal_id Appeal ID
     * @return TaskEmp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sender_id, $reciever_id, $register_id, $appeal_id)
    {
        if (($model = TaskEmp::findOne(['sender_id' => $sender_id, 'reciever_id' => $reciever_id, 'register_id' => $register_id, 'appeal_id' => $appeal_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
