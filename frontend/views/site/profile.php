<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->user->identity->name.' маълумотлари';
$this->params['breadcrumbs'][] = $this->title;
$userid = Yii::$app->user->identity->id;
echo Yii::$app->user->identity->name;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row register-form">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-success" style="margin-top:30px;" value="Сақлаш"/>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
