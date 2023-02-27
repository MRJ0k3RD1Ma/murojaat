<?php

namespace frontend\modules\village\controllers;

use common\models\VPersonMigrant;
use common\models\VPersonMigrantWhy;
use common\models\VVillage;
use common\models\search\VVillageSearch;
use common\models\VVillageFives;
use common\models\VVillageProblem;
use common\models\VVillageProblemType;
use common\models\VVillageReport;
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
        $dataProvider = $searchModel->searchVillage(Yii::$app->request->queryParams);

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
        $soato = Yii::$app->user->identity->company->soato;
        $model->soato_id = $soato->id;
        $model->user_id = Yii::$app->user->id;
        if($rep = VVillageReport::findOne('17'.$soato->region_id.$soato->district_id)){
            $date = $rep->next_date;
            if(time() > strtotime($date) ){
                $date = date('Y-m-d');
            }
        }else{
            $date = date('Y-m-d');
        }
        $model->date = date('Y-m-d',strtotime($date));

        if($sec = VVillageFives::findOne(['company_id'=>Yii::$app->user->identity->company_id])){
            $model->sector = $sec->sector;
        }
        $model->migrant = 0;
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) ) {
                $model->sector = Yii::$app->user->identity->company->soato->sector;

                if($model->want_subsidy == 2){
                    $model->subsidy_women = 0;
                    $model->subsidy_young = 0;
                    $model->subsidy = "";
                }
                if($model->is_want_credit == 2){
                    $model->want_credit = 0;
                    $model->credit_women = 0;
                    $model->credit_young = 0;
                    $model->credit = "";
                }
                if($model->want_econom_energy == 2){
                    $model->econom_energy = "";
                    $model->econom_energy_own = "";
                    $model->econom_energy_credit = "";
                }


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
                            $mig->why_id = $item['why_id'];
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
                            $mig->name = $item['name'];
                            $mig->detail = $item['detail'];
                            $mig->type_id = $item['type_id'];
                            $mig->save();
                        }
                    }
                }else{
                    echo '<pre>';
                    var_dump($model);
                    exit;
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

    public function actionGetwhy($key){
        $model = VPersonMigrantWhy::find()->all();
        $res = "<div class='col-sm-12'><label class='control-label' style='width: 100%'>Сабаб<select class='form-control' name='VVillage[mig][{$key}][why_id]'>";
        foreach ($model as $item){
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        $res .= "</select></label></div>";
        return $res;
    }
    public function actionGettype($key){
        $model = VVillageProblemType::find()->all();
        $res = "<div class='col-sm-12'><label class='control-label' style='width: 100%'>Муаммо коди<select class='form-control' name='VVillage[problems][{$key}][type_id]'>";
        foreach ($model as $item){
            $res .= "<option value='{$item->id}'>{$item->code} - {$item->name}</option>";
        }
        $res .= "</select></label></div>";
        return $res;
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

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
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
        if (($model = VVillage::find()->where(['id' => $id,'soato_id'=>Yii::$app->user->identity->company->soato_id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
