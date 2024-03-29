<?php

namespace frontend\controllers;

use common\models\Company;
use common\models\search\AppealBajaruvchiSearch;
use common\models\search\CompanySearch;
use common\models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;
use Yii;

class CompanyController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->searchStatus(Yii::$app->request->queryParams);
        if(Yii::$app->request->isPost){
            $speadsheet = new Spreadsheet();
            $sheet = $speadsheet->getActiveSheet();
            $title = "Sheet1";
            $sheet->setTitle(substr($title, 0, 31));
            $n = 0;
            $sheet->setCellValue('A1', '№');
            $sheet->setCellValue('B1', 'Ташкилот номи');
            $sheet->setCellValue('C1', 'Юборилган мурожаатлар');
            $sheet->setCellValue('D1', 'Қабул қилинмаган');
            $sheet->setCellValue('E1', 'Янги');
            $sheet->setCellValue('F1', 'Жараёнда');
            $sheet->setCellValue('G1', 'Тасдиқланиши кутилмоқда');
            $sheet->setCellValue('H1', 'Бажарилган');
            $sheet->setCellValue('I1', 'Натижа рад этилган');
            $sheet->setCellValue('J1', 'Муддати бузилган');
            $sheet->setCellValue('K1', 'Муддати бузилиб бажарилган');
            $sheet->setCellValue('L1', 'Назоратга олинган');
            $sheet->setCellValue('M1', 'Ижобий хал этилди');
            $sheet->setCellValue('N1', 'Чоралар кўрилди');
            $sheet->setCellValue('O1', 'Тушунтирилди');
            $sheet->setCellValue('P1', 'Мурожаат рад этилган');
            $sheet->setCellValue('Q1', 'Маълумот учун');
            $sheet->setCellValue('R1', 'Кўрмасдан қолдирилди');
            foreach ($dataProvider->query->all() as $item){
                $n++;
                $m = $n+1;
                $sheet->setCellValue('A'.$m, $n);
                $sheet->setCellValue('B'.$m, $item->name);
                $sheet->setCellValue('C'.$m, $item->cntall);
                $sheet->setCellValue('D'.$m, $item->cnt0);
                $sheet->setCellValue('E'.$m, $item->cnt1);
                $sheet->setCellValue('F'.$m, $item->cnt2);
                $sheet->setCellValue('G'.$m, $item->cnt3);
                $sheet->setCellValue('H'.$m, $item->cnt4);
                $sheet->setCellValue('I'.$m, $item->cnt5);
                $sheet->setCellValue('J'.$m, $item->cntdead);
                $sheet->setCellValue('K'.$m, $item->cntwithdead);
                $sheet->setCellValue('L'.$m, $item->cnt_nazorat);
                $sheet->setCellValue('M'.$m, $item->cnt_6);
                $sheet->setCellValue('N'.$m, $item->cnt_7);
                $sheet->setCellValue('O'.$m, $item->cnt_8);
                $sheet->setCellValue('P'.$m, $item->cnt_9);
                $sheet->setCellValue('Q'.$m, $item->cnt_10);
                $sheet->setCellValue('R'.$m, $item->cnt_11);

            }
            $name = 'hisobot.xlsx';
            $writer = new Xlsx($speadsheet);
            $dir = Yii::$app->basePath.'/web/template/temp/';
            if (!is_dir($dir)) {
                FileHelper::createDirectory($dir, 0777);
            }
            $fileName = $dir . DIRECTORY_SEPARATOR . $name;
            $writer->save($fileName);
            return Yii::$app->response->sendFile($fileName);

        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id){

        if($com = Company::findOne($id)){
            $searchModel = new AppealBajaruvchiSearch();
            $dataProvider = $searchModel->searchMy(Yii::$app->request->queryParams,'company',$id);

            if(Yii::$app->request->isPost){

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="hisbot.xlsx"');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $n = 0;
                $sheet->setCellValue('A1', '№');
                $sheet->setCellValue('B1', 'Ҳолати');
                $sheet->setCellValue('C1', 'Мурожаатчи');
                $sheet->setCellValue('D1', 'Савол');
                $sheet->setCellValue('E1', 'Муддат');
                $sheet->setCellValue('F1', 'Юборилган вақти');
                foreach ($dataProvider->query->all() as $item){
                    $n++;
                    $m = $n+1;
                    $d = $item;
                    if($q = $d->appeal->question){
                        $res = $q->group->code.'-'.$q->code.'.'.$q->name;
                    }else{
                        $res = "Савол белгиланмаган";
                    }

                    if($d->status == 0){
                        $status =  "Рўйхатга олинмаган";
                    }elseif($d->status == 1){
                        $status =  "Жараёнда";
                    }else{
                        $status =  "Бажарилган";
                    }

                    $sheet->setCellValue('A'.$m, $n);
                    $sheet->setCellValue('B'.$m, $status);
                    $sheet->setCellValue('C'.$m, $d->appeal->person_name);
                    $sheet->setCellValue('D'.$m, $res);
                    $sheet->setCellValue('E'.$m, $item->deadtime);
                    $sheet->setCellValue('F'.$m, $item->created);
                }

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save("php://output");

            }

            return $this->render('view', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'company'=>$com
            ]);
        }else{
            return $this->redirect(['index']);
        }
    }

}
