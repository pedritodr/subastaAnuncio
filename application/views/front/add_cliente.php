     <style>
        .btn-theme-register {
           color: #ffffff;
           background-color: #8c1822;
        }
     </style>
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
                 <div class="col-md-6 col-md-push-3 col-sm-12 col-xs-12">
                    <!--  Form -->
                    <div class="form-grid">
                       <div class="row">
                          <div class="col-lg-12">
                             <div class="form-group">
                                <label>E-mail del referidor</label>
                                <?php if (isset($user)) { ?>
                                   <?php if ($user) { ?>
                                      <input placeholder="Ej. referidor@subastanuncio.com" class="form-control" disabled type="email" id="referidor" value="<?= $user->email ?>" required>
                                   <?php } else { ?>
                                      <input placeholder="Ej. referidor@subastanuncio.com" class="form-control" type="email" id="referidor" required>
                                   <?php } ?>
                                <?php } else { ?>
                                   <input placeholder="Ej. referidor@subastanuncio.com" class="form-control" type="email" id="referidor" required>
                                <?php } ?>
                             </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate("primer_nombre_lang"); ?></label>
                                <input required placeholder="Ej. Jesus" class="form-control input-text" type="text" id="name" name="name">
                             </div>
                          </div>
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate("primer_apellido_lang"); ?></label>
                                <input required placeholder="Ej. Perez" class="form-control input-text" type="text" id="surname" name="surname">
                             </div>
                          </div>
                          <div class="col-lg-12">
                             <div style="background: none;" id="search-section">

                                <div class="row">
                                   <div class="col-sm-12 col-xs-12 col-md-12">
                                      <div class="col-md-5 col-xs-12 col-sm-5 no-padding">
                                         <select class="form-control" name="tipo_documento" id="tipo_documento" required>

                                            <option value="1">Cédula</option>
                                            <option value="2">Pasaporte</option>
                                         </select>
                                      </div>
                                      <div class="col-md-7 col-xs-12 col-sm-7 no-padding">
                                         <input id="nro_documento" name="nro_documento" type="text" class="form-control" placeholder="Nro de documento de identidad" required />
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate("email_lang"); ?></label>
                                <input placeholder="Ej. info@subastanuncio.com" class="form-control" type="email" name="email" id="email" required>
                             </div>
                          </div>
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate("phone_user__lang"); ?></label>
                                <input placeholder="Ej. 986547800" class="form-control input-number" type="number" name="phone" id="phone" required>
                             </div>
                          </div>
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate('password_lang'); ?></label>
                                <input placeholder="<?= translate('password_lang'); ?>" class="form-control" type="password" name="password" id="password" required>
                             </div>
                          </div>
                          <div class="col-lg-6">
                             <div class="form-group">
                                <label><?= translate('repeat_password_lang'); ?></label>
                                <input placeholder="<?= translate('repeat_password_lang'); ?>" class="form-control" type="password" name="repeat_password" id="repeat_password" required>
                             </div>
                          </div>
                       </div>
                       <button type="buttom" class="btn btn-theme-register btn-lg btn-block" onclick="submitRegister()"><?= translate('registrarse_lang'); ?></button>
                    </div>
                    <!-- Form -->
                 </div>
                 <!-- Middle Content Area  End -->
              </div>
              <!-- Row End -->
           </div>
           <!-- Main Container End -->
        </section>
     </div>
     <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
     <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
     <script>
        const validarEmail = (email) => {
           expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           if (!expr.test(email)) {
              $('#email').val("");
              $('#email').focus();
           } else {
              $('#email').val(email.trim());
           }
        }

        $('.input-number').on('input', () => {
           this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('.input-text').on('input', () => {
           this.value = this.value.replace(/[^a-zA-ZáéíóúñüàèÑ ]/i, '');
        });

        $("#email").change(() => {
           var email = $('#email').val();
           $('#email').val(email.trim());
           validarEmail(email);
        });

        $('#name').change(() => {
           let texto = $('#name').val();
           texto = texto.trim();
           texto = texto.split(" ");
           if (texto.length > 1) {
              texto = texto[0];
           } else {
              texto = texto[0];
           }
           $('#name').val(texto);
        });

        $('#surname').change(() => {
           let texto = $('#surname').val();
           texto = texto.trim();
           texto = texto.split(" ");
           if (texto.length >= 2) {
              texto = texto[0] + " " + texto[1];
           } else {
              texto = texto[0];
           }
           $('#surname').val(texto);
        });

        const submitRegister = () => {
           let referidor = $('#referidor').val().trim();
           let name = $('#name').val().trim();
           let surname = $('#surname').val().trim();
           let tipo_documento = $('#tipo_documento').val();
           let nro_documento = $('#nro_documento').val().trim();
           let email = $('#email').val().trim();
           let phone = $('#phone').val().trim();
           let password = $('#password').val().trim();
           let repeat_password = $('#repeat_password').val().trim();
           if (name == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo nombre es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#name').focus();
              })
           } else if (surname == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo apellido es obligatorio',
                 showCancelButton: true,
                 confirmButtonText: `Ok`,
              }).then((result) => {
                 $('#surname').focus();
              })
           } else if (nro_documento == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo número de documento es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#nro_documento').focus();
              })
           } else if (email == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El correo electrónico es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#email').focus();
              })
           } else if (phone == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo número de teléfono es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#phone').focus();
              })
           } else if (password == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo contraseña es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#password').focus();
              })
           } else if (repeat_password == '') {
              Swal.fire({
                 icon: 'info',
                 text: 'El campo repetir contraseña es obligatorio',
                 showCancelButton: false,
                 confirmButtonText: 'Continuar',
              }).then((result) => {
                 $('#repeat_password').focus();
              })
           } else {
              if (password != repeat_password) {
                 Swal.fire({
                    icon: 'info',
                    text: 'El campo repetir contraseña es diferente del campo contraseña',
                    showCancelButton: false,
                    confirmButtonText: 'Continuar',
                 }).then((result) => {
                    $('#password').focus();
                 })
              } else {
                 Swal.fire({
                    title: 'Completando operación',
                    text: 'Registrando el usuario...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                 });
                 let data = {
                    referidor,
                    name,
                    surname,
                    nro_documento,
                    tipo_documento,
                    email,
                    phone,
                    password
                 }
                 setTimeout(() => {
                    $.ajax({
                       type: 'POST',
                       url: "<?= site_url('front/add_cliente') ?>",
                       data: data,
                       success: function(result) {
                          result = JSON.parse(result);
                          if (result.status == 200) {
                             Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Correcto',
                                showConfirmButton: false,
                                timer: 1500
                             })
                             setTimeout(() => {
                                window.location = '<?= site_url('activacion') ?>';
                             }, 1000);
                          } else {
                             Swal.close();
                             swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                             });
                          }
                       }
                    });
                 }, 1500)
              }
           }
        }
     </script>