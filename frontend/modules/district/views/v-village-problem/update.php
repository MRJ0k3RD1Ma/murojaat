<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VVillageProblem */

$this->title = 'Update V Village Problem: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'V Village Problems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'village_id' => $model->village_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vvillage-problem-update">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
