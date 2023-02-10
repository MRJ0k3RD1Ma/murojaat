<?php

use common\models\VVillageProblem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageProblemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'V Village Problems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-problem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create V Village Problem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'village_id',
            'kinship',
            'year',
            'name',
            //'detail:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VVillageProblem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'village_id' => $model->village_id]);
                 }
            ],
        ],
    ]); ?>


</div>
