<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBajaruvchi $model */

$this->title = 'Create Appeal Bajaruvchi';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Bajaruvchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-bajaruvchi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
