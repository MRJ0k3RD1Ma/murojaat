<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppealAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appeal-answer-form">

    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(['/site/answer','id'=>$model->register_id])]); ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Жўнатиш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
