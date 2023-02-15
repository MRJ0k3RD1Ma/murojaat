<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */

$this->title = 'Сўровнома';
$this->params['breadcrumbs'][] = ['label' => 'Маҳаллалар бешлиги томонидан хонадонларда ўтказиладиган СЎРОВНОМА', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-create">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Сўровнома қўшиш
            </h3>
            <div class="card-tools">
                <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/village/v-village'])?>">Рўйхатга ўтиш</a>
            </div>
        </div>
        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
