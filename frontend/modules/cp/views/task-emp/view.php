<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\TaskEmp $model */

$this->title = $model->sender_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Emps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-emp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sender_id',
            'reciever_id',
            'register_id',
            'appeal_id',
            'deadtime',
            'task:ntext',
            'letter',
            'created',
            'updated',
            'status',
        ],
    ]) ?>

</div>
