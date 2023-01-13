<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\AppealSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pursuit') ?>

    <?= $form->field($model, 'passport') ?>

    <?= $form->field($model, 'passport_jshshir') ?>

    <?= $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'person_name') ?>

    <?php // echo $form->field($model, 'person_phone') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'soato_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'businessman') ?>

    <?php // echo $form->field($model, 'isbusinessman') ?>

    <?php // echo $form->field($model, 'appeal_preview') ?>

    <?php // echo $form->field($model, 'appeal_detail') ?>

    <?php // echo $form->field($model, 'appeal_file') ?>

    <?php // echo $form->field($model, 'question_id') ?>

    <?php // echo $form->field($model, 'executor_files') ?>

    <?php // echo $form->field($model, 'appeal_file_extension') ?>

    <?php // echo $form->field($model, 'appeal_type_id') ?>

    <?php // echo $form->field($model, 'appeal_shakl_id') ?>

    <?php // echo $form->field($model, 'appeal_control_id') ?>

    <?php // echo $form->field($model, 'count_applicant') ?>

    <?php // echo $form->field($model, 'count_list') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'deadtime') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'boshqa_tashkilot') ?>

    <?php // echo $form->field($model, 'boshqa_tashkilot_number') ?>

    <?php // echo $form->field($model, 'boshqa_tashkilot_date') ?>

    <?php // echo $form->field($model, 'boshqa_tashkilot_id') ?>

    <?php // echo $form->field($model, 'answer_name') ?>

    <?php // echo $form->field($model, 'answer_file') ?>

    <?php // echo $form->field($model, 'answer_preview') ?>

    <?php // echo $form->field($model, 'answer_detail') ?>

    <?php // echo $form->field($model, 'answer_reply_send') ?>

    <?php // echo $form->field($model, 'answer_number') ?>

    <?php // echo $form->field($model, 'answer_date') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'register_id') ?>

    <?php // echo $form->field($model, 'register_company_id') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'number_full') ?>

    <?php // echo $form->field($model, 'employment_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
