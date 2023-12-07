<?php

use yii\widgets\Breadcrumbs; ?>
<div class="content-header">
    <? if ($_SERVER['REQUEST_URI'] != '/appeal/index') { ?>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?=$this->title?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <?= Breadcrumbs::widget([
                    'options'=>[
                        'class'=>'breadcrumb float-sm-right',
                    ],
                    'tag'=>'ol',
                    'itemTemplate'=>' <li class="breadcrumb-item">{link}</li>',
                    'activeItemTemplate'=>' <li  class="breadcrumb-item active" >{link}</li>',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <? } // agar bosh sahifa bo'lmasa ?>
</div>
<!-- /.content-header -->


