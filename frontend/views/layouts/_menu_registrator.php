<!--<li class="nav-item">
    <a href="<?php /*= Yii::$app->urlManager->createUrl(['/village/'])*/?>" class="nav-link">
        <p><i class="nav-icon fas fa-list"></i>
            Андижон тажрибаси
        </p>
    </a>
</li>-->


<?php
/*
?>
=(Yii::$app->controller->id=='appeal'
    and Yii::$app->controller->action->id == 'notregister'
)?'active':''
*/
?>


<?php
$cnt = \common\models\AppealBajaruvchi::find()->where(['<=','status',1])->andWhere(['company_id'=>Yii::$app->user->identity->company_id])->count('id');

if(Yii::$app->user->identity->company_id == 1){
    $cnt2 = \common\models\Appeal::find()->where(['type'=>1])->andWhere(['<','status',2])->count('id');
    //echo $cnt +  $cnt2;

    if ($cnt > '0' or $cnt2 > '0') {
        $style = 'faol';



        echo '
            <audio loop autoplay="autoplay" controls style="display: none;">
                <source src="/theme/dist/murojaat.mp3" type="audio/mp3">
            </audio>';
    }
}else{
    $cnt2 = \common\models\Appeal::find()->where(['type'=>1])->andWhere(['<','status',2])->count('id');
    if ($cnt > '0') {
        $style = 'faol';
        echo '
            <audio loop autoplay="autoplay" controls style="display: none;">
                <source src="/theme/dist/murojaat.mp3" type="audio/mp3">
            </audio>';
    }
}
?>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="nav-link <? echo $style; ?>">
        <p><i class="nav-icon fas fa-registered"></i>
            Рўйхатга олинмаган
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/list'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'list'
        and Yii::$app->controller->action->id != 'request'
        and Yii::$app->controller->action->id != 'notregister'
    )?'active':''?>">

        <p><i class="nav-icon fas fa-list"></i>
            Мурожаатлар рўйхати
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/answered'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'answered'
    )?'active':''?>">

        <p><i class="nav-icon fas fa-check"></i>
            Натижаси келган
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/tosayyor'])?>"
       class="nav-link <?=(Yii::$app->controller->id=='appeal' and Yii::$app->controller->action->id == 'tosayyor')?'active':''?>">
        <p><i class="nav-icon fas fa-plus"></i>
            Сайёр қабул
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/company/index'])?>" class="nav-link <?=(Yii::$app->controller->id=='company')?'active':''?>">

        <p><i class="nav-icon fas fa-list"></i>
            Ташкилотлар
        </p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-sync"></i>
        <p>
            Сўровлар
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'time'])?>" class="nav-link">

                <p><i class="nav-icon fas fa-clock"></i>
                    Муддат узайтириш
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'reject'])?>" class="nav-link">

                <p><i class="nav-icon fas fa-random"></i>
                    Ижрочини ўзгартириш
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/req/index','RequestSearch[do]'=>'answered'])?>" class="nav-link">

                <p><i class="nav-icon fas fa-check"></i>
                    Жавоби келган
                </p>
            </a>
        </li>

    </ul>
</li>


<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>
            Ҳисоботлар
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/report/index'])?>" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Раҳбарлар кесимида
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/report/index2'])?>" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Масалалар кесимида
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/report/index3'])?>" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p style="font-size: 13px;">
                    Қуйи ташкилотлар кесимида
                </p>
            </a>
        </li>
		<li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/report/index4'])?>" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p style="font-size: 13px;">
                    Масалалар кесимида<br>(жараёнда)
                </p>
            </a>
        </li>


    </ul>
</li>

<?php if(Yii::$app->user->identity->access(3)){?>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/indexhok'])?>" class="nav-link <?=(Yii::$app->controller->id=='appeal' and Yii::$app->controller->action->id == 'indexhok')?'active':''?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Вилоят ҳокимлигига юборилган
            </p>
        </a>
    </li>
<?php }?>


<style>
    .sidebar-mini .nav-sidebar, .sidebar-mini .nav-sidebar > .nav-header, .sidebar-mini .nav-sidebar .nav-link{
        white-space:normal !important;
    }
</style>
