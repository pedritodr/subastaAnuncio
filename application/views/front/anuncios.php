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
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <!-- Sorting Filters Breadcrumb -->
                            <div class="filter-brudcrums">
                                <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                <div class="filter-brudcrums-sort">
                                    <ul>
                                        <li><span>Sort by:</span></li>
                                        <li><a href="#">Updated date</a></li>

                                    </ul>
                                </div>
                            </div>
                            <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
                        <!-- Ads Archive -->
                        <div class="posts-masonry">
                            <!-- Listing Ad Grid -->
                            <?php foreach ($all_anuncios as $item) { ?>
                                <div class="col-md-6 col-xs-12 col-sm-6">
                                    <!-- Ad Box -->
                                    <div class="category-grid-box">
                                        <!-- Ad Img -->
                                        <div class="category-grid-img">
                                            <img class="img-responsive" alt="" src="<?= base_url($item->anuncio_photo) ?>">
                                            <!-- Ad Status --><span class="ad-status"> Featured </span>
                                            <!-- User Review -->
                                            <div class="user-preview">
                                                <a href="#"> <img src="images/users/1.jpg" class="avatar avatar-small" alt=""> </a>
                                            </div>
                                            <!-- View Details --><a href="<?= site_url('front/detalle_anuncio/' . $item->anuncio_id) ?>" class="view-details"><?= translate("ver_info_lang"); ?></a>
                                            <!-- Additional Info -->
                                            <div class="additional-information">
                                                <?= $item->descripcion ?>
                                            </div>
                                            <!-- Additional Info End-->
                                        </div>
                                        <!-- Ad Img End -->
                                        <div class="short-description">
                                            <!-- Ad Category -->
                                            <div class="category-title"> <span><a href="#"><?= $item->categoria ?>/<?= $item->subcategoria ?></a></span> </div>
                                            <!-- Ad Title -->
                                            <h3><a title="" href="<?= site_url('front/detalle_anuncio/' . $item->anuncio_id) ?>"><?= $item->titulo ?></a></h3>
                                            <!-- Price -->
                                            <div class="price">$<?= number_format($item->precio, 2) ?></div>
                                        </div>
                                        <!-- Addition Info -->
                                        <div class="ad-info">
                                            <ul>
                                                <li><i class="fa fa-map-marker"></i><?= $item->ciudad ?></li>
                                                <!--<li><i class="fa fa-clock-o"></i> 15 minutes ago </li>-->
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Ad Box End -->
                                </div>
                            <?php } ?>
                            <!-- Listing Ad Grid -->

                        </div>
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
                                            Categories
                                        </a>
                                    </h4>
                                    <!-- Title End -->
                                </div>
                                <!-- Content -->
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body categories">
                                        <ul>
                                            <li><a href="#"><i class="flaticon-data"></i>Electronics & Gedget<span>(1029)</span></a></li>
                                            <li><a href="#"><i class="flaticon-transport-6"></i>Cars & Vehicles<span>(1228)</span></a></li>
                                            <li><a href="#"><i class="flaticon-mortgage"></i>Property<span>(178)</span></a></li>
                                            <li><a href="#"><i class="flaticon-technology-8"></i>Mobile & Tablets<span>(2178)</span></a></li>
                                            <li><a href="#"><i class="flaticon-suitcase"></i>Jobs<span>(7178)</span></a></li>
                                            <li><a href="#"><i class="flaticon-search"></i>Home & Garden<span>(7163)</span></a></li>
                                            <li><a href="#"><i class="flaticon-dog"></i>Pets & Animals<span>(8709)</span></a></li>
                                            <li><a href="#"><i class="flaticon-science"></i>Health & Beauty<span>(3129)</span></a></li>
                                            <li><a href="#"><i class="flaticon-game"></i>Hobby, Sport & Kids<span>(2019)</span></a></li>
                                            <li><a href="#"><i class="flaticon-food"></i>Food & Agriculture<span>(323)</span></a></li>
                                            <li><a href="#"><i class="flaticon-blouse"></i>Women & Children Cloths<span>(425)</span></a></li>
                                            <li><a href="#"><i class="flaticon-technology-22"></i>Cameras & Security<span>(3223)</span></a></li>
                                            <li><a href="#"><i class="flaticon-technology-45"></i>Office Product<span>(3283)</span></a></li>
                                            <li><a href="#"><i class="flaticon-wrench"></i>Arts, Crafts & Sewing<span>(3221)</span></a></li>
                                            <li><a href="#"><i class="flaticon-cogwheel-2"></i>Others<span>(3129)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Categories Panel End -->



                            <!-- Featured Ads Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a>
                                            Featured Ads
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div class="panel-collapse">
                                    <div class="panel-body recent-ads">
                                        <div class="featured-slider-3">
                                            <!-- Featured Ads -->
                                            <div class="item">
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                                                    <!-- Ad Box -->
                                                    <div class="category-grid-box">
                                                        <!-- Ad Img -->
                                                        <div class="category-grid-img">
                                                            <img class="img-responsive" alt="" src="images/posting/car-3.jpg">
                                                            <!-- Ad Status -->
                                                            <!-- User Review -->
                                                            <div class="user-preview">
                                                                <a href="#"> <img src="images/users/2.jpg" class="avatar avatar-small" alt=""> </a>
                                                            </div>
                                                            <!-- View Details --><a href="#" class="view-details">View Details</a>
                                                        </div>
                                                        <!-- Ad Img End -->
                                                        <div class="short-description">
                                                            <!-- Ad Category -->
                                                            <div class="category-title"> <span><a href="#">Cars</a></span> </div>
                                                            <!-- Ad Title -->
                                                            <h3><a title="" href="single-page-listing.html">2017 Honda Civic EX</a></h3>
                                                            <!-- Price -->
                                                            <div class="price">$18,200 <span class="negotiable">(Negotiable)</span></div>
                                                        </div>
                                                        <!-- Addition Info -->
                                                        <div class="ad-info">
                                                            <ul>
                                                                <li><i class="fa fa-map-marker"></i>London</li>
                                                                <li><i class="fa fa-clock-o"></i> 15 minutes ago </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- Ad Box End -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Featured Ads Panel End -->
                            <!-- Latest Ads Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a>
                                            Recent Ads
                                        </a>
                                    </h4>
                                </div>
                                <!-- Content -->
                                <div class="panel-collapse">
                                    <div class="panel-body recent-ads">
                                        <!-- Ads -->
                                        <div class="recent-ads-list">
                                            <div class="recent-ads-container">
                                                <div class="recent-ads-list-image">
                                                    <a href="#" class="recent-ads-list-image-inner">
                                                        <img src="images/posting/thumb-1.jpg" alt="">
                                                    </a><!-- /.recent-ads-list-image-inner -->
                                                </div>
                                                <!-- /.recent-ads-list-image -->
                                                <div class="recent-ads-list-content">
                                                    <h3 class="recent-ads-list-title">
                                                        <a href="#">Sony Xperia Z1</a>
                                                    </h3>
                                                    <ul class="recent-ads-list-location">
                                                        <li><a href="#">New York</a>,</li>
                                                        <li><a href="#">Brooklyn</a></li>
                                                    </ul>
                                                    <div class="recent-ads-list-price">
                                                        $ 17,000
                                                    </div>
                                                    <!-- /.recent-ads-list-price -->
                                                </div>
                                                <!-- /.recent-ads-list-content -->
                                            </div>
                                            <!-- /.recent-ads-container -->
                                        </div>
                                        <!-- Ads -->



                                    </div>
                                </div>
                            </div>
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