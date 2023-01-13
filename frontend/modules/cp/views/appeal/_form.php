<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Appeal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pursuit')->textInput() ?>

    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_jshshir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'soato_id')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'businessman')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbusinessman')->textInput() ?>

    <?= $form->field($model, 'appeal_preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'appeal_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'appeal_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question_id')->textInput() ?>

    <?= $form->field($model, 'executor_files')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'appeal_file_extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appeal_type_id')->textInput() ?>

    <?= $form->field($model, 'appeal_shakl_id')->textInput() ?>

    <?= $form->field($model, 'appeal_control_id')->textInput() ?>

    <?= $form->field($model, 'count_applicant')->textInput() ?>

    <?= $form->field($model, 'count_list')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'deadtime')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'boshqa_tashkilot')->textInput() ?>

    <?= $form->field($model, 'boshqa_tashkilot_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'boshqa_tashkilot_date')->textInput() ?>

    <?= $form->field($model, 'boshqa_tashkilot_id')->textInput() ?>

    <?= $form->field($model, 'answer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_preview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer_reply_send')->textInput() ?>

    <?= $form->field($model, 'answer_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_date')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'register_id')->textInput() ?>

    <?= $form->field($model, 'register_company_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'number_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employment_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
