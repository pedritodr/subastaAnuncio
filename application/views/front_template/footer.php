<!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
<footer class="footer-area">
   <!--Footer Upper-->
   <div class="footer-content">
      <div class="container">
         <div class="row clearfix">
            <!--Two 4th column-->
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="row clearfix">
                  <div class="col-lg-4 col-sm-4 col-xs-12 column">
                     <div class="footer-widget about-widget">
                        <div class="logo">
                           <a href="<?= site_url('portada') ?>"><img alt="" class="img-responsive" src="<?= base_url('assets_front/images/subastanuncio-x1.png'); ?>"></a>
                        </div>
                        <br>
                        <div class="social-links-two clearfix text-center">
                           <?php if ($empresa_object->facebook) { ?>
                              <a class="facebook img-circle" href="<?= $empresa_object->facebook ?>"><span class="fa fa-facebook-f"></span></a>
                           <?php } ?>
                           <?php if ($empresa_object->youtube) { ?>
                              <a class="twitter img-circle" href="<?= $empresa_object->youtube ?>"><span class="fa fa-youtube"></span></a>
                           <?php } ?>
                           <?php if ($empresa_object->instagram) { ?>
                              <a class="google-plus img-circle" href="<?= $empresa_object->instagram ?>"><span class="fa fa-instagram"></span></a>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-sm-5 col-xs-12 column">
                     <div class="footer-widget about-widget">

                        <ul class="contact-info">
                           <?php if ($empresa_object->direccion) { ?>
                              <li style="color:#fff"><span style="color:#fff" class="icon fa fa-map-marker"></span> <?= $empresa_object->direccion ?></li>
                           <?php } ?>
                           <?php if ($empresa_object->telefonos) { ?>
                              <li style="color:#fff"><span style="color:#fff" class="icon fa fa-phone"></span> <?= $empresa_object->telefonos ?></li>
                           <?php } ?>
                        </ul>

                     </div>
                  </div>
                  <div class="col-lg-3 col-sm-3 col-xs-12 column">
                     <div class="footer-widget about-widget">

                        <ul class="contact-info">
                           <?php if ($empresa_object->telefonos) { ?>
                              <li style="color:#fff"><span style="color:#fff" class="icon fa fa-envelope-o footer-hover"></span> <?= $empresa_object->email ?></li>
                           <?php } ?>

                        </ul>

                     </div>
                  </div>

                  <!--Footer Column-->

               </div>
            </div>
            <!--Two 4th column End-->
            <!--Two 4th column-->

            <!--Two 4th column End-->
         </div>
      </div>
   </div>
   <!--Footer Bottom-->
   <div class="footer-copyright">
      <div class="container clearfix">
         <!--Copyright-->
         <div class="copyright text-center">Copyright © 2019-<?php if (date('Y') != 2019)  date('Y') ?> Todos los derechos reservados para &nbsp; <?= $empresa_object->nombre ?>. Potenciado por &nbsp;<a style="color:#fff" href="http://www.datalabcenter.com/"> DatalabCenter</a></div>
      </div>
   </div>
</footer>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- Main Content Area End -->
<!-- Post Ad Sticky -->
<?php if ($this->session->userdata('user_id')) { ?>
   <a href="<?= site_url('crear-anuncio') ?>" class="sticky-post-button hidden-xs">
      <span class="sell-icons">
         <i class="flaticon-online-job-search-symbol"></i>
      </span>
      <h4><?= translate("publicar_lang"); ?></h4>
   </a>
<?php } else { ?>
   <a onclick="login()" class="sticky-post-button hidden-xs">
      <span class="sell-icons">
         <i class="flaticon-online-job-search-symbol"></i>
      </span>
      <h4><?= translate("publicar_lang"); ?></h4>
   </a>
<?php } ?>
<!-- Back To Top -->
<a href="#0" class="cd-top">Top</a>
<!-- =-=-=-=-=-=-= Inicio Modal fotos =-=-=-=-=-=-= -->


<div id="modal_imagen" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <?php echo form_open_multipart("front/photo_anuncio") ?>

            <input type="hidden" id='anuncio_id' name="anuncio_id">


            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel"><?= translate('add_photo_lang') ?></h3>
         </div>
         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <div id="alert-message" class="alert alert-danger alert-dismissable" style="display: none;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-ban"></i> <?= translate('title_alert_message_lang'); ?></h4>
                     <p></p>
                  </div>
                  <label><?= translate("image_lang"); ?> (750x750)</label>
                  <input type="file" class="form-control input-sm" name="archivo" id="image_upload" placeholder="<?= translate('image_lang'); ?>" required>
                  <br>
                  <div id="galeria">

                  </div>


                  <div id="dropzone" class="dropzone"></div>
               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-block"><?= translate('add_boton_lang') ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<!-- =-=-=-=-=-=-= Inicio Modal detalles subasta =-=-=-=-=-=-= -->
<div id="modal_desactivar" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <?php echo form_open_multipart("front/desactivar") ?>

            <input type="hidden" id='anuncio_id2' name="anuncio_id2">


            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="title_desactivar"><?= translate('desactivar_ads_lang') ?></h3>
            <h3 class="modal-title text-center" id="title_activar"><?= translate('activar_ads_lang') ?></h3>


         </div>
         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <p class="text-center" id="mensaje_desactivar">
                     <?= translate('confirmar_desactivar_ads_lang') ?>
                  </p>
                  <p class="text-center" id="mensaje_activar">
                     <?= translate('confirmar_activar_ads_lang') ?>
                  </p>

                  <div id="dropzone" class="dropzone"></div>
               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btn_desactivar" type="submit" class="btn btn-theme btn-block"><?= translate('desactivar_ads_lang') ?></button>
               <button id="btn_activar" type="submit" class="btn btn-theme btn-block"><?= translate('activar_ads_lang') ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<div id="modal_destacar" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <?php echo form_open_multipart("front/destacar_anuncio") ?>

            <input type="hidden" id='anuncio_id_destacar' name="anuncio_id_destacar">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center"><?= translate('featured_ads_lang') ?></h3>
         </div>
         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

                  <p class="text-center">
                     <?= translate('confirmar_destacar_ads_lang') ?>
                  </p>

                  <div id="dropzone" class="dropzone"></div>
               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btn_destacar" type="submit" class="btn btn-theme btn-block"><?= translate('featured_ads_lang') ?></button>

            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<div class="quick-view-modal modalopen" id="modal_detalle" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg ad-modal">
      <button class="close close-btn popup-cls" aria-label="Close" data-dismiss="modal" type="button"> <i class="fa-times fa"></i> </button>
      <div class="modal-content single-product">

         <div class="diblock">
            <div class="col-lg-7 col-sm-12 col-xs-12">
               <div class="flexslider single-page-slider">
                  <div class="flex-viewport">

                     <div id="myCarousel" class="carousel slide2" data-interval="3000" data-ride=" carousel">

                        <ol class="carousel-indicators">

                        </ol>

                        <div id="galeria_main" class="carousel-inner">



                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

                     </div>
                  </div>
               </div>

            </div>

            <div class=" col-sm-12 col-lg-5 col-xs-12">
               <div class="summary entry-summary">
                  <div class="ad-preview-details">

                     <a href="#">
                        <h4 id="titulo"></h4>
                     </a>
                     <div class="overview-price">
                        <div class="row">
                           <div class="col-md-4">
                              <span style="margin-top:5px"><?= translate('precios_lang') ?> <h5 id="precio"> </h5> </span>
                           </div>
                           <div id="body_valor_alto" class="col-md-8">
                              <span style="color:#fff" class="label label-success"><?= translate("valor_alto_lang"); ?> <h4 id="valor_alto_modal" style="color:#fff"></h4></span>
                           </div>
                        </div>


                     </div>
                     <div class="overview-price"></div>

                     <h3><?= translate('descripcion_lang') ?></h3>
                     <p id="descripcion"></p>

                     <ul class="ad-preview-info col-md-12 col-sm-12">
                        <li id="li_valor_entrada">
                           <span><?= translate('valor_pagado_lang') ?></span>
                           <p id="valor_entrada"></p>
                        </li>
                        <li>
                           <span><?= translate('date_cierre_lang') ?></span>
                           <p id="fecha_cierre"></p>
                        </li>



                     </ul>

                     <div style="display:none" id="body_cronometro" style="margin-left:41px; margin-bottom:5px" class="col-md-12">
                        <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                           <div class="timer conte">
                              <span class="days a"></span>
                           </div>
                           <div class="smalltext"><?= translate("dias_lang"); ?></div>
                        </div>
                        <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                           <div class="timer conte">
                              <span class="hours b"></span>
                           </div>
                           <div class="smalltext"><?= translate("horas_lang"); ?></div>
                        </div>
                        <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                           <div class="timer conte">
                              <span class="minutes c"></span>
                           </div>
                           <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                        </div>
                        <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                           <div class="timer conte">
                              <span class="seconds d"></span>
                           </div>
                           <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                        </div>
                     </div>
                     <br>
                     <?php if ($this->session->userdata('user_id')) { ?>
                        <div class="row">

                           <div id="body_entrar_subasta" class="col-md-12">
                              <button id="btn_entrar_subasta" onclick="" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>
                              <br>
                           </div>

                           <div id="body_pujar" class="col-md-12">
                              <button id="btn_pujar" onclick="" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>
                           </div>
                           <div style="display:none" id="body_comprar_inversa" class="col-md-12">
                              <button id="btn_comprar_inversa" onclick="" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("comprar_inversa_lang"); ?></button>
                           </div>

                        </div>
                     <?php } ?>
                  </div>
               </div>
               <!-- .summary -->
            </div>
         </div>
      </div>
   </div>
</div>
<!---modal entrar-->
<!-- =-=-=-=-=-=-= Price Quote Modal =-=-=-=-=-=-= -->
<div class="modal fade price-quote" id="modal_entrar" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("entrar_subasta_lang"); ?></h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <?php echo form_open_multipart("front/pagar_entrada") ?>
            <h5 class="text-center" id="name_subasta"></h5>
            <h4 id="inicial" class="text-center"></h4>

            <input type="hidden" id='subasta_id' name="subasta_id">

            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-block"><?= translate('pagar_lang') ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<div class="modal fade price-quote" id="modal_login" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("login_lang"); ?></h3>

            <?php if (get_message_from_operation()) { ?>
               <div role="alert" class="alert alert-success alert-dismissible">
                  <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                  <strong><?= get_message_from_operation(); ?></strong>
               </div>
            <?php } ?>
         </div> <?= form_open('login/auth'); ?>
         <input name="valida_ads" id="" type="hidden" value="1">
         <div class="modal-body">
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
                           <p class="help-block"><a href="<?= site_url('registrarse') ?>"><?= translate('registrarse_lang'); ?></a>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('entrar_lang'); ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<div class="modal fade price-quote" id="modal_pagar_inversa" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("comprar_inversa_lang"); ?></h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <?php echo form_open_multipart("front/pagar_inversa") ?>
            <h5 class="text-center" id="name_subasta_inversa"></h5>
            <h4 id="valor_inversa" class="text-center"></h4>

            <input type="hidden" id='invresa_subasta_id' name="invresa_subasta_id">

            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-block"><?= translate('pagar_lang') ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>

<div class="modal fade price-quote" id="modal_pujar" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("subir_puja_lang"); ?></h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <?php echo form_open_multipart("front/pujar") ?>
            <h4 class="text-center" id="name_subasta"></h4>
            <h4 class="text-center"><?= translate("valor_alto_lang"); ?> <span id="valor_puja" class="label label-danger"></span></h4>

            <input type="hidden" id='subasta_user_id' name="subasta_user_id">
            <div class="clearfix"></div>
            <div class="form-group">
               <label for="valor"><?= translate("escriba_valor_lang"); ?></label>
               <input placeholder="<?= translate("escriba_valor_lang"); ?>" class="form-control" type="number" name="valor" id="valor">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-block"><?= translate('pujar_lang') ?></button>
            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>

<div id="modal_membresia_gratis" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("menbresi_lang"); ?></h3>
         </div>
         <?php echo form_open_multipart("front/pagar_membresia") ?>
         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <h3 class="text-center" id="nombre_membresia"></h3>
                  <h4 class="text-center" id="precio_membresia"></h4>
                  <input name="membresia_id" id="membresia_id" type="hidden" value="">

               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button type="submit" class="btn btn-theme btn-block"><?= translate('pagar_lang'); ?></button>
               <button type="button" class="btn btn-dark btn-block" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>

            </div>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
<script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
<!-- Bootstrap Core Css  -->
<script src="<?= base_url('assets_front/js/bootstrap.min.js') ?>"></script>
<!-- Jquery Easing -->
<script src="<?= base_url('assets_front/js/easing.js') ?>"></script>
<!-- Menu Hover  -->
<script src="<?= base_url('assets_front/js/forest-megamenu.js') ?>"></script>
<!-- Jquery Appear Plugin -->
<!-- <script src="<?= base_url('assets_front/js/jquery.appear.min.js') ?>"></script> -->
<!-- Numbers Animation   -->
<script src="<?= base_url('assets_front/js/jquery.countTo.js') ?>"></script>
<!-- Jquery Smooth Scroll  -->
<!-- <script src="<?= base_url('assets_front/js/jquery.smoothscroll.js') ?>"></script> -->
<!-- Jquery Select Options  -->
<script src="<?= base_url('assets_front/js/select2.min.js') ?>"></script>
<!-- noUiSlider -->
<script src="<?= base_url('assets_front/js/nouislider.all.min.js') ?>"></script>
<!-- Carousel Slider  -->
<script src="<?= base_url('assets_front/js/carousel.min.js') ?>"></script>
<script src="<?= base_url('assets_front/js/slide.js') ?>"></script>
<!-- Image Loaded  -->
<script src="<?= base_url('assets_front/js/imagesloaded.js') ?>"></script>
<script src="<?= base_url('assets_front/js/isotope.min.js') ?>"></script>
<!-- CheckBoxes  -->
<script src="<?= base_url('assets_front/js/icheck.min.js') ?>"></script>
<!-- Jquery Migration  -->
<!-- <script src="<?= base_url('assets_front/js/jquery-migrate.min.js') ?>"></script> -->
<!-- Sticky Bar  -->
<script src="<?= base_url('assets_front/js/theia-sticky-sidebar.js') ?>"></script>
<!-- Style Switcher -->
<script src="<?= base_url('assets_front/js/color-switcher.js') ?>"></script>
<!-- Template Core JS -->
<script src="<?= base_url('assets_front/js/custom.js') ?>"></script>

<script type="text/javascript">
   let contador_directa = 0;
   let vacio = null;
   let contador_inversa = 0;
   let user_id = "<?= $this->session->userdata('user_id') ?>";
   $(function() {

      $('.carousel').carousel();

      setTimeout(function() {
         $(".alert").fadeOut(1500);
      }, 6000);
      $('#carousels').flexslider({
         animation: "slide",
         controlNav: false,
         animationLoop: false,
         slideshow: false,
         itemWidth: 110,
         itemMargin: 50,
         asNavFor: '.single-page-slider'
      });
      $('.single-page-slider').flexslider({
         animation: "slide",
         controlNav: false,
         animationLoop: false,
         slideshow: true,
         sync: "#carousel"
      });

      var mensaje = "<?php echo get_message_from_operation(); ?>";

      if (mensaje == "<div class='alert alert-success msg-info message_info'>Membresia adquirida exitosamente</div>") {
         $('#perfil_tab').removeClass("active");
         $('#profile').removeClass("in active");
         $('#editar_tab').removeClass("active");
         $('#edit').removeClass("in active");
         $('#membresia_tab').addClass("active");
         $('#membresia').addClass("in active");


      }

   });
   $(".item").click(function() {
      $("#myCarousel").carousel(0);
   });

   function login() {
      $('#modal_login').modal('show');
   }
   // Enable Carousel Controls
   $(".left").click(function() {
      $("#myCarousel").carousel("prev");
   });

   function cargar_modal_imagen(id) {
      $('#modal_imagen').modal("show");
      $('#anuncio_id').val(id);
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/buscar_fotos') ?>",

         data: {
            id: id
         },
         success: function(result) {
            result = JSON.parse(result);

            if (result) {
               for (let i = 0; i < result.length; i++) {
                  $('#galeria').append("<div style='padding-left:0px; padding-right:0px;' class='col-lg-2' id='foto_" + result[i].photo_anuncio_id + "'><img style='width:80px; height:80px;' src='<?= base_url() ?>" + result[i].photo_anuncio + "'><a  style='position:absolute; top:-7;right:8px; width:20px; heigth:20px;'  title='<?= translate('delete_photo_lang') ?>'  style='cursor:pointer' onclick='delete_img(" + result[i].photo_anuncio_id + ")'><i style='color:#fff' class='fa fa-times delete'></i></a></div>");

               }


            }

         }
      });

   }

   function delete_img(id) {

      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/delete_fotos') ?>",

         data: {
            id: id
         },
         success: function(result) {
            $('#foto_' + id).empty();
            result = JSON.parse(result);
         }
      });

   }


   function cargar_modal_desactivar(id, cod) {
      if (cod == 1) {
         $('#title_desactivar').show();
         $('#title_activar').hide();
         $('#mensaje_activar').hide();
         $('mensaje_desactivar').show();
         $('#btn_activar').hide();
         $('#btn_desactivar').show();
      } else {

         $('#title_desactivar').hide();
         $('#title_activar').show();
         $('#mensaje_activar').show();
         $('#mensaje_desactivar').hide();
         $('#btn_activar').show();
         $('#btn_desactivar').hide();
      }
      $('#modal_desactivar').modal("show");
      $('#anuncio_id2').val(id);
   }

   function cargar_modal_destacar(id) {

      $('#modal_destacar').modal("show");
      $('#anuncio_id_destacar').val(id);
   }

   function cargar_modal_membresia(id, nombre, precio, cantidad) {
      var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#membresia').val(id);
      $('#nombre').text(nombre);
      $('#precio').text("$" + parseFloat(precio).toFixed(2));
      $('#cantidad').text(cant + " " + cantidad);
      $("#modal_membresia").modal("show");
   }

   function cargarmodal_entrar(id, nombre, precio) {
      //  var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#subasta_id').val(id);
      $('#name_subasta').text(nombre);
      $('#inicial').html("<span class='label label-primary'>$" + parseFloat(precio).toFixed(2) + "</span>");

      $("#modal_entrar").modal("show");
      $("#modal_detalle").modal("hide");
   }

   function cargarmodal_pujar(id, nombre, precio, valor_inicial) {

      // var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#subasta_user_id').val(id);
      $('#name_subasta').text(nombre);
      if (precio == "") {
         $('#valor_puja').text("$" + parseFloat(valor_inicial).toFixed(2));
      } else {
         $('#valor_puja').text("$" + parseFloat(precio).toFixed(2));
      }
      $("#modal_pujar").modal("show");
      $("#modal_detalle").modal("hide");
   }

   function cargarmodal_subasta(id, object) {
      if (object != "") {
         object = atob(object);
         object = JSON.parse(object);
      }

      console.log(object);
      if (object != "") {
         //  $("#body_valor_alto").show();
         //  $("#body_entrar_subasta").hide();
         $("#body_pujar").hide();
         $('#galeria_main').empty();
         $('.carousel-indicators').empty();

         var cadena_1 = "";
         var cadena_2 = "";
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/detalle_subasta') ?>",

            data: {
               id: id
            },
            success: function(result) {
               result = JSON.parse(result);
               console.log(result);
               if (result) {


                  cadena_1 = "<div class='item active'><img  src='<?= base_url() ?>" + result.all_detalle.photo + "'></div>"
                  // $('#imagen_main').attr("src", "<?= base_url() ?>" + result.all_detalle.photo)
                  for (let i = 0; i < result.foto_object.length; i++) {
                     cadena_1 = cadena_1 + "<div class='item'><img  src='<?= base_url() ?>" + result.foto_object[i].url_photo + "'></div>"

                  }
                  cont = 0;
                  cadena_2 = "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
                  for (let k = 0; k < result.foto_object.length; k++) {
                     cont++;
                     //  cadena_2 = "<li style='width:106px !important' class='flex-active-slide'><img draggable='false'  src='<?= base_url() ?>" + result.all_detalle.photo + "'></li>";

                     cadena_2 = cadena_2 + "<li data-target='#myCarousel' data-slide-to='" + cont + "'></li>";

                  }
                  var count_intervalo = object.intervalo.length;

                  $('#galeria_main').html(cadena_1);
                  $('.carousel-indicators').html(cadena_2);
                  if (count_intervalo >= 2) {

                     $('#precio').html("<b class='strikethrough' style='font-size:16px !important; color:#2a3681 !important'>$" + parseFloat(object.intervalo[count_intervalo - 2].valor).toFixed(2) + "</b> $" + parseFloat(object.intervalo[count_intervalo - 1].valor).toFixed(2));
                  } else {
                     $('#precio').html("$" + parseFloat(object.intervalo[count_intervalo - 1].valor).toFixed(2));

                  }

                  $('#titulo').text(result.all_detalle.nombre_espa);
                  $('#descripcion').html(result.all_detalle.descrip_espa);
                  $('#body_valor_alto').hide();
                  $('#li_valor_entrada').hide();
                  $('#body_comprar_inversa').show();
                  $('#body_entrar_subasta').hide();
                  $('#body_cronometro').hide();
                  $('#fecha_cierre').text(object.intervalo[count_intervalo - 1].fecha);
                  $('#btn_comprar_inversa').attr("onclick", "pagar_subasta_inversa('" + btoa(JSON.stringify(object)) + "')");

               }

            }
         });
      } else {
         $("#body_valor_alto").show();
         $("#body_entrar_subasta").hide();
         $("#body_pujar").hide();
         $('#galeria_main').empty();
         $('.carousel-indicators').empty();
         $('.a').attr("id", "day-" + id);
         $('.b').attr("id", "hour-" + id);
         $('.c').attr("id", "minute-" + id);
         $('.d').attr("id", "second-" + id);
         $('#day-' + id).html("0");
         $('#hour-' + id).html("0");
         $('#minute-' + id).html("0");
         $('#second-' + id).html("0");
         var cadena_1 = "";
         var cadena_2 = "";
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/detalle_subasta') ?>",

            data: {
               id: id
            },
            success: function(result) {
               result = JSON.parse(result);
               if (result) {
                  console.log(result);
                  var fecha = result.all_detalle.fecha_cierre;
                  var date = new Date(fecha);
                  var hoy = new Date();

                  // console.log(hoy + " inter " + date);
                  if (date >= hoy) {

                     var x = setInterval(function() {

                        var deadline = new Date(fecha).getTime();
                        var currentTime = new Date().getTime();
                        var t = deadline - currentTime;
                        var days = Math.floor(t / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((t % (1000 * 60)) / 1000);
                        $('#day-' + id).html(days);
                        $('#hour-' + id).html(hours);
                        $('#minute-' + id).html(minutes);
                        $('#second-' + id).html(seconds);

                        if (t < 0) {

                           clearInterval(x);

                           $('#day-' + id).html(0);
                           $('#hour-' + id).html(0);
                           $('#minute-' + id).html(0);
                           $('#second-' + id).html(0);

                        }

                     }, 1000);
                  } else {

                     $('#day-' + id).html(0);
                     $('#hour-' + id).html(0);
                     $('#minute-' + id).html(0);
                     $('#second-' + id).html(0);
                  }

                  cadena_1 = "<div class='item active'><img  src='<?= base_url() ?>" + result.all_detalle.photo + "'></div>"
                  // $('#imagen_main').attr("src", "<?= base_url() ?>" + result.all_detalle.photo)
                  for (let i = 0; i < result.foto_object.length; i++) {
                     cadena_1 = cadena_1 + "<div class='item'><img  src='<?= base_url() ?>" + result.foto_object[i].url_photo + "'></div>"

                  }
                  cont = 0;
                  cadena_2 = "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
                  for (let k = 0; k < result.foto_object.length; k++) {
                     cont++;
                     //  cadena_2 = "<li style='width:106px !important' class='flex-active-slide'><img draggable='false'  src='<?= base_url() ?>" + result.all_detalle.photo + "'></li>";

                     cadena_2 = cadena_2 + "<li data-target='#myCarousel' data-slide-to='" + cont + "'></li>";

                  }
                  $('#body_cronometro').show();
                  $('#galeria_main').html(cadena_1);
                  $('.carousel-indicators').html(cadena_2);
                  $('#precio').text("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                  $('#titulo').text(result.all_detalle.nombre_espa);
                  $('#descripcion').html(result.all_detalle.descrip_espa);
                  $('#valor_entrada').text("$" + parseFloat(result.all_detalle.valor_pago).toFixed(2));
                  $('#fecha_cierre').text(result.all_detalle.fecha_cierre);
                  if (result.puja != null) {
                     $("#valor_alto_modal").text("$" + parseFloat(result.puja.valor).toFixed(2));
                  }

                  if (result.subasta_user && result.puja.valor == null) {
                     $('#valor_alto_modal').text("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                  }
                  if (result.subasta_user == null && result.puja.valor == null) {
                     $('#body_valor_alto').hide();
                  }


                  if (result.subasta_user == null && user_id) {
                     $("#body_entrar_subasta").show();
                     $("#btn_entrar_subasta").attr('onclick', 'cargarmodal_entrar("' + result.all_detalle.subasta_id + '","' + result.all_detalle.nombre_espa + '","' + result.all_detalle.valor_inicial + '")');

                  } else {
                     $("#body_pujar").show();
                     $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');

                  }



               }

            }
         });
      }

      $("#modal_detalle").modal("show");

   }


   function seleccionar_membresia(object) {
      object = atob(object);
      object = JSON.parse(object);
      var user_id = "<?= $this->session->userdata('user_id'); ?>";
      var phone = "<?= $this->session->userdata('phone'); ?>";
      var email = "<?= $this->session->userdata('email'); ?>";
      $('#nombre_membresia').text(object.nombre);
      $('#precio_membresia').text("$" + parseFloat(object.precio).toFixed(2));
      $('#membresia_id').val(object.membresia_id);
      $('#modal_membresia_gratis').modal('show');

   }


   /* $(".modal-body").bind("click", function() {

    });*/
   let FILETYPES = [
      'image/jpeg',
      'image/pjpeg',
      'image/png',
      'image/bmp',
      'image/gif'
   ];

   let MESSAGES = [];
   let MAX_FILE_SIZE = 5 * 1048576;

   // Define text message
   MESSAGES['file_not_accept'] = '<?= "Extención del archivo no valida" ?>';
   MESSAGES['file_size_exceeded'] = '<?= "El archivo seleccionado supera los 5mb permitidos" ?>';

   // action message validation
   let input_image = $("#image_upload");
   let alert_message = $("#alert-message");

   input_image.on("change", (e) => {

      if (window.File && window.FileReader && window.FileList && window.Blob) {

         //get the file size and file type from file input field
         let fileUpload = e.target.files[0];

         // Validate type file
         if (!validFileType(fileUpload)) {
            // console.log("Tipo de archivo Incorrecto");
            showMessage(MESSAGES['file_not_accept']);
            resetForm();
         }

         // Valid max file size
         if (fileUpload.size > MAX_FILE_SIZE) {
            // console.log('Supera los 5 mb');
            showMessage(MESSAGES['file_size_exceeded']);
            resetForm();
         }
      }
   });

   function showMessage(message) {
      alert_message.find('p').html(message);
      alert_message.show(1);
      setTimeout(() => {
         alert_message.fadeOut(2000)
      }, 5000);
   }

   function resetForm() {
      input_image.val('');
   }

   function validFileType(file) {
      console.log(FILETYPES);
      for (let i = 0; i < FILETYPES.length; i++) {
         if (file.type === FILETYPES[i]) {
            return true;
         }
      }
      return false;
   }

   function cambio_btn_directa() {
      $('.mensaje_directa').hide();
      $('.mensaje_inversa').hide();
      $('#btn_subasta_directa').addClass('active');
      $('#btn_subasta_inversa').removeClass('active');
      $('.inverse').hide();
      $('.direct').show();
      $('.mensaje_directa').hide();
      valida = $('.direct').is(":visible");

      if (!valida) {
         $('.mensaje_directa').show();
         $('.mensaje_inversa').hide();
      }
      //  valida = $('.subastas').hasClass("inverse");


   }

   function cambio_btn_inversa() {
      $('.mensaje_directa').hide();
      $('.mensaje_inversa').hide();
      $('#btn_subasta_directa').removeClass('active');
      $('#btn_subasta_inversa').addClass('active');
      $('.direct').hide();
      $('.inverse').show();
      $('.mensaje_inversa').hide();
      valida = $('.inverse').is(":visible");

      if (!valida) {
         $('.mensaje_directa').hide();
         $('.mensaje_inversa').show();
      }
      //valida = $('.subastas').hasClass("inverse");

   }

   function detalle_categoria(inversa, directa) {
      $('.mensaje_directa').hide();
      $('.mensaje_inversa').hide();
      valida_directa = $('#btn_subasta_directa').hasClass('active');
      valida_inversa = $('#btn_subasta_inversa').hasClass('active');
      if (inversa == 0 && valida_inversa) {
         $('.mensaje_directa').hide();
         $('.mensaje_inversa').show();
      }
      if (directa == 0 && valida_directa) {
         $('.mensaje_directa').show();
         $('.mensaje_inversa').hide();
      }

   }

   function pagar_subasta_inversa(object) {
      object = atob(object);
      object = JSON.parse(object);
      $('#name_subasta_inversa').text(object.nombre_espa);
      $('#valor_inversa').text("$" + parseFloat(object.intervalo[object.intervalo.length - 1].valor).toFixed(2));
      $('#invresa_subasta_id').val(object.subasta_id);
      $('#modal_pagar_inversa').modal("show");
      $("#modal_detalle").modal("hide");

   }


   $(function() {



      if (contador_directa == 0) {

         $('.mensaje_directa').show();
         //  $('.mensaje_inversa').hide();

      } else {
         $('#btn_subasta_directa_2').addClass('active');
         $('#btn_subasta_inversa_2').removeClass('active');
      }
      if (contador_inversa == 0) {

         // $('.mensaje_directa').hide();
         $('.mensaje_inversa').show();

      } else {
         $('#btn_subasta_directa_2').removeClass('active');
         $('#btn_subasta_inversa_2').addClass('active');
      }
   });

   function cambio_btn_directa_2() {
      $('.mensaje_directa').hide();
      $('.mensaje_inversa').hide();
      $('#btn_subasta_directa_2').addClass('active');
      $('#btn_subasta_inversa_2').removeClass('active');
      $(".tipo_directa").removeClass("active_subasta");
      $(".tipo_inversa").addClass("active_subasta");
      if (contador_directa == 0) {
         $('.mensaje_directa').show();
         $('.mensaje_inversa').hide();
      }


   }

   function cambio_btn_inversa_2() {
      $('.mensaje_directa').hide();
      $('.mensaje_inversa').hide();
      $('#btn_subasta_directa_2').removeClass('active');
      $('#btn_subasta_inversa_2').addClass('active');
      $(".tipo_inversa").removeClass("active_subasta");
      $(".tipo_directa").addClass("active_subasta");

      if (contador_inversa == 0) {
         $('.mensaje_directa').hide();
         $('.mensaje_inversa').show();
      }

   }
</script>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- Main Content Area End -->
<!-- Post Ad Sticky -->



</body>

<!-- Mirrored from templates.scriptsbundle.com/addforest/demos/adforest/site-map.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Aug 2019 00:19:51 GMT -->