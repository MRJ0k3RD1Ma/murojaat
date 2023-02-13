<?php

use common\models\VVillageFives;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var $model VVillageFives */

$this->title = $model->company->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vvillage-fives-index">


    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('Ўзгартириш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
//            'id',
//            'company_id',
                    'mfy_rais',
                    'profilaktika_inspektor',
                    'hokim_yordamchi',
                    'xotin_qizlar',
                    'yoshlar_yetakchi',
                    'deputat',
                    'sector'
                ],
            ]) ?>
        </div>
    </div>


</div>
