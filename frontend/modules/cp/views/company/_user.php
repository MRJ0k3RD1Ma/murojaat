<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'role_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\UserRole::find()->all(),'id','name')) ?>


        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'bulim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Bulim::find()->all(),'id','name')) ?>

            <?= $form->field($model, 'lavozim_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Lavozim::find()->all(),'id','name')) ?>

            <h4 class="card-title">Foydalanuvchi ruhsatlari</h4>
            <br>
            <?php foreach (\common\models\UserAccess::find()->all() as $item):
                $p = false;
                if($true = \common\models\UserAccesItem::findOne(['user_id'=>$model->id,'access_id'=>$item->id])){
                    $p = true;
                }
                ?>

                <?= $form->field($model, 'access['.$item->id.']')->checkbox(['value' => 1,'checked'=>$p])->label($item->name) ?>

            <?php endforeach;?>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

