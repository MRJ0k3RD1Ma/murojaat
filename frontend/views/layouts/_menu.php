<?php

use yii\helpers\Url; ?>
<!-- Sidebar Menu -->



<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item has-treeview">
            <a href="/" class="nav-link ">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    <?= Yii::$app->user->identity->name?>
                </p>
            </a>

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['#'])?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Созламалар
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['#'])?>" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Ташкилот маълумотлари
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['#'])?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Ҳодимлар рўйхати
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['#'])?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Профил
                        </p>
                    </a>
                </li>

            </ul>
        </li>




        <?php

        $user = Yii::$app->user->identity;
        if ($user->access(2)) {
            echo $this->render('_menu_registrator');
        } else {
            echo $this->render('_menu_user');
        }
        ?>

    </ul>
</nav>
<!-- /.sidebar-menu -->

<style>
    .nav-treeview{
        background: rgb(0 0 0 / 10%) !important;
    }
</style>

