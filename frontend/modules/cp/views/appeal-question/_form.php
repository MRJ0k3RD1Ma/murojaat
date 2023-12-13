<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AppealQuestion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appeal-question-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        $data =[];
        foreach (\common\models\AppealQuestionGroup::find()->all() as $item){
            $data[$item->id] = $item->code.'-'.$item->name;
        }
    ?>
    <?= $form->field($model, 'group_id')->dropDownList($data) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
