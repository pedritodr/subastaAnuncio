<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_anuncio_lang'); ?>
            <small><?= translate('listar_anuncio_lang'); ?></small>
            <!--  | <a href="<?= site_url('front/anuncio'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a> -->

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_anuncio_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_anuncio_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("titulo_lang"); ?></th>
                                    <th><?= translate("descripcion_lang"); ?></th>
                                    <th><?= translate("fecha_publicacion_lang"); ?></th>
                                    <th><?= translate("fecha_vencimiento_lang"); ?></th>
                                    <th><?= translate("name_city_lang"); ?></th>
                                    <th><?= translate("precios_lang"); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= translate("estado_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_anuncios as $item) { ?>
                                    <tr>


                                        <td> <?= $item->titulo; ?>
                                            <?php if ($item->destacado == 1) { ?>
                                                <label class="label label-warning">Destacado</label>
                                            <?php } ?>
                                        </td>
                                        <td style="width:30%"> <?= $item->descripcion; ?></td>
                                        <td> <?= $item->fecha; ?></td>
                                        <td> <?= $item->fecha_vencimiento; ?></td>
                                        <td> <?= $item->ciudad; ?></td>
                                        <td>
                                            <label class="label label-info"> $<?= number_format($item->precio, 2); ?></label>
                                        </td>
                                        <td><img style="width:50%" class="img img-rounded img-responsive" src="<?= base_url($item->anuncio_photo); ?>" /></td>


                                        <td>
                                            <?php if ($item->is_active == 1) { ?>
                                                <label class="label label-success">Publicado</label>
                                            <?php } else { ?>

                                                <label class="label label-danger">Desactivado</label>

                                            <?php } ?>
                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a style="cursor:pointer" onclick="detalles('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-eye"></i> <?= translate("ver_lang"); ?></a></li>
                                                    <?php if ($item->is_active == 1) { ?>
                                                        <li><a style="cursor:pointer" onclick="desactivar('<?= $item->anuncio_id ?>')"><i class="fa fa-remove"></i> <?= translate("desactivar_ads_lang"); ?></a></li>
                                                    <?php } else { ?>
                                                        <li><a style="cursor:pointer" onclick="activar('<?= $item->anuncio_id ?>')"><i class="fa fa-check"></i> <?= translate("publicar_lang"); ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($item->destacado == 0) { ?>
                                                        <li><a style="cursor:pointer" onclick="destacarAnuncio('<?= $item->anuncio_id ?>')"><i class="fa fa-check"></i>Destacar anuncio</a></li>
                                                    <?php } ?>
                                                    <?php if ($item->galeria) { ?>
                                                        <li><a style="cursor:pointer" onclick="galeria('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-picture-o" aria-hidden="true"></i> <?= translate("photos_lang"); ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($item->user) { ?>
                                                        <li class="divider"></li>
                                                        <li><a style="cursor:pointer" onclick="usuario('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-user"></i> <?= translate("user_lang"); ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("titulo_lang"); ?></th>
                                    <th><?= translate("descripcion_lang"); ?></th>
                                    <th><?= translate("fecha_publicacion_lang"); ?></th>
                                    <th><?= translate("fecha_vencimiento_lang"); ?></th>
                                    <th><?= translate("name_city_lang"); ?></th>
                                    <th><?= translate("precios_lang"); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= translate("estado_lang"); ?></th>
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
<!-- Modal -->
<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="titulo_detalle">Detalle</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img id="img_detalle" src="" class="img-responsive img-rounded" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="text-justify" id="descripcion_detalle"></div>
                        <br>
                        <label id="lbl_categoria" class="label label-success"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                        <br>
                        <label id="lbl_precio" class="label label-info"></label>
                        <br>
                        <label id="lbl_ciudad" class="label label-info"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                        <br>
                        <label id="lbl_destacado" style="display:none" class="label label-warning"></label>
                        <label id="lbl_publicado" style="display:none" class="label label-success"></label>
                        <label id="lbl_desactivado" style="display:none" class="label label-danger"></label>
                        <br>
                        <label id="lbl_whatsaap" class="label label-success"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                        <br>
                        <p id="direccion_detalle" class="text-center"></p>
                        <p id="fechas_detalle" class="text-center"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_desactivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Desactivar anuncio</h4>
            </div>
            <?= form_open_multipart("anuncio/desactivar") ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center"><?= translate('confirmar_desactivar_ads_lang') ?></h4>
                    </div>
                </div>
            </div>
            <input name="anuncio_id_desactivar" id="anuncio_id_desactivar" class="btn btn-primary" type="hidden" value="">
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><?= translate('desactivar_ads_lang') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_destacar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Destacar anuncio</h4>
            </div>
            <?= form_open_multipart("anuncio/destacar") ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center"><?= translate('confirmar_destacar_ads_lang') ?></h4>
                    </div>
                </div>
            </div>
            <input name="anuncio_id_destacar" id="anuncio_id_destacar" class="btn btn-primary" type="hidden" value="">
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Destacar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Publicar anuncio</h4>
            </div>
            <?= form_open_multipart("anuncio/publicar") ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center"><?= translate('confirmar_activar_ads_lang') ?></h4>
                    </div>
                </div>
                <input name="anuncio_id_publicar" id="anuncio_id_publicar" class="btn btn-primary" type="hidden" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><?= translate('activar_ads_lang') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_galeria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Galeria</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="titulo_galeria" class="text-center"></h3>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

                                    <div class="carousel-caption">
                                        First Slide
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
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

<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Usuario</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="titulo_user" class="text-center"></h3>

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="center">
                                <h3 class="widget-user-username">Elizabeth Pierce</h3>

                            </div>
                            <div class="widget-user-image">
                                <img id="img_perfil" class="img-circle" src="../dist/img/user3-128x128.jpg" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Email</h5>
                                            <span id="email_usuario" class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Telefono</h5>
                                            <span id="telefono_usuario" class="description-text">FOLLOWERS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">Dirección</h5>
                                            <span id="direccion_usuario" class="description-text">PRODUCTS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
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
        $("#example1").DataTable({
            "order": [
                [0, "desc"]
            ]
        });

    });

    function detalles(object) {
        object = atob(object);
        object = JSON.parse(object);

        $('#titulo_detalle').text(object.titulo);
        $('#direccion_detalle').text("Dirección: " + object.direccion);
        $('#lbl_categoria').html("<i class='fa fa-tag'></i>" + object.categoria + "/" + object.subcategoria);
        $('#lbl_precio').text("$" + parseFloat(object.precio).toFixed(2));
        $('#lbl_ciudad').html("<i class='fa fa-map-marker'></i> " + object.ciudad);
        $('#lbl_whatsaap').html("<i class='fa fa-whatsapp'></i> " + object.whatsapp);

        if (object.destacado == 1) {
            $('#lbl_destacado').text("Destacado");
            $('#lbl_destacado').show();
        } else {
            $('#lbl_destacado').hide();
        }
        if (object.is_active == 1) {
            $('#lbl_publicado').text("Publicado");
            $('#lbl_desactivado').hide();
            $('#lbl_publicado').show();
        } else {
            $('#lbl_desactivado').text("Desacticado");
            $('#lbl_publicado').hide();
            $('#lbl_desactivado').show()
        }
        $('#descripcion_detalle').html(object.descripcion);
        $('#fechas_detalle').html("<?= translate('fecha_publicacion_lang') ?>: " + object.fecha + "<br> <?= translate('fecha_vencimiento_lang') ?>: " + object.fecha_vencimiento);
        $('#img_detalle').prop("src", "<?= site_url() ?>" + object.anuncio_photo);
        $('#modal_detalle').modal('show');
    }

    function desactivar(params) {
        $('#anuncio_id_desactivar').val(params);
        $('#modal_desactivar').modal('show');

    }

    function destacarAnuncio(params) {
        $('#anuncio_id_destacar').val(params);
        $('#modal_destacar').modal('show');

    }

    function activar(params) {
        $('#anuncio_id_publicar').val(params);
        $('#modal_activar').modal('show');

    }

    function galeria(object) {
        object = atob(object);
        object = JSON.parse(object);
        $('#titulo_galeria').text(object.titulo);
        if (object.galeria.length > 0) {
            count = object.galeria.length;
            if (count == 1) {
                $('.carousel-indicators').html('<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>');
            } else if (count >= 2) {
                cadena = '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';

                for (let i = 1; i < object.galeria.length; i++) {
                    cadena += '<li data-target="#carousel-example-generic" data-slide-to="' + i + '"></li>';
                }
                $('.carousel-indicators').html(cadena);
            }

            if (count == 1) {
                $('.carousel-inner').html('<div class="item active"><img src="<?= site_url() ?>' + object.galeria[0].photo_anuncio + '" ></div>');
            } else if (count >= 2) {
                cadena = '<div class="item active"><img src="<?= site_url() ?>' + object.galeria[0].photo_anuncio + '" ></div>';

                for (let i = 1; i < object.galeria.length; i++) {
                    cadena += '<div class="item"><img src="<?= site_url() ?>' + object.galeria[i].photo_anuncio + '" ></div>';

                }
                $('.carousel-inner').html(cadena);

            }

        }
        $('#modal_galeria').modal('show');

    }

    function usuario(object) {
        object = atob(object);
        object = JSON.parse(object);
        let photo = object.user.photo;
        let ok = photo.indexOf("uploads");
        $('.widget-user-header').css('background', 'url(<?= site_url() ?>' + object.anuncio_photo + ') center');
        $('.widget-user-username').text(object.user.name);
        if (ok > 0) {
            $('#img_perfil').prop('src', "<?= site_url() ?>" + object.user.photo);
        } else {
            $('#img_perfil').prop('src', object.user.photo);
        }

        $('#direccion_usuario').text(object.user.direccion);
        $('#telefono_usuario').text(object.user.phone);
        $('#email_usuario').text(object.user.email);
        $('#modal_user').modal('show');

    }
</script>