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
                        <a href="" class="btn btn-danger" data-method="post"><span class="fa fa-file-excel"></span> Эхпорт</a>
                    </p>

                </div>
            </div>
            <div class="card-body">

                <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
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
                        [
                            'attribute'=>'type_id',
                            'value'=>function($d){
                                return $d->type->name;
                            },
                            'filter'=>\yii\helpers\ArrayHelper::map(\common\models\CompanyType::find()->all(),'id','name')
                        ],
                        [
                            'attribute'=>'paid',
                            'value'=>function($d){
                                $txt = "";
                                if($d->paid==0){
                                    $txt = "Тўланмаган";
                                }else{
                                    $txt = $d->paid_date;
                                }
                                $url = Yii::$app->urlManager->createUrl(['/cp/company/paid','id'=>$d->id,'url'=>\yii\helpers\Url::current()]);
                                return "<button value='{$url}' class='btn btn-link paidbtn'>{$txt}</button>";
                            },
                            'format'=>'raw',
                            'filter'=>[0=>'To`lanmagan',1=>'Muddati o`tgan',2=>'To`langan'],
                            'label'=>'To`lov holati'
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
    <div class="modal" id="paidmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pul o'tirganligi haqidagi ma'lumotlari</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiqish</button>
                </div>
            </div>
        </div>
    </div>


<?php
$this->registerJs("
        $('.paidbtn').click(function(){
            var url = this.value;
            $('#paidmodal').modal('show').find('.modal-body').load(url);
        })
    ");
?>