<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/village/'])?>" class="nav-link">

        <p><i class="nav-icon fas fa-list"></i>
            Сўровнома (Андижон тажрибаси)
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'notregister'
    )?'active':''?>">

        <p><i class="nav-icon fas fa-registered"></i>
            Рўйхатга олинмаган
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/index'])?>" class="nav-link
                <?=(Yii::$app->controller->id=='appeal'
        and Yii::$app->controller->action->id == 'index'
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
    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/tosayyor'])?>" class="nav-link
                    <?=(Yii::$app->controller->id=='appeal' and Yii::$app->controller->action->id == 'tosayyor')?'active':''?>">

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

        <p><i class="nav-icon fas fa-sync"></i>
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
