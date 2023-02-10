<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VHomeStatus $model */

$this->title = 'Create V Home Status';
$this->params['breadcrumbs'][] = ['label' => 'V Home Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vhome-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
