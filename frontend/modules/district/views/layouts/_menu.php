<?php

use yii\helpers\Url; ?>
<!-- Sidebar Menu -->



<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/village/'])?>" class="nav-link <?=(Yii::$app->controller->id=='default' && Yii::$app->controller->action->id=='index')?'active':''?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Бош саҳифа
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Мурожаатлар
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/district/v-village'])?>" class="nav-link <?=(Yii::$app->controller->id=='v-village')?'active':''?>">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Сўровнома
                </p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
