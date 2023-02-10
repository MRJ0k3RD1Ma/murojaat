<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $name string*/
/* @var $users \common\models\User*/
/* @var $report array*/
/* @var $jami array*/
$this->title = 'Ҳисоботлар шакллантириш';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">1-Шакл</h3>
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
                <p>2023 йил <?= Yii::$app->user->identity->company->name ?> раҳбарияти томонидан қабул қилинган жисмоний шахслар ва юридик шахслар вакиллари, кўриб чиқилган мурожаатлар тўғрисида маълумот</p>
                <div class="table-responsive">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'name',
                            'bulim_name',
                            'lavozim_name',
                            'cnt',
                            'cnt_1',
                            'cnt_2',
                            'cnt_3',
                            'cnt_4',
                            'cnt_5',
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>