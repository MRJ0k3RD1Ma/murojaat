<div class="container-fluid">
    <div class="header-body">


        <!-- Card stats -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['/village/v-village/create'])?>">
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