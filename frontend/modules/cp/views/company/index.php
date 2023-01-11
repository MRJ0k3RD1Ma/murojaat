<?php

use common\models\Company;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <div class="card">
        <div class="card-header">
           <div class="card-tools">
               <p>
                   <?= Html::a('Tashkilot qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
               </p>

           </div>
        </div>
        <div class="card-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'name',
                    [
                        'attribute'=>'name',
                        'value'=>function($d){
                            $url = Yii::$app->urlManager->createUrl(['/cp/company/view','id'=>$d->id]);
                            return "<a href='{$url}'>{$d->name}</a>";
                        },
                        'format'=>'raw'
                    ],
                    'inn',
                    'director',
                    'phone',
                    //'telegram',
                    //'phone_director',
//                    'type_id',
                    [
                        'attribute'=>'type_id',
                        'value'=>function($d){
                            return $d->type->name;
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\CompanyType::find()->all(),'id','name')
                    ],
//                    'soato_id',
                    //'status_id',
                    //'created',
                    //'updated',
                    //'address',
                    //'location:ntext',
                    //'lat',
                    //'long',
                    //'parent_id',
                    //'ads:ntext',
                    //'cadastre',
                  /*  [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],*/
                ],
            ]); ?>
        </div>
    </div>


</div>
