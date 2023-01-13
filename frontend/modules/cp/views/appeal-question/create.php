<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealQuestion $model */

$this->title = 'Create Appeal Question';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
