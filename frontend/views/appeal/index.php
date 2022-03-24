<?php

/** @var yii\web\View $this */

$this->title = 'Bosh sahifa';
?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Менга келган топшириқлар рўйхати</h1>
    <div class="float-right">
        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/create'])?>" class="btn btn-success btn-icon-split mr-3">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
            <span class="text">Янги мурожаат қўшиш</span>
        </a>

        <a href="<?= Yii::$app->urlManager->createUrl(['/appeal/notregister'])?>" class="btn btn-danger btn-icon-split">
            <span class="text">Рўйхатга олинмаган</span>
        </a>
    </div>
</div>




<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats card bg-light shadow h-100 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-dark mb-2">Жами топшириқлар</h5>
                        <span class="h4 mb-0 text-dark">7 та</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape">
                            <i class="fas fa-flag fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats card bg-light shadow h-100 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-dark mb-2">Бажарилган топшириқлар</h5>
                        <span class="h4 mb-0 text-dark">1 та</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape">
                            <i class="fas fa-check fa-3x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats card bg-light shadow h-100 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-dark mb-2">Жараёндаги топшириқлар</h5>
                        <span class="h4 mb-0 text-dark">1 та</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape">
                            <i class="fas fa-info-circle fa-3x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats card bg-light shadow h-100 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-dark mb-2">Муддати тугаган</h5>
                        <span class="h4 mb-0 text-dark text-bolder">1 та</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape">
                            <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->



<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">



        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div id="dataTable_filter" class="dataTables_filter float-right">
                    <div class="card-tools">
                        <a href="/site/answerlist" class="btn btn-primary">Жавоби келган мурожаатлар</a>
                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-search"></span> Қидирув
                        </button>
                    </div>
                </div>
                <h5 class="m-0 font-weight-bold text-primary mt-2">Менга келган топшириқлар рўйхати</h5>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">

                            <div class="col-sm-12 col-md-12">
                                <div class="collapse" id="collapseExample" style="">
                                    <h4>Қидирув</h4>
                                    <hr>
                                    <form id="w0" action="http://e-murojaat.uz/site/index" method="get">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-number">
                                                    <label class="control-label" for="appealregistermysearch-number">Рақами</label>
                                                    <input type="text" id="appealregistermysearch-number" class="form-control" name="AppealRegisterMySearch[number]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-date">
                                                    <label class="control-label" for="appealregistermysearch-date">Сана</label>
                                                    <input type="date" id="appealregistermysearch-date" class="form-control" name="AppealRegisterMySearch[date]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-question_id">
                                                    <label class="control-label" for="appealregistermysearch-question_id">Саволни танланг</label>
                                                    <select id="appealregistermysearch-question_id" class="form-control js-select2 select2-hidden-accessible" name="AppealRegisterMySearch[question_id]" data-select2-id="appealregistermysearch-question_id" tabindex="-1" aria-hidden="true">
                                                        <option value="" data-select2-id="2">Саволни танланг</option>
                                                        <optgroup label="1А-Давлат хўжалик идоралари ишлари">
                                                            <option value="1">1А 1)Вилоят идоралари ишлари</option>
                                                            <option value="2">1А 2)Шаҳар ва туманлар идоралари</option>
                                                            <option value="3">1А 3)Идоралар раҳбарлари фаолияти</option>
                                                        </optgroup>
                                                        <optgroup label="1Б-Ҳокимият идораларининг ишлари">
                                                            <option value="5">1Б 1)Вилоятлар ҳокимликлари</option>
                                                            <option value="6">1Б 2)Шаҳарлар ва туманлар ҳокимликлари</option>
                                                            <option value="7">1Б 3)Ҳокимлик раҳбарлари фаолияти</option>
                                                        </optgroup>
                                                        <optgroup label="2А  -Молия, солиқ ва божхона масаласи">
                                                            <option value="8">2А 1)Молия масалалари</option>
                                                            <option value="9">2А 2)Солиқ масалалари</option>
                                                            <option value="10">2А 3) Божхона масалалари</option>
                                                            <option value="11">2А 4)Займ ва облигация тўғрисида</option>
                                                            <option value="12">2А 5)Кредит фондлари ажратиш</option>
                                                            <option value="13">2А 6)Суғурта қилиш масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="2Б  -Банк, кредит масалалари">
                                                            <option value="14">2Б 1)Банк муассасалари ишлари</option>
                                                            <option value="15">2Б 2)Тадбиркорлик кредити олиш</option>
                                                            <option value="16">2Б 3)Фермер хўжалиги учун кредит</option>
                                                            <option value="17">2Б 4)Авто кредит олиш</option>
                                                            <option value="18">2Б 5)Таълим кредити</option>
                                                            <option value="19">2Б 6)Уй-жой кредити (ипотека)</option>
                                                            <option value="20">2Б 7)Микрокредит (ҳунарманд, оилавий)</option>
                                                            <option value="21">2Б 8)Юридик шахслар конвертация масаласи</option>
                                                            <option value="22">2Б 9)ХУЖМШга кредит ажратиш масаласи</option>
                                                        </optgroup>
                                                        <optgroup label="2В-  Иш, иш ҳақи ва имтиёзлар">
                                                            <option value="23">2В 1)Иш билан таъминлаш масаласи</option>
                                                            <option value="24">2В 2)Иш ҳақи масалалари</option>
                                                            <option value="25">2В 3)Коллеж битирувчилари ишга жойлашиш</option>
                                                            <option value="26">2В 4)Имтиёзлар бериш тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="2Г  -Нафақа масалалари">
                                                            <option value="27">2Г 1)Пенсионерлар нафақаси</option>
                                                            <option value="28">2Г 2)Болалар нафақаси</option>
                                                            <option value="29">2Г 3)Ногиронлик нафақаси</option>
                                                            <option value="30">2Г 4)ВТЭК ва имтиёзлар тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="2Д - Моддий ёрдам масалалари">
                                                            <option value="31">2Д 1)Оилага моддий ёрдам</option>
                                                            <option value="32">2Д 2)Уй-жойларни тузатиш тўғрисида</option>
                                                            <option value="33">2Д 3)Турли совғалар</option>
                                                        </optgroup>
                                                        <optgroup label="2Е - Корхона фаолияти ва хусусийлаштириш">
                                                            <option value="34">2Е 1)Хусусийлаштиришга ёрдам бериш</option>
                                                            <option value="35">2Е 2)Ноқонуний хусусийлаштириш</option>
                                                            <option value="36">2Е 3)Акциядорларнинг ҳақ-ҳуқуқлари</option>
                                                            <option value="37">2Е 4)Мулкга зарар этказиш</option>
                                                            <option value="38">2Е 5)Корхона фаолияти</option>
                                                        </optgroup>
                                                        <optgroup label="2Ж - Ташқи иқтисодий алоқалар">
                                                            <option value="39">2Ж 1)Қўшма хорижий корхона фаолияти</option>
                                                            <option value="40">2Ж 2)Чет элга бориш ва ишлаш тўғрисида</option>
                                                            <option value="41">2Ж 3)Ташқи иқтисодий алоқалар (экспорт)</option>
                                                            <option value="42">2Ж 4)Туризм масалалари</option>
                                                            <option value="43">2Ж 5)Мева-сабзавот маҳсулотлар экспорт мас</option>
                                                        </optgroup>
                                                        <optgroup label="2З  -Тадбиркорликни ривожлантириш">
                                                            <option value="44">2З 1)Тадбиркорликни ривожлантириш</option>
                                                            <option value="45">2З 2)Тадбиркорлик субъектини текшириш</option>
                                                            <option value="46">2З 3)Корхонани расмийлаштириш, лицензия</option>
                                                            <option value="47">2З 4)Тадбиркорлик бўйича таклифлар</option>
                                                        </optgroup>
                                                        <optgroup label="3А  -Фермер хўжаликлари масалалари">
                                                            <option value="48">3А 1)Тендер комиссияси фаолияти</option>
                                                            <option value="49">3А 2)Фермер хўжаликлари масалалари</option>
                                                            <option value="50">3А 3)Ф/х ташкил этиш ва фаолияти</option>
                                                            <option value="51">3А 4)Фермер хўжалигини кенгайтириш</option>
                                                            <option value="52">3А 5)Фермер хўжалигини тугатилиши</option>
                                                            <option value="53">3А 6)Фермер хўжалигига тазйиқ тўғрисида</option>
                                                            <option value="190">3А 7)Ўрмончилик ва бошқа хўжаликлар</option>
                                                        </optgroup>
                                                        <optgroup label="3Б  -Агросаноат инфраструктураси">
                                                            <option value="54">3Б 1)МТП масалалари</option>
                                                            <option value="55">3Б 2)Ёқилғи таъминоти</option>
                                                            <option value="57">3Б 4)Сув ресурслари таъминоти</option>
                                                            <option value="58">3Б 5)Кунжара, шелухо ва ёғ-мой олиш</option>
                                                            <option value="59">3Б 6)Пахта, дон заводлари фаолияти</option>
                                                            <option value="60">3Б 7)Зооветеринария ва бошқа масалалар</option>
                                                            <option value="61">3Б 8)Тухум, тери ва бошқа (лицензия) мас</option>
                                                        </optgroup>
                                                        <optgroup label="4А  -Истеъмол товарлари ишлаб чиқариш">
                                                            <option value="56">4А 3)Минерал ўғитлар таъминоти</option>
                                                            <option value="62">4А 1)Енгил саноат ва бошқа масалалар</option>
                                                            <option value="63">4А 2)Озиқ-овқатлар и/ч масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="4Б  -Бозор ва савдо саҳолари">
                                                            <option value="64">4Б 1)Бозорлар фаолияти</option>
                                                            <option value="65">4Б 2)Савдони ташкил этиш</option>
                                                        </optgroup>
                                                        <optgroup label="5А  -Уй-жой ва ер олиш масалалари">
                                                            <option value="66">5А 1)Уй-жой учун ер олиш</option>
                                                            <option value="67">5А 2)Квартира олиш масалалари</option>
                                                            <option value="68">5А 3)Бузилган уй-жой масалалари</option>
                                                            <option value="69">5А 4)Уй-жой ер мажораси</option>
                                                            <option value="70">5А 5)Корхона (дўкон ва хакоза) қуришга ер ажратиш</option>
                                                            <option value="71">5А 6)Ёш оилалар учун уй-жой олиш</option>
                                                            <option value="72">5А 7)Уй-жойга эгалик ҳуқуқ ва хусусийлаштириш</option>
                                                        </optgroup>
                                                        <optgroup label="5Б  -Уйларни таъмирлаш масаллари">
                                                            <option value="73">5Б 1)Кўп қаватли уйларни таъмирлаш</option>
                                                            <option value="74">5Б 2)Якка турар жойларни таъмирлаш</option>
                                                            <option value="75">5Б 3)Томни таъмирлаш тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="5В  -Коммунал-ҳизмат соҳаси ">
                                                            <option value="76">5В 1)Иссиқлик таъминоти</option>
                                                            <option value="77">5В 2)Иссиқ сув таъминоти</option>
                                                            <option value="78">5В 3)Ичимлик суви</option>
                                                            <option value="79">5В 4)Коммунал хизмат тўловлари</option>
                                                            <option value="80">5В 5)Хисоблагичлар ўрнатиш</option>
                                                            <option value="81">5В 6)Лифт масаласи</option>
                                                            <option value="82">5В 7)Соҳага доир бир неча масалалар</option>
                                                        </optgroup>
                                                        <optgroup label="5Г  -Ободонлаштириш масалалари">
                                                            <option value="83">5Г 1)Уй атрофини ободонлаштириш</option>
                                                            <option value="84">5Г 2)Аҳоли пунктларини ободонлаштириш</option>
                                                            <option value="85">5Г 3)Гаражлар қурилиши масалалари</option>
                                                            <option value="86">5Г 4)Фавқулотда вазиятлар масалалари</option>
                                                            <option value="87">5Г 5)Ички йўллар ва йўлакларни таъмирлаш</option>
                                                            <option value="88">5Г 6)Кўча чироқлари масаласи</option>
                                                        </optgroup>
                                                        <optgroup label="5Д  -Хусусий уй-жой мулкдорлари ширкати">
                                                            <option value="89">5Д 1)ХУЖМШ фаолияти тўғрисида</option>
                                                            <option value="90">5Д 2)Тўловларни ошириш масаласи</option>
                                                            <option value="91">5Д 3)ХУЖМШ раҳбарлари тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="6А-  Қурилиш масалалари">
                                                            <option value="92">6А 1)Коллежлар қурилиши</option>
                                                            <option value="93">6А 2)Лицейлар қурилиши</option>
                                                            <option value="94">6А 3)Мактаблар қурилиши</option>
                                                            <option value="95">6А 4)Таълим муассасаларини таъмирлаш</option>
                                                            <option value="96">6А 5)Корхоналар қурилиши</option>
                                                            <option value="97">6А 6)Ноқонуний қурилишлар</option>
                                                            <option value="98">6А 7)Қишлоқдаги намунали уй-жой қурилиши</option>
                                                        </optgroup>
                                                        <optgroup label="6Б  -Электрлаштириш ва газлаштириш">
                                                            <option value="99">6Б 1)Электрлаштириш масалалари</option>
                                                            <option value="100">6Б 2) Газлаштириш масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="6В  -Транспорт масалалари">
                                                            <option value="101">6В 1)Автокорхоналар фаолияти</option>
                                                            <option value="102">6В 2)Автокорхона лицензияси тўғрисида</option>
                                                            <option value="103">6В 3)Транспорт қатнови масаласи</option>
                                                            <option value="104">6В 4)Автойўл қурилиши ва таъмирлаш</option>
                                                            <option value="105">6В 5)Темир йўл ва авияция масаласи</option>
                                                            <option value="106">6В 6)Давондан юк машинаси ўтиш тўғ</option>
                                                        </optgroup>
                                                        <optgroup label="7А  -Ёқилғи энергитика саҳолари">
                                                            <option value="107">7А 1)Электр таъминоти</option>
                                                            <option value="108">7А 2)Газ таъминоти</option>
                                                            <option value="109">7А 3)Нефт ва газ масалалари</option>
                                                            <option value="110">7А 4)АЁҚШ (лицензия) масалалари</option>
                                                            <option value="111">7А 5)Кимё саноат масалалари</option>
                                                            <option value="112">7А 6)Металлургия масалалари</option>
                                                            <option value="113">7А 7)Геология (лицензия) масалалари</option>
                                                            <option value="114">7А 8)Газ, электр масалалари (тех қисми)</option>
                                                        </optgroup>
                                                        <optgroup label="7Б  -Машинасозлик ва автомобил саноат мас">
                                                            <option value="115">7Б 1)Машинасозлик масалалари</option>
                                                            <option value="116">7Б 2)Қ/х машинасозлик масалалари</option>
                                                            <option value="117">7Б 3)Электратехника ва стандарт масалалари</option>
                                                            <option value="118">7Б 4)Автомобил сотиб олиш</option>
                                                        </optgroup>
                                                        <optgroup label="8А  -Халқ таълими масалалари ">
                                                            <option value="119">8А 1)Мактаб масалалари</option>
                                                            <option value="120">8А 2)Лицей масалалари</option>
                                                            <option value="121">8А 3)Мактабгача тарбия масалалари</option>
                                                            <option value="122">8А 4)Соҳага доир масалалар</option>
                                                            <option value="123">8А 5)Халқ таълими раҳбарлари тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="8Б - Олий ва ўрта маҳсус таълим">
                                                            <option value="124">8Б 1)Олий ўқув юртларига кириш</option>
                                                            <option value="125">8Б 2)Коллежларга кириш масалалари</option>
                                                            <option value="126">8Б 3)Ўқишни кўчириш ва тиклаш</option>
                                                            <option value="127">8Б 4)Контракт тўловлари масалалари</option>
                                                            <option value="128">8Б 5)Тест синовлари тўғрисида</option>
                                                            <option value="129">8Б 6)Дипломни нострификация масалалари</option>
                                                            <option value="130">8Б 7)Соҳага доир масалалар</option>
                                                            <option value="131">8Б 8)Муассасалар раҳбарлари тўғрисида</option>
                                                            <option value="132">8Б 9)Фан масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="8В  -Соғлиқни сақлаш соҳаси">
                                                            <option value="133">8В 1)Даволаниш масалалари</option>
                                                            <option value="134">8В 2)Даволанишга моддий ёрдам бериш</option>
                                                            <option value="135">8В 3)Соҳага доир масалалар</option>
                                                            <option value="136">8В 4)Муассасалар раҳбарлари тўғрисида</option>
                                                            <option value="137">8В 5)Экология масаласи</option>
                                                            <option value="138">8В 6)Спорт масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="8Г  -Маданият, матбуот ва санъат ишлари">
                                                            <option value="139">8Г 1)Маданият масалалари</option>
                                                            <option value="140">8Г 2)Спорт масаласи</option>
                                                            <option value="141">8Г 3) Матбуот масаласи</option>
                                                            <option value="142">8Г 4)Туризм масалалари</option>
                                                            <option value="143">8Г 5)Театр ва кино масаласи</option>
                                                            <option value="144">8Г 6)Телерадио масаласи</option>
                                                            <option value="145">8Г 7)Санъат масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="8Д  -Дин масалалари">
                                                            <option value="146">8Д 1)Диний фаолиятга доир</option>
                                                            <option value="147">8Д 2)Ҳаж ва умрага бориш масалалари</option>
                                                            <option value="148">8Д 3)Мачит масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="8Е - Маҳалла ва ҚФЙ масалалари">
                                                            <option value="149">8Е 1)МФЙ масалалари</option>
                                                            <option value="150">8Е 2)ҚФЙ масалалари</option>
                                                            <option value="151">8Е 3)МФЙ ва ҚФЙ раҳбарлари тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="8Ж  -Оила масалалари">
                                                            <option value="152">8Ж 1)Оилавий муносабатлар</option>
                                                            <option value="153">8Ж 2)Қўшнилар билан муносабатлар</option>
                                                            <option value="154">8Ж 3)Хотин – қизлар масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="9А  -Алоқа ва ахборот технологияси">
                                                            <option value="155">9А 1)Алоқа тармоқлари фаолияти</option>
                                                            <option value="156">9А 2)Телефон ўрнатиш масалалари</option>
                                                            <option value="157">9А 3)Интеллектуал мулк масалалари</option>
                                                            <option value="158">9А 4)Телерадио масала (техник жихат)</option>
                                                            <option value="159">9А 5)Матбуот масалалари</option>
                                                            <option value="160">9А 6)Архив маълумотлари тўғрисида</option>
                                                            <option value="161">9А 7)Почта масаласи</option>
                                                            <option value="162">9А 8)Интернет масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="10А - Суд масалалари ">
                                                            <option value="163">10А 1)Суд масалалари</option>
                                                            <option value="164">10А 2)Жазо муддатлари тўғрисида</option>
                                                            <option value="165">10А 3)Фермер хўжалиги суди масаласи</option>
                                                            <option value="166">10А 4)Суд ходимлари тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="10Б - Прокуратура масалалари">
                                                            <option value="167">10Б 1)Прокуратура масалалари</option>
                                                            <option value="168">10Б 2)Прокуратура ходимлари тўғрисида</option>
                                                            <option value="169">10Б 3)МИБ ходимлари тўғрисида</option>
                                                            <option value="170">10Б 5)Алимент тўловлари</option>
                                                            <option value="171">10Б 6)Газ, электр тўлови ундириш (ижро юза)</option>
                                                            <option value="175">10Б 4)Адвокатура тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="10В-  Адлия масалалари">
                                                            <option value="172">10В 1)Адлия масалалари</option>
                                                            <option value="173">10В 2)Адлия ходимлари тўғрисида</option>
                                                            <option value="174">10В 3)Нотариат ва ФХДЁ масалалари</option>
                                                        </optgroup>
                                                        <optgroup label="10Г - Ички ишлар масалалари">
                                                            <option value="176">10Г 1)Ички ишлар масалалари</option>
                                                            <option value="177">10Г 2)Фуқаролик ва паспорт олиш</option>
                                                            <option value="178">10Г 3)Ички ишлар ходимлари тўғрисида</option>
                                                            <option value="179">10Г 4)Паспорт прапискаси тўғрисида</option>
                                                        </optgroup>
                                                        <optgroup label="10Д  -Мудофаа масалалари">
                                                            <option value="180">10Д 1)Мудофаа масалалари</option>
                                                            <option value="181">10Д 2)Мудофаа ходимлари тўғрисида</option>
                                                            <option value="182">10Д 3)Чегара ҳуқуқидаги масалалар</option>
                                                        </optgroup>
                                                        <optgroup label="11А  -Турли масалалар">
                                                            <option value="183">11А 1)Битта масала</option>
                                                            <option value="184">11А 2)Иккита масала</option>
                                                            <option value="185">11А 3)Учта ва ундан ортиқ масалалар</option>
                                                            <option value="186">11А 4)Табрик ва миннатдорчилик масалалари</option>
                                                            <option value="187">11А 5)Архив маълумотлари тўғрисида</option>
                                                            <option value="188">11А 6)Сайлов масалалари</option>
                                                            <option value="189">11А 7)Фуқароларнинг турли таклифлари</option>
                                                        </optgroup>
                                                    </select>

                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-person_name">
                                                    <label class="control-label" for="appealregistermysearch-person_name">ФИО</label>
                                                    <input type="text" id="appealregistermysearch-person_name" class="form-control" name="AppealRegisterMySearch[person_name]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-date_of_birth">
                                                    <label class="control-label" for="appealregistermysearch-date_of_birth">Туғилган санаси</label>
                                                    <input type="date" id="appealregistermysearch-date_of_birth" class="form-control" name="AppealRegisterMySearch[date_of_birth]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-gender">
                                                    <label class="control-label" for="appealregistermysearch-gender">Жинси</label>
                                                    <select id="appealregistermysearch-gender" class="form-control" name="AppealRegisterMySearch[gender]">
                                                        <option value="">Жинсини танланг</option>
                                                        <option value="0">Аёл</option>
                                                        <option value="1">Эркак</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-person_phone">
                                                    <label class="control-label" for="appealregistermysearch-person_phone">Телефон рақами</label>
                                                    <input type="text" id="appealregistermysearch-person_phone" class="form-control" name="AppealRegisterMySearch[person_phone]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-region_id">
                                                    <label class="control-label" for="appealregistermysearch-region_id">Вилоят номи</label>
                                                    <select id="appealregistermysearch-region_id" class="form-control" name="AppealRegisterMySearch[region_id]" onchange="
                                                				$.get( &quot;/get/district&quot;, { id: $(this).val() } )
                                                                            .done(function( data ) {
                                                                                $( &quot;#appealregistermysearch-district_id&quot; ).html( data );
                                                                            });
                                                			">
                                                        <option value="">Вилоятни танланг</option>
                                                        <option value="1">Андижон вилояти</option>
                                                        <option value="2">Бухоро вилояти</option>
                                                        <option value="3">Жиззах вилояти</option>
                                                        <option value="4">Навоий вилояти</option>
                                                        <option value="5">Наманган вилояти</option>
                                                        <option value="6">Самарқанд вилояти</option>
                                                        <option value="7">Сирдарё вилояти</option>
                                                        <option value="8">Сурхондарё вилояти</option>
                                                        <option value="9">Тошкент шахар</option>
                                                        <option value="10">Тошкент вилояти</option>
                                                        <option value="11">Фарғона вилояти</option>
                                                        <option value="12">Хоразм вилояти</option>
                                                        <option value="13">Қашқадарё вилояти</option>
                                                        <option value="14">Қорақалпоғистон Республикаси</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-district_id">
                                                    <label class="control-label" for="appealregistermysearch-district_id">Туман номи</label>
                                                    <select id="appealregistermysearch-district_id" class="form-control" name="AppealRegisterMySearch[district_id]" onchange="
                                                				            $.get( &quot;/get/village&quot;, { id: $(this).val() } )
                                                                            .done(function( data ) {
                                                                                $( &quot;#appealregistermysearch-village_id&quot; ).html( data );
                                                                            });
                                                			">
                                                        <option value="">Туманни танланг</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-village_id">
                                                    <label class="control-label" for="appealregistermysearch-village_id">Маҳалла номи</label>
                                                    <select id="appealregistermysearch-village_id" class="form-control js-select2 select2-hidden-accessible" name="AppealRegisterMySearch[village_id]" data-select2-id="appealregistermysearch-village_id" tabindex="-1" aria-hidden="true">
                                                        <option value="" data-select2-id="4">Маҳаллани танланг</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-address">
                                                    <label class="control-label" for="appealregistermysearch-address">Манзил</label>
                                                    <input type="text" id="appealregistermysearch-address" class="form-control" name="AppealRegisterMySearch[address]">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group field-appealregistermysearch-control_id">
                                                    <label class="control-label" for="appealregistermysearch-control_id">Назоратлилиги</label>
                                                    <select id="appealregistermysearch-control_id" class="form-control" name="AppealRegisterMySearch[control_id]">
                                                        <option value="">Назорат турини танланг</option>
                                                        <option value="0">Янги</option>
                                                        <option value="1">Кўриб чиқилмоқда</option>
                                                        <option value="2">Ижобий хал этилди</option>
                                                        <option value="3">Чоралар кўрилди</option>
                                                        <option value="4">Тушунтирилди</option>
                                                        <option value="5">Рад этилди</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Қидириш</button> <a href="http://e-murojaat.uz/site/index" class="btn btn-outline-secondary">Тозалаш</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0;">
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>№ ва санаси</th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=appeal_id" data-sort="appeal_id">Мурожаат</a>
                                        </th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=rahbar_id" data-sort="rahbar_id">Раҳбар</a>
                                        </th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=ijrochi_id" data-sort="ijrochi_id">Масъул</a>
                                        </th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=control_id" data-sort="control_id">Назоратлилиги</a>
                                        </th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=deadtime" data-sort="deadtime">Муддат</a>
                                        </th>
                                        <th><a href="http://e-murojaat.uz/site/index?sort=preview" data-sort="preview">Раҳбар резолюцияси</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr data-key="1664">
                                        <td>1</td>
                                        <td><b>№ ФЭ-С-123</b>
                                            <br>2022-02-15</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1664">Собиров Рўзимбой Аминович<br>11А  -2.Иккита масала</a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-warning"></i> <br />5 кун қолди
                                        </td>
                                        <td>Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда хал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.</td>
                                    </tr>
                                    <tr data-key="1415">
                                        <td>2</td>
                                        <td><b>№ ФЭ-С-106</b>
                                            <br>2022-02-05</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1415">Салаев Ойбек Сапарбаевич<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-danger"></i> <br /> Муддати тугуган
                                        </td>
                                        <td>Мурожаатни кўриб чиқиб масалани ҳал қилиш чораларни кўринг</td>
                                    </tr>
                                    <tr data-key="1251">
                                        <td>3</td>
                                        <td><b>№ А-76</b>
                                            <br>2022-01-21</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1251">Азмуханов Базарбой<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-danger"></i> <br /> Муддати тугуган
                                        </td>
                                        <td>Муржаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.</td>
                                    </tr>
                                    <tr data-key="1385">
                                        <td>4</td>
                                        <td><b>№ ФЭ-Ж-103</b>
                                            <br>2022-02-04</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1385">Жуманиязов Рўзимбой<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Салаев Санъатбек Камилович</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-danger"></i> <br /> Муддати тугуган
                                        </td>
                                        <td>Мурожаатни кўриб чиқиб масалани ҳал қилиш чораларни кўринг</td>
                                    </tr>
                                    <tr data-key="1238">
                                        <td>5</td>
                                        <td><b>№ Ж-50</b>
                                            <br>2022-01-20</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1238">Жуманиёзов Рўзимбой<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-danger"></i> <br /> Муддати тугуган
                                        </td>
                                        <td>Муржаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.</td>
                                    </tr>
                                    <tr data-key="1239">
                                        <td>6</td>
                                        <td><b>№ Б-51</b>
                                            <br>2022-01-20</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=1239">Болтаев Давронбек Аматович<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Кўриб чиқилмоқда</td>
                                        <td class="text-center"><i class="fas fa-clock text-danger"></i> <br /> Муддати тугуган
                                        </td>
                                        <td>Муржаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.</td>
                                    </tr>
                                    <tr data-key="350">
                                        <td>7</td>
                                        <td><b>№ М-846</b>
                                            <br>2021-10-25</td>
                                        <td><a href="http://e-murojaat.uz/site/view?id=350">Матякубов Фарход<br>11А  -1.Битта масала </a>
                                        </td>
                                        <td>Эрманов Фарход Уразбоевич</td>
                                        <td>Сабуpов Раимбеpган Садуллаевич</td>
                                        <td>Тушунтирилди</td>
                                        <td class="text-center"><i class="fas fa-check text-success"></i> Бажарилган
                                        </td>
                                        <td>Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Content Row -->


<div class="row">
    <div class="col-lg-4 mb-4">
        <!-- Illustration card example-->
        <div class="card mb-4">
            <div class="card-body text-center p-5 border-left-primary">
                <img class="img-fluid mb-5" src="/res/img/data-report.svg" />
                <p class="">Tizimdagi murojaatlar hisobotini Excel (.xlsx) shaklida belgilangan sana bo'yicha yuklab oling.</p>

                <div class="dropdown no-arrow">
                    <a class="btn btn-primary dropdown-toggle dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hisobotni yuklab olish
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                        <div class="dropdown-header">Muddatni tanlang:</div>
                        <a class="dropdown-item" href="#">Fevral oyi hisoboti</a>
                        <a class="dropdown-item" href="#">Kvartal hisoboti</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Hammasini yuklab olish</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Report summary card example-->

        <!-- Progress card example-->
    </div>
    <div class="col-lg-8 mb-4">
        <!-- Area chart example-->
        <div class="card mb-4">
            <div class="card-header">Murojaatlar diagrammasi</div>
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                        <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                    </div>
                    <canvas id="myAreaChart" width="874" height="240" style="display: block; width: 874px; height: 240px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
