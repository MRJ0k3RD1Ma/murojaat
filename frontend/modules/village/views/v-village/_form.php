<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vvillage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'sector')->dropDownList(Yii::$app->params['sector']) ?>

    <?= $form->field($model, 'road')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_birthday')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'person_phone')->textInput() ?>

    <?= $form->field($model, 'home_status_id')->radioList(\yii\helpers\ArrayHelper::map(\common\models\VHomeStatus::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'has_cl_problem')->radioList(Yii::$app->params['has_cl_problem']) ?>

    <?= $form->field($model, 'want_econom_energy')->radioList(Yii::$app->params['want_econom_energy']) ?>

    <?= $form->field($model, 'econom_energy_credit')->textInput(['maxlength' => true])->label('Кредит ҳисобидан') ?>

    <?= $form->field($model, 'econom_energy_own')->textInput(['maxlength' => true])->label('Ўз маблағлари ҳисобидан') ?>

    <?= $form->field($model, 'econom_energy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'want_credit')->textInput() ?>

    <?= $form->field($model, 'credit_women')->textInput()->label('Шундан, Аёллар') ?>

    <?= $form->field($model, 'credit_young')->textInput()->label('Шундан, Ёшлар') ?>
    <?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'want_subsidy')->radioList(Yii::$app->params['want_subsidy']) ?>

    <?= $form->field($model, 'subsidy_women')->textInput()->label('Шундан, Аёллар') ?>

    <?= $form->field($model, 'subsidy_young')->textInput()->label('Шундан, Ёшлар') ?>

    <?= $form->field($model, 'subsidy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'migrant')->textInput() ?>

    <div id="migs" data-key="0">
        <h3 class="card-title">Хонадон вакилидан четда (ишлаш ёки ўқиш мақсадида) юрганлар рўйхати </h3>
        <br>
        <div class="row key-0">
            <div class="col-sm-6">
                <label class="control-label" style="width: 100%">ФИО
                    <input type="text" class="form-control" name="VVillage[mig][0][name]">
                </label>
            </div>
            <div class="col-sm-6">
                <label class="control-label" style="width: 100%">Туғилган санаси
                    <input type="date" class="form-control active" id='mig-0' name="VVillage[mig][0][birthday]">
                </label>
            </div>
        </div>
    </div>
    <button class="btn btn-info" type="button" id="addmigrant"><span class="fa fa-plus"></span> Мигрант қўшиш</button>
    <br>
    <div id="problems" data-key="0">
        <h3 class="card-title">Хонадонда аниқланган муаммолар</h3>   <br>
        <p style="font-style: italic">(Агар ўрганилган хонадонда муаммо аниқланмаса ушбу қисм тўлдирилмайди, бунда
            “Аниқланган муаммо мазмуни” устунидаги бўш қаторлардан бирига
            “муаммо мавжуд эмас” деб бир марта ёзилади)</p>

        <div class='row'>
            <div class='col-sm-6'>
                <label style='width: 100%' class='control-label'>Қариндошлиги<input type='text' class='form-control' name='VVillage[problems][0][kinship]'></label>
            </div>
            <div class='col-sm-6'>
                <label style='width: 100%' class='control-label'>Йил<input type='number' class='form-control' name='VVillage[problems][0][year]'></label>
            </div>
            <div class='col-sm-12'>
                <label style='width: 100%' class='control-label'>Муаммо мазмуни<textarea type='text' class='form-control' name='VVillage[problems][0][detail]'></textarea></label>
            </div>
        </div>
    </div>
    <button class="btn btn-info" type="button" id="addproblem"><span class="fa fa-plus"></span> Муамми қўшиш</button>
    <br>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




<?php

$this->registerJs("
        $('#addmigrant').click(function(){
            var key = $('#migs').attr('data-key');
            key++;
            var append = \"<div class='row'><div class='col-sm-6'><label class='control-label' style='width: 100%'>ФИО<input type='text' id='vvillage-mig-name' class='form-control' name='VVillage[mig][\"+key+\"][name]'></label></div><div class='col-sm-6'><label class='control-label' style='width: 100%'>Туғилган санаси<input type='date' id='mig\"+key+\"' class='form-control' name='VVillage[mig][\"+key+\"][birthday]'></label></div></div>\"
            $('#migs').append(append);
            $('#migs').attr('data-key',key);
        });
        $('#addproblem').click(function(){
            var key = $('#problems').attr('data-key');
            key++;
            var append = \"<div class='row'><div class='col-sm-6'><label style='width: 100%' class='control-label'>Қариндошлиги<input type='text' class='form-control' name='VVillage[problems][\"+key+\"][kinship]'></label></div><div class='col-sm-6'><label style='width: 100%' class='control-label'>Йил<input type='number' class='form-control' name='VVillage[problems][\"+key+\"][year]'></label></div><div class='col-sm-12'><label style='width: 100%' class='control-label'>Муаммо мазмуни<textarea type='text' class='form-control' name='VVillage[problems][\"+key+\"][detail]'></textarea></label></div></div>\"
            $('#problems').append(append);
        });
    ")
?>
