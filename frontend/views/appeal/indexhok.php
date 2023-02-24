<?php

$this->title = 'Мурожаатлар рўйхати';
?>
<?php

use common\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AppealRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$user = Yii::$app->user->identity;
?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">


                            <div class="table-responsive">

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'label'=>'Рақами ва санаси',
                                            'value'=>function($d){
                                                $d->created = date('d-m-Y',strtotime($d->created));
                                                $url = Yii::$app->urlManager->createUrl(['/appeal/viewhok','id'=>$d->id]);
                                                return "<a href='{$url}'><b>№ {$d->number_full}</b> <br> {$d->created}</a>";
                                            },
                                            'format'=>'raw'
                                        ],
                                        'person_name',
                                        'person_phone',
//                                        'address',
                                        [
                                            'attribute'=>'address',
                                            'value'=>function($d){
                                                return $d->region.' '.$d->district.' '.@$d->village->name_cyr.' '.$d->address;
                                            }
                                        ],

                                        'appeal_detail',
                                        [
                                            'attribute'=>'deadtime',
                                            'value'=>function($d){

                                                if($d->status == 4){
                                                    return "<span class='bg-success' style='display: block;text-align: center'>Бажарилган</span>".
                                                        $d->answer_date;
                                                }
                                                $datetime2 = date_create($d->deadtime);
                                                $datetime1 = date_create(date('Y-m-d'));
                                                $interval = date_diff($datetime1, $datetime2);
                                                $days = $interval->format('%a ');
                                                $ds = $interval->format('%R%a ');
                                                $d->deadtime = date('d-m-Y',strtotime($d->deadtime));
                                                $class = "";
                                                if($ds <= 5){
                                                    $class = "bg-warning";
                                                }
                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                }
                                                $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;text-align: center'>".$days.' кун<br>'.$d->deadtime."</span> ";


                                                if($ds < 0){
                                                    $class = "bg-danger";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>Муддати ўтган</span>";
                                                }elseif($ds <= 5){
                                                    $class = "bg-warning";
                                                    $res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";
                                                }else{$res = "<span class='{$class}' style='width: 100%; height: 100%; display: block;'>".$days.' кун'."</span><br>{$d->deadtime}";}

                                                return $res;
                                            },
                                            'format'=>'raw'
                                        ],
                                        [
                                            'label'=>'',
                                            'value'=>function($d){
                                                $url  = Yii::$app->urlManager->createUrl(['/appeal/deletehok','id'=>$d->id]);
                                                return "<a href='{$url}' data-confirm='Siz rostdan ham ushbu murojaatni o`chirmoqchimisiz?' data-method='post' class='btn btn-danger'><span class='fa fa-trash'></span></a>";
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