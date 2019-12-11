 <!-- =-=-=-=-=-=-= Light Header End  =-=-=-=-=-=-=  -->
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

             <li><a class="active" href="<?= site_url('contacto') ?>"><?= translate('contact_lang') ?></a></li>
          </ul>
       </div>
    </div>
 </div>
 <!-- Small Breadcrumb -->
 <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
 <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
 <div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding ">
       <!-- Main Container -->
       <div class="container">
          <!-- Row -->
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12 no-padding commentForm">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                   <div class="">
                      <h3 class="text-center"><?= translate('send_menssage_lang') ?></h3>
                      <?= form_open('front/contacto_mensaje'); ?>
                      <?= get_message_from_operation(); ?>
                      <div class="row">
                         <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="form-group">
                               <input required placeholder="<?= translate('nombre_lang'); ?>" class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                               <input placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group">
                               <textarea cols="12" rows="7" placeholder="<?= translate('message_lang') ?>" id="message" name="mensaje" class="form-control" required></textarea>
                            </div>
                         </div>

                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-theme" type="submit"><?= translate('enviar_lang') ?></button>
                         </div>
                      </div>
                      </form>
                   </div>
                </div>
                <div class="col-lg-2 col-md-2"></div>
                <?= form_close(); ?>
             </div>
          </div>
          <!-- Row End -->
       </div>
       <!-- Main Container End -->
    </section>