<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VVillageProblemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Маҳаллалардан қабул қилинган муаммодар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-problem-index">

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'name',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/district/v-village-problem/view','id'=>$d->id,'village_id'=>$d->village_id]);
                                    return "<a href='{$url}'>{$d->name}</a>";
                                },
                                'format'=>'raw'
                            ],
                            'kinship',
                            'year',
//                            'name',
                            'detail:ntext',
//                            'type_id',
                            [
                                'attribute'=>'type_id',
                                'value'=>function($d){return $d->type->code.'-'.$d->type->name;},
                                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\VVillageProblemType::find()->all(),'id','code')
                            ],
//                            'status_id',
                            [
                                'attribute'=>'status_id',
                                'value'=>function($d){
                                    return $d->status->name;
                                }
                            ],
//                            'ranges',
                            [
                                'attribute'=>'ranges',
                                'value'=>function($d){return Yii::$app->params['ranges'][$d->ranges];},
                                'filter'=>Yii::$app->params['ranges']
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>


</div>
