<?php
use yii\widgets\ActiveForm;

/* @var $model \common\models\VVillageReport*/
$this->title = "Ҳисоботлар";
?>
<div class="row">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Ҳисобот санаси:</b><?= $model->report_date ?> <br>
                    <b>Янги киритиладиган маълумотлар санаси: </b> <?= $model->next_date?>
                </h3>
            </div>
            <div class="card-body">
                <?php if(strtotime($model->next_date) == time()){?>
                <p><b>Кунни якунлаш</b> тугмасини босган ҳолда маҳаллалар томонидан киритилаётган сўровномаларнинг санаси <b>автоматик <?= date('Y-m-d',strtotime(date('Y-m-d').' +1 day'))?> санадан киритилади.</b></p>
                <a href="<?= Yii::$app->urlManager->createUrl(['/district/default/closedate'])?>" data-method="post" data-confirm="Сиз ростдан ҳам бугунги кунни якунламоқчимисиз?" class="btn btn-success">Кунни якунлаш</a>
                <?php }else{?>
                    <p>Кун якунланган. Кейинги кун <b><?= date('Y-m-d',strtotime(date('Y-m-d').' +1 day'))?></b> санада кунни якунлаш мумкин.</p>
                <?php }?>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Ҳисоботни юклаб олиш
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Ҳисоботларни юклаб олишда бирир санаси белгиланг ва <b>Ҳисоботни юклаб олиш</b> тугмасини босинг</p>
                    </div>
                    <div class="col-md-6">
                        <form action="<?= Yii::$app->urlManager->createUrl(['/district/default/report'])?>" data-method="get">
                            <div class="form-group">
                                <label>Ҳисобот санасини киритинг
                                    <input type="date" name="rdate" class="form-control">
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Ҳисоботни юклаб олиш</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>