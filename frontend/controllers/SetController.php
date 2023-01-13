<?php

namespace frontend\controllers;


use common\models\CompanyType;
use common\models\District;
use common\models\KasanachiTutzorSxema;
use common\models\Village;
use yii\web\Controller;


class SetController extends Controller
{
    public function actionAppeal(){
        var_dump($_SERVER['previous_location']);
        exit;
    }
}
