<?php

$this->title = 'Мурожаатлар рўйхати';
?>
<style>
    span.belgilar i {
        font-size: 50px;
        opacity: 0.5;
    }
</style>
<?php

use common\models\AppealRegister;

use common\models\AppealBajaruvchi;
use yii\helpers\Html;
use yii\helpers\url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AppealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$user = Yii::$app->user->identity;

?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">


            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жами топшириқлар</h5>
                                        <br />
                                        <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">
											<?= prettyNumber(AppealRegister::find()->where(['company_id'=>\Yii::$app->user->identity->company_id])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])
															 ->count('id')) ?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <span class="belgilar text-default"><i class="fa fa-tasks"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','type'=>'closed'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Бажарилган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['=','status',4])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id')) ?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <span class="belgilar text-success"><i class="fa fa-check"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','type'=>'running'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жараёнда</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','status',4])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id'))?> та</span>
                                    </div>

                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <span class="belgilar text-warning"><i class="fa fa-sync-alt"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','type'=>'dead'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Муддати ўтган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?php
                                            //select * from appeal_register where company_id = 1 and status <> 4 and

                                            $sql = "if(appeal_register.parent_bajaruvchi_id is null, deadtime = (select appeal.deadtime from appeal where appeal.id = appeal_register.appeal_id), deadtime = (select appeal_bajaruvchi.deadtime from appeal_bajaruvchi where appeal_bajaruvchi.id = appeal_register.parent_bajaruvchi_id)) and appeal_register.deadtime<date(now())";

                                            $query = AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','appeal_register.status',4])
                                                ->andWhere($sql)->count('id');
                                            echo prettyNumber($query)?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <span class="belgilar text-danger"><i class="fa fa-history"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

            </div>


            <div class="collapse" id="collapseExample">
                <h4>Қидирув</h4>
                <hr>

                <?= $this->render('_search',['searchModel'=>$searchModel])?>

            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?= $this->title?>
                            </h3>
                            <div class="card-tools">

                                <a href="" data-method="post" class="btn btn-info"><i class="fa fa-file-excel"></i> Экспорт</a>
<!--                                <form action="http://mur.lc/appeal/list/phpspreadsheet/export" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">-->
<!--                                    <div class="row padall">-->
<!--                                        <div class="col-lg-12">-->
<!--                                            <div class="float-right">-->
<!--                                                <input type="radio" checked="checked" name="export_type" value="xlsx"> .xlsx-->
<!--                                                <input type="radio" name="export_type" value="xls"> .xls-->
<!--                                                <input type="radio" name="export_type" value="csv"> .csv-->
<!--                                                <button type="submit" name="import" class="btn btn-primary">Export</button>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </form>-->
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="fa fa-search"></span> Қидирув
                                </button>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
//                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'label'=>'Рақами ва санаси',
                                            'value'=>function($d){
                                                $d->date = date('d-m-Y',strtotime($d->date));
                                                return "<b>№ {$d->number}</b> <br> {$d->date}";
                                            },
                                            'format'=>'raw'
                                        ],
                                        [
                                            'attribute'=>'appeal_id',
                                            'value'=>function($d){

                                                if($q = $d->appeal->question){
                                                    $res = $q->group->code.'-'.$q->code.'.'.$q->name;
                                                }else{
                                                    $res = "Савол белгиланмаган";
                                                }

                                                $url = Yii::$app->urlManager->createUrl(['/appeal/view','id'=>$d->id]);

                                                $res = $d->appeal->person_name.'<br>'.$res;
                                                return "<a href='{$url}'>{$res}</a>";
                                            },
                                            'format'=>'raw',
                                        ],
										 [
                                             'label'=>'Туман, Шахар',

                                            'value'=>function($d){


												return $d->appeal->district;
                                            },
                                            'format'=>'raw',
                                        ],
                                        [
                                            'attribute'=>'rahbar_id',
                                            'value'=>function($d){
                                                return isset($d->rahbar) ? $d->rahbar->name : '';
                                            }
                                        ],
                                        [
                                            'attribute'=>'ijrochi_id',
                                            'value'=>function($d){
                                                return isset($d->ijrochi) ? $d->ijrochi->name : '';
                                            }
                                        ],

                                        [
                                            'attribute'=>'control_id',
                                            'value'=>function($d){
                                                if($d->parent_bajaruvchi_id){
                                                    return $d->parent->status0->name;
                                                }else{
                                                    return $d->appeal->status0->name;
                                                }
                                            }
                                        ],

                                        [
                                            'attribute'=>'deadtime',
                                            'value'=>function($d){
                                                if($d->parent_bajaruvchi_id>0){
                                                    $baj = $d->parent;
                                                    if($baj->status == 4){
                                                        return "<span class='bg-success' style='display: block;text-align: center'>Бажарилган</span>".
                                                            $d->donetime;
                                                    }
                                                    $datetime2 = date_create($baj->deadtime);
                                                    $datetime1 = date_create(date('Y-m-d'));
                                                    $interval = date_diff($datetime1, $datetime2);
                                                    $days = $interval->format('%a ');
                                                    $ds = $interval->format('%R%a ');
                                                    $dead = date('d-m-Y',strtotime($baj->deadtime));

                                                }else{
                                                    $baj = $d->appeal;
                                                    if($baj->status == 4){
                                                        return "<span class='bg-success' style='display: block;text-align: center'>Бажарилган</span>".
                                                            $baj->answer_date;
                                                    }
                                                    $datetime2 = date_create($baj->deadtime);
                                                    $datetime1 = date_create(date('Y-m-d'));
                                                    $interval = date_diff($datetime1, $datetime2);
                                                    $days = $interval->format('%a ');
                                                    $ds = $interval->format('%R%a ');
                                                    $dead = date('d-m-Y',strtotime($baj->deadtime));
                                                }




                                                $class = "";

                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                    $res = "-".$days.' кун'."<br>{$baj->deadtime} <br><span class='{$class}' style='width: 100%; height: 100%; '> Муддати ўтган</span>";
                                                }elseif($ds <= 5){
                                                    $class = "bg-warning";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; '>".$days.' кун'."</span><br>{$d->deadtime}";
                                                }else{
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%;'>".$days.' кун'."</span><br>{$d->deadtime}";
                                                }

                                                return $res;
                                            },
                                            'format'=>'raw'
                                        ],

                                        [
                                            'label'=>'Юборилган',
                                            'value'=>function($d){
                                                $res = \common\models\AppealBajaruvchi::find()->where(['appeal_id'=>$d->appeal_id])
                                                    ->andWhere(['register_id'=>$d->id])->all();
                                                $ret = "";
                                                foreach ($res as $item){
                                                    if($item->company_id and $item->company){
                                                        $url = Yii::$app->urlManager->createUrl(['/appeal/complist','id'=>$item->company_id]);
                                                        $ret .= '<a href="'.$url.'"><span class="'.$item->status0->icon.'"></span>'.$item->company->name.'</a><br>';
                                                    }
                                                }

                                                return $ret;
                                            },
                                            'format'=>'raw'
                                        ],

                                        [
                                            'label'=>'Жавоб берган',
                                            'value'=>function($d){
                                                $res = \common\models\AppealBajaruvchi::find()->where(['register_id'=>$d->id])
                                                    ->andWhere('status = 3 or status=4')->all();
                                                $ret = "";
                                                $com = [];
                                                foreach ($res as $item){
                                                    if($item->company){
                                                        if(!in_array($item->company_id,$com)){
                                                            $com[] = $item->company_id;
                                                            $ret .= $item->company->name.'<br>';
                                                        }
                                                    }
                                                }

                                                return $ret;
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
        </div>
    </div>
</div>

<style>
    table th,table td{
        min-width: 100px;
    }
</style>
