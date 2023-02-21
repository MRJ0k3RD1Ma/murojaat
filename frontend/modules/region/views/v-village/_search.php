<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'sector') ?>

    <?= $form->field($model, 'soato_id') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'road') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'person_name') ?>

    <?php // echo $form->field($model, 'person_birthday') ?>

    <?php // echo $form->field($model, 'has_cl_problem') ?>

    <?php // echo $form->field($model, 'want_econom_energy') ?>

    <?php // echo $form->field($model, 'econom_energy_credit') ?>

    <?php // echo $form->field($model, 'econom_energy_own') ?>

    <?php // echo $form->field($model, 'econom_energy') ?>

    <?php // echo $form->field($model, 'want_credit') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'credit_women') ?>

    <?php // echo $form->field($model, 'credit_young') ?>

    <?php // echo $form->field($model, 'want_subsidy') ?>

    <?php // echo $form->field($model, 'subsidy_women') ?>

    <?php // echo $form->field($model, 'subsidy_young') ?>

    <?php // echo $form->field($model, 'subsidy') ?>

    <?php // echo $form->field($model, 'migrant') ?>

    <?php // echo $form->field($model, 'home_status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
