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

                 <li><a class="active" href="<?= site_url('perfil') ?>"><?= translate('perfil_lang') ?></a></li>
             </ul>
         </div>
     </div>
 </div>
 <!-- Small Breadcrumb -->
 <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
 <div class="main-content-area clearfix">
     <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
     <section class="section-padding gray">
         <!-- Main Container -->
         <div class="container">
             <!-- Row -->
             <div class="row">
                 <!-- Middle Content Area -->
                 <div class="col-md-4 col-sm-12 col-xs-12 leftbar-stick blog-sidebar">
                     <!-- Sidebar Widgets -->
                     <div class="user-profile">
                         <a href="profile.html"><img src="<?= base_url('assets_front/images/users/9.jpg') ?>" alt=""></a>
                         <div class="profile-detail">
                             <h6><?= $this->session->userdata('name'); ?></h6>
                             <ul class="contact-details">
                                 <li>
                                     <i class="fa fa-map-marker"></i> UK London
                                 </li>
                                 <li>
                                     <i class="fa fa-envelope"></i> <?= $this->session->userdata('email'); ?>
                                 </li>

                                 <li>
                                     <i class="fa fa-phone"></i> <?= $this->session->userdata('phone'); ?>
                                 </li>
                             </ul>
                         </div>
                         <ul>
                             <li class="active" id="perfil" style="cursor:pointer"><a><?= translate('perfil_lang') ?></a></li>
                             <li><a id="ads" style="cursor:pointer"><?= translate('mis_anuncios_lang') ?> <span class="badge"></span></a></li>
                             <li><a href="<?= site_url('login/logout') ?>"><?= translate('sign_out_lang') ?></a></li>
                         </ul>
                     </div>
                     <!-- Categories -->

                 </div>
                 <div class="col-md-8 col-sm-12 col-xs-12">
                     <?php if (get_message_from_operation()) { ?>
                         <div class="alert">

                             <?= get_message_from_operation(); ?>
                         </div>
                     <?php } ?>
                     <!-- lista de anuncios -->
                     <div id="listado_anuncio" class="row">
                         <!-- Sorting Filters -->
                         <div class="col-md-12 col-xs-12 col-sm-12">
                             <ul class="pagination pagination-lg">
                                 <?php echo $this->pagination->create_links(); ?>
                             </ul>
                         </div>
                         <!-- Sorting Filters End-->
                         <div class="clearfix"></div>
                         <!-- Pagination -->

                         <!-- mis anuncios -->
                         <div class="posts-masonry">
                             <!-- primer anuncio -->
                             <?php $contador = 1;
                                foreach ($all_anuncios as $item) { ?>

                                 <div style="height:640.7px; margin-top:5px;" class="col-md-6 col-lg-6 col-sm-6 col-xs-12  ">
                                     <div class="white category-grid-box-1 ">
                                         <!-- foto -->
                                         <div class="image"> <img alt="Tour Package" src="<?= base_url($item->photo); ?>" class="img-responsive"> </div>
                                         <!--descripcion -->
                                         <div class="short-description-1 ">
                                             <!-- subcategoria  -->
                                             <div class="category-title"><?= $item->subcate->nombre; ?> </div>

                                             <!-- descripcion -->
                                             <h6>

                                                 <a title="" href="<?= site_url('front/detalle_anuncio/' . $item->anuncio_id) ?>"><?= $item->titulo; ?></a>
                                             </h6>
                                             <!-- Location -->
                                             <p class="location"><i class="fa fa-map-marker"></i> <?= $item->ciudad->name_ciudad; ?></p>
                                             <!-- Rating -->
                                             <div class="rating">
                                                 <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="rating-count">(2)</span>

                                             </div>
                                             <!-- Price --><span class="ad-price">$<?= number_format($item->precio, 2); ?></span>
                                         </div>
                                         <!-- Ad Meta Stats -->
                                         <div class="ad-info-1">
                                             <ul class="pull-left">
                                                 <li> <i class="fa fa-eye"></i><a href="#">445 Views</a> </li>
                                                 <li> <i class="fa fa-clock-o"></i>15 minutes ago </li>
                                             </ul>
                                             <ul class="pull-right">
                                                 <li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit this Ad" href="#"><i class="fa fa-pencil edit"></i></a> </li>
                                                 <li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Ad" href="#"><i class="fa fa-times delete"></i></a></li>
                                                 <button onclick="cargar_modal_imagen('<?= $item->anuncio_id ?>');"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>


                                             </ul>
                                         </div>
                                     </div>
                                 </div>

                             <?php } ?>
                             <!--fin primer anuncio-->

                         </div>

                         <!-- Ads Archive End -->

                         <!-- Pagination -->

                         <!-- Pagination End -->
                     </div>
                     <!-- Row -->

                     <!--perfil-->
                     <div id="panel_perfil" class="profile-section margin-bottom-20">
                         <div class="profile-tabs">
                             <ul class="nav nav-justified nav-tabs">
                                 <li id="perfil_tab" class="active"><a href="#profile" data-toggle="tab"><?= translate('profile_lang') ?></a></li>
                                 <li id="editar_tab"><a href="#edit" data-toggle="tab"><?= translate('edit_perfil') ?></a></li>
                                 <li id="membresia_tab"><a href="#membresia" data-toggle="tab"><?= translate('menbresi_lang') ?></a></li>

                             </ul>
                             <div class="tab-content">
                                 <div class="profile-edit tab-pane fade in active" id="profile">

                                     <dl class="dl-horizontal">
                                         <dt><strong><?= translate('name_cliente_lang') ?></strong></dt>
                                         <dd>
                                             <?= $this->session->userdata('name'); ?>
                                         </dd>
                                         <dt><strong> <?= translate('email_lang') ?> </strong></dt>
                                         <dd>
                                             <?= $this->session->userdata('email'); ?>
                                         </dd>
                                         <dt><strong> <?= translate('phone_user__lang') ?> </strong></dt>
                                         <dd>
                                             <?= $this->session->userdata('phone'); ?>
                                         </dd>
                                         <dt><strong> <?= translate('country_lang') ?> </strong></dt>
                                         <dd>
                                             England
                                         </dd>
                                         <dt><strong> <?= translate('name_city_lang') ?> </strong></dt>
                                         <dd>
                                             London
                                         </dd>

                                         <dt><strong> <?= translate('direccion_lang') ?> </strong></dt>
                                         <dd>
                                             Lahore, PK
                                         </dd>
                                     </dl>
                                 </div>
                                 <!--editar perfil-->
                                 <div class="profile-edit tab-pane fade" id="edit">

                                     <div class="clearfix"></div>
                                     <form>
                                         <div class="row">
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <label><?= translate('name_cliente_lang') ?></label>

                                                 <input type="text" value="<?= $this->session->userdata('name'); ?>" class="form-control margin-bottom-20">
                                             </div>
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <label> <?= translate('email_lang') ?> <span class="color-red">*</span></label>
                                                 <input type="text" value="<?= $this->session->userdata('email'); ?>" class="form-control margin-bottom-20">
                                             </div>
                                             <div class="col-md-12 col-sm-12 col-xs-12">
                                                 <label> <?= translate('phone_user__lang') ?> <span class="color-red">*</span></label>
                                                 <input type="text" value="<?= $this->session->userdata('phone'); ?>" class="form-control margin-bottom-20">
                                             </div>

                                             <!--aqui va el pais-->
                                             <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20">
                                                 <label> <?= translate('country_lang') ?> <span class="color-red">*</span></label>
                                                 <select class="form-control">
                                                     <option value="0">SriLanka</option>
                                                     <option value="1">Australia</option>
                                                     <option value="2">Bahrain</option>
                                                     <option value="3">Canada</option>
                                                     <option value="4">Denmark</option>
                                                     <option value="5">Germany</option>
                                                 </select>
                                             </div>

                                             <!--ciudades-->
                                             <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20">
                                                 <label> <?= translate('name_city_lang') ?> <span class="color-red">*</span></label>
                                                 <select class="form-control">
                                                     <option value="0">London</option>
                                                     <option value="1">Edinburgh</option>
                                                     <option value="2">Wales</option>
                                                     <option value="3">Cardiff</option>
                                                     <option value="4">Bradford</option>
                                                     <option value="5">Cambridge</option>
                                                 </select>
                                             </div>
                                             <div class="col-md-12 col-sm-12 col-xs-12">
                                                 <label> <?= translate('direccion_lang') ?> <span class="color-red">*</span></label>
                                                 <textarea class="form-control margin-bottom-20" rows="3"></textarea>
                                             </div>
                                         </div>
                                         <div class="row margin-bottom-20">
                                             <div class="form-group">
                                                 <div class="col-md-9">
                                                     <div class="input-group">
                                                         <span class="input-group-btn">
                                                             <span class="btn btn-default btn-file">
                                                                 <?= translate('photo_lang') ?> <input type="file" id="imgInp">
                                                             </span>
                                                         </span>
                                                         <input type="text" class="form-control" readonly>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-3">
                                                     <img id="img-upload" class="img-responsive" src="images/users/2.jpg" alt="" />
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="clearfix"></div>

                                         <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-12">
                                                 <div class="form-group">
                                                     <div class="skin-minimal">
                                                         <ul class="list">

                                                         </ul>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                                                 <button type="submit" class="btn btn-theme btn-sm"><?= translate('update_info_lang') ?></button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                                 <?php if ($all_membresia) { ?>
                                     <div class="profile-edit tab-pane fade" id="membresia">

                                         <br>
                                         <!--Checkout-Form-->
                                         <dl class="dl-horizontal">

                                             <dt><strong><?= translate('membresia_act_lang') ?></strong></dt>
                                             <dd>
                                                 <?= $all_membresia->nombre ?>
                                             </dd>
                                             <dt><strong><?= translate('date_compra_lang') ?> </strong></dt>
                                             <dd>
                                                 <?= $all_membresia->fecha ?>
                                             </dd>
                                             <dt><strong><?= translate('cant_anuncios_lang') ?> </strong></dt>
                                             <dd>
                                                 <?= $all_membresia->cant_anuncio ?>
                                             </dd>
                                         </dl>


                                         <!--End Checkout-Form-->

                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
                     <!-- Row End -->
                 </div>
                 <!-- Middle Content Area  End -->
             </div>
             <!-- Row End -->
         </div>
         <!-- Main Container End -->
     </section>
     <!-- Mostrando y ocultando vistas-->
     <script type="text/javascript">
         $(function() {
             $("#listado_anuncio").hide();
             $("#panel_perfil").show();
         });

         $("#perfil").click(function() {
             $("#listado_anuncio").hide();
             $("#panel_perfil").show();
         });
         $("#ads").click(function() {
             $("#listado_anuncio").show();
             $("#panel_perfil").hide();
         });
     </script>
     <style>
         h6 a:hover {
             color: #8c1822 !important;
         }

         h6 a {
             color: #000 !important;
         }
     </style>