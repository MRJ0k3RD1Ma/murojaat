<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */

$this->title = 'Create V Village';
$this->params['breadcrumbs'][] = ['label' => 'V Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
