<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBoshqaTashkilotGroup $model */

$this->title = 'Create Appeal Boshqa Tashkilot Group';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilot Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-boshqa-tashkilot-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
