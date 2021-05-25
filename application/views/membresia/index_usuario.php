<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('membresias_lang'); ?>
            <small><?= translate('users_lang'); ?></small>

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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('user_list_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("membresias_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dateActual = date('Y-m-d H:i:s');
                                foreach ($all_users as $item) { ?>
                                    <tr>
                                        <td><?= $item->name; ?></td>
                                        <td><?= $item->email; ?></td>
                                        <td>
                                            <?= $item->phone; ?>
                                        </td>
                                        <td>
                                            <?php if ($item->membresia_id == 6) { ?>
                                                <label class="label label-success"> <?= $item->nombre; ?></label>
                                            <?php } elseif ($item->membresia_id == 7) { ?>
                                                <label class="label label-warning"> <?= $item->nombre; ?></label>
                                            <?php } else { ?>
                                                <label class="label label-danger"> <?= $item->nombre; ?></label>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-info" style="cursor:pointer" onclick="usuario_perfil('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-edit"></i> <?= translate("ver_perfil_lang"); ?></a>
                                            <?php if (isset($item->node)) {
                                                if ($item->node) {
                                                    if ($item->node->is_culminated == 1) {
                                                        echo ' <a style="cursor:pointer" onclick=handleRenovateMembership("' . base64_encode(json_encode($item)) . '") class="btn btn-success"> Renovar membresia</a>';
                                                    } elseif (strtotime($dateActual) > strtotime($item->fecha_fin)) {
                                                        echo ' <a style="cursor:pointer" onclick=handleRenovateMembership("' . base64_encode(json_encode($item)) . '") class="btn btn-success"> Renovar membresia</a>';
                                                    }
                                                } else {
                                                    if (strtotime($dateActual) > strtotime($item->fecha_fin)) {
                                                        echo ' <a style="cursor:pointer" onclick=handleRenovateMembership("' . base64_encode(json_encode($item)) . '") class="btn btn-success"> Renovar membresia</a>';
                                                    }
                                                }
                                            } else {
                                                if (strtotime($dateActual) > strtotime($item->fecha_fin)) {
                                                    echo ' <a style="cursor:pointer" onclick=handleRenovateMembership("' . base64_encode(json_encode($item)) . '") class="btn btn-success"> Renovar membresia</a>';
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang");  ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("membresias_lang"); ?></th>
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
<div class="modal fade" id="modal_user_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Perfil</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="titulo_user" class="text-center"></h3>

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="center">
                                <h3 id="nombre_perfil" class="widget-user-username">Elizabeth Pierce</h3>

                            </div>
                            <div class="widget-user-image">
                                <img id="img_perfil_2" class="img-circle" src="../dist/img/user3-128x128.jpg" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Email</h5>
                                            <span id="email_usuario_perfil" class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Telefono</h5>
                                            <span id="telefono_usuario_perfil" class="description-text">FOLLOWERS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Ciudad</h5>
                                            <span id="ciudad_perfil" class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div style="text-align :left !important" class="description-block">
                                            <h5 class="description-header">Dirección</h5>
                                            <span id="direccion_usuario_perfil" class="description-text">PRODUCTS</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="description-block">
                                            <h5 class="description-header">Membresia</h5>
                                            <span id="name_membresia" class="description-text">SALES</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Anuncios disponibles</h5>
                                            <span id="cant_anuncios" class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Fecha de compra</h5>
                                            <span id="fecha_compra" class="description-text">FOLLOWERS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Fecha de vencimiento</h5>
                                            <span id="fecha_vencimiento" class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

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

    const handleRenovateMembership = (object) => {
        object = JSON.parse(decodeB64Utf8(object));
        let idMembership = object.membresia_id;
        let idUser = object.user_id;
        let idMembershipUser = object.membre_user_id;
        Swal.fire({
            title: '¿ Estás seguro de realizar esta operación ?',
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
                        url: "<?= site_url('membresia/renovate_membership') ?>",
                        data: {
                            idUser,
                            idMembership,
                            idMembershipUser
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    title: 'Info!',
                                    text: result.msg,
                                    padding: '2em'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: result.msg,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500);
            }
        })
    }

    function usuario_perfil(object) {
        object = JSON.parse(decodeB64Utf8(object));
        let photo = object.photo;
        if (photo) {
            let ok = photo.indexOf("uploads");
            if (ok > 0) {
                $('#img_perfil_2').prop('src', "<?= site_url() ?>" + object.photo);
            } else {
                $('#img_perfil_2').prop('src', object.photo);
            }
        } else {
            $('#img_perfil_2').prop('src', '<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>');
        }
        $('.widget-user-header').css('background', 'url(<?= site_url() ?>)  center');
        $('#nombre_perfil').text(object.name);

        $('#name_membresia').text(object.nombre);
        $('#cant_anuncios').text(object.anuncios_publi);
        $('#fecha_compra').text(object.fecha_inicio);
        $('#fecha_vencimiento').text(object.fecha_fin);
        $('#direccion_usuario_perfil').text(object.direccion);
        $('#telefono_usuario_perfil').text(object.phone);
        $('#email_usuario_perfil').text(object.email);
        if (object.ciudad) {
            $('#ciudad_perfil').text(object.ciudad.name_ciudad);
        } else {
            $('#ciudad_perfil').text("");
        }
        $('#modal_user_perfil').modal('show');
    }
</script>