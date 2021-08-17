<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar transferencias'; ?>
            <small><?= 'Solicitudes procesadas'; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Transferencias'; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= 'Solicitudes de transferencias'; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Datos del usuario</th>
                                    <th>Datos solicitud</th>
                                    <th>Status</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($request as $item) { ?>
                                    <tr>
                                        <td><?= "st-" . $item->transfer_id; ?></td>
                                        <td><?= $item->date_create; ?></td>
                                        <td>
                                            <p><b>Nombre:</b> <?= $item->name; ?></p>
                                            <p><b>Apellido:</b> <?= $item->surname; ?></p>
                                            <p><b>Teléfono:</b> <?= $item->phone; ?></p>
                                            <p><b>email:</b> <?= $item->email; ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if ($item->type == 1) {
                                                echo '<p><b>Membresia:</b> ' . $item->nombre . '</p>';
                                                echo '<p><b>Monto:</b> ' . number_format($item->precio, 2) . '</p>';
                                            } else {
                                                echo '<p><b>Anuncio:</b> ' . $item->titulo . '</p>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($item->status == 0) {
                                                echo '<label class="label label-warning">Pendiente</label>';
                                            } else if ($item->status == 1) {
                                                echo '<label class="label label-success">Confirmnada</label>';
                                            } else {
                                                echo '<label class="label label-danger">Cancelada</label>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($item->status == 0) { ?>
                                                <?php if ($item->renovate == 0 && $item->type == 1) { ?>
                                                    <a style="cursor:pointer" onclick="handleTransaction('<?= base64_encode(json_encode($item)) ?>')" class="btn btn-success"> Confirmar</a>
                                                <?php } else if ($item->type == 1) { ?>
                                                    <a style="cursor:pointer" onclick="handleTransactionRenovate('<?= base64_encode(json_encode($item)) ?>')" class="btn btn-success"> Confirmar</a>
                                                <?php } else { ?>
                                                    <a style="cursor:pointer" onclick="handleTransactionAds('<?= base64_encode(json_encode($item)) ?>')" class="btn btn-success"> Confirmar</a>
                                                <?php } ?>
                                                <a style="cursor:pointer" onclick="handleCancel('<?= base64_encode(json_encode($item)) ?>')" class="btn btn-danger"> Cancelar</a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Datos del usuario</th>
                                    <th>Datos solicitud</th>
                                    <th>Status</th>
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

<script>
    $(function() {
        $("#example1").DataTable({
            "aaSorting": [
                [1, "desc"]
            ]
        });
    });

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const handleTransaction = (object) => {
        object = JSON.parse(decodeB64Utf8(object))
        Swal.fire({
            title: '¿ Estás seguro de realizar esta operación ?',
            html: `<h6>Usted no podrá revertir este cambio</h6><h5>Id: st- ${object.transfer_id}</h5><h5>Membresia: Plan  ${object.nombre}</h5>`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando datos...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('transaccion/asignar_membresia') ?>",
                        data: {
                            transaction_id: object.transfer_id,
                            user_id: object.user_id,
                            membresia_id: object.membresia_id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    title: 'Info!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500);
            }
        })
    }
    const handleCancel = (object) => {
        object = JSON.parse(decodeB64Utf8(object))
        Swal.fire({
            title: '¿ Estás seguro de realizar esta operación ?',
            html: `<h6>Usted no podrá revertir este cambio</h6><h5>Id: st-${object.transfer_id}</h5><h5>Membresia: Plan  ${object.nombre}</h5>`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando datos...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('transaccion/delete_transfer') ?>",
                        data: {
                            transaction_id: object.transfer_id,
                            user_id: object.user_id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    title: 'Info!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500);

            }
        })
    }
    const handleTransactionRenovate = (object) => {
        object = JSON.parse(decodeB64Utf8(object))
        Swal.fire({
            title: '¿ Estás seguro de realizar esta operación ?',
            html: `<h6>Usted no podrá revertir este cambio</h6><h5>Id: st-${object.transfer_id}</h5><h5>Membresia: Plan  ${object.nombre}</h5>`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando datos...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('transaccion/renovate_membership') ?>",
                        data: {
                            transfer_id: object.transfer_id,
                            user_id: object.user_id,
                            membresia_id: object.membresia_id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    title: 'Info!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500);
            }
        })
    }
    const handleTransactionAds = (object) => {
        object = JSON.parse(decodeB64Utf8(object))
        Swal.fire({
            title: '¿ Estás seguro de realizar esta operación ?',
            html: `<h6>Usted no podrá revertir este cambio</h6><h5>Id: st- ${object.transfer_id}</h5><h5>Anuncio:  ${object.titulo}</h5>`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando datos...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('transaccion/destacar_ads') ?>",
                        data: {
                            transaction_id: object.transfer_id,
                            user_id: object.user_id,
                            ads_id: object.anuncio_id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    title: 'Info!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500);
            }
        })
    }
</script>