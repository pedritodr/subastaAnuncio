<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">

<!-- Bootstrap time Picker -->
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/date-timer/css/bootstrap-datetimepicker.min.css"> -->
<!-- bootstrap time picker -->
<!-- <script src="<?= base_url(); ?>assets/date-timer/js/bootstrap-datetimepicker.min.js"></script> -->
<!-- bootstrap datepicker -->
<!-- <script src="<?= base_url(); ?>admin_lte/plugins/datepicker/bootstrap-datepicker.js"></script> -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('subasta_lang'); ?>
            | <a href="<?= site_url('subasta/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('subasta_lang'); ?></li>


        </ol>
    </section>
    <section class="content">

        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            <?= $subasta->date_create ?>
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-info  bg-blue"></i>


                        <div class="timeline-item">
                            <!--    <span class="time">
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                                </div>
                            </span> -->
                            <h3 class="timeline-header"><a style="cursor:pointer">Detalles de la subasta: </a> <?= $subasta->nombre_espa ?></h3>

                            <div class="timeline-body">
                                <?= $subasta->descrip_espa ?>
                            </div>
                            <div class="timeline-footer">
                                <a onclick="detalle()" class="btn btn-primary btn-xs"><?= translate("ver_info_lang") ?></a>
                                <a onclick="galeria()" class="btn btn-info btn-xs"><?= translate("gallery_lang") ?></a>
                            </div>

                        </div>
                    </li>
                    <!-- END timeline item -->


                    <!-- timeline item -->
                    <?php $contador = 1;
                    if ($intervalos) { ?>

                        <?php foreach ($intervalos as $item) { ?>
                            <li>
                                <i class="fa fa-clock-o bg-purple"></i>

                                <div class="timeline-item">


                                    <h3 class="timeline-header"><a style="cursor:pointer"><?= translate('intervalo_lang') ?>-<?= $contador ?></a>

                                        <label class="label label-primary"> <?= $item->fecha ?></label> <label class="label label-info">Stock <?= $item->cantidad ?></label> <label class="label label-success">Valor $<?= number_format($item->valor, 2) ?></label>
                                    </h3>

                                    <div class="timeline-body">
                                        <?php if ($item->user_subasta) { ?>
                                            <ul>
                                                <?php foreach ($item->user_subasta as $user_subasta) { ?>

                                                    <li>
                                                        <h5 class="timeline-header"><a onclick="ver_perfil('<?= base64_encode(json_encode($user_subasta->user)) ?>')" style="cursor:pointer"> <span><i class="fa fa-user"></i></span> <?= $user_subasta->user->name ?></a></h5>

                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        <?php } else { ?>
                                            <h3 class="timeline-header no-border">No hay resultados</h3>
                                        <?php } ?>
                                    </div>

                                </div>
                            </li>
                            <?php $contador++ ?>
                        <?php } ?>
                    <?php } else { ?>
                        <h3 class="timeline-header no-border">No hay resultados</h3>
                    <?php } ?>

                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-green">
                            <?= $subasta->fecha_cierre  ?>
                        </span>
                    </li>

                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>

                    </li>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->

    </section>
</div><!-- /.content-wrapper -->
<div class="modal fade" id="modal_detalle_subasta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="titulo_detalle"><?= $subasta->nombre_espa ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img id="img_detalle" src="<?= base_url($subasta->photo) ?>" class="img-responsive img-rounded" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="text-justify" id="descripcion_detalle">
                            <?= $subasta->descrip_espa ?>
                        </div>
                        <br>
                        <label id="lbl_categoria" class="label label-success"><i class="fa fa-tag" aria-hidden="true"></i> <?= $categoria->name_espa ?></label>
                        <label class="label label-danger">Valor minimo $<?= number_format($subasta->valor_minimo, 2) ?></label>
                        <label class="label label-success">Valor máximo $ <?= number_format($subasta->valor_maximo, 2) ?></label>
                        <label class="label label-success">Porcentaje <?= number_format($subasta->porcentaje, 2) ?>%</label>
                        <label class="label label-danger">Cantidad de dias <?= $subasta->cantidad_dias ?></label>
                        <label class="label label-primary">Intervalo de dias <?= $subasta->intervalo ?></label>
                        <label class="label label-warning">Cantidad de articulos <?= $subasta->qty_articles ?></label>

                        <label id="lbl_ciudad" class="label label-info"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $ciudad->name_ciudad ?></label>

                        <?php if ($subasta->is_open == 1) { ?>
                            <label class="label label-success">Abierta</label>
                        <?php } else { ?>
                            <label class="label label-warning">Cerrada</label>
                        <?php } ?>

                        <br>
                        <br>
                        <p class="text-center"><strong>Fecha de creación:</strong> <?= $subasta->date_create ?></p>
                        <p class="text-center"><strong>Fecha de cierre:</strong> <?= $subasta->fecha_cierre ?></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_galeria_subasta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Galeria</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="titulo_galeria" class="text-center"><?= $subasta->nombre_espa ?></h3>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <?php if ($galeria) { ?>
                                    <?php for ($i = 0; $i < count($galeria); $i++) { ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="<?= $i + 1 ?>"></li>
                                    <?php  } ?>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="<?= base_url($subasta->photo) ?>" alt="First slide">
                                </div>
                                <?php if ($galeria) { ?>
                                    <?php foreach ($galeria as $item) { ?>
                                        <div class="item ">
                                            <img src="<?= base_url($item->url_photo) ?>">
                                        </div>
                                    <?php } ?>
                                <?php } ?>


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
                                <div id="membresia_user" style="display:none" class="row">
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
    function detalle() {
        $('#modal_detalle_subasta').modal('show');
    }

    function galeria() {
        $('#modal_galeria_subasta').modal('show');
    }

    function ver_perfil(object) {
        object = atob(object);
        object = JSON.parse(object);
        console.log(object);
        let photo = object.photo;
        let ok = photo.indexOf("uploads");
        $('.widget-user-header').css('background', 'url(<?= site_url() ?>)  center');
        $('#nombre_perfil').text(object.name);
        if (ok > 0) {
            $('#img_perfil_2').prop('src', "<?= site_url() ?>" + object.photo);
        } else {
            $('#img_perfil_2').prop('src', object.photo);
        }
        $('#direccion_usuario_perfil').text(object.direccion);
        $('#telefono_usuario_perfil').text(object.phone);
        $('#email_usuario_perfil').text(object.email);
        $('#ciudad_perfil').text(object.ciudad.name_ciudad);
        if (object.membresia) {
            $('#name_membresia').text(object.membresia.nombre);
            $('#cant_anuncios').text(object.membresia.anuncios_publi);
            $('#fecha_compra').text(object.membresia.fecha_inicio);
            $('#fecha_vencimiento').text(object.membresia.fecha_fin);
            $('#membresia_user').show();
        } else {
            $('#membresia_user').hide();
        }


        $('#modal_user_perfil').modal('show');

    }
</script>