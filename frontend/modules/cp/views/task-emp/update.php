<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TaskEmp $model */

$this->title = 'Update Task Emp: ' . $model->sender_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Emps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sender_id, 'url' => ['view', 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-emp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
