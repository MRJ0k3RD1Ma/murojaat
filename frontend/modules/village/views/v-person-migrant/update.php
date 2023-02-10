<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VPersonMigrant $model */

$this->title = 'Update V Person Migrant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'V Person Migrants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'village_id' => $model->village_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vperson-migrant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
