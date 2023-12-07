<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Appeal */
/* @var $register common\models\AppealRegister */
/* @var $form yii\widgets\ActiveForm */
?>

    <script>
        var deleteitem = function(){};
        var deletetashkilotitem = function(){};
        var tashkilotadd = function(){};
        var removetask = function(){};
    </script>
    <style>
        .buttonremovetask{
            margin-top:32px;
        }
    </style>
<div class="appeal-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="card card-primary card-outline">
        <div class="card-body" style="padding: 10px 20px;">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($register, 'number')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($register, 'date')->textInput(['type' => 'date']) ?>
                </div>
                <div class="col-md-6">
                    <?php
                    $quest = [];
                    foreach (\common\models\AppealQuestionGroup::find()->all() as $item) {
                        $quest[$item->code.'-'.$item->name] = [];
                        foreach ($item->question as $i){
                            $quest[$item->code.'-'.$item->name][$i->id] = $item->code.' '.$i->code.')'.$i->name;
                        }
                    }
                    ?>
                    <?= $form->field($model, 'question_id')->dropDownList($quest,['prompt'=>'Саволни танланг','class'=>'form-control js-select2']) ?>

                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title text-dark">
                        Мурожаатчи маълумотлари
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row label-none">
                        <div class="col-md-3">
                            <b>Ф.И.О</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'person_name')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                        <div class="col-md-3">
                            <b>Туғилган санаси</b>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date'])->label(false) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'gender')->dropDownList([0=>'Аёл',1=>'Эркак'],['prompt'=>'Жинсини танланг'])->label(false) ?>
                        </div>
                        <div class="col-md-3">
                            <b>Телефон</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'person_phone')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                        <div class="col-md-3">
                            <b>Ижтимоий ҳолати</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'employment_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Employment::find()->all(),'id','name'))->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 label-none">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title text-dark">
                        Мурожаатчи манзили
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Вилоятни танланг</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionView::find()->all(),'region_id','name_cyr'),['prompt'=>'Вилоятни танланг'])->label(false) ?>
                        </div>
                        <div class="col-md-3">
                            <b>Туманни танланг</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->region_id])->all(),'district_id','name_cyr'),['prompt'=>'Туманни танланг'])->label(false) ?>
                        </div>

                        <div class="col-md-3">
                            <b>Маҳаллани танланг</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MahallaView::find()->where(['region_id'=>$model->region_id,'district_id'=>$model->district_id])->all(),'id','name_cyr'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2'])->label(false) ?>
                        </div>

                        <div class="col-md-3">
                            <b>Манзилни киритинг</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="card card-primary card-outline xcard-collapsed collapsed-card">
        <div class="card-header card-outline">
            <h3 class="card-title text-dark">
                Бошқа ташкилотдан
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool bg-primary" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="padding: 10px 20px;display: none;">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot')->checkbox(['value'=>1,'style'=>'margin-top:35px;'])?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot_number')->textInput()?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'boshqa_tashkilot_date')->textInput(['type'=>'date'])?>
                </div>
                <?php   $tashkilot = [];
                foreach (\common\models\AppealBoshqaTashkilotGroup::find()->all() as $item) {
                    $tashkilot[$item->name] = [];
                    foreach ($item->tashkilotlar as $i){
                        $tashkilot[$item->name][$i->id] = $i->name;
                    }
                }
                ?>
                <div class="col-md-3">
                    <?= $form->field($model, 'boshqa_tashkilot_id')->dropDownList($tashkilot,['prompt'=>'Ташкилот гуруҳини танланг танланг','class'=>'form-control js-select2newdata']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title text-dark">
                        Мурожаат матни
                    </h3>
                    <div class="card-tools" style="height: 20px;">
                        <?= $form->field($model, 'isbusinessman')->checkbox(['value' => 1]) ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <?= $form->field($model, 'businessman',['options'=>['style'=>'display:none;margin-bottom: 20px;']])->textInput() ?>
                        </div>

                        <div class="col-md-3">
                            <b>Мурожаат шакли</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'appeal_shakl_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AppealShakl::find()->all(),'id','name'),['prompt'=>'Мурожаат шаклини танланг'])->label(false) ?>
                        </div>

                        <div class="col-md-3">
                            <b>Мурожаат тури</b>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'appeal_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AppealType::find()->all(),'id','name'),['prompt'=>'Мурожаат турини танланг'])->label(false) ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'count_applicant')->textInput(['type'=>'number']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'count_list')->textInput(['type'=>'number']) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'pursuit')->checkbox(['value' => 1,'style'=>'margin-top:0px;']) ?>

                    <?= $form->field($model, 'appeal_detail')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'appeal_file')->fileInput(['maxlength' => true]) ?>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-dark">
                                Резолюция
                            </h3>
                            <div class="card-tools" style="height: 20px;">
                                <?= $form->field($register, 'nazorat')->checkbox(['value' => 1,'checked'=>true]) ?>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <b>Раҳбарни танланг</b>
                                </div>
                                <div class="col-md-9">
                                    <?= $form->field($register,'rahbar_id')->dropDownList(
                                        \yii\helpers\ArrayHelper::map(\common\models\User::find()->select(['user.*'])
                                            ->where(['user.company_id'=>Yii::$app->user->identity->company_id])
                                            ->innerJoin('user_acces_item','(user_acces_item.user_id=user.id and user_acces_item.access_id=1)')
                                            ->all(),'id','name'),['prompt'=>'Раҳбарни танланг'])->label(false)?>
                                </div>

                                <div class="col-md-12">
                                    <?= $form->field($register, 'preview')->textarea(['maxlength' => true]) ?>
                                </div>


                                <div class="col-md-6">
                                    <?= $form->field($register,'deadline')->textInput(['type'=>'number'])?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($register,'deadtime')->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-md-2">
                                    <b>Ижрочи</b>
                                </div>
                                <div class="col-md-10">
                                    <?= $form->field($register,'ijrochi_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all(),'id','name'),['prompt'=>'Ижрочини танланг'])->label(false)?>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-dark">
                                Такрорий мурожаат маълумотлари
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <?= $form->field($register, 'takroriy')->checkbox(['value' => 1,'style'=>'margin-top:35px;']) ?>

                                </div>
                                <div class="col-md-5">

                                    <?= $form->field($register, 'takroriy_number')->textInput(['maxlength' => true,'disabled'=>true]) ?>
                                </div>
                                <div class="col-md-5">
                                    <?= $form->field($register, 'takroriy_date')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p><button class="btn btn-primary" id="buttontashkilot" type="button"><span class="fa fa-plus"></span> Topshiriq qo`shish</button></p>
                    <div id="tasks">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" id="users">

    </div>
    <div class="form-group">
        <?= Html::submitButton('Мурожаатни юбориш', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <!-- Modal -->
    <div id="modalhodim" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ҳодимлар рўйхати</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ФИО</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $users = \common\models\User::find()->where(['company_id'=>Yii::$app->user->identity->company_id])->all();


                                foreach ($users as $item):


                            ?>
                                <tr>
                                    <td><button type="button" value="<?= $item->id?>" class="btn btn-success buttonhodimadd btnid-<?=$item->id?>"><span class="fa fa-plus"></span></button></td>
                                    <td class="trhodimadd<?= $item->id?>"><?= $item->name ?></td>
                                </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="modaltashkilot" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ташкилотлар рўйхати</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered datatable_tashkilot">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Ташкилот номи</th>
                            <th>Директор</th>
                            <th>СТИР(ИНН)</th>
                        </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>


</div>

    <style>
        .table.table-hover.table-bordered.datatable_tashkilot.dataTable.no-footer{
            width: 100% !important;
        }
    </style>
<?php


$this->registerJs('
     $(document).ready(function() {

            $(\'.datatable_tashkilot\').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url":"/get/tasktashkilot",
                    "type":"post"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "director" },
                    { "data": "inn" }
                ],
            });


        $(".js-select2newdata").select2({
                escapeMarkup: function (markup) { return markup; },

         language: {
            "noResults": function() {
              return \'<a id="newData" href="#" class="btn btn-xs btn-success">Янги ташкилот қўшиш</a>\';
            }
          },
        });
    });
    $(document).on(\'click\', \'#newData\', function() {
      var $select2 = $(".js-select2newdata");      
      var newStateVal = $select2.siblings("span.select2-container").find("input.select2-search__field").val();
      //Get the new value.
      if ($select2.find("option[value=" + newStateVal + "]").length) { //if already present just select it
          $select2.val(newStateVal).trigger("change");
      } else {
          // Create the DOM option that is pre-selected by default
          var newState = new Option(newStateVal, newStateVal, true, true);
          // Append it to the select
          $select2.append(newState).trigger(\'change\');
          $select2.select2(\'close\');
      }
});

$("#appeal-isbusinessman").change(function(){
    if($("#appeal-isbusinessman").is(":checked")){
        $(".field-appeal-businessman").show();
    }else{
        $(".field-appeal-businessman").hide();
    }
})
$("#appealregister-deadline").change(function(){
    
    var today = new Date($("#appealregister-date").val());
    var res = new Date();
//    res.setDate( today.getDate() + $("#appealregister-deadline").val() );
    var day= new Date(today.getFullYear(),today.getMonth(), today.getDate() + parseInt($("#appealregister-deadline").val()) );
//    alert(day);
    res = day;
//    alert(res);
    $("#appealregister-deadtime").val(res.getFullYear()+"-"+("0"+(res.getMonth()+1)).slice(-2)+"-"+("0"+res.getDate()).slice(-2));
    
});
$("#appealregister-date").change(function(){
    
    var today = new Date($("#appealregister-date").val());
    var res = new Date();
//    res.setDate( today.getDate() + $("#appealregister-deadline").val() );
    var day= new Date(today.getFullYear(),today.getMonth(), today.getDate() + parseInt($("#appealregister-deadline").val()) );
//    alert(day);
    res = day;
//    alert(res);
    $("#appealregister-deadtime").val(res.getFullYear()+"-"+("0"+(res.getMonth()+1)).slice(-2)+"-"+("0"+res.getDate()).slice(-2));
    
});

$("#buttonhodim").click(function(){
    $("#modalhodim").modal();
});

$("#buttontashkilot").click(function(){
    $("#modaltashkilot").modal();
});

$(".buttonhodimadd").click(function(){
    var id=this.value;
    var res = "<tr id=\"u"+id+"\"><td><button value=\"" + id + "\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteitem(\'"+id+"\')\"><span class=\"fa fa-trash\"></span></button></td><td>"+$(".trhodimadd"+id).text()+"</td></tr>"
    $("#tablehomditashkilot").append(res);
    this.disabled = true;
    $("#users").append("<input type=\"text\" id=\"userid-"+id+"\" name=\"AppealRegister[users][]\" value=\""+id+"\">");
    $("#appealregister-ijrochi_id").append("<option value=\""+id+"\">"+$(".trhodimadd"+id).text()+"</option>");
});

$(".buttontashkilotadd").click(function(){
    var id = this.value;
});
tashkilotadd = function(id,name){
    if($("#appeal-task-company-"+id+"-name").length){
        console.log(1);
    }else{
        var res = \'<div class="row" id="task-\'+id+\'"><div class="col-md-4"><div class="form-group field-appeal-task-company-\'+id+\'-name"><label class="control-label" for="appeal-task-company-\'+id+\'-name">Ташкилот номи</label><input type="text" id="appeal-task-company-\'+id+\'-name" disabled value="\'+name+\'" class="form-control" name="Appeal[task][company][\'+id+\'][name]"></div></div><div class="col-md-7"><div class="form-group field-appeal-task-company-\'+id+\'-task"><label class="control-label" for="appeal-task-company-\'+id+\'-task">Топшириқ матни</label><input type="text" id="appeal-task-company-\'+id+\'-task" value="Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин." class="form-control" name="Appeal[task][company][\'+id+\'][task]"></div></div><div class="col-md-1"><button class="btn btn-danger form-control buttonremovetask" type="button" onclick="removetask(\'+id+\')"><span class="fa fa-trash"></span></button></div></div>\';
        
        $("#tasks").append(res);
    }
    
}
removetask = function(id){
    $("#task-"+id).remove();
}

deleteitem = function(id){
    $("#u"+id).remove();
    $("#userid-"+id).remove();
    $(".btnid-"+id).attr("disabled",false);
    $("#appealregister-ijrochi_id option[value=\""+id+"\"]").remove();
}
deletetashkilotitem = function(id){
    $("#t"+id).remove();
    $("#tashkilotid-"+id).remove();
}
$(".deluser").click(function(){
    var id = this.value;
    alert(id);
    $("#u"+id).remove();
})


');
$this->registerJs("
    $('#appeal-region_id').change(function(){
        $.get('/get/district?id='+$('#appeal-region_id').val()).done(function(data){
            $('#appeal-district_id').empty();
            $('#appeal-district_id').append(data);
        })
    });
    $('#appeal-district_id').change(function(){
        $.get('/get/village?id='+$('#appeal-district_id').val()+'&region_id='+$('#appeal-region_id').val()).done(function(data){
            $('#appeal-soato_id').empty();
            $('#appeal-soato_id').append(data).trigger('change');
        })
    })
")
?>


<?php if(false){?>

<div class="row" id="task-\'+id+\'"><div class="col-md-5"><div class="form-group field-appeal-task-company-\'+id+\'-name"><label class="control-label" for="appeal-task-company-\'+id+\'-name">Ташкилот номи</label><input type="text" id="appeal-task-company-\'+id+\'-name" value="\'+name+\'" class="form-control" name="Appeal[task][company][\'+id+\'][name]"></div></div><div class="col-md-6"><div class="form-group field-appeal-task-company-\'+id+\'-task"><label class="control-label" for="appeal-task-company-\'+id+\'-task">Топшириқ матни</label><input type="text" id="appeal-task-company-\'+id+\'-task" value="Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин." class="form-control" name="Appeal[task][company][\'+id+\'][task]"></div></div><div class="col-md-1"><button class="btn btn-danger form-control buttonremovetask" type="button" onclick="removetask(\'+id+\')"><span class="fa fa-trash"></span></button></div></div>

<?php }?>
