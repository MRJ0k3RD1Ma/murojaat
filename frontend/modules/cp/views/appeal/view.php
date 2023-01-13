<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Appeal $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="appeal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'pursuit',
            'passport',
            'passport_jshshir',
            'person_id',
            'person_name',
            'person_phone',
            'date_of_birth',
            'gender',
            'soato_id',
            'address',
            'email:email',
            'businessman',
            'isbusinessman',
            'appeal_preview:ntext',
            'appeal_detail:ntext',
            'appeal_file',
            'question_id',
            'executor_files:ntext',
            'appeal_file_extension',
            'appeal_type_id',
            'appeal_shakl_id',
            'appeal_control_id',
            'count_applicant',
            'count_list',
            'status',
            'deadtime',
            'created',
            'updated',
            'boshqa_tashkilot',
            'boshqa_tashkilot_number',
            'boshqa_tashkilot_date',
            'boshqa_tashkilot_id',
            'answer_name',
            'answer_file',
            'answer_preview',
            'answer_detail:ntext',
            'answer_reply_send',
            'answer_number',
            'answer_date',
            'company_id',
            'register_id',
            'register_company_id',
            'type',
            'number',
            'year',
            'number_full',
            'employment_id',
        ],
    ]) ?>

</div>
