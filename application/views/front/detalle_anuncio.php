      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
         <div class="master-slider ms-skin-default banner2" id="masterslider">
            <?php foreach ($all_banners as $item) { ?>
               <div class="ms-slide slide-1" data-delay="5">
                  <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />

                  <!--  <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs" style="left:90px; top:170px;" data-type="text" data-delay="2000" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)">2017 Ducati Panigale 959 </h3>
                  <h3 class="ms-layer title4 font-white font-thin-xs" style="left:90px; top:220px;" data-type="text" data-delay="2500" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)"><span class="font-color">Brand new 0 kms</span></h3>

                  <h5 class="ms-layer text1 font-white" style="left: 92px; top: 295px;" data-type="text" data-effect="bottom(45)" data-duration="2500" data-delay="3000" data-ease="easeOutExpo">Lorem Ipsum is simply dummy text of the printing typesetting<br>
                     industry is proident sunt in culpa officia deserunt mollit.
                  </h5>
                  <a class="ms-layer btn3 uppercase" style="left:95px; top: 405px;" data-type="text" data-delay="3500" data-ease="easeOutExpo" data-duration="2000" data-effect="scale(1.5,1.6)"> Get Started Now!</a> -->
               </div>
            <?php } ?>
         </div>
      <?php } ?>
      <!-- end Master Slider -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page pattern-bgs gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-xs-12 col-sm-12">
                     <!-- Single Ad -->


                     <div class="single-anun">
                        <!-- Titulo -->
                        <div class="ad-box">
                           <h5><?= $all_anuncios->titulo; ?></h5>
                           <?php if ($all_anuncios->destacado == 1) { ?>
                              <div class="featured-ribbon">
                                 <span>
                                    <?= translate("featured_lang") ?>
                                 </span>
                              </div>
                           <?php } ?>

                           <div class="short-history">
                              <ul>


                              </ul>
                           </div>


                        </div>
                        <!-- Listing Slider  -->
                        <div class="flexslider single-page-slider">
                           <div class="flex-viewport">
                              <ul class="slides slide-main">
                                 <li class="flex-active-slide">
                                    <?php if (strpos($all_anuncios->anuncio_photo, 'uploads') !== false) { ?>
                                       <img style="width:100%" draggable="false" src="<?= base_url($all_anuncios->anuncio_photo) ?>" alt="">
                                    <?php } else { ?>
                                       <img style="width:100%" draggable="false" src="<?= $all_anuncios->anuncio_photo ?>" alt="">

                                    <?php } ?>

                                 </li>
                                 <?php foreach ($fotos_object as $item) { ?>
                                    <li>
                                       <?php if (strpos($item->photo_anuncio, 'uploads') !== false) { ?>
                                          <img style="width:100%" draggable="false" src="<?= base_url($item->photo_anuncio) ?>" alt="">
                                       <?php } else { ?>
                                          <img style="width:100%" draggable="false" src="<?= $item->photo_anuncio ?>" alt="">

                                       <?php } ?>
                                    </li>
                                 <?php } ?>
                              </ul>
                           </div>
                        </div>

                        <!-- Listing Slider Thumb -->
                        <div class="flexslider" id="carousels">
                           <div class="flex-viewport">
                              <ul class="slides slide-thumbnail">
                                 <li class="flex-active-slide">

                                    <?php if (strpos($all_anuncios->anuncio_photo, 'uploads') !== false) { ?>
                                       <img style="width:150px; height:120px" src="<?= base_url($all_anuncios->anuncio_photo) ?>" alt="">
                                    <?php } else { ?>
                                       <img style="width:150px; height:120px" src="<?= $all_anuncios->anuncio_photo ?>" alt="">

                                    <?php } ?>
                                 </li>
                                 <?php foreach ($fotos_object as $item) { ?>
                                    <li>
                                       <?php if (strpos($item->photo_anuncio, 'uploads') !== false) { ?>
                                          <img style="width:150px; height:120px" draggable="false" src="<?= base_url($item->photo_anuncio) ?>" alt="">
                                       <?php } else { ?>
                                          <img style="width:150px; height:120px" draggable="false" src="<?= $item->photo_anuncio ?>" alt="">

                                       <?php } ?>
                                    </li>
                                 <?php } ?>
                                 <!-- items mirrored twice, total of 12 -->
                              </ul>
                           </div>
                        </div>

                        <div class="clearfix"></div>
                        <!-- Short Description  -->
                        <div class="ad-box">
                           <div class="short-features">
                              <!-- Heading Area -->
                              <div class="heading-panel">
                                 <h3 class="main-title text-left">
                                    <?= translate('descripcion_lang') ?>
                                 </h3>
                              </div>

                              <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                                 <span><strong><?= translate('precios_lang'); ?> <?= number_format($all_anuncios->precio, 2); ?></strong></span>
                              </div>
                           </div>
                           <!-- Short Features  -->
                           <div class="desc-points">
                              <ul>
                                 <li>
                                    <?= $all_anuncios->descripcion; ?>
                                 </li>

                              </ul>
                           </div>
                           <!-- Related Image  -->

                           <!-- Ad Specifications -->

                           <div class="clearfix"></div>
                        </div>

                     </div>
                     <!-- Single Ad End -->

                     <!-- =-=-=-=-=-=-= Latest Ads End =-=-=-=-=-=-= -->
                     <?php if ($relacionados) { ?>
                        <?php if (count($relacionados) > 0) { ?>
                           <div class="hidden-sm hidden-xs">
                              <?php if ($relacionados) { ?>
                                 <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
                                 <div class="grid-panel margin-top-30">
                                    <div class="heading-panel">
                                       <div class="col-xs-12 col-md-12 col-sm-12">
                                          <h3 class="main-title text-left">
                                             <?= translate('anuncio_relacionado_lang') ?>
                                          </h3>
                                       </div>
                                    </div>
                                    <!-- Ads Archive -->
                                    <div class="posts-masonry">
                                       <div class="col-md-12 col-xs-12 col-sm-12">

                                          <!-- Ads Archive --><?php if ($relacionados) { ?>
                                             <?php foreach ($relacionados as $item) { ?>
                                                <div class="ads-list-archive">
                                                   <!-- Image Block -->
                                                   <div class="col-lg-4 col-md-4 col-sm-4 no-padding">
                                                      <!-- Img Block -->
                                                      <div class="ad-archive-img">
                                                         <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                            <!--   <div class="ribbon popular"></div> -->


                                                            <?php if (strpos($item->anuncio_photo, 'uploads') !== false) { ?>
                                                               <img class="img-responsive" src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                            <?php } else { ?>
                                                               <img class="img-responsive" src="<?= $item->anuncio_photo ?>" alt="">

                                                            <?php } ?>

                                                         </a>

                                                      </div>
                                                      <!-- Img Block -->
                                                   </div>
                                                   <!-- Ads Listing -->
                                                   <div class="clearfix visible-xs-block"></div>
                                                   <!-- Content Block -->
                                                   <div class="col-lg-8 col-md-8 col-sm-8 no-padding">
                                                      <!-- Ad Desc -->
                                                      <div class="ad-archive-desc">
                                                         <!-- Price -->
                                                         <div class="ad-price">
                                                            <font style="vertical-align: inherit;">
                                                               <font style="vertical-align: inherit;">$ <?= number_format($item->precio, 2) ?></font>
                                                            </font>
                                                         </div>
                                                         <!-- Title -->
                                                         <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                            <h6>
                                                               <font style="vertical-align: inherit;">
                                                                  <font style="vertical-align: inherit;"><?= $item->titulo_corto ?></font>
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
                                                         <div class="clearfix archive-history">

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
                                          <?php } ?>

                                       </div>
                                    </div>
                                 </div> <?php } ?>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  </div>
                  <!-- Right Sidebar -->
                  <div class="col-md-4 col-xs-12 col-sm-12">
                     <!-- Sidebar Widgets -->
                     <div class="sidebar">
                        <!-- Contact info -->

                        <!-- Price info block -->
                        <div class="ad-listing-price">
                           <p>$. <?= number_format($all_anuncios->precio, 2); ?></p>
                        </div>
                        <!-- User Info -->
                        <div class="white-bg user-contact-info">
                           <div class="user-info-card">
                              <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                                 <?php if (strpos($all_anuncios->photo_perfil, 'uploads') !== false) { ?>
                                    <img class="img-responsive" src="<?= base_url($all_anuncios->photo_perfil) ?>" alt="">
                                 <?php } else { ?>
                                    <img class="img-responsive" src="<?= $all_anuncios->photo_perfil ?>" alt="">

                                 <?php } ?>

                              </div>
                              <div class="user-information no-padding col-md-8 col-sm-9 col-xs-8">
                                 <span class="user-name"><a class="hover-color"><?= $all_anuncios->user ?></a></span><br>
                                 <span class="text-center"><a href="https://api.whatsapp.com/send?phone=593<?= $all_anuncios->whatsapp ?>" target="_blank">
                                       <i class="fa fa-whatsapp" aria-hidden="true"></i> <?= $all_anuncios->whatsapp ?></a></span>


                                 <div class="item-date">
                                    <span class="ad-pub"><?= translate("publicado_lang"); ?>: <?= $all_anuncios->fecha ?></span><br>
                                 </div>
                              </div>

                              <div class="clearfix"></div>
                           </div>
                           <div class="ad-listing-meta">
                              <ul>

                                 <li><?= translate("categories_lang"); ?>: <span><?= $all_anuncios->categoria ?>/<?= $all_anuncios->subcategoria ?></span></li>

                                 <li id="direccion"><?= translate("ubicacion_lang") ?>: <span class="color"><?= $all_anuncios->ciudad ?></span></li>
                              </ul>
                           </div>
                           <!--mapa -->
                           <br>
                           <div id="map" class="google-maps">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d89553.25418528763!2d9.19406272678945!3d45.458941223623455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c1493f1275e7%3A0x3cffcd13c6740e8d!2sMilan!5e0!3m2!1sen!2s!4v1403031740860" width="370" height="150"></iframe>
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
                                                      <!--    <div class="user-preview">
                                                   <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"> <img src="" class="avatar avatar-small" alt=""> </a>
                                                </div> -->
                                                      <!-- View Details --><a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>" class="view-details"><?= translate("ver_info_lang") ?></a>
                                                   </div>
                                                   <!-- Ad Img End -->
                                                   <div class="short-description">
                                                      <!-- Ad Category -->
                                                      <div class="category-title"> <span><a><?= $item->categoria ?>/<?= $item->subcategoria ?></a></span> </div>
                                                      <!-- Ad Title -->
                                                      <h6>
                                                         <?php if ($item->titulo_corto) { ?>
                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo_corto ?></a>
                                                         <?php } else { ?>
                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo ?></a>
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
                              </div>
                           <?php } ?>
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
                                                <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>" class="recent-ads-list-image-inner">
                                                   <img src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                </a><!-- /.recent-ads-list-image-inner -->
                                             </div>
                                             <!-- /.recent-ads-list-image -->
                                             <div class="recent-ads-list-content">
                                                <h4 class="recent-ads-list-title text-justify">
                                                   <?php if ($item->titulo_corto) { ?>
                                                      <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo_corto ?></a>
                                                   <?php } else { ?>
                                                      <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo ?></a>
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
                     </div>
                     <!-- Sidebar Widgets End -->

                  </div>
                  <?php if ($relacionados) { ?>
                     <?php if (count($relacionados) > 0) { ?>
                        <div class="col-md-8 hidden-lg didden-md">
                           <?php if ($relacionados) { ?>
                              <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
                              <div class="grid-panel margin-top-30">
                                 <div class="heading-panel">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                       <h3 class="main-title text-left">
                                          <?= translate('anuncio_relacionado_lang') ?>
                                       </h3>
                                    </div>
                                 </div>
                                 <!-- Ads Archive -->
                                 <div class="posts-masonry">
                                    <div class="col-md-12 col-xs-12 col-sm-12">

                                       <!-- Ads Archive --><?php if ($relacionados) { ?>
                                          <?php foreach ($relacionados as $item) { ?>
                                             <div class="ads-list-archive">
                                                <!-- Image Block -->
                                                <div class="col-lg-4 col-md-4 col-sm-4 no-padding">
                                                   <!-- Img Block -->
                                                   <div class="ad-archive-img">
                                                      <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                         <!--   <div class="ribbon popular"></div> -->


                                                         <?php if (strpos($item->anuncio_photo, 'uploads') !== false) { ?>
                                                            <img class="img-responsive" src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                         <?php } else { ?>
                                                            <img class="img-responsive" src="<?= $item->anuncio_photo ?>" alt="">

                                                         <?php } ?>

                                                      </a>

                                                   </div>
                                                   <!-- Img Block -->
                                                </div>
                                                <!-- Ads Listing -->
                                                <div class="clearfix visible-xs-block"></div>
                                                <!-- Content Block -->
                                                <div class="col-lg-8 col-md-8 col-sm-8 no-padding">
                                                   <!-- Ad Desc -->
                                                   <div class="ad-archive-desc">
                                                      <!-- Price -->
                                                      <div class="ad-price">
                                                         <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">$ <?= number_format($item->precio, 2) ?></font>
                                                         </font>
                                                      </div>
                                                      <!-- Title -->
                                                      <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                         <h6>
                                                            <font style="vertical-align: inherit;">
                                                               <font style="vertical-align: inherit;"><?= $item->titulo ?></font>
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
                                                      <div class="clearfix archive-history">

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
                                       <?php } ?>

                                    </div>
                                 </div>
                              </div> <?php } ?>
                        </div>
                     <?php } ?>
                  <?php } ?>

                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jIY1DdGJ7yWZrPDmhCiupu_K2En_4HY&amp;callback=initMap"></script>

         <script type="text/javascript">
            function initMap() {
               var lat = '<?php echo $all_anuncios->lat; ?>';
               var lng = '<?php echo $all_anuncios->lng; ?>';
               getReverseGeocodingData(lat, lng);
               var location = {
                  lat: parseFloat(lat),
                  lng: parseFloat(lng)
               };
               var map = new google.maps.Map(document.getElementById("map"), {
                  zoom: 16,
                  center: location,
                  scrollwheel: false
               });
               var marker = new google.maps.Marker({
                  position: location,
                  map: map

               });



               /*  map.addListener('click', function(e) {
    placeMarkerAndPanTo(e.latLng, map);
  });*/


            }

            setTimeout(function() {
               $("#form-messages").fadeOut(1500);
            }, 3000);

            function getReverseGeocodingData(lat, lng) {

               var latlng = new google.maps.LatLng(lat, lng);
               // This is making the Geocode request
               var geocoder = new google.maps.Geocoder();
               geocoder.geocode({
                  'latLng': latlng
               }, function(results, status) {
                  if (status !== google.maps.GeocoderStatus.OK) {
                     alert(status);
                  }
                  // This is checking to see if the Geoeode Status is OK before proceeding
                  if (status == google.maps.GeocoderStatus.OK) {

                     var address = (results[0].formatted_address);
                     $('#direccion').html("<?= translate("direccion_lang"); ?>:<span class='color'>" + address + "</span>");
                  }
               });
            }
            /* varios marcadores
            function placeMarkerAndPanTo(latLng, map) {
              var marker = new google.maps.Marker({
                position: latLng,
                map: map
              });
              map.panTo(latLng);
            }
            */
         </script>
         <style>
            h6 a:hover {
               color: #8c1822 !important;
            }

            h6 a {
               color: #000 !important;
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