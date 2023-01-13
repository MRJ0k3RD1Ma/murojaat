<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AppealAnswer $model */

$this->title = 'Create Appeal Answer';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
