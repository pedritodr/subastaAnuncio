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
            <div class="col-md-6 col-md-push-3 col-sm-12 col-xs-12">
               <!--  Form -->
               <div class="form-grid">
                  <form action="<?= site_url('front/add_cliente'); ?>" method="post">
                     <?php if (get_message_from_operation()) { ?>
                        <div role="alert" class="alert alert-success alert-dismissible">
                           <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                           <strong><?= get_message_from_operation(); ?></strong>
                        </div>
                     <?php } ?>
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate("primer_nombre_lang"); ?></label>
                              <input required placeholder="Ej. Jesus" class="form-control input-text" type="text" id="name" name="name">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate("primer_apellido_lang"); ?></label>
                              <input required placeholder="Ej. Perez" class="form-control input-text" type="text" id="surname" name="surname">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div style="background: none;" id="search-section">

                              <div class="row">
                                 <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="col-md-5 col-xs-12 col-sm-5 no-padding">
                                       <select class="form-control" name="tipo_documento" id="tipo_documento" required>

                                          <option value="1">Cédula</option>
                                          <option value="2">Pasaporte</option>
                                       </select>
                                    </div>
                                    <div class="col-md-7 col-xs-12 col-sm-7 no-padding">
                                       <input name="nro_documento" type="number" class="form-control input-number" placeholder="Nro de documento de identidad" required />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>

                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate("email_lang"); ?></label>
                              <input placeholder="Ej. info@subastanuncio.com" class="form-control" type="email" name="email" id="email" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate("phone_user__lang"); ?></label>
                              <input placeholder="Ej. 986547800" class="form-control input-number" type="number" name="phone" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate('password_lang'); ?></label>
                              <input placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" name="password" required>
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label><?= translate('repeat_password_lang'); ?></label>
                              <input placeholder="<?= translate('repeat_password_lang'); ?>" class="form-control" type="password" name="repeat_password" required>
                           </div>
                        </div>
                     </div>


                     <button type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('registrarse_lang'); ?></button>
                  </form>
               </div>
               <!-- Form -->
            </div>


            <!-- Middle Content Area  End -->
         </div>
         <!-- Row End -->
      </div>
      <!-- Main Container End -->
   </section>
   <style>
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
   <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
   <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
   <script>
      function validar_email(email) {
         expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if (!expr.test(email)) {
            $('#email').val("");
            $('#email').focus();
         } else {
            $('#email').val(email.trim());
         }
      }

      $('.input-number').on('input', function() {
         this.value = this.value.replace(/[^0-9]/g, '');
      });
      $('.input-text').on('input', function() {
         this.value = this.value.replace(/[^a-zA-ZáéíóúñüàèÑ ]/i, '');
      });

      $("#email").change(function() {
         var email = $('#email').val();
         $('#email').val(email.trim());
         validar_email(email);
      });
      $('#name').change(function() {
         let texto = $('#name').val();
         texto = texto.trim();
         texto = texto.split(" ");
         if (texto.length > 1) {
            texto = texto[0];
         } else {
            texto = texto[0];
         }
         $('#name').val(texto);
      });
      $('#surname').change(function() {
         let texto = $('#surname').val();
         texto = texto.trim();
         texto = texto.split(" ");
         if (texto.length > 2) {
            texto = texto[0] + " " + texto[1];
         } else {
            texto = texto[0] + " " + texto[1];
         }
         $('#surname').val(texto);
      });
   </script>