<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\AppealBajaruvchi;
use common\models\AppealRegister;
use common\widgets\Alert;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
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
    <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background-color: #014e6c;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block align-center">
                <a href="/" class="nav-link">
                    "E-MUROJAAT.UZ" Ахборот тизими
                </a>
            </li>

        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


            <?php if(!Yii::$app->user->isGuest and Yii::$app->user->identity->access(2)){?>

               <?php if(Yii::$app->user->identity->access(3)){ ?>
                    <li class="nav-item" style="margin-right: 10px;"><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/tohok'])?>" class="btn btn-primary"><span class="fa fa-plus"></span> Янги мурожаат</a></li>

               <?php }else{?>
                    <li class="nav-item" style="margin-right: 10px;"><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/create'])?>" class="btn btn-primary"><span class="fa fa-plus"></span> Янги мурожаат</a></li>

                <?php }?>

                <!-- <li class="nav-item"><a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="btn btn-success"><span class="fa fa-registered"></span> Рўйхатга олинмаган</a></li> -->

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-envelope"></i>
                        <span class="badge badge-warning navbar-badge mycolor">


                        <?php $cnt_ans = \common\models\AppealBajaruvchi::find()
                            ->where('register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')')
                            ->andWhere(['status'=>3])->count('id');

                        echo $cnt_ans?>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Жавоби келган</span>
                        <div class="dropdown-divider"></div>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/answered'])?>" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> <?= $cnt_ans ?> та жавоб келган
                        </a>

                    </div>
                </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-sync"></i>
                    <span class="badge badge-warning navbar-badge mycolor">
                    <?php
                    $request_deadline_comp = \common\models\Request::find()
                        ->where('(reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')) and '.
                            '(sender_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.'))'
                        )
                        ->andWhere(['type_id'=>1])
                        ->andWhere(['<=','status_id',1])
                        ->count('id');

                    $request_deadline_user = \common\models\Request::find()
                        ->where('(reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')) and '.
                            '(sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.'))'
                        )
                        ->andWhere(['type_id'=>1])
                        ->andWhere(['<=','status_id',1])
                        ->count('id');

                    $request_change_comp = \common\models\Request::find()
                        ->where('(reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')) and '.
                            '(sender_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.'))'
                        )
                        ->andWhere(['type_id'=>2])
                        ->andWhere(['<=','status_id',1])
                        ->count('id');

                    $request_change_user = \common\models\Request::find()
                        ->where('(reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')) and '.
                            '(sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.'))'
                        )
                        ->andWhere(['type_id'=>2])
                        ->andWhere(['<=','status_id',1])
                        ->count('id');

                    echo $request_deadline_comp+$request_deadline_user+$request_change_comp+$request_change_user;
                    ?>
                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Муддат узайтиришга</span>
                    <div class="dropdown-divider"></div>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/request','do'=>'time'])?>" class="dropdown-item">
                        <i class="fas fa-clock mr-2"></i> <?= $request_deadline_comp ?> та бошқа ташкилотдан
                    </a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/request','do'=>'timemy'])?>" class="dropdown-item">
                        <i class="fas fa-clock mr-2"></i> <?= $request_deadline_user ?> та ҳодимлардан
                    </a>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item dropdown-header">Ижрочини ўзгартиришга</span>
                    <div class="dropdown-divider"></div>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/request','do'=>'reject'])?>" class="dropdown-item">
                        <i class="fas fa-random mr-2"></i> <?= $request_change_comp ?> та бошқа ташкилотдан
                    </a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/request','do'=>'rejectmy'])?>" class="dropdown-item">
                        <i class="fas fa-random mr-2"></i> <?= $request_change_user ?> та ҳодимлардан
                    </a>

                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge mycolor"><?php
                        $cnt = \common\models\AppealBajaruvchi::find()->where(['<=','status',1])->andWhere(['company_id'=>Yii::$app->user->identity->company_id])->count('id');

                        if(Yii::$app->user->identity->company_id == 1){
                            $cnt2 = \common\models\Appeal::find()->where(['type'=>1])->andWhere(['<','status',2])->count('id');
                            echo $cnt +  $cnt2;
                        }else{
                            $cnt2 = \common\models\Appeal::find()->where(['type'=>1])->andWhere(['<','status',2])->count('id');
                            echo $cnt ;
                        }
                        ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Мурожаатлар</span>
                    <div class="dropdown-divider"></div>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?= $cnt ?> та рўйхатга олинмаган
                    </a>
                    <?php if(Yii::$app->user->identity->company_id==1){?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregvil'])?>" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> <?= $cnt2 ?> та МФЙ орқали келган
                        </a>
                    <?php }?>

                </div>
            </li>
            <?php }else{?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-envelope"></i>
                        <span class="badge badge-warning navbar-badge mycolor">


                        <?php $cnt_ans = AppealBajaruvchi::find()
                            ->where('register_id in (select id from appeal_register where company_id='.\Yii::$app->user->identity->company_id.')')
                            ->andWhere(['status'=>3])->andWhere(['sender_id'=>Yii::$app->user->identity->id])
                            ->count('id'); echo $cnt_ans ?>


                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Жавоби келган</span>
                        <div class="dropdown-divider"></div>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/site/answered'])?>" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> <?= $cnt_ans ?> та жавоб келган
                        </a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge mycolor"><?php
                            $cnt1 = AppealRegister::find()
                                ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
                                ->where(['appeal_register.company_id'=>Yii::$app->user->identity->company_id])
                                ->where('appeal_register.id in (select register_id from task_emp where (reciever_id='.\Yii::$app->user->id.' or sender_id='.\Yii::$app->user->id.') and status=0)')
                                ->orderBy(['appeal_register.deadtime'=>SORT_DESC])->count('appeal_register.id');
                            echo  $cnt1;
                            ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Мурожаатлар</span>
                        <div class="dropdown-divider"></div>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/site/index','status'=>0])?>" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> <?= $cnt1 ?> та менга келган
                        </a>

                    </div>
                </li>
            <?php }?>
            <li class="nav-item">
                <?=Html::a('<i class="fa fa-door-open"></i> Чиқиш',['/site/logout'],[
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
            <br />
            <a href="/"><img src="/theme/dist/img/gerb_uzb.png" width="100" style="max-width: 80%;" alt="logo" title="Bosh sahifa" /></a>
            <br />
            <div style="padding: 10px;" class="brand-text text-white">
                <b>E-MUROJAAT.UZ</b> автоматлаштирилган мурожаатлар мониторинги ахборот тизими
            </div>
        </div>
        <hr />

        <!-- Sidebar -->
        <div class="sidebar">

            <?=$this->render('_menu')?>

            <hr />
            <div class="nav-header text-center">Тел: +998 (62) 223-18-78</div>

            <div  align="center">
                <a href="https://t.me/emurojaatuz" target="_blank" class="telegram-button-link"><div class="telegram-button">
                    <p>
                        <i class="fab fa-telegram-plane"></i>
                        Телеграм гуруҳга аъзо бўлинг
                    </p>
                </a>
            </div>

            </div>

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


<?php

if (Yii::$app->user->identity->id == '55') {
    $style = 'style="opacity: 1;"';
} else {
    $style = 'style="opacity: 0;"';
}

?>


<!-- Yandex.RTB -->
<script>window.yaContextCb=window.yaContextCb||[]</script>

<script src="https://yandex.ru/ads/system/context.js" async></script>


    <!-- Main Footer -->
    <footer class="main-footer hidden-sm hidden-xs" style="position: relative">
        <strong>&copy; "E-MUROJAAT.UZ" ахборот тизими <a href="http://raqamli.uz">"Рақамли иқтисодиётни ривожлантириш" МЧЖ</a> томонидан ишлаб чиқарилган.</strong>
        Барча ҳуқуқлар ҳимояланган.
        <div class="float-right" <? echo $style; ?>>
            <!--LiveInternet counter-->
            <a href="https://www.liveinternet.ru/click" target="_blank">
                <img
                        id="licntE6DF"
                        width="88"
                        height="31"
                        style="border: 0;"
                        title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"
                        alt=""
                />
            </a>
            <script>
                (function (d, s) {
                    d.getElementById("licntE6DF").src =
                        "https://counter.yadro.ru/hit?t16.6;r" +
                        escape(d.referrer) +
                        (typeof s == "undefined" ? "" : ";s" + s.width + "*" + s.height + "*" + (s.colorDepth ? s.colorDepth : s.pixelDepth)) +
                        ";u" +
                        escape(d.URL) +
                        ";h" +
                        escape(d.title.substring(0, 150)) +
                        ";" +
                        Math.random();
                })(document, screen);
            </script>
            <!--/LiveInternet-->



            <!-- Yandex.RTB R-A-2503530-1 -->
            <div id="yandex_rtb_R-A-2503530-1"></div>
            <script>window.yaContextCb.push(()=>{
                    Ya.Context.AdvManager.render({
                        "blockId": "R-A-2503530-1",
                        "renderTo": "yandex_rtb_R-A-2503530-1"
                    })
                })
            </script>


        </div>

    </footer>
</div>

    <?php $vil = Yii::$app->user->identity->access(3) or Yii::$app->user->identity->access(4); if($vil){?>
        <div class="telegram-popup" align="center">

            <p style="margin-bottom:-5px; color:#1682FB">Тел: +998(62)223-18-78</p>
            <!-- Telegram icon. I like to use font-awesome but dont want to effect your imports too much.-->
            <a href="<?= Yii::$app->urlManager->createUrl(['/village/'])?>" target="_blank" class="telegram-button-link"><div class="telegram-button">
                    <p>
                        <i class="fas fa-list"></i>
                        Сўровномага ўтиш
                    </p>

                </div></a>

        </div>
    <?php }?>


    <style>
        <?php if(!$vil){ ?>
            body.sidebar-collapse .telegram-popup{
                display: none !important;
            }
        <?php } ?>
        /*Body css here just to demonstrate scrolling*/
        .telegram-popup{
            width: 291px;
            position: fixed;
            <?= $vil ? 'bottom: 50px; right: 0px;' : 'bottom: 10px;left: -22px;'?>
            z-index: 2000;
            /*round corners*/
            border-radius: 10px;
            /*cool option borders.*/

            /*animate. hide on load*/
            display: <?= $vil ? 'block' : 'none'?>;
        }

        /*text stuff*/
        .telegram-popup p{
            color: #fff;
            padding: 4px;
        }

        .telegram-button{
            background-color: #1682FB;
            margin-top: 20px;
        }

        .telegram-button:hover{
            background-color: #1080F5;
        }

        .telegram-button p{
            color: #FFFFFF;
            font-size: 15px;
            /*padding makes the link like a bubble*/
            padding: 10px;
        }

        .telegram-button-link:link{
            text-decoration: none;
        }

        .swal2-checkbox input{
            display: none;
        }
        .mycolor{
            color: #ffffff !important;
            background-color: #9c27b0 !important;
        }
    </style>

    <?php
    if(!$vil){
        $this->registerJs("
        //Animation. 
        $(document).ready(function(){
            $(\".telegram-popup\").delay(3000).show(0);
        });
    ");
    }
    ?>
<?php
    $this->registerJs("
    $(document).ready(function() {
        $('.js-select2').select2();
    });
")
?>



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
    $xato = 'Муваффақиятли';
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