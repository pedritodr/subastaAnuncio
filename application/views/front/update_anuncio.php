      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
         <div class="master-slider ms-skin-default banner2" id="masterslider">
            <?php foreach ($all_banners as $item) { ?>
               <div class="ms-slide slide-1" data-delay="5">
                  <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />

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
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding  gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                     <!-- end post-padding -->
                     <div class="post-ad-form postdetails">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                              <!--  <label><?= translate("publi_lang"); ?></label> -->
                           </h3>
                        </div>
                        <!-- <p class="lead">Posting an ad on <a href="#">AdForest</a> is free! However, all ads must follow our rules:</p> -->

                        <!-- Titulo anuncio  -->
                        <div class="row">
                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div id="alert-message" class="alert alert-danger alert-dismissable" style="display: none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <h4><i class="icon fa fa-ban"></i> <?= translate('title_alert_message_lang'); ?></h4>
                                 <p></p>
                              </div>
                              <?= get_message_from_operation(); ?>

                              <div class="form-group">
                                 <label><?= translate("titulo_anun_lang"); ?></label>
                                 <input required placeholder="<?= translate('titulo_anun_lang'); ?>" class="form-control" type="text" id="titulo" name="titulo" value="<?= $anuncio_object->titulo ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <!-- Categoria  -->
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <label><?= translate("cate_list_lang"); ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i>
                                 </span>
                                 <select onchange="change_categoria();" id="categoria" name="categoria" class="form-control select2">

                                    <?php
                                    if (isset($all_cate_anuncio))
                                       foreach ($all_cate_anuncio as $item) { ?>
                                       <option <?php if ($categoria->cate_anuncio_id == $item->cate_anuncio_id) { ?> selected <?php } ?> value="<?= $item->cate_anuncio_id; ?>"><?= $item->nombre; ?></option>
                                    <?php } ?>
                                 </select>

                              </div>
                           </div>

                           <div id="cuerpo_subcategoria" class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <label><?= translate("listar_subcate_lang"); ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i>
                                 </span>
                                 <select id="subcategoria" name="subcategoria" class="form-control select2">

                                    <?php
                                    if (isset($all_subcate))
                                       foreach ($all_subcate as $item) { ?>
                                       <option <?php if ($anuncio_object->subcate_id == $item->subcate_id) { ?> selected <?php } ?> value="<?= $item->subcate_id; ?>"><?= $item->nombre; ?></option>
                                    <?php } ?>
                                 </select>


                              </div>

                           </div>

                           <!-- Precio  -->
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <label><?= translate("precios_lang"); ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                 <input required placeholder="<?= translate('precios_lang'); ?>" class="form-control" min="0" type="number" step="any" id="precio" name="precio" value="<?= $anuncio_object->precio ?>">
                              </div>

                           </div>

                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <label><?= translate("phone_person__lang"); ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                                 </span>
                                 <input placeholder="<?= translate("phone_person__lang"); ?>" class="form-control" type="text" id="whatsapp" name="whatsapp" value="<?= $anuncio_object->whatsapp ?>">
                              </div>
                           </div>

                        </div>
                        <div class="row">
                           <div style="margin-bottom: -3%;" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label class="control-label"><?= translate('description_lang'); ?></label>
                                 <textarea name="descripcion" id="descripcion" class="form-control textarea" required placeholder="<?= translate('description_lang'); ?>"><?= $anuncio_object->descripcion ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <br>
                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <p class="text-left"> <label style="color:#8c1822;"><span><i style="color:#8c1822;font-size:24px" class="fa fa-upload" aria-hidden="true"></i></span> Hasta 10 Imagenes para el anuncio (tamaño recomendado 645x645)</label></p>

                              <div class="row" id="bodyCargaImagenes">
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_0" onclick="delete_image_0()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_0" onclick="llamar_add_imagen_0()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image" class="text-center"> <span id="span_add_0" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_0" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_1" onclick="delete_image_1()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_1" onclick="llamar_add_imagen_1()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_1" class="text-center"> <span id="span_add_1" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_1" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_2" onclick="delete_image_2()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_2" onclick="llamar_add_imagen_2()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_2" class="text-center"> <span id="span_add_2" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_2" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_3" onclick="delete_image_3()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_3" onclick="llamar_add_imagen_3()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_3" class="text-center"> <span id="span_add_3" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_3" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_4" onclick="delete_image_4()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_4" onclick="llamar_add_imagen_4()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_4" class="text-center"> <span id="span_add_4" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_4" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_5" onclick="delete_image_5()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_5" onclick="llamar_add_imagen_5()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_5" class="text-center"> <span id="span_add_6" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_5" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_6" onclick="delete_image_6()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_6" onclick="llamar_add_imagen_6()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_6" class="text-center"> <span id="span_add_6" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_6" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_7" onclick="delete_image_7()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_7" onclick="llamar_add_imagen_7()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_7" class="text-center"> <span id="span_add_7" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_7" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_8" onclick="delete_image_8()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_8" onclick="llamar_add_imagen_8()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_8" class="text-center"> <span id="span_add_8" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_8" accepts="image/*">
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div style="box-shadow: 4px 6px 10px -3px #bfc9d4" class="text-center">
                                       <span id="span_delete_9" onclick="delete_image_9()" style="position:absolute; top:0%;z-index:100;right: 23%;cursor:pointer;display:none;" class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</span>
                                       <img style="width: 70%; cursor:pointer position:relative" id="image_9" onclick="llamar_add_imagen_9()" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                                       <br>
                                       <label style="font-size:12px;cursor: pointer;" for="add_image_9" class="text-center"> <span id="span_add_9" style="background:#fff0" class="label label-success"> <i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen</span></label>
                                       <input type="file" name="archivo" id="add_image_9" accepts="image/*">
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <br>
                        </div>
                        <div class="row">
                           <br>
                           <div style="padding:0 20px 0 20px" class="google-maps-wrapper">
                              <div id="google-maps-inner" class="google-maps-inner">

                                 <label><?= translate("direccion_lang"); ?></label>
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input style="width:100%;" id="pac-input" name="pac-input" class="controls input-sm form-control" value="<?= $anuncio_object->direccion ?>" type="text" placeholder="Escribe la dirección aqui">
                                 </div>
                                 <div id="map" class="map">
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <input type="hidden" id="anuncio_id" name="anuncio_id" value="<?= $anuncio_object->anuncio_id ?>" />
                           <input type="hidden" id="lat" name="lat" value="<?= $anuncio_object->lat ?>" />
                           <input type="hidden" id="lng" name="lng" value="<?= $anuncio_object->lng ?>" />
                           <input type="hidden" id="city_main" name="city_main" value="<?= $ciudad->name_ciudad ?>" />
                           <input type="hidden" id="pais" />
                           <input name="array_fotos" id="array_fotos" type="hidden" value="">
                           <button id="btn_update_anuncio" type="button" class="btn btn-theme pull-right"><?= translate('update_publi_lang') ?></button>
                        </div>
                     </div>

                  </div>
                  <!-- end post-ad-form-->

                  <!-- end col -->
                  <!-- Right Sidebar -->

                  <!-- Middle Content Area  End -->
                  <!-- end col -->
               </div>
               <!-- Row End -->
            </div>
            <div class="modal fade" id="myModal" role="dialog">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar imagen</h4>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="progress">
                              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                           </div>
                           <div class="col-lg-12">
                              <div class="img-container">
                                 <img style="width:75%" id="image">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <div style="width:33%; float:right">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="button" class="btn btn-primary" id="crop">Aceptar</button>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

            <!-- Main Container End -->
         </section>
         <div style="display:none" class="container">
            <h1>Upload cropped image to server</h1>
            <label class="label" data-toggle="tooltip" title="Change your avatar">
               <img class="rounded" id="avatar" src="https://avatars0.githubusercontent.com/u/3456749?s=160" alt="avatar">
               <input type="file" class="sr-only" id="input" name="image" accept="image/*">
            </label>
            <div class="alert" role="alert"></div>
         </div>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jIY1DdGJ7yWZrPDmhCiupu_K2En_4HY&libraries=places" async defer></script>
         <script src="<?= base_url('assets_front/js/cropper.js') ?>"></script>
         <script type="text/javascript">
            var peso_maximo = 4 * 1048576;
            var array_imagenes = [];
            var imagen_default = '<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>';
            var name_foto = '<?= $anuncio_object->photo ?>';
            var direccion_cargada = '<?= $anuncio_object->direccion ?>';
            var foto_main = '<?= base_url($anuncio_object->photo) ?>';
            var anuncio_id = '<?= $anuncio_object->anuncio_id ?>';
            var fotos_cargadas = '<?= json_encode($fotos_object) ?>';
            var lat = '<?= $anuncio_object->lat; ?>';
            var lng = '<?= $anuncio_object->lng; ?>';
            var imagen_click = -1;
            $(function() {
               setTimeout(() => {
                  cargar_city(city = "", lat, lng);
                  getReverseGeocodingData(lat, lng);
                  array_imagenes.push({
                     "id": name_foto,
                     "imagen": foto_main,
                     'foto_anuncio_id': anuncio_id,
                     'name': "image_0"
                  });
                  $('#span_delete_0').show();
                  $('#image_0').attr("src", foto_main);
                  $('#span_add_0').text("Portada");
                  fotos_cargadas = JSON.parse(fotos_cargadas);
                  if (fotos_cargadas.length > 0) {
                     var contador_fotos_cargadas = 1;
                     for (let i = 0; i < fotos_cargadas.length; i++) {
                        var id_cargado = contador_fotos_cargadas;
                        var cadena_name_cargada = "image_" + id_cargado;
                        $('#span_delete_' + id_cargado).show();
                        var foto_galeria = '<?= base_url() ?>' + fotos_cargadas[i].photo_anuncio;
                        $('#' + cadena_name_cargada).attr("src", foto_galeria);
                        $('#span_add_' + id_cargado).text("Cargada");
                        contador_fotos_cargadas++;
                        array_imagenes.push({
                           "id": fotos_cargadas[i].photo_anuncio,
                           "imagen": foto_galeria,
                           'foto_anuncio_id': fotos_cargadas[i].photo_anuncio_id,
                           'name': cadena_name_cargada
                        });
                     }
                  }
               }, 2000);
            })
            window.addEventListener('DOMContentLoaded', function() {

               //cargar_city(city = "", lat, lng);
               // getReverseGeocodingData(lat, lng);
               //    var avatar = document.getElementById('avatar');
               var image = document.getElementById('image');
               var input = document.getElementById('input');
               var input_imagen_0 = document.getElementById('add_image_0');
               var input_imagen_1 = document.getElementById('add_image_1');
               var input_imagen_2 = document.getElementById('add_image_2');
               var input_imagen_3 = document.getElementById('add_image_3');
               var input_imagen_4 = document.getElementById('add_image_4');
               var input_imagen_5 = document.getElementById('add_image_5');
               var input_imagen_6 = document.getElementById('add_image_6');
               var input_imagen_7 = document.getElementById('add_image_7');
               var input_imagen_8 = document.getElementById('add_image_8');
               var input_imagen_9 = document.getElementById('add_image_9');
               var $progress = $('.progress');
               var $progressBar = $('.progress-bar');
               var $alert = $('.alert');
               var $modal = $('#myModal');
               var cropper;
               var name_archivo;
               input_imagen_0.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_0") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_0") {
                              if (id_encontrado != -1) {
                                 //   array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 0;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_1.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {

                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_1") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_1") {
                              if (id_encontrado != -1) {
                                 //    array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 1;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_2.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_2") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_2") {
                              if (id_encontrado != -1) {
                                 // array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 2;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_3.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_3") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_3") {
                              if (id_encontrado != -1) {
                                 // array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 3;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_4.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_4") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_4") {
                              if (id_encontrado != -1) {
                                 //   array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 4;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_5.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_5") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_5") {
                              if (id_encontrado != -1) {
                                 //    array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 5;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_6.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_6") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_6") {
                              if (id_encontrado != -1) {
                                 //  array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 6;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_7.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_7") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_7") {
                              if (id_encontrado != -1) {
                                 //  array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 7;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_8.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_8") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_8") {
                              if (id_encontrado != -1) {
                                 //  array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 8;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               input_imagen_9.addEventListener('change', function(e) {
                  var files = e.target.files;
                  var sizeByte = this.files[0].size;
                  var sizekiloBytes = parseInt(sizeByte / 1024);
                  var encontro = false;
                  var id_encontrado = -1;
                  var name_contenedor;
                  var repetido = false;
                  var valida_crear = false;
                  if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {
                     if (this.files[0].size < peso_maximo) {
                        if (array_imagenes.length > 0) {
                           for (let i = 0; i < array_imagenes.length; i++) {
                              if (array_imagenes[i].name == "image_9") {
                                 encontro = true;
                                 id_encontrado = i;
                                 name_contenedor = array_imagenes[i].name;
                              }
                              if (array_imagenes[i].id == this.files[0].name) {
                                 encontro = true;
                                 repetido = true;
                              }
                           }
                        } else {
                           valida_crear = true;
                        }
                        if (encontro && !repetido) {
                           if (name_contenedor == "image_9") {
                              if (id_encontrado != -1) {
                                 //  array_imagenes.splice(id_encontrado, 1);
                                 valida_crear = true;
                              }
                           }
                        } else if (encontro && repetido) {
                           Swal.fire({
                              icon: 'info',
                              title: 'La imagen ya esta cargada',
                              showConfirmButton: true
                           });
                        } else if (!encontro && !repetido) {
                           valida_crear = true;
                        }
                        if (valida_crear) {
                           imagen_click = 9;
                           name_archivo = this.files[0].name;
                           var done = function(url) {
                              input.value = '';
                              image.src = url;
                              $alert.hide();
                              $modal.modal({
                                 backdrop: 'static',
                                 keyboard: false
                              });
                           };
                           var reader;
                           var file;
                           var url;

                           if (files && files.length > 0) {
                              file = files[0];
                              if (URL) {
                                 done(URL.createObjectURL(file));
                              } else if (FileReader) {
                                 reader = new FileReader();
                                 reader.onload = function(e) {
                                    done(reader.result);
                                 };
                                 reader.readAsDataURL(file);
                              }
                           }
                        }

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'La imagen supera el peso máximo de 4MB',
                           showConfirmButton: true,
                        });
                     }
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                        showConfirmButton: true
                     });
                  }
               });

               $modal.on('shown.bs.modal', function() {
                  cropper = new Cropper(image, {
                     aspectRatio: 1,
                     viewMode: 3,
                  });
               }).on('hidden.bs.modal', function() {
                  cropper.destroy();
                  cropper = null;
               });

               document.getElementById('crop').addEventListener('click', function() {
                  var initialAvatarURL;
                  var canvas;
                  $modal.modal('hide');
                  if (cropper) {
                     canvas = cropper.getCroppedCanvas({
                        width: 645,
                        height: 645,
                     });
                     initialAvatarURL = avatar.src;
                     avatar = canvas.toDataURL();
                     if (array_imagenes.length > 0) {
                        if (typeof array_imagenes[imagen_click] !== 'undefined') {
                           $('#image_' + imagen_click).attr("src", avatar);
                           $('#span_delete_' + imagen_click).show();
                           if (imagen_click == 0) {
                              $('#span_add_' + imagen_click).text("Portada");
                           } else {
                              $('#span_add_' + imagen_click).text("Cargada");
                           }
                           array_imagenes[imagen_click].foto_anuncio_id = null;
                           array_imagenes[imagen_click].id = name_archivo;
                           array_imagenes[imagen_click].imagen = avatar;
                        } else {
                           var indice = array_imagenes.length;
                           $('#image_' + indice).attr("src", avatar);
                           $('#span_delete_' + indice).show();
                           $('#span_add_' + indice).text("Cargada");
                           array_imagenes.push({
                              "id": name_archivo,
                              "imagen": avatar,
                              'foto_anuncio_id': null,
                              'name': "image_" + indice
                           });
                        }
                     } else {
                        $('#image_0').attr("src", avatar);
                        $('#span_delete_0').show();
                        $('#span_add_0').text("Portada");
                        array_imagenes.push({
                           "id": name_archivo,
                           "imagen": avatar,
                           'foto_anuncio_id': null,
                           'name': "image_0"
                        });
                     }
                     Swal.fire({
                        icon: 'success',
                        title: 'La imagen se ha subido correctamente',
                        showConfirmButton: false,
                        timer: 1500
                     });
                     // $progress.show();
                  }
               });
            });

            function delete_image_0() {

               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_0") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_1() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_1") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_2() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_2") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_3() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_3") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_4() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_4") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_5() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_5") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_6() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_6") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_7() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_6") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_8() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_8") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function delete_image_9() {
               var id_encontrado = -1;
               for (let i = 0; i < array_imagenes.length; i++) {
                  if (array_imagenes[i].name == "image_9") {
                     id_encontrado = i;
                  }
               }
               if (id_encontrado != -1) {
                  array_imagenes.splice(id_encontrado, 1);
                  for (let i = 0; i < 10; i++) {
                     $('#image_' + i).attr("src", imagen_default);
                     $('#add_image_' + i).val("");
                     $('#span_delete_' + i).hide();
                     $('#span_add_' + i).html('<i class="fa fa-upload" aria-hidden="true"></i> Agregar imagen');
                  }
                  if (array_imagenes.length > 0) {
                     array_imagenes.forEach(function(item, index, array) {
                        item.name = "image_" + index;
                        $('#image_' + index).attr("src", item.imagen);
                        $('#span_delete_' + index).show();
                        if (index == 0) {
                           $('#span_add_' + index).text("Portada");
                        } else {
                           $('#span_add_' + index).text("Cargada");
                        }
                     });
                  }
                  Swal.fire({
                     icon: 'success',
                     title: 'La imagen se eliminó correctamente',
                     showConfirmButton: false,
                     timer: 1500
                  });
               }
            }

            function llamar_add_imagen_0() {
               $('#add_image_0').click();
               imagen_click = 0;
            }

            function llamar_add_imagen_1() {
               $('#add_image_1').click();
               imagen_click = 1;
            }

            function llamar_add_imagen_2() {
               $('#add_image_2').click();
               imagen_click = 2;
            }

            function llamar_add_imagen_3() {
               $('#add_image_3').click();
               imagen_click = 3;
            }

            function llamar_add_imagen_4() {
               $('#add_image_4').click();
               imagen_click = 4;
            }

            function llamar_add_imagen_5() {
               $('#add_image_5').click();
               imagen_click = 5;
            }

            function llamar_add_imagen_6() {
               $('#add_image_6').click();
               imagen_click = 6;
            }

            function llamar_add_imagen_7() {
               $('#add_image_7').click();
               imagen_click = 7;
            }

            function llamar_add_imagen_8() {
               $('#add_image_8').click();
               imagen_click = 8;
            }

            function llamar_add_imagen_9() {
               $('#add_image_9').click();
               imagen_click = 9;
            }

            function getReverseGeocodingData(lat, lng) {
               var latlng = new google.maps.LatLng(lat, lng);
               // This is making the Geocode request
               var geocoder = new google.maps.Geocoder();
               geocoder.geocode({
                  'latLng': latlng
               }, function(results, status) {
                  if (status !== google.maps.GeocoderStatus.OK) {
                     alert(status);
                  }
                  // This is checking to see if the Geoeode Status is OK before proceeding
                  if (status == google.maps.GeocoderStatus.OK) {

                     var address = (results[0].formatted_address);
                     var arrayDeCadenas = address.split(",");
                     $('#pac-input').val(address);
                     if (arrayDeCadenas) {
                        if (arrayDeCadenas.length > 0) {
                           var pais = arrayDeCadenas[arrayDeCadenas.length - 1];

                           $('#pais').val(pais);

                        }
                     }

                     var nombre_pais = 'Ecuador';
                     var seleccion_pais = $('#pais').val().trim();

                     if (nombre_pais != seleccion_pais) {
                        $('#pac-input').val("");
                        $('#pais').val("");
                        $('#error_ubicacion').text("Lo sentimos solo estamos displonibes en Ecuador");
                        $('#modal_error_ciudad').modal('show');
                        cargar_city(city = "", lat, lng);
                     }

                  }
               });
            }

            $("#btn_update_anuncio").click(async function() {
               var titulo = $('#titulo');
               var categoria = $('#categoria');
               var subcategoria = $('#subcategoria');
               var precio = $('#precio');
               var whatsapp = $('#whatsapp');
               var decripcion = $('#descripcion');
               var seleccion_pais = $('#pais').val().trim();
               if (titulo.val().trim() == "") {
                  Swal.fire({
                     icon: 'info',
                     title: titulo.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (result.isConfirmed) {
                        titulo.focus();
                     } else {
                        titulo.focus();
                     }
                  });
               } else if (categoria.val() == "0") {
                  Swal.fire({
                     icon: 'info',
                     title: categoria.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (result.isConfirmed) {
                        categoria.focus();
                     } else {
                        categoria.focus();
                     }
                  });
               } else if (subcategoria.val() == "0") {
                  Swal.fire({
                     icon: 'info',
                     title: subcategoria.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (subcategoria.isConfirmed) {
                        subcategoria.focus();
                     } else {
                        subcategoria.focus();
                     }
                  });
               } else if (precio.val().trim() == "") {
                  Swal.fire({
                     icon: 'info',
                     title: precio.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (result.isConfirmed) {
                        precio.focus();
                        precio.blur(function() {
                           precio.focus();
                        });
                     } else {
                        precio.focus();
                     }
                  });
               } else if (whatsapp.val().trim() == "") {
                  Swal.fire({
                     icon: 'info',
                     title: whatsapp.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (result.isConfirmed) {
                        whatsapp.focus();
                     } else {
                        whatsapp.focus();
                     }
                  });
               } else if (decripcion.val().trim() == "") {
                  Swal.fire({
                     icon: 'info',
                     title: decripcion.prop('placeholder') + ' es un campo requerido',
                     showConfirmButton: true
                  }).then((result) => {
                     if (result.isConfirmed) {
                        decripcion.focus();

                     } else {
                        decripcion.focus();

                     }
                  });
               } else if (array_imagenes.length == 0) {
                  Swal.fire({
                     icon: 'info',
                     title: 'No hay imagenes cargadas',
                     showConfirmButton: true
                  });
               } else if (seleccion_pais == "") {
                  $('#pac-input').val("");
                  initMap();
               } else if (seleccion_pais != "Ecuador") {
                  $('#error_ubicacion').text("Lo sentimos solo estamos displonibes en Ecuador");
                  $('#modal_error_ciudad').modal('show');
                  initMap();
                  $('#btn_update_anuncio').prop('disabled', false);
               } else {
                  swal.fire({
                     title: '',
                     html: '<div class="save_loading"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div><div><h4 id="mensajeAlert">Actualizando el anuncio...</h4></div>',
                     showConfirmButton: false,
                     allowOutsideClick: false,
                     footer: '<h6>No realice acciones sobre la página</h6>'
                  });
                  $('#btn_update_anuncio').prop('disabled', true);
                  var latAds = $("#lat").val();
                  var lngAds = $('#lng').val();
                  var cityAds = $('#city_main').val();
                  var addressAds = $('#pac-input').val();
                  var photoMain = array_imagenes[0];
                  setTimeout(async () => {
                     var resultCreateAds = await updateAds(anuncio_id, titulo.val().trim(), categoria.val(), subcategoria.val(), precio.val().trim(), whatsapp.val().trim(), decripcion.val().trim(), JSON.stringify(photoMain), cityAds, latAds, lngAds, addressAds)
                     resultCreateAds = JSON.parse(resultCreateAds);
                     if (resultCreateAds.status == 404) {
                        $('#btn_update_anuncio').prop('disabled', false);
                        Swal.fire({
                           icon: 'info',
                           title: 'Lo sentimos esta opción solo esta disponible para los clientes',
                           showConfirmButton: true
                        });
                     } else if (resultCreateAds.status == 500) {
                        $('#btn_update_anuncio').prop('disabled', false);
                        Swal.fire({
                           icon: 'info',
                           title: 'Lo sentimos esta opción solo esta disponible para los clientes registrados',
                           showConfirmButton: true
                        });
                     } else {
                        $('#mensajeAlert').text("Actualizando imagenes...");
                        setTimeout(async () => {
                           array_imagenes.splice(0, 1);
                           resultPhoto = await updatePhoto(resultCreateAds.id, JSON.stringify(array_imagenes));
                           resultPhoto = JSON.parse(resultPhoto);
                           if (resultPhoto.status == 200) {
                              setTimeout(() => {
                                 window.location = '<?= site_url("perfil/page") ?>';
                              }, 1000);
                              Swal.fire({
                                 icon: 'success',
                                 title: 'Anuncio actualizado correctamente',
                                 showConfirmButton: false,
                                 timer: 1500
                              });
                           } else {
                              Swal.fire({
                                 icon: 'error',
                                 title: 'Ocurrido un error vuelva a intentarlo',
                                 showConfirmButton: false,
                                 timer: 1500
                              }).then((result) => {
                                 if (result.isConfirmed) {
                                    location.reload();
                                 } else {
                                    location.reload();
                                 }
                              });
                           }
                        }, 2000);
                     }
                  }, 2000);
               }
            });

            async function updateAds(anuncioId, titulo, categoria, subcategoria, precio, whatsapp, descripcion, photo, city_main, lat, lng, pac_input) {
               return $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/update_anuncio') ?>",
                  data: {
                     anuncioId,
                     titulo,
                     categoria,
                     subcategoria,
                     precio,
                     whatsapp,
                     descripcion,
                     photo,
                     city_main,
                     lat,
                     lng,
                     pac_input
                  },
                  success: function(result) {
                     result = JSON.parse(result);
                  }
               })
            }

            async function updatePhoto(id, photos) {
               return $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/update_photo_anuncio') ?>",
                  data: {
                     id,
                     photos
                  },
                  success: function(result) {
                     result = JSON.parse(result);
                  }
               })
            }

            function change_categoria() {
               var a = $("select[name=categoria]").val();
               $('#subcategoria').empty();
               $.ajax({
                  type: 'POST',
                  url: "<?= site_url('front/get_subcate') ?>",
                  data: {
                     categoria_id: a
                  },
                  success: function(result) {
                     result = JSON.parse(result);
                     var cadena = "";
                     for (let i = 0; i < result.length; i++) {
                        cadena = cadena + "<option value='" + result[i].subcate_id + "'>" + result[i].nombre + "</option>";
                     }
                     $('#subcategoria').html(cadena);
                  }
               });
            }


            function change_pais() {

               var nuevo = $("select[name=pais]").val();

               $('#ciudad').empty();
               $.ajax({

                  type: 'POST',
                  url: "<?= site_url('front/get_ciudad') ?>",
                  data: {

                     pais_id: nuevo
                  },

                  success: function(result) {
                     result = JSON.parse(result);

                     var cadena = "";
                     cadena = "<label><?= translate('listar_city_lang'); ?></label><div  class='input-group'><span class='input-group-addon'><i class='fa fa-globe></i></span><select id='ciudad' name='ciudad class='form-control select2'>";

                     for (let i = 0; i < result.length; i++) {

                        cadena = cadena + "<option value ='" + result[i].ciudad_id + "'>" + result[i].name_ciudad + "</option>";

                     }

                     cadena = cadena + "</select></div>"

                     $('#ciudad').html(cadena);

                     cargar_city(result[0].name_ciudad.toUpperCase(), 0, 0);

                  }

               });

            }

            function cargar_city(city = "", lat, lng) {

               if (city == "") {
                  var ciudad = $('#ciudad option:selected').text().toUpperCase();

                  initMap(ciudad, lat, lng);
               } else {
                  initMap(city, lat, lng);
               }

            }
            const cargaInicial = async () => {
               initMap("Ecuador", "", "");
            }
            //Funcion principal
            function initMap(city, lat, lng) {

               //      $('#pac-input').val("");

               $.ajax({
                  url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + city + ",+EC&key=AIzaSyCxSjmDtXEki2dmimctXMPd5y-FQrZpGmQ",
                  dataType: 'json',
                  success: function(response) {
                     if (lat != 0 && lng != 0) {

                        var pos = {
                           lat: parseFloat(lat),

                           lng: parseFloat(lng)
                        };
                     } else {
                        var pos = {
                           lat: parseFloat(response.results[0].geometry.location.lat),

                           lng: parseFloat(response.results[0].geometry.location.lng)
                        };
                     }

                     var map = new google.maps.Map(document.getElementById('map'), {
                        center: pos,
                        scrollwheel: false,
                        zoom: 13
                     });
                     var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable: true
                     });
                     marker.addListener("dragend", function() {
                        var currentLocation = marker.getPosition();
                        var lat = currentLocation.lat(); //latitude
                        var lng = currentLocation.lng(); //longitude
                        search_city(lat, lng);
                        getReverseGeocodingData2(lat, lng);
                        $('#lat').val(lat);
                        $('#lng').val(lng);
                        map.setZoom(16);
                        map.setCenter(currentLocation);

                     });

                     // Create the search box and link it to the UI element.
                     var input = document.getElementById('pac-input');
                     var searchBox = new google.maps.places.SearchBox(input);
                     // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                     $('#lat').val(pos.lat);
                     $('#lng').val(pos.lng);
                     $('#pac-input').val(direccion_cargada);
                     // Bias the SearchBox results towards current map's viewport.
                     map.addListener('bounds_changed', function() {

                        searchBox.setBounds(map.getBounds());
                     });

                     var markers = [];

                     // Listen for the event fired when the user selects a prediction and retrieve
                     // more details for that place.
                     searchBox.addListener('places_changed', function() {
                        var places = searchBox.getPlaces();

                        if (places.length == 0) {
                           return;
                        }

                        // Clear out the old markers.
                        markers.forEach(function(marker) {
                           marker.setMap(null);
                        });
                        //  marker = [];

                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function(place) {
                           if (!place.geometry) {
                              console.log("Returned place contains no geometry");
                              return;
                           }
                           var icon = {
                              url: "https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png",
                              size: new google.maps.Size(71, 71),
                              origin: new google.maps.Point(0, 0),
                              anchor: new google.maps.Point(17, 34),
                              scaledSize: new google.maps.Size(25, 25)
                           };

                           if (marker === false) {

                              marker = new google.maps.Marker({
                                 position: place.geometry.location,
                                 map: map,
                                 draggable: true //make it draggable
                              });
                           } else {

                              marker.setPosition(place.geometry.location);


                           }


                           if (place.geometry.viewport) {
                              // Only geocodes have viewport.
                              bounds.union(place.geometry.viewport);
                           } else {

                              bounds.extend(place.geometry.location);
                           }
                        });

                        map.fitBounds(bounds);

                        var currentLocation = marker.getPosition();
                        var lat = currentLocation.lat(); //latitude
                        var lng = currentLocation.lng(); //longitude
                        $('#lat').val(lat);
                        $('#lng').val(lng);
                        getReverseGeocodingData2(lat, lng);
                        search_city(lat, lng);
                        google.maps.event.addListener(marker, 'dragend', function(event) {

                           var currentLocation = marker.getPosition();
                           var lat = currentLocation.lat(); //latitude
                           var lng = currentLocation.lng(); //longitude
                           $('#lat').val(lat);
                           $('#lng').val(lng);
                           search_city(lat, lng);
                           getReverseGeocodingData2(lat, lng)
                        });

                     });


                     //Listen for any clicks on the map.
                     google.maps.event.addListener(map, 'click', function(event) {

                        //Get the location that the user clicked.
                        var clickedLocation = event.latLng;

                        //If the marker hasn't been added.
                        if (marker === false) {
                           //Create the marker.
                           marker = new google.maps.Marker({
                              position: clickedLocation,
                              map: map,
                              draggable: true //make it draggable
                           });
                           //Listen for drag events!
                           google.maps.event.addListener(marker, 'dragend', function(event) {
                              // markerLocation();.

                              var currentLocation = marker.getPosition();
                              var lat = currentLocation.lat(); //latitude
                              var lng = currentLocation.lng(); //longitude

                           });

                        } else {

                           //Marker has already been added, so just change its location.
                           marker.setPosition(clickedLocation);


                        }
                        //Get the marker's location.
                        markerLocation();


                        //This function will get the marker's current location and then add the lat/long
                        //values to our textfields so that we can save the location.
                        function markerLocation() {
                           //Get location.
                           var currentLocation = marker.getPosition();
                           var lat = currentLocation.lat(); //latitude
                           var lng = currentLocation.lng(); //longitude
                           var geocoder = new google.maps.Geocoder;
                           var infowindow = new google.maps.InfoWindow;
                           search_city(lat, lng);
                           getReverseGeocodingData2(lat, lng);
                           $('#lat').val(lat);
                           $('#lng').val(lng);

                        }


                     });



                     function getReverseGeocodingData2(lat, lng) {
                        var latlng = new google.maps.LatLng(lat, lng);
                        // This is making the Geocode request
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({
                           'latLng': latlng
                        }, function(results, status) {
                           if (status !== google.maps.GeocoderStatus.OK) {
                              alert(status);
                           }
                           // This is checking to see if the Geoeode Status is OK before proceeding
                           if (status == google.maps.GeocoderStatus.OK) {

                              var address = (results[0].formatted_address);
                              var arrayDeCadenas = address.split(",");
                              $('#pac-input').val(address);
                              if (arrayDeCadenas) {
                                 if (arrayDeCadenas.length > 0) {
                                    var pais = arrayDeCadenas[arrayDeCadenas.length - 1];
                                    alert(pais)
                                    $('#pais').val(pais);

                                 }
                              }

                              var nombre_pais = 'Ecuador';
                              var seleccion_pais = $('#pais').val().trim();

                              if (nombre_pais != seleccion_pais) {
                                 $('#pac-input').val("");
                                 $('#pais').val("");
                                 $('#error_ubicacion').text("Lo sentimos solo estamos displonibes en Ecuador");
                                 $('#modal_error_ciudad').modal('show');
                                 cargar_city(city = "", lat, lng);
                              }

                           }
                        });
                     }

                     function search_city(lat, lng) {
                        var latlng;
                        latlng = new google.maps.LatLng(lat, lng); // New York, US

                        new google.maps.Geocoder().geocode({
                           'latLng': latlng
                        }, function(results, status) {
                           if (status == google.maps.GeocoderStatus.OK) {
                              if (results[1]) {
                                 var country = null,
                                    countryCode = null,
                                    city = null,
                                    cityAlt = null;
                                 var c, lc, component;
                                 for (var r = 0, rl = results.length; r < rl; r += 1) {
                                    var result = results[r];

                                    if (!city && result.types[0] === 'locality') {
                                       for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                                          component = result.address_components[c];

                                          if (component.types[0] === 'locality') {
                                             city = component.long_name;
                                             break;
                                          }
                                       }
                                    } else if (!city && !cityAlt && result.types[0] === 'administrative_area_level_1') {
                                       for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                                          component = result.address_components[c];

                                          if (component.types[0] === 'administrative_area_level_1') {
                                             cityAlt = component.long_name;
                                             break;
                                          }
                                       }
                                    } else if (!country && result.types[0] === 'country') {
                                       country = result.address_components[0].long_name;
                                       countryCode = result.address_components[0].short_name;
                                    }

                                    if (city && country) {
                                       break;
                                    }
                                 }
                                 $("#city_main").val(city);
                                 // console.log("City: " + city + ", City2: " + cityAlt + ", Country: " + country + ", Country Code: " + countryCode);
                              }
                           }
                        });
                     }

                  }
               });
               $('#pac-input').val(direccion_cargada);

            }
         </script>
         <style>
            .postdetails label span {
               font-size: 12px;
               color: #777;
            }

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

            /* save success icon */

            #add_image_1 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_2 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_3 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_4 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_5 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_6 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_7 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_8 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_9 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            #add_image_0 {
               opacity: 0;
               position: absolute;
               z-index: -1;
            }

            h6 a:hover {
               color: #8c1822 !important;
            }

            h6 a {
               color: #000 !important;
            }

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