<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Appeal */
/* @var $register common\models\AppealRegister */

$this->title = 'Мурожаат қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Мурожаатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-create">

    <div class="row">
        <div class="col-12">

                    <?= $this->render('_form', [
                    'model' => $model,
                    'register'=>$register,
                    ]) ?>

        </div>
    </div>


</div>
