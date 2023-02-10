<?php

use common\models\VPersonMigrant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\VPersonMigrantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'V Person Migrants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vperson-migrant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create V Person Migrant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'village_id',
            'person_name',
            'birthday',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VPersonMigrant $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'village_id' => $model->village_id]);
                 }
            ],
        ],
    ]); ?>


</div>
