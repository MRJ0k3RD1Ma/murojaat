<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bulim $model */

$this->title = 'Create Bulim';
$this->params['breadcrumbs'][] = ['label' => 'Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
