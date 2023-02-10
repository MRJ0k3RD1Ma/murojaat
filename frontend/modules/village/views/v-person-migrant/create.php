<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VPersonMigrant $model */

$this->title = 'Create V Person Migrant';
$this->params['breadcrumbs'][] = ['label' => 'V Person Migrants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vperson-migrant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
