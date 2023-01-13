<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBoshqaTashkilotGroup $model */

$this->title = 'Update Appeal Boshqa Tashkilot Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilot Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-boshqa-tashkilot-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
