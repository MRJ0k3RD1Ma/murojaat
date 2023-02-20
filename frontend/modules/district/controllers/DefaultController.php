<?php

namespace frontend\modules\district\controllers;

use common\models\MahallaView;
use common\models\VVillage;
use common\models\VVillageFives;
use common\models\VVillageProblem;
use common\models\VVillageProblemType;
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

        return $this->render('index');
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
}
