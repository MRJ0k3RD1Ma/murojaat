<?php

namespace frontend\modules\district\controllers;

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
}
