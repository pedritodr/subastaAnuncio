<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= "Gestión de Clientes"; ?>
            <small><?= translate('users_lang'); ?></small>
            | <a href="<?= site_url('user/add_cliente_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Clientes</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:10%">&nbsp;</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th>Cédula</th>
                                    <th>Dirección</th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th>Telefono</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_users as $item) { ?>
                                    <tr>
                                        <?php
                                        if ($item->photo == "") {
                                        ?>
                                            <td>&nbsp;</td>
                                        <?php
                                        } else {
                                        ?>
                                            <td> <img style="width: 75%; margin: 0 auto;" class="img img-rounded img-responsive" src="<?= site_url($item->photo); ?>"></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= $item->name; ?> <?= $item->surname; ?></td>
                                        <td><?= $item->cedula; ?></td>
                                        <td><?= $item->direccion; ?></td>
                                        <td><?= $item->email; ?></td>

                                        <td>
                                            <a style="color:black;" href="tel:<?= $item->phone ?>"><?= $item->phone; ?></a>
                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <?php if ($item->user_id != 4) { ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?= site_url('user/detalles/' . $item->user_id); ?>"><i class="fa fa-search"></i>Detalles</a></li>
                                                        <li><a href="javascrip:void()" onclick="modalReferidor('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-smile-o"></i>Referidor</a></li>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:10%">&nbsp;</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th>Cédula</th>
                                    <th>Dirección</th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th>Telefono</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="modalReferidor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="titulo_detalle">Referidor</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="user_id">
                    <div class="col-lg-12">
                        <label>Email referidor</label>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input disabled placeholder="Ej. referidor@subastanuncio.com" class="form-control input-sm" type="email" id="referidor" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <!--  <button onclick="updateReferido()" type="button" class="btn btn-success">Actualizar</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#example1").DataTable();
    });

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const modalReferidor = (obj) => {
        obj = JSON.parse(decodeB64Utf8(obj));;
        $('#user_id').val(obj.user_id);
        if (obj.referidor) {
            $('#referidor').val(obj.referidor.email ? obj.referidor.email : '');
        } else {
            $('#referidor').val('');
        }
        $('#modalReferidor').modal('show');
    }

    const updateReferido = () => {
        let referidor = $('#referidor').val().trim();
        let userId = $('#user_id').val();
        if (referidor == '') {
            Swal.fire({
                icon: 'info',
                text: 'El campo email es obligatorio',
                showCancelButton: false,
                confirmButtonText: 'Continuar',
            }).then((result) => {
                $('#referidor').focus();
            })
        } else {
            Swal.fire({
                icon: 'info',
                text: 'Esta seguro de continuar con esta operación',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Continuar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Completando operación',
                        text: 'Actualizando...',
                        imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                        imageAlt: 'No realice acciones sobre la página',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        footer: '<a href>No realice acciones sobre la página</a>',
                    });
                    let data = {
                        referidor,
                        userId
                    }
                    setTimeout(() => {
                        $.ajax({
                            type: 'POST',
                            url: "<?= site_url('user/update_referidor') ?>",
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

            })





        }
    }
</script>