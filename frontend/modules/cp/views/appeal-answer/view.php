<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AppealAnswer $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="appeal-answer-view">

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
            'appeal_id',
            'register_id',
            'parent_id',
            'preview',
            'detail:ntext',
            'number',
            'date',
            'tarqatma_number',
            'tarqatma_date',
            'bajaruvchi_id',
            'reaply_send',
            'name',
            'file',
            'status',
            'status_boshqa',
            'created',
            'updated',
        ],
    ]) ?>

</div>
