<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TaskEmp $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-emp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender_id')->textInput() ?>

    <?= $form->field($model, 'reciever_id')->textInput() ?>

    <?= $form->field($model, 'register_id')->textInput() ?>

    <?= $form->field($model, 'appeal_id')->textInput() ?>

    <?= $form->field($model, 'deadtime')->textInput() ?>

    <?= $form->field($model, 'task')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'letter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
