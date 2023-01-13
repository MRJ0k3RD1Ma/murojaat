<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealBoshqaTashkilot $model */

$this->title = 'Create Appeal Boshqa Tashkilot';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Boshqa Tashkilots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-boshqa-tashkilot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
