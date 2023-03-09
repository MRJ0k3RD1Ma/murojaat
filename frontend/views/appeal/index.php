<?php

$this->title = 'Мурожаатлар рўйхати';
?>
<?php

use common\models\AppealRegister;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model \common\models\ViewFullstat*/
$user = Yii::$app->user->identity;
?>
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">


                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Жами топшириқлар</h5>
                                        <br />
                                        <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0"><?= prettyNumber(AppealRegister::find()->where(['company_id'=>\Yii::$app->user->identity->company_id])->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id')) ?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/theme/dist/img/home.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px; height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'closed'])?>">
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
                                            <img src="/theme/dist/img/home_human.png" style="color: #397fd5;font-size: 85px;float: right; height: 50px; position: absolute;right: 20px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'running'])?>">
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
                                            <img src="/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index','type'=>'dead'])?>">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Муддати ўтган</h5>
                                        <br />
                                        <span style="color: #32325d;background: url(/theme/dist/img/link_hover_tolqin.svg);padding-bottom: 3px;" class="h4 mb-0"><?php
                                            $sql = "deadtime<date(now())";
                                            $query = AppealRegister::find()->where(['company_id'=>$user->company_id])
                                                ->andWhere(['<>','status',4])->andWhere($sql)->orderBy(['status'=>SORT_ASC,'deadtime'=>SORT_ASC])->count('id');
                                            echo prettyNumber($query)?> та</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape">
                                            <img src="/theme/dist/img/humans.png" style="color: #397fd5;font-size: 85px;float: right;position: absolute;right: 20px;  height: 50px;" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </a>
                    </div>

                </div>


            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <?= $this->title?>
                                </h3>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive">

                                    <table  class="table table-bordered">
                                        <tr>
                                            <td colspan="3" align="center">Urganch tuman hokimligi va quyi tashkilotlarida ro`yxarga olingan murojaatlar</td>
                                        </tr>
                                        <tr>
                                            <td width="40%"></td>
                                            <td align="center">Urganch tuman hokimyatida</td>
                                            <td align="center">Quyi tashkilotlarida</td>
                                        </tr>
                                        <tr align="center">
                                            <td >Tansiflanmagan murojaatlar</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>1])?>"><?= $model->count_not_quest ?></a></td>
                                            <td><?= $model->count_not_quest_quyi ?></td>
                                        </tr>
                                        <tr align="center">
                                            <td >Jarayondaki murojaatlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td >Ko'rib chiqilgan murojaatlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td ><b>Jami:</b></td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>


                                    <table  class="table table-bordered">

                                        <tr align="center">
                                            <td width="40%"></td>
                                            <td>Yuqori tashkilotdan kelib tushgan</td>
                                            <td>Murojaat etuvchilardan to`g`ridan tog`ri kelib tushgan</td>
                                            <td>Quyi tashkilotlardan kelib tushgan</td>
                                            <td>Quyi tashkilotlar nazoratida</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Statistika yangilangan vaqti</td>
                                            <td colspan="4">07.03.2023</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>Jami kelib tushgan masalalar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yangi</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Jarayonda</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yopilgan</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Javob kiritilgan,o`rganilmoqda</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>Bugun kelib tushgan masalalar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yangi</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Jarayonda</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>Javobi kiritilgan,o`rganishda</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Administratsiya</b></td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yuqori tashkilotlarda</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Joriy tashkilotlardan</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Quyi tashkilotlardan</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>So`rovlar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Boshqa tashkilotlardan jo`natish so`rovlari</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Muddati o`zgargan so`rovlari</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Javobi kiritilgan,o`rganishda</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Tasnif o`zgartirish so`rovlari</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Cheklovni o`zgartirish so`rovlari</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>Muddati yaqinlar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Bugun</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Ertaga</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" align="center"><b>Muddati tugaganlar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Muddati buzilganlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>30 kunlik muddat buzilganlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Muddat buzib yopilganlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>30 kunlik muddat buzib yopilganlar</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" align="center"><b>Takroriylik</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td>Takroriy</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Duplikat</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>


                                    </table>

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