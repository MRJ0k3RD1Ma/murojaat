<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Complex $model */

$this->title = 'Create Complex';
$this->params['breadcrumbs'][] = ['label' => 'Complexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
