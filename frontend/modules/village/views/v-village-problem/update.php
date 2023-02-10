<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageProblem $model */

$this->title = 'Update V Village Problem: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'V Village Problems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'village_id' => $model->village_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vvillage-problem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
