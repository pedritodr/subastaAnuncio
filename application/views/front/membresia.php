 <!-- =-=-=-=-=-=-= Light Header End  =-=-=-=-=-=-= -->
 <!-- =-=-=-=-=-=-= Transparent Breadcrumb =-=-=-=-=-=-= -->
 <div class="page-header-area">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="header-page">

                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Small Breadcrumb -->
 <div class="small-breadcrumb">
     <div class="container">
         <div class=" breadcrumb-link">
             <ul>
                 <li><a href="<?= site_url('portada') ?>"><?= translate('inicio_lang') ?></a></li>
                 <li><a class="active" href="<?= site_url('membresia') ?>"><?= translate('menbresi_lang') ?></a></li>
             </ul>
         </div>
     </div>
 </div>
 <div class="main-content-area clearfix">
     <section class="custom-padding">
         <!-- Main Container -->
         <div class="container">
             <!-- Row -->
             <div class="row">
                 <!-- Heading Area -->
                 <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                         <!-- Main Title -->
                         <h1><?= translate('menbresi_descrip_lang') ?> <span class="heading-color"><?= translate('name_plan_lang') ?></span></h1>
                         <!-- Short Description -->
                         <p class="heading-text"></p>
                     </div>
                 </div>
                 <!-- Middle Content Box -->
                 <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="row pricing">
                         <?php foreach ($all_membresia as $item) { ?>
                             <div class="col-sm-6 col-lg-4 col-md-4">
                                 <div class="block">

                                     <h3><?= $item->nombre ?></h3>

                                     <span class="price">$<?= number_format($item->precio, 2); ?></span>
                                     <span class="time"><?= translate('cant_anuncios_lang') ?> <?= $item->cant_anuncio; ?></span>

                                     <?php if ($this->session->userdata('user_id')) { ?>
                                         <a style="cursor:pointer" onclick="seleccionar_membresia('<?= $item->membresia_id; ?>','<?= $item->precio; ?>');" class="btn btn-theme"><?= translate('select_plan_lang') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                     <?php } ?>
                                 </div>
                             </div>
                         <?php } ?>


                     </div>
                 </div>

             </div>
             <!-- Row End -->
         </div>
         <!-- Main Container End -->
     </section>
 </div>
 <!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->
 <div class="custom-modal">
     <div id="modal_membresia" class="modal fade" role="dialog">
         <div class="modal-dialog">
             <!-- Modal content-->
             <div class="modal-content">
                 <div class="modal-header rte">
                     <h2 class="modal-title text-center"><?= translate('menbresi_lang'); ?></h2>
                 </div>
                 <?= form_open("front/pagar_membresia") ?>

                 <div class="modal-body">
                     <div class="block">
                         <h3 class="text-center" id="nombre"></h3>
                         <h4 class="text-center" id="precio"></h4>
                         <input name="membresia" id="membresia" type="hidden" value="">
                         <h4 class="text-center"><span id="cantidad" class="time"></span></h4>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-default"><?= translate('pagar_lang'); ?></button>
                     <button type="button" class="btn btn-dark" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>
                 </div>
                 <?= form_close(); ?>
             </div>
         </div>
     </div>
 </div>
 <!-- =-=-=-=-=-=-= Share Modal =-=-=-=-=-=-= -->