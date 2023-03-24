<?php


use common\models\Appeal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/* @var $name string*/
/* @var $users \common\models\User*/
/* @var $report array*/
/* @var $jami array*/
$this->title = 'Ҳисоботлар шакллантириш';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">2-Жадвал</h3>
                <div class="card-tools">
                    <ul class="pagination">
                        <li class="active"><a href="<?= Yii::$app->urlManager->createUrl(['/report/index'])?>" data-page="0">1</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index2'])?>" data-page="1">2</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index3'])?>" data-page="2">3</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index4'])?>" data-page="3">4</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index5'])?>" data-page="4">5</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index6'])?>" data-page="5">6</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index7'])?>" data-page="6">7</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <p>2023 йил <?= Yii::$app->user->identity->company->name ?>га  жисмоний ва юридик шахслардан тушган ва назоратга олинган мурожаатларни кўриб чиқиш натижалари тўғрисида маълумот</p>
                <a href="" data-method="post" class="btn btn-info"><i class="fa fa-file-excel"></i> Экспорт</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="6">№</th>
                                <th rowspan="6">Мурожаатларда кўтарилан масалалар</th>
                                <th rowspan="5">Жами мурожаатлар сони</th>
                                <th colspan="<?= \common\models\AppealShakl::find()->count('*')+7?>">Шу жумладан</th>
                            </tr>
                        <tr>
                            <th colspan="<?= \common\models\AppealShakl::find()->count('*')?>">Мурожаатларни шакллари</th>
                            <th colspan="7">2023 йил бўйича мурожаатларни  кўриб чиқиш ҳолатлари</th>
                        </tr>
                        <tr>
                            <?php foreach (\common\models\AppealShakl::find()->orderBy(['id'=>SORT_ASC])->all() as $item):?>
                                <th rowspan="3"><?= $item->name ?></th>
                            <?php endforeach;?>
                            <th rowspan="4">Назоратга олинганлар</th>
                            <th colspan="4">Жумладан</th>
                            <th rowspan="4">такрорийлар</th>
                            <th rowspan="4">муддати бузилганлар</th>
                        </tr>
                        <tr>
                            <th rowspan="3">чоралар  кўрилди</th>
                            <th rowspan="3">тушунтирилди</th>
                            <th rowspan="3">рад этилди</th>
                            <th rowspan="3">кўриб чиқилмоқда</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $user = \Yii::$app->user->identity;
//                        $cc= common\models\Appeal::find()->all();
                        $time = new \DateTime('now');
                        ?>
                        <?php $n=0; foreach ($quest as $item) : $n++;?>
                          <?php
                            $aa=0;
                            $at=0;
                            $ax=0;
                            $ao=0;
                            $ae=0;
                            $as=0;
                            $ai=0;
                            $am=0;
                            $av=0;
                            $apr=0;
                            $ap=0;
                            $ab=0;
                            $ach=0;
                            $ar=0;
                            $ak=0;
                            $ata=0;
                            $ama=0;
                          ?>
                            <tr>
                                <th><?= $n?></th>
                                <td><?= $item->name ?></td>
                                <td>
                                    <?php
                                    foreach ($cc as $a)
                                        {  if ( $a->question_id !== NULL)
                                            { if ($a->question->group->id == $item->id)
                                                {$aa=$aa+1;
                                                    if ($a->appeal_shakl_id==1){$at=$at+1;}
                                                    if ($a->appeal_shakl_id==2){$ax=$ax+1;}
                                                    if ($a->appeal_shakl_id==3){$ao=$ao+1;}
                                                    if ($a->appeal_shakl_id==4){$ae=$ae+1;}
                                                    if ($a->appeal_shakl_id==5){$as=$as+1;}
                                                    if ($a->appeal_shakl_id==6){$ai=$ai+1;}
                                                    if ($a->appeal_shakl_id==7){$am=$am+1;}
                                                    if ($a->appeal_shakl_id==8){$av=$av+1;}
                                                    if ($a->appeal_shakl_id==9){$apr=$apr+1;}
                                                    if ($a->appeal_shakl_id==10){$ap=$ap+1;}
                                                    if ($a->status>=2 && $a->status<=4){$ab=$ab+1;}
                                                    if ($a->status==4){$ach=$ach+1;}
                                                    if ($a->status==5){$ar=$ar+1;}
                                                    if ($a->status==2 || $a->status==3){$ak=$ak+1;}
                                                    foreach ($arr as $i){
                                                        if ( $i->appeal_id==$a->id ){
                                                            if ($i->takroriy==1){
                                                            $ata=$ata+1;}
                                                            if ($i->deadtime>=$time->format('Y-m-d')){
$ama=$ama+1;
                                                            }
                                                        }
                                                    }
                                                }}
                                        } echo $aa;?>
                                </td>




                                <td><?=$at?></td>
                                <td><?=$ax?></td>
                                <td><?=$ao?></td>
                                <td><?=$ae?></td>
                                <td><?=$as?></td>
                                <td><?=$ai?></td>
                                <td><?=$am?></td>
                                <td><?=$av?></td>
                                <td><?=$apr?></td>
                                <td><?=$ap?></td>
                                <td><?=$ab?></td>
                                <td><?=$ach?></td>
                                <td>0</td>
                                <td><?=$ar?></td>
                                <td><?=$ak?></td>
                                <td><?=$ata?></td>
                                <td><?=$ama?></td>

                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
    


                </div>
            </div>
        </div>
    </div>
</div>