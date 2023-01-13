<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bulim $model */

$this->title = 'Update Bulim: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bulim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
