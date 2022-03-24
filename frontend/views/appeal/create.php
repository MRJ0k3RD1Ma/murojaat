<?php

use yii\base\BaseObject;
use yii\widgets\ActiveForm;
/*
 *     $model = new Appeal();
       $send = new AppealSend();
        $register = new Register();
 * */
/* @var $model \common\models\Appeal*/
/* @var $send \common\models\AppealSend*/
/* @var $register \common\models\Register*/
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Мурожаат қўшиш</h1>
<?php $form = ActiveForm::begin()?>
<div class="row">
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                                        <span class="float-right">
                                            <input type="checkbox" id="appealregister-takroriy" value="1"> &nbsp;Такрорий мурожаат
                                        </span>
                    Янги мурожаат қўшиш</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model,'number_full')->textInput(['value'=>$model->number])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model,'date')->textInput(['type'=>'date'])?>
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
                        <?= $form->field($model,'question_id')->dropDownList($quest,['prompt'=>'Саволни танланг','class'=>'form-control select2list'])?>
                    </div>
                </div>
                <?= $form->field($model,'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LocRegions::find()->all(),'id','name'),['prompt'=>'Вилоятни танланг'])?>
                <?= $form->field($model,'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LocDistricts::find()->where(['region_id'=>$model->region_id])->all(),'id','name'),['prompt'=>'Туманни танланг'])?>
                <?= $form->field($model,'village_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LocVillages::find()->where(['district_id'=>$model->district_id])->all(),'id','name'),['prompt'=>'Маҳаллани танланг'])?>

                <?= $form->field($model,'address')->textInput()?>

            </div>
        </div>
        <!-- Basic Card Example -->
    </div>
    <div class="col-lg-6">

        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Умумий маълумотлар</h6> </div>
            <div class="card-body">
                <?= $form->field($model,'name')->textInput()?>
                <?= $form->field($model,'birthday')->textInput(['type'=>'date'])?>
                <?= $form->field($model,'gender')->dropDownList([0=>'Аёл',1=>'Эркак',2=>'Номалум'],['prompt'=>'Жинсини танланг'])?>
                <?= $form->field($model,'phone')->textInput()?>
                <?= $form->field($model,'employment_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Employment::find()->all(),'id','name'),['prompt'=>'Фуқаро тоифасини танланг'])?>
            </div>
        </div>
        <!-- Basic Card Example -->

    </div>


    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Бошқа ташкилотдан</h6> </a>
            <!-- Card Content - Collapse -->
            <div class="collapse" id="collapseCardExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($model,'other')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model,'other_number')->textInput()?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model,'other_date')->textInput(['type'=>'date'])?>
                        </div>
                        <div class="col-md-4">
                            <?php   $tashkilot = [];
                            foreach (\common\models\AppealBoshqaTashkilotGroup::find()->all() as $item) {
                                $tashkilot[$item->name] = [];
                                foreach ($item->tashkilotlar as $i){
                                    $tashkilot[$item->name][$i->id] = $i->name;
                                }
                            }
                            ?>
                            <?= $form->field($model,'other_id')->dropDownList($tashkilot,['prompt'=>'Ташкилотни танланг'])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Мурожаат матни
                        </h6>
                    </div>
                    <div class="card-body">
                        <?= $form->field($model,'shakl_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AppealShakl::find()->all(),'id','name'),['prompt'=>'Мурожаат шаклини танланг'])?>

                        <?= $form->field($model,'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AppealType::find()->all(),'id','name'),['prompt'=>'Мурожаат турини танланг'])?>
                        <?= $form->field($model,'is_juridical')->checkbox(['value'=>1]) ?>
                        <?= $form->field($model,'business')->textInput()?>
                        <?= $form->field($model,'count_page')->textInput(['type'=>'number'])?>

                    </div>
                </div>
            </div>


            <div class="col-lg-6">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Мурожаат матни</h6>
                    </div>
                    <div class="card-body">

                        <?= $form->field($model,'detail')->textarea(['rows'=>6]) ?>

                        <?= $form->field($model,'file')->fileInput()?>
                    </div>
                </div>

            </div>


        </div>

        <div class="row">
            <div class="col-md-12  text-center mb-5">
                <button type="submit" class="btn btn-block btn-success">Киритилган мурожаатни сақлаш</button>
            </div>
        </div>

    </div> <!-- col-lg-12 -->

</div>


<?php ActiveForm::end()?>



<?php
$url_dist = Yii::$app->urlManager->createUrl(['/get/district']);
$url_vill = Yii::$app->urlManager->createUrl(['/get/village']);
$this->registerJs("
    $('#appeal-region_id').change(function(){
        $.get('{$url_dist}?id='+$('#appeal-region_id').val()).done(function(data){
            $('#appeal-district_id').empty();
            $('#appeal-district_id').append(data);
        })
    });
    $('#appeal-district_id').change(function(){
        $.get('{$url_vill}?id='+$('#appeal-district_id').val()).done(function(data){
            $('#appeal-village_id').empty();
            $('#appeal-village_id').append(data);
        })
    })
")
?>
