<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\CompanySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionView::find()->all(),'region_id','name_cyr'),['prompt'=>'Вилоятни танланг']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->region_id])->all(),'district_id','name_cyr'),['prompt'=>'Туманни танланг']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MahallaView::find()->where(['region_id'=>$model->region_id,'district_id'=>$model->district_id])->all(),'id','name_cyr'),['prompt'=>'Маҳаллани танланг','class'=>'form-control js-select2']) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'inn') ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name') ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'director') ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone') ?>

        </div>
        <div class="col-md-4">
            <?php  echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CompanyType::find()->all(),'id','name'),['prompt'=>'Tashkilot turini tanlang']) ?>

        </div>
        <div class="col-md-4">
            <?php  echo $form->field($model, 'complex_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Complex::find()->all(),'id','name'),['prompt'=>'Komplexni tanlang']) ?>

        </div>
    </div>







    <?php // echo $form->field($model, 'telegram') ?>

    <?php // echo $form->field($model, 'phone_director') ?>




    <?php // echo $form->field($model, 'soato_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'long') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'ads') ?>

    <?php // echo $form->field($model, 'cadastre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$this->registerJs("
    $('#companysearch-region_id').change(function(){
        $.get('/get/district?id='+$('#companysearch-region_id').val()).done(function(data){
            $('#companysearch-district_id').empty();
            $('#companysearch-district_id').append(data);
        })
    });
    $('#companysearch-district_id').change(function(){
        $.get('/get/village?id='+$('#companysearch-district_id').val()+'&region_id='+$('#companysearch-region_id').val()).done(function(data){
            $('#companysearch-soato_id').empty();
            $('#companysearch-soato_id').append(data).trigger('change');
        })
    })
")
?>