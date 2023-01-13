<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealRegister $model */

$this->title = 'Create Appeal Register';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
