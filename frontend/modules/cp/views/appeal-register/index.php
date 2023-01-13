<?php

use common\models\AppealRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\AppealRegisterSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appeal Registers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-register-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appeal Register', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'date',
            'question_id',
            'appeal_id',
            //'rahbar_id',
            //'ijrochi_id',
            //'users:ntext',
            //'user_answer:ntext',
            //'tashkilot:ntext',
            //'tashkilot_answer:ntext',
            //'parent_bajaruvchi_id',
            //'deadline',
            //'deadtime',
            //'donetime',
            //'control_id',
            //'status',
            //'created',
            //'updated',
            //'reply_send',
            //'preview',
            //'detail:ntext',
            //'file',
            //'company_id',
            //'answer_send',
            //'nazorat',
            //'takroriy',
            //'takroriy_id',
            //'takroriy_date',
            //'takroriy_number',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AppealRegister $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
