<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var common\models\Company $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <p>
                    <?= Html::a('Комплексга фойдаланувчи қўшиш', ['generatekomplex', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                    <?= Html::a('Фойдаланувчи қўшиш', ['adduser', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('ўзгартириш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
        <div class="card-body">


            <div class="row">
                <div class="col-md-5">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'inn',
                            'name',
                            [
                                'attribute'=>'parent_id',
                                'value'=>function($d){
                                    if($d->parent_id){
                                        $url = Yii::$app->urlManager->createUrl(['/cp/company/view','id'=>$d->parent_id]);
                                        return "<a href='{$url}'>{$d->parent->name}</a>";
                                    }
                                    return null;
                                },
                                'format'=>'raw'
                            ],
                            'director',
                            'phone',
                            'telegram',
                            'phone_director',
//                            'type_id',
                            [
                                'attribute'=>'type_id',
                                'value'=>function($d){
                                    return $d->type->name;
                                }
                            ],
//                            'soato_id',
                            [
                                'attribute'=>'soato_id',
                                'value'=>function($d){
                                    return $d->fulladdr;
                                }
                            ],
//                            'status_id',
                            [
                                'attribute'=>'status_id',
                                'value'=>function($d){
                                    return $d->status->name;
                                }
                            ],
                            'created',
                            'updated',
                            'address',
                            'location:ntext',
                            'lat',
                            'long',
//                            'parent_id',
                            'ads:ntext',
                            'cadastre',
                        ],
                    ]) ?>
                </div>

                <div class="col-md-7">
                    <h3>Ташкилот фойдаланувчилари</h3>
                    <table id="example" style="width: 100%" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>ФИО</th>
                            <th>Логин</th>
                            <th>Телефон</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n=0;foreach ($model->users as $item): $n++;?>
                            <tr>
                                <td><?= $n?></td>
                                <td><?= $item->name?></td>
                                <td><?= $item->username?></td>
                                <td><?= $item->phone?></td>
                                <td>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/company/updateuser','id'=>$item->id])?>"><span class="fa fa-edit"></span></a>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/company/deleteuser','id'=>$item->id,'com'=>$model->id])?>"><span class="fa fa-trash"></span></a>

                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <hr>
                    <div class="card-header">

                        <h3 class="card-title">Quyi tashkilotlar ro`yhati</h3>

                            <div class="card-tools">
                                <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/cp/company/child','id'=>$model->id])?>">Quyi tashkilot qo`shish</a>
                            </div>
                    </div>
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
                            [
                                'label'=>'',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/cp/company/removechild','id'=>$d->parent_id,'child_id'=>$d->id]);
                                    return "<a href='{$url}' class='btn btn-danger'><i class='fa fa-trash'></i></a>";
                                },
                                'format'=>'raw'
                            ],
                        ],
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

</div>


<?php
$this->registerJs("
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
} );
")
?>