<section id="hero" class="hero bg-img">
   <div class="content">
      <p>
         <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"><a href="<?= $all_banners[0]->url ?>"><?= $all_banners[0]->titulo ?></a></font>
         </font>
      </p>

      <h1><?= $all_banners[0]->subtitulo ?></h1>

   </div>
   <!-- .content -->
</section>
<!-- Home Banner 1 End -->
<!-- Main Content Area -->
<div class="main-content-area clearfix">
   <!-- =-=-=-=-=-=-= Home Tabs =-=-=-=-=-=-= -->
   <section class="home-tabs">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="tabs-container">
                  <ul role="tablist" class="nav nav-tabs">
                     <li class="clearfix active">
                        <a data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[0]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[0]->photo) ?>" alt=""></i> </a>
                     </li>
                     <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
                        <!-- Category -->
                        <li class="clearfix">
                           <a data-toggle="tab" role="tab" href="#<?= strtolower(seo_url($all_categorias[$i]->name_espa)) ?>" aria-expanded="false"> <i><img src="<?= base_url($all_categorias[$i]->photo) ?>" alt=""></i> </a>
                        </li>
                        <!-- Category -->
                     <?php } ?>

                  </ul>
                  <!-- Tab Content -->
                  <div class="tab-content">
                     <div id="<?= strtolower(seo_url($all_categorias[0]->name_espa)) ?>" class="row tab-pane active in fade">

                        <?php for ($k = 0; $k < count($all_categorias[0]->all_subastas); $k++) { ?>
                           <div class="col-md-4 col-xs-12 col-sm-6">
                              <!-- Ad Box -->
                              <div class="category-grid-box">
                                 <!-- Ad Img -->
                                 <div class="category-grid-img">
                                    <img class="img-responsive" alt="" src="<?= base_url($all_categorias[0]->all_subastas[$k]->photo_subasta) ?>">
                                    <!-- Ad Status --><span class="ad-status"> Destacado </span>
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
                                    <div class="category-title"> <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[0]->all_subastas[$k]->fecha_cierre ?> </span> </div>
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
                                 </div>
                                 <!-- Addition Info -->
                                 <div class="ad-info">
                                    <ul>
                                       <li><i class="fa fa-map-marker"></i> <?= $all_categorias[0]->all_subastas[$k]->name_ciudad ?></li>
                                       <li><button onclick="cargarmodal_subasta('<?= $all_categorias[0]->all_subastas[$k]->subasta_id ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                    </ul>
                                 </div>
                              </div>
                              <!-- Ad Box End -->
                           </div>
                        <?php } ?>


                     </div>
                     <?php for ($i = 1; $i < count($all_categorias); $i++) { ?>
                        <!-- tab content -->
                        <div id="<?= strtolower(seo_url($all_categorias[$i]->name_espa)) ?>" class="row tab-pane fade ">

                           <?php for ($k = 0; $k < count($all_categorias[$i]->all_subastas); $k++) { ?>
                              <div class="col-md-4 col-xs-12 col-sm-6">
                                 <!-- Ad Box -->
                                 <div class="category-grid-box">
                                    <!-- Ad Img -->
                                    <div class="category-grid-img">
                                       <img class="img-responsive" alt="" src="<?= base_url($all_categorias[$i]->all_subastas[$k]->photo_subasta) ?>">
                                       <!-- Ad Status --><span class="ad-status"> Destacado </span>
                                       <!-- User Review -->
                                       <div class="user-preview">
                                          <a href="#"> <img src="images/users/7.jpg" class="avatar avatar-small" alt=""> </a>
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
                                       <div class="category-title"> <span> <i class="fa fa-clock-o"></i> <?= $all_categorias[$i]->all_subastas[$k]->fecha_cierre ?> </span> </div>
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
                                    </div>
                                    <!-- Addition Info -->
                                    <div class="ad-info">
                                       <ul>
                                          <li><i class="fa fa-map-marker"></i> <?= $all_categorias[$i]->all_subastas[$k]->name_ciudad ?></li>

                                          <li><button onclick="cargarmodal_subasta('<?= $all_categorias[$i]->all_subastas[$k]->subasta_id ?>');" class="btn btn-success" type="button"><?= translate('ver_info_lang') ?></button></li>
                                       </ul>
                                    </div>
                                 </div>
                                 <!-- Ad Box End -->
                              </div>
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
                     Categorias populares
                  </h3>
               </div>
            </div>
            <!-- Middle Content Box -->
            <div class="col-md-12 category-blocks">
               <ul class="popular-categories">
                  <?php foreach ($all_cate_anuncio as $item) {  ?>
                     <!-- <li><a href="#"><i><img  class="img-responsive img-rounded" src ="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( 0 )</span></a></li>-->
                     <li><a href="<?= site_url('front/anuncios_index/' . $item->cate_anuncio_id) ?>"><i><img style="heigth:128px; width:128px; margin-left:38px;" class="img-responsive img-rounded" src="<?= base_url($item->photo); ?>"></i> <?= $item->nombre ?> <span class="count">( 0 )</span></a></li>

                  <?php } ?>
               </ul>
            </div>
            <!-- Middle Content Box End -->
         </div>
         <!-- Row End -->
      </div>
      <!-- Main Container End -->
   </section>

   <style>
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
   </script>