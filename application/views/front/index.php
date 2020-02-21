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
                           <div style="margin-top:2%" class="col-lg-6 col-xs-12 text-center">
                              <a onclick="cambio_btn_directa();" id="btn_subasta_directa" class="btn active btn-theme">
                                 <span class="fa fa-arrow-up"></span>
                                 <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                       <?= translate('subastas_directas_lang') ?>
                                    </font>
                                 </font>
                              </a>
                           </div>
                           <div style="margin-top:2%" class="col-lg-6 col-xs-12 text-center">
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
                        <?php if ($all_categorias[0]->count_directa == 0) { ?>
                           <p style="display:none" class="text-center mensaje_directa"><?= translate('mensaje_directa_lang') ?></p>
                        <?php } ?>
                        <?php if ($all_categorias[0]->count_inversa == 0) { ?>
                           <p style="display:none" class="text-center mensaje_inversa"><?= translate('mensaje_inversa_lang') ?></p>
                        <?php } ?>
                        <?php for ($k = 0; $k < count($all_categorias[0]->all_subastas); $k++) { ?>
                           <?php if ($all_categorias[0]->all_subastas[$k]->tipo_subasta == 1) { ?>

                              <div class="col-md-4 col-xs-12 col-sm-6 direct subastas">

                                 <!-- Ad Box -->
                                 <div class="category-grid-box">
                                    <!-- Ad Img -->
                                    <div class="category-grid-img">
                                       <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                       <!-- Ad Status <span class="ad-status"> Destacado </span>-->
                                       <!-- User Review -->
                                       <div class="user-preview">
                                          <!-- <a href="#"> <img src="images/users/7.jpg" class="avatar avatar-small" alt=""> </a>-->
                                       </div>
                                       <div class="additional-information">
                                          <?= $all_categorias[0]->all_subastas[$k]->descrip_espa ?>
                                       </div>

                                    </div>
                                    <!-- Ad Img End -->
                                    <div class="short-description">
                                       <!-- Ad Category -->
                                       <div class="category-title"> <span><a href="#"><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                       <!-- Ad Title -->
                                       <h6><a title="" href="single-page-listing.html"><?= $all_categorias[0]->all_subastas[$k]->nombre_espa ?></a></h6>
                                       <!-- Price -->
                                       <div class="price"> $<?= number_format($all_categorias[0]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                       <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                       <?php if ($all_categorias[0]->all_subastas[0]->fecha_cierre >= date("Y-m-d H:i:s")) { ?>
                                          <div class="row">
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
                                          </div>
                                       <?php } ?>
                                    </div>
                                    <!-- Addition Info -->
                                    <div class="ad-info">
                                       <ul>
                                          <li><i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?></li>
                                          <li><button onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                       </ul>
                                    </div>
                                 </div>
                                 <!-- Ad Box End -->
                              </div>

                           <?php } else { ?>
                              <?php $count_intervalo = count($all_categorias[0]->all_subastas[$k]->intervalo); ?>
                              <?php if ($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                 <div style="display:none" class="col-md-4 col-xs-12 col-sm-6 subastas inverse">

                                    <!-- Ad Box -->
                                    <div class="category-grid-box">
                                       <!-- Ad Img -->
                                       <div class="category-grid-img">
                                          <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                          <!-- Ad Status <span class="ad-status"> Destacado </span>-->
                                          <!-- User Review -->
                                          <div class="user-preview">
                                             <!-- <a href="#"> <img src="images/users/7.jpg" class="avatar avatar-small" alt=""> </a>-->
                                          </div>
                                          <div class="additional-information">
                                             <?= $all_categorias[0]->all_subastas[$k]->descrip_espa ?>
                                          </div>

                                       </div>

                                       <!-- Ad Img End -->
                                       <div class="short-description">
                                          <!-- Ad Category -->
                                          <div class="category-title"> <span><a href="#"><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                          <!-- Ad Title -->
                                          <h6><a title="" href="single-page-listing.html"><?= $all_categorias[0]->all_subastas[$k]->nombre_espa ?></a></h6>
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

                                          <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->fecha ?> </span> </div>
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
                              <p style="display:none" class="text-center mensaje_directa"><?= translate('mensaje_directa_lang') ?></p>
                           <?php } ?>
                           <?php if ($all_categorias[$i]->count_inversa == 0) { ?>
                              <p style="display:none" class="text-center mensaje_inversa"><?= translate('mensaje_inversa_lang') ?></p>
                           <?php } ?>
                           <?php for ($k = 0; $k < count($all_categorias[$i]->all_subastas); $k++) { ?>
                              <?php if ($all_categorias[$i]->all_subastas[$k]->tipo_subasta == 1) { ?>

                                 <div class="col-md-4 col-xs-12 col-sm-6 subastas direct">
                                    <!-- Ad Box -->
                                    <div class="category-grid-box">
                                       <!-- Ad Img -->
                                       <div class="category-grid-img">
                                          <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                          <!-- Ad Status <span class="ad-status"> Destacado </span>-->
                                          <!-- User Review -->
                                          <div class="user-preview">
                                             <!--      <a href="#"> <img src="images/users/7.jpg" class="avatar avatar-small" alt=""> </a> -->
                                          </div>
                                          <div class="additional-information">
                                             <?= $all_categorias[$i]->all_subastas[$k]->descrip_espa ?>
                                          </div>
                                       </div>
                                       <!-- Ad Img End -->
                                       <div class="short-description">
                                          <!-- Ad Category -->
                                          <div class="category-title"> <span><a href="#"><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                          <!-- Ad Title -->
                                          <h6><a title="" href=""><?= $all_categorias[$i]->all_subastas[$k]->nombre_espa ?></a></h6>
                                          <!-- Price -->
                                          <div class="price"> $<?= number_format($all_categorias[$i]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                          <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                          <?php if ($all_categorias[$i]->all_subastas[$k]->fecha_cierre >= date("Y-m-d H:i:s")) { ?>
                                             <div class="row">
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
                                             </div>
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
                                    <div style="display:none" class="col-md-4 col-xs-12 col-sm-6 subastas inverse">

                                       <!-- Ad Box -->
                                       <div class="category-grid-box">
                                          <!-- Ad Img -->
                                          <div class="category-grid-img">
                                             <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                             <!-- Ad Status <span class="ad-status"> Destacado </span>-->
                                             <!-- User Review -->
                                             <div class="user-preview">
                                                <!-- <a href="#"> <img src="images/users/7.jpg" class="avatar avatar-small" alt=""> </a>-->
                                             </div>
                                             <div class="additional-information">
                                                <?= $all_categorias[$i]->all_subastas[$k]->descrip_espa ?>
                                             </div>

                                          </div>

                                          <!-- Ad Img End -->
                                          <div class="short-description">
                                             <!-- Ad Category -->
                                             <div class="category-title"> <span><a href="#"><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                             <!-- Ad Title -->
                                             <h6><a title="" href="single-page-listing.html"><?= $all_categorias[$i]->all_subastas[$k]->nombre_espa ?></a></h6>
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
                                             <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->fecha ?> </span> </div>
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
               <?= form_open_multipart("front/buscar_anuncio", array('class' => 'search-form', 'id' => 'buscar_categoria')); ?>
               <ul class="popular-categories">
                  <?php foreach ($all_cate_anuncio as $item) {  ?>
                     <!-- <li><a href="#"><i><img  class="img-responsive img-rounded" src ="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( 0 )</span></a></li>-->
                     <li><a style="cursor:pointer" onclick="cargar_input('<?= $item->cate_anuncio_id ?>')"><i><img style="heigth:128px; width:128px; margin-left:38px;" class="img-responsive img-rounded" src="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( <?= $item->count ?> )</span></a></li>

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

      .bg-img {

         background: rgba(0, 0, 0, 0.6) url("<?= base_url($all_banners[0]->foto) ?>") no-repeat;
         background-position: 0px 0px;
         -webkit-background-size: cover;
         -moz-background-size: cover;
         -o-background-size: cover;
         background-size: cover;
         clear: both;
      }

      p a:hover {
         color: #8c1822 !important;
      }

      p a {
         color: #fff !important;
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
   <script>
      var subastas = <?= json_encode($all_subastas); ?>;

      for (let i = 0; i < subastas.length + 1; i++) {

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


      }


      function cargar_input(params) {
         $('#category').val(params);
         $("#buscar_categoria").submit();
      }
   </script>