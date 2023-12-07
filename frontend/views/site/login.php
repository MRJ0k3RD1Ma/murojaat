<?php

use yii\widgets\ActiveForm;

$this->title ="Tizimga kirish";
/* @var $model \common\models\LoginForm */
?>
<div class="login-page">
    <div class="login">
        <div class="logos">
            <div class="img">
                <img src="/gerb-144.png" alt="img" style="float: right; width: 50px;" class="img-responsive">
            </div>
            <div class="text">
                <b>E-MUROJAAT.UZ</b> - Хоразм вилояти ҳокимлигининг автоматлаштирилган мурожаатлар мониторинги ахборот тизими
            </div>
        </div>
        <div class="login-form">
            <h3>Тизимга кириш</h3>
            <p>E-murojaat.uz ахборот тизимига хуш келибсиз!</p>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "{input}",
                ],
            ]); ?>
            <div class="form">
                <div class="input">
                    <span class="far fa-user"></span>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => '', 'placeholder' => 'Login']) ?>

                </div>
                <div class="input">
                    <span class="fas fa-lock"></span>
                    <?= $form->field($model, 'password')->passwordInput(['class' => '', 'placeholder' =>'Parol']) ?>
                </div>


                <div class="sign row">
                    <div class="col-md-6">
                        <button class="btn btn-success btn-block">Кириш</button>
                    </div>
                    <div class="col-md-6">
                        <button onclick="location.href='https://t.me/emurojaatuz';" class="btn btn-default btn-block">Боғланиш</button>
                    </div>
                </div>


            </div>
            <?php ActiveForm::end() ?>
        </div>

        <!--<div class="logos">
            <div class="img">
                <img src="/rir300.png" alt="img" style="float: right; width: 50px;" class="img-responsive">
            </div>
            <div class="text">Ахборот тизими <a href="http://raqamli.uz" style="color: white">"Рақамли иқтисодиётни ривожлантириш"</a> маркази томонидан яратилган</div>
        </div>-->

        <div class="sign row" style="margin: 0px 10px;">
            <div class="col-md-6">
                <a href="tel:+998622231878" class="btn btn-success btn-block"><span class="fa fa-phone-alt fa-sm"></span> +998 (62) 223 18 78</a>
            </div>
            <div class="col-md-6">
                <a href="tel:+998787704037" class="btn btn-success btn-block"><span class="fa fa-phone-alt fa-sm"></span> +998 (78) 770 40 37</a>
            </div>
        </div>

    </div>


</div>

<!--LiveInternet counter--><a href="https://www.liveinternet.ru/click"
                              target="_blank"><img id="licntE6DF" width="88" height="31" style="border:0"
                                                   title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
                                                   src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"
                                                   alt=""/></a><script>(function(d,s){d.getElementById("licntE6DF").src=
        "https://counter.yadro.ru/hit?t16.6;r"+escape(d.referrer)+
        ((typeof(s)=="undefined")?"":";s"+s.width+"*"+s.height+"*"+
            (s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+
        ";h"+escape(d.title.substring(0,150))+";"+Math.random()})
    (document,screen)</script><!--/LiveInternet-->
qwe

