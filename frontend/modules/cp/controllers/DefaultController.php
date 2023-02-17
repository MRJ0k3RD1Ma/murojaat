<?php

namespace frontend\modules\cp\controllers;

use common\models\DistrictView;
use common\models\MahallaView;
use common\models\RegionView;
use common\models\Soato;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `cp` module
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

    public function actionSector($id = 0){
        $region = DistrictView::find()->where('id like "%1733%"')->all();

        return $this->render('sector',[
            'region'=>$region,
            'id'=>$id
        ]);

    }

    public function actionSetsector($id,$val){
        if($model = Soato::findOne($id)){
            $model->sector = $val;
            $model->save();
            return 'saqlandi';
        }
        return "mahalla topilmadi";
    }

}
