<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageFives $model */

$this->title = 'Маҳалла фаолларини қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Маҳалла фаоллари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-fives-create">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
