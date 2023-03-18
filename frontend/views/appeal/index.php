<?php

$this->title = 'Мурожаатлар рўйхати';
?>
<?php

use common\models\AppealRegister;
use yii\db\Expression;
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

                                    <table  class="table table-bordered" style="font-weight: 900;">
                                        <tr>
                                            <td colspan="3" align="center"><?= $user->company->name?> tuman hokimligi va quyi tashkilotlarida ro`yxarga olingan murojaatlar</td>
                                        </tr>
                                        <tr>
                                            <td width="40%"></td>
                                            <td align="center">Urganch tuman hokimyatida</td>
                                            <td align="center">Quyi tashkilotlarida</td>
                                        </tr>
                                        <tr align="center">
                                            <td >Tansiflanmagan murojaatlar</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>1])?>"><?= $model->count_not_quest ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>10])?>"><?= $model->count_not_quest_quyi ?></a></td>
                                        </tr>
                                        <tr align="center">
                                            <td >Jarayondaki murojaatlar</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>2])?>"><?= $model->count_jarayonda_quest ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>20])?>"><?= $model->count_jarayonda_quest_quyi ?></a></td>

                                        </tr>
                                        <tr align="center">
                                            <td >Ko'rib chiqilgan murojaatlar</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>4])?>"><?= $model->count_close_quest ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>40])?>"><?= $model->count_close_quest_quyi ?></a></td>
                                        </tr>
                                        <tr align="center">
                                            <td ><b>Jami:</b></td>
                                            <td><?php echo $model->count_not_quest + $model->count_jarayonda_quest + $model->count_close_quest?></td>
                                            <td><?php echo $model->count_not_quest_quyi + $model->count_jarayonda_quest_quyi + $model->count_close_quest_quyi?></td>
                                        </tr>
                                    </table>


                                    <table  class="table table-bordered" style="font-weight: 700;">

                                        <tr align="center">
                                            <td width="40%"></td>
                                            <td>Yuqori tashkilotdan kelib tushgan</td>
                                            <td>Murojaat etuvchilardan to`g`ridan tog`ri kelib tushgan</td>
                                            <td>Quyi tashkilotlardan kelib tushgan</td>
                                            <td>Quyi tashkilotlar nazoratida</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Statistika yangilangan vaqti</td>
                                            <td colspan="4"> <?= new Expression(date('m.d.Y'))?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="center"><b>Jami kelib tushgan masalalar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>20])?>"><?= $model->count_quyi ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>21])?>"><?= $model->count_tugri ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>22])?>"><?= $model->count_quyi_send ?></a></td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yangi</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>11])?>"><?= $model->count_quyi_yangi ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>210])?>"><?= $model->count_tugri_yangi ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>31])?>"><?= $model->count_quyi_send_yangi ?></a></td>
                                            <td></td>

                                        </tr>
                                        <tr align="center">
                                            <td>Jarayonda</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>12])?>"><?= $model->count_quyi_jarayonda ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>220])?>"><?= $model->count_tugri_jarayonda ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>32])?>"><?= $model->count_quyi_send_jarayonda_all ?></a></td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yopilgan</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>14])?>"><?= $model->count_quyi_close ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>24])?>"><?= $model->count_tugri_close ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>33])?>"><?= $model->count_quyi_send_close_all ?></a></td>
                                            <td>0</td>
                                        </tr>
<!--                                        <tr align="center">-->
<!--                                            <td>Javob kiritilgan,o`rganilmoqda</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
                                        <tr>
                                            <td colspan="5" align="center"><b>Bugun kelib tushgan masalalar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td><?= $model->count_yuqori_today+$model->count_yuqori_today_jarayonda ?></td>
                                            <td><?= $model->count_tugri_today+$model->count_tugri_today_jarayonda ?></td>
                                            <td><?= $model->count_quyi_send_jarayonda+$model->count_quyi_send_today ?></td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Yangi</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>17])?>"><?= $model->count_yuqori_today ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>27])?>"><?= $model->count_tugri_today ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>37])?>"><?= $model->count_quyi_send_today ?></a></td>
                                            <td>0</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Jarayonda</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>18])?>"><?= $model->count_yuqori_today_jarayonda ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>28])?>"><?= $model->count_tugri_today_jarayonda ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>38])?>"><?= $model->count_quyi_send_jarayonda ?></a></td>
                                            <td>0</td>
                                        </tr>
<!--                                        <tr>-->
<!--                                            <td colspan="5" align="center"><b>Javobi kiritilgan,o`rganishda</b></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td><b>Administratsiya</b></td>-->
<!--                                            <td>0</td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Yuqori tashkilotlarda</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Joriy tashkilotlardan</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Quyi tashkilotlardan</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td></td>-->
<!--                                            <td></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td colspan="5" align="center"><b>So`rovlar</b></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Boshqa tashkilotlardan jo`natish so`rovlari</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Muddati o`zgargan so`rovlari</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Javobi kiritilgan,o`rganishda</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Tasnif o`zgartirish so`rovlari</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Cheklovni o`zgartirish so`rovlari</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->

                                        <tr>
                                            <td colspan="5" align="center"><b>Muddati yaqinlar</b></td>
                                        </tr>
                                        <tr align="center">
                                            <td><b>Jami:</b></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl([''])?>"><?= $model->count_date_interval_quyi ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>29])?>"><?= $model->count_date_interval ?></a></td>
                                            <td>0</td>
                                            <td>0</td>

                                        </tr>
                                        <tr align="center">
                                            <td>Bugun</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>100])?>"><?= $model->count_today_interval_quyi ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>300])?>"><?= $model->count_today_interval ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>300])?>"><?= $model->count_today_interval_quyi_send ?></a></td>
                                            <td>0</td>

                                        </tr>
                                        <tr align="center">
                                            <td>Ertaga</td>
                                            <td>0</td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>301])?>"><?= $model->count_tomorrow_interval ?></a></td>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list','status'=>300])?>"><?= $model->count_tomorrow_interval_quyi_send ?></a></td>
                                            <td>0</td>
                                        </tr>

<!--                                        <tr>-->
<!--                                            <td colspan="5" align="center"><b>Muddati tugaganlar</b></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Muddati buzilganlar</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>30 kunlik muddat buzilganlar</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Muddat buzib yopilganlar</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>30 kunlik muddat buzib yopilganlar</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!---->
<!--                                        <tr>-->
<!--                                            <td colspan="5" align="center"><b>Takroriylik</b></td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Takroriy</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!--                                        <tr align="center">-->
<!--                                            <td>Duplikat</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                            <td>0</td>-->
<!--                                        </tr>-->
<!---->

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