<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBoshqaTashkilot $model */

$this->title = 'Update Appeal Boshqa Tashkilot: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-boshqa-tashkilot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
