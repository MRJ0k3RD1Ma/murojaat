<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ташкилотлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="" class="btn btn-danger" data-method="post"><span class="fa fa-file-excel"></span> Эхпорт</a>
                    </div>
                </div>
<!--                --><?php
//
//                echo "<pre>";
//var_dump($dataProvider);
//exit;
//?>
                <div class="card-body table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'name',
                            [
                                'attribute'=>'name',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/company/view','id'=>$d->id]);
                                    return "<a href='{$url}'>{$d->name}</a>";
                                },
                                'format'=>'raw'
                            ],
                            'cntall',
                            'cnt0',
                            'cnt1',
                            'cnt2',
                            'cnt3',
                            'cnt4',
                            'cnt5',
                            'cntdead',
                            'cntwithdead',
                            'cnt_nazorat',
                            'cnt_6',
                            'cnt_7',
                            'cnt_8',
                            'cnt_9',
                            'cnt_10',
                            'cnt_11',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>





</div>
