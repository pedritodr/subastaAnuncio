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
            <?= translate('manage_subasta_lang'); ?>
            <small><?= translate('add_subasta_lang'); ?></small>
            | <a href="<?= site_url('subasta/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_subasta_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_subasta_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("subasta/add", array('id' => 'form_add_subasta')); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <label><?= translate("tipo_subasta_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="tipo_subasta" name="tipo_subasta" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                            <option value=1>Directa</option>
                                            <option value=2>Inversa</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="nombre" style="display:none" class="col-lg-3">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control input-sm" name="nombre_espa" placeholder="<?= translate('nombre_lang'); ?>" required>
                                    </div>

                                </div>


                                <div id="categoria" style="display:none" class="col-lg-3">
                                    <label><?= translate("cate_list_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="name_espa" name="name_espa" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>

                                            <?php
                                            if (isset($all_categoria))
                                                foreach ($all_categoria as $item) { ?>
                                                <option value="<?= $item->categoria_id; ?>"><?= $item->name_espa; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div id="city" style="display:none" class="col-lg-3">

                                    <label><?= translate("listar_city_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </span>
                                        <select id="ciudad" name="ciudad" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>

                                            <?php
                                            if (isset($all_ciudad))
                                                foreach ($all_ciudad as $item) { ?>
                                                <option value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                </div>
                                <div id="estado" style="display:none" class="col-lg-3">
                                    <label><?= translate("state_subasta"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="is_open" name="is_open" class="form-control select2 input-sm" placeholder="<?= translate('state_subasta'); ?>" style="width: 100%" required>

                                            <option value=1>Abierta</option>
                                            <option value=2>Cerrada</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="imagen" style="display:none" class="col-lg-3">
                                    <label><?= translate("image_lang"); ?> (768x768)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('image_lang'); ?>" required>
                                    </div>
                                </div>
                                <div id="inicial" style="display:none" class="col-lg-3">
                                    <label><?= translate("valor_inical_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" name="valor_inicial" placeholder="<?= translate('valor_inical_lang'); ?>">
                                    </div>
                                </div>
                                <div id="fecha_publicacion" class="col-lg-3">
                                    <?php
                                    $date1 = date('Y-m-d');
                                    $d1 = new DateTime($date1);
                                    $d1->modify('+0 day');
                                    ?>
                                    <label><?= "Fecha de inicio" ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input type="datetime-local" class="form-control input-sm" id="fecha_inicio" name="fecha_inicio" value="<?= $d1->format('Y-m-d\TH:i:s') ?>" min="<?= $d1->format('Y-m-d\TH:i:s') ?>" placeholder="Fecha de inicio" required>
                                    </div>

                                </div>
                                <div id="fecha" style="display:none" class="col-lg-3">
                                    <?php
                                    $date = date('Y-m-d');
                                    $d = new DateTime($date);
                                    $d->modify('+1 day');
                                    ?>
                                    <label><?= translate("date_cierre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input type="datetime-local" class="form-control input-sm" id="fecha_cierre" name="fecha_cierre" value="<?= $d->format('Y-m-d\TH:i:s') ?>" min="<?= $d->format('Y-m-d\TH:i:s') ?>" placeholder="<?= translate('date_cierre_lang'); ?>">
                                    </div>

                                </div>
                                <div id="entrada" style="display:none" class="col-lg-3">
                                    <label><?= translate("valor_pagado_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" name="valor_pago" placeholder="<?= translate('valor_pagado_lang'); ?>">
                                    </div>

                                </div>

                                <div id="cantidad" style="display:none" class="col-lg-3">
                                    <label><?= translate("cant_dias_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="cantidad_dias" placeholder="<?= translate('cant_dias_lang'); ?>">
                                    </div>
                                </div>
                                <div id="intervalo" style="display:none" class="col-lg-3">
                                    <label><?= translate("intervalo_dias_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="intervalo_dias" placeholder="<?= translate('intervalo_dias_lang'); ?>">
                                    </div>
                                </div>
                                <div id="maximo" style="display:none" class="col-lg-3">
                                    <label><?= translate("valor_maximo_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="valor_maximo" placeholder="<?= translate('valor_maximo_lang'); ?>">
                                    </div>
                                </div>
                                <div id="minimo" style="display:none" class="col-lg-3">
                                    <label><?= translate("valor_minimo_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="valor_minimo" placeholder="<?= translate('valor_minimo_lang'); ?>">
                                    </div>
                                </div>
                                <div id="porcentaje" style="display:none" class="col-lg-3">
                                    <label><?= translate("porcentaje_deducion_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="porcentaje_dias" placeholder="<?= translate('porcentaje_deducion_lang'); ?>">
                                    </div>
                                </div>
                                <div id="articulos" style="display:none" class="col-lg-3">
                                    <label><?= translate("qty_article_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <input type="number" class="form-control input-sm" min="1" name="qty_articles" placeholder="<?= translate('qty_article_lang'); ?>">
                                    </div>
                                </div>
                                <div id="descripcion" style="display:none" class="col-lg-12">

                                    <div class="form-group">
                                        <label class="control-label"><?= translate('description_lang'); ?></label>
                                        <textarea name="descrip_espa" class="form-control textarea" placeholder="<?= translate('description_lang'); ?>">

                            </textarea>
                                    </div>
                                </div>


                            </div>
                            <!--cierre del col 12-->
                        </div>
                        <!--cierre del ro-->

                        <div class="col-lg-12" style="text-align: right;">
                            <br>
                            <button onclick="guardar_subasta()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                        </div>
                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $('#nombre').show();
        $('#categoria').show();
        $('#city').show();
        $('#estado').show();
        $('#imagen').show();
        $('#inicial').show();
        $('#fecha').show();
        $('#entrada').show();
        $('#descripcion').show();
        //Date picker
    });

    $('#tipo_subasta').change(function(e) {
        var tipo = $('#tipo_subasta').val();
        if (tipo == 1) {
            $('#nombre').show();
            $('#categoria').show();
            $('#city').show();
            $('#estado').show();
            $('#imagen').show();
            $('#inicial').show();
            $('#fecha').show();
            $('#entrada').show();
            $('#descripcion').show();
            $('#cantidad').hide();
            $('#intervalo').hide();
            $('#maximo').hide();
            $('#minimo').hide();
            $('#porcentaje').hide();
        } else {
            $('#inicial').hide();
            $('#fecha').hide();
            $('#entrada').hide();
            $('#cantidad').show();
            $('#intervalo').show();
            $('#maximo').show();
            $('#minimo').show();
            $('#porcentaje').show();
            $('#articulos').show();
        }
    });

    function guardar_subasta() {
        var fecha_cierre = $('#fecha_cierre').val();
        var fecha_inicio = $('#fecha_inicio').val();
        if (Date.parse(fecha_cierre) < Date.parse(fecha_inicio)) {
            $('#error_fechas').modal('show');
        } else {
            $('#form_add_subasta').submit();
        }
    }
</script>