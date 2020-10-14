<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar financiamientos'; ?>
            <small><?= 'Listar Financiamientos'; ?></small>
            |
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Listar Financiamientos'; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= 'Listar Financiamientos'; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th>Resumen</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($financiamientos as $item) { ?>
                                    <tr>
                                        <td><?= $item->financiamiento_id; ?></td>
                                        <td style="width:75%">
                                            <?php if ($item->tipo == 1) { ?>
                                                <p><b>Tipo Financiamineto:</b> AUTOMOTRIZ</p>
                                            <?php } elseif ($item->tipo == 2) { ?>
                                                <p><b>Tipo Financiamineto:</b> CONSUMO</p>
                                            <?php } else { ?>
                                                <p><b>Tipo Financiamineto:</b> INMOBILIARIO</p>
                                            <?php  } ?>

                                            <p><b>Nombres:</b> <?= $item->nombres; ?></p>
                                            <p><b>Apellidos:</b> <?= $item->apellidos; ?></p>
                                            <p><b>Teléfono:</b> <?= $item->telefono; ?></p>
                                            <p><b>email:</b> <?= $item->email; ?></p>
                                            <p><b>Fecha:</b> <?= $item->fecha_creacion; ?></p>
                                        </td>
                                        <td>
                                            <a style="cursor:pointer" onclick="detalleFinanciamiento('<?= base64_encode(json_encode($item)) ?>')" class="btn btn-info"><i class="fa fa-info"></i> Detalle</a>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th>Resumen</th>
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
<div class="modal fade" id="modalDetalleFinanciamiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Detalle</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 id="titulo_user" class="text-center"></h3>

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="center">
                                <h3 id="nombres" class="widget-user-username"></h3>
                                <h5 class="description-header">Tipo de crédito</h5>
                                <h3 id="tipo" style="color:#fff"></h3>
                            </div>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="description-block">
                                            <h5 id="descripcion" class="description-header"></h5>
                                            <span id="descripcionVal" class="description-text"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Email</h5>
                                            <span id="email" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Telefono</h5>
                                            <span id="telefono" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Cédula</h5>
                                            <span id="cedula" class="description-text"></span>
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
                                            <h5 class="description-header">Datos cónyuge</h5>
                                            <span id="conyuge" class="description-text"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Monto</h5>
                                            <span id="monto" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Entrada</h5>
                                            <span id="entrada" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Estado civil</h5>
                                            <span id="estadoCivil" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Datos laborales</h5>
                                            <span id="datosLaborales" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Fecha de nacimiento</h5>
                                            <span id="fechaNacimiento" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Ingreso mensuales</h5>
                                            <span id="ingreso" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Gasto mensuales</h5>
                                            <span id="gasto" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Tipo de vivienda</h5>
                                            <span id="tipoVivienda" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">Fecha de creación</h5>
                                            <span id="fechaCreacion" class="description-text"></span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
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

    function detalleFinanciamiento(item) {
        item = atob(item);
        item = JSON.parse(item);
        $('#modalDetalleFinanciamiento').modal('show');
        $('#cedula').text(item.cedula);
        $('#nombres').text(item.nombres);
        $('#conyuge').text(item.datos_conyuge);
        $('#fechaCreacion').text(item.fecha_creacion);
        $('#telefono').text(item.telefono);
        $('#email').text(item.email);
        $('#monto').text(parseFloat(item.monto).toFixed(2));
        $('#entrada').text(parseFloat(item.entrada).toFixed(2));
        $('#ingreso').text(parseFloat(item.ingreso).toFixed(2));
        $('#gasto').text(parseFloat(item.gasto).toFixed(2));
        $('#fechaNacimiento').text(item.fecha_nacimiento);
        if (item.estado_civil == 1) {
            $('#estadoCivil').text('SOLTERO');
        } else if (item.estado_civil == 2) {
            $('#estadoCivil').text('CASADO SIN SEPARACION DE BIENES');
        } else if (item.estado_civil == 3) {
            $('#estadoCivil').text('CASADO CON SEPARACION DE BIENES DIVORCIADO');
        } else if (item.estado_civil == 4) {
            $('#estadoCivil').text('VIUDO');
        } else {
            $('#estadoCivil').text('UNION LIBRE');
        }
        if (item.datos_laborales == 1) {
            $('#datosLaborales').text('EMPLEADO PUBLICO');
        } else if (item.datos_laborales == 2) {
            $('#datosLaborales').text('EMPLEADO PRIVADO');
        } else {
            $('#datosLaborales').text('NEGOCIO PROPIO -RUC -RISE');
        }
        if (item.tipo_vivienda == 1) {
            $('#tipoVivienda').text('PROPIA');
        } else if (item.tipo_vivienda == 2) {
            $('#tipoVivienda').text('RENTADA');
        } else {
            $('#tipoVivienda').text('FAMILIAR');
        }

        if (item.tipo == 1) {
            $('#tipo').text('AUTOMOTRIZ');
        } else if (item.tipo == 2) {
            $('#tipo').text('CONSUMO');
        } else {
            $('#tipo').text('INMOBILIARIO');
        }
        if (item.tipo_auto) {
            $('#descripcion').text('Auto');
            if (item.tipo_auto == 1) {
                $('#descripcionVal').text("Nuevo");
            } else {
                $('#descripcionVal').text("Usado");
            }

        }
        if (item.tipo_inmobiliario) {
            $('#descripcion').text('Inmobiliario');
            if (item.tipo_inmobiliario == 1) {
                $('#descripcionVal').text("Nueva");
            } else {
                $('#descripcionVal').text("Usada");
            }
        }
        if (item.destino_credito) {
            $('#descripcion').text('Destino crédito');
            $('#descripcionVal').text(item.destino_credito);
        }
    }
</script>