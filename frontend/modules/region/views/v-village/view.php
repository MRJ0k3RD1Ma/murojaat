<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */

$this->title = $model->person_name;
$this->params['breadcrumbs'][] = ['label' => 'Маҳаллалар бешлиги томонидан хонадонларда ўтказиладиган СЎРОВНОМА', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vvillage-view">

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                Маҳаллалар бешлиги томонидан хонадонларда ўтказиладиган
                СЎРОВНОМА
            </h3>
            <br>
            <p style="text-align: right">сўров ўтказилган сана <?= date('d.m.Y',strtotime($model->date))?>й</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <p><strong>1. Сектор рақами №<?= $model->sector?> </strong></p>
                            <p><strong>МФЙ номи <?= $model->soato->name_cyr ?></strong></p>
                        </td>
                        <td colspan="3">
                            <p><strong>Кўча </strong><em>(мавзе, даҳа)</em><strong> номи <?= $model->road?></strong></p>
                            <p><strong>Ҳонадон / уй рақами  №<?= $model->address?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p><strong>2. Суҳбат ўтказилган хонадон вакили Ф.И.Ш <?= $model->person_name?></strong></p>
                        </td>
                        <td colspan="2">
                            <p><strong>Туғилган санаси: </strong><strong><?= date('d.m.Y',strtotime($model->person_birthday))?></strong><strong>&nbsp;йил</strong></p>
                        </td>
                        <td>
                            <p><strong>Тел.рақами:<br /><?= $model->person_phone?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <p><strong>3. Хонадоннинг иқтисодий-ижтимоий аҳволи:</strong></p>
                        </td>
                    </tr>
                    <?php $sts = \common\models\VHomeStatus::find()->all();
                        foreach ($sts as $item):
                    ?>
                    <tr>
                        <td>
                            <p><strong><?= $item->id == $model->home_status_id ? "<span class='fa fa-check'></span>" : ''?></strong><strong><?= $item->name?></strong></p>
                        </td>
                        <td colspan="4">
                            <p><?= $item->ads?></p>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="5">
                            <p><strong>4. Назоратга олинадиган муаммоси бор хонадонми </strong><?= Yii::$app->params['has_cl_problem'][$model->has_cl_problem]?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <p><strong>5. Энергия тежамкор ускуналар ўрнатишга эҳтиёжи </strong><em> <?= Yii::$app->params['want_econom_energy'][$model->want_econom_energy]?></em></p>
                            <p><em>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</em><strong>кредит- </strong><strong><?= $model->econom_energy_credit == 1 ? '<span class="fa fa-check"></span>' : '<span class="fa fa-times"></span>'?></strong><strong> ўз маблағи- </strong><strong><?= $model->econom_energy_credit == 1 ? '<span class="fa fa-check"></span>' : '<span class="fa fa-times"></span>'?></strong><strong>&nbsp; </strong><strong><?= $model->econom_energy?></strong><strong>кВт </strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><strong>6. Кредит олишга бўлган талаб (млн.сўмда) <?= $model->want_credit?></strong></p>
                            <p><em>шундан, </em><strong>Аёллар </strong><strong>&nbsp;<?= $model->credit_women?></strong><strong>&nbsp; Ёшлар</strong><strong>&nbsp;&nbsp; <?= $model->credit_young?></strong></p>
                        </td>
                        <td colspan="2">
                            <p><strong>Кредит мақсади:</strong></p>
                            <p><strong><?= $model->credit?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><strong>7. Субсидия олишга бўлган талаб:</strong><?= Yii::$app->params['want_subsidy'][$model->want_subsidy]?></p>
                            <p><em>шундан, </em><strong>Аёллар </strong><strong>&nbsp;<?= $model->subsidy_women?></strong><strong>&nbsp; Ёшлар</strong><strong>&nbsp;&nbsp; <?= $model->subsidy_young?></strong></p>
                        </td>
                        <td colspan="2">
                            <p><strong>Субсидия мақсади:</strong></p>
                            <p><strong><?= $model->subsidy?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <p><strong>8. Хонадон вакилидан четда <em>(ишлаш ёки ўқиш мақсадида)</em> юрганлар сони </strong><strong><?= $model->migrant?>&nbsp; </strong><strong>нафар</strong></p>
                        </td>
                    </tr>
                    <?php $migrant = \common\models\VPersonMigrant::find()->where(['village_id'=>$model->id])->all(); foreach ($migrant as $item):?>
                    <tr>
                        <td colspan="3">
                            <p>ФИО: <?= $item->person_name?></p>
                        </td>
                        <td colspan="2">
                            <p>Туғилган йили: <?= $item->birthday?></p>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

                <p>
                    Хонадонда аниқланган муаммолар
                    (Агар ўрганилган хонадонда муаммо аниқланмаса ушбу қисм тўлдирилмайди, бунда “Аниқланган муаммо мазмуни” устунидаги бўш қаторлардан бирига
                    “муаммо мавжуд эмас” деб бир марта ёзилади
                </p>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Аниқланган муаммо мазмуни</th>
                    </tr>
                    <?php foreach (\common\models\VVillageProblem::find()->where(['village_id'=>$model->id])->all() as $item):?>
                        <tr>
                            <td><?= $item->id?> </td>
                            <td>Қариндошлиги <?= $item->kinship?>, <?= $item->year?>, <?= $item->detail?></td>
                        </tr>
                    <?php endforeach;?>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
