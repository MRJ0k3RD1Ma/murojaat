
<div class="card">
    <div class="card-body">
        <h4 style="text-align: center"><?= \common\models\Soato::findOne($soato)->name_cyr ?>да ўтказилган хатловда аниқланган муаммоларни йўналишлари кесимида</h4>
        <h4 style="text-align: center; font-weight: bold">МАЪЛУМОТ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Ҳудуд номи</th>
                    <th rowspan="2">Сектор</th>
                    <th colspan="2">Фуқаролар йиғинидаги</th>
                    <th colspan="5">Уйма-уй юриш жараёнида</th>
                    <th colspan="3">Аниқланган муаммонинг даражаси</th>
                </tr>
                <tr>
                    <th>Хонадонлар сони</th>
                    <th>Аҳоли сони</th>
                    <th>Жами ўрганилган хонадонлар сони</th>
                    <th>Бир кунда ўрганилган хонадонлар</th>
                    <th>Жами муаммо аниқланган хонадонлар сони</th>
                    <th>Жами аниқланган муаммолар сони</th>
                    <th>Жами ҳал этилган муаммолар сони</th>
                    <th>туман</th>
                    <th>вилоят</th>
                    <th>республика</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?= $res[0][0][1]?></th>
                        <th>Туман(шаҳар) бўйича</th>
                        <th></th>
                        <th><?= $res[0][0][4]?></th>
                        <th><?= $res[0][0][5]?></th>
                        <th><?= $res[0][0][6]?></th>
                        <th><?= $res[0][0][7]?></th>
                        <th><?= $res[0][0][8]?></th>
                        <th><?= $res[0][0][9]?></th>
                        <th><?= $res[0][0][10]?></th>
                        <th><?= $res[0][0][11]?></th>
                        <th><?= $res[0][0][12]?></th>
                        <th><?= $res[0][0][13]?></th>

                    </tr>

                    <tr>
                        <th><?= $res[1][0][1]?></th>
                        <th>1-сектор</th>
                        <th>1</th>
                        <th><?= $res[1][0][4]?></th>
                        <th><?= $res[1][0][5]?></th>
                        <th><?= $res[1][0][6]?></th>
                        <th><?= $res[1][0][7]?></th>
                        <th><?= $res[1][0][8]?></th>
                        <th><?= $res[1][0][9]?></th>
                        <th><?= $res[1][0][10]?></th>
                        <th><?= $res[1][0][11]?></th>
                        <th><?= $res[1][0][12]?></th>
                        <th><?= $res[1][0][13]?></th>

                    </tr>

                    <?php $n=0; foreach ($sec_1 as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->name_cyr ?></td>
                            <td><?= $item->sector ?></td>
                            <td><?= $res[1][$item->id][4]?></td>
                            <td><?= $res[1][$item->id][5]?></td>
                            <td><?= $res[1][$item->id][6]?></td>
                            <td><?= $res[1][$item->id][7]?></td>
                            <td><?= $res[1][$item->id][8]?></td>
                            <td><?= $res[1][$item->id][9]?></td>
                            <td><?= $res[1][$item->id][10]?></td>
                            <td><?= $res[1][$item->id][11]?></td>
                            <td><?= $res[1][$item->id][12]?></td>
                            <td><?= $res[1][$item->id][13]?></td>

                        </tr>
                    <?php endforeach;?>

                    <tr>
                        <th><?= $res[2][0][1]?></th>
                        <th>2-сектор</th>
                        <th>2</th>
                        <th><?= $res[2][0][4]?></th>
                        <th><?= $res[2][0][5]?></th>
                        <th><?= $res[2][0][6]?></th>
                        <th><?= $res[2][0][7]?></th>
                        <th><?= $res[2][0][8]?></th>
                        <th><?= $res[2][0][9]?></th>
                        <th><?= $res[2][0][10]?></th>
                        <th><?= $res[2][0][11]?></th>
                        <th><?= $res[2][0][12]?></th>
                        <th><?= $res[2][0][13]?></th>

                    </tr>

                    <?php $n=0; foreach ($sec_2 as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->name_cyr ?></td>
                            <td><?= $item->sector ?></td>
                            <td><?= $res[2][$item->id][4]?></td>
                            <td><?= $res[2][$item->id][5]?></td>
                            <td><?= $res[2][$item->id][6]?></td>
                            <td><?= $res[2][$item->id][7]?></td>
                            <td><?= $res[2][$item->id][8]?></td>
                            <td><?= $res[2][$item->id][9]?></td>
                            <td><?= $res[2][$item->id][10]?></td>
                            <td><?= $res[2][$item->id][11]?></td>
                            <td><?= $res[2][$item->id][12]?></td>
                            <td><?= $res[2][$item->id][13]?></td>

                        </tr>
                    <?php endforeach;?>

                    <tr>
                        <th><?= $res[3][0][1]?></th>
                        <th>3-сектор</th>
                        <th>3</th>
                        <th><?= $res[3][0][4]?></th>
                        <th><?= $res[3][0][5]?></th>
                        <th><?= $res[3][0][6]?></th>
                        <th><?= $res[3][0][7]?></th>
                        <th><?= $res[3][0][8]?></th>
                        <th><?= $res[3][0][9]?></th>
                        <th><?= $res[3][0][10]?></th>
                        <th><?= $res[3][0][11]?></th>
                        <th><?= $res[3][0][12]?></th>
                        <th><?= $res[3][0][13]?></th>

                    </tr>

                    <?php $n=0; foreach ($sec_3 as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->name_cyr ?></td>
                            <td><?= $item->sector ?></td>
                            <td><?= $res[3][$item->id][4]?></td>
                            <td><?= $res[3][$item->id][5]?></td>
                            <td><?= $res[3][$item->id][6]?></td>
                            <td><?= $res[3][$item->id][7]?></td>
                            <td><?= $res[3][$item->id][8]?></td>
                            <td><?= $res[3][$item->id][9]?></td>
                            <td><?= $res[3][$item->id][10]?></td>
                            <td><?= $res[3][$item->id][11]?></td>
                            <td><?= $res[3][$item->id][12]?></td>
                            <td><?= $res[3][$item->id][13]?></td>

                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <th><?= $res[4][0][1]?></th>
                        <th>4-сектор</th>
                        <th>4</th>
                        <th><?= $res[4][0][4]?></th>
                        <th><?= $res[4][0][5]?></th>
                        <th><?= $res[4][0][6]?></th>
                        <th><?= $res[4][0][7]?></th>
                        <th><?= $res[4][0][8]?></th>
                        <th><?= $res[4][0][9]?></th>
                        <th><?= $res[4][0][10]?></th>
                        <th><?= $res[4][0][11]?></th>
                        <th><?= $res[4][0][12]?></th>
                        <th><?= $res[4][0][13]?></th>

                    </tr>

                    <?php $n=0; foreach ($sec_4 as $item): $n++?>
                        <tr>
                            <td><?= $n?></td>
                            <td><?= $item->name_cyr ?></td>
                            <td><?= $item->sector ?></td>
                            <td><?= $res[4][$item->id][4]?></td>
                            <td><?= $res[4][$item->id][5]?></td>
                            <td><?= $res[4][$item->id][6]?></td>
                            <td><?= $res[4][$item->id][7]?></td>
                            <td><?= $res[4][$item->id][8]?></td>
                            <td><?= $res[4][$item->id][9]?></td>
                            <td><?= $res[4][$item->id][10]?></td>
                            <td><?= $res[4][$item->id][11]?></td>
                            <td><?= $res[4][$item->id][12]?></td>
                            <td><?= $res[4][$item->id][13]?></td>

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