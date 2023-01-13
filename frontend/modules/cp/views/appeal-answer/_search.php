<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\AppealAnswerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'appeal_id') ?>

    <?= $form->field($model, 'register_id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'preview') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'tarqatma_number') ?>

    <?php // echo $form->field($model, 'tarqatma_date') ?>

    <?php // echo $form->field($model, 'bajaruvchi_id') ?>

    <?php // echo $form->field($model, 'reaply_send') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_boshqa') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
