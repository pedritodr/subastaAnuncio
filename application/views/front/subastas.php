<div id="carousel-example-generic" class="carousel slide banner2" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <?php if (count($all_banners) > 1) { ?>

            <?php for ($i = 1; $i < count($all_banners); $i++) { ?>

                <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"></li>
            <?php } ?>
        <?php } ?>


    </ol>
    <div class="carousel-inner">
        <?php if (count($all_banners) > 0) { ?>
            <div class="item active">
                <img style="width:100% !important" class="img-responsive" src="<?= base_url($all_banners[0]->foto) ?>" alt="First slide">
                <!--   <div class="carousel-caption">
               <h3>
                  First slide</h3>
               <p>
                  Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> -->
            </div>
        <?php } ?>
        <?php if (count($all_banners) > 1) { ?>
            <?php for ($j = 1; $j < count($all_banners); $j++) { ?>
                <div class="item">
                    <img style="width:100% !important" src="<?= base_url($all_banners[$j]->foto) ?>" alt="Second slide">
                    <!--  <div class="carousel-caption">
               <h3>
                  Second slide</h3>
               <p>
                  Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> -->
                </div>
            <?php } ?>
        <?php } ?>


    </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
        </span></a>
</div>
<!-- =-=-=-=-=-=-= Advance Search =-=-=-=-=-=-= -->
<div id="search-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12">

                <?= form_open_multipart("search_subasta_directa", array('class' => 'search-form', 'method' => 'post')); ?>


                <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                    <select name="category" class="category form-control">
                        <option label="<?= translate("select_category_lang"); ?>"></option>
                        <?php if ($categories) { ?>
                            <?php foreach ($categories as $item) { ?>
                                <?php if ($this->session->userdata('session_categoria')) { ?>
                                    <option <?php if ($this->session->userdata('session_categoria') == $item->categoria_id) { ?> selected <?php } ?> value="<?= $item->categoria_id ?>"><?= $item->name_espa ?></option>
                                <?php  } else { ?>
                                    <option value="<?= $item->categoria_id ?>"><?= $item->name_espa ?></option>
                                <?php } ?>

                            <?php } ?>

                        <?php } ?>

                    </select>
                </div>
                <!-- Search Field -->
                <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                    <?php if ($this->session->userdata('session_palabra')) { ?>
                        <input name="subasta_palabra" type="text" class="form-control" value="<?= $this->session->userdata('session_palabra') ?>" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
                    <?php } else { ?>
                        <input name="subasta_palabra" type="text" class="form-control" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
                    <?php  } ?>
                </div>
                <!-- Search Button -->
                <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                    <button type="submit" class="btn btn-block btn-light"><?= translate("buscar_lang"); ?></button>
                </div>

                <?= form_close(); ?>
                <!-- end .search-form -->
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-= Advance Search End  =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding pattern_dots">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-12 col-lg-12 col-sx-12">
                    <!-- Row -->

                    <div class="row">
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <!-- Sorting Filters Breadcrumb -->
                            <div class="filter-brudcrums">
                                <?php if ($all_subastas) { ?>
                                    <?php if (count($all_subastas) > 0) { ?>
                                        <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                    <?php } ?>
                                <?php } ?>
                                <div style="margin-top:1%" class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div style="margin-top:2%" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                                            <?php if ($this->session->userdata('session_palabra') || $this->session->userdata('session_categoria')) { ?>
                                                <a href="<?= site_url('search_subasta_directa') ?>" id="btn_subasta_directa_2" class="btn btn-block active btn-theme">
                                                    <span><i style="color:#fff" class="fa fa-arrow-up"></i></span>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            <?= translate('subastas_directas_lang') ?>
                                                        </font>
                                                    </font>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?= site_url('subastas_directas') ?>" id="btn_subasta_directa_2" class="btn btn-block active btn-theme">
                                                    <span><i style="color:#fff" class="fa fa-arrow-up"></i></span>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            <?= translate('subastas_directas_lang') ?>
                                                        </font>
                                                    </font>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div style="margin-top:2%" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                                            <?php if ($this->session->userdata('session_palabra') || $this->session->userdata('session_categoria')) { ?>
                                                <a href="<?= site_url('search_subasta_inversa') ?>" id="btn_subasta_inversa_2" class="btn btn-block btn-theme">
                                                    <span><i style="color:#fff" class="fa fa-exchange"></i></span>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            <?= translate('subastas_inversas_lang') ?>
                                                        </font>
                                                    </font>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?= site_url('subastas_inversas') ?>" id="btn_subasta_inversa_2" class="btn btn-block btn-theme">
                                                    <span><i style="color:#fff" class="fa fa-exchange"></i></span>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            <?= translate('subastas_inversas_lang') ?>
                                                        </font>
                                                    </font>
                                                </a>
                                            <?php } ?>
                                        </div>


                                    </div>


                                </div>
                            </div>

                            <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
                        <!-- Ads Archive -->

                        <div class="posts-masonry">
                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                <ul class="list-unstyled">

                                    <?php $contador_directa = 0;
                                    $contador_inversa = 0;
                                    if ($all_subastas) { ?>
                                        <!-- Listing Grid -->
                                        <?php foreach ($all_subastas as $item) { ?>
                                            <?php if ($item->tipo_subasta == 1) { ?>
                                                <?php $contador_directa++; ?>
                                                <li>
                                                    <div class="well ad-listing clearfix">
                                                        <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                            <!-- Image Box -->
                                                            <div style="cursor:pointer" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');" class="img-box">
                                                                <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                                <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                                <!--    <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div> -->
                                                            </div>
                                                            <!-- Ad Status -->
                                                            <!--<span class="ad-status"> Featured </span>-->
                                                            <!-- User Preview -->

                                                        </div>
                                                        <div class="col-md-9 col-sm-7 col-xs-12">
                                                            <!-- Ad Content-->
                                                            <div class="row">
                                                                <div class="content-area">
                                                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                                                        <!-- Category Title -->

                                                                        <div class="category-title"> <span><a><?= $item->categoria ?></a></span>
                                                                            <span style="display:none" id="span_subasta_<?= $item->subasta_id ?>" class="label label-danger">Finalizada</span>
                                                                        </div>


                                                                        <!-- Ad Title -->
                                                                        <h6><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');"><?= $item->corto ?></a> </h6>
                                                                        <!-- Info Icons -->

                                                                        <!-- Ad Meta Info -->
                                                                        <ul class="ad-meta-info">
                                                                            <li> <i class="fa fa-map-marker"></i><a><?= $item->ciudad ?></a> </li>
                                                                            <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                        </ul>
                                                                        <div class="row" id="cronometro_subasta_<?= $item->subasta_id ?>">
                                                                            <div class="col-md-12">
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="days" id="day_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="hours" id="hour_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="minutes" id="minute_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="seconds" id="second_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Ad Description-->
                                                                        <div class="ad-details">

                                                                            <?= $item->corta ?>


                                                                        </div>
                                                                        <?php if ($this->session->userdata('user_id')) { ?>
                                                                            <div class="row" id="btn_subastas_<?= $item->subasta_id ?>">

                                                                                <?php if (!$item->subasta_user) { ?>
                                                                                    <div class="col-md-6">
                                                                                        <button id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                    </div>
                                                                                <?php } ?>
                                                                                <?php if ($item->subasta_user) { ?>
                                                                                    <?php if ($item->puja_user) { ?>
                                                                                        <?php if ((float) $item->puja_user->valor < (float) $item->puja->valor) { ?>
                                                                                            <div class="col-md-6">
                                                                                                <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div class="col-md-6">
                                                                                                <button style="display:none" id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } else { ?>
                                                                                        <div class="col-md-6">
                                                                                            <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                        </div>
                                                                                    <?php } ?>
                                                                                <?php } ?>

                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-12 col-sm-12">
                                                                        <!-- Ad Stats -->

                                                                        <!-- Price -->
                                                                        <?php if ($item->subasta_user &&  $item->puja->valor > 0) { ?>
                                                                            <h6 class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                            <h5 class="text-center" style="font-size:14px !important"><span id="valor_inicial_subasta_<?= $item->subasta_id ?>" class="label label-success"><i class='fa fa-user-o'></i> <?= $item->user_win->name ?> $<?= number_format($item->puja->valor, 2) ?></span></h5>
                                                                        <?php } ?>
                                                                        <h6 class="text-center"><?= "Valor de entreda" ?></h6>
                                                                        <div class="price text-center"> <span>$ <?= number_format($item->valor_pago, 2) ?></span> </div>
                                                                        <h6 class="text-center"><?= "Valor inicial" ?> </h6>
                                                                        <div class="price text-center"><span>$ <?= number_format($item->valor_inicial, 2) ?></span> </div>
                                                                        <!-- Ad View Button -->

                                                                        <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Ad Content End -->
                                                        </div>
                                                    </div>
                                                </li>

                                            <?php } else if ($item->tipo_subasta == 2) { ?>
                                                <?php $count_intervalo = count($item->intervalo); ?>
                                                <?php $contador_inversa++; ?>
                                                <?php if ($item->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                                    <li>
                                                        <div class="well ad-listing clearfix">
                                                            <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                                <!-- Image Box -->
                                                                <div style="cursor:pointer" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');" class="img-box">
                                                                    <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                                    <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                                    <!--    <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div> -->
                                                                </div>
                                                                <!-- Ad Status -->
                                                                <!--<span class="ad-status"> Featured </span>-->
                                                                <!-- User Preview -->

                                                            </div>
                                                            <div class="col-md-9 col-sm-7 col-xs-12">
                                                                <!-- Ad Content-->
                                                                <div class="row">
                                                                    <div class="content-area">
                                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                                            <!-- Category Title -->

                                                                            <div class="category-title"> <span><a><?= $item->categoria ?></a></span>

                                                                            </div>


                                                                            <!-- Ad Title -->
                                                                            <h6><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');"><?= $item->corto ?></a> </h6>
                                                                            <!-- Info Icons -->

                                                                            <!-- Ad Meta Info -->
                                                                            <ul class="ad-meta-info">
                                                                                <li> <i class="fa fa-map-marker"></i><a href="#"><?= $item->ciudad ?></a> </li>

                                                                                <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?></li>
                                                                            </ul>
                                                                            <!--      <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                        <div class="timer conte">
                                                                                            <span class="days" id="day_<?= $item->subasta_id ?>"></span>
                                                                                        </div>
                                                                                        <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                                                    </div>
                                                                                    <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                        <div class="timer conte">
                                                                                            <span class="hours" id="hour_<?= $item->subasta_id ?>"></span>
                                                                                        </div>
                                                                                        <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                                                    </div>
                                                                                    <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                        <div class="timer conte">
                                                                                            <span class="minutes" id="minute_<?= $item->subasta_id ?>"></span>
                                                                                        </div>
                                                                                        <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                                                    </div>
                                                                                    <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                        <div class="timer conte">
                                                                                            <span class="seconds" id="second_<?= $item->subasta_id ?>"></span>
                                                                                        </div>
                                                                                        <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->

                                                                            <!-- Ad Description-->
                                                                            <div class="ad-details">

                                                                                <?= $item->corta ?>


                                                                            </div>
                                                                            <?php if ($this->session->userdata('user_id')) { ?>
                                                                                <div class="row">

                                                                                    <!--  <?php if (!$item->subasta_user) { ?>
                                                                                        <div class="col-md-6">
                                                                                            <button onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                        </div>
                                                                                    <?php } ?> -->
                                                                                    <!--   -->
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="col-md-3 col-xs-12 col-sm-12">
                                                                            <!-- Ad Stats -->

                                                                            <!-- Price -->
                                                                            <?php if ($item->subasta_user &&  $item->puja->valor > 0) { ?>
                                                                                <h6 class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                                <h5 class="text-center"><span id="valor_inicial_subasta" class="label label-success">$<?= number_format($item->puja->valor, 2) ?></span></h5>
                                                                            <?php } ?>
                                                                            <h6 class="text-center"><?= "Precio" ?></h6>
                                                                            <?php if ($count_intervalo >= 2) { ?>
                                                                                <div class="price text-center"> <span style="font-size:18px !important; color:#2a3681 !important;" class="strikethrough">$ <?= number_format($item->intervalo[$count_intervalo - 2]->valor, 2) ?></span> </div>
                                                                                <div class="price text-center"> <span>$ <?= number_format($item->intervalo[$count_intervalo - 1]->valor, 2) ?></span> </div>
                                                                            <?php } else { ?>
                                                                                <div class="price text-center"> <span>$ <?= number_format($item->intervalo[$count_intervalo - 1]->valor, 2) ?></span> </div>
                                                                            <?php } ?>
                                                                            <div class="category-title text-center">Stock: <span> <?= $item->intervalo[$count_intervalo - 1]->cantidad ?> </span> </div>

                                                                            <!-- Ad View Button -->
                                                                            <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Ad Content End -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>

                                        <?php } ?>
                                        <!-- Listing Grid -->
                                    <?php } else { ?>
                                        <p class="text-center"><?= translate("n_resultados"); ?></p>
                                    <?php } ?>



                                </ul>
                            </div>


                        </div>
                        <!-- Ads Archive End -->
                        <div class="clearfix"></div>
                        <!-- Pagination -->
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <ul class="pagination pagination-lg">
                                <?php echo $this->pagination->create_links(); ?>
                            </ul>
                        </div>
                        <!-- Pagination End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Middle Content Area  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

    <script>
        contador_inversa = <?= $contador_inversa ?>;
        contador_directa = <?= $contador_directa ?>;
        let subastas_2 = <?= json_encode($all_subastas); ?>;

        for (let i = 0; i < subastas_2.length; i++) {

            if (subastas_2[i].tipo_subasta == 1) {

                var x = setInterval(function() {
                    var fecha = subastas_2[i].fecha_cierre;
                    var deadline = new Date(fecha).getTime();
                    var currentTime = new Date().getTime();
                    var t = deadline - currentTime;
                    var days = Math.floor(t / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((t % (1000 * 60)) / 1000);
                    $('#day_' + subastas_2[i].subasta_id).html(days);
                    $('#hour_' + subastas_2[i].subasta_id).html(hours);
                    $('#minute_' + subastas_2[i].subasta_id).html(minutes);
                    $('#second_' + subastas_2[i].subasta_id).html(seconds);

                    if (t < 0) {

                        clearInterval(x);

                        $('#day_' + subastas_2[i].subasta_id).html(0);
                        $('#hour_' + subastas_2[i].subasta_id).html(0);
                        $('#minute_' + subastas_2[i].subasta_id).html(0);
                        $('#second_' + subastas_2[i].subasta_id).html(0);

                    }

                }, 1000);
            }


        }
    </script>
    <style>
        .active_subasta {
            display: none;
        }

        /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 58px;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            z-index: 1;
        }

        /* Declare heights because of positioning of img element */
        .carousel .item {
            height: 500px;
            background-color: #555;
        }

        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 500px;
        }

        .banner2 {
            padding-top: 107px !important
        }

        @media screen and (max-width: 992px) {
            /*      .banner2 {
            margin-top: 0
         } */

            .carousel .item {
                height: 300px;
                background-color: #555;
            }

            .carousel img {
                position: absolute;
                top: 0;
                left: 0;
                min-height: 300px;
            }
        }

        @media screen and (max-width: 400px) {
            /*   .banner2 {
   margin-top: 29% !important
} */

            .carousel .item {
                height: 300px;
                background-color: #555;
            }

            .carousel img {
                position: absolute;
                top: 0;
                left: 0;
                min-height: 300px;
            }
        }
    </style>