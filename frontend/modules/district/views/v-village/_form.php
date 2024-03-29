<?php

use common\models\VVillageProblemType;
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

    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionView::find()->all(),'region_id','name_cyr'),['prompt'=>'Вилоятни танланг']) ?>
    <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->region_id])->all(),'district_id','name_cyr'),['prompt'=>'Туманни танланг']) ?>
    <?= $form->field($model, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MahallaView::find()->where(['region_id'=>$model->region_id,'district_id'=>$model->district_id])->all(),'id','name_cyr'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2']) ?>

    <?= $form->field($model, 'road')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(Yii::$app->params['gender']) ?>

    <?= $form->field($model, 'person_birthday')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'person_phone')->textInput() ?>

    <?= $form->field($model, 'home_status_id')->radioList(\yii\helpers\ArrayHelper::map(\common\models\VHomeStatus::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'has_cl_problem')->radioList(Yii::$app->params['has_cl_problem']) ?>

    <?= $form->field($model, 'want_econom_energy')->radioList(Yii::$app->params['want_econom_energy']) ?>

  <div id="want-econom-energy" style="display: none; margin-left:10px; border-left:1px solid #007bff; padding-left:10px;">

      <?= $form->field($model, 'econom_energy_credit')->checkbox(['value' => 1])->label('Кредит ҳисобидан') ?>

      <?= $form->field($model, 'econom_energy_own')->checkbox(['value' => 1])->label('Ўз маблағлари ҳисобидан') ?>

      <?= $form->field($model, 'econom_energy')->textInput(['maxlength' => true]) ?>

  </div>

    <?= $form->field($model, 'is_want_credit')->radioList(Yii::$app->params['is_want_credit']) ?>

    <div id="want-credit" style="display: none; margin-left:10px; border-left:1px solid #007bff; padding-left:10px;">
        <?= $form->field($model, 'want_credit')->textInput() ?>

        <?= $form->field($model, 'credit_women')->textInput()->label('Шундан, Аёллар') ?>

        <?= $form->field($model, 'credit_young')->textInput()->label('Шундан, Ёшлар') ?>
        <?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'want_subsidy')->radioList(Yii::$app->params['want_subsidy']) ?>
    <div id="want-subsidy" style="display: none; margin-left:10px; border-left:1px solid #007bff; padding-left:10px;">

        <?= $form->field($model, 'subsidy_women')->textInput()->label('Шундан, Аёллар') ?>

        <?= $form->field($model, 'subsidy_young')->textInput()->label('Шундан, Ёшлар') ?>

        <?= $form->field($model, 'subsidy')->textInput(['maxlength' => true]) ?>
    </div>
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
            <?php
            $m = \common\models\VPersonMigrantWhy::find()->all();
            $res = "<div class='col-sm-12'><label class='control-label' style='width: 100%'>Сабаб<select class='form-control' name='VVillage[mig][0][why_id]'>";
            foreach ($m as $item){
                $res .= "<option value='{$item->id}'>{$item->name}</option>";
            }
            $res .= "</select></label></div>";
            echo $res; ?>
        </div>
    </div>

    <button class="btn btn-info" type="button" id="addmigrant"><span class="fa fa-plus"></span> Мигрант қўшиш</button>
    <br>
    <div id="problems" data-key="0">
        <h3 class="card-title">Хонадонда аниқланган муаммолар</h3>  <br>
        <div class='row key-0'>
            <div class='col-sm-12'>
                <label style='width: 100%' class='control-label'>ФИО<input type='text' class='form-control' name='VVillage[problems][0][name]'></label>
            </div>
            <div class='col-sm-6'>
                <label style='width: 100%' class='control-label'>Қариндошлиги<input type='text' class='form-control' name='VVillage[problems][0][kinship]'></label>
            </div>
            <div class='col-sm-6'>
                <label style='width: 100%' class='control-label'>Йил<input type='number' class='form-control' name='VVillage[problems][0][year]'></label>
            </div>
            <div class='col-sm-12'>
                <label style='width: 100%' class='control-label'>Муаммо мазмуни<textarea type='text' class='form-control' name='VVillage[problems][0][detail]'></textarea></label>
            </div>
            <?php
            $model = VVillageProblemType::find()->all();
            $res = "<div class='col-sm-12'><label class='control-label' style='width: 100%'>Муаммо коди<select class='form-control' name='VVillage[problems][0][type_id]'>";
            foreach ($model as $item){
                $res .= "<option value='{$item->id}'>{$item->code} - {$item->name}</option>";
            }
            $res .= "</select></label></div>";
            echo $res;
            ?>
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
$url = Yii::$app->urlManager->createUrl(['/village/v-village/getwhy']);
$url_type = Yii::$app->urlManager->createUrl(['/village/v-village/gettype']);
$this->registerJs("
        $('#addmigrant').click(function(){
            var key = $('#migs').attr('data-key');
            key++;
            var append = \"<div class='row key-\"+key+\"'><div class='col-sm-6'><label class='control-label' style='width: 100%'>ФИО<input type='text' id='vvillage-mig-name' class='form-control' name='VVillage[mig][\"+key+\"][name]'></label></div><div class='col-sm-6'><label class='control-label' style='width: 100%'>Туғилган санаси<input type='date' id='mig\"+key+\"' class='form-control' name='VVillage[mig][\"+key+\"][birthday]'></label></div></div>\"
      
            $('#migs').append(append);
             $.get('{$url}?key='+key).done(function(data){
                $('.row.key-'+key).append(data);
            });
            $('#migs').attr('data-key',key);
        });
        $('#addproblem').click(function(){
            var key = $('#problems').attr('data-key');
            key++;
            var append = \"<div class='row prob key-\"+key+\"'><div class='col-sm-6'><label style='width: 100%' class='control-label'>ФИО<input type='text' class='form-control' name='VVillage[problems][\"+key+\"][name]'></label></div><div class='col-sm-6'><label style='width: 100%' class='control-label'>Қариндошлиги<input type='text' class='form-control' name='VVillage[problems][\"+key+\"][kinship]'></label></div><div class='col-sm-6'><label style='width: 100%' class='control-label'>Йил<input type='number' class='form-control' name='VVillage[problems][\"+key+\"][year]'></label></div><div class='col-sm-12'><label style='width: 100%' class='control-label'>Муаммо мазмуни<textarea type='text' class='form-control' name='VVillage[problems][\"+key+\"][detail]'></textarea></label></div></div>\"
            $('#problems').append(append);
             $.get('{$url_type}?key='+key).done(function(data){
                $('.prob.row.key-'+key).append(data);
            });
            $('#problems').attr('data-key',key);
        });
        
        $('input[name=\"VVillage[want_econom_energy]\"]').change(function(){
            var val = this.value;
            if(val == 1){
                $('#want-econom-energy').show();
            }else{
                $('#want-econom-energy').hide();
            }
        });
        $('input[name=\"VVillage[is_want_credit]\"]').change(function(){
            var val = this.value;
            if(val == 1){
                $('#want-credit').show();
            }else{
                $('#want-credit').hide();
            }
        });
        $('input[name=\"VVillage[want_subsidy]\"]').change(function(){
            var val = this.value;
            if(val == 1){
                $('#want-subsidy').show();
            }else{
                $('#want-subsidy').hide();
            }
        });
    ");

$this->registerJs("
    $('#vvillage-region_id').change(function(){
        $.get('/get/district?id='+$('#vvillage-region_id').val()).done(function(data){
            $('#vvillage-district_id').empty();
            $('#vvillage-district_id').append(data);
        })
    });
    $('#vvillage-district_id').change(function(){
        $.get('/get/village?id='+$('#vvillage-district_id').val()+'&region_id='+$('#vvillage-region_id').val()).done(function(data){
            $('#vvillage-soato_id').empty();
            $('#vvillage-soato_id').append(data).trigger('change');
        })
    })
")
?>
