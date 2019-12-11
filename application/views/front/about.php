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

                 <li><a class="active" href="<?= site_url('nosotros') ?>"><?= translate('acerca_lang') ?></a></li>
             </ul>
         </div>
     </div>
 </div>
 <!-- Small Breadcrumb -->
 <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
 <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
 <div class="main-content-area clearfix">
     <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
     <section class="section-padding pattern_dots">
         <!-- Main Container -->
         <div class="container">
             <!-- Row -->
             <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                     <div class="about-us-content">
                         <div class="heading-panel">
                             <h3 class="main-title text-left">
                                 <?= translate('gestion_empresa_lang') ?>
                             </h3>
                         </div>

                         <?= $empresa_object->sobre_nosotros ?>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                     <div class="about-page-featured-image">
                         <a href="#"><img src="<?= base_url('assets_front/images/logo-subasta-anuncio.png'); ?>" alt=""></a>
                     </div>
                 </div>
             </div>
             <!-- Row End -->
         </div>
         <!-- Main Container End -->
     </section>
     <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
     <section class="about-us">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12 no-padding">
                     <!-- service box 3 -->
                     <!-- service box end -->
                     <!-- service box 3 -->
                     <div class="col-sm-6 col-md-6 col-xs-12 no-padding">
                         <div class="why-us border-box text-center">
                             <h5><?= translate('mision_lang') ?></h5>
                             <p><?= $empresa_object->mision ?></p>
                         </div>
                         <!-- end featured-item -->
                     </div>
                     <!-- service box end -->
                     <!-- service box 3 -->
                     <div class="col-sm-6 col-md-6 col-xs-12 no-padding">
                         <div class="why-us border-box text-center">
                             <h5><?= translate('vision_lang') ?></h5>
                             <p><?= $empresa_object->vision ?></p>
                         </div>
                         <!-- end featured-item -->
                     </div>
                     <!-- service box end -->
                 </div>
             </div>
         </div>
         <!-- end container -->
     </section>
     <div class="clearfix"></div>


 </div>