<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VVillageFives $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-fives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mfy_rais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profilaktika_inspektor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hokim_yordamchi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xotin_qizlar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yoshlar_yetakchi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deputat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sector')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
