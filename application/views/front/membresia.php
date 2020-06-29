      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
          <div class="master-slider ms-skin-default banner2" id="masterslider">
              <?php foreach ($all_banners as $item) { ?>
                  <!--    <div class="ms-slide slide-1 imagen-banner" data-delay="5">
                  <img style="margin-top: 0px;" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="" alt="<?= $item->foto ?>" />
               </div> -->

                  <div class="ms-slide">

                      <!-- slide background -->
                      <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" />

                  </div>
              <?php } ?>
          </div>
      <?php } ?>
      <!-- end Master Slider -->
      <div class="main-content-area clearfix">
          <section class="custom-padding">
              <!-- Main Container -->
              <div class="container">
                  <!-- Row -->
                  <div class="row">
                      <!-- Heading Area -->
                      <div class="heading-panel">
                          <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                              <!-- Main Title -->
                              <h1><?= translate('menbresi_descrip_lang') ?> <span class="heading-color"><?= translate('name_plan_lang') ?></span></h1>
                              <!-- Short Description -->
                              <p class="heading-text"></p>
                          </div>
                      </div>
                      <!-- Middle Content Box -->
                      <div class="col-md-12 col-xs-12 col-sm-12">
                          <div class="row pricing">
                              <?php foreach ($all_membresia as $item) { ?>
                                  <div class="col-sm-6 col-lg-4 col-md-4">
                                      <div class="block">

                                          <h3><?= $item->nombre ?></h3>

                                          <span class="price">$<?= number_format($item->precio, 2); ?></span>
                                          <span class="time"><?= translate('cant_anuncios_lang') ?> <?= $item->cant_anuncio; ?></span>
                                          <span class="time"><?= translate('descripcion_lang') ?></span>
                                          <div style="height:260px !important" class="text-center">
                                              <?= $item->descripcion; ?>
                                          </div>
                                          <?php if ($this->session->userdata('user_id')) { ?>
                                              <a style="cursor:pointer;" onclick="seleccionar_membresia('<?= base64_encode(json_encode($item)); ?>');" class="btn btn-theme"><?= translate('select_plan_lang') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                          <?php } ?>
                                      </div>
                                  </div>
                              <?php } ?>


                          </div>
                      </div>

                  </div>
                  <!-- Row End -->
              </div>
              <!-- Main Container End -->
          </section>
      </div>
      <!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->

      <!-- =-=-=-=-=-=-= Share Modal =-=-=-=-=-=-= -->
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