<?php

use common\models\AppealQuestion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\AppealQuestionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appeal Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appeal Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'group_id',
            [
                'attribute'=>'group_id',
                'value'=>function($d){
                    $gr = $d->group;
                    return  $gr->code.'-'.$gr->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\AppealQuestionGroup::find()->all(),'id','name')
            ],
            'code',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AppealQuestion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
