<?php

use yii\helpers\Url; ?>
<!-- Sidebar Menu -->



<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/region/'])?>" class="nav-link <?=(Yii::$app->controller->id=='default' && Yii::$app->controller->action->id=='index')?'active':''?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Бош саҳифа
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/region/v-village'])?>" class="nav-link <?=(Yii::$app->controller->id=='v-village')?'active':''?>">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Сўровнома
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Статистикалар
                </p>
            </a>

            <ul class="nav nav-treeview" style="display: none;">

                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/region/default/statmahalla'])?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Туман(шаҳар)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/region/default/statproblem'])?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Муаммолар
                        </p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
