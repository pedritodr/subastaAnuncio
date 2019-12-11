 <!-- =-=-=-=-=-=-= Light Header End  =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb =-=-=-=-=-=-= -->
      <div class="page-header-area">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="header-page">
                     <h1><?=translate('create_cuenta_lang')?></h1>
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
               <li><a href="#"><?= translate('inicio_lang')?></a></li>
                  <li><a href="#"><?= translate('name_pag_lang')?></a></li>
                  <li><a class="active" href="#"><?= translate('registrarse_lang')?></a></li>
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
                  <div class="col-md-5 col-md-push-7 col-sm-12 col-xs-12">
                     <!--  Form -->
                     <div class="form-grid">
                     <form action="<?= site_url('front/add_cliente'); ?>" method="post">
                <?= get_message_from_operation(); ?>
                           <div class="form-group">
                              <label><?= translate("nombre_lang"); ?></label>
                              <input required placeholder="<?= translate('nombre_lang'); ?>"class="form-control" type="text" name="name">
                           </div>
                           <div class="form-group">
                              <label><?= translate("phone_person__lang"); ?></label>  
                              <input placeholder="<?= translate("phone_person__lang"); ?>" class="form-control" type="text" name="phone">
                           </div>
                           <div class="form-group">
                              <label><?= translate("email_lang"); ?></label>
                              <input placeholder="<?= translate("email_lang"); ?>" class="form-control" type="email" name="email">
                           </div>
                           <div class="form-group">
                              <label><?= translate('password_lang'); ?></label>
                              <input placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" name="password">
                           </div>

                           <div class="form-group">
                              <label><?= translate('repeat_password_lang'); ?></label>
                              <input placeholder="<?= translate('repeat_password_lang'); ?>" class="form-control" type="password" name="repeat_password">
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-xs-12 col-sm-7">
                                    <div class="skin-minimal">
                                       <ul class="list">
                                          <li>
                                           
                                           
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>
                           <button  type="submit" class="btn btn-theme btn-lg btn-block"><?= translate('entrar_lang'); ?></button>
                        </form>
                     </div>
                     <!-- Form -->
                  </div>
                 
                  <div class="col-md-7  col-md-pull-5  col-sm-12 col-xs-12">
                     <div class="heading-panel">
                        <h3 class="main-title text-left">
                        <h1><?=translate('create_cuenta_lang')?></h1>
                        </h3>
                     </div>
                     <div class="content-info">
                        <div class="features">
                           <div class="features-icons">
                              <img src="<?= base_url('assets_front/images/icons/chat.png')?>" alt="img">
                           </div>
                           <div class="features-text">
                              <h3>Chat & Messaging</h3>
                              <p>
                                 Access your chats and account info from any device.
                              </p>
                           </div>
                        </div>
                        <div class="features">
                           <div class="features-icons">
                              <img src="<?= base_url('assets_front/images/icons/panel.png')?>" alt="img">
                           </div>
                           <div class="features-text">
                              <h3>User Dashboard</h3>
                              <p>
                                 Maintain a wishlist by saving your favourite items.
                              </p>
                           </div>
                        </div>
                        <div class="features">
                           <div class="features-icons">
                              <img src="<?= base_url('assets_front/images/icons/history.png')?>" alt="img">
                           </div>
                           <div class="features-text">
                              <h3>Track History</h3>
                              <p>
                                 Track the status of your ads history.
                              </p>
                           </div>
                        </div>
                        <div class="features">
                           <div class="features-icons">
                              <img src="<?= base_url('assets_front/images/icons/featured-listing.png')?>" alt="img">
                           </div>
                           <div class="features-text">
                              <h3>features Listing</h3>
                              <p>
                                 Get more value fro your ad.
                              </p>
                           </div>
                        </div>
                        <span class="arrowsign hidden-sm hidden-xs"><img src="images/arrow.png" alt=""></span>
                     </div>
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>