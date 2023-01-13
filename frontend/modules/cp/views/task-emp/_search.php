<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\TaskEmpSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-emp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sender_id') ?>

    <?= $form->field($model, 'reciever_id') ?>

    <?= $form->field($model, 'register_id') ?>

    <?= $form->field($model, 'appeal_id') ?>

    <?= $form->field($model, 'deadtime') ?>

    <?php // echo $form->field($model, 'task') ?>

    <?php // echo $form->field($model, 'letter') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
