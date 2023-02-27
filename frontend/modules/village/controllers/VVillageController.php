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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\FileHelper;
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
        if(Yii::$app->request->isPost){
            // export excel;
            ini_set('upload_max_filesize','500M');
            ini_set('max_input_time','5000');
            ini_set('max_execution_time','5000');
            ini_set('memory_limit','500000M');
            $speadsheet = new Spreadsheet();

            $sheet = $speadsheet->getActiveSheet();
            $title = date('Y-m-d h:i:s');

            $speadsheet->getActiveSheet()->mergeCells("A1:O1");
            $sheet->setCellValue('A1',Yii::$app->user->identity->company->fulladdr.'да уйма-уй юриш жараёнида ўтказилган ўрганишлар натижалари');

            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(20);
            $sheet->getColumnDimension('C')->setWidth(10);
            $sheet->getColumnDimension('D')->setWidth(14);
            $sheet->getColumnDimension('E')->setWidth(22);
            $sheet->getColumnDimension('F')->setWidth(20);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(12);
            $sheet->getColumnDimension('J')->setWidth(10);
            $sheet->getColumnDimension('K')->setWidth(15);
            $sheet->getColumnDimension('L')->setWidth(15);
            $sheet->getColumnDimension('M')->setWidth(15);
            $sheet->getColumnDimension('N')->setWidth(15);
            $sheet->getColumnDimension('O')->setWidth(15);
            $sheet->getColumnDimension('P')->setWidth(15);
            $sheet->getColumnDimension('Q')->setWidth(15);
            $sheet->getColumnDimension('R')->setWidth(15);
            $sheet->getColumnDimension('S')->setWidth(15);
            $sheet->getColumnDimension('T')->setWidth(15);
            $sheet->getColumnDimension('U')->setWidth(15);
            $sheet->getColumnDimension('V')->setWidth(15);
            $sheet->getColumnDimension('W')->setWidth(15);
            $sheet->getColumnDimension('X')->setWidth(30);
            $sheet->getColumnDimension('Y')->setWidth(15);
            $sheet->getColumnDimension('Z')->setWidth(15);
            $sheet->getColumnDimension('AA')->setWidth(15);
            $sheet->getColumnDimension('AB')->setWidth(15);
            $sheet->getColumnDimension('AC')->setWidth(20);
            $sheet->getColumnDimension('AD')->setWidth(15);
            $sheet->getColumnDimension('AE')->setWidth(20);
            $sheet->getColumnDimension('AF')->setWidth(20);
            $sheet->getColumnDimension('AG')->setWidth(15);
            $sheet->getColumnDimension('AH')->setWidth(30);
            $sheet->getColumnDimension('AI')->setWidth(20);
            $sheet->getColumnDimension('AJ')->setWidth(20);
            $sheet->getColumnDimension('AK')->setWidth(20);
            $sheet->getColumnDimension('AL')->setWidth(20);
            $sheet->getColumnDimension('AM')->setWidth(20);
            $sheet->getColumnDimension('AN')->setWidth(20);






            $speadsheet->getActiveSheet()->mergeCells("A2:A3");
            $sheet->setCellValue('A2','№');
            $speadsheet->getActiveSheet()->mergeCells("B2:B3");
            $sheet->setCellValue('B2','Туман (шаҳар) номи');
            $speadsheet->getActiveSheet()->mergeCells("C2:C3");
            $sheet->setCellValue('C2','Сектор рақами');
            $speadsheet->getActiveSheet()->mergeCells("D2:D3");
            $sheet->setCellValue('D2','Хонадон ўрганилган сана (кун/ой/йил)');
            $speadsheet->getActiveSheet()->mergeCells("E2:E3");
            $sheet->setCellValue('E2','МФЙ номи');
            $speadsheet->getActiveSheet()->mergeCells("F2:F3");
            $sheet->setCellValue('F2','Хонадон манзили (кўча номи ва уй рақами)');
            $speadsheet->getActiveSheet()->mergeCells("G2:K2");
            $sheet->setCellValue('G2','Суҳбат ўтказилган хонадон вакили');
            $speadsheet->getActiveSheet()->mergeCells("L2:N2");
            $sheet->setCellValue('L2','"Хонадоннинг иқтисодий-ижтимоий аҳволи (керакли устунга 1 рақами ёзилади)"');

            $speadsheet->getActiveSheet()->mergeCells("O2:O3");
            $sheet->setCellValue('O2','"Назоратга олинадиган муаммоси бор хонадонми (1 рақами ёзилади)"');

            $speadsheet->getActiveSheet()->mergeCells("P2:S2");
            $sheet->setCellValue('P2','Энергия тежамкор ускуналар ўрнатишга эҳтиёжи ');
            $speadsheet->getActiveSheet()->mergeCells("T2:X2");
            $sheet->setCellValue('T2','Кредит олишга бўлган талаб');
            $speadsheet->getActiveSheet()->mergeCells("Y2:AB2");
            $sheet->setCellValue('Y2','Субсидия олишга бўлган талаб');
            $speadsheet->getActiveSheet()->mergeCells("AC2:AE2");
            $sheet->setCellValue('AC2','Хонадон вакилидан четга кетганлар ');
            $speadsheet->getActiveSheet()->mergeCells("AF2:AH2");
            $sheet->setCellValue('AF2','Аниқланган муаммо мазмуни');

            $speadsheet->getActiveSheet()->mergeCells("AI2:AI3");
            $sheet->setCellValue('AI2','"Аниқланган муаммо йўналишининг махсус коди
(Ушбу устунда иловада келтирилган  муаммолар йўналиши бўйича махсус кодлар ёзилади) "');
            $speadsheet->getActiveSheet()->mergeCells("AJ2:AJ3");
            $sheet->setCellValue('AJ2','Ижро учун масъул ташкилот ');
            $speadsheet->getActiveSheet()->mergeCells("AK2:AK3");
            $sheet->setCellValue('AK2','Бажариш муддати (...гача)');
            $speadsheet->getActiveSheet()->mergeCells("AL2:AO2");
            $sheet->setCellValue('AL2','Муаммони ҳал этиш натижаси ');
            $speadsheet->getActiveSheet()->mergeCells("AP2:AP3");
            $sheet->setCellValue('AP2','Бажарилиши асослари (масъул ташкилот жавоб хати, хонадон қониқиш хати, сухбат баёни киритилади)');

            $sheet->setCellValue('G3','Ф.И.О.');
            $sheet->setCellValue('H3','Туғилган йили ');
            $sheet->setCellValue('I3','Ёши');
            $sheet->setCellValue('J3','Жинси');
            $sheet->setCellValue('K3','Телефон номери');
            $sheet->setCellValue('L3','"биринчи тоифа 
(кам таъминланган, эхтиёжманд ва даромади паст хонадонлар.)"');
            $sheet->setCellValue('M3','"иккинчи тоифа 
(доимий даромадга эга, қўшимча даромад топиш истагидаги хонадонлар.)"');
            $sheet->setCellValue('N3','"учинчи тоифа 
(иқтисодий аҳволи яхши ва ўзига тўқ хонадонлар.)"');
            $sheet->setCellValue('P3','ха/йук');
            $sheet->setCellValue('Q3','"ўз маблағига
(1 рақами ёзилади)"');
            $sheet->setCellValue('R3',' имтиёзли кредитга  (1 рақами ёзилади)');
            $sheet->setCellValue('S3','кВт ');
            $sheet->setCellValue('T3','бор/йук');
            $sheet->setCellValue('U3',' суммаси (млн.сўмда)');
            $sheet->setCellValue('V3','"Аёллар 
(1 рақами ёзилади)"');
            $sheet->setCellValue('W3','"Ёшлар 
(1 рақами ёзилади)"');
            $sheet->setCellValue('X3','"Кредит мақсади 
(сўз билан ёзилади)"');
            $sheet->setCellValue('Y3','бор/йук');
            $sheet->setCellValue('Z3','"Аёллар 
(1 рақами ёзилади)"');
            $sheet->setCellValue('AA3','"Ёшлар 
(1 рақами ёзилади)"');
            $sheet->setCellValue('AB3','"субсидия мақсади 
(сўз билан ёзилади)"');
            $sheet->setCellValue('AC3','Ф.И.О');
            $sheet->setCellValue('AD3','Туғилган кун, ой йил');
            $sheet->setCellValue('AE3','"Четга кетганлик сабаби
(ўқиш, ишлаш, саёҳат, даволаниш в.х.к)"');
            $sheet->setCellValue('AF3','Муаммоси бор бўлган хонадон вакили Ф.И.О.');
            $sheet->setCellValue('AG3','"Туғилган 
кун. ой. йил"');
            $sheet->setCellValue('AH3','муаммо мазмуни');
            $sheet->setCellValue('AL3','"Жараёнда  
(1 раками ёзилади) ');
            $sheet->setCellValue('AM3','Ҳал этилди 
(1 раками ёзилади)');
            $sheet->setCellValue('AN3','"Қисқа муддатли манзилли тадбирлар режасига киритилди 
(1 раками ёзилади)"');
            $sheet->setCellValue('AO3','"Ўрта муддатли манзилли тадбирлар режасига киритилди 
(1 раками ёзилади)"');

            $word = [
                '','A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
            ];

            $row = 4;
            $sheet->setCellValueByColumnAndRow(1,$row,1);
            for($i=1; $i<=41; $i++){
                $sheet->setCellValueByColumnAndRow($i+1,$row,$i);
            }
            $n=5;

            $m=0;
            foreach ($dataProvider->query->all() as $item){
                $m++;
                $l = 1;
                if($l < count($item->vPersonMigrants)){
                    $l = count($item->vPersonMigrants);
                }
                if($l < count($item->vVillageProblems)){
                    $l = count($item->vVillageProblems);
                }
                $len = $n+$l-1;
                $sheet->mergeCells('A'.$n.':A'.$len);
                $sheet->setCellValue('A'.$n,$m);
                $sheet->mergeCells('B'.$n.':b'.$len);
                $sheet->setCellValue('B'.$n,$item->soato->district);

                $sheet->mergeCells('C'.$n.':C'.$len);
                $sheet->setCellValue('C'.$n,$item->sector);
                $sheet->mergeCells('D'.$n.':D'.$len);
                $sheet->setCellValue('D'.$n,date('d.m.Y',strtotime($item->date)));
                $sheet->mergeCells('E'.$n.':E'.$len);
                $sheet->setCellValue('E'.$n,$item->soato->name_cyr);
                $sheet->mergeCells('F'.$n.':F'.$len);
                $sheet->setCellValue('F'.$n,$item->road.' '.$item->address);
                $sheet->mergeCells('G'.$n.':G'.$len);
                $sheet->setCellValue('G'.$n,$item->person_name);
                $sheet->mergeCells('H'.$n.':H'.$len);
                $sheet->setCellValue('H'.$n,date('Y',strtotime($item->person_birthday)));
                $sheet->mergeCells('I'.$n.':I'.$len);
                $sheet->setCellValue('I'.$n,"");
                $sheet->mergeCells('J'.$n.':J'.$len);
                $sheet->setCellValue('J'.$n,Yii::$app->params['gender'][$item->gender]);
                $sheet->mergeCells('K'.$n.':K'.$len);
                $sheet->setCellValue('K'.$n,$item->person_phone);
                $sheet->mergeCells('L'.$n.':L'.$len);
                $sheet->setCellValue('L'.$n,$item->home_status_id == 1 ? '1' : "");
                $sheet->mergeCells('M'.$n.':M'.$len);
                $sheet->setCellValue('M'.$n,$item->home_status_id == 2? '1' : '');
                $sheet->mergeCells('N'.$n.':N'.$len);
                $sheet->setCellValue('N'.$n,$item->home_status_id == 3 ? '1' : '');
                $sheet->mergeCells('O'.$n.':O'.$len);
                $sheet->setCellValue('O'.$n,Yii::$app->params['has_cl_problem'][$item->has_cl_problem]);
                $sheet->mergeCells('P'.$n.':P'.$len);
                $sheet->setCellValue('P'.$n,Yii::$app->params['want_econom_energy'][$item->want_econom_energy]);
                $sheet->mergeCells('Q'.$n.':Q'.$len);
                $sheet->setCellValue('Q'.$n,$item->econom_energy_credit);
                $sheet->mergeCells('R'.$n.':R'.$len);
                $sheet->setCellValue('R'.$n,$item->econom_energy_own);
                $sheet->mergeCells('S'.$n.':S'.$len);
                $sheet->setCellValue('S'.$n,$item->econom_energy);
                $sheet->mergeCells('T'.$n.':T'.$len);
                $sheet->setCellValue('T'.$n,Yii::$app->params['is_want_credit'][$item->is_want_credit]);
                $sheet->mergeCells('U'.$n.':U'.$len);
                $sheet->setCellValue('U'.$n,$item->want_credit);
                $sheet->mergeCells('V'.$n.':V'.$len);
                $sheet->setCellValue('V'.$n,$item->credit_women);
                $sheet->mergeCells('W'.$n.':W'.$len);
                $sheet->setCellValue('W'.$n,$item->credit_young);
                $sheet->mergeCells('X'.$n.':X'.$len);
                $sheet->setCellValue('X'.$n,$item->credit);
                $sheet->mergeCells('Y'.$n.':Y'.$len);
                $sheet->setCellValue('Y'.$n,Yii::$app->params['want_subsidy'][$item->want_subsidy]);
                $sheet->mergeCells('Z'.$n.':Z'.$len);
                $sheet->setCellValue('Z'.$n,$item->subsidy_women);
                $sheet->mergeCells('AA'.$n.':AA'.$len);
                $sheet->setCellValue('AA'.$n,$item->subsidy_young);
                $sheet->mergeCells('AB'.$n.':AB'.$len);
                $sheet->setCellValue('AB'.$n,$item->subsidy);

                $p=0;
                foreach ($item->vPersonMigrants as $mig){
                    $q = $n+$p;
                    $p++;
                    $sheet->setCellValue('AC'.$q,$mig->person_name);
                    $sheet->setCellValue('AD'.$q,$mig->birthday);
                    $sheet->setCellValue('AE'.$q,$mig->why->name);
                }
                $p = 0;
                foreach ($item->vVillageProblems as $prob){
                    $q = $n+$p;
                    $p++;
                    $sheet->setCellValue('AF'.$q,$prob->name);
                    $sheet->setCellValue('AG'.$q,$prob->year);
                    $sheet->setCellValue('AH'.$q,$prob->detail);
                    $sheet->setCellValue('AI'.$q,$prob->type->code);
                }

                /*$sheet->setCellValue('AJ'.$n,$item);
                $sheet->setCellValue('AK'.$n,$item);
                $sheet->setCellValue('AL'.$n,$item);

                $sheet->setCellValue('AM'.$n,$item);
                $sheet->setCellValue('AN'.$n,$item);*/
                $n+=$l;
            }


            $speadsheet->getActiveSheet()->getStyle("A1:AN".$n)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $speadsheet->getActiveSheet()->getStyle("A1:AN".$n)->getAlignment()->setHorizontal('center');
            $speadsheet->getActiveSheet()->getStyle("A1:AN".$n)->getAlignment()->setVertical('center');
            $speadsheet->getActiveSheet()->getStyle("A1:AN".$n)->getAlignment()->setWrapText(true);


            $name = 'Umumiy ma`lumotlar - ' . Yii::$app->formatter->asDatetime(time(), 'php:d_m_Y_h_i_s') . '.xlsx';
            $base_name = 'report.xlsx';
            $writer = new Xlsx($speadsheet);
            $dir = Yii::$app->basePath.'/web/tmp';
            if (!is_dir($dir)) {
                FileHelper::createDirectory($dir, 0777);
            }
            $fileName = $dir . DIRECTORY_SEPARATOR . $base_name;
            $writer->save($fileName);
            return Yii::$app->response->sendFile($fileName,$name);

        }
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
