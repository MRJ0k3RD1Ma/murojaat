<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CompanyType::find()->all(),'id','name'),['prompt'=>'Tashkilot turini tanlang']) ?>
            <?= $form->field($model, 'complex_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Complex::find()->all(),'id','name'),['prompt'=>'Tegishli komplexni tanlang']) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionView::find()->all(),'region_id','name_cyr'),['prompt'=>'Вилоятни танланг']) ?>
            <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->region_id])->all(),'district_id','name_cyr'),['prompt'=>'Туманни танланг']) ?>
            <?= $form->field($model, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MahallaView::find()->where(['region_id'=>$model->region_id,'district_id'=>$model->district_id])->all(),'id','name_cyr'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2']) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CompanyStatus::find()->all(),'id','name'),['prompt'=>'Statusni tanlang']) ?>


            <?= $form->field($model, 'cadastre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ads')->textarea(['rows' => 2]) ?>

        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs("
    $('#company-region_id').change(function(){
        $.get('/get/district?id='+$('#company-region_id').val()).done(function(data){
            $('#company-district_id').empty();
            $('#company-district_id').append(data);
        })
    });
    $('#company-district_id').change(function(){
        $.get('/get/village?id='+$('#company-district_id').val()+'&region_id='+$('#company-region_id').val()).done(function(data){
            $('#company-soato_id').empty();
            $('#company-soato_id').append(data).trigger('change');
        })
    })
")
?>