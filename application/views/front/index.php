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

         <section class="gray" style="padding-bottom:30px;padding-top: 50px;">
            <!-- Main Container -->
            <div class="container-fluid">
               <!-- Row -->
               <div class="row" style="padding-left:60px;padding-right:60px">
                  <!-- Heading Area -->
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12">
                        <h3 class="main-title text-center">Destacados</h3>
                     </div>
                     <!--      <a href="javascript:void(0)" onclick="openMenu()">
                        <i class="fa fa-bars" aria-hidden="true" style="font-size: 41px;color: #08374C;"></i>
                     </a> -->
                  </div>
                  <div class="row">
                     <div class="home-category-slider">
                        <div class="container-fluid no-padding">
                           <div class="category-slider">
                              <?php if ($all_anuncios) {
                                 foreach ($all_anuncios as $item) {
                                    echo ' <div class="item">';
                                    echo ' <div class="col-lg-12">';
                                    echo '<div class="category-grid-box-1">';
                                    echo '<a style="cursor:pointer" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">';
                                    echo ' <div class="image">';
                                    if (file_exists($item->anuncio_photo)) {
                                       if (strpos($item->anuncio_photo, 'uploads') !== false) {
                                          echo '<img alt="Tour Package" src="' . base_url($item->anuncio_photo) . '" class="img-responsive"  loading="lazy">';
                                       } else {
                                          echo '<img alt="Tour Package" src="' . $item->anuncio_photo . '" class="img-responsive"  loading="lazy">';
                                       }
                                    } else {
                                       echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive"  loading="lazy">';
                                    }
                                    if ($item->destacado == 1) {
                                       echo '<div class="ribbon popular"><i class="fa fa-star" aria-hidden="true"></i>
                                       </div>';
                                    }
                                    echo ' </div>';
                                    echo '</a>';
                                    echo ' <div class="short-description-1 clearfix">';
                                    echo '<div class="category-title"> <span>' . $item->categoria . ' / ' . $item->subcategoria . '</span> </div>';
                                    echo ' <p class="title-carousel"><a title="" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">' . $item->corto . '</a></p>';
                                    echo '<p class="text-left" style="font-size:14px;color:#fff">$' . number_format($item->precio, 2) . '</p>';
                                    echo ' <span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-whatsapp"></i> ' . $item->whatsapp . ' </span> ';

                                    if (isset($item->url)) {
                                       if ($item->url != '' || $item->url != null) {
                                          echo '<a href="' . $item->url . '" class="btn btn-outline btn-default btn-sm" style="margin-left:4px">Comprar</a>';
                                       }
                                    }
                                    echo '</div>';
                                    echo '<div class="ad-info-1">';
                                    echo ' <ul>';
                                    echo '  <li> <i class="fa fa-map-marker"></i>' . $item->ciudad . ' </li>';
                                    echo '  <li> <i class="fa fa-eye"></i>' . $item->views . ' </li>';
                                    echo ' </ul>';
                                    echo '</div>';
                                    echo ' </div>';
                                    echo ' </div>';
                                    echo ' </div>';
                                 }
                                 echo ' <div class="item">';
                                 echo ' <div class="col-lg-12">';
                                 echo '<div class="category-grid-5" style="background:#34495e;min-height:406.84px;">';
                                 echo '<a href="' . site_url('anuncios') . '" class="btn btn-lg btn-clean">Ver mas</a>';
                                 echo '</div>';
                                 echo '</div>';
                                 echo '</div>';
                              } else {
                                 echo '<h1 class="text-center">No hay resultados</h1>';
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                     <!-- Middle Content Box End -->
                  </div>
               </div>
               <!-- Row End -->
               <!-- Row -->
               <div class="row" style="padding-left:60px;padding-right:60px">
                  <!-- Heading Area -->

                  <div class="row">
                     <div class="home-category-slider">
                        <div class="container-fluid no-padding">
                           <?php if ($all_cate_anuncio) {
                              foreach ($all_cate_anuncio as $cAds) {

                                 echo '<div class="heading-panel text-center" style="margin-top:30px">';
                                 echo '<div class="col-xs-12 col-md-12 col-sm-12">';
                                 echo '<a href="' . site_url() . 'anuncios?category=' . $cAds->cate_anuncio_id . '" >';
                                 echo '<img style="width: 100%" src="' . base_url($cAds->banner) . '" />';
                                 echo '</a>';
                                 echo '</div>';
                                 echo '</div>';
                                 echo '<div  class="category-slider" style="margin-top:20px">';
                                 if (count($cAds->ads) > 0) {
                                    foreach ($cAds->ads as $item) {
                                       echo ' <div class="item">';
                                       echo ' <div class="col-lg-12">';
                                       echo '<div class="category-grid-box-1">';
                                       echo '<a style="cursor:pointer" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">';
                                       echo ' <div class="image">';
                                       if (file_exists($item->anuncio_photo)) {
                                          if (strpos($item->anuncio_photo, 'uploads') !== false) {
                                             echo '<img alt="Tour Package" src="' . base_url($item->anuncio_photo) . '" class="img-responsive"  loading="lazy">';
                                          } else {
                                             echo '<img alt="Tour Package" src="' . $item->anuncio_photo . '" class="img-responsive"  loading="lazy">';
                                          }
                                       } else {
                                          echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive"  loading="lazy">';
                                       }
                                       if ($item->destacado == 1) {
                                          echo '<div class="ribbon popular"><i class="fa fa-star-o" aria-hidden="true"></i>
                                          </div>';
                                       }
                                       echo ' </div>';
                                       echo '</a>';
                                       echo ' <div class="short-description-1 clearfix">';
                                       echo '<div class="category-title"> <span>' . $item->categoria . ' / ' . $item->subcategoria . '</span> </div>';
                                       echo ' <p class="title-carousel"><a title="" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">' . $item->corto . '</a></p>';
                                       echo '<p class="text-left" style="font-size:14px;color:#fff">$' . number_format($item->precio, 2) . '</p>';
                                       echo ' <span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-whatsapp"></i> ' . $item->whatsapp . ' </span> ';

                                       if (isset($item->url)) {
                                          if ($item->url != '' || $item->url != null) {
                                             echo '<a href="' . $item->url . '" class="btn btn-outline btn-default btn-sm" style="margin-left:4px">Comprar</a>';
                                          }
                                       }
                                       echo '</div>';
                                       echo '<div class="ad-info-1">';
                                       echo ' <ul>';
                                       echo '  <li> <i class="fa fa-map-marker"></i>' . $item->ciudad . ' </li>';
                                       echo '  <li> <i class="fa fa-eye"></i>' . $item->views . ' </li>';
                                       echo ' </ul>';
                                       echo '</div>';
                                       echo ' </div>';
                                       echo ' </div>';
                                       echo ' </div>';
                                    }
                                    echo ' <div class="item">';
                                    echo ' <div class="col-lg-12">';
                                    echo '<div class="category-grid-5" style="background:#34495e;min-height:406.84px;">';
                                    echo '<a href="' . site_url('anuncios') . '" class="btn btn-lg btn-clean">Ver mas</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                 } else {
                                    echo '<h1 class="text-center">No hay resultados</h1>';
                                 }
                                 echo '</div>';
                              }
                           } ?>
                        </div>
                     </div>
                     <!-- Middle Content Box End -->
                  </div>
               </div>
               <!-- Row End -->

            </div>
            <!-- Main Container End -->
         </section>

         <!--      <section style="margin-top: 30px;" class="home-tabs">
            <div class="container">
               <div class="heading-panel">
                  <div class="col-xs-12 col-md-12 col-sm-12">
                     <h3 class="main-title text-center">Subastas</h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="tabs-container">
                        <ul role="tablist" class="nav nav-tabs">
                           <li class="clearfix active">
                              <a onclick="detalle_categoria('<?= $all_categorias[0]->count_inversa ?>','<?= $all_categorias[0]->count_directa ?>')" data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[0]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[0]->photo) ?>" alt=""></i> </a>
                           </li>
                           <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
                              <li class="clearfix">
                                 <a onclick="detalle_categoria('<?= $all_categorias[$i]->count_inversa ?>','<?= $all_categorias[$i]->count_directa ?>')" data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[$i]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[$i]->photo) ?>" alt=""></i> </a>
                              </li>
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
                                       <div class="category-grid-box white category-grid-box-1 ">
                                          <div class="category-grid-img">
                                             <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');">
                                                <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                             </div>
                                          </div>
                                          <div style="height: 174px !important;" class="short-description">
                                             <div class="category-title"> <span><a><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                             <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');"><?= $all_categorias[0]->all_subastas[$k]->titulo_corto ?></a></h6>
                                             <div class="price">Precio inicial $<?= number_format($all_categorias[0]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                             <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->fecha_cierre ?> </span> </div>
                                             <div class="category-title">Ubicación: <span> <i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?> </span> </div>

                                          </div>
                                          <div class="ad-info">
                                             <ul>
                                                <li class="text-center"><button style="margin-left: 23%;" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= NULL ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>

                                 <?php } else { ?>
                                    <?php $count_intervalo = count($all_categorias[0]->all_subastas[$k]->intervalo); ?>
                                    <?php if ($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                       <div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">
                                          <div class="category-grid-box white category-grid-box-1">
                                             <div class="category-grid-img">
                                                <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');">
                                                   <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                                </div>
                                             </div>
                                             <div style="height: 174px !important;" class="short-description">
                                                <div class="category-title"> <span><a href="#"><?= $all_categorias[0]->name_espa ?></a></span> </div>
                                                <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');"><?= $all_categorias[0]->all_subastas[$k]->titulo_corto ?></a></h6>

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
                                             <div class="ad-info">
                                                <ul>
                                                   <li><i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?></li>
                                                   <li><button onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    <?php } ?>
                                 <?php } ?>
                              <?php } ?>
                           </div>

                           <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
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
                                          <div class="category-grid-box  white category-grid-box-1">
                                             <div class="category-grid-img">
                                                <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');">
                                                   <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                                </div>
                                             </div>
                                             <div style="height: 174px !important;" class="short-description">
                                                <div class="category-title"> <span><a><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                                <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');"><?= $all_categorias[$i]->all_subastas[$k]->titulo_corto ?></a></h6>

                                                <div class="price">Precio inicial $<?= number_format($all_categorias[$i]->all_subastas[$k]->valor_inicial, 2) ?></div>
                                                <div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->fecha_cierre ?> </span> </div>

                                             </div>
                                             <div class="ad-info">
                                                <ul>
                                                   <li><i class="fa fa-map-marker"></i> <?= $all_categorias[$i]->all_subastas[$k]->name_ciudad ?></li>

                                                   <li><button onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= '' ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>

                                    <?php } else { ?>
                                       <?php $count_intervalo = count($all_categorias[$i]->all_subastas[$k]->intervalo); ?>
                                       <?php if ($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                          <div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">
                                             <div class="category-grid-box  white category-grid-box-1">
                                                <div class="category-grid-img">
                                                   <div style="cursor:pointer" class="image" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');">
                                                      <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                                   </div>
                                                </div>
                                                <div style="height: 174px !important;" class="short-description">
                                                   <div class="category-title"> <span><a><?= $all_categorias[$i]->name_espa ?></a></span> </div>
                                                   <h6><a title="" onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');"><?= $all_categorias[$i]->all_subastas[$k]->titulo_corto ?></a></h6>
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
                                                <div class="ad-info">
                                                   <ul>
                                                      <li><i class="fa fa-map-marker"></i> <?= $all_categorias[$i]->all_subastas[$k]->name_ciudad ?></li>
                                                      <li><button onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>','<?= base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       <?php } ?>
                                    <?php } ?>
                                 <?php } ?>
                              </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->
      </div>
      <style>
         .strikethrough {
            position: relative;
         }

         .ad-info-1 ul li {
            color: #fff;
            display: inline-block;
            margin-bottom: 0;
            margin-right: 14px;
            margin-top: 4px;
            vertical-align: middle;
            font-size: 13px;
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

         .ribbon.popular {
            background: none;
            color: #e5124c;
            font-size: 18px;
         }

         .gray {
            background-color: #ffffff;
         }
      </style>