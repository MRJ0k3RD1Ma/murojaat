<div class="container-fluid">
    <div class="header-body">


        <!-- Card stats -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['/village/v-village/index'])?>">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Маҳаллалар бешлиги томонидан хонадонларда ўтказиладиган СЎРОВНОМА (Андижон тажрибаси)
                                    </h5>
                                    <br />
                                    <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">Умумий <b><?= prettyNumber(\common\models\VVillage::find()->where(['soato_id'=>Yii::$app->user->identity->company->soato_id])->count('*')) ?></b> та сўровнома</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>


<div class="card">
    <div class="card-body">
        <h4 style="text-align: center"><?= Yii::$app->user->identity->company->fulladdr ?>да ўтказилган хатловда аниқланган муаммоларни йўналишлари кесимида</h4>
        <h4 style="text-align: center; font-weight: bold">МАЪЛУМОТ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">№</th>
                        <th rowspan="2">Муаммо коди</th>
                        <th rowspan="2">Муаммо йўналиши</th>
                        <th colspan="3">Маҳалла бўйича жами</th>
                    </tr>
                    <tr>
                        <th>Аниқланган муаммолар сони</th>
                        <th>Жами муаммодаги улуши %</th>
                        <th>Ҳал этилган муаммолар сони</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Жами</td>
                    <td><?= $prob[0][0]?></td>
                    <td><?= $prob[0][1]?></td>
                    <td><?= $prob[0][2]?></td>
                </tr>
                <?php $n=0; foreach ($model as $item): $n++;?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->code ?></td>
                        <td><?= $item->name?></td>
                        <td><?= $prob[$item->id][0]?></td>
                        <td><?= $prob[$item->id][1]?></td>
                        <td><?= $prob[$item->id][2]?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>