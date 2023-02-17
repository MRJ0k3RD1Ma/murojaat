<div class="card">
    <div class="card-body">
        <div class="row">
            <?php foreach ($region as $item):?>
                <div class="col-md-2">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/sector','id'=>$item->district_id])?>"><?= $item->name_cyr?></a>
                </div>
            <?php endforeach;?>
        </div>

        <?php if($id != 0){?>
            <div class="row">
                <div class="col-md-4">
                    <?php foreach (\common\models\MahallaView::find()->where('id like "%1733'.$id.'%"')->all() as $item):?>
                        <div class="row">
                            <div class="col-md-12">
                                <label><?= $item->name_cyr?> <input type="text" class="sector" data-id="<?= $item->id?>" value="<?= $item->sector?>"></label>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="col-md-4">
                    <?php foreach (\app\models\LocVillage::find()->where(['district_id'=>$id])->orderBy(['sector_number'=>SORT_ASC])->all() as $item):?>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $item->name?> - <?= $item->sector_number?>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php }?>


    </div>
</div>

<?php
    $url = Yii::$app->urlManager->createUrl(['/cp/default/setsector']);
    $this->registerJs("
        $('.sector').change(function(){
            var id = $(this).attr('data-id');
            var val = this.value;
            $.get('{$url}?id='+id+'&val='+val).done(function(data){
               console.log(data);
            })
        })
    ")
?>