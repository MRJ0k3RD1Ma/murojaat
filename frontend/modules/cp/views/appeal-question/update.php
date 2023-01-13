<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealQuestion $model */

$this->title = 'Update Appeal Question: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
