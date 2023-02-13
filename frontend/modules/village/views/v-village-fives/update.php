<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageFives $model */

$this->title = 'Маҳалла фаолларининг маълумотларини ўзгартириш';
$this->params['breadcrumbs'][] = ['label' => 'V Village Fives', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="vvillage-fives-update">


    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
