<?php

namespace frontend\controllers;


use common\models\CompanyType;
use yii\web\Controller;


class SetController extends Controller
{
    public function actionAppeal(){
        var_dump($_SERVER['previous_location']);
        exit;
    }
}
