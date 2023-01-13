<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Lavozim $model */

$this->title = 'Create Lavozim';
$this->params['breadcrumbs'][] = ['label' => 'Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lavozim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
