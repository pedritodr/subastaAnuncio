      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
         <div class="master-slider ms-skin-default banner2" id="masterslider">
            <?php foreach ($all_banners as $item) { ?>
               <!--    <div class="ms-slide slide-1 imagen-banner" data-delay="5">
                  <img style="margin-top: 0px;" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="" alt="<?= $item->foto ?>" />
               </div> -->

               <div class="ms-slide">

                  <!-- slide background -->
                  <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" />

               </div>
            <?php } ?>
         </div>
      <?php } ?>
      <!-- end Master Slider -->

      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Home Tabs =-=-=-=-=-=-= -->
         <section class="home-tabs">
            <!-- Carousel
================================================== -->
            <!-- /.carousel -->
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="tabs-container">
                        <ul role="tablist" class="nav nav-tabs">
                           <li class="clearfix active">
                              <a onclick="detalle_categoria('<?= $all_categorias[0]->count_inversa ?>','<?= $all_categorias[0]->count_directa ?>')" data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[0]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[0]->photo) ?>" alt=""></i> </a>
                           </li>
                           <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
                              <!-- Category -->
                              <li class="clearfix">
                                 <a onclick="detalle_categoria('<?= $all_categorias[$i]->count_inversa ?>','<?= $all_categorias[$i]->count_directa ?>')" data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[$i]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[$i]->photo) ?>" alt=""></i> </a>
                              </li>
                              <!-- Category -->
                           <?php } ?>

                        </ul>
                        <div style="margin-top:1%" class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="switcher pull-left">
                                 <div style="margin-top:2%" class="col-lg-6 col-sm-6 col-xs-12 text-center">
                                    <a onclick="cambio_btn_directa();" id="btn_subasta_directa" class="btn active btn-theme">
                                       <span class="fa fa-arrow-up"></span>
                                       <font style="vertical-align: inherit;">
                                          <font style="vertical-align: inherit;">
                                             <?= translate('subastas_directas_lang') ?>
                                          </font>
                                       </font>
                                    </a>
                                 </div>
                                 <div style="margin-top:2%" class="col-lg-6 col-sm-6 col-xs-12 text-center">
                                    <a onclick="cambio_btn_inversa()" id="btn_subasta_inversa" class="btn  btn-theme">
                                       <span class="fa fa-exchange"></span>
                                       <font style="vertical-align: inherit;">
                                          <font style="vertical-align: inherit;">
                                             <?= translate('subastas_inversas_lang') ?>
                                          </font>
                                       </font>
                                    </a>
                                 </div>


                              </div>
                           </div>

                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                           <div id="<?= strtolower(seo_url($all_categorias[0]->name_espa)) ?>" class="row tab-pane active in fade">
                              <?php if ($all_categorias[0]->count_directa == 0 && $all_categorias[0]->count_inversa != 0) { ?>
                                 <p style="display:none" class="text-center mensaje_directa"><?= translate('mensaje_directa_lang') ?></p>
                              <?php } else if ($all_categorias[0]->count_directa != 0 &&  $all_categorias[0]->count_inversa == 0) { ?>
                                 <p style="display:none" class="text-center mensaje_inversa"><?= translate('mensaje_inversa_lang') ?></p>
                              <?php } else if ($all_categorias[0]->count_inversa == 0 && $all_categorias[0]->count_directa == 0) { ?>

                                 <p style="display:none" class="text-center mensaje_all"><?= translate('mensaje_subasta_lang') ?></p>
                              <?php } ?>
                              <?php for ($k = 0; $k < count($all_categorias[0]->all_subastas); $k++) { ?>
                                 <?php if ($all_categorias[0]->all_subastas[$k]->tipo_subasta == 1) { ?>

                                    <div class="col-md-3 col-xs-12 col-sm-3 direct subastas">

                                       <!-- Ad Box -->
                                       <div class="category-grid-box white category-grid-box-1 ">
                                          <!-- Ad Img -->
                                          <div class="category-grid-img">
                                             <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');">
                                                <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                             </div>

                                          </div>
                                          <!-- Ad Img End -->
                                          <div style="height: 174px !important;" class="short-description">
                                             <!-- Ad Category -->
                                             <div class="category-title"> <span><a><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                             <!-- Ad Title -->
                                             <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');"><?= $all_categorias[0]->all_subastas[$k]->titulo_corto ?></a></h6>
                                             <!-- Price -->
                                             <div class="price"> $<?= number_format($all_categorias[0]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                             <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                             <div class="category-title">Ubicación: <span> <i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?> </span> </div>

                                             <?php if ($all_categorias[0]->all_subastas[0]->fecha_cierre >= date("Y-m-d H:i:s")) { ?>
                                                <!--    <div class="row">
                                             <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                   <div class="timer conte">
                                                      <span class="days" id="day<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>"></span>
                                                   </div>
                                                   <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                </div>
                                                <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                                                   <div class="timer conte">
                                                      <span class="hours" id="hour<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>"></span>
                                                   </div>
                                                   <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                </div>
                                                <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                   <div class="timer conte">
                                                      <span class="minutes" id="minute<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>"></span>
                                                   </div>
                                                   <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                </div>
                                                <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                   <div class="timer conte">
                                                      <span class="seconds" id="second<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>"></span>
                                                   </div>
                                                   <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                </div>
                                             </div>
                                          </div> -->
                                             <?php } ?>
                                          </div>
                                          <!-- Addition Info -->
                                          <div class="ad-info">
                                             <ul>

                                                <li class="text-center"><button style="margin-left: 23%;" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                             </ul>
                                          </div>
                                       </div>
                                       <!-- Ad Box End -->
                                    </div>

                                 <?php } else { ?>
                                    <?php $count_intervalo = count($all_categorias[0]->all_subastas[$k]->intervalo); ?>
                                    <?php if ($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                       <div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">

                                          <!-- Ad Box -->
                                          <div class="category-grid-box white category-grid-box-1">
                                             <!-- Ad Img -->
                                             <div class="category-grid-img">
                                                <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');">
                                                   <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                                </div>

                                             </div>

                                             <!-- Ad Img End -->
                                             <div style="height: 174px !important;" class="short-description">
                                                <!-- Ad Category -->
                                                <div class="category-title"> <span><a href="#"><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                                <!-- Ad Title -->
                                                <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');"><?= $all_categorias[0]->all_subastas[$k]->titulo_corto ?></a></h6>
                                                <!-- Price -->
                                                <?php if ($count_intervalo >= 2) { ?>
                                                   <div class="price">
                                                      <b class="strikethrough" style=" font-size:16px !important; color:#2a3681 !important">$<?= number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 2]->valor, 2) ?></b> $<?= number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) ?>
                                                   </div>
                                                <?php } else { ?>
                                                   <div class="price">
                                                      $<?= number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) ?>
                                                   </div>
                                                <?php } ?>

                                                <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                                <div class="category-title">Stock: <span> <?= $all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad ?> </span> </div>
                                             </div>
                                             <!-- Addition Info -->
                                             <div class="ad-info">
                                                <ul>
                                                   <li><i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?></li>
                                                   <li><button onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                </ul>
                                             </div>
                                          </div>
                                          <!-- Ad Box End -->
                                       </div>
                                    <?php } ?>
                                 <?php } ?>

                              <?php } ?>


                           </div>

                           <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
                              <!-- tab content -->
                              <div id="<?= strtolower(seo_url($all_categorias[$i]->name_espa)) ?>" class="row tab-pane fade ">
                                 <?php if ($all_categorias[$i]->count_directa == 0) { ?>
                                    <p class="text-center mensaje_directa"><?= translate('mensaje_directa_lang') ?></p>
                                 <?php } ?>
                                 <?php if ($all_categorias[$i]->count_inversa == 0) { ?>
                                    <p style="display:none" class="text-center mensaje_inversa"><?= translate('mensaje_inversa_lang') ?></p>
                                 <?php } ?>
                                 <?php for ($k = 0; $k < count($all_categorias[$i]->all_subastas); $k++) { ?>
                                    <?php if ($all_categorias[$i]->all_subastas[$k]->tipo_subasta == 1) { ?>

                                       <div class="col-md-3 col-xs-12 col-sm-3 subastas direct">
                                          <!-- Ad Box -->
                                          <div class="category-grid-box  white category-grid-box-1">
                                             <!-- Ad Img -->
                                             <div class="category-grid-img">
                                                <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');">
                                                   <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                                </div>
                                             </div>
                                             <!-- Ad Img End -->
                                             <div style="height: 174px !important;" class="short-description">
                                                <!-- Ad Category -->
                                                <div class="category-title"> <span><a><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                                <!-- Ad Title -->
                                                <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');"><?= $all_categorias[$i]->all_subastas[$k]->titulo_corto ?></a></h6>
                                                <!-- Price -->
                                                <div class="price"> $<?= number_format($all_categorias[$i]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                                <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                                <?php if ($all_categorias[$i]->all_subastas[$k]->fecha_cierre >= date("Y-m-d H:i:s")) { ?>
                                                   <!--        <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                   <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                      <div class="timer conte">
                                                         <span class="days" id="day<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>"></span>
                                                      </div>
                                                      <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                   </div>
                                                   <div style="margin-left:-19px" class="timer col-md-3 col-xs-3">
                                                      <div class="timer conte">
                                                         <span class="hours" id="hour<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>"></span>
                                                      </div>
                                                      <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                   </div>
                                                   <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                      <div class="timer conte">
                                                         <span class="minutes" id="minute<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>"></span>
                                                      </div>
                                                      <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                   </div>
                                                   <div style="margin-left:-19px" class="timer col-md-3 col-xs-4">
                                                      <div class="timer conte">
                                                         <span class="seconds" id="second<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>"></span>
                                                      </div>
                                                      <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                   </div>
                                                </div>
                                             </div> -->
                                                <?php } ?>
                                             </div>
                                             <!-- Addition Info -->
                                             <div class="ad-info">
                                                <ul>
                                                   <li><i class="fa fa-map-marker"></i> <?= $all_categorias[$i]->all_subastas[$k]->name_ciudad ?></li>

                                                   <li><button onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                </ul>
                                             </div>
                                          </div>
                                          <!-- Ad Box End -->
                                       </div>

                                    <?php } else { ?>
                                       <?php $count_intervalo = count($all_categorias[$i]->all_subastas[$k]->intervalo); ?>
                                       <?php if ($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                          <div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">

                                             <!-- Ad Box -->
                                             <div class="category-grid-box  white category-grid-box-1">
                                                <!-- Ad Img -->
                                                <div class="category-grid-img">
                                                   <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');">
                                                      <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                                   </div>
                                                </div>

                                                <!-- Ad Img End -->
                                                <div style="height: 174px !important;" class="short-description">
                                                   <!-- Ad Category -->
                                                   <div class="category-title"> <span><a><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                                   <!-- Ad Title -->
                                                   <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');"><?= $all_categorias[$i]->all_subastas[$k]->titulo_corto ?></a></h6>
                                                   <!-- Price -->
                                                   <?php if ($count_intervalo >= 2) { ?>
                                                      <div class="price">
                                                         <b class="strikethrough" style=" font-size:16px !important; color:#2a3681 !important">$<?= number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 2]->valor, 2) ?></b> $<?= number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) ?>
                                                      </div>
                                                   <?php } else { ?>
                                                      <div class="price">
                                                         $<?= number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) ?>
                                                      </div>
                                                   <?php } ?>
                                                   <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                                   <div class="category-title">Stock: <span> <?= $all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad ?> </span> </div>
                                                </div>
                                                <!-- Addition Info -->
                                                <div class="ad-info">
                                                   <ul>
                                                      <li><i class="fa fa-map-marker"></i> <?= $all_categorias[$i]->all_subastas[$k]->name_ciudad ?></li>
                                                      <li><button onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                   </ul>
                                                </div>
                                             </div>
                                             <!-- Ad Box End -->
                                          </div>

                                       <?php } ?>
                                    <?php } ?>
                                 <?php } ?>

                              </div>

                           <?php } ?>


                        </div>
                        <!-- End Tab panes -->
                        <!-- Tab Content End -->
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- =-=-=-=-=-=-= Home Tabs End =-=-=-=-=-=-= -->
         <!-- =-=-=-=-=-=-= Popular Categories =-=-=-=-=-=-= -->
         <section class="section-padding gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Heading Area -->
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12">
                        <h3 class="main-title text-left">
                           <?= translate('categorie_popular_lang') ?>

                        </h3>
                     </div>
                  </div>
                  <!-- Middle Content Box -->
                  <div class="col-md-12 category-blocks">
                     <?= form_open_multipart("search_anuncios", array('class' => 'search-form', 'id' => 'buscar_categoria')); ?>
                     <ul class="popular-categories">
                        <?php foreach ($all_cate_anuncio as $item) {  ?>
                           <!-- <li><a href="#"><i><img  class="img-responsive img-rounded" src ="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( 0 )</span></a></li>-->
                           <li><a style="cursor:pointer" onclick="cargar_input('<?= $item->cate_anuncio_id ?>')"><i><img style="height:128px; width:128px; margin-left:38px;" class="img-responsive img-rounded" src="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( <?= $item->count ?> )</span></a></li>

                        <?php } ?>
                     </ul>
                     <input name="category" id="category" class="" type="hidden" value="">
                     <?= form_close(); ?>
                  </div>
                  <!-- Middle Content Box End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>

         <style>
            .strikethrough {
               position: relative;
            }

            .strikethrough:before {
               position: absolute;
               content: "";
               left: 0;
               top: 50%;
               right: 0;
               border-top: 1px solid;
               border-color: #8c1822;

               -webkit-transform: rotate(-10deg);
               -moz-transform: rotate(-10deg);
               -ms-transform: rotate(-10deg);
               -o-transform: rotate(-10deg);
               transform: rotate(-10deg);
            }

            /*
            .bg-img {

               background: rgba(0, 0, 0, 0.6) url("<?= base_url($all_banners[0]->foto) ?>") no-repeat;
               background-position: 0px 0px;
               -webkit-background-size: cover;
               -moz-background-size: cover;
               -o-background-size: cover;
               background-size: cover;
               clear: both;
            } */

            p a:hover {
               color: #8c1822 !important;
            }

            p a {
               color: #fff !important;
            }

        
         </style>
         <script>
            /*     var subastas = <?= json_encode($all_subastas); ?>;

      for (let i = 0; i < subastas.length; i++) {

         var x = setInterval(function() {
            var fecha = subastas[i].fecha_cierre;
            var deadline = new Date(fecha).getTime();
            var currentTime = new Date().getTime();
            var t = deadline - currentTime;
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((t % (1000 * 60)) / 1000);
            $('#day' + subastas[i].subasta_id).html(days);
            $('#hour' + subastas[i].subasta_id).html(hours);
            $('#minute' + subastas[i].subasta_id).html(minutes);
            $('#second' + subastas[i].subasta_id).html(seconds);

            if (t < 0) {

               clearInterval(x);

               $('#day' + subastas[i].subasta_id).html(0);
               $('#hour' + subastas[i].subasta_id).html(0);
               $('#minute' + subastas[i].subasta_id).html(0);
               $('#second' + subastas[i].subasta_id).html(0);

            }

         }, 1000);


      } */


            function cargar_input(params) {
               $('#category').val(params);
               $("#buscar_categoria").submit();
            }
         </script>