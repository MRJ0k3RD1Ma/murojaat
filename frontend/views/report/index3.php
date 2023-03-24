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
                <h3 class="card-title">3-Жадвал</h3>
                <div class="card-tools">
                    <ul class="pagination">
                        <li ><a href="<?= Yii::$app->urlManager->createUrl(['/report/index'])?>" data-page="0">1</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index2'])?>" data-page="1">2</a></li>
                        <li class="active"><a href="<?= Yii::$app->urlManager->createUrl(['/report/index3'])?>" data-page="2">3</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index4'])?>" data-page="3">4</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index5'])?>" data-page="4">5</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index6'])?>" data-page="5">6</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/report/index7'])?>" data-page="6">7</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <p>2023 йил <?= Yii::$app->user->identity->company->name ?>га  жисмоний ва юридик шахслардан тушган ва назоратга олинган мурожаатларни кўриб чиқиш натижалари тўғрисида маълумот</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th rowspan="6">№</th>
                            <th rowspan="6">Шахар ва туманлар</th>
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
                        <?php
                        //                        $cc= common\models\Appeal::find()->all();
                        $user = \Yii::$app->user->identity;
                        $time = new \DateTime('now');
                        $n=0;
                        foreach ($quest as $item):
                            $n++;
                        ?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->jami?></td>
                            <td><?= $item->shakl1 ?></td>
                            <td><?= $item->shakl2 ?></td>
                            <td><?= $item->shakl3 ?></td>
                            <td><?= $item->shakl4 ?></td>
                            <td><?= $item->shakl5 ?></td>
                            <td><?= $item->shakl6 ?></td>
                            <td><?= $item->shakl7 ?></td>
                            <td><?= $item->shakl8 ?></td>
                            <td><?= $item->shakl9 ?></td>
                            <td><?= $item->shakl10 ?></td>
                            <td><?= $item->chora+$item->tushin+$item->rad+$item->kor ?></td>
                            <td><?= $item->chora ?></td>
                            <td><?= $item->tushin ?></td>
                            <td><?= $item->rad ?></td>
                            <td><?= $item->kor ?></td>
                            <td><?= $item->tak ?></td>
                            <td><?= $item->date ?></td>
                        </tr>
                        <?php  endforeach;?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>