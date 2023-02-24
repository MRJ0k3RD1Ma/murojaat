<?php
/* @var $model \common\models\VAppeal*/
?>

<div class="row">
    <div class="col-md-12">
        <br>
        <div class="table-responsive">
            <h3 class="card-title">
                Муаммо юзасидан борилган топшириқлар рўйхати
            </h3>
            <br>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Ташкилот номи</th>
                        <th>Топшириқ матни</th>
                        <th>Юборилган сана</th>
                        <th>Ўхирги ўзгариш</th>
                        <th>Ҳолати</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=0; foreach ($model as $item): $n++;?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->company->name ?></td>
                            <td><?= $item->task ?></td>
                            <td><?= $item->created ?></td>
                            <td><?= $item->updated ?></td>
                            <td><?= $item->status->name ?></td>
                            <td><a data-method="post" href="<?= Yii::$app->urlManager->createUrl(['/district/v-village-problem/deletetask','id'=>$item->id,'village_id'=>$item->village_id,'company_id'=>$item->company_id,'appeal_id'=>$item->appeal_id])?>" class="btn btn-danger"> <span class="fa fa-trash"></span></a></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>