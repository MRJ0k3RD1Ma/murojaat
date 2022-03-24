<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'layout' => 'horizontal',
                                    'fieldConfig' => [
                                        'template' => "{label}\n{input}\n{error}",
                                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                                    ],
                                    'options'=>['class'=>'user']
                                ]); ?>

                                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'form-control form-control-user'])->label(false) ?>

                                <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control form-control-user'])->label(false) ?>

                                <?= $form->field($model, 'rememberMe')->checkbox([
                                        'class'=>'custom-control custom-checkbox small','id'=>'customCheck'
                                ])->label('Eslab qolish',['class'=>'','for'=>'customCheck']) ?>

                                <div class="form-group">
                                    <div class="offset-lg-1 col-lg-11">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>
                                </div>

                                <?php ActiveForm::end(); ?>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="#">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
