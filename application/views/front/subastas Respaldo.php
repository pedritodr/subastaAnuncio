<div class="container">
<br>    <br><br><br><br>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Collapsible Group 1</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Collapsible Group 2</a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Collapsible Group 3</a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
            </div>
        </div>
    </div> 
</div>


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

                      <?= form_open_multipart("search_subasta_directa", array('class' => 'search-form', 'method' => 'post')); ?>


                      <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                          <select name="subasta_ciudad_id" class="category form-control">
                              <option label="<?= translate("select_category_lang"); ?>"></option>
                              <option value="0">TODAS LAS CIUDADES </option>
                              <?php if ($all_ciudad) { ?>
                                  <?php foreach ($all_ciudad as $item) { ?>
                                      <?php if ($this->session->userdata('session_ciudad_subasta')) { ?>
                                          <option <?php if ($this->session->userdata('session_ciudad_subasta') == $item->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                      <?php  } else { ?>
                                          <option value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                      <?php } ?>

                                  <?php } ?>

                              <?php } ?>

                          </select>
                      </div>
                      <!-- Search Field -->
                      <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                          <input name="tipo_subasta" id="tipo_subasta" type="hidden" value="<?= $tipo ?>">
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
                      <div class="col-md-9 col-md-push-3 col-lg-9 col-sx-12 white-bg">
                          <!-- Row -->

                          <div class="row">
                              <!-- Sorting Filters -->
                              <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                  <!-- Sorting Filters Breadcrumb -->
                                  <div class="filter-brudcrums">
                                      <?php if ($all_subastas) { ?>
                                          <?php if (count($all_subastas) > 0) { ?>
                                              <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                          <?php } ?>
                                      <?php } ?>
                                      <div style="margin-top:1%" class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                              <div style="margin-top:2%" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
                                                  <?php if ($this->session->userdata('session_palabra') || $this->session->userdata('session_categoria')) { ?>
                                                      <a href="<?= site_url('search_subasta_directa') ?>" id="btn_subasta_directa_2" class="btn btn-block active btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-arrow-up"></i></span>
                                                          <font style="vertical-align: inherit;">
                                                              <font style="vertical-align: inherit;">
                                                                  <?= translate('subastas_directas_lang') ?>
                                                              </font>
                                                          </font>
                                                      </a>
                                                  <?php } else { ?>
                                                      <a href="<?= site_url('subastas_directas') ?>" id="btn_subasta_directa_2" class="btn btn-block active btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-arrow-up"></i></span>
                                                          <font style="vertical-align: inherit;">
                                                              <font style="vertical-align: inherit;">
                                                                  <?= translate('subastas_directas_lang') ?>
                                                              </font>
                                                          </font>
                                                      </a>
                                                  <?php } ?>
                                              </div>
                                              <div style="margin-top:2%" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
                                                  <?php if ($this->session->userdata('session_palabra') || $this->session->userdata('session_categoria')) { ?>
                                                      <a href="<?= site_url('search_subasta_inversa') ?>" id="btn_subasta_inversa_2" class="btn btn-block btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-exchange"></i></span>
                                                          <font style="vertical-align: inherit;">
                                                              <font style="vertical-align: inherit;">
                                                                  <?= translate('subastas_inversas_lang') ?>
                                                              </font>
                                                          </font>
                                                      </a>
                                                  <?php } else { ?>
                                                      <a href="<?= site_url('subastas_inversas') ?>" id="btn_subasta_inversa_2" class="btn btn-block btn-theme">
                                                          <span><i style="color:#fff" class="fa fa-exchange"></i></span>
                                                          <font style="vertical-align: inherit;">
                                                              <font style="vertical-align: inherit;">
                                                                  <?= translate('subastas_inversas_lang') ?>
                                                              </font>
                                                          </font>
                                                      </a>
                                                  <?php } ?>
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
                                                      <li>
                                                          <div class="well ad-listing clearfix">
                                                              <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                                  <!-- Image Box -->
                                                                  <div style="cursor:pointer" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');" class="img-box">
                                                                      <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                                      <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                                      <!--    <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div> -->
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

                                                                              <div class="category-title"> <span><a><?= $item->categoria ?></a></span>
                                                                                  <span style="display:none" id="span_subasta_<?= $item->subasta_id ?>" class="label label-danger">Finalizada</span>
                                                                              </div>


                                                                              <!-- Ad Title -->
                                                                              <h6><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');"><?= $item->corto ?></a> </h6>
                                                                              <!-- Info Icons -->

                                                                              <!-- Ad Meta Info -->
                                                                              <ul class="ad-meta-info">
                                                                                  <li> <i class="fa fa-map-marker"></i><a><?= $item->ciudad ?></a> </li>
                                                                                  <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                              </ul>
                                                                              <!--     <div class="row" id="cronometro_subasta_<?= $item->subasta_id ?>">
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
                                                                        </div> -->

                                                                              <!-- Ad Description-->
                                                                              <div class="ad-details">

                                                                                  <?= $item->corta ?>


                                                                              </div>
                                                                              <?php if ($this->session->userdata('user_id')) { ?>
                                                                                  <div class="row" id="btn_subastas_<?= $item->subasta_id ?>">

                                                                                      <?php if (!$item->subasta_user) { ?>
                                                                                          <div class="col-md-8">
                                                                                              <button id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                          </div>
                                                                                      <?php } ?>
                                                                                      <?php if ($item->subasta_user) { ?>
                                                                                          <?php if ($item->puja_user) { ?>
                                                                                              <?php if ((float) $item->puja_user->valor < (float) $item->puja->valor) { ?>
                                                                                                  <div class="col-md-8">
                                                                                                      <button style="display:none" id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                                      <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                                  </div>
                                                                                              <?php } else { ?>
                                                                                                  <div class="col-md-8">
                                                                                                      <button style="display:none" id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                                      <button style="display:none" id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                                  </div>
                                                                                              <?php } ?>
                                                                                          <?php } else { ?>

                                                                                              <div class="col-md-8">
                                                                                                  <button style="display:none" id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                                  <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_pago ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                              </div>
                                                                                          <?php } ?>
                                                                                      <?php } ?>

                                                                                  </div>
                                                                              <?php } ?>
                                                                          </div>
                                                                          <div class="col-md-3 col-xs-12 col-sm-12">
                                                                              <!-- Ad Stats -->

                                                                              <!-- Price -->
                                                                              <?php if ($item->subasta_user &&  $item->puja->valor > 0) { ?>
                                                                                  <h6 class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                                  <h5 class="text-center" style="font-size:14px !important"><span style="margin-left: -11%;" id="valor_inicial_subasta_<?= $item->subasta_id ?>" class="label label-success"><i class='fa fa-user-o'></i> <?= $item->user_win->name ?> $<?= number_format($item->puja->valor, 2) ?></span></h5>
                                                                              <?php } else { ?>
                                                                                  <h6 style="display:none" id="user_win_title_<?= $item->subasta_id ?>" class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                                  <h5 id="user_win_<?= $item->subasta_id ?>" class="text-center" style="font-size:14px !important; display:none"><span style="margin-left: -11%;" id="valor_inicial_subasta_<?= $item->subasta_id ?>" class="label label-success"><i class='fa fa-user-o'></i> </span></h5>
                                                                              <?php  } ?>
                                                                              <h6 class="text-center"><?= "Valor de entreda" ?></h6>
                                                                              <div class="price text-center"> <span>$ <?= number_format($item->valor_pago, 2) ?></span> </div>
                                                                              <h6 class="text-center"><?= "Valor inicial" ?> </h6>
                                                                              <div class="price text-center"><span>$ <?= number_format($item->valor_inicial, 2) ?></span> </div>
                                                                              <!-- Ad View Button -->

                                                                              <button style="width: 96%; font-size: 11px;" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>

                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <!-- Ad Content End -->
                                                              </div>
                                                          </div>
                                                      </li>

                                                  <?php } else if ($item->tipo_subasta == 2) { ?>
                                                      <?php $count_intervalo = count($item->intervalo); ?>
                                                      <?php $contador_inversa++; ?>
                                                      <?php if ($item->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                                          <li>
                                                              <div class="well ad-listing clearfix">
                                                                  <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                                      <!-- Image Box -->
                                                                      <div style="cursor:pointer" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');" class="img-box">
                                                                          <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                                          <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>
                                                                          <!--    <div class="quick-view"><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>');" class="view-button"><i class="fa fa-search"></i></a> </div> -->
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

                                                                                  <div class="category-title"> <span><a><?= $item->categoria ?></a></span>

                                                                                  </div>


                                                                                  <!-- Ad Title -->
                                                                                  <h6><a onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');"><?= $item->corto ?></a> </h6>
                                                                                  <!-- Info Icons -->

                                                                                  <!-- Ad Meta Info -->
                                                                                  <ul class="ad-meta-info">
                                                                                      <li> <i class="fa fa-map-marker"></i><a href="#"><?= $item->ciudad ?></a> </li>

                                                                                      <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?></li>
                                                                                  </ul>
                                                                                  <!--      <div class="row">
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
                                                                            </div> -->

                                                                                  <!-- Ad Description-->
                                                                                  <div class="ad-details">

                                                                                      <?= $item->corta ?>


                                                                                  </div>
                                                                                  <?php if ($this->session->userdata('user_id')) { ?>
                                                                                      <div class="row">

                                                                                          <!--  <?php if (!$item->subasta_user) { ?>
                                                                                        <div class="col-md-6">
                                                                                            <button onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                        </div>
                                                                                    <?php } ?> -->
                                                                                    <!--   -->
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
                                                                            <h6 class="text-center"><?= "Precio" ?></h6>
                                                                            <?php if ($count_intervalo >= 2) { ?>
                                                                                <div class="price text-center"> <span style="font-size:18px !important; color:#2a3681 !important;" class="strikethrough">$ <?= number_format($item->intervalo[$count_intervalo - 2]->valor, 2) ?></span> </div>
                                                                                <div class="price text-center"> <span>$ <?= number_format($item->intervalo[$count_intervalo - 1]->valor, 2) ?></span> </div>
                                                                            <?php } else { ?>
                                                                                <div class="price text-center"> <span>$ <?= number_format($item->intervalo[$count_intervalo - 1]->valor, 2) ?></span> </div>
                                                                            <?php } ?>
                                                                            <div class="category-title text-center">Stock: <span> <?= $item->intervalo[$count_intervalo - 1]->cantidad ?> </span> </div>

                                                                            <!-- Ad View Button -->
                                                                            <button style="width: 96%; font-size: 11px;" onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Ad Content End -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>

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
                <!-- Left Sidebar -->
                <div class="col-md-3 col-md-pull-9 col-sx-12">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Categories Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <!-- Title -->
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            <?= translate("categories_lang"); ?>
                                        </a>
                                    </h4>
                                    <!-- Title End -->
                                </div>
                                <!-- Content -->
                                <div id="collapseOne" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body categories">
                                        <?= form_open_multipart("search_subasta_directa", array('class' => 'search-form', 'id' => 'buscar_categoria')); ?>

                                        <ul>
                                            <?php $category_id = $this->session->userdata('session_categoria_subasta'); ?>
                                            <?php if (!$category_id) { ?>

                                               
                                                <li><a style="cursor:pointer; color:#2a3681" onclick="cargar_input_2('0')"><span><i style="color:#8c1822ab" class="fa fa-tags"></i></span>Todas las categorias</a></li>
                                            <?php } else { ?>
                                                <li><a style="cursor:pointer; color:#2a3681" onclick="cargar_input_2('0')"><span><i style="color:#8c1822ab" class="fa fa-tags"></i></span>Todas las categorias</a></li>
                                            <?php } ?>
                                            <?php if (!$category_id) { ?>
                                                <?php if ($categories) { ?>
                                                    <?php foreach ($categories as $item) { ?>
                                                        
                                                        <li class="dropdown">
                                                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i> <?= ucwords($item->name_espa); ?> </a>
                                                                <ul class="dropdown-menu">
                                                                    <?php
                                                                    foreach($subcat as $result)
                                                                        {
                                                                            if($result->categoria_id == $item->categoria_id)
                                                                                {
                                                                                ?>
                                                                                <li>
                                                                                <?php
                                                                                    if($result->subcat_id == $subcat_id)
                                                                                        {
                                                                                            ?>
                                                                                            <a style="color:red;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                                <?= ucwords($result->nombre); ?>
                                                                                            </a>
                                                                                            <?php
                                                                                            
                                                                                        }
                                                                                    else{
                                                                                        ?>
                                                                                        <a style="color:black;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                            <?= ucwords($result->nombre); ?>
                                                                                        </a>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    
                                                                                </li>
                                                                                <?php 
                                                                                }
                                                                        }
                                                                    ?>
                                                                </ul>                                                            
                                                            
                                                        </li>
                                                        
                                                       


                                                    <?php } ?>

                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($categories) { ?>
                                                    <?php foreach ($categories as $item) { ?>
                                                        
                                                        <?php if ($item->categoria_id == $category_id) { ?>
                                                            <li class="dropdown">
                                                                <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i> <?= ucwords($item->name_espa); ?> </a>
                                                                    <ul class="dropdown-menu">
                                                                        <?php
                                                                        foreach($subcat as $result)
                                                                            {
                                                                                if($result->categoria_id == $item->categoria_id)
                                                                                    {
                                                                                    ?>
                                                                                    
                                                                                    <li>
                                                                                        <?php
                                                                                            if($result->subcat_id == $subcat_id)
                                                                                                {
                                                                                                    ?>
                                                                                                    <a style="color:red;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                                        <?= ucwords($result->nombre); ?>
                                                                                                    </a>
                                                                                                    <?php
                                                                                            
                                                                                                }
                                                                                            else{
                                                                                                ?>
                                                                                                <a style="color:black;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                                    <?= ucwords($result->nombre); ?>
                                                                                                </a>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                    
                                                                                    </li>
                                                                                    <?php 
                                                                                    }
                                                                            }
                                                                        ?>
                                                                    </ul>                                                            
                                                            
                                                            </li>
                                                           
                                                        <?php } else { ?>
                                                            <li class="dropdown">
                                                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i> <?= ucwords($item->name_espa); ?> </a>
                                                                <ul class="dropdown-menu">
                                                                    <?php
                                                                    foreach($subcat as $result)
                                                                        {
                                                                            if($result->categoria_id == $item->categoria_id)
                                                                                {
                                                                                ?>
                                                                                
                                                                                <li>
                                                                                <?php
                                                                                    if($result->subcat_id == $subcat_id)
                                                                                        {
                                                                                            ?>
                                                                                            <a style="color:red;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                                <?= ucwords($result->nombre); ?>
                                                                                            </a>
                                                                                            <?php
                                                                                            
                                                                                        }
                                                                                    else{
                                                                                        ?>
                                                                                        <a style="color:black;" onclick="cargar_input_2('<?= $result->subcat_id ?>')">
                                                                                            <?= ucwords($result->nombre); ?>
                                                                                        </a>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    
                                                                                </li>
                                                                                <?php 
                                                                                }
                                                                        }
                                                                    ?>
                                                                </ul>                                                            
                                                            
                                                        </li>
                                                        <?php } ?>
                                                    <?php } ?>

                                                <?php } ?>

                                            <?php } ?>
                                            <input name="category_subasta" id="category_subasta" type="hidden" value="">
                                            <input name="tipo_subasta_2" id="tipo_subasta_2" type="hidden" value="<?= $tipo ?>">
                                        </ul>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
                <!-- Left Sidebar End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->

    <script>
        function cargar_input_2(params) {
            $('#category_subasta').val(params);
            $("#buscar_categoria").submit();
        }

        contador_inversa = <?= $contador_inversa ?>;
        contador_directa = <?= $contador_directa ?>;
        let subastas_2 = <?= json_encode($all_subastas); ?>;

        for (let i = 0; i < subastas_2.length; i++) {

            if (subastas_2[i].tipo_subasta == 1) {

                var x = setInterval(function() {
                    var fecha = subastas_2[i].fecha_cierre;
                    var deadline = new Date(fecha).getTime();
                    var currentTime = new Date().getTime();
                    var t = deadline - currentTime;
                    var days = Math.floor(t / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((t % (1000 * 60)) / 1000);
                    $('#day_' + subastas_2[i].subasta_id).html(days);
                    $('#hour_' + subastas_2[i].subasta_id).html(hours);
                    $('#minute_' + subastas_2[i].subasta_id).html(minutes);
                    $('#second_' + subastas_2[i].subasta_id).html(seconds);

                    if (t < 0) {

                        clearInterval(x);

                        $('#day_' + subastas_2[i].subasta_id).html(0);
                        $('#hour_' + subastas_2[i].subasta_id).html(0);
                        $('#minute_' + subastas_2[i].subasta_id).html(0);
                        $('#second_' + subastas_2[i].subasta_id).html(0);

                    }

                }, 1000);
            }


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