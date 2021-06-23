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

   p a:hover {
      color: #8c1822 !important;
   }

   p a {
      color: #fff !important;
   }
</style>
<?php if (count($all_banners) > 0) { ?>
   <div class="master-slider ms-skin-default banner2" id="masterslider">
      <?php foreach ($all_banners as $item) { ?>
         <div class="ms-slide">
            <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" />
         </div>
      <?php } ?>
   </div>
<?php } ?>
<div class="main-content-area clearfix">
   <section style="margin-top: 1%;" class="home-tabs">
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
                              <?php
                              echo '<div class="col-lg-3 col-md-3 col-xs-12 col-sm-3 direct subastas">';
                              echo '<div class="category-grid-box-1">';
                              echo '<a style="cursor:pointer" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) . '")>';
                              echo '<div class="image">';
                              if (file_exists($all_categorias[0]->all_subastas[$k]->photo_subasta)) {
                                 echo '<img alt="Tour Package" src="' . base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) . '" class="img-responsive">';
                              } else {
                                 echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                              }
                              echo '<div class="price-tag">';
                              echo '<div class="price"><span>Precio inicial: $' . number_format($all_categorias[0]->all_subastas[$k]->valor_inicial, 2) . '</span></div>';
                              echo '</div>';
                              echo '</div>';
                              echo '</a>';
                              echo '<div class="short-description-1 clearfix">';
                              echo '<div class="category-title"> <span>' . $all_categorias[0]->name_espa . '</span> </div>';
                              echo '<p><a style="cursor:pointer" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) . '")>' . $all_categorias[0]->all_subastas[$k]->titulo_corto . '</a></p>';
                              echo '<span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-clock-o"></i> ' . $all_categorias[0]->all_subastas[$k]->fecha_cierre . ' </span> ';
                              echo '</div>';
                              echo '<div class="ad-info-1">';
                              echo '<ul>';
                              echo '<li> <i class="fa fa-map-marker"></i>' . $all_categorias[0]->all_subastas[$k]->name_ciudad . ' </li>';
                              echo '<li class="text-center"><button style="margin-left: 23%;" class="btn btn-outline btn-default btn-sm" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[0]->all_subastas[$k])) . '") type="button">' . translate('ver_info_lang') . '</button></li>';
                              echo '</ul>';
                              echo '</div>';
                              echo '</div>';
                              echo '</div>';
                              ?>
                           <?php } else { ?>
                              <?php $count_intervalo = count($all_categorias[0]->all_subastas[$k]->intervalo); ?>
                              <?php if ($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                 <?php
                                 echo '<div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">';
                                 echo '<div class="category-grid-box-1">';
                                 echo '<a style="cursor:pointer">';
                                 echo '<div class="image">';
                                 if (file_exists($all_categorias[0]->all_subastas[$k]->photo_subasta)) {
                                    echo '<img alt="Tour Package" src="' . base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) . '" class="img-responsive">';
                                 } else {
                                    echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                                 }
                                 echo '<div class="price-tag">';
                                 if ($count_intervalo >= 2) {
                                    echo '<div class="price"><span><b class="strikethrough" style=" font-size:16px !important; color:#2a3681 !important">$ ' . number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 2]->valor, 2) . '</b> $' . number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) . '</span></div>';
                                 } else {
                                    echo '<div class="price"><span>Precio inicial: $' . number_format($all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) . '</span></div>';
                                 }
                                 echo '</div>';
                                 echo '</div>';
                                 echo '</a>';
                                 echo '<div class="short-description-1 clearfix">';
                                 echo '<div class="category-title"> <span>' . $all_categorias[0]->name_espa . '</span> </div>';
                                 echo '<p><a title="" href="">' . $all_categorias[0]->all_subastas[$k]->titulo_corto . '</a></p>';
                                 echo '<div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i>' . $all_categorias[0]->all_subastas[$k]->fecha_cierre . '</span> </div>';
                                 echo '<div class="category-title">Stock: <span>' . $all_categorias[0]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad . '</span> </div>';
                                 echo '</div>';
                                 echo '<div class="ad-info-1">';
                                 echo '<ul>';
                                 echo '<li> <i class="fa fa-map-marker"></i>' . $all_categorias[0]->all_subastas[$k]->name_ciudad . ' </li>';
                                 echo '<li class="text-center"><button style="margin-left: 23%;" class="btn btn-outline btn-default btn-sm" type="button">' . translate('ver_info_lang') . '</button></li>';
                                 echo '</ul>';
                                 echo '</div>';
                                 echo '</div>';
                                 echo '</div>';
                                 ?>
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
                                 <?php
                                 echo '<div class="col-lg-3 col-md-3 col-xs-12 col-sm-3 direct subastas">';
                                 echo '<div class="category-grid-box-1">';
                                 echo '<a style="cursor:pointer" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) . '")>';
                                 echo ' <div class="image">';
                                 if (file_exists($all_categorias[$i]->all_subastas[$k]->photo_subasta)) {
                                    echo '<img alt="Tour Package" src="' . base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) . '" class="img-responsive">';
                                 } else {
                                    echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                                 }
                                 echo ' <div class="price-tag">';
                                 echo '<div class="price"><span>Precio inicial: $' . number_format($all_categorias[$i]->all_subastas[$k]->valor_inicial, 2) . '</span></div>';
                                 echo '</div>';
                                 echo ' </div>';
                                 echo '</a>';
                                 echo ' <div class="short-description-1 clearfix">';
                                 echo '<div class="category-title"> <span>' . $all_categorias[$i]->name_espa . '</span> </div>';
                                 echo ' <p><a style="cursor:pointer" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) . '>' . $all_categorias[$i]->all_subastas[$k]->titulo_corto . '</a></p>';
                                 echo ' <span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-clock-o"></i> ' . $all_categorias[$i]->all_subastas[$k]->fecha_cierre . ' </span> ';
                                 echo '</div>';
                                 echo '<div class="ad-info-1">';
                                 echo ' <ul>';
                                 echo '  <li> <i class="fa fa-map-marker"></i>' . $all_categorias[$i]->all_subastas[$k]->name_ciudad . ' </li>';
                                 echo '<li class="text-center"><button style="margin-left: 23%;" class="btn btn-outline btn-default btn-sm" onclick=loadDetailSubasta("' . base64_encode(json_encode($all_categorias[$i]->all_subastas[$k])) . ' type="button">' . translate('ver_info_lang') . '</button></li>';
                                 echo ' </ul>';
                                 echo '</div>';
                                 echo ' </div>';
                                 echo ' </div>';
                                 ?>
                              <?php } else { ?>
                                 <?php $count_intervalo = count($all_categorias[$i]->all_subastas[$k]->intervalo); ?>
                                 <?php if ($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad > 0) { ?>
                                    <?php
                                    echo '<div style="display:none" class="col-md-3 col-xs-12 col-sm-3 subastas inverse">';
                                    echo '<div class="category-grid-box-1">';
                                    echo '<a style="cursor:pointer">';
                                    echo '<div class="image">';
                                    if (file_exists($all_categorias[$i]->all_subastas[$k]->photo_subasta)) {
                                       echo '<img alt="Tour Package" src="' . base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) . '" class="img-responsive">';
                                    } else {
                                       echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                                    }
                                    echo '<div class="price-tag">';
                                    if ($count_intervalo >= 2) {
                                       echo '<div class="price"><span><b class="strikethrough" style=" font-size:16px !important; color:#2a3681 !important">$ ' . number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 2]->valor, 2) . '</b> $' . number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) . '</span></div>';
                                    } else {
                                       echo '<div class="price"><span>Precio inicial: $' . number_format($all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->valor, 2) . '</span></div>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                    echo '<div class="short-description-1 clearfix">';
                                    echo '<div class="category-title"> <span>' . $all_categorias[$i]->name_espa . '</span> </div>';
                                    echo '<p><a title="" href="">' . $all_categorias[$i]->all_subastas[$k]->titulo_corto . '</a></p>';
                                    echo '<div class="category-title">Vence: <span> <i class="fa fa-clock-o"></i>' . $all_categorias[$i]->all_subastas[$k]->fecha_cierre . '</span> </div>';
                                    echo '<div class="category-title">Stock: <span>' . $all_categorias[$i]->all_subastas[$k]->intervalo[$count_intervalo - 1]->cantidad . '</span> </div>';
                                    echo '</div>';
                                    echo '<div class="ad-info-1">';
                                    echo '<ul>';
                                    echo '<li> <i class="fa fa-map-marker"></i>' . $all_categorias[$i]->all_subastas[$k]->name_ciudad . ' </li>';
                                    echo '<li class="text-center"><button style="margin-left: 23%;" class="btn btn-outline btn-default btn-sm" type="button">' . translate('ver_info_lang') . '</button></li>';
                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    ?>
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
   </section>
   <section class="section-padding gray">
      <!-- Main Container -->
      <div class="container-fluid">
         <!-- Row -->
         <div class="row" style="padding-left:30px;padding-right:30px">
            <!-- Heading Area -->
            <div class="heading-panel">
               <div class="col-xs-12 col-md-12 col-sm-12">
                  <h3 class="main-title text-center">Destacados</h3>
               </div>
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
                              echo '<a style="cursor:pointer" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id) . '">';
                              echo ' <div class="image">';
                              if (file_exists($item->anuncio_photo)) {
                                 if (strpos($item->anuncio_photo, 'uploads') !== false) {
                                    echo '<img alt="Tour Package" src="' . base_url($item->anuncio_photo) . '" class="img-responsive">';
                                 } else {
                                    echo '<img alt="Tour Package" src="' . $item->anuncio_photo . '" class="img-responsive">';
                                 }
                              } else {
                                 echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                              }
                              if ($item->destacado == 1) {
                                 echo '<div class="ribbon popular">Destacado</div>';
                              }
                              echo ' <div class="price-tag">';
                              echo '<div class="price"><span>$' . number_format($item->precio, 2) . '</span></div>';
                              echo '</div>';
                              echo ' </div>';
                              echo '</a>';
                              echo ' <div class="short-description-1 clearfix">';
                              echo '<div class="category-title"> <span>' . $item->categoria . ' / ' . $item->subcategoria . '</span> </div>';
                              echo ' <p><a title="" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id) . '">' . $item->corto . '</a></p>';
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
      </div>
      <!-- Main Container End -->
   </section>