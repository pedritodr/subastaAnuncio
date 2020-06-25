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
<!-- Small Breadcrumb -->
<!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
   <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
   <section class="section-padding error-page pattern-bg ">
      <!-- Main Container -->
      <div class="container">
         <!-- Row -->
         <div class="row">
            <!-- Middle Content Area -->
            <div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6 col-sm-12 col-xs-12">
               <!--  Form -->
               <div class="">

                  <?= form_open('front/activacion_final'); ?>
                  <?= get_message_from_operation() ?>
                  <h4 class="text-center">Verificación de usuario</h4>
                  <p class="text-center">Revisa tu correo electrónico y coloca el código de 4 dígitos
                     que te llegó y escribe tu email. </p>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label><?= translate("email_lang"); ?></label>
                           <input required placeholder="Ej. info@subastanuncio.com" class="form-control" type="email" name="email_valido">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label>Código de verificación</label>
                           <input required placeholder="Ej. 0000" class="form-control input-number" type="number" name="codigo">
                        </div>
                     </div>
                  </div>


                  <button type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('enviar_lang'); ?></button>

               </div>
               <!-- Form -->
               <?= form_close(); ?>
               <br><br>
               <?= form_open('front/generar_codigo'); ?>
               <p class="text-center">Si no te llegó el código, puedes generar otro escribiendo tu email y presionar el
                  botón: Generar código</p>
               <div class="form-group">
                  <label><?= translate("email_lang"); ?></label>
                  <input required placeholder="Ej. info@subastanuncio.com" class="form-control" type="email" name="email">
               </div>

               <button type="submit" class="btn btn-theme btn-lg btn-block">Generar código</button>

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
<!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
<script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
<script>
   function validar_email(email, ok) {
      expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!expr.test(email))
         if (ok == 1) {
            $('input[name=email_valido]').val("");
            $('input[name=email_valido]').focus();
         } else {
            $('input[name=email]').val("");
            $('input[name=email]').focus();
         }


   }

   $('.input-number').on('input', function() {
      this.value = this.value.replace(/[^0-9]/g, '');
   });
   $('.input-text').on('input', function() {
      this.value = this.value.replace(/[^a-zA-Záéíóúñüàè]/i, '');
   });

   $("#email").change(function() {
      var email = $('input[name=email]').val();
      validar_email(email, 2);
   });
   $("#email_valido").change(function() {
      var email = $('input[name=email]').val();
      validar_email(email, 1);
   });
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
</style>