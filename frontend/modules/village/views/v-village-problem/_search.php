<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageProblemSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-problem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'village_id') ?>

    <?= $form->field($model, 'kinship') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
