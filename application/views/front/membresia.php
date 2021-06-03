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
      <div class="main-content-area clearfix" style="background-color: #212233;">
          <section class="custom-padding">
              <!-- Main Container -->
              <div class="container">
                  <!-- Row -->
                  <div class="row">
                      <!-- Heading Area -->
                      <div class="heading-panel">
                          <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                              <!-- Main Title -->
                              <h1 style="color:#fff"><?= translate('menbresi_descrip_lang') ?> <span class="heading-color" style="color:#fff"><?= translate('name_plan_lang') ?></span></h1>
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
                                          <div class="row">
                                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                  <svg xmlns="http://www.w3.org/2000/svg" version="1.2" baseProfile="tiny-ps" viewBox="0 0 334 229" width="300" height="150">
                                                      <defs>
                                                          <image width="48" height="48" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAB50lEQVRoQ+1ZQW6DMBDclVDOvTYQiR+0/UH7kqY/yE+aJ7QvaZ8AP0CK4dxzFckRFZaQZZvdeAMVco6RGZjxencYsCi2Ghw/pTp0/e/7z4fjWy+Fj54b10p1j0wCFQA8EK8Rw3cSQMS306n9ID7M37I8vz8g4jvlGkl8FwG2Ouahi2JL2QVRfJtAnWWb56ZpfihK2mvKsrw7n3+/A6Ukjm8I1Ih45JaNj+Rul++11ocRkZvhkzrNUN+vAGAOdqU1Htu2/bxmp+xrYvCDBIaS+Bo9uH3vKss2L5ElF4UfJEA8lJVS3dM1OyGB7yWwVFt0CRFqu14CRHXM/di7IIUfIuC0GLe2Blz8VROgTFUjGHu6MkvIi7/eQ9xLS1SJrb6kd6IMslm9jXWIJ70TyUrM6W0GAmTvZMzcv/E2lIk+9k62nV7c24QIuLyZ64WGPVWZh1IUf5WvlL2gbJWILVfcO/lSCZCKPbjehhvbrJYAe7oyS0gMf5WHmK0Os42K4qdcyNU15vROJDMXk9twvc2wnuzNKHY6Krfhehtr/aQ3S7lQr5hkXJ5yoVFPT7lQ6ABLfVOTihbZ01XKO6VcCADY6kt6J8ogS7nQlJ2I8U4pFxqru8Q3tZQLmR1Y6puaL5VIudBU55HKnS7WEGfn4VKIdQAAAABJRU5ErkJggg==" />
                                                          <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                                              <path d="M46.96 22.72L122.03 22.72L163.55 7.62L208.83 22.72L280.66 22.72L280.66 46.66L315.54 57.59L315.54 159.09L281.7 170.54L281.7 195.01L208.83 195.01L163.55 210.62L122.03 196.05L46.96 195.53L46.96 170.54L12.39 160.13L12.39 58.63L46.43 45.1L46.96 22.72Z" />
                                                          </clipPath>
                                                      </defs>
                                                      <style>
                                                          tspan {
                                                              white-space: pre
                                                          }

                                                          .shp0 {
                                                              fill: #201b17
                                                          }

                                                          .shp1 {
                                                              fill: #ffffff
                                                          }

                                                          .shp2 {
                                                              fill: #<?= $item->color ?>
                                                          }

                                                          .shp3 {
                                                              fill: none;
                                                              stroke: #ffffff;
                                                              stroke-width: 2.215;
                                                              stroke-dasharray: 7
                                                          }

                                                          .txt4 {
                                                              font-size: 73px;
                                                              fill: #ffffff;
                                                              font-weight: 711;
                                                              font-family: "CooperHewitt-Bold", "Cooper Hewitt";
                                                              text-align: "center";
                                                          }

                                                          .txt5 {
                                                              font-size: 41px;
                                                              fill: #ffffff;
                                                              font-weight: 711;
                                                              font-family: "CooperHewitt-Bold", "Cooper Hewitt";
                                                              text-align: "center";
                                                          }

                                                          .shp6 {
                                                              fill: none;
                                                              stroke: #ffffff;
                                                              stroke-width: 3.691;
                                                              stroke-dasharray: 7
                                                          }
                                                      </style>
                                                      <g id="elements">
                                                          <g id="&lt;Group&gt;">
                                                              <path id="&lt;Path&gt;" class="shp0" d="M44.79 26.37L125.51 26.37L170.16 10.13L218.85 26.37L296.09 26.37L296.09 52.11L333.58 63.86L333.58 173L297.21 185.32L297.21 211.62L218.85 211.62L170.16 228.41L125.51 212.74L44.79 212.18L44.79 185.32L7.61 174.12L7.61 64.98L44.23 50.43L44.79 26.37Z" />
                                                              <path id="&lt;Path&gt;" class="shp1" d="M38.15 16.21L118.87 16.21L163.52 -0.02L212.21 16.21L289.45 16.21L289.45 41.96L326.95 53.71L326.95 162.85L290.57 175.17L290.57 201.47L212.21 201.47L163.52 218.26L118.87 202.59L38.15 202.03L38.15 175.17L0.98 163.97L0.98 54.83L37.59 40.28L38.15 16.21Z" />
                                                              <path id="&lt;Path&gt;" fill="#<?= $item->color ?>" d="M46.96 22.72L122.03 22.72L163.55 7.62L208.83 22.72L280.66 22.72L280.66 46.66L315.54 57.59L315.54 159.09L281.7 170.54L281.7 195.01L208.83 195.01L163.55 210.62L122.03 196.05L46.96 195.53L46.96 170.54L12.39 160.13L12.39 58.63L46.43 45.1L46.96 22.72Z" />
                                                              <g id="&lt;Group&gt;">
                                                                  <g clip-path="url(#cp1)">
                                                                      <use id="&lt;Path&gt;" href="#img1" transform="matrix(0.738,0,0,0.738,-550,-57)" />
                                                                  </g>
                                                              </g>
                                                              <path id="&lt;Path&gt;" class="shp3" d="M55.15 28.77L124.97 28.77L163.58 14.73L205.69 28.77L272.5 28.77L272.5 51.03L304.93 61.2L304.93 155.59L273.46 166.24L273.46 188.99L205.69 188.99L163.58 203.52L124.97 189.96L55.15 189.48L55.15 166.24L23 156.56L23 62.17L54.66 49.58L55.15 28.77Z" />
                                                              <text id="BEST " style="transform: matrix(1,0,0,1,114.566,94.96)">
                                                                  <tspan x="0" y="0" class="txt5">PLAN</tspan>
                                                              </text>
                                                              <text id="CHOICE " <?php
                                                                                    if (strlen($item->nombre) == 3) {
                                                                                        echo 'style="transform:matrix(1,0,0,1,115.105,154.139)"';
                                                                                    } else if (strlen($item->nombre) == 4) {
                                                                                        echo 'style="transform:matrix(1,0,0,1,102.105,154.139)"';
                                                                                    } else {
                                                                                        echo 'style="transform:matrix(1,0,0,1,81.105,154.139)"';
                                                                                    }
                                                                                    ?>>
                                                                  <tspan x="0" y="0" class="txt4"><?= $item->nombre ?></tspan>
                                                              </text>
                                                              <path id="&lt;Path&gt;" class="shp6" d="M172.62 39.25L215.81 39.25" />
                                                              <path id="&lt;Path&gt;" class="shp6" d="M112.11 39.25L154.87 39.25" />
                                                              <path id="&lt;Path&gt;" class="shp1" d="M163.88 30.78L165.66 35.74L170.88 35.91L166.76 39.15L168.21 44.21L163.88 41.25L159.56 44.21L161.01 39.15L156.89 35.91L162.11 35.74L163.88 30.78Z" />
                                                              <path id="&lt;Path&gt;" class="shp1" d="M164.77 167.26L167.77 176.03L176.57 176.34L169.62 182.07L172.07 191.03L164.77 185.79L157.47 191.03L159.92 182.07L152.97 176.34L161.77 176.03L164.77 167.26Z" />
                                                              <path id="&lt;Path&gt;" class="shp1" d="M136.24 173.71L137.89 178.55L142.74 178.72L138.91 181.87L140.26 186.81L136.24 183.92L132.23 186.81L133.57 181.87L129.74 178.72L134.59 178.55L136.24 173.71Z" />
                                                              <path id="&lt;Path&gt;" class="shp1" d="M193.16 173.71L191.51 178.55L186.66 178.72L190.49 181.87L189.14 186.81L193.16 183.92L197.18 186.81L195.83 181.87L199.66 178.72L194.81 178.55L193.16 173.71Z" />
                                                          </g>
                                                      </g>
                                                  </svg>
                                              </div>
                                          </div>
                                          <span class="price" style="color:#fff">$<?= number_format($item->precio, 2); ?></span>
                                          <span class="time" style="color:#fff"><?= translate('cant_anuncios_lang') ?> <?= $item->cant_anuncio; ?></span>
                                          <br>
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