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