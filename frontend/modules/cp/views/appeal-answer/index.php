<?php

use common\models\AppealAnswer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\AppealAnswerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appeal Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appeal Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'appeal_id',
            'register_id',
            'parent_id',
            'preview',
            //'detail:ntext',
            //'number',
            //'date',
            //'tarqatma_number',
            //'tarqatma_date',
            //'bajaruvchi_id',
            //'reaply_send',
            //'name',
            //'file',
            //'status',
            //'status_boshqa',
            //'created',
            //'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AppealAnswer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
