<?php

use yii\helpers\Url; ?>
<!-- Sidebar Menu -->



<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/cp/'])?>" class="nav-link <?=(Yii::$app->controller->id=='default' && Yii::$app->controller->action->id=='index')?'active':''?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Бош саҳифа
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?=(Yii::$app->controller->id=='company' && Yii::$app->controller->action->id=='index')?'active':''?>">
                <i class="nav-icon fas fa-filter"></i>
                <p>
                    Ташкилотлар
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['/cp/company/index'])?>">
                        <i class="nav-icon fa fa-circle"></i>
                        <p>
                            Ташкилотлар
                        </p>
                    </a>
                </li>


            </ul>
        </li>


        <li class="nav-item">
            <a href="<?= Yii::$app->urlManager->createUrl(['/cp/service'])?>" class="nav-link <?=(Yii::$app->controller->id=='service')?'active':''?>">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Хизматлар
                </p>
            </a>
        </li>


    </ul>
</nav>
<!-- /.sidebar-menu -->
