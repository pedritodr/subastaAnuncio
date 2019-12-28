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
   <a href="#" class="sticky-post-button hidden-xs">
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
                        <li>
                           <span><?= translate('valor_pagado_lang') ?></span>
                           <p id="valor_entrada"></p>
                        </li>
                        <li>
                           <span><?= translate('date_cierre_lang') ?></span>
                           <p id="fecha_cierre"></p>
                        </li>



                     </ul>

                     <div style="margin-left:41px; margin-bottom:5px" class="col-md-12">
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
<script src="https://cdn.paymentez.com/checkout/1.0.1/paymentez-checkout.min.js"></script>

<script type="text/javascript">
   var user_id = "<?= $this->session->userdata('user_id') ?>";
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

   function cargarmodal_subasta(id) {
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
      $("#modal_detalle").modal("show");

   }


   function seleccionar_membresia(membresia_id, precio) {

      var user_id = "<?= $this->session->userdata('user_id'); ?>";
      var phone = "<?= $this->session->userdata('phone'); ?>";
      var email = "<?= $this->session->userdata('email'); ?>";

      var sub = parseFloat(precio) / 1.12;
      var iva = parseFloat(precio) - sub;
      var descripcion = "Compra de una membresia de subasta anuncio";
      var misElementos = "1234567890"; // Conjunto de elementos validos a obtener
      // posición aleatoria del elemento que va a ser elegido
      var posicion = 0 + Math.floor(Math.random() * misElementos.length);

      paymentezCheckout.open({
         user_id: user_id,
         user_email: email, //optional
         user_phone: phone, //optional
         order_description: descripcion,
         order_amount: parseFloat(parseFloat(precio).toFixed(2)),
         order_vat: parseFloat(parseFloat(iva).toFixed(2)),
         order_reference: posicion.toString(),
         order_taxable_amount: parseFloat(parseFloat(sub).toFixed(2)),
         order_tax_percentage: 12
      });

   }


   var paymentezCheckout = new PaymentezCheckout.modal({
      client_app_code: 'MUSIC-EC-CLIENT', // Client Credentials Provied by Paymentez
      client_app_key: 'Z7NE0mtkrrjxKCyp42FWdQ2FfKGbJl', // Client Credentials Provied by Paymentez
      locale: 'es', // User's preferred language (es, en, pt). English will be used by default.
      env_mode: 'stg', // `prod`, `stg`, `dev`, `local` to change environment. Default is `stg`
      onOpen: function() {
         console.log('modal open');
      },
      onClose: function() {
         console.log("Modal cerrado");
      },
      onResponse: function(response) { // The callback to invoke when the Checkout process is completed

         console.log(response);
         console.log(response.transaction["status_detail"]);

         if (response.transaction["status_detail"] === 3) {
            alert("todo bien");
            // window.location.href = "<?= site_url('/front/change_status_order/') ?>" +"/"+order_id+"/"+ response.transaction.id + "/" + response.transaction.authorization_code;
         } else {
            $("#msg_error_pago").empty();
            console.log(response.transaction.message);
            $("#msg_error_pago").show();
            $("#msg_error_pago").html("La compra no se ha podido procesar. Por favor, intente de nuevo.");
            $('html,body').animate({
               scrollTop: $("body").offset().top
            }, 'slow');
         }


      }
   });



   // Close Checkout on page navigation:
   window.addEventListener('popstate', function() {
      paymentezCheckout.close();
   });

   /* $(".modal-body").bind("click", function() {

    });*/
   const FILETYPES = [
      'image/jpeg',
      'image/pjpeg',
      'image/png',
      'image/bmp',
      'image/gif'
   ];

   const MESSAGES = [];
   const MAX_FILE_SIZE = 5 * 1048576;

   // Define text message
   MESSAGES['file_not_accept'] = '<?= "Extención del archivo no valida" ?>';
   MESSAGES['file_size_exceeded'] = '<?= "El archivo seleccionado supera los 5mb permitidos" ?>';

   // action message validation
   const input_image = $("#image_upload");
   const alert_message = $("#alert-message");

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
</script>
<!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
<!-- Main Content Area End -->
<!-- Post Ad Sticky -->
<a href="<?= site_url('crear-anuncio') ?>" class="sticky-post-button hidden-xs">
   <span class="sell-icons">
      <i class="flaticon-online-job-search-symbol"></i>
   </span>
   <h4><?= translate("publicar_lang"); ?></h4>
</a>
<!-- Back To Top -->
<a href="#0" class="cd-top">Top</a>
<!-- Back To Top -->

</body>

<!-- Mirrored from templates.scriptsbundle.com/addforest/demos/adforest/site-map.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Aug 2019 00:19:51 GMT -->