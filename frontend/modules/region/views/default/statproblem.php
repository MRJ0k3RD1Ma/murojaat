
<div class="card">
    <div class="card-body">
        <h4 style="text-align: center"><?= Yii::$app->user->identity->company->soato->region ?>да ўтказилган хатловда аниқланган муаммоларни йўналишлари кесимида</h4>
        <h4 style="text-align: center; font-weight: bold">МАЪЛУМОТ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Муаммо коди</th>
                    <th rowspan="2">Муаммо йўналиши</th>
                    <th colspan="3">Туман бўйича жами</th>
                    <th colspan="2">1-сектор</th>
                    <th colspan="2">2-сектор</th>
                    <th colspan="2">3-сектор</th>
                    <th colspan="2">4-сектор</th>
                </tr>
                <tr>
                    <th>Аниқланган муаммолар сони</th>
                    <th>Жами муаммодаги улуши %</th>
                    <th>Ҳал этилган муаммолар сони</th>
                    <th>Аниқланган муаммолар сони</th>
                    <th>Ҳал этилган муаммолар сони</th>
                    <th>Аниқланган муаммолар сони</th>
                    <th>Ҳал этилган муаммолар сони</th>
                    <th>Аниқланган муаммолар сони</th>
                    <th>Ҳал этилган муаммолар сони</th>
                    <th>Аниқланган муаммолар сони</th>
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
                    <td><?= $prob[0][3][1]?></td>
                    <td><?= $prob[0][4][1]?></td>
                    <td><?= $prob[0][3][2]?></td>
                    <td><?= $prob[0][4][2]?></td>
                    <td><?= $prob[0][3][3]?></td>
                    <td><?= $prob[0][4][3]?></td>
                    <td><?= $prob[0][3][4]?></td>
                    <td><?= $prob[0][4][4]?></td>
                </tr>
                <?php $n=0; foreach ($model as $item): $n++;?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->code ?></td>
                        <td><?= $item->name?></td>
                        <td><?= $prob[$item->id][0]?></td>
                        <td><?= intval($prob[$item->id][1])?>%</td>
                        <td><?= $prob[$item->id][2]?></td>
                        <td><?= $prob[$item->id][3][1]?></td>
                        <td><?= $prob[$item->id][4][1]?></td>
                        <td><?= $prob[$item->id][3][2]?></td>
                        <td><?= $prob[$item->id][4][2]?></td>
                        <td><?= $prob[$item->id][3][3]?></td>
                        <td><?= $prob[$item->id][4][3]?></td>
                        <td><?= $prob[$item->id][3][4]?></td>
                        <td><?= $prob[$item->id][4][4]?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    td{
        text-align: center !important;
    }
</style>