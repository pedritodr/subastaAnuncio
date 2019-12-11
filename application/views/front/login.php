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

              <li><a class="active" href="<?= site_url('login') ?>"><?= translate('login_lang') ?></a></li>
           </ul>
        </div>
     </div>
  </div>
  <!-- Small Breadcrumb -->
  <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
  <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
  <div class="main-content-area clearfix">
     <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
     <section class="section-padding error-page pattern-bg ">
        <!-- Main Container -->
        <div class="container">
           <!-- Row -->
           <div class="row">
              <!-- Middle Content Area -->
              <div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                 <!--  Form -->
                 <div class="">

                    <?= form_open('login/auth'); ?>
                    <?php if (get_message_from_operation()) { ?>
                       <div role="alert" class="alert alert-success alert-dismissible">
                          <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                          <strong><?= get_message_from_operation(); ?></strong>
                       </div>
                    <?php } ?>

                    <div class="form-group">
                       <label><?= translate("email_lang"); ?></label>
                       <input required placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" name="email">
                    </div>
                    <div class="form-group">
                       <label><?= translate('password_lang'); ?></label>
                       <input required placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                       <div class="row">
                          <div class="col-xs-12">
                             <div class="skin-minimal">
                                <ul class="list">
                                   <li>
                                      <input type="checkbox" id="minimal-checkbox-1">
                                      <label for="minimal-checkbox-1">Remember Me</label>
                                   </li>
                                </ul>
                                <div class="col-xs-12 col-sm-5 text-right">
                                   <p class="help-block"><a data-target="#myModal" data-toggle="modal"><?= translate('i_forgot_password_lang'); ?></a>
                                   </p>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('entrar_lang'); ?></button>

                 </div>
                 <!-- Form -->
                 <?= form_close(); ?>
                 <!-- Middle Content Area  End -->
              </div>
              <!-- Row End -->
           </div>
           <!-- Main Container End -->
     </section>
     <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
  </div>
  <!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->
  <div class="custom-modal">
     <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header rte">
                 <h2 class="modal-title"><?= translate('i_forgot_password_lang'); ?></h2>
              </div>
              <?= form_open("login/recover_password") ?>

              <div class="modal-body">

                 <div class="form-group">
                    <label><?= translate('email_lang'); ?></label>
                    <input placeholder="<?= translate('escriba_email_lang'); ?>" class="form-control" type="email" name="email">
                 </div>
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-default"><?= translate('recuperar_password_lang'); ?></button>
                 <button type="button" class="btn btn-dark" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>
              </div>
              <?= form_close(); ?>
           </div>
        </div>
     </div>
  </div>
  <!-- =-=-=-=-=-=-= Share Modal =-=-=-=-=-=-= -->