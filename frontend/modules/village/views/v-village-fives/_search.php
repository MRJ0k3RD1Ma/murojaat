<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageFivesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-fives-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'mfy_rais') ?>

    <?= $form->field($model, 'profilaktika_inspektor') ?>

    <?= $form->field($model, 'hokim_yordamchi') ?>

    <?php // echo $form->field($model, 'xotin_qizlar') ?>

    <?php // echo $form->field($model, 'yoshlar_yetakchi') ?>

    <?php // echo $form->field($model, 'deputat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
