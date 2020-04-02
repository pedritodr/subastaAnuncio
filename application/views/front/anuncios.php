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
<div id="search-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12">
                <!-- Form -->
                <?= form_open_multipart("search_anuncios", array('class' => 'search-form')); ?>

                <!-- Search Field -->
                <div class="col-md-9 col-xs-12 col-sm-4 no-padding">
                    <input name="anuncio_palabra" type="text" class="form-control" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
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
<!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding gray">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-8 col-md-push-4 col-lg-8 col-sx-12 white-bg">
                    <!-- Row -->
                    <div class="row">
                        <?php if ($all_anuncios) { ?>
                            <?php if (count($all_anuncios) > 0) { ?>
                                <!-- Sorting Filters -->
                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                    <!-- Sorting Filters Breadcrumb -->
                                    <div class="filter-brudcrums">
                                        <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>

                                    </div>
                                    <!-- Sorting Filters Breadcrumb End -->
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
                        <!-- Ads Archive --><?php if ($all_anuncios) { ?>
                            <?php foreach ($all_anuncios as $item) { ?>
                                <div class="ads-list-archive">
                                    <!-- Image Block -->
                                    <div class="col-lg-3 col-md-3 col-sm-3 no-padding">
                                        <!-- Img Block -->
                                        <div class="ad-archive-img">

                                            <a style="cursor:pointer" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                <!--   <div class="ribbon popular"></div> -->


                                                <?php if (strpos($item->anuncio_photo, 'uploads') !== false) { ?>

                                                    <img class="img-responsive" src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                <?php } else { ?>
                                                    <img class="img-responsive" src="<?= $item->anuncio_photo ?>" alt="">

                                                <?php } ?>

                                            </a>
                                            <?php if ($item->destacado == 1) { ?>
                                                <div class="ribbon popular"><?= translate("featured_lang") ?></div>
                                            <?php } ?>
                                        </div>

                                        <!-- Img Block -->
                                    </div>
                                    <!-- Ads Listing -->
                                    <div class="clearfix visible-xs-block"></div>
                                    <!-- Content Block -->
                                    <div class="col-lg-9 col-md-9 col-sm-9 no-padding">
                                        <!-- Ad Desc -->
                                        <div class="ad-archive-desc">
                                            <!-- Price -->
                                            <div class="ad-price">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">$ <?= number_format($item->precio, 2) ?></font>
                                                </font>
                                            </div>
                                            <!-- Title -->
                                            <a style="cursor:pointer" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                <h6>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;"><?= $item->corto ?></font>
                                                    </font>
                                                </h6>
                                            </a>
                                            <!-- Category -->
                                            <div class="category-title"> <span><a href="#">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;"><?= $item->categoria ?>/<?= $item->subcategoria ?></font>
                                                        </font>
                                                    </a></span> </div>
                                            <!-- Short Description -->
                                            <div class="clearfix visible-xs-block"></div>
                                            <p class="hidden-sm">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;"><?= $item->corta ?></font>
                                                </font>
                                            </p>
                                            <!-- Ad Features -->
                                            <ul class="add_info">
                                                <!-- Contact Details -->
                                                <li>
                                                    <div class="custom-tooltip tooltip-effect-4">
                                                        <span class="tooltip-item"><i class="fa fa-phone"></i></span>
                                                        <div class="tooltip-content">
                                                            <span class="label label-success">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">+ <?= $item->whatsapp ?></font>
                                                                </font>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- Address -->
                                                <li>
                                                    <div class="custom-tooltip tooltip-effect-4">
                                                        <span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
                                                        <div class="tooltip-content">

                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">
                                                                    <?= $item->direccion ?>
                                                                </font>
                                                            </font>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                            <!-- Ad History -->
                                            <div>

                                                <div class="ad-meta"> <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>" class="btn btn-success"><i class="fa fa-eye"></i>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;"> <?= translate("ver_info_lang"); ?></font>
                                                        </font>
                                                    </a> </div>
                                            </div>
                                        </div>
                                        <!-- Ad Desc End -->
                                    </div>
                                    <!-- Content Block End -->
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="text-center"><?= translate("n_resultados"); ?></p>
                        <?php } ?>
                        <!-- Ads Archive End -->
                        <div class="clearfix"></div>
                        <!-- Pagination -->
                        <div class="text-center margin-bottom-30">
                            <ul class="pagination ">
                                <?php echo $this->pagination->create_links(); ?>
                            </ul>
                        </div>
                        <!-- Pagination End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Middle Content Area  End -->
                <!-- Left Sidebar -->
                <div class="col-md-4 col-md-pull-8 col-sx-12">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Categories Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <!-- Title -->
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            <?= translate("categories_lang"); ?>
                                        </a>
                                    </h4>
                                    <!-- Title End -->
                                </div>
                                <!-- Content -->
                                <div id="collapseOne" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body categories">
                                        <?= form_open_multipart("search_anuncios", array('class' => 'search-form', 'id' => 'buscar_categoria')); ?>
                                        <ul>
                                            <?php if ($categories) { ?>
                                                <?php foreach ($categories as $item) { ?>
                                                    <li><a style="cursor:pointer" onclick="cargar_input('<?= $item->cate_anuncio_id ?>')"><i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i><?= $item->nombre ?><span>(<?= $item->count ?>)</span></a></li>

                                                <?php } ?>
                                                <input name="category" id="category" class="" type="hidden" value="">
                                            <?php } ?>
                                        </ul>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Featured Ads -->
                            <?php if ($destacados) { ?>
                                <?php if (count($destacados) > 0) { ?>
                                    <div class="widget" style="margin-top:8% !important">
                                        <div class="widget-heading">
                                            <h4 class="panel-title"><a><?= translate("anuncios_destacados_lang") ?></a></h4>
                                        </div>
                                        <div class="widget-content">
                                            <div class="featured-slider-3">
                                                <!-- Featured Ads -->
                                                <?php foreach ($destacados as $item) { ?>
                                                    <div class="item">
                                                        <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                                                            <!-- Ad Box -->
                                                            <div class="category-grid-box">
                                                                <!-- Ad Img -->
                                                                <div class="category-grid-img">
                                                                    <img class="img-responsive" alt="" src="<?= base_url($item->anuncio_photo) ?>">
                                                                    <!-- Ad Status -->
                                                                    <!-- User Review -->
                                                                    <div class="user-preview">
                                                                        <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"> <img src="" class="avatar avatar-small" alt=""> </a>
                                                                    </div>
                                                                    <!-- View Details --><a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>" class="view-details"><?= translate("ver_info_lang") ?></a>
                                                                </div>
                                                                <!-- Ad Img End -->
                                                                <div class="short-description">
                                                                    <!-- Ad Category -->
                                                                    <div class="category-title"> <span><a href="#"><?= $item->categoria ?>/<?= $item->subcategoria ?></a></span> </div>
                                                                    <!-- Ad Title -->
                                                                    <h6>
                                                                        <?php if ($item->titulo_corto) { ?>
                                                                            <a href="#"><?= $item->titulo_corto ?></a>
                                                                        <?php } else { ?>
                                                                            <a href="#"><?= $item->titulo ?></a>
                                                                        <?php } ?>
                                                                    </h6>
                                                                    <!-- Price -->
                                                                    <div class="price">$<?= number_format($item->precio, 2) ?></div>
                                                                </div>
                                                                <!-- Addition Info -->
                                                                <div class="ad-info">
                                                                    <ul>
                                                                        <li><i class="fa fa-map-marker"></i><?= $item->ciudad ?></li>
                                                                        <li><i class="fa fa-clock-o"></i><?= translate("publicado_lang"); ?>: <?= $item->fecha ?> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- Ad Box End -->
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div> <?php } ?>
                            <?php } ?>
                            <!-- Recent Ads -->
                            <?php if ($recientes) { ?>
                                <?php if (count($recientes) > 0) { ?>
                                    <div class="widget">
                                        <div class="widget-heading">
                                            <h4 class="panel-title"><a><?= translate("anuncios_recientes_lang") ?></a></h4>
                                        </div>
                                        <div class="widget-content recent-ads">
                                            <?php foreach ($recientes as $item) { ?>
                                                <!-- Ads -->
                                                <div class="recent-ads-list">
                                                    <div class="recent-ads-container">
                                                        <div class="recent-ads-list-image">
                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>" class="recent-ads-list-image-inner">
                                                                <img src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                            </a><!-- /.recent-ads-list-image-inner -->
                                                        </div>
                                                        <!-- /.recent-ads-list-image -->
                                                        <div class="recent-ads-list-content">
                                                            <h4 class="recent-ads-list-title text-justify">
                                                                <?php if ($item->titulo_corto) { ?>
                                                                    <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"><?= $item->titulo_corto ?></a>
                                                                <?php } else { ?>
                                                                    <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"><?= $item->titulo ?></a>
                                                                <?php } ?>
                                                            </h4>
                                                            <ul class="recent-ads-list-location">
                                                                <li><a href="#"><?= $item->ciudad ?></a></li>

                                                            </ul>
                                                            <div class="recent-ads-list-price">
                                                                $ <?= number_format($item->precio, 2) ?>
                                                            </div>
                                                            <!-- /.recent-ads-list-price -->
                                                        </div>
                                                        <!-- /.recent-ads-list-content -->
                                                    </div>
                                                    <!-- /.recent-ads-container -->
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <!-- Categories Panel End -->



                            <!-- Featured Ads Panel -->
                            <!--  <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a>
                                            Featured Ads
                                        </a>
                                    </h4>
                                </div>

                                <div class="panel-collapse">
                                    <div class="panel-body recent-ads">
                                        <div class="featured-slider-3">

                                            <div class="item">
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding">

                                                    <div class="category-grid-box">

                                                        <div class="category-grid-img">
                                                            <img class="img-responsive" alt="" src="images/posting/car-3.jpg">

                                                            <div class="user-preview">
                                                                <a href="#"> <img src="images/users/2.jpg" class="avatar avatar-small" alt=""> </a>
                                                            </div>
                                                        <a href="#" class="view-details">View Details</a>
                                                        </div>

                                                        <div class="short-description">

                                                            <div class="category-title"> <span><a href="#">Cars</a></span> </div>

                                                            <h3><a title="" href="single-page-listing.html">2017 Honda Civic EX</a></h3>

                                                            <div class="price">$18,200 <span class="negotiable">(Negotiable)</span></div>
                                                        </div>

                                                        <div class="ad-info">
                                                            <ul>
                                                                <li><i class="fa fa-map-marker"></i>London</li>
                                                                <li><i class="fa fa-clock-o"></i> 15 minutes ago </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Featured Ads Panel End -->
                            <!-- Latest Ads Panel -->

                            <!-- Latest Ads Panel End -->
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
                <!-- Left Sidebar End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <script>
        function cargar_input(params) {
            $('#category').val(params);
            $("#buscar_categoria").submit();
        }
    </script>
    <style>
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

        .recent-ads .recent-ads-list-image-inner {
            background-color: rgba(0, 0, 0, 0.0) !important;
            display: block;
            height: 60px;
            margin: 0 16px 0 0;
            position: relative;
            width: 100px;
        }
    </style>