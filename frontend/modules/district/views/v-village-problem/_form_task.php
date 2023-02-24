<?php
use yii\widgets\ActiveForm;
/* @var $model \common\models\Appeal*/
?>
<?php $form = ActiveForm::begin()?>
    <?= $form->field($model,'person_name')->textInput()?>

    <?= $form->field($model,'date_of_birth')->textInput(['type'=>'date'])?>

    <?= $form->field($model,'gender')->dropDownList(Yii::$app->params['gender'],['prompt'=>'Жинсини танланг'])?>

    <?= $form->field($model,'address')->textInput()?>

    <?= $form->field($model,'person_phone')->textInput()?>

    <?= $form->field($model,'task_txt')->textInput()?>

    <?= $form->field($model, 'appeal_detail')->textarea(['rows' => 6]) ?>

    <button type="submit" class="btn btn-success">Жўнатиш</button>
<?php ActiveForm::end();?>
