      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
         <div class="master-slider ms-skin-default banner2" id="masterslider">
            <?php foreach ($all_banners as $item) { ?>
               <div class="ms-slide slide-1" data-delay="5">
                  <img src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />

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
         <section class="section-padding ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 no-padding commentForm">
                     <div class="col-lg-2 col-md-2"></div>
                     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="">
                           <h3 class="text-center"><?= translate('send_menssage_lang') ?></h3>
                           <?= form_open('front/contacto_mensaje'); ?>
                           <?= get_message_from_operation(); ?>
                           <div class="row">
                              <div class="col-lg-12 col-md-12 col-xs-12">
                                 <div class="form-group">
                                    <input required placeholder="<?= translate('nombre_lang'); ?>" class="form-control" type="text" name="name">
                                 </div>
                                 <div class="form-group">
                                    <input placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" name="email">
                                 </div>
                                 <div class="form-group">
                                    <textarea cols="12" rows="7" placeholder="<?= translate('message_lang') ?>" id="message" name="mensaje" class="form-control" required></textarea>
                                 </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <button class="btn btn-theme" type="submit"><?= translate('enviar_lang') ?></button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-2"></div>
                     <?= form_close(); ?>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
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