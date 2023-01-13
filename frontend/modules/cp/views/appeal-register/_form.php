<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AppealRegister $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-register-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'question_id')->textInput() ?>

    <?= $form->field($model, 'appeal_id')->textInput() ?>

    <?= $form->field($model, 'rahbar_id')->textInput() ?>

    <?= $form->field($model, 'ijrochi_id')->textInput() ?>

    <?= $form->field($model, 'users')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tashkilot')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tashkilot_answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_bajaruvchi_id')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'deadtime')->textInput() ?>

    <?= $form->field($model, 'donetime')->textInput() ?>

    <?= $form->field($model, 'control_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'reply_send')->textInput() ?>

    <?= $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'answer_send')->textInput() ?>

    <?= $form->field($model, 'nazorat')->textInput() ?>

    <?= $form->field($model, 'takroriy')->textInput() ?>

    <?= $form->field($model, 'takroriy_id')->textInput() ?>

    <?= $form->field($model, 'takroriy_date')->textInput() ?>

    <?= $form->field($model, 'takroriy_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
