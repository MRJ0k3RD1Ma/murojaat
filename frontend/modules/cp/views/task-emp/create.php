<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TaskEmp $model */

$this->title = 'Create Task Emp';
$this->params['breadcrumbs'][] = ['label' => 'Task Emps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-emp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
