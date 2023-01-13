<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealRegister $model */

$this->title = 'Update Appeal Register: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
