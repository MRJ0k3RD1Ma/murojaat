<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageFives $model */

$this->title = 'Create V Village Fives';
$this->params['breadcrumbs'][] = ['label' => 'V Village Fives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-fives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
