<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VVillageProblemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Жавоби келган муаммолар';
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
                                'label'=>'Рақами ва санаси',
                                'value'=>function($d){
                                    $url  = Yii::$app->urlManager->createUrl(['/district/v-village-problem/viewanswer','appeal_id'=>$d->appeal_id,'id'=>$d->id,'village_id'=>$d->village_id,'company_id'=>$d->company_id]);
                                    $ans = $d->appeal;
                                    $text = $ans->answer_number.'<br>'.$ans->answer_date;
                                    return "<a href='{$url}'>{$text}</a>";
                                },
                                'format'=>'raw'
                            ],
                            [
                                'label'=>'Мурожаатчи',
                                'value'=>function($d){
                                    $ap = \common\models\VVillageProblem::findOne(['id'=>$d->id,'village_id'=>$d->village_id]);
                                    $url = Yii::$app->urlManager->createUrl(['/district/v-village-problem/view','id'=>$d->id,'village_id'=>$d->village_id]);
                                    $text = $ap->name.'<br>'.$ap->type->code.'-'.$ap->type->name;
                                    return "<a href='{$url}'>{$text}</a>";
                                },
                                'format'=>'raw'
                            ],
                            [
                                'label'=>'Ташкилот',
                                'value'=>function($d){
                                    return $d->company->name;
                                },
                            ],
                            [
                                'attribute'=>'task'
                            ],
                            [
                                'label'=>'Муддат',
                                'value'=>function($d){
                                    return $d->appeal
                                }
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>


</div>
