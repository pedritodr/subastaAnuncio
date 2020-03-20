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
   <a onclick="login(1)" class="sticky-post-button hidden-xs">
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
<div style="overflow: scroll !important" class="quick-view-modal modalopen" id="modal_detalle" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg ad-modal">
      <button class="close close-btn popup-cls" aria-label="Close" data-dismiss="modal" type="button"> <i class="fa-times fa"></i> </button>
      <div class="modal-content single-product">
         <input id="detalle_subasta_id" type="hidden">
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
                              <span style="color:#fff" class="label label-success"><?= translate("valor_alto_lang"); ?> <h6 style="font-size:14px !important" id="valor_alto_modal" style="color:#fff"></h6></span>
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

                           <div style="margin-top:5% !important" id="body_entrar_subasta" class="col-md-12">
                              <button id="btn_entrar_subasta" onclick="" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>
                              <br>
                           </div>

                           <div style="margin-top:5% !important" id="body_pujar" class="col-md-12">

                              <button id="btn_pujar" onclick="" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>
                           </div>
                           <div style="margin-top:5% !important" style="display:none" id="body_comprar_inversa" class="col-md-12">
                              <button id="btn_comprar_inversa" onclick="" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("comprar_inversa_lang"); ?></button>
                           </div>

                        </div>
                     <?php } else { ?>

                        <div style="margin-top:5% !important" id="body_login_subasta_entrar" class="col-md-12">
                           <button id="btn_login_subasta" onclick="login(2)" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("login_lang"); ?></button>
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
            <div id="mensaje_piso" class="alert alert-danger alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_piso"></p>
            </div>
            <div id="mensaje_piso_2" class="alert alert-success alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_piso_2"></p>
            </div>
            <!-- content goes here -->
            <!--  <?php echo form_open_multipart("front/pagar_entrada") ?> -->
            <h5 style="font-size:22px !important" class="text-center" id="name_subasta"></h5>
            <h4 style="font-size:26px !important" id="descuento" class="text-center"></h4>
            <h4 style="font-size:26px !important" id="inicial" class="text-center"></h4>
            <input type="hidden" id='subasta_id' name="subasta_id">

            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btn_pagar_piso" type="button" onclick="pagar_piso()" class="btn btn-theme btn-block"><?= translate('pagar_lang') ?></button>
            </div>
            <!--   <?= form_close(); ?> -->
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
         <input name="valida_ads" id="valida_ads" type="hidden" value="1">
         <input name="subasta_id_login" id="subasta_id_login" type="hidden">
         <input name="subasta_login_frm" id="subasta_login_frm" type="hidden">
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
<div class="modal fade price-quote" id="modal_login_subasta" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("login_lang"); ?></h3>
         </div>
         <div class="modal-body">
            <div id="mensaje_login" class="alert alert-danger alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_login"></p>
            </div>
            <div id="mensaje_login_2" class="alert alert-success alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_login_2"></p>
            </div>
            <div class="form-group">
               <label><?= translate("email_lang"); ?></label>
               <input required placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" id="email_subasta">
            </div>
            <div class="form-group">
               <label><?= translate('password_lang'); ?></label>
               <input required placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" id="password_subasta">
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
               <button id="btn_login_subasta" type="button" onclick="login_aut()" class="btn  btn-success btn-block"><?= translate('entrar_lang'); ?></button>
            </div>

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
            <div id="mensaje_pujar" class="alert alert-danger alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_pujar"></p>
            </div>
            <div id="mensaje_pujar_2" class="alert alert-success alert-dismissable" style="display: none;">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p id="mensaje_error_pujar_2"></p>
            </div>
            <!-- content goes here -->
            <!--   <?php echo form_open_multipart("front/pujar") ?> -->
            <h4 class="text-center" id="name_subasta"></h4>
            <h4 class="text-center"><?= translate("valor_alto_lang"); ?> <span id="valor_puja" class="label label-success"></span></h4>
            <h6 class="text-center"> <span style="display:none" id="error_puja" class="label label-danger"><?= translate('error_valor_pujar_lang') ?></span></h6>
            <input type="hidden" id='subasta_user_id' name="subasta_user_id">
            <div class="clearfix"></div>
            <div class="form-group">
               <label for="valor"><?= translate("escriba_valor_lang"); ?></label>
               <input placeholder="<?= translate("escriba_valor_lang"); ?>" class="form-control" type="number" name="valor_pujando" id="valor_pujando">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button style="display:none" onclick="pagar_puja()" id="btn_pujando" type="button" class="btn btn-theme btn-block"><?= translate('pujar_lang') ?></button>
            </div>
            <!--     <?= form_close(); ?> -->
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
   let obj_subasta = null;
   let detalle_subasta_id = null;
   let user_id = "<?= $this->session->userdata('user_id') ?>";
   let session_subasta_id = null;
   let session_subasta = null;
   let input_valor = 0;

   //  console.log(subastas_2);
   $('#valor_pujando').change(function() {

      let valor_modal = $('#valor_pujando').val();
      if (valor_modal > input_valor) {

         $('#error_puja').hide();
         $('#btn_pujando').show();
      } else {
         $('#btn_pujando').hide();
         $('#error_puja').show();
      }
   });
   $(function() {
      session_subasta_id = "<?= $this->session->userdata('subasta_id') ?>";
      session_subasta = "<?= base64_encode(json_encode($this->session->userdata('subasta')))   ?>";

      if (session_subasta_id && session_subasta == "bnVsbA==") {
         <?php $this->session->set_userdata('subasta_id', null) ?>
         cargarmodal_subasta(session_subasta_id, "");

      }
      if (session_subasta_id && session_subasta != "bnVsbA==") {
         <?php $this->session->set_userdata('subasta_id', null) ?>
         <?php $this->session->set_userdata('subasta', null) ?>
         cargarmodal_subasta(session_subasta_id, session_subasta);

      }

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

   function login_aut() {
      let email = $('#email_subasta').val();
      let pass = $('#password_subasta').val();
      $.ajax({
         type: 'POST',
         url: "<?= site_url('login/auth_ajax') ?>",

         data: {
            email: email,
            password: pass
         },
         success: function(result) {
            result = JSON.parse(result);
            // console.log(result);
            if (result.status == 500) {
               let message = "<?= translate('autenticacion_lang') ?>";
               $('#mensaje_error_login').text(message);
               $('#mensaje_login').show();
               setTimeout(() => {
                  $('#mensaje_login').fadeOut(2000)
               }, 5000);

            } else if (result.status == 200) {
               $('#btn_login_subasta').prop('disabled', true);
               $('#email_subasta').prop('disabled', true);
               $('#password_subasta').prop('disabled', true);
               let message = "<?= translate('sesion_lang') ?>";
               $('#mensaje_error_login_2').text(message);
               $('#mensaje_login_2').show();
               setTimeout(() => {
                  cargarmodal_subasta(subasta_id, obj_subasta);
               }, 2500);
            }

         }
      });
   }

   function login(dir) {
      if (dir == 2) {
         $('#valida_ads').val(0);
         $('#subasta_login_frm').val(JSON.stringify(obj_subasta));
         $('#subasta_id_login').val(detalle_subasta_id);
         $("#modal_detalle").modal("hide");
         $('#modal_login').modal('show');

      } else if (dir == 1) {
         $('#valida_ads').val(1);
         $('#modal_login').modal('show');
      }
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
      let qty_subastas = '<?= $this->session->userdata('qty_subastas') ?>';
      let descuento = '<?= $this->session->userdata('descuento') ?>';
      let membresia_id = '<?= $this->session->userdata('membresia_id') ?>';
      descuento = parseFloat(descuento) / 100;
      qty_subastas = parseInt(qty_subastas);

      if (membresia_id != "") {
         if (qty_subastas > 0) {
            $('#inicial').html("<span class='label label-primary'>$0.00</span>");
            $('#descuento').html('Antes <span  class="label label-success strikethrough">$' + parseFloat(precio).toFixed(2) + ' </span>');
         } else {
            precio = parseFloat(precio);
            let total = precio - (precio * (1 * descuento));
            $('#inicial').html("Total a pagar <span class='label label-primary'>$" + parseFloat(total).toFixed(2) + "</span>");
            $('#descuento').html('Antes <span  class="label label-success strikethrough">$' + parseFloat(precio).toFixed(2) + ' </span>');

         }

      } else {
         $('#inicial').html("Total a pagar <span class='label label-primary'>$" + parseFloat(precio).toFixed(2) + "</span>");
      }

      $('#subasta_id').val(id);
      $('#name_subasta').text(nombre);
      $("#modal_entrar").modal("show");
      $("#modal_detalle").modal("hide");
   }

   function cargarmodal_pujar(id, nombre, precio, valor_inicial) {

      // var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#subasta_user_id').val(id);
      $('#name_subasta').text(nombre);

      if (precio == "null") {
         input_valor = parseFloat(valor_inicial);

         $('#valor_pujando').val(valor_inicial);
         $('#valor_puja').text("$" + parseFloat(valor_inicial).toFixed(2));
      } else {
         input_valor = parseFloat(precio);
         $('#valor_pujando').val(precio);
         $('#valor_puja').text("$" + parseFloat(precio).toFixed(2));
      }
      $("#modal_pujar").modal("show");
      $("#modal_detalle").modal("hide");
   }

   function cargarmodal_subasta(id, object) {
      detalle_subasta_id = id;
      $('#detalle_subasta_id').val(id);
      if (object != "") {
         object = atob(object);
         object = JSON.parse(object);
         obj_subasta = object;
      }
      /*  if (obj_subasta_directa) {
          object = $obj_subasta;
       } */

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
                  if (object.intervalo) {
                     var count_intervalo = object.intervalo.length;
                     if (count_intervalo >= 2) {

                        $('#precio').html("<b class='strikethrough' style='font-size:16px !important; color:#2a3681 !important'>$" + parseFloat(object.intervalo[count_intervalo - 2].valor).toFixed(2) + "</b> $" + parseFloat(object.intervalo[count_intervalo - 1].valor).toFixed(2));
                     } else {
                        $('#precio').html("$" + parseFloat(object.intervalo[count_intervalo - 1].valor).toFixed(2));

                     }
                     $('#fecha_cierre').text(object.intervalo[count_intervalo - 1].fecha);
                     $('#btn_comprar_inversa').attr("onclick", "pagar_subasta_inversa('" + btoa(JSON.stringify(object)) + "')");
                  } else {
                     $('#btn_comprar_inversa').hide();
                     $('#precio').html("$" + parseFloat(object.costo).toFixed(2));
                     $('#fecha_cierre').text(object.fecha_cierre);
                  }

                  $('#galeria_main').html(cadena_1);
                  $('.carousel-indicators').html(cadena_2);

                  $('#titulo').text(result.all_detalle.nombre_espa);
                  $('#descripcion').html(result.all_detalle.descrip_espa);
                  $('#body_valor_alto').hide();
                  $('#li_valor_entrada').hide();
                  $('#body_comprar_inversa').show();
                  $('#body_entrar_subasta').hide();
                  $('#body_cronometro').hide();



               }

            }
         });
      } else {

         if (user_id == "") {
            $('#body_login_subasta_entrar').show();

         } else {
            $('#body_login_subasta_entrar').hide();
         }
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
                  $('#body_comprar_inversa').hide();
                  $('#galeria_main').html(cadena_1);
                  $('.carousel-indicators').html(cadena_2);
                  $('#precio').text("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                  $('#titulo').text(result.all_detalle.nombre_espa);
                  $('#descripcion').html(result.all_detalle.descrip_espa);
                  $('#valor_entrada').text("$" + parseFloat(result.all_detalle.valor_pago).toFixed(2));
                  $('#fecha_cierre').text(result.all_detalle.fecha_cierre);
                  if (result.puja.valor != null) {
                     $("#valor_alto_modal").html("<i class='fa fa-user-o'></i> " + result.user_win.name + " $" + parseFloat(result.puja.valor).toFixed(2));
                  }

                  if (result.subasta_user && result.puja.valor == null) {
                     $('#valor_alto_modal').html("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                  }
                  if (result.subasta_user == null && result.puja.valor == null) {
                     $('#body_valor_alto').hide();
                  }


                  if (user_id != "") {
                     if (result.subasta_user == null && user_id) {
                        $("#body_entrar_subasta").show();
                        $("#btn_entrar_subasta").attr('onclick', 'cargarmodal_entrar("' + result.all_detalle.subasta_id + '","' + result.all_detalle.nombre_espa + '","' + result.all_detalle.valor_pago + '")');

                     } else {
                        if (result.puja_user.valor == null) {
                           $("#body_pujar").show();
                           $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                        } else {
                           if (parseFloat(result.puja_user.valor) < parseFloat(result.puja.valor)) {
                              $("#body_pujar").show();
                              $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                           }
                        }


                     }
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

   function pagar_piso() {
      let subasta_id = $('#subasta_id').val();
      $('#btn_pagar_piso').prop('disabled', true);
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/pagar_entrada_ajax') ?>",

         data: {
            subasta_id: subasta_id,
         },
         success: function(result) {
            result = JSON.parse(result);
            // console.log(result);
            if (result.status == 500) {
               let message = "<?= translate('piso_error') ?>";
               $('#mensaje_error_piso').text(message);
               $('#mensaje_piso').show();
               $('#btn_pagar_piso').prop('disabled', false);
               setTimeout(() => {
                  $('#mensaje_piso').fadeOut(2000)
               }, 3000);

            } else if (result.status == 200) {

               let message = "<?= translate('piso_pagado_lang') ?>";
               $('#mensaje_error_piso_2').text(message);
               $('#mensaje_piso_2').show();
               $('#btn_pagar_piso').prop('disabled', true);
               $('#btn_entrar_subasta_' + subasta_id).hide();
               setTimeout(() => {
                  $('#modal_entrar').modal('hide');
                  cargarmodal_subasta(subasta_id, "");
               }, 2500);
            }

         }
      });
   }

   function pagar_puja() {
      let subasta_user_id = $('#subasta_user_id').val();
      let valor_pujando = $('#valor_pujando').val();
      $('#btn_pujando').prop('disabled', true);
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/pujar_ajax   ') ?>",

         data: {
            subasta_user_id: subasta_user_id,
            valor_pujando: valor_pujando
         },
         success: function(result) {
            result = JSON.parse(result);
            // console.log(result);
            if (result.status == 500) {
               let message = "<?= translate('error_valor_pujar_lang') ?>";
               $('#mensaje_error_pujar').text(message);
               $('#mensaje_pujar').show();
               $('#btn_pujando').prop('disabled', false);
               setTimeout(() => {
                  $('#mensaje_pujar').fadeOut(2000)
               }, 3000);

            } else if (result.status == 200) {

               let message = "<?= translate('pujar_valor_lang') ?>";
               $('#mensaje_error_pujar_2').text(message);
               $('#mensaje_pujar_2').show();
               $('#btn_pujando').prop('disabled', true);
               $('#btn_pujar_subasta_' + result.subasta_id).hide();
               setTimeout(() => {
                  $('#modal_pujar').modal('hide');
                  cargarmodal_subasta(result.subasta_id, "");
               }, 2500);
            }

         }
      });
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
   let y = setInterval(function() {

      if ($('#modal_detalle').hasClass('in')) {

         let subasta_id = $('#detalle_subasta_id').val();

         if (subasta_id > 0) {
            console.log(":entro");
            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/detalle_subasta') ?>",

               data: {
                  id: subasta_id
               },
               success: function(result) {
                  result = JSON.parse(result);
                  if (result) {

                     if (result.tipo_subasta == 1) {
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
                              $('#day-' + subasta_id).html(days);
                              $('#hour-' + subasta_id).html(hours);
                              $('#minute-' + subasta_id).html(minutes);
                              $('#second-' + subasta_id).html(seconds);

                              if (t < 0) {

                                 clearInterval(x);

                                 $('#day-' + subasta_id).html(0);
                                 $('#hour-' + subasta_id).html(0);
                                 $('#minute-' + subasta_id).html(0);
                                 $('#second-' + subasta_id).html(0);

                              }

                           }, 1000);
                        } else {

                           $('#day-' + subasta_id).html(0);
                           $('#hour-' + subasta_id).html(0);
                           $('#minute-' + subasta_id).html(0);
                           $('#second-' + subasta_id).html(0);
                        }
                        if (result.puja.valor != null) {
                           $("#valor_alto_modal").html("<i class='fa fa-user-o'></i> " + result.user_win.name + " $" + parseFloat(result.puja.valor).toFixed(2));
                        }
                        if (result.subasta_user && result.puja.valor == null) {
                           $('#valor_alto_modal').html("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                        }

                        if (user_id != "") {
                           if (result.subasta_user == null && user_id) {
                              $("#body_entrar_subasta").show();
                              $("#btn_entrar_subasta").attr('onclick', 'cargarmodal_entrar("' + result.all_detalle.subasta_id + '","' + result.all_detalle.nombre_espa + '","' + result.all_detalle.valor_pago + '")');

                           } else {
                              if (result.puja_user.valor == null) {
                                 $("#body_pujar").show();
                                 $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                              } else {
                                 if (parseFloat(result.puja_user.valor) < parseFloat(result.puja.valor)) {
                                    $("#body_pujar").show();
                                    $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                                 }
                              }

                           }
                        }
                     }


                  }

               }
            });
         }

      }
      if (user_id != "") {
         console.log(":entro subastas");
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/subasta_directas_ajax') ?>",

            data: {
               id: 0
            },
            success: function(result) {
               result = JSON.parse(result);
               if (result) {
                  console.log(result);
                  for (let i = 0; i < result.length; i++) {
                     if (result[i].puja.valor == "null") {
                        $('#valor_inicial_subasta_' + result[i].subasta_id).html("$" + parseFloat(result[i].valor_inicial).toFixed(2));
                     } else {
                        if (result[i].user_win) {

                           let name_win = result[i].user_win.name;
                           $('#valor_inicial_subasta_' + result[i].subasta_id).html("<i class='fa fa-user-o'></i> " + name_win + " $" + parseFloat(result[i].puja.valor).toFixed(2));
                        }

                     }

                     if (result[i].puja.valor != "null") {
                        if (result[i].puja_user.valor == "null") {
                           //$("#btn_pujar_subasta_" + result[i].subasta_id).remove();
                           // $('#body_btn_pujar_' + result[i].subasta_id).empty();
                           //$('#body_btn_pujar_' + result[i].subasta_id).show(); $('#body_btn_pujar_' + result[i].subasta_id).html("<button id='btn_pujar_subasta_" + result[i].subasta_id + "' onclick='' class='btn btn-block btn-success'><i class='fa fa-hand-paper-o'></i > <?= translate('pujar_lang'); ?> < /button>");
                           //  $("#btn_pujar_subasta_" + result[i].subasta_id).attr('onclick', 'cargarmodal_pujar("' + result[i].subasta_user.subasta_user_id + '","' + result[i].nombre_espa + '","' + result[i].puja.valor + '","' + result[i].valor_inicial + '")');
                           $('#btn_pujar_subasta_' + result[i].subasta_id).show();
                        } else {
                           $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                        }
                        if (parseFloat(result[i].puja_user.valor) < parseFloat(result[i].puja.valor)) {
                           //$("#btn_pujar_subasta_" + result[i].subasta_id).remove();
                           //$('#body_btn_pujar_' + result[i].subasta_id).empty();
                           // $('#body_btn_pujar_' + result[i].subasta_id).html("<button id='btn_pujar_subasta_" + result[i].subasta_id + "' onclick='' class='btn btn-block btn-success'><i class='fa fa-hand-paper-o'></i> <?= translate('pujar_lang'); ?></button>");
                           //$("#btn_pujar_subasta_" + result.subasta_id).attr('onclick', 'cargarmodal_pujar("' + result[i].subasta_user.subasta_user_id + '","' + result[i].nombre_espa + '","' + result[i].puja.valor + '","' + result[i].valor_inicial + '")');
                           $('#btn_pujar_subasta_' + result[i].subasta_id).show();
                        } else {

                           $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                        }
                     }


                  }


               }

            }
         });
      }

      /* if ($('.faq-a').is(':visible')) {
          $.ajax({
              type: 'POST',
              url: "<?= site_url('front/solicitudes_ajax') ?>",
              timeout: 4000,
              success: function(result) {

                  if (result) {
                      result = JSON.parse(result);

                      if (result.length > 0) {
                          for (var i = 0; i < result.length; i++) {
                              $('#estado_solicitud_' + result[i].solicitud_id).removeClass("label-danger");
                              $('#estado_solicitud_' + result[i].solicitud_id).text("");
                              if (result[i].estado_solicitud == 0) {

                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-warning");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text("En revisión");

                              } else if (result[i].estado_solicitud == 1) {

                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-danger");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text("En espera");

                              } else if (result[i].estado_solicitud == 2 && result[i].pago != null) {
                                  $('#llamar_calificacion_' + result[i].solicitud_id).remove();
                                  $('#salto_label' + result[i].solicitud_id).remove();
                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-success");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text(" Culminada ");
                                  $('#estado_solicitud_' + result[i].solicitud_id).after("<br id='salto_label" + result[i].solicitud_id + "'><button id='llamar_calificacion_" + result[i].solicitud_id + "' data-toggle='modal' data-target='#myCalificacion' class='col-sm-12 col-xs-12 col-lg-4 col-md-4 btn btn-warning'><i class='fa fa-star'></i> <?= translate('calificar_lang'); ?></button>");
                                  $('#llamar_calificacion_' + result[i].solicitud_id).attr('onclick', 'cargar_calificacion("' + result[i].solicitud_id + '")');
                                  $('#cancelar_solicitud_' + result[i].solicitud_id).hide();
                              } else if (result[i].estado_solicitud == 3) {
                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-danger");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text("Cancelada");
                              } else if (result[i].estado_solicitud == 4) {
                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-danger");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text("Sin técnico");
                              } else if (result[i].estado_solicitud == 5) {
                                  $('#estado_solicitud_' + result[i].solicitud_id).addClass("label-danger");
                                  $('#estado_solicitud_' + result[i].solicitud_id).text("En visita");
                              }

                              if (result[i].tecnicos.length > 0) {
                                  for (var j = 0; j < result[i].tecnicos.length; j++) {
                                      $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("");

                                      if (result[i].tecnicos[j].estado_tecnico == 0) {

                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-warning");
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("En revisión");

                                      } else if (result[i].tecnicos[j].estado_tecnico == 3) {
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-danger");
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("Visita");
                                      } else if (result[i].tecnicos[j].estado_tecnico == 1) {
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-danger");
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("Cotizada");
                                      } else if (result[i].tecnicos[j].estado_tecnico == 6) {
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-success");
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("Culminada");
                                      } else if (result[i].estado_solicitud == 0 && result[i].tecnicos[j].estado_tecnico == 3 && result[i].tecnicos[j].precio > 0) {
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-danger");
                                          $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("Cotizada");
                                          $('#botones_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).show();
                                      }
                                      if (result[i].estado_solicitud == 5 && result[i].tecnicos[j].estado_tecnico == 3 && result[i].tecnicos[j].precio > 0) {

                                          $('#botones_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).show();
                                          $('#cotiza_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("$ " + result[i].tecnicos[j].precio);
                                      }
                                      if (result[i].estado_solicitud == 0 && result[i].tecnicos[j].estado_tecnico == 1 && result[i].tecnicos[j].precio > 0) {

                                          $('#botones_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).show();
                                          $('#cotiza_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("$ " + result[i].tecnicos[j].precio);
                                      }
                                      if (result[i].estado_solicitud == 1 && result[i].tecnicos[j].estado_tecnico == 3 && result[i].monto_final > 0) {

                                          if (result[i].pago.length <= 0) {
                                              $('#botones_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).hide();
                                              $('#pago_' + result[i].solicitud_id).remove();
                                              $('#pago2_' + result[i].solicitud_id).remove();
                                              $('#salto1_' + result[i].solicitud_id).remove();
                                              $('#salto2_' + result[i].solicitud_id).remove();
                                              $('#cancelar_solicitud_' + result[i].solicitud_id).after("<br id='salto1_" + result[i].solicitud_id + "'><br id='salto2_" + result[i].solicitud_id + "'><button id='pago2_" + result[i].solicitud_id + "' data-toggle='modal' data-target='#myModal5' class='col-sm-12 col-xs-12 col-lg-4 col-md-4 btn btn-success'><i class='fa fa-credit-card-alt' aria-hidden='true'></i> Pagar</button>");
                                              $('#pago2_' + result[i].solicitud_id).attr('onclick', 'cargar_pago("' + result[i].solicitud_id + '","' + result[i].tecnicos[j].tecnico_id + '","' + result[i].monto_final + '")');
                                          }
                                      }
                                      if (result[i].estado_solicitud == 1) {
                                          $.ajax({
                                              type: 'POST',
                                              url: "<?= site_url('front/solicitudes_tecnico_rechazado_ajax') ?>",
                                              timeout: 4000,
                                              data: {
                                                  user: user
                                              },
                                              success: function(result) {
                                                  result = JSON.parse(result);

                                                  if (result.length > 0) {

                                                      for (var i = 0; i < result.length; i++) {

                                                          if (result[i].tecnicos.length > 0) {
                                                              for (var j = 0; j < result[i].tecnicos.length; j++) {
                                                                  if (result[i].estado_solicitud == 1 && result[i].tecnicos[j].estado_tecnico == 4) {
                                                                      $('#botones_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).hide();
                                                                      $('#aceptar_visita_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).remove();
                                                                  }
                                                              }

                                                          }
                                                      }

                                                  }
                                              }
                                          });

                                      }


                                      if (result[i].tecnicos[j].visita != null) {

                                          if (result[i].tecnicos[j].visita.estado_visita == 0) {
                                              $('#aceptar_visita_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).remove();
                                              $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).addClass("label-danger");
                                              $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).text("Visita solicitda");
                                              $('#estado_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).after("<a id='aceptar_visita_" + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id + "' class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal2' href='#'><i class='fa fa-car'></i> Aceptar visita</a>");
                                              $('#aceptar_visita_' + result[i].tecnicos[j].tecnico_id + result[i].tecnicos[j].solicitud_id).attr('onclick', 'cargar_modal_visita("' + result[i].tecnicos[j].solicitud_id + '","' + result[i].tecnicos[j].tecnico_id + '","' + result[i].inicio + '","' + result[i].fin + '","' + result[i].fecha + '","' + result[i].tecnicos[j].visita.visita_id + '")');
                                          }

                                      }

                                      var extras = 0;
                                      var pagos = 0;
                                      var total_pagar = 0;
                                      if (result[i].extras.length > 0) {


                                          $('#titulo_extra_' + result[i].solicitud_id).show();
                                          for (let m = 0; m < result[i].extras.length; m++) {
                                              $('#extra_' + result[i].extras[m].servicio_extra_id).remove();

                                          }

                                          for (let k = 0; k < result[i].extras.length; k++) {

                                              $('#titulo_extra_' + result[i].solicitud_id).after("<p id='extra_" + result[i].extras[k].servicio_extra_id + "' class='col-lg-12 col-sm-12 col-xs-12 col-md-12'><i class='fa fa-plus'></i>" + result[i].extras[k].descripcion + "<strong style='color: #f8b604;'> $" + parseFloat(result[i].extras[k].precio).toFixed(2) + "</strong></p>")
                                              var suma = parseFloat(extras) + parseFloat(result[i].extras[k].precio);
                                              extras = +suma;

                                          }
                                          total_pagar = extras + parseFloat(result[i].monto_final);
                                          $('#total_full_' + result[i].solicitud_id).show();
                                          $('#total_full_' + result[i].solicitud_id).html("<strong>Total: </strong><strong style='color: #f8b604;'> $" + total_pagar.toFixed(2) + "</strong>");
                                          if (result[i].pago.length > 0) {

                                              for (let h = 0; h < result[i].pago.length; h++) {
                                                  var pg = parseFloat(pagos) + parseFloat(result[i].pago[h].monto_pagado);
                                                  pagos = +pg;

                                              }
                                          }
                                          var resultado = total_pagar - pagos;

                                          if (resultado > 0 && pagos > 0) {

                                              $('#pago_' + result[i].solicitud_id).remove();
                                              $('#pago2_' + result[i].solicitud_id).remove();
                                              $('#salto1_' + result[i].solicitud_id).remove();
                                              $('#salto2_' + result[i].solicitud_id).remove();
                                              $('#cancelar_solicitud_' + result[i].solicitud_id).after("<br id='salto1_" + result[i].solicitud_id + "'><br id='salto2_" + result[i].solicitud_id + "'><button id='pago2_" + result[i].solicitud_id + "' data-toggle='modal' data-target='#myModal5' class='col-sm-12 col-xs-12 col-lg-4 col-md-4 btn btn-success'><i class='fa fa-credit-card-alt' aria-hidden='true'></i> Pagar</button>");
                                              $('#pago2_' + result[i].solicitud_id).attr('onclick', 'cargar_pago("' + result[i].solicitud_id + '","' + result[i].tecnicos[j].tecnico_id + '","' + resultado + '")');

                                          }
                                          if (resultado > 0 && pagos == 0) {

                                              $('#pago_' + result[i].solicitud_id).remove();
                                              $('#pago2_' + result[i].solicitud_id).remove();
                                              $('#salto1_' + result[i].solicitud_id).remove();
                                              $('#salto2_' + result[i].solicitud_id).remove();
                                              $('#cancelar_solicitud_' + result[i].solicitud_id).after("<br id='salto1_" + result[i].solicitud_id + "'><br id='salto2_" + result[i].solicitud_id + "'><button id='pago2_" + result[i].solicitud_id + "' data-toggle='modal' data-target='#myModal5' class='col-sm-12 col-xs-12 col-lg-4 col-md-4 btn btn-success'><i class='fa fa-credit-card-alt' aria-hidden='true'></i> Pagar</button>");
                                              $('#pago2_' + result[i].solicitud_id).attr('onclick', 'cargar_pago("' + result[i].solicitud_id + '","' + result[i].tecnicos[j].tecnico_id + '","' + resultado + '")');
                                          }

                                      }



                                  }
                              }

                          }
                      }
                  }
              }

          });
      } */


      /* if ($('#myChat').is(':visible')) {
          $.ajax({
              type: 'POST',
              url: "<?= site_url('front/update_estado') ?>",
              timeout: 4000,
              data: {
                  solicitud_id: solicitud_id,
                  tecnico_id: tecnico_id

              },
              success: function(result) {

                  if (result) {
                      result = JSON.parse(result);
                  }

              }

          });
      } */


   }, 6000);
</script>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- Main Content Area End -->
<!-- Post Ad Sticky -->



</body>

<!-- Mirrored from templates.scriptsbundle.com/addforest/demos/adforest/site-map.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Aug 2019 00:19:51 GMT -->