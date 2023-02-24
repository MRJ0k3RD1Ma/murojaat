<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VVillageProblem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Муаммолар рўйхати', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vvillage-problem-view">

    <div class="row">
        <div class="col-md-8">


            <div class="card">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <?php foreach (\common\models\VVillageProblem::find()->where(['village_id'=>$model->village_id])->all() as $item):?>
                        <li class="nav-item">
                            <a class="nav-link <?= $item->id == $id ? 'active' : ''?>" href="<?= Yii::$app->urlManager->createUrl(['/district/v-village-problem/view','id'=>$item->id,'village_id'=>$model->village_id])?>"><?= $item->name?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
                <div class="card-header">
                    <h3 class="card-title">
                        Мурожаатчи маълумотлари
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'name',
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
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-12">
                            <script>
                                var tashkilotadd = function(){}
                            </script>
                            <div id="accordion">
                                <a class="btn btn-primary" data-toggle="collapse" href="#task-send"><span class="fa fa-share-alt"></span> Топшириқ бериш</a>
                                <a class="btn btn-success" data-toggle="collapse" href="#task-close"><span class="fa fa-envelope"></span> Жавобни киритиш</a>

                            </div>
                            <div id="task-send" class="collapse" style="margin-top: 20px; padding: 20px;border: 1px solid #007bff;" data-parent="#accordion">

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered datatable_tashkilot" style="width: 99% !important;">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Ташкилот номи</th>
                                            <th>Директор</th>
                                            <th>СТИР(ИНН)</th>
                                        </tr>
                                        </thead>
                                        <tbody>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                    <?= $this->render('_task',['model'=>\common\models\VAppeal::find()->where(['id'=>$model->id,'village_id'=>$model->village_id])->all() ])?>

                </div>

            </div>




        </div>

        <div class="col-md-4">
            <?php $vill = $model->village; ?>
            <?= $this->render('_v_view',['model'=>$vill])?>
        </div>
    </div>

    <!-- Modal -->
    <div id="modaltashkilot" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Топшириқ бериш</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ёпиш</button>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
    $url = Yii::$app->urlManager->createUrl(['/district/v-village-problem/task','id'=>$model->id,'village_id'=>$model->village_id]);
    $this->registerJs("
         $(document).ready(function(){
              $('.datatable_tashkilot').DataTable({
                \"processing\": true,
                \"serverSide\": true,

                \"ajax\": {
                    \"url\":\"/get/gettashkilot_full\",
                    \"type\":\"post\"
                },
                \"columns\": [
                    { \"data\": \"id\" },
                    { \"data\": \"name\" },
                    { \"data\": \"director\" },
                    { \"data\": \"inn\" }
                ],
            });
            
            tashkilotadd = function(id){
               
                $('#modaltashkilot').modal('show').find('.modal-body').load('{$url}&cid='+id);
            }   
        })
    ")
?>