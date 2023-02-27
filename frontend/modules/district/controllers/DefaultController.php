<?php

namespace frontend\modules\district\controllers;

use common\models\MahallaView;
use common\models\VVillage;
use common\models\VVillageFives;
use common\models\VVillageProblem;
use common\models\VVillageProblemStatus;
use common\models\VVillageProblemType;
use common\models\VVillageReport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\FileHelper;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `district` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        /*
         * series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26]
        }]
        */
        $series = [];
        $status = VVillageProblemStatus::find()->all();
        foreach ($status as $item){
            $arr = [
                'name'=>$item->name,
                'data'=>[
                    VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['status_id'=>$item->id])->count('*'),
                    VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['status_id'=>$item->id])->count('*'),
                    VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['status_id'=>$item->id])->count('*'),
                    VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['status_id'=>$item->id])->count('*'),
                ],
            ];
            $series[] = $arr;
        }

        $chart_gen = [];
        $arr = [
            'name'=>"Ўрганилган ҳонадонлар",
            'data'=>[
                VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->count('*'),
                VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->count('*'),
                VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->count('*'),
                VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->count('*'),
            ],
        ];
        $chart_gen[] = $arr;

        $arr = [
            'name'=>"Ўрганилган муаммолар",
            'data'=>[
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->count('*'),
            ],
        ];
        $chart_gen[] = $arr;

        $arr = [
            'name'=>"Хал этилган ёки назоратга олинган",
            'data'=>[
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['>=','status_id',3])->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['>=','status_id',3])->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['>=','status_id',3])->count('*'),
                VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['>=','status_id',3])->count('*'),
            ],
        ];
        $chart_gen[] = $arr;


        return $this->render('index',[
            'series'=>json_encode($series),
            'chart_gen'=>json_encode($chart_gen),
        ]);
    }


    public function actionStatproblem(){
        $model = VVillageProblemType::find()->all();
        $prob = [];
        $prob[0][0] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%")')->count('*');
        if($prob[0][0] == 0){
            $prob[0][0] = 1;
        }
        $prob[0][1] = 100;
        $prob[0][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%")')->andWhere(['>','status_id',3])->count('*');
        $prob[0][3][1] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->count('*');
        $prob[0][4][1] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['>','status_id',3])->count('*');

        $prob[0][3][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->count('*');
        $prob[0][4][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['>','status_id',3])->count('*');

        $prob[0][3][3] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->count('*');
        $prob[0][4][3] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['>','status_id',3])->count('*');

        $prob[0][3][4] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->count('*');
        $prob[0][4][4] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['>','status_id',3])->count('*');



        foreach ($model as $item){
            $prob[$item->id][0] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%")')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][1] = $prob[$item->id][0] / $prob[0][0] * 100;
            $prob[$item->id][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%")')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');

            $prob[$item->id][3][1] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][4][1] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');

            $prob[$item->id][3][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][4][2] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');

            $prob[$item->id][3][3] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][4][3] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');

            $prob[$item->id][3][4] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][4][4] = VVillageProblem::find()->where('village_id in (select id from v_village where soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');
        }
        return $this->render('statproblem',[
            'model'=>$model,
            'prob'=>$prob
        ]);
    }


    public function actionStatmahalla(){

        $sec_1 = MahallaView::find()->where('id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['sector'=>1])->all();
        $sec_2 = MahallaView::find()->where('id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['sector'=>2])->all();
        $sec_3 = MahallaView::find()->where('id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['sector'=>3])->all();
        $sec_4 = MahallaView::find()->where('id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['sector'=>4])->all();

        $res = [];

        $res[1][0][1] = count($sec_1);
        $res[1][0][3] = 1;
        $res[1][0][4] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->sum('homes');
        $res[1][0][5] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->sum('people');
        $res[1][0][6] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->count('*');
        $res[1][0][7] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['date'=>date('Y-m-d')])->count('*');

        $res[1][0][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->groupBy('v_village_problem.village_id')->count('*');
        $res[1][0][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

        $res[1][0][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['>','v_village_problem.status_id',3])->count('*');
        $res[1][0][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['ranges'=>1])->count('*');
        $res[1][0][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['ranges'=>2])->count('*');
        $res[1][0][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=1)')->andWhere(['ranges'=>3])->count('*');

        foreach ($sec_1 as $item){
            $res[1][$item->id][3] = 1;
            $res[1][$item->id][4] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('homes');
            $res[1][$item->id][5] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('people');
            $res[1][$item->id][6] = VVillage::find()->where(['soato_id'=>$item->id])->count('*');
            $res[1][$item->id][7] = VVillage::find()->where(['soato_id'=>$item->id])->andWhere(['date'=>date('Y-m-d')])->count('*');

            $res[1][$item->id][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->groupBy('v_village_problem.village_id')->count('*');
            $res[1][$item->id][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

            $res[1][$item->id][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['>','v_village_problem.status_id',3])->count('*');
            $res[1][$item->id][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>1])->count('*');
            $res[1][$item->id][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>2])->count('*');
            $res[1][$item->id][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>3])->count('*');

        }

        $res[2][0][1] = count($sec_2);
        $res[2][0][3] = 2;
        $res[2][0][4] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->sum('homes');
        $res[2][0][5] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->sum('people');
        $res[2][0][6] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->count('*');
        $res[2][0][7] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['date'=>date('Y-m-d')])->count('*');

        $res[2][0][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->groupBy('v_village_problem.village_id')->count('*');
        $res[2][0][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

        $res[2][0][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['>','v_village_problem.status_id',3])->count('*');
        $res[2][0][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['ranges'=>1])->count('*');
        $res[2][0][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['ranges'=>2])->count('*');
        $res[2][0][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=2)')->andWhere(['ranges'=>3])->count('*');

        foreach ($sec_2 as $item){
            $res[2][$item->id][3] = 2;
            $res[2][$item->id][4] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('homes');
            $res[2][$item->id][5] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('people');
            $res[2][$item->id][6] = VVillage::find()->where(['soato_id'=>$item->id])->count('*');
            $res[2][$item->id][7] = VVillage::find()->where(['soato_id'=>$item->id])->andWhere(['date'=>date('Y-m-d')])->count('*');

            $res[2][$item->id][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->groupBy('v_village_problem.village_id')->count('*');
            $res[2][$item->id][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

            $res[2][$item->id][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['>','v_village_problem.status_id',3])->count('*');
            $res[2][$item->id][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>1])->count('*');
            $res[2][$item->id][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>2])->count('*');
            $res[2][$item->id][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>3])->count('*');

        }

        $res[3][0][3] = 3;
        $res[3][0][1] = count($sec_3);
        $res[3][0][4] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->sum('homes');
        $res[3][0][5] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->sum('people');
        $res[3][0][6] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->count('*');
        $res[3][0][7] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['date'=>date('Y-m-d')])->count('*');

        $res[3][0][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')
            ->groupBy('v_village_problem.village_id')->count('*');

        $res[3][0][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

        $res[3][0][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['>','v_village_problem.status_id',3])->count('*');
        $res[3][0][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['ranges'=>1])->count('*');
        $res[3][0][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['ranges'=>2])->count('*');
        $res[3][0][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=3)')->andWhere(['ranges'=>3])->count('*');

        foreach ($sec_3 as $item){
            $res[3][$item->id][3] = 3;
            $res[3][$item->id][4] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('homes');
            $res[3][$item->id][5] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('people');
            $res[3][$item->id][6] = VVillage::find()->where(['soato_id'=>$item->id])->count('*');
            $res[3][$item->id][7] = VVillage::find()->where(['soato_id'=>$item->id])->andWhere(['date'=>date('Y-m-d')])->count('*');

            $res[3][$item->id][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->groupBy('v_village_problem.village_id')->count('*');
            $res[3][$item->id][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

            $res[3][$item->id][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['>','v_village_problem.status_id',3])->count('*');
            $res[3][$item->id][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>1])->count('*');
            $res[3][$item->id][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>2])->count('*');
            $res[3][$item->id][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>3])->count('*');

        }

        $res[4][0][1] = count($sec_4);
        $res[4][0][3] = 3;
        $res[4][0][4] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->sum('homes');
        $res[4][0][5] = VVillageFives::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->sum('people');
        $res[4][0][6] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->count('*');
        $res[4][0][7] = VVillage::find()->where('soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['date'=>date('Y-m-d')])->count('*');

        $res[4][0][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->groupBy('v_village_problem.village_id')->count('*');
        $res[4][0][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

        $res[4][0][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['>','v_village_problem.status_id',3])->count('*');
        $res[4][0][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['ranges'=>1])->count('*');
        $res[4][0][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['ranges'=>2])->count('*');
        $res[4][0][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.Yii::$app->user->identity->company->soato_id.'%" and sector=4)')->andWhere(['ranges'=>3])->count('*');

        foreach ($sec_4 as $item){
            $res[4][$item->id][3] = 4;
            $res[4][$item->id][4] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('homes');
            $res[4][$item->id][5] = VVillageFives::find()->where(['soato_id'=>$item->id])->sum('people');
            $res[4][$item->id][6] = VVillage::find()->where(['soato_id'=>$item->id])->count('*');
            $res[4][$item->id][7] = VVillage::find()->where(['soato_id'=>$item->id])->andWhere(['date'=>date('Y-m-d')])->count('*');

            $res[4][$item->id][8] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->groupBy('v_village_problem.village_id')->count('*');
            $res[4][$item->id][9] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['v_village.date'=>date('Y-m-d')])->count('*');

            $res[4][$item->id][10] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['>','v_village_problem.status_id',3])->count('*');
            $res[4][$item->id][11] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>1])->count('*');
            $res[4][$item->id][12] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>2])->count('*');
            $res[4][$item->id][13] = VVillageProblem::find()->innerJoin('v_village','v_village.id=v_village_problem.village_id')
                ->where(['v_village.soato_id'=>$item->id])->andWhere(['ranges'=>3])->count('*');

        }


        $res[0][0][1] = count($sec_1)+count($sec_2)+count($sec_3)+count($sec_4);
        $res[0][0][3] = "";
        $res[0][0][4] = $res[1][0][4] + $res[2][0][4] + $res[3][0][4] + $res[4][0][4];
        $res[0][0][5] = $res[1][0][5] + $res[2][0][5] + $res[3][0][5] + $res[4][0][5];
        $res[0][0][6] = $res[1][0][6] + $res[2][0][6] + $res[3][0][6] + $res[4][0][6];
        $res[0][0][7] = $res[1][0][7] + $res[2][0][7] + $res[3][0][7] + $res[4][0][7];
        $res[0][0][8] = $res[1][0][8] + $res[2][0][8] + $res[3][0][8] + $res[4][0][8];
        $res[0][0][9] = $res[1][0][9] + $res[2][0][9] + $res[3][0][9] + $res[4][0][9];
        $res[0][0][10] = $res[1][0][10] + $res[2][0][10] + $res[3][0][10] + $res[4][0][10];
        $res[0][0][11] = $res[1][0][11] + $res[2][0][11] + $res[3][0][11] + $res[4][0][11];
        $res[0][0][12] = $res[1][0][12] + $res[2][0][12] + $res[3][0][12] + $res[4][0][12];
        $res[0][0][13] = $res[1][0][13] + $res[2][0][13] + $res[3][0][13] + $res[4][0][13];

        return $this->render('statmfy',[
            'sec_1'=>$sec_1,
            'sec_2'=>$sec_2,
            'sec_3'=>$sec_3,
            'sec_4'=>$sec_4,
            'res'=>$res
        ]);

    }


    public function actionReport($rdate = null){
        if($rdate){
            $model = VVillage::find()->filterWhere(['like','soato_id',Yii::$app->user->identity->company->soato_id])->andWhere(['date'=>$rdate])->all();
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
            foreach ($model as $item){
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

        if(!($model = VVillageReport::findOne(Yii::$app->user->identity->company->soato_id))){
            $model = new VVillageReport();
            $model->soato_id = Yii::$app->user->identity->company->soato_id;
            $model->report_date = date('Y-m-d');
            $model->next_date = date('Y-m-d',strtotime(date('Y-m-d').' +1 day'));
        }

        if($model->load(Yii::$app->request->post())){
            echo "<pre>";
            var_dump($model);
            exit;
        }

        return $this->render('report',[
            'model'=>$model
        ]);
    }

    public function actionClosedate(){
        if($model = VVillageReport::findOne(Yii::$app->user->identity->company->soato_id)){
            $model->soato_id = Yii::$app->user->identity->company->soato_id;
            $model->report_date = date('Y-m-d');
            $model->next_date = date('Y-m-d',strtotime(date('Y-m-d').' +1 day'));
            $model->save();
        }else{
            $model = new VVillageReport();
            $model->soato_id = Yii::$app->user->identity->company->soato_id;
            $model->report_date = date('Y-m-d');
            $model->next_date = date('Y-m-d',strtotime(date('Y-m-d').' +1 day'));
            $model->save();
        }
        return $this->redirect(['report']);
    }
}
