<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_users_lang'); ?>
            <small><?= translate('add_user_lang'); ?></small>
            | <a href="<?= site_url('user/cliente'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('user_list_lang'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_user_lang'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label><?= translate("primer_nombre_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input required placeholder="Ej. Jesus" class="form-control input-text input-sm" type="text" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label><?= translate("primer_apellido_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input required placeholder="Ej. Perez" class="form-control input-text input-sm" type="text" id="surname" name="surname">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Tipo de documento</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="tipo_documento" name="tipo_documento" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                        <option value="1">Cédula</option>
                                        <option value="2">Pasaporte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Número de documento</label>
                                <div class="input-group">
                                    <span class="input-group-addon">#</span>
                                    <input id="nro_documento" name="nro_documento" type="text" class="form-control input-sm" placeholder="Nro de documento de identidad" required />
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <label><?= translate("email_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input placeholder="Ej. info@subastanuncio.com" class="form-control input-sm" type="email" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Email referidor</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input placeholder="Ej. referidor@subastanuncio.com" class="form-control input-sm" type="email" id="referidor" required>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <label><?= translate("phone_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                    <input placeholder="Ej. 986547800" class="form-control input-number input-sm" type="number" name="phone" id="phone" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label><?= translate("role_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="role" name="role" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                        <?php
                                        if (isset($all_roles))
                                            foreach ($all_roles as $item) { ?>
                                            <?php if ($item->role_id == 2) { ?>
                                                <option value="<?= $item->role_id; ?>"><?= $item->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label><?= translate('password_lang'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input placeholder="<?= translate('password_lang'); ?>" class="form-control input-sm" type="password" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label><?= translate('repeat_password_lang'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input placeholder="<?= translate('repeat_password_lang'); ?>" class="form-control input-sm" type="password" name="repeat_password" id="repeat_password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <div class="col-xs-12" style="text-align: right;">
                                <button type="button" class="btn btn-primary" onclick="submitRegister()"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
    });
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
                        url: "<?= site_url('user/add_cliente') ?>",
                        data: data,
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    text: result.msj,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                })
                                setTimeout(() => {
                                    window.location = '<?= site_url('user/cliente') ?>';
                                }, 1000);
                            } else {
                                Swal.close();
                                Swal.fire({
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