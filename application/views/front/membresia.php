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
                                          <span class="time"><?= translate('descripcion_lang') ?></span>
                                          <div style="height:260px !important" class="text-left">
                                              <?= $item->descripcion; ?>
                                          </div>
                                          <?php if ($this->session->userdata('user_id')) { ?>
                                              <a style="cursor:pointer;" onclick="modalMetodoPago('<?= base64_encode(json_encode($item)); ?>');" class="btn btn-theme"><?= translate('select_plan_lang') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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
      <div class="modal fade price-quote" id="modalMetodoPago" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title text-center" id="lineModalLabel">Métodos de pagos</h3>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" id='subasta_id' name="subasta_id">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group">
                                  <label> Tipos de pagos<span class="color-red">*</span></label>
                                  <select id="typePayment" class="form-control select2">
                                      <option value="1">Tarjeta</option>
                                      <option value="2">Billetera</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 margin-bottom-20 margin-top-20 text-right">
                          <button type="button" onclick="handleTypePayment()" class="btn btn-blue margin-bottom-10">Enviar</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <style>
          .pricing ul {
              font-size: 14px;
              font-weight: 400;
              list-style-type: square;
              margin: 50px 30px 30px;
              padding: 0;
              text-align: left;
          }
      </style>
      <script type="text/javascript">
          const modalMetodoPago = (obj) => {
              localStorage.setItem('membresia', obj);
              $('#modalMetodoPago').modal('show');
          }
      </script>