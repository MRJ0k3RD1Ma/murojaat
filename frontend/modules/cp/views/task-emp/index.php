<?php

use common\models\TaskEmp;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\TaskEmpSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Task Emps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-emp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task Emp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sender_id',
            'reciever_id',
            'register_id',
            'appeal_id',
            'deadtime',
            //'task:ntext',
            //'letter',
            //'created',
            //'updated',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TaskEmp $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'sender_id' => $model->sender_id, 'reciever_id' => $model->reciever_id, 'register_id' => $model->register_id, 'appeal_id' => $model->appeal_id]);
                 }
            ],
        ],
    ]); ?>


</div>
