<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */

$this->title = 'Update V Village: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'V Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vvillage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
