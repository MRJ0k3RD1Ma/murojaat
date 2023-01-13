<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Lavozim $model */

$this->title = 'Update Lavozim: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lavozim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
