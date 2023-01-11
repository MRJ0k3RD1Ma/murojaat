<?php

use common\models\Company;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/* @var $model Company*/

$this->title = $model->name.' quyi tashkilotlarini qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Tashkilotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Quyi tashkilot qo`shish';
?>
<div class="company-index">

    <div class="card">

        <div class="card-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'label'=>'',
                        'value'=>function($d) use ($model){
                            if($d->id == $model->id){
                                return "";
                            }
                            if($d->parent_id == $model->id){
                               return "";
                            }else{
                                $txt = '/cp/company/addchild';
                                $class = "btn btn-primary";
                                $i = "<i class='fa fa-plus'></i>";
                            }
                            $url = Yii::$app->urlManager->createUrl([$txt,'id'=>$model->id,'child_id'=>$d->id]);
                            return "<button value='{$url}' class='{$class} addchild'>{$i}</button>";
                        },
                        'format'=>'raw'
                    ],
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'name',
                    [
                        'attribute'=>'name',

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


<?php
    $this->registerJs("
        $('.addchild').click(function(){
            var url = this.value;
            $.get(url).done(function(data){
                if(data == 1){
                    $('.addchild[value=\''+url+'\']').remove();
                    Swal.fire({
                      icon: 'success',
                      title: 'Ajoyib',
                      text: 'Quyi tashkiloti ulandi!',
                    })
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Xato',
                      text: 'Quyi tashkilotni ulashda xatolik!',
                    })
                }
            })
        })
    ")
?>