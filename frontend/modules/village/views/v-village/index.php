<?php

use common\models\VVillage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Сўровномалар рўйхати';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-index">

    <div class="card">
        <div class="card-body">

            <p>
                <?= Html::a('Сўровнома қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
                <a href="" data-method="post" class="btn btn-primary"><span class="fa fa-file-excel"></span> Экспорт қилиш</a>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'user_id',
                        [
                            'attribute'=>'soato_id',
                            'value'=>function($d){
                                $url = Yii::$app->urlManager->createUrl(['/village/v-village/view','id'=>$d->id]);
                                return "<a href='{$url}'>{$d->fulladdr}</a>";
                            },
                            'format'=>'raw'
                        ],
                        'sector',
//                    'soato_id',
                        'date',
                        [
                            'attribute'=>'soato_id',
                            'value'=>function($d){
                                return $d->soato->name_cyr;
                            }
                        ],
                        [
                            'attribute'=>'road',
                            'value'=>function($d){
                                return $d->road.' '.$d->address;
                            }
                        ],
                        //'road',
                        //'address',
                        'person_name',

                        'person_birthday',
                        [
                            'attribute'=>'gender',
                            'value'=>function($d){
                                return Yii::$app->params['gender'][$d->gender];
                            }
                        ],
                        'person_phone',
                        [
                            'attribute'=>'home_status_id',
                            'value'=>function($d){
                                return $d->homeStatus->name;
                            },
                        ],
//                        'has_cl_problem',
                        [
                            'attribute'=>'has_cl_problem',
                            'value'=>function($d){
                                return Yii::$app->params['has_cl_problem'][$d->has_cl_problem];
                            }
                        ],
                        [
                            'attribute'=>'want_econom_energy',
                            'value'=>function($d){
                                return Yii::$app->params['want_econom_energy'][$d->want_econom_energy];
                            }
                        ],
                        //'want_econom_energy',
                        [
                            'attribute'=>'econom_energy_credit',
                            'label'=>'Кредит'
                        ],
                        [
                            'attribute'=>'econom_energy_own',
                            'label'=>'Ўз хисобилдан'
                        ],
                        'econom_energy',
//                        'is_want_credit',
                        [
                            'attribute'=>'is_want_credit',
                            'value'=>function($d){
                                return Yii::$app->params['is_want_credit'][$d->is_want_credit];
                            }
                        ],
                        'want_credit',
                        'credit_women',
                        'credit_young',
                        'credit',
                        //'want_subsidy',
                        //'subsidy_women',
                        //'subsidy_young',
                        //'subsidy',
                        //'migrant',
                        //'home_status_id',
                    ],
                ]); ?>
            </div>
        </div>
    </div>


</div>
