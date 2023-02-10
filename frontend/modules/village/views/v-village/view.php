<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\VVillage $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'V Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vvillage-view">

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
            'user_id',
            'sector',
            'soato_id',
            'date',
            'road',
            'address',
            'person_name',
            'person_birthday',
            'has_cl_problem',
            'want_econom_energy',
            'econom_energy_credit',
            'econom_energy_own',
            'econom_energy',
            'want_credit',
            'credit',
            'credit_women',
            'credit_young',
            'want_subsidy',
            'subsidy_women',
            'subsidy_young',
            'subsidy',
            'migrant',
            'home_status_id',
        ],
    ]) ?>

</div>
