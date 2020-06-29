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
                              <?php echo form_open_multipart("front/update_anuncio") ?>
                              <div id="alert-message" class="alert alert-danger alert-dismissable" style="display: none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <h4><i class="icon fa fa-ban"></i> <?= translate('title_alert_message_lang'); ?></h4>
                                 <p></p>
                              </div>
                              <?= get_message_from_operation(); ?>


                              <div class="form-group">
                                 <label><?= translate("titulo_anun_lang"); ?></label>
                                 <input required placeholder="<?= translate('titulo_anun_lang'); ?>" class="form-control" type="text" name="titulo" value="<?= $anuncio_object->titulo ?>">
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
                                 <input required placeholder="<?= translate('precios_lang'); ?>" class="form-control" min="0" type="number" step="any" name="precio" value="<?= $anuncio_object->precio ?>">
                              </div>

                           </div>

                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <label><?= translate("phone_person__lang"); ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                                 </span>
                                 <input placeholder="<?= translate("phone_person__lang"); ?>" class="form-control" type="text" name="whatsapp" value="<?= $anuncio_object->whatsapp ?>">
                              </div>
                           </div>

                        </div>

                        <!-- end row -->
                        <!-- Image Upload  -->
                        <div class="row">
                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <label><?= translate("image_lang"); ?> (750x750)</label>
                              <input type="file" class="form-control input-sm" name="archivo" id="image_upload" placeholder="<?= translate('image_lang'); ?>">
                              <div id="dropzone" class="dropzone">
                                 <?php if (strpos($anuncio_object->photo, 'uploads') !== false) { ?>

                                    <img style="width: 15%;" class="img-responsive" src="<?= base_url($anuncio_object->photo) ?>" alt="">
                                 <?php } else { ?>
                                    <img style="width: 15%;" class="img-responsive" src="<?= $anuncio_object->photo ?>" alt="">

                                 <?php } ?>

                              </div>
                           </div>
                        </div>



                        <!-- end row -->
                        <!-- Ad Description  -->
                        <div class="row">
                           <div style="margin-bottom: -3%;" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label class="control-label"><?= translate('description_lang'); ?></label>
                                 <textarea name="descripcion" class="form-control textarea" required placeholder="<?= translate('description_lang'); ?>"><?= $anuncio_object->descripcion ?></textarea>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->

                        <div class="row">

                           <!-- <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <label><?= translate("listar_country_lang"); ?></label>
                        <div class="input-group">
                           <span class="input-group-addon"> <i class="fa fa-globe"></i></span>

                           <select onchange="change_pais();" id="pais" name="pais" class="form-control select2">

                              <?php
                              if (isset($all_pais))
                                 foreach ($all_pais as $item) { ?>
                                 <option <?php if ($ciudad->pais_id == $item->pais_id) { ?> selected <?php } ?> value="<?= $item->pais_id; ?>"><?= $item->name_pais; ?></option>
                              <?php } ?>
                           </select>

                        </div>
                     </div> -->

                           <!--         <div id="cuerpo_ciudades" class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <label><?= translate("listar_city_lang"); ?></label>
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                           <select onchange="cargar_city();" id="ciudad" name="ciudad" class="form-control select2">

                              <?php
                              if (isset($all_ciudad))
                                 foreach ($all_ciudad as $item) { ?>
                                 <option <?php if ($ciudad->ciudad_id == $item->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                              <?php } ?>
                           </select>


                        </div>

                     </div> -->



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
                           <button id="btn_update_anuncio" type="submit" class="btn btn-theme pull-right"><?= translate('update_publi_lang') ?></button>



                        </div>




                        <?= form_close(); ?>
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


            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jIY1DdGJ7yWZrPDmhCiupu_K2En_4HY&libraries=places" async defer></script>

         <script type="text/javascript">
            $(document).ready(function() {
               var lat = '<?php echo $anuncio_object->lat; ?>';
               var lng = '<?php echo $anuncio_object->lng; ?>';
               cargar_city(city = "", lat, lng);
            });
            $('#btn_update_anuncio').click(function() {
               var seleccion_pais = $('#pais').val().trim();
               if (seleccion_pais == "Ecuador") {
                  $("#form_add_anuncio").submit();
               } else if (seleccion_pais == "") {
                  $('#pac-input').val("");
               } else {
                  $('#error_ubicacion').text("Lo sentimos solo estamos displonibes en Ecuador");
                  $('#modal_error_ciudad').modal('show');
               }

            });

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


                     // Create the search box and link it to the UI element.
                     var input = document.getElementById('pac-input');
                     var searchBox = new google.maps.places.SearchBox(input);
                     // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                     $('#lat').val(pos.lat);
                     $('#lng').val(pos.lng);
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


            }
            /*   let FILETYPES = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/bmp', 'image/gif'];
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
              } */
         </script>
         <style>
            h6 a:hover {
               color: #8c1822 !important;
            }

            h6 a {
               color: #000 !important;
            }

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