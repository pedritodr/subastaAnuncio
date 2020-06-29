<div id="carousel-example-generic" class="carousel slide banner2" data-ride="carousel">
   <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <?php if (count($all_banners) > 1) { ?>

         <?php for ($i = 1; $i < count($all_banners); $i++) { ?>

            <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"></li>
         <?php } ?>
      <?php } ?>
   </ol>
   
   <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
      </span></a>
</div>
<div class="main-content-area clearfix">
   <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
   <section class="section-padding error-page pattern-bg ">
      <!-- Main Container -->
      <div class="container">
         <!-- Row -->
         <div class="row">
            <!-- Middle Content Area -->
            <h3 class="text-center" style="color:#202836;">Iniciar sesión</h3>
            <div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6 col-sm-12 col-xs-12">
               <!--  Form -->
               <div class="">
                  <?= form_open('login/auth'); ?>
                  <?= get_message_from_operation(); ?>
                  <div class="form-group">
                     <label><?= translate("email_lang"); ?></label>
                     <input required placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" name="email">
                  </div>
                  <div class="form-group">
                     <label><?= translate('password_lang'); ?></label>
                     <input required placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" name="password">
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="skin-minimal">

                              <div class="col-xs-12 col-sm-5 text-right">
                                 <p class="help-block"><a data-target="#myModal" data-toggle="modal"><?= translate('i_forgot_password_lang'); ?></a>
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('entrar_lang'); ?></button>

               </div>
               <!-- Form -->
               <?= form_close(); ?>
               <!-- Middle Content Area  End -->
            </div>
            <!-- Row End -->
         </div>
         <!-- Main Container End -->
   </section>
   <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
</div>
<!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->
<div class="custom-modal">
   <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header rte">
               <h2 class="modal-title"><?= translate('i_forgot_password_lang'); ?></h2>
            </div>
            <?= form_open("login/recover_password") ?>

            <div class="modal-body">

               <div class="form-group">
                  <label><?= translate('email_lang'); ?></label>
                  <input placeholder="<?= translate('escriba_email_lang'); ?>" class="form-control" type="email" name="email">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-default"><?= translate('recuperar_password_lang'); ?></button>
               <button type="button" class="btn btn-dark" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
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