<?php

namespace frontend\controllers;

use common\models\LocDistricts;
use common\models\LocVillages;
use Yii;
use yii\web\Controller;

use yii\filters\AccessControl;


/**
 * Site controller
 */
class GetController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    public function actionDistrict($id){
        $model = LocDistricts::find()->where(['region_id'=>$id])->all();
        $res = "<option value=''>- Туманни танланг -</option>";
        foreach ($model as $item){
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        return $res;
    }
    public function actionVillage($id){
        $model = LocVillages::find()->where(['district_id'=>$id])->all();
        $res = "<option value=''>- Маҳаллани танланг -</option>";
        foreach ($model as $item){
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        return $res;
    }
}
