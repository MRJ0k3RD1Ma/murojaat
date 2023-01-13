<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBajaruvchi $model */

$this->title = 'Update Appeal Bajaruvchi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Bajaruvchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-bajaruvchi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
