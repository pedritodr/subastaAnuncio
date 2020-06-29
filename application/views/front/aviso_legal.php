      <!-- Master Slider -->
      <?php if (count($all_banners) > 0) { ?>
          <div class="master-slider ms-skin-default banner2" id="masterslider">
              <?php foreach ($all_banners as $item) { ?>
                  <div class="ms-slide slide-1" data-delay="5">
                      <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />

                      <!--  <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs" style="left:90px; top:170px;" data-type="text" data-delay="2000" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)">2017 Ducati Panigale 959 </h3>
                  <h3 class="ms-layer title4 font-white font-thin-xs" style="left:90px; top:220px;" data-type="text" data-delay="2500" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)"><span class="font-color">Brand new 0 kms</span></h3>

                  <h5 class="ms-layer text1 font-white" style="left: 92px; top: 295px;" data-type="text" data-effect="bottom(45)" data-duration="2500" data-delay="3000" data-ease="easeOutExpo">Lorem Ipsum is simply dummy text of the printing typesetting<br>
                     industry is proident sunt in culpa officia deserunt mollit.
                  </h5>
                  <a class="ms-layer btn3 uppercase" style="left:95px; top: 405px;" data-type="text" data-delay="3500" data-ease="easeOutExpo" data-duration="2000" data-effect="scale(1.5,1.6)"> Get Started Now!</a> -->
                  </div>
              <?php } ?>
          </div>
      <?php } ?>
      <!-- end Master Slider -->
      <div class="main-content-area clearfix">

          <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
          <section class="section-padding error-page pattern-bg ">
              <!-- Main Container -->
              <div class="container">
                  <!-- Row -->
                  <div class="row">
                      <!-- Middle Content Area -->
                      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <h1 class="text-left"><?= translate('aviso_legal_lang') ?></h1>
                          <p class="text-justify">1. El titular de esta página Web es MARLON ALBERTO FLORES SANCHEZ (en adelante, LA ENTIDAD), con RUC 100244421200, domicilio en Jacinto Egas #1459 y Río Morona, Ibarra, Ecuador. E-mail: <a href="info@subastanuncios.com">info@subastanuncios.com</a>. Teléfono de atención: +(593) 967133720.</p>

                          <p class="text-justify">2. El hecho de utilizar o interactuar con la web <a herf="<?= site_url() ?>">SUBASTANUNCIOS.COM</a>, en cualquiera de sus módulos, implica por parte del Usuario, la aceptación de todas las condiciones detalladles en este Aviso Legal. Es obligación del Usuario dar lectura e interpretar dichas condiciones al realizar su acceso a la web. De igual forma, mantenerse actualizado en cuanto a la información que en ellas puedan modificarse cotidianamente. Se entiende, que algunos elementos dentro de la web podrían conllevar a Condiciones Exclusivas, dependiendo de su propia estructura o peculiaridades, las cuales podrían en cualquier caso sustituir o modificar los términos del presente documento. </p>
                          <p class="text-justify">3. Todos los elementos que conforman la web <a herf="<?= site_url() ?>">SUBASTANUNCIOS.COM</a> (textos, banners, publicidades directas, imágenes, logotipos, formatos tecnológicos, formatos de bases de datos, contenidos audiovisuales o sonoros, etc.), así como las marcas y demás signos distintivos son propiedad de LA ENTIDAD o de terceros, no permitiendo a los usuarios recibir derecho alguno sobre los mismos, en ningún momento durante el uso de la plataforma. adquiriendo el Usuario ningún derecho sobre ellos por el mero uso de esta Web.</p>
                          <p class="text-justify">Por ello, los usuarios se obligan a:</p>
                          <p class="text-justify">• No promover o efectuar copias, distribuciones, poner a disposición de terceros, comunicar de manera pública, transformar o modificar los contenidos que esta web se muestran.</p>
                          <p class="text-justify">• No recrear o simular para uso privado el software, las imágenes, los videos o las bases de datos existentes en esta Web.</p>
                          <p class="text-justify">• No utilizar la marca o cualquier otro signo distintivo de LA ENTIDAD dentro de su página Web, salvo en los casos autorizados por la ley o permitidos expresamente por LA ENTIDAD.</p>
                          <p class="text-justify">4. LA ENTIDAD no se hace responsable de la posible existencia de archivos maliciosos proveídos por otros usuarios. LA ENTIDAD no se responsabiliza de los daños producidos a equipos informáticos durante el acceso a la presente Web. </p>
                          <p class="text-justify">5. En la web se podrán encontrar links que redirijan la navegación del usuario hacia otra página en internet. La Entidad no se hace responsable de las interacciones que realice el Usuario una vez que interactúe con sitios terceros. </p>
                          <p class="text-justify">6. El Usuario se compromete a hacer un uso correcto de esta Web de conformidad con la Ley, con el presente Aviso Legal y con las demás condiciones, reglamentos e instrucciones que, en su caso, pudieran ser de aplicación. El Usuario responderá frente a LA ENTIDAD y frente a terceros de cualesquiera daños o perjuicios que pudieran causarse por incumplimiento de estas obligaciones.</p>
                          <p class="text-justify">1. El presente Aviso Legal se rige íntegramente por la legislación ecuatoriana. Para la resolución de cualquier conflicto relativo a la interpretación o aplicación de este Aviso Legal, el Usuario se somete expresamente a la jurisdicción de los tribunales del domicilio de LA ENTIDAD.</p>


                      </div>

                      <!-- Middle Content Area  End -->
                  </div>
                  <!-- Row End -->
              </div>
              <!-- Main Container End -->
          </section>
          <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
          <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->

          <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
      </div>
      <style>
          /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

          /* Carousel base class */
          .carousel {
              margin-bottom: 58px;
          }

          /* Since positioning the image, we need to help out the caption */
          .carousel-caption {
              z-index: 1;
          }

          /* Declare heights because of positioning of img element */
          .carousel .item {
              height: 500px;
              background-color: #555;
          }

          .carousel img {
              position: absolute;
              top: 0;
              left: 0;
              min-height: 500px;
          }

          .banner2 {
              padding-top: 107px !important
          }

          @media screen and (max-width: 992px) {
              /*      .banner2 {
            margin-top: 0
         } */

              .carousel .item {
                  height: 300px;
                  background-color: #555;
              }

              .carousel img {
                  position: absolute;
                  top: 0;
                  left: 0;
                  min-height: 300px;
              }
          }

          @media screen and (max-width: 400px) {
              /*   .banner2 {
   margin-top: 29% !important
} */

              .carousel .item {
                  height: 300px;
                  background-color: #555;
              }

              .carousel img {
                  position: absolute;
                  top: 0;
                  left: 0;
                  min-height: 300px;
              }
          }
      </style>