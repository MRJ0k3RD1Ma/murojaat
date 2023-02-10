<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'sector')->textInput() ?>

    <?= $form->field($model, 'soato_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'road')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_birthday')->textInput() ?>

    <?= $form->field($model, 'has_cl_problem')->textInput() ?>

    <?= $form->field($model, 'want_econom_energy')->textInput() ?>

    <?= $form->field($model, 'econom_energy_credit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'econom_energy_own')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'econom_energy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'want_credit')->textInput() ?>

    <?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credit_women')->textInput() ?>

    <?= $form->field($model, 'credit_young')->textInput() ?>

    <?= $form->field($model, 'want_subsidy')->textInput() ?>

    <?= $form->field($model, 'subsidy_women')->textInput() ?>

    <?= $form->field($model, 'subsidy_young')->textInput() ?>

    <?= $form->field($model, 'subsidy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'migrant')->textInput() ?>

    <?= $form->field($model, 'home_status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
