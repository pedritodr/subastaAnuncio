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
                           <div style="display:none" class="row">
                              <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                                 <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
                              </div>
                              <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                                 <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
                              </div>
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                                 <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt="">
                              </div>
                           </div>
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
                           <?php if ($empresa_object->email) { ?>
                              <li style="color:#fff"><span style="color:#fff" class="icon fa fa-envelope-o footer-hover"></span> <a style="color:#fff !important" href="<?= $empresa_object->email ?>"><?= $empresa_object->email ?></a></li>

                           <?php } ?>
                           <li style="color:#fff"><span style="color:#fff" class="icon fa fa-shield footer-hover"></span><a style="color:#fff !important" href="<?= site_url('politicas-de-privacidad') ?>"><?= translate('politicas_lang') ?></a></li>
                           <li style="color:#fff"><span style="color:#fff" class="icon fa fa-check footer-hover"></span><a style="color:#fff !important" href="<?= site_url('condiciones-de-uso') ?>"><?= translate('condiciones_lang') ?></a></li>
                           <li style="color:#fff"><span style="color:#fff" class="icon fa fa-sticky-note-o footer-hover"></span> <a style="color:#fff !important" href="<?= site_url('aviso-legal') ?>"><?= translate('aviso_legal_lang') ?></a></li>

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
                  <h3 class="text-center"><strong>Costo:</strong> $7.00</h3>
                  <input type="hidden" id='anuncio_id_destacar'>
                  <input type="hidden" id='anuncio_detalle_destacar'>
                  <div id="dropzone" class="dropzone"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                  <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
               </div>
               <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                  <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
               </div>
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                  <a href="https://www.placetopay.com"> <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt=""></a>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transaccion_pendiente">


               </div>
               <div id="body_condiciones_destacar" class="col-lg-12">
                  <div class="form-group">
                     <label style="margin-left: 25%" class="text-center">
                        <input style="margin-top: 5%;" required id="condiciones_destacar" type="checkbox"> <a href="<?= site_url('condiciones-de-uso') ?>" target="_blank">ACEPTO LAS CONDICIONES DE USO.</a>
                     </label>
                  </div>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noficacion_error">


               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btn_destacar" type="button" onclick="pagar_destacar()" class="btn btn-theme btn-block"><?= translate('featured_ads_lang') ?></button>

            </div>

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
            <div class="col-lg-6 col-sm-6 col-xs-12">
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

            <div class=" col-sm-6 col-lg-6 col-xs-12">
               <div class="summary entry-summary">
                  <div class="ad-preview-details">

                     <a href="#">
                        <h4 id="titulo"></h4>
                     </a>
                     <div class="overview-price">
                        <div class="row">
                           <div class="col-md-4">
                              <span style="margin-top:5px">
                                 <h5 style="font-size:14px !important"><?= translate('precios_lang') ?> inicial</h5>
                                 <h5 style="font-size:14px !important" id="precio"> </h5>
                              </span>
                           </div>
                           <div id="body_valor_alto" class="col-md-8">
                              <span style="color:#fff" class="label label-success"><?= translate("valor_alto_lang"); ?> <h6 style="font-size:14px !important" id="valor_alto_modal" style="color:#fff"></h6></span>
                           </div>
                        </div>


                     </div>
                     <div class="overview-price"></div>

                     <h6><strong><?= translate('descripcion_lang') ?></strong></h6>
                     <p style="font-size:10px !important" id="descripcion"></p>

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
                        <div class="row" id="btn_modal_detalle_subasta">

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
                        <div style="margin-top:5% !important" style="display:none" id="body_comprar_inversa" class="col-md-12">
                           <button id="btn_comprar_inversa" onclick="" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("comprar_inversa_lang"); ?></button>
                        </div>
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
            <div class="row">
               <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                  <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
               </div>
               <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                  <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
               </div>
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                  <a href="https://www.placetopay.com"> <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt=""></a>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transaccion_pendiente">


               </div>
               <div id="body_condiciones_piso" class="col-lg-12">
                  <div class="form-group">
                     <label style="margin-left: 25%" class="text-center">
                        <input style="margin-top: 5%;" required id="condiciones_piso" type="checkbox"> <a href="<?= site_url('condiciones-de-uso') ?>" target="_blank">ACEPTO LAS CONDICIONES DE USO.</a>
                     </label>
                  </div>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noficacion_error">


               </div>
            </div>

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

            <h5 class="text-center" id="name_subasta_inversa"></h5>
            <h4 id="valor_inversa" class="text-center"></h4>
            <input type="hidden" id='pagar_valor_inversa'>
            <input type="hidden" id='invresa_subasta_id'>
            <div class="row">
               <!--    <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                  <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
               </div>
               <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                  <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
               </div>
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                  <a href="https://www.placetopay.com"> <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt=""></a>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transaccion_pendiente">


               </div> -->
               <div id="formClienteSubastaInversa" style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <!--  Form -->
                  <div class="form-grid">
                     <form>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= translate("primer_nombre_lang"); ?></label>
                                 <input required placeholder="Ej. Jesus" class="form-control input-text" type="text" id="nameInversa">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= translate("primer_apellido_lang"); ?></label>
                                 <input required placeholder="Ej. Perez" class="form-control input-text" type="text" id="surnameInversa">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= translate("email_lang"); ?></label>
                                 <input placeholder="Ej. info@subastanuncio.com" class="form-control" type="email" id="emailInversa" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= translate("phone_user__lang"); ?></label>
                                 <input placeholder="Ej. 986547800" class="form-control input-number" type="number" id="phoneInversa" required>
                              </div>
                           </div>

                        </div>
                     </form>
                  </div>
                  <!-- Form -->

               </div>
               <div id="body_condiciones_inversa" class="col-lg-12">
                  <div class="form-group">
                     <label style="margin-left: 25%" class="text-center">
                        <input style="margin-top: 5%;" required id="condiciones_inversa" type="checkbox"> <a href="<?= site_url('condiciones-de-uso') ?>" target="_blank">ACEPTO LAS CONDICIONES DE USO.</a>
                     </label>
                  </div>
               </div>
               <!--    <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noficacion_error">


               </div> -->
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btn_pagar_inversa" type="button" onclick="pagar_inversa()" class="btn btn-theme btn-block">Lo quiero</button>
            </div>

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
               <button style="display:none" onclick="pagar_puja()" id="btn_pujando_modal" type="button" class="btn btn-theme btn-block"><?= translate('pujar_lang') ?></button>
            </div>
            <!--     <?= form_close(); ?> -->
         </div>
      </div>
   </div>
</div>
<div class="modal fade price-quote" id="modal_saludar" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("hola_lang"); ?></h3>
         </div>
         <div class="modal-body">

            <!-- content goes here -->
            <?php if ($this->session->userdata('user_id')) { ?>
               <h6 class="text-center"><?= $this->session->userdata('name') ?></h6>
            <?php } ?>
            <p class="text-center"><?= translate("msg_hola_lang"); ?></p>


         </div>
      </div>
   </div>
</div>
<div class="modal fade price-quote" id="modal_error_ciudad" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("mensaje_lang"); ?></h3>
         </div>
         <div class="modal-body">

            <p id="error_ubicacion" class="text-center"></p>


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
         <!--   <?php echo form_open_multipart("front/pagar_membresia") ?> -->
         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">

               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <h3 class="text-center" id="nombre_membresia"></h3>
                  <h4 class="text-center" id="precio_membresia"></h4>
                  <input name="membresia_id" id="membresia_id" type="hidden" value="">
                  <input id="cod_secret" class="btn btn-primary" type="hidden" value="">
               </div>
               <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                  <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
               </div>
               <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                  <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
               </div>
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                  <a href="https://www.placetopay.com"> <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt=""></a>
               </div>


               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transaccion_pendiente">


               </div>

               <div id="body_condiciones_membresia" class="col-lg-12">
                  <div class="form-group">
                     <label style="margin-left: 25%" class="text-center">
                        <input style="margin-top: 5%;" required id="condiciones_membresia" type="checkbox"> <a href="<?= site_url('condiciones-de-uso') ?>" target="_blank">ACEPTO LAS CONDICIONES DE USO.</a>
                     </label>
                  </div>
               </div>
               <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noficacion_error">


               </div>

            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button style="border-color: #2a3681;" id="btn_modal_membresia" onclick="payment()" type="button" class="btn btn-theme btn-block"><?= translate('pagar_lang'); ?></button>
               <button type="button" class="btn btn-dark btn-block" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>

            </div>
            <!--       <?= form_close(); ?> -->
         </div>
      </div>
   </div>
</div>
<div id="modalPaymentBilletera" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel">Pago con billetera</h3>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <h3 class="text-center" id="nameMembresia"></h3>
                  <h4 class="text-center" id="priceMembresia"></h4>
                  <h4 class="text-center" id="saldoWalletMembresia"></h4>
                  <input id="membresiaId" type="hidden" value="">
                  <input id="priceMembre" type="hidden" value="">
               </div>
            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">
               <button id="btnPaymentWallet" style="border-color: #2a3681;" onclick="paymentWallet()" type="button" class="btn btn-success btn-block"><?= translate('pagar_lang'); ?></button>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="modal_notificacion" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title text-center" id="lineModalLabel"><?= "Notificación" ?></h3>
         </div>

         <div class="modal-body">
            <!-- content goes here =-->

            <div class="row">
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <h2 style="color:#008f39 " class="text-center" id="icono_notificacion"></h2>
                  <h4 class="text-center" id="status_notificacion"></h4>
                  <p class="text-center" id="referencia_notificacion"></p>
                  <p class="text-center" id="mensaje_notificacion"></p>
                  <p class="text-center" id="product_adquirido"></p>

               </div>
               <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                  <img src="<?= base_url('assets/logos_EC.png') ?>" alt="">
               </div>
               <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                  <img style="width:62%; margin-left:-62%;" src="<?= base_url('assets/mastercard.png') ?>" alt="">
               </div>
               <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center">
                  <a href="https://www.placetopay.com"> <img style="width: 33%" src="<?= base_url('assets/Logo_PlacetoPay.png') ?>" alt=""></a>
               </div>

            </div>
            <div class="col-md-12 margin-bottom-20 margin-top-20">

               <button type="button" class="btn btn-dark btn-block" data-dismiss="modal"><?= translate('cerrar_lang'); ?></button>

            </div>

         </div>
      </div>
   </div>
</div>
<?php
$load = false;
$localhost = $_SERVER['REQUEST_URI'];
$url_request =  "/perfil";
$pos = strpos($localhost, $url_request);
if ($pos === false) {
   $load = true;
} ?>
<?php if ($load) { ?>
   <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
   <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
<?php } ?>

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
<script src="https://secure.placetopay.ec/redirection/lightbox.min.js"></script>
<!-- MasterSlider -->
<script src="<?= base_url('assets_front/js/masterslider/masterslider.min.js') ?>"></script>
<?php if (isset($wallet)) {
   if (!$wallet) {
      $wallet = null;
   }
} else {
   $wallet = null;
}
?>
<script type="text/javascript">
   let wallet = <?= json_encode($wallet) ?>;
   const encodeB64Utf8 = (str) => {
      return btoa(unescape(encodeURIComponent(str)));
   }

   const decodeB64Utf8 = (str) => {
         return decodeURIComponent(escape(atob(str)));
      }
      (function($) {
         "use strict";
         var slider = new MasterSlider();

         // adds Arrows navigation control to the slider.
         slider.control('arrows');
         slider.control('timebar', {
            insertTo: '#masterslider'
         });
         slider.control('bullets');

         slider.setup('masterslider', {
            width: 1919, // slider standard width
            height: 500, // slider standard height
            space: 1,
            layout: 'fullwidth',
            loop: true,
            preload: 0,
            instantStartLayers: true,
            autoplay: true,
            autoHeight: false
         });
      })(jQuery);
   $('#btn_modal_membresia').click(function() {
      if ($('#condiciones_membresia').prop('checked') == true) {
         $('#btn_modal_membresia').hide();
         $('#modal_membresia_gratis').modal('hide');
      }
   });
   let contador_directa = 0;
   let vacio = null;
   let contador_inversa = 0;
   let obj_subasta = null;
   let detalle_subasta_id = null;
   let user_id = "<?= $this->session->userdata('user_id') ?>";
   let session_subasta_id = null;
   let session_subasta = null;
   let input_valor = 0;
   let membresia_seleccionada = null;

   function payment() {
      $(".btn-theme").css("background-color", "#8c1822");
      $(".btn-theme").css("color", "#fff");
      membresia_seleccionada = $('#membresia_id').val();
      nombre_membresia = $('#nombre_membresia').text();
      valor_membresia = $('#precio_membresia').text();
      if ($('#condiciones_membresia').prop('checked') == true) {
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/checkout') ?>",
            data: {
               monto: valor_membresia,
               detalle: nombre_membresia,
               id: membresia_seleccionada,
               tipo: 0
            },
            success: function(data) {
               data = JSON.parse(data);
               //console.log(data.requestId);
               var processUrl = data.processUrl;

               P.init(processUrl);
               $("#processUrl").val(processUrl);
            },
            error: function(data) {
               data = JSON.parse(data);
               alert(data.status.message);
            }
         });
         P.on('response', function(data) {
            let requestId = data.requestId;
            let reference = data.reference;
            let estado_payment = 0
            if (data.status.status == "APPROVED") {
               estado_payment = 1;
               $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
               $('#status_notificacion').text("Transacción Aprobada");
               $('#product_adquirido').html("<strong>Membresia adquirida : </strong>" + nombre_membresia);
            } else if (data.status.status == "REJECTED") {
               estado_payment = 2;
               $('#icono_notificacion').html("<i class='fa fa-times-circle-o'></i>");
               $('#status_notificacion').text("El pago ha sido rechazado");
            } else if (data.status.status == "PENDING") {
               estado_payment = 3;
               $('#icono_notificacion').html("<i class='fa fa-question-circle-o'></i>");
               $('#status_notificacion').text("El proceso de pago está pendiente");
            }
            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/update_request_id') ?>",
               data: {
                  request_id: requestId,
                  reference: reference,
                  status: estado_payment
               },
               success: function(result) {
                  result = JSON.parse(result);
                  if (result.status == 200) {
                     $('#mensaje_notificacion').text(data.status.message);
                     $('#referencia_notificacion').html("<strong>Referencia de la Transacción: </strong>" + data.reference);
                     $('#modal_notificacion').modal('show');
                     setTimeout(() => {
                        location.href = "<?= site_url("perfil/page/") ?>";
                     }, 6000);

                  } else {
                     alert("Ocurrio un error en el servidor");
                  }

               },
               error: function(result) {

                  alert("Ocurrio un error en el servidor");
               }
            });

         });

         $("#lightboxIt").on('click', function() {

            P.init($("#processUrl").val());
         });

      } else {
         $('#condiciones_membresia').focus();
         $('.noficacion_error').html("<h6 class='text-center'>Para continuar es necesario que acepte las condiciones de uso.</h6>")
         $('.noficacion_error').show();
      }

   }

   function pagar_inversa() {
      $(".btn-theme").css("background-color", "#8c1822");
      $(".btn-theme").css("color", "#fff");
      var name_subasta = $('#name_subasta_inversa').text();
      var valor_subasta_inversa = $('#pagar_valor_inversa').val();
      var inversa_subasta_id = $('#invresa_subasta_id').val();
      var condicionesInversas = $('#condiciones_inversa').prop('checked');
      var nameInversa = $('#nameInversa').val();
      var surnameInversa = $('#surnameInversa').val();
      var emailInversa = $('#emailInversa').val();
      var phoneInversa = $('#phoneInversa').val();
      if (!validaUserInversa) {
         nameInversa = nameInversa.trim();
         surnameInversa = surnameInversa.trim();
         emailInversa = emailInversa.trim();
         phoneInversa = phoneInversa.trim();
         if (nameInversa == "") {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es necesario el campo primer nombre es requerido.',
               showConfirmButton: false,
               timer: 1500
            });
            nameInversa.focus();
         } else if (surnameInversa == "") {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es el campo primer apellido es requerido.',
               showConfirmButton: false,
               timer: 1500
            });
            surnameInversa.focus();
         } else if (emailInversa == "") {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es necesario el campo email es requerido.',
               showConfirmButton: false,
               timer: 1500
            });
            emailInversa.focus();
         } else if (phoneInversa == "") {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es necesario el campo teléfono es requerido.',
               showConfirmButton: false,
               timer: 1500
            });
            phoneInversa.focus();
         } else if (!condicionesInversas) {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es necesario que acepte las condiciones de uso.',
               showConfirmButton: true
            });
            $('#condiciones_inversa').focus();
         } else {
            $('#modal_pagar_inversa').modal("hide");
            swal.fire({
               title: '',
               html: '<div class="save_loading"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div><div><h4>Guardando...</h4></div>',
               showConfirmButton: false,
               allowOutsideClick: false,
            });
            setTimeout(() => {
               $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/generar_pedido_inversa') ?>",
                  data: {
                     id: inversa_subasta_id,
                     user_id: null,
                     valida_user: validaUserInversa,
                     nombre: nameInversa,
                     apellido: surnameInversa,
                     telefono: phoneInversa,
                     email: emailInversa
                  },
                  success: function(data) {
                     data = JSON.parse(data);
                     if (data.status == 200) {
                        swal.close();
                        Swal.fire({
                           icon: 'success',
                           title: 'Su pedido está en proceso de verificación, en breves minutos nuestros asistentes de ventas se comunicarán para concretar la compra.',
                           showConfirmButton: true
                        });

                     } else {
                        swal.close();
                        Swal.fire({
                           icon: 'error',
                           title: 'Ocurrio un problema vuelva a intentarlo',
                           showConfirmButton: true
                        });
                        $('#modal_pagar_inversa').modal("show");
                     }
                  },
                  error: function(data) {
                     swal.close();
                     Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error en el servidor vuelva a intentarlo',
                        showConfirmButton: true
                     });
                     $('#modal_pagar_inversa').modal("show");
                  }
               });
            }, 1500);
         }
      } else {
         if (!condicionesInversas) {
            Swal.fire({
               icon: 'info',
               title: 'Para continuar es necesario que acepte las condiciones de uso.',
               showConfirmButton: true
            });
            $('#condiciones_inversa').focus();
         } else {
            $('#modal_pagar_inversa').modal("hide");
            swal.fire({
               title: '',
               html: '<div class="save_loading"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div><div><h4>Guardando...</h4></div>',
               showConfirmButton: false,
               allowOutsideClick: false,
            });
            setTimeout(() => {
               $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/generar_pedido_inversa') ?>",
                  data: {
                     id: inversa_subasta_id,
                     user_id: user_id,
                     valida_user: validaUserInversa,
                     nombre: null,
                     apellido: null,
                     telefono: null,
                     email: null
                  },
                  success: function(data) {
                     data = JSON.parse(data);
                     if (data.status == 200) {
                        swal.close();
                        Swal.fire({
                           icon: 'success',
                           title: 'Su pedido está en proceso de verificación, en breves minutos nuestros asistentes de ventas se comunicarán para concretar la compra.',
                           showConfirmButton: true
                        }).then((result) => {
                           if (result.value) {
                              setTimeout(() => {
                                 location.reload();
                              }, 500);
                           }
                        });

                     } else {
                        swal.close();
                        Swal.fire({
                           icon: 'error',
                           title: 'Ocurrio un problema vuelva a intentarlo',
                           showConfirmButton: true
                        });
                        $('#modal_pagar_inversa').modal("show");
                     }
                  },
                  error: function(data) {
                     swal.close();
                     Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error en el servidor vuelva a intentarlo',
                        showConfirmButton: true
                     });
                     $('#modal_pagar_inversa').modal("show");
                  }
               });

            }, 1500);
         }
      }



      /*   if ($('#condiciones_inversa').prop('checked') == true) {
           $('#modal_pagar_inversa').modal("hide");
              $.ajax({
                     type: 'POST',
                     url: "<?= site_url('front/checkout') ?>",
                     data: {
                        monto: valor_subasta_inversa,
                        detalle: name_subasta,
                        id: inversa_subasta_id,
                        tipo: 3
                     },
                     success: function(data) {
                        data = JSON.parse(data);

                        var processUrl = data.processUrl;

                        P.init(processUrl);
                        $("#processUrl").val(processUrl);
                     },
                     error: function(data) {
                        data = JSON.parse(data);
                        alert(data.status.message);
                     }
                  });
                  P.on('response', function(data) {
                     let requestId = data.requestId;
                     let reference = data.reference;
                     let estado_payment = 0
                     if (data.status.status == "APPROVED") {
                        estado_payment = 1;
                        $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
                        $('#status_notificacion').text("Transacción Aprobada");
                        $('#product_adquirido').html("<strong>Subasta adquirida : </strong>" + name_subasta);
                     } else if (data.status.status == "REJECTED") {
                        estado_payment = 2;
                        $('#icono_notificacion').html("<i class='fa fa-times-circle-o'></i>");
                        $('#status_notificacion').text("El pago ha sido rechazado");
                     } else if (data.status.status == "PENDING") {
                        estado_payment = 3;
                        $('#icono_notificacion').html("<i class='fa fa-question-circle-o'></i>");
                        $('#status_notificacion').text("El proceso de pago está pendiente");
                     }
                     $.ajax({
                        type: 'POST',
                        url: "<?= site_url('front/update_request_id') ?>",
                        data: {
                           request_id: requestId,
                           reference: reference,
                           status: estado_payment
                        },
                        success: function(result) {
                           result = JSON.parse(result);
                           if (result.status == 200) {
                              $('#mensaje_notificacion').text(data.status.message);
                              $('#referencia_notificacion').html("<strong>Referencia de la Transacción: </strong>" + data.reference);
                              $('#modal_notificacion').modal('show');
                              setTimeout(() => {
                                 location.reload();
                              }, 6000);
                           } else {
                              alert("Ocurrio un error en el servidor");
                           }

                        },
                        error: function(result) {

                           alert("Ocurrio un error en el servidor");
                        }
                     });
                  });

                  $("#lightboxIt").on('click', function() {

                     P.init($("#processUrl").val());
                  });
        } else {
           $('#condiciones_inversa').focus();
           Swal.fire({
              icon: 'info',
              title: 'Para continuar es necesario que acepte las condiciones de uso.',
              showConfirmButton: true
           });
             $('.noficacion_error').html("<h6 class='text-center'>Para continuar es necesario que acepte las condiciones de uso.</h6>")
            $('.noficacion_error').show();
        } */
   }

   function pagar_destacar() {
      $(".btn-theme").css("background-color", "#8c1822");
      $(".btn-theme").css("color", "#fff");

      var name_destacado = $('#anuncio_detalle_destacar').val();
      var valor_destacado = 7;
      var anuncio_destacado_id = $('#anuncio_id_destacar').val();
      if ($('#condiciones_destacar').prop('checked') == true) {
         $('#modal_destacar').modal("hide");
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/checkout') ?>",
            data: {
               monto: valor_destacado,
               detalle: name_destacado,
               id: anuncio_destacado_id,
               tipo: 2
            },
            success: function(data) {
               data = JSON.parse(data);

               var processUrl = data.processUrl;

               P.init(processUrl);
               $("#processUrl").val(processUrl);
            },
            error: function(data) {
               data = JSON.parse(data);
               alert(data.status.message);
            }
         });
         P.on('response', function(data) {
            let requestId = data.requestId;
            let reference = data.reference;
            let estado_payment = 0
            if (data.status.status == "APPROVED") {
               estado_payment = 1;
               $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
               $('#status_notificacion').text("Transacción Aprobada");
               $('#product_adquirido').html("<strong>Anuncio detacado : </strong>" + name_destacado);
            } else if (data.status.status == "REJECTED") {
               estado_payment = 2;
               $('#icono_notificacion').html("<i class='fa fa-times-circle-o'></i>");
               $('#status_notificacion').text("El pago ha sido rechazado");
            } else if (data.status.status == "PENDING") {
               estado_payment = 3;
               $('#icono_notificacion').html("<i class='fa fa-question-circle-o'></i>");
               $('#status_notificacion').text("El proceso de pago está pendiente");
            }
            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/update_request_id') ?>",
               data: {
                  request_id: requestId,
                  reference: reference,
                  status: estado_payment
               },
               success: function(result) {
                  result = JSON.parse(result);
                  if (result.status == 200) {
                     $('#mensaje_notificacion').text(data.status.message);
                     $('#referencia_notificacion').html("<strong>Referencia de la Transacción: </strong>" + data.reference);
                     $('#modal_notificacion').modal('show');
                     setTimeout(() => {
                        location.reload();
                     }, 6000);
                  } else {
                     alert("Ocurrio un error en el servidor");
                  }

               },
               error: function(result) {

                  alert("Ocurrio un error en el servidor");
               }
            });

         });

         $("#lightboxIt").on('click', function() {

            P.init($("#processUrl").val());
         });
      } else {
         $('#condiciones_destacar').focus();
         $('.noficacion_error').html("<h6 class='text-center'>Para continuar es necesario que acepte las condiciones de uso.</h6>")
         $('.noficacion_error').show();
      }
   }

   //  console.log(subastas_2);
   $('#valor_pujando').change(function() {
      $('#btn_pujando_modal').prop('disabled', false);
      let valor_modal = parseFloat($('#valor_pujando').val());
      if (valor_modal > parseFloat(input_valor)) {

         $('#error_puja').hide();
         $('#btn_pujando_modal').show();

      } else {

         $('#btn_pujando_modal').hide();
         $('#error_puja').show();
      }
   });
   $(function() {
      session_subasta_id = "<?= $this->session->userdata('subasta_id') ?>";
      login_user_welcome = "<?= $this->session->userdata('login') ?>";
      if (login_user_welcome) {
         <?php $this->session->set_userdata('login', null) ?>
         $('#modal_saludar').modal('show');
         setTimeout(function() {
            $('#modal_saludar').modal('hide');
         }, 4000);

      }
      session_subasta = "<?= base64_encode(json_encode($this->session->userdata('subasta')))   ?>";

      setTimeout(function() {
         if (session_subasta_id && session_subasta == "bnVsbA==") {
            <?php $this->session->set_userdata('subasta_id', null) ?>
            cargarmodal_subasta(session_subasta_id, "");

         }
         if (session_subasta_id && session_subasta != "bnVsbA==") {
            <?php $this->session->set_userdata('subasta_id', null) ?>
            <?php $this->session->set_userdata('subasta', null) ?>
            cargarmodal_subasta(session_subasta_id, session_subasta);

         }
      }, 4000);
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

   function cargar_modal_destacar(object) {
      object = atob(object);
      object = JSON.parse(object);
      $('.transaccion_pendiente').hide();
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/get_payments_user') ?>",

         data: {
            user_id: user_id,
         },
         success: function(result) {
            result = JSON.parse(result);
            // console.log(result);
            if (result.status == 500) {
               if (result.data.length > 0) {

                  let trans_pendiente = "<p class='text-center'><b>Estimado usuario actualmente tiene una transacción pendiente.</b></p>";
                  for (let i = 0; i < result.data.length; i++) {
                     trans_pendiente += "<p class='text-center'><b>Referencia: #" + result.data[i].reference + "</b></p>";
                  }

                  $('#body_condiciones_destacar').hide();
                  $('#btn_destacar').hide();
                  $('.transaccion_pendiente').html(trans_pendiente);
                  $('.transaccion_pendiente').show();

               } else {
                  $('#body_condiciones_destacar').show();
                  $('#btn_destacar').show();
               }


            } else if (result.status == 200) {
               $('#body_condiciones_destacar').show();
               $('#btn_destacar').show();
            }
         }
      });
      $('#modal_destacar').modal("show");
      $('#anuncio_id_destacar').val(object.anuncio_id);
      $('#anuncio_detalle_destacar').val(object.titulo);
   }

   function cargar_modal_membresia(id, nombre, precio, cantidad) {

      var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#membresia').val(id);
      $('#nombre').text(nombre);
      $('#precio').text("$" + parseFloat(precio).toFixed(2));
      $('#cantidad').text(cant + " " + cantidad);
      $('#btn_modal_membresia').show();
      $("#modal_membresia").modal("show");
   }
   let precio_piso_subata = 0;

   function cargarmodal_entrar(id, nombre, precio) {

      //  var cant = "<?php echo translate('cant_anuncios_lang') ?>";

      $('#condiciones_piso').prop('checked', false);
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/get_membresia_user_ajax') ?>",
         data: {
            user_id: 0,
         },
         success: function(result) {
            result = JSON.parse(result);
            //  console.log(result);

            if (result.status == 500) {
               qty_subastas = parseInt(result.data.qty_subastas);
               descuento = parseFloat(result.data.descuento);
               membresia_id = result.data.membre_user_id;
               if (qty_subastas > 0) {
                  $('#inicial').html("<span class='label label-primary'>$0.00</span>");
                  precio_piso_subata = 0
                  $('#descuento').html('Antes <span  class="label label-success strikethrough">$' + parseFloat(precio).toFixed(2) + ' </span>');
               } else {
                  precio = parseFloat(precio);
                  descuento = descuento / 100;
                  base_deduccion = precio * descuento;

                  let total = precio - base_deduccion;
                  precio_piso_subata = total;
                  $('#inicial').html("Total a pagar <span class='label label-primary'>$" + parseFloat(total).toFixed(2) + "</span>");
                  $('#descuento').html('Antes <span  class="label label-success strikethrough">$' + parseFloat(precio).toFixed(2) + ' </span>');

               }


            } else if (result.status == 200) {
               precio_piso_subata = precio;
               $('#inicial').html("Total a pagar <span class='label label-primary'>$" + parseFloat(precio).toFixed(2) + "</span>");
            }

         }
      });




      $('.transaccion_pendiente').hide();
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/get_payments_user') ?>",

         data: {
            user_id: user_id,
         },
         success: function(result) {
            result = JSON.parse(result);
            console.log(result);
            if (result.status == 500) {
               if (result.data.length > 0) {

                  let trans_pendiente = "<p class='text-center'><b>Estimado usuario actualmente tiene una transacción pendiente.</b></p>";
                  for (let i = 0; i < result.data.length; i++) {
                     trans_pendiente += "<p class='text-center'><b>Referencia: #" + result.data[i].reference + "</b></p>";
                  }

                  $('#body_condiciones_piso').hide();
                  $('#btn_pagar_piso').hide();
                  $('.transaccion_pendiente').html(trans_pendiente);
                  $('.transaccion_pendiente').show();

               } else {
                  $('#body_condiciones_piso').show();
                  $('#btn_pagar_piso').show();
               }


            } else if (result.status == 200) {
               $('#body_condiciones_piso').show();
               $('#btn_pagar_piso').show();
            }
         }
      });

      $('#subasta_id').val(id);
      $('#name_subasta').text(nombre);
      $("#modal_entrar").modal("show");
      $("#modal_detalle").modal("hide");
   }
   let puja_mayor_subasta = 0;

   function cargarmodal_pujar(id, nombre, precio, valor_inicial) {

      // var cant = "<?php echo translate('cant_anuncios_lang') ?>";
      $('#valor_pujando').val("");
      $('#valor_puja').val("");
      $('#subasta_user_id').val(id);
      $('#name_subasta').text(nombre);
      $('#mensaje_pujar').hide();
      $('#mensaje_pujar_2').hide();
      if (puja_mayor_subasta > 0) {
         input_valor = parseFloat(puja_mayor_subasta);
         $('#valor_pujando').val(puja_mayor_subasta);
         $('#valor_puja').text("$" + parseFloat(puja_mayor_subasta).toFixed(2));
      } else {
         if (precio == "null") {
            input_valor = parseFloat(valor_inicial);
            $('#valor_pujando').val(valor_inicial);
            $('#valor_puja').text("$" + parseFloat(valor_inicial).toFixed(2));
         } else {
            input_valor = parseFloat(precio);
            $('#valor_pujando').val(precio);
            $('#valor_puja').text("$" + parseFloat(precio).toFixed(2));
         }
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

         $("#btn_login_subasta").hide();
         $("#btn_comprar_inversa").show();
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
               console.log(result)
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
                        $('#precio').html("Precio inicial $" + parseFloat(object.intervalo[count_intervalo - 1].valor).toFixed(2));

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
                  if (result.is_open == 0) {
                     $('#btn_subastas_' + result[i].subasta_id).show();
                     $('#cronometro_subasta_' + result[i].subasta_id).hide();
                     $('#span_subasta_' + result[i].subasta_id).hide();
                     $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                     $('#body_login_subasta_entrar').hide();
                     $('#body_entrar_subasta').hide();
                     $('#body_cronometro').hide();
                     $("#body_pujar").hide();
                  }



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
                  var fecha = result.all_detalle.fecha_cierre;
                  var fecha_inicio = result.all_detalle.fecha_inicio;
                  var date = new Date(fecha);
                  var date_inicio = new Date(fecha_inicio);
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
                           console.log('aqui2');
                           $("#body_pujar").show();
                           $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                        } else {
                           console.log('aqui3');
                           if (parseFloat(result.puja_user.valor) < parseFloat(result.puja.valor)) {
                              $("#body_pujar").show();
                              $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                           }
                        }


                     }
                  }
                  if (result.is_open == 0) {
                     $('#btn_subastas_' + result[i].subasta_id).show();
                     $('#cronometro_subasta_' + result[i].subasta_id).hide();
                     $('#span_subasta_' + result[i].subasta_id).hide();
                     $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                     $('#body_login_subasta_entrar').hide();
                     $('#body_entrar_subasta').hide();
                     $('#body_cronometro').hide();
                     $("#body_pujar").hide();
                  }
                  if (date_inicio >= hoy) {
                     $("#body_entrar_subasta").hide();
                  }


               }

            }
         });
      }

      $("#modal_detalle").modal("show");

   }

   const handleTypePayment = () => {
      let typePayment = $('#typePayment').val();
      let obj = localStorage.getItem('membresia');
      $('#modalMetodoPago').modal('hide');
      typePayment == 1 ? seleccionar_membresia(obj) : paymentBilletera(obj);
   }

   const paymentBilletera = (object) => {
      object = JSON.parse(decodeB64Utf8(object));
      wallet = JSON.parse(wallet);
      $('#nameMembresia').text('Membresia: ' + object.nombre);
      $('#priceMembresia').text('Precio: ' + parseFloat(object.precio).toFixed(2));
      $('#priceMembre').val(parseFloat(object.precio).toFixed(2));
      $('#saldoWalletMembresia').text(wallet ? 'Saldo disponible: ' + parseFloat(wallet.balance).toFixed(2) : 'Saldo disponible: 0.00');
      $('#membresiaId').val(object.membresia_id);
      if (wallet) {
         if (wallet.balance > 0) {
            $('#btnPaymentWallet').prop('disabled', false)
         } else {
            $('#btnPaymentWallet').prop('disabled', true);
         }
      } else {
         $('#btnPaymentWallet').prop('disabled', true);
      }
      $('#modalPaymentBilletera').modal('show');
   }

   const paymentWallet = () => {
      let membresiaId = $('#membresiaId').val();
      let priceMembresia = $('#priceMembre').val();
      if (wallet) {
         let balance = parseFloat(parseFloat(wallet.balance).toFixed(2));
         priceMembresia = parseFloat(parseFloat(priceMembresia).toFixed(2));
         if (balance >= priceMembresia) {
            Swal.fire({
               title: 'Completando operación',
               text: 'Procesando  pago...',
               imageUrl: '<?= base_url("assets/cargando.gif") ?>',
               imageAlt: 'No realice acciones sobre la página',
               showConfirmButton: false,
               allowOutsideClick: false,
               footer: '<a href>No realice acciones sobre la página</a>',
            });
            setTimeout(function() {
               $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/payment_membresia_wallet') ?>",
                  data: {
                     membresiaId
                  },
                  success: function(result) {
                     localStorage.removeItem('membresia');
                     Swal.close();
                     result = JSON.parse(result);
                     if (result.status == 200) {
                        Swal.fire({
                           position: 'top-end',
                           icon: 'success',
                           title: 'Membresia adquirida correctamente',
                           showConfirmButton: false,
                           timer: 1500
                        })
                        setTimeout(() => {
                           window.location.href = '<?= site_url('perfil/page'); ?>';
                        }, 1000);
                     } else {
                        Swal.close();
                        swal({
                           title: '¡Error!',
                           text: result.msj,
                           padding: '2em'
                        });
                     }
                  }
               });
            }, 1500)
         } else {
            Swal.fire({
               position: 'top-end',
               icon: 'info',
               title: 'Su saldo no es suficiente para realizar esta transacción',
               showConfirmButton: false,
               timer: 1500
            })
         }
      } else {
         Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Su saldo no es suficiente para realizar esta transacción',
            showConfirmButton: false,
            timer: 1500
         })
      }
   }

   function seleccionar_membresia(object) {
      object = JSON.parse(decodeB64Utf8(object));
      localStorage.removeItem('membresia');
      let id_pendiente = false;
      let contador_trans = 0;
      var user_id = "<?= $this->session->userdata('user_id'); ?>";
      var phone = "<?= $this->session->userdata('phone'); ?>";
      var email = "<?= $this->session->userdata('email'); ?>";
      $('#body_condiciones_membresia').hide();
      $('#btn_modal_membresia').hide();
      $('.transaccion_pendiente').hide();
      $('.noficacion_error').hide();
      $.ajax({
         type: 'POST',
         url: "<?= site_url('front/get_payments_user') ?>",

         data: {
            user_id: user_id,
         },
         success: function(result) {
            result = JSON.parse(result);

            if (result.status == 500) {
               if (result.data.length > 0) {

                  let trans_pendiente = "<p class='text-center'><b>Estimado usuario actualmente tiene una transacción pendiente.</b></p>";
                  for (let i = 0; i < result.data.length; i++) {
                     trans_pendiente += "<p class='text-center'><b>Referencia: #" + result.data[i].reference + "</b></p>";
                  }

                  $('#body_condiciones_membresia').hide();
                  $('#btn_modal_membresia').hide();
                  $('.transaccion_pendiente').html(trans_pendiente);
                  $('.transaccion_pendiente').show();

               } else {
                  $('#body_condiciones_membresia').show();
                  $('#btn_modal_membresia').show();
               }


            } else if (result.status == 200) {
               $('#body_condiciones_membresia').show();
               $('#btn_modal_membresia').show();
            }
         }
      });
      $('#nombre_membresia').text(object.nombre);
      $('#precio_membresia').text("$" + parseFloat(object.precio).toFixed(2));
      $('#membresia_id').val(object.membresia_id);
      $('#modal_membresia_gratis').modal('show');

   }

   function pagar_piso() {
      $(".btn-theme").css("background-color", "#8c1822");
      $(".btn-theme").css("color", "#fff");
      if ($('#condiciones_piso').prop('checked') == true) {
         let subasta_id = $('#subasta_id').val();
         $("#modal_entrar").modal("hide");
         if (precio_piso_subata == 0) {
            let detalle = "Pago de piso de la subasta";
            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/pagar_entrada_ajax') ?>",

               data: {
                  subasta_id: subasta_id,
               },
               success: function(result) {
                  result = JSON.parse(result);
                  //console.log(result);
                  if (result.status == 500) {
                     let message = "<?= translate('piso_error') ?>";
                     $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
                     $('#status_notificacion').text("Transacción Aprobada");
                     $('#product_adquirido').html("<strong>Descripción : </strong>" + detalle);
                     $('#mensaje_notificacion').text(message);
                     $('#referencia_notificacion').html("");
                     $('#modal_notificacion').modal('show');
                     setTimeout(() => {
                        $('#modal_notificacion').modal('hide');
                     }, 6000);

                  } else if (result.status == 200) {

                     let message = "<?= translate('piso_pagado_lang') ?>";
                     $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
                     $('#status_notificacion').text("Transacción Aprobada");
                     $('#product_adquirido').html("<strong>Descripción : </strong>" + detalle);
                     $('#mensaje_notificacion').text(message);
                     $('#referencia_notificacion').html("");
                     $('#modal_notificacion').modal('show');
                     $('#btn_entrar_subasta_' + subasta_id).hide();
                     setTimeout(() => {
                        $('#modal_notificacion').modal('hide');
                        cargarmodal_subasta(subasta_id, "");
                     }, 6000);
                  }

               }
            });
         } else {
            let detalle = "Pago de piso de la subasta";

            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/checkout') ?>",
               data: {
                  monto: precio_piso_subata,
                  detalle: detalle,
                  id: subasta_id,
                  tipo: 1
               },
               success: function(data) {
                  // console.log(data);
                  data = JSON.parse(data);

                  var processUrl = data.processUrl;

                  P.init(processUrl);
                  $("#processUrl").val(processUrl);
               },
               error: function(data) {
                  data = JSON.parse(data);
                  alert(data.status.message);
               }
            });
            P.on('response', function(data) {

               let requestId = data.requestId;
               let reference = data.reference;
               let estado_payment = 0;
               if (data.status.status == "APPROVED") {
                  estado_payment = 1;
                  $('#icono_notificacion').html("<i class='fa fa-check-circle-o'></i>");
                  $('#status_notificacion').text("Transacción Aprobada");
                  $('#product_adquirido').html("<strong>Descripción : </strong>" + detalle);
               } else if (data.status.status == "REJECTED") {
                  estado_payment = 2;
                  $('#icono_notificacion').html("<i class='fa fa-times-circle-o'></i>");
                  $('#status_notificacion').text("El pago ha sido rechazado");
               } else if (data.status.status == "PENDING") {
                  estado_payment = 3;
                  $('#icono_notificacion').html("<i class='fa fa-question-circle-o'></i>");
                  $('#status_notificacion').text("El proceso de pago está pendiente");
               }
               $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/update_request_id') ?>",
                  data: {
                     request_id: requestId,
                     reference: reference,
                     status: estado_payment
                  },
                  success: function(result) {
                     result = JSON.parse(result);
                     if (result.status == 200) {
                        $('#mensaje_notificacion').text(data.status.message);
                        $('#referencia_notificacion').html("<strong>Referencia de la Transacción: </strong>" + data.reference);
                        $('#modal_notificacion').modal('show');
                        setTimeout(() => {
                           $('#modal_notificacion').modal('hide');
                           cargarmodal_subasta(subasta_id, "");
                        }, 6000);
                     } else {
                        alert("Ocurrio un error en el servidor");
                     }

                  },
                  error: function(result) {

                     alert("Ocurrio un error en el servidor");
                  }
               });

            });

            $("#lightboxIt").on('click', function() {

               P.init($("#processUrl").val());
            });
         }
      } else {
         $('#condiciones_piso').focus();
         $('.noficacion_error').html("<h6 class='text-center'>Para continuar es necesario que acepte las condiciones de uso.</h6>")
         $('.noficacion_error').show();
      }

      /*  */
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
               $('#btn_pujando_modal').prop('disabled', false);
               setTimeout(() => {
                  $('#mensaje_pujar').fadeOut(2000)
               }, 3000);

            } else if (result.status == 200) {

               let message = "<?= translate('pujar_valor_lang') ?>";
               $('#mensaje_error_pujar_2').text(message);
               $('#mensaje_pujar_2').show();
               $('#btn_pujando_modal').prop('disabled', true);
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
      $('.transaccion_pendiente').hide();
      /*      $.ajax({
              type: 'POST',
              url: "<?= site_url('front/get_payments_user') ?>",

              data: {
                 user_id: user_id,
              },
              success: function(result) {
                 result = JSON.parse(result);
                 console.log(result);
                 if (result.status == 500) {
                    if (result.data.length > 0) {

                       let trans_pendiente = "<p class='text-center'><b>Estimado usuario actualmente tiene una transacción pendiente.</b></p>";
                       for (let i = 0; i < result.data.length; i++) {
                          trans_pendiente += "<p class='text-center'><b>Referencia: #" + result.data[i].reference + "</b></p>";
                       }

                       $('#body_condiciones_inversa').hide();
                       $('#btn_pagar_inversa').hide();
                       $('.transaccion_pendiente').html(trans_pendiente);
                       $('.transaccion_pendiente').show();

                    } else {
                       $('#body_condiciones_inversa').show();
                       $('#btn_pagar_inversa').show();
                    }


                 } else if (result.status == 200) {
                    $('#body_condiciones_inversa').show();
                    $('#btn_pagar_inversa').show();
                 }
              }
           }); */
      $('#name_subasta_inversa').text(object.nombre_espa);
      $('#pagar_valor_inversa').val(parseFloat(object.intervalo[object.intervalo.length - 1].valor).toFixed(2));
      $('#valor_inversa').text("$" + parseFloat(object.intervalo[object.intervalo.length - 1].valor).toFixed(2));
      $('#invresa_subasta_id').val(object.subasta_id);
      $('#modal_pagar_inversa').modal("show");
      $("#modal_detalle").modal("hide");
      if (!user_id) {
         $('#formClienteSubastaInversa').show();
         validaUserInversa = false;
      } else {
         $('#formClienteSubastaInversa').hide();
         validaUserInversa = true;
      }

   }
   let validaUserInversa = false;

   $(function() {
      if (contador_directa == 0 && contador_inversa != 0) {
         $('.mensaje_directa').show();
      } else if (contador_directa != 0 && contador_inversa == 0) {
         $('.mensaje_inversa').show();
      } else if (contador_directa == 0 && contador_inversa == 0) {
         $('.mensaje_all').show();
      }
      /*      if (contador_directa == 0) {

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
           } */
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

            $.ajax({
               type: 'POST',
               url: "<?= site_url('front/detalle_subasta') ?>",

               data: {
                  id: subasta_id
               },
               success: function(result) {
                  result = JSON.parse(result);

                  if (result) {

                     if (result.all_detalle.tipo_subasta == 1) {

                        var fecha = result.all_detalle.fecha_cierre;
                        var date = new Date(fecha);
                        var hoy = new Date();

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

                        if (result.puja.valor) {
                           $("#valor_alto_modal").html("<i class='fa fa-user-o'></i> " + result.user_win.name + " $" + parseFloat(result.puja.valor).toFixed(2));
                        }
                        if (result.subasta_user && result.puja.valor == null) {
                           $('#valor_alto_modal').html("$" + parseFloat(result.all_detalle.valor_inicial).toFixed(2));
                        }
                        if (user_id != "") {
                           if (result.subasta_user == "null") {
                              $("#body_entrar_subasta").show();
                              $("#btn_entrar_subasta").attr('onclick', 'cargarmodal_entrar("' + result.all_detalle.subasta_id + '","' + result.all_detalle.nombre_espa + '","' + result.all_detalle.valor_pago + '")');

                           } else {
                              if (result.puja_user) {
                                 if (result.puja_user.valor == "null") {
                                    $("#body_entrar_subasta").hide();
                                    $('#btn_pujar_subasta_' + result.subasta_id).show();
                                    $("#body_pujar").show();
                                    $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                                 } else {
                                    if (parseFloat(result.puja_user.valor) < parseFloat(result.puja.valor)) {
                                       puja_mayor_subasta = result.puja.valor;
                                       $('#btn_pujar_subasta_' + result[i].subasta_id).show();
                                       $("#body_pujar").show();
                                       $("#btn_pujar").attr('onclick', 'cargarmodal_pujar("' + result.subasta_user.subasta_user_id + '","' + result.all_detalle.nombre_espa + '","' + result.puja.valor + '","' + result.all_detalle.valor_inicial + '")');
                                    }
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

         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/subasta_directas_ajax') ?>",

            data: {
               id: 0
            },
            success: function(result) {
               result = JSON.parse(result);

               if (result) {

                  for (let i = 0; i < result.length; i++) {
                     if (result[i].puja.valor == "null") {
                        $('#valor_inicial_subasta_' + result[i].subasta_id).html("$" + parseFloat(result[i].valor_inicial).toFixed(2));
                     } else {
                        if (result[i].user_win) {

                           let name_win = result[i].user_win.name;
                           $('#user_win_title_' + result[i].subasta_id).show();
                           $('#user_win_' + result[i].subasta_id).show();
                           $('#valor_inicial_subasta_' + result[i].subasta_id).html("<i class='fa fa-user-o'></i> " + name_win + " $" + parseFloat(result[i].puja.valor).toFixed(2));
                        }

                     }
                     if (result[i].is_open == 0) {

                        $('#btn_subastas_' + result[i].subasta_id).show();
                        $('#cronometro_subasta_' + result[i].subasta_id).hide();
                        $('#span_subasta_' + result[i].subasta_id).hide();
                        $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                        $('#body_login_subasta_entrar').hide();
                        $('#body_entrar_subasta').hide();
                        $('#body_cronometro').hide();
                        $("#body_pujar").hide();
                     } else {
                        if (result[i].subasta_user != null) {

                           $('#btn_entrar_subasta_' + result[i].subasta_id).hide();
                           $("#btn_pujar_subasta_" + result[i].subasta_id).remove();
                           $('#btn_entrar_subasta_' + result[i].subasta_id).after("<button id='btn_pujar_subasta_" + result[i].subasta_id + "' onclick='' class='btn btn-block btn-success'><i class='fa fa-hand-paper-o'></i> <?= translate("pujar_lang"); ?></button>");
                           $("#btn_pujar_subasta_" + result[i].subasta_id).attr('onclick', 'cargarmodal_pujar("' + result[i].subasta_user.subasta_user_id + '","' + result[i].nombre_espa + '","' + result[i].puja.valor + '","' + result[i].valor_inicial + '")');


                        } else {

                           $('#btn_entrar_subasta_' + result[i].subasta_id).show();
                        }

                        if (result[i].puja.valor != "null") {

                           if (result[i].puja_user.valor == null) {

                              $('#btn_pujar_subasta_' + result[i].subasta_id).show();
                           } else {
                              if (parseFloat(result[i].puja_user.valor) < parseFloat(result[i].puja.valor)) {

                                 $('#btn_pujar_subasta_' + result[i].subasta_id).show();
                              } else {

                                 $('#btn_pujar_subasta_' + result[i].subasta_id).hide();
                              }
                           }

                        }
                     }



                  }


               }

            }
         });
      } else {
         $.ajax({
            type: 'POST',
            url: "<?= site_url('front/subastas_ajax') ?>",

            data: {
               id: 0
            },
            success: function(result) {
               result = JSON.parse(result);

               if (result) {

                  for (let i = 0; i < result.length; i++) {
                     if ($('#modal_detalle').hasClass('in')) {
                        if (result[i].is_open == 0 && subasta_id == result[i].subasta_id) {

                           $('#body_login_subasta_entrar').hide();
                           $('#body_entrar_subasta').hide();
                           $('#body_cronometro').hide();
                           $("#body_pujar").hide();
                           $('#btn_modal_detalle_subasta').hide();

                        }
                     } else {
                        if (result[i].is_open == 0) {
                           $('#btn_subastas_' + result[i].subasta_id).show();
                           $('#cronometro_subasta_' + result[i].subasta_id).hide();
                           $('#span_subasta_' + result[i].subasta_id).hide();


                        }
                     }



                  }


               }

            }
         });
      }



   }, 6000);
</script>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- Main Content Area End -->
<!-- Post Ad Sticky -->
<style>
   .sweet-alert-trigger {
      padding: 5px 10px;
      border: 0;
      border-radius: 3px;
      background: #0F74F4;
      color: white;
   }

   .save_loading {
      width: 140px;
      height: 140px;
      margin: 0 auto;
      animation-duration: 0.5s;
      animation-timing-function: linear;
      animation-iteration-count: infinite;
      animation-name: ro;
      transform-origin: 50% 50%;
   }

   @keyframes ro {
      100% {
         transform: rotate(-360deg) translate(0, 0);
      }
   }

   .img-master {
      margin-top: 0px !important;
      max-height: 500px !important;
   }

   .banner2 {
      padding-top: 107px !important
   }
</style>


</body>

<!-- Mirrored from templates.scriptsbundle.com/addforest/demos/adforest/site-map.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Aug 2019 00:19:51 GMT -->