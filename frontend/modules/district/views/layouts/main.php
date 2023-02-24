<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .swal2-checkbox{
            display: none !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php $this->beginBody() ?>
<script>
    function filter() {

    }
    function close_modal() {

    }
    function person_export() {

    }
    function close_export() {

    }

</script>

<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block align-center">
                <a href="/" class="nav-link">
                    "E-MUROJAAT.UZ" axborot tizimi
                </a>
            </li>

        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


            <li class="nav-item">
                <?=Html::a('<i class="fa fa-door-open"></i> Chiqish',['/site/logout'],[
                    'class'=>'nav-link',
                    'data' => [
                        'confirm' => Yii::t('app', 'Haqiqatdan ham dasturdan chiqmoqchimisiz?'),
                        'method' => 'post',
                    ],
                ])?>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary">
        <!-- Brand Logo -->
        <div align="center">
            <br>
            <img src="/logo_2.png" style="max-width: 80%;width: 100px;" alt="logo">
            <br>
            <div style="padding: 10px;" class="brand-text text-white">
                "E-MUROJAAT.UZ" автоматлаштирилган мурожаатлар мониторинги ахборот тизими
            </div>
        </div>
        <hr />

        <!-- Sidebar -->
        <div class="sidebar">

            <?=$this->render('_menu')?>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?=$this->render('_brandcrubs')?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
               <?=$content?>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer hidden-sm hidden-xs" style="position: relative">
        <strong>© "E-MUROJAAT.UZ" ахборот тизими <a href="http://raqamli.uz">"Рақамли иқтисодиётни ривожлантириш" МЧЖ</a> томонидан ишлаб чиқарилган.</strong>
        Барча ҳуқуқлар ҳимояланган.

    </footer>
</div>


<?php
if(Yii::$app->session->hasFlash('error')){
    $txt = Yii::$app->session->getFlash('error');
    $xato = 'Хатолик';
    $this->registerJs("
        $(document).ready(function(){
            Swal.fire({
              icon: 'error',
              title: \"{$xato}\",
              text: \"{$txt}\"
            })
        })
    ");

}
if(Yii::$app->session->hasFlash('success')){
    $txt = Yii::$app->session->getFlash('success');
    $xato = 'Muvvofaqiyatli';
    $this->registerJs("
        $(document).ready(function(){
            Swal.fire({
              icon: 'success',
              title: \"{$xato}\",
              text: \"{$txt}\"
            })
        })
    ");

}
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
