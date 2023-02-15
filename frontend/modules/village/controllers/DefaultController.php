<?php

namespace frontend\modules\village\controllers;

use common\models\VVillageProblem;
use common\models\VVillageProblemType;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `village` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = VVillageProblemType::find()->all();
        $prob = [];
        $prob[0][0] = VVillageProblem::find()->where('id in (select id from v_village where soato_id = '.Yii::$app->user->identity->company->soato_id.')')->count('*');
        $prob[0][1] = 100;
        $prob[0][2] = VVillageProblem::find()->where('id in (select id from v_village where soato_id = '.Yii::$app->user->identity->company->soato_id.')')->andWhere(['>','status_id',3])->count('*');

        foreach ($model as $item){
            $prob[$item->id][0] = VVillageProblem::find()->where('id in (select id from v_village where soato_id = '.Yii::$app->user->identity->company->soato_id.')')->andWhere(['type_id'=>$item->id])->count('*');
            $prob[$item->id][1] = $prob[$item->id][0] / $prob[0][0] * 100;
            $prob[$item->id][2] = VVillageProblem::find()->where('id in (select id from v_village where soato_id = '.Yii::$app->user->identity->company->soato_id.')')->andWhere(['>','status_id',3])->andWhere(['type_id'=>$item->id])->count('*');
        }
        return $this->render('index',[
            'model'=>$model,
            'prob'=>$prob
        ]);
    }
}
