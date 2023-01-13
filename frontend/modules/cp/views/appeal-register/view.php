<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AppealRegister $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="appeal-register-view">

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
            'number',
            'date',
            'question_id',
            'appeal_id',
            'rahbar_id',
            'ijrochi_id',
            'users:ntext',
            'user_answer:ntext',
            'tashkilot:ntext',
            'tashkilot_answer:ntext',
            'parent_bajaruvchi_id',
            'deadline',
            'deadtime',
            'donetime',
            'control_id',
            'status',
            'created',
            'updated',
            'reply_send',
            'preview',
            'detail:ntext',
            'file',
            'company_id',
            'answer_send',
            'nazorat',
            'takroriy',
            'takroriy_id',
            'takroriy_date',
            'takroriy_number',
        ],
    ]) ?>

</div>
