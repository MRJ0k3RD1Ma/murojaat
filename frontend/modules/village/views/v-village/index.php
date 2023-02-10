<?php

use common\models\VVillage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VVillageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'V Villages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create V Village', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'sector',
            'soato_id',
            'date',
            //'road',
            //'address',
            //'person_name',
            //'person_birthday',
            //'has_cl_problem',
            //'want_econom_energy',
            //'econom_energy_credit',
            //'econom_energy_own',
            //'econom_energy',
            //'want_credit',
            //'credit',
            //'credit_women',
            //'credit_young',
            //'want_subsidy',
            //'subsidy_women',
            //'subsidy_young',
            //'subsidy',
            //'migrant',
            //'home_status_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VVillage $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
