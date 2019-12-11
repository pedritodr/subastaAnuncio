<section class="breadcrumb-1 small-hero">
    <div class="bg-overlay">
        <div class="container">
            <!-- Main Content -->
            <div class="content-section">
                <!-- Title -->

            </div>
            <!-- Main Content End -->
        </div>
    </div>
</section>
<!-- =-=-=-=-=-=-= Advance Search =-=-=-=-=-=-= -->
<div id="search-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12">
                <!-- Form -->
                <form method="post" class="search-form">
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <select class="category form-control">
                            <option label="Select Option"></option>
                            <option value="0">Cars & Bikes</option>
                            <option value="1">Mobile Phones</option>
                            <option value="2">Home Appliances</option>
                            <option value="3">Clothing</option>
                            <option value="4">Human Resource</option>
                            <option value="5">Information Technology</option>
                            <option value="6">Marketing</option>
                            <option value="7">Others</option>
                            <option value="8">Sales</option>
                        </select>
                    </div>
                    <!-- Search Field -->
                    <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                        <input type="text" class="form-control" placeholder="What Are You Looking For..." />
                    </div>
                    <!-- Search Button -->
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <button type="submit" class="btn btn-block btn-light">Search</button>
                    </div>
                </form>
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
                                <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                <div class="filter-brudcrums-sort">
                                    <ul>
                                        <li><span>Sort by:</span></li>
                                        <li><a href="#">Updated date</a></li>
                                        <li><a href="#">Price</a></li>
                                        <li><a href="#">New</a></li>
                                        <li><a href="#">Used</a></li>
                                        <li><a href="#">Warranty</a></li>
                                    </ul>
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
                                    <!-- Listing Grid -->
                                    <?php foreach ($all_subastas as $item) { ?>

                                        <li>
                                            <div class="well ad-listing clearfix">
                                                <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                    <!-- Image Box -->
                                                    <div class="img-box">
                                                        <img src="<?= base_url($item->subasta_photo) ?>" class="img-responsive" alt="">
                                                        <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                        <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div>
                                                    </div>
                                                    <!-- Ad Status -->
                                                    <!--<span class="ad-status"> Featured </span>-->
                                                    <!-- User Preview -->
                                                    <div class="user-preview">
                                                        <a href="#"> <img src="" class="avatar avatar-small" alt=""> </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-7 col-xs-12">
                                                    <!-- Ad Content-->
                                                    <div class="row">
                                                        <div class="content-area">
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                                <!-- Category Title -->

                                                                <div class="category-title"> <span><a href="#"><?= $item->categoria ?></a></span>

                                                                </div>


                                                                <!-- Ad Title -->
                                                                <h6><a><?= $item->nombre_espa ?></a> </h6>
                                                                <!-- Info Icons -->

                                                                <!-- Ad Meta Info -->
                                                                <ul class="ad-meta-info">
                                                                    <li> <i class="fa fa-map-marker"></i><a href="#"><?= $item->ciudad ?></a> </li>
                                                                    <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                </ul>
                                                                <div class="row">
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

                                                                    <?= $item->descrip_espa ?>


                                                                </div>
                                                                <?php if ($this->session->userdata('user_id')) { ?>
                                                                    <div class="row">

                                                                        <?php if (!$item->subasta_user) { ?>
                                                                            <div class="col-md-6">
                                                                                <button onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                            </div>
                                                                        <?php } ?>
                                                                        <?php if ($item->subasta_user) { ?>
                                                                            <div class="col-md-6">
                                                                                <button onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                            </div>
                                                                        <?php } ?>
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
                                                                <h6 class="text-center"><?= "Valor de entreda" ?></h6>
                                                                <div class="price text-center"> <span>$ <?= number_format($item->valor_inicial, 2) ?></span> </div>
                                                                <h6 class="text-center"><?= "Valor inicial" ?> </h6>
                                                                <div class="price text-center"><span>$ <?= number_format($item->valor_pago, 2) ?></span> </div>
                                                                <!-- Ad View Button -->

                                                                <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Ad Content End -->
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <!-- Listing Grid -->


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
        var subastas = <?= json_encode($all_subastas); ?>;

                for (let i = 0; i < subastas.length + 1; i++) {

                    var x = setInterval(function() {
                        var fecha = subastas[i].fecha_cierre;
                        var deadline = new Date(fecha).getTime();
                        var currentTime = new Date().getTime();
                        var t = deadline - currentTime;
                        var days = Math.floor(t / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((t % (1000 * 60)) / 1000);
                        $('#day_' + subastas[i].subasta_id).html(days);
                        $('#hour_' + subastas[i].subasta_id).html(hours);
                        $('#minute_' + subastas[i].subasta_id).html(minutes);
                        $('#second_' + subastas[i].subasta_id).html(seconds);

                        if (t < 0) {

                            clearInterval(x);

                            $('#day_' + subastas[i].subasta_id).html(0);
                            $('#hour_' + subastas[i].subasta_id).html(0);
                            $('#minute_' + subastas[i].subasta_id).html(0);
                            $('#second_' + subastas[i].subasta_id).html(0);

                        }

                    }, 1000);


                }
    </script>