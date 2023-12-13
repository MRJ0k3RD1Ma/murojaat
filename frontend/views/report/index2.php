<?php


use common\models\Appeal;
use common\models\AppealControl;
use common\models\AppealQuestionGroup;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

/* @var $name string*/
/* @var $users \common\models\User*/
/* @var $report array*/
/* @var $tp array*/
/* @var $jami array*/
$this->title = 'Ҳисоботлар шакллантириш';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider=new \common\models\Appeal()
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">2-Жадвал</h3>
                <div class="card-tools">
                    <ul class="pagination">
                        <li class="active"><a href="<?= Yii::$app->urlManager->createUrl(['/report/index'])?>" data-page="0">1</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index2'])?>" data-page="1">2</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index3'])?>" data-page="2">3</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index4'])?>" data-page="3">4</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index5'])?>" data-page="4">5</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index6'])?>" data-page="5">6</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index7'])?>" data-page="6">7</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <p>2023 йил <?= Yii::$app->user->identity->company->name ?>га  жисмоний ва юридик шахслардан тушган ва назоратга олинган мурожаатларни кўриб чиқиш натижалари тўғрисида маълумот</p>
 <?php

                $form = ActiveForm::begin([
                    'method' => 'post',
                    'id' => 'active-form',
                    'options' => [
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ],
                ]);
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($dataProvider, 'start')->textInput(['type'=>'date'])->label('boshlanish kuni');?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($dataProvider, 'end')->textInput(['type'=>'date'])->label('tugash kuni');?>
                    </div>
                    <div class="col-md-4" style="display: flex; padding: 29px;">
                        <?=Html::submitButton('yuborish', ['class' => 'btn btn-primary mr-2']);?>
                        <a href="" data-method="post" class="btn btn-info mr-3"><i class="fa fa-file-excel"></i> Экспорт</a>
                    </div>
                </div>
                <?php
                ActiveForm::end();
?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="6">№</th>
                                <th rowspan="6">Мурожаатларда кўтарилан масалалар</th>
                                <th rowspan="5">Жами мурожаатлар сони</th>
                                <th colspan="<?= \common\models\AppealShakl::find()->count('*')+3+AppealControl::find()->count('*')?>">Шу жумладан</th>
                            </tr>
                        <tr>
                            <th colspan="<?= \common\models\AppealShakl::find()->count('*')?>">Мурожаатларни шакллари</th>
                            <th colspan="<?= 3+AppealControl::find()->count('*') ?>">Мурожаатларни  кўриб чиқиш ҳолатлари</th>
                        </tr>
                        <tr>
                            <?php foreach (\common\models\AppealShakl::find()->orderBy(['id'=>SORT_ASC])->all() as $item):?>
                                <th rowspan="3"><?= $item->name ?></th>
                            <?php endforeach;?>
                            <th rowspan="4">Назоратга олинганлар</th>
                            <th colspan="<?= AppealControl::find()->count('*')?>">Жумладан</th>
                            <th rowspan="4">такрорийлар</th>
                            <th rowspan="4">муддати бузилганлар</th>
                        </tr>
                        <tr>
                            <?php foreach (AppealControl::find()->all() as $item):?>
                            <th rowspan="3"><?= $item->name?></th>
                            <?php endforeach;?>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach (AppealQuestionGroup::find()->all() as $key=>$item):?>

                        <tr>
                            <td><?= $key+1?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $tp[$item->id]['jami']?></td>
                            <?php foreach (\common\models\AppealShakl::find()->all() as $i): ?>
                                <td><?= $tp[$item->id]['shakl'][$i->id] ?></td>
                            <?php endforeach;?>
                            <td><?= $tp[$item->id]['nazorat'] ?></td>
                            <?php foreach (AppealControl::find()->all() as $i):?>
                                <td><?= $tp[$item->id]['control'][$i->id] ?></td>
                            <?php endforeach;?>
                            <td><?=  $tp[$item->id]['dead']?></td>
                            <td><?=  $tp[$item->id]['dead_done']?></td>
                        </tr>


                        <?php endforeach;?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
