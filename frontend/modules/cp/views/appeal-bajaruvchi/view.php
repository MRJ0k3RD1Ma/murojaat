<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AppealBajaruvchi $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Bajaruvchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="appeal-bajaruvchi-view">

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
            'company_id',
            'appeal_id',
            'register_id',
            'sender_id',
            'task:ntext',
            'deadline',
            'deadtime',
            'created',
            'status',
            'letter',
            'updated',
        ],
    ]) ?>

</div>
