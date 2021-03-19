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
      <!-- =-=-=-=-=-=-= Advance Search =-=-=-=-=-=-= -->
      <div id="search-section">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12 col-xs-12 col-md-12">
                      <!-- Form -->
                      <?= form_open_multipart("search", array('class' => 'search-form')); ?>


                      <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                          <select name="category" class="category form-control">
                              <option label="<?= translate("select_category_lang"); ?>"></option>
                              <?php if ($categories) { ?>
                                  <?php foreach ($categories as $item) { ?>
                                      <option value="<?= $item->categoria_id ?>"><?= $item->name_espa ?></option>
                                  <?php } ?>

                              <?php } ?>

                          </select>
                      </div>
                      <!-- Search Field -->
                      <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                          <input name="subasta_palabra" type="text" class="form-control" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
                      </div>
                      <!-- Search Button -->
                      <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                          <button type="submit" class="btn btn-block btn-light"><?= translate("buscar_lang"); ?></button>
                      </div>

                      <?= form_close(); ?>
                      <!-- end .search-form -->
                  </div>
              </div>
          </div>
      </div>
      <!-- =-=-=-=-=-=-= Advance Search End  =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
          <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
          <section class="section-padding pattern_dots">
              <!-- Main Container -->
              <div class="container">
                  <!-- Row -->
                  <div class="row">
                      <!-- Middle Content Area -->
                      <div class="col-md-12 col-lg-12 col-sx-12">
                          <!-- Row -->

                          <div class="row">
                              <!-- Sorting Filters -->
                              <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                  <!-- Sorting Filters Breadcrumb -->
                                  <div class="filter-brudcrums">
                                      <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                      <div style="margin-top:1%" class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                              <div class="switcher pull-left">
                                                  <div style="margin-top:2%" class="col-lg-6 col-xs-12 text-center">
                                                      <a href="<?= site_url('subastas_directas') ?>" id="btn_subasta_directa_2" class="btn active btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-arrow-up"></i></span>
                                                          <font style="vertical-align: inherit;">
                                                              <font style="vertical-align: inherit;">
                                                                  <?= translate('subastas_directas_lang') ?>
                                                              </font>
                                                          </font>
                                                      </a>
                                                  </div>
                                                  <div style="margin-top:2%" class="col-lg-6 col-xs-12 text-center">
                                                      <a href="<?= site_url('subastas_inversas') ?>" id="btn_subasta_inversa_2" class="btn  btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-exchange"></i></span>
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
                                  </div>

                                  <!-- Sorting Filters Breadcrumb End -->
                              </div>
                              <!-- Sorting Filters End-->
                              <div class="clearfix"></div>
                              <!-- Ads Archive -->

                              <div class="posts-masonry">
                                  <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                      <ul class="list-unstyled">

                                          <?php $contador_directa = 0;
                                            $contador_inversa = 0;
                                            if ($all_subastas) { ?>
                                              <!-- Listing Grid -->
                                              <?php foreach ($all_subastas as $item) { ?>
                                                  <?php if ($item->tipo_subasta == 1) { ?>
                                                      <?php $contador_directa++; ?>
                                                      <li class="tipo_directa">

                                                      <?php } else if ($item->tipo_subasta == 2) { ?>
                                                          <?php $contador_inversa++; ?>

                                                      <li class="tipo_inversa">
                                                      <?php } ?>

                                                      <div class="well ad-listing clearfix">
                                                          <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                              <!-- Image Box -->
                                                              <div class="img-box">
                                                                  <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                                  <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                                  <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div>
                                                              </div>
                                                              <!-- Ad Status -->
                                                              <!--<span class="ad-status"> Featured </span>-->
                                                              <!-- User Preview -->

                                                          </div>
                                                          <div class="col-md-9 col-sm-7 col-xs-12">
                                                              <!-- Ad Content-->
                                                              <div class="row">
                                                                  <div class="content-area">
                                                                      <div class="col-md-9 col-sm-12 col-xs-12">
                                                                          <!-- Category Title -->

                                                                          <div class="category-title"> <span><a href="#"><?= $item->categoria ?></a></span>

                                                                          </div>


                                                                          <!-- Ad Title -->
                                                                          <h6><a><?= $item->nombre_espa ?></a> </h6>
                                                                          <!-- Info Icons -->

                                                                          <!-- Ad Meta Info -->
                                                                          <ul class="ad-meta-info">
                                                                              <li> <i class="fa fa-map-marker"></i><a href="#"><?= $item->ciudad ?></a> </li>
                                                                              <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                          </ul>
                                                                          <div class="row">
                                                                              <div class="col-md-12">
                                                                                  <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                      <div class="timer conte">
                                                                                          <span class="days" id="day_<?= $item->subasta_id ?>"></span>
                                                                                      </div>
                                                                                      <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                                                  </div>
                                                                                  <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                      <div class="timer conte">
                                                                                          <span class="hours" id="hour_<?= $item->subasta_id ?>"></span>
                                                                                      </div>
                                                                                      <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                                                  </div>
                                                                                  <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                      <div class="timer conte">
                                                                                          <span class="minutes" id="minute_<?= $item->subasta_id ?>"></span>
                                                                                      </div>
                                                                                      <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                                                  </div>
                                                                                  <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                      <div class="timer conte">
                                                                                          <span class="seconds" id="second_<?= $item->subasta_id ?>"></span>
                                                                                      </div>
                                                                                      <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>

                                                                          <!-- Ad Description-->
                                                                          <div class="ad-details">

                                                                              <?= $item->descrip_espa ?>


                                                                          </div>
                                                                          <?php if ($this->session->userdata('user_id')) { ?>
                                                                              <div class="row">

                                                                                  <?php if (!$item->subasta_user) { ?>
                                                                                      <div class="col-md-6">
                                                                                          <button onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                      </div>
                                                                                  <?php } ?>
                                                                                  <?php if ($item->subasta_user) { ?>
                                                                                      <div class="col-md-6">
                                                                                          <button onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                      </div>
                                                                                  <?php } ?>
                                                                              </div>
                                                                          <?php } ?>
                                                                      </div>
                                                                      <div class="col-md-3 col-xs-12 col-sm-12">
                                                                          <!-- Ad Stats -->

                                                                          <!-- Price -->
                                                                          <?php if ($item->subasta_user &&  $item->puja->valor > 0) { ?>
                                                                              <h6 class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                              <h5 class="text-center"><span id="valor_inicial_subasta" class="label label-success">$<?= number_format($item->puja->valor, 2) ?></span></h5>
                                                                          <?php } ?>
                                                                          <h6 class="text-center"><?= "Valor de entrada" ?></h6>
                                                                          <div class="price text-center"> <span>$ <?= number_format($item->valor_inicial, 2) ?></span> </div>
                                                                          <h6 class="text-center"><?= "Valor inicial" ?> </h6>
                                                                          <div class="price text-center"><span>$ <?= number_format($item->valor_pago, 2) ?></span> </div>
                                                                          <!-- Ad View Button -->

                                                                          <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <!-- Ad Content End -->
                                                          </div>
                                                      </div>
                                                      </li>
                                                  <?php } ?>
                                                  <!-- Listing Grid -->
                                              <?php } else { ?>
                                                  <p class="text-center"><?= translate("n_resultados"); ?></p>
                                              <?php } ?>



                                      </ul>
                                  </div>


                              </div>
                              <!-- Ads Archive End -->
                              <div class="clearfix"></div>
                              <!-- Pagination -->
                              <div class="col-md-12 col-xs-12 col-sm-12">
                                  <ul class="pagination pagination-lg">
                                      <?php echo $this->pagination->create_links(); ?>
                                  </ul>
                              </div>
                              <!-- Pagination End -->
                          </div>
                          <!-- Row End -->
                      </div>
                      <!-- Middle Content Area  End -->
                  </div>
                  <!-- Row End -->
              </div>
              <!-- Main Container End -->
          </section>
          <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

          <script>
              var subastas = <?= json_encode($all_subastas); ?>;
              let contador_inversa = <?= $contador_inversa ?>;
              contador_directa = <?= $contador_directa ?>;

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
                      $('#day_' + subastas[i].subasta_id).html(days);
                      $('#hour_' + subastas[i].subasta_id).html(hours);
                      $('#minute_' + subastas[i].subasta_id).html(minutes);
                      $('#second_' + subastas[i].subasta_id).html(seconds);

                      if (t < 0) {

                          clearInterval(x);

                          $('#day_' + subastas[i].subasta_id).html(0);
                          $('#hour_' + subastas[i].subasta_id).html(0);
                          $('#minute_' + subastas[i].subasta_id).html(0);
                          $('#second_' + subastas[i].subasta_id).html(0);

                      }

                  }, 1000);


              }
          </script>
          <style>
              .active_subasta {
                  display: none;
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