<?php

namespace frontend\modules\district\controllers;

use common\models\Appeal;
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
        $model = $this->findModel($id, $village_id);
        if($model->status_id == 1){
            $model->status_id = 2;
            $model->save(false);
        }
        return $this->render('view', [
            'model' => $model,
            'id'=>$id,
        ]);
    }

    public function actionTask($id,$village_id,$cid){
        if(VAppeal::findOne(['id'=>$id,'village_id'=>$village_id,'company_id'=>$cid])){
           return "Ушбу ташкилотга топшириқ юборилган.";
        }
        $prob = VVillageProblem::findOne(['id'=>$id,'village_id'=>$village_id]);
        $model = new Appeal();
        $model->scenario = "v_district";
        $model->register_company_id = Yii::$app->user->identity->company_id;
        $model->register_id = Yii::$app->user->id;
        $model->type = 2;
        $model->count_applicant = 1;
        $model->appeal_type_id = 1;
        $model->appeal_shakl_id = 7;
        $model->count_list = 1;
        $model->company_id = $cid;
        $model->soato_id = Yii::$app->user->identity->company->soato_id;
        $model->deadtime = date('Y-m-d', strtotime(date('Y-m-d') . ' +15 day'));
        $model->date_of_birth = date('Y-m-d',strtotime($prob->year.'-01-01'));
        $model->person_name = $prob->name;
        $model->appeal_detail = $prob->type->code.'-'.$prob->type->name." Мурожаат матни: ".$prob->detail;
        $model->address = $prob->village->soato->name_cyr.' '.$prob->village->road.' '.$prob->village->address;

        if(Yii::$app->request->isPost and $model->load(Yii::$app->request->post())){

            $transaction = Yii::$app->db->beginTransaction();
            $model->year = date('Y');
            if($model->number = Appeal::find()->where(['year'=>$model->year])->andWhere(['type'=>2])->max('number')){
                $model->number = $model->number+1;
            }else{
                $model->number = 1;
            }

            $model->number_full = 'Ш-'.$model->number.'/'.substr($model->year,2,2);

            if ($model->save()) {

                $ap = new VAppeal();
                $ap->appeal_id = $model->id;
                $ap->id = $id;
                $ap->village_id = $village_id;
                $ap->company_id = $cid;
                $ap->status_id = 0;
                $ap->task = $model->task_txt;
                if($ap->save()){
                    $prob->status_id = 3;
                    if($prob->save(false)){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Топшириқ мувоффақийатли юборилди.');
                    }else{
                        $transaction->rollback();
                        Yii::$app->session->setFlash('error','Топшириқни сақлашда хатолик-prob');
                    }
                }else{
                    $transaction->rollback();
                    Yii::$app->session->setFlash('error','Топшириқни сақлашда хатолик-ap');
                }
                // если сохранение прошло без ошибок, то коммитим транзакцию


            } else {

                // если хоть одно из сохранений не удалось, то откатываемся
                $transaction->rollback();
                Yii::$app->session->setFlash('error','Топшириқни сақлашда хатолик-model');
            }

            return $this->redirect(['view','id'=>$id,'village_id'=>$village_id]);
        }

        return $this->renderAjax('_form_task',['model'=>$model]);
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
