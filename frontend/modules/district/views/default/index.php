<div class="container-fluid">
    <div class="header-body">


        <!-- Card stats -->
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Ўрганилган ҳонадонлар
                                </h5>
                                <br />
                                <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">Умумий <b><?= prettyNumber(\common\models\VVillage::find()->where('soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->count('*')) ?></b> та сўровнома</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Бугун ўрганилган
                                </h5>
                                <br />
                                <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">Умумий <b><?= prettyNumber(\common\models\VVillage::find()->where('soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['date'=>date('Y-m-d')])->count('*')) ?></b> та сўровнома</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Эркаклар
                                </h5>
                                <br />
                                <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">Умумий <b><?= prettyNumber(\common\models\VVillage::find()->where('soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['gender'=>1])->count('*')) ?></b> та сўровнома</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Аёллар
                                </h5>
                                <br />
                                <span style="color: #32325d; background: url(/theme/dist/img/link_hover_tolqin.svg); padding-bottom: 3px;" class="h4 mb-0">Умумий <b><?= prettyNumber(\common\models\VVillage::find()->where('soato_id like "%'.Yii::$app->user->identity->company->soato_id.'%"')->andWhere(['gender'=>0])->count('*')) ?></b> нафар сўровнома</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Секторлар кусимида ўрганишлар</h5>
                    </div>
                </div>

                <div>
                    <div id="chart-gen"></div>
                </div>
            </div>
            <!-- end card-body -->


        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Секторлар кусимида ўрганишлар</h5>
                    </div>
                </div>

                <div>
                    <div id="chart"></div>
                </div>
            </div>
            <!-- end card-body -->


        </div>
    </div>
</div>



<?php

$this->registerJsFile("/theme/plugins/apexcharts/apexcharts.min.js");

$this->registerJs("
     var options = {
          series: {$series},
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['1-Сектор','2-Сектор','3-Сектор','4-Сектор'],
        },
        
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector(\"#chart\"), options);
        chart.render();
      
");

$this->registerJs("
     var options = {
          series: {$chart_gen},
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['1-Сектор','2-Сектор','3-Сектор','4-Сектор'],
        },
        
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector(\"#chart-gen\"), options);
        chart.render();
      
")

?>