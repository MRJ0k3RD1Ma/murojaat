<?php

use common\models\Appeal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\AppealSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appeals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appeal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pursuit',
            'passport',
            'passport_jshshir',
            'person_id',
            //'person_name',
            //'person_phone',
            //'date_of_birth',
            //'gender',
            //'soato_id',
            //'address',
            //'email:email',
            //'businessman',
            //'isbusinessman',
            //'appeal_preview:ntext',
            //'appeal_detail:ntext',
            //'appeal_file',
            //'question_id',
            //'executor_files:ntext',
            //'appeal_file_extension',
            //'appeal_type_id',
            //'appeal_shakl_id',
            //'appeal_control_id',
            //'count_applicant',
            //'count_list',
            //'status',
            //'deadtime',
            //'created',
            //'updated',
            //'boshqa_tashkilot',
            //'boshqa_tashkilot_number',
            //'boshqa_tashkilot_date',
            //'boshqa_tashkilot_id',
            //'answer_name',
            //'answer_file',
            //'answer_preview',
            //'answer_detail:ntext',
            //'answer_reply_send',
            //'answer_number',
            //'answer_date',
            //'company_id',
            //'register_id',
            //'register_company_id',
            //'type',
            //'number',
            //'year',
            //'number_full',
            //'employment_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Appeal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
