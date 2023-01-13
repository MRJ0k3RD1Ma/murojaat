<?php

use common\models\AppealBajaruvchi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\AppealBajaruvchiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appeal Bajaruvchis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-bajaruvchi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appeal Bajaruvchi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'appeal_id',
            'register_id',
            'sender_id',
            //'task:ntext',
            //'deadline',
            //'deadtime',
            //'created',
            //'status',
            //'letter',
            //'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AppealBajaruvchi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
