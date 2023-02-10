<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageFives $model */

$this->title = 'Update V Village Fives: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'V Village Fives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vvillage-fives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
