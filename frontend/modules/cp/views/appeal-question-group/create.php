<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealQuestionGroup $model */

$this->title = 'Create Appeal Question Group';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Question Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
