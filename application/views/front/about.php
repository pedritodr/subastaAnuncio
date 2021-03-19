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
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
          <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
          <section class="section-padding pattern_dots">
              <!-- Main Container -->
              <div class="container">
                  <!-- Row -->
                  <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                          <div class="about-us-content">
                              <div class="heading-panel">
                                  <h3 class="main-title text-left">
                                      <?= translate('gestion_empresa_lang') ?>
                                  </h3>
                              </div>

                              <?= $empresa_object->sobre_nosotros ?>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                          <div class="about-page-featured-image">
                              <a href="#"><img src="<?= base_url('assets_front/images/logo-subasta-anuncio.png'); ?>" alt=""></a>
                          </div>
                      </div>
                  </div>
                  <!-- Row End -->
              </div>
              <!-- Main Container End -->
          </section>
          <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
          <section class="about-us">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12 no-padding">
                          <!-- service box 3 -->
                          <!-- service box end -->
                          <!-- service box 3 -->
                          <div class="col-sm-6 col-md-6 col-xs-12 no-padding">
                              <div class="why-us border-box text-center">
                                  <h5><?= translate('mision_lang') ?></h5>
                                  <p><?= $empresa_object->mision ?></p>
                              </div>
                              <!-- end featured-item -->
                          </div>
                          <!-- service box end -->
                          <!-- service box 3 -->
                          <div class="col-sm-6 col-md-6 col-xs-12 no-padding">
                              <div class="why-us border-box text-center">
                                  <h5><?= translate('vision_lang') ?></h5>
                                  <p><?= $empresa_object->vision ?></p>
                              </div>
                              <!-- end featured-item -->
                          </div>
                          <!-- service box end -->
                      </div>
                  </div>
              </div>
              <!-- end container -->
          </section>
          <div class="clearfix"></div>


      </div>
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
      </style>