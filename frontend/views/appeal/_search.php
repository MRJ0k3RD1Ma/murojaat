<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'action' => ['list'],
    'method' => 'get',
]); ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($searchModel,'number')->textInput()?>
    </div>
    <div class="col-md-4">
        <?= $form->field($searchModel,'date')->textInput(['type'=>'date'])?>
    </div>
    <div class="col-md-4">
        <?php
        $quest = [];
        foreach (\common\models\AppealQuestionGroup::find()->all() as $item) {
            $quest[$item->code.'-'.$item->name] = [];
            foreach ($item->question as $i){
                $quest[$item->code.'-'.$item->name][$i->id] = $item->code.' '.$i->code.')'.$i->name;
            }
        }
        ?>

        <?= $form->field($searchModel, 'question_id')->dropDownList($quest,['prompt'=>'Саволни танланг','class'=>'form-control js-select2'])->label('Саволни танланг') ?>

    </div>

    <div class="col-md-4">
        <?= $form->field($searchModel,'person_name')->textInput()->label('ФИО')?>
    </div>
    <div class="col-md-4">
        <?= $form->field($searchModel, 'date_of_birth')->textInput(['type'=>'date'])->label('Туғилган санаси') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($searchModel, 'gender')->dropDownList([0=>'Аёл',1=>'Эркак'],['prompt'=>'Жинсини танланг'])->label('Жинси') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($searchModel, 'person_phone')->textInput(['maxlength' => true])->label('Телефон рақами') ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($searchModel, 'address')->textInput(['maxlength' => true])->label('Манзил') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($searchModel, 'control_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AppealControl::find()->all(),'id','name'),[
            'prompt'=>'Назорат турини танланг'
        ]) ?>
    </div>

<!--    <div class="col-md-4">-->
<!--        --><?php //= $form->field($searchModel, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionView::find()->all(),'region_id','name_cyr'),['prompt'=>'Вилоятни танланг'])->label(false)?>
<!--    </div>-->

    <div class="col-md-4">
        <?= $form->field($searchModel, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>33])->all(),'id','name_cyr'),['prompt'=>'Туманни танланг'])->label(false) ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Қидириш', ['class' => 'btn btn-primary']) ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list'])?>" class="btn btn-outline-secondary">Тозалаш</a>
</div>

<?php ActiveForm::end(); ?>
