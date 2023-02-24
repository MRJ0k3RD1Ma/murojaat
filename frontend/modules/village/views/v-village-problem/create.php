<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VVillageProblem $model */

$this->title = 'Create V Village ProblemController';
$this->params['breadcrumbs'][] = ['label' => 'V Village Problems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-problem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
