<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\AppealRegisterSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-register-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'question_id') ?>

    <?= $form->field($model, 'appeal_id') ?>

    <?php // echo $form->field($model, 'rahbar_id') ?>

    <?php // echo $form->field($model, 'ijrochi_id') ?>

    <?php // echo $form->field($model, 'users') ?>

    <?php // echo $form->field($model, 'user_answer') ?>

    <?php // echo $form->field($model, 'tashkilot') ?>

    <?php // echo $form->field($model, 'tashkilot_answer') ?>

    <?php // echo $form->field($model, 'parent_bajaruvchi_id') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'deadtime') ?>

    <?php // echo $form->field($model, 'donetime') ?>

    <?php // echo $form->field($model, 'control_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'reply_send') ?>

    <?php // echo $form->field($model, 'preview') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'answer_send') ?>

    <?php // echo $form->field($model, 'nazorat') ?>

    <?php // echo $form->field($model, 'takroriy') ?>

    <?php // echo $form->field($model, 'takroriy_id') ?>

    <?php // echo $form->field($model, 'takroriy_date') ?>

    <?php // echo $form->field($model, 'takroriy_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
