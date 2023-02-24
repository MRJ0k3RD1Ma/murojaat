<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VVillageProblem */

$this->title = 'Қўшиш V Village Problem';
$this->params['breadcrumbs'][] = ['label' => 'V Village Problems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-problem-create">

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
