<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_subasta_lang'); ?>
            <small><?= translate('update_subasta_lang'); ?></small>
            | <a href="<?= site_url('subasta/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_subasta_lang'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_subasta_lang'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <?= get_message_from_operation(); ?>

                            <?= form_open_multipart("subasta/update", array('id' => 'form_add_subasta')); ?>
                            <div class="col-lg-3">
                                <label><?= translate("tipo_subasta_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <select required id="tipo_subasta" name="tipo_subasta" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                        <option <?php if ($subasta_object->tipo_subasta == 1) { ?> selected <?php } ?> value="1">Directa</option>
                                        <option <?php if ($subasta_object->tipo_subasta == 2) { ?> selected <?php } ?> value="2">Inversa</option>
                                    </select>
                                </div>
                            </div>
                            <div id="nombre" style="display:none" class="col-lg-3">
                                <label><?= translate("nombre_lang"); ?></label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="nombre_espa" required value="<?= $subasta_object->nombre_espa; ?>" placeholder="<?= translate('nombre_lang'); ?>">
                                    <input name="subasta_id" id="" class="btn btn-primary" type="hidden" value="<?= $subasta_object->subasta_id; ?>">
                                </div>

                            </div>
                            <div id="categoria2" style="display:show" class="col-lg-3">
                                <label><?= translate("cate_list_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <select required id="categoria" name="categoria" onchange="change_categoria();" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                        <?php
                                        if (isset($all_categoria))
                                            foreach ($all_categoria as $item) { ?>
                                            <option <?php if ($item->categoria_id == $subasta_object->categoria_id) { ?> selected <?php } ?> value="<?= $item->categoria_id; ?>"><?= $item->name_espa; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div id="cuerpo_subcategoria" class="col-lg-3">
                                <label><?= translate("listar_subcate_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i>
                                    </span>
                                    <select required id="subcategoria" name="subcategoria" class="form-control select2 input-sm">
                                        <?php if ($find_subcat) { ?>
                                            <option selected value="<?= $find_subcat->subcat_id ?>"><?= $find_subcat->nombre; ?></option>
                                        <?php } ?>
                                        <?php
                                        if (isset($all_subcate))
                                            foreach ($all_subcate as $item) { ?>
                                            <option value="<?= $item->subcate_id; ?>"><?= $item->nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <div id="city" style="display:none" class="col-lg-3">

                                <label><?= translate("listar_city_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </span>
                                    <select required id="ciudad" name="ciudad" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                        <?php
                                        if (isset($all_ciudad))
                                            foreach ($all_ciudad as $item) { ?>
                                            <option <?php if ($item->ciudad_id == $subasta_object->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>

                            </div>
                            <div id="estado" style="display:none" class="col-lg-3">
                                <label><?= translate("state_subasta"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <select required id="is_open" name="is_open" required class="form-control select2 input-sm" placeholder="<?= translate('state_subasta'); ?>" style="width: 100%">

                                        <option <?php if ($subasta_object->is_open == 1) { ?> selected <?php } ?> value="1">Abierta</option>
                                        <option <?php if ($subasta_object->is_open == 0) { ?> selected <?php } ?> value="0">Cerrada</option>
                                    </select>
                                </div>
                            </div>

                            <div id="imagen" style="display:none" class="col-lg-3">
                                <label><?= translate("image_lang"); ?> (768x768)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                </div>
                            </div>

                            <div id="inicial" style="display:none" class="col-lg-3">
                                <label><?= translate("valor_inical_lang"); ?></label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" name="valor_inicial" value="<?= $subasta_object->valor_inicial; ?>" placeholder="<?= translate('valor_inical_lang'); ?>">
                                </div>

                            </div>
                            <div id="fecha_publicacion" class="col-lg-3">
                                <label><?= "Fecha Inicio" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <?php $date_actutal1 = date('Y-m-d');
                                    $d1 = new DateTime($date_actutal1);
                                    $d1->modify('+0 day');
                                    if ($subasta_object->fecha_inicio) { ?>
                                        <?php $date_inicio = new DateTime($subasta_object->fecha_inicio); ?>
                                        <input type="datetime-local" class="form-control input-sm" id="fecha_inicio" name="fecha_inicio" value="<?php echo $date_inicio->format('Y-m-d\TH:i:s') ?>">
                                    <?php } else { ?>
                                        <input type="datetime-local" class="form-control input-sm" id="fecha_inicio" name="fecha_inicio" value="<?php echo $d1->format('Y-m-d\TH:i:s') ?>">
                                    <?php } ?>

                                </div>
                            </div>
                            <div id="fecha" style="display:none" class="col-lg-3">
                                <label><?= translate("date_cierre_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <?php
                                    $date_actutal = date('Y-m-d');
                                    $d = new DateTime($date_actutal);
                                    $d->modify('+1 day');
                                    ?>
                                    <?php $date = new DateTime($subasta_object->fecha_cierre); ?>
                                    <input type="datetime-local" class="form-control input-sm" id="fecha_cierre" name="fecha_cierre" value="<?php echo $date->format('Y-m-d\TH:i:s') ?>" placeholder="<?= translate('date_cierre_lang'); ?>">
                                </div>

                            </div>

                            <div id="entrada" style="display:none" class="col-lg-3">
                                <label><?= translate("valor_pagado_lang"); ?></label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" name="valor_pago" placeholder="<?= translate('valor_pagado_lang'); ?>" value="<?= $subasta_object->valor_pago; ?>">
                                </div>

                            </div>

                            <div id="cantidad" style="display:none" class="col-lg-3">
                                <label><?= translate("cant_dias_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="cantidad_dias" placeholder="<?= translate('cant_dias_lang'); ?>" value="<?= $subasta_object->cantidad_dias; ?>">
                                </div>
                            </div>
                            <div id="intervalo" style="display:none" class="col-lg-3">
                                <label><?= translate("intervalo_dias_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="intervalo_dias" placeholder="<?= translate('intervalo_dias_lang'); ?>" value="<?= $subasta_object->intervalo; ?>">
                                </div>
                            </div>
                            <div id="maximo" style="display:none" class="col-lg-3">
                                <label><?= translate("valor_maximo_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="valor_maximo" placeholder="<?= translate('valor_maximo_lang'); ?>" value="<?= $subasta_object->valor_maximo; ?>">
                                </div>
                            </div>
                            <div id="minimo" style="display:none" class="col-lg-3">
                                <label><?= translate("valor_minimo_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="valor_minimo" placeholder="<?= translate('valor_minimo_lang'); ?>" value="<?= $subasta_object->valor_minimo; ?>">
                                </div>
                            </div>
                            <div id="porcentaje" style="display:none" class="col-lg-3">
                                <label><?= translate("porcentaje_deducion_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="porcentaje_dias" placeholder="<?= translate('porcentaje_deducion_lang'); ?>" value="<?= $subasta_object->porcentaje; ?>">
                                </div>
                            </div>
                            <div id="articulos" style="display:none" class="col-lg-3">
                                <label><?= translate("qty_article_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control input-sm" min="1" name="qty_articles" placeholder="<?= translate('qty_article_lang'); ?>" value="<?= $subasta_object->qty_articles; ?>">
                                </div>
                            </div>

                            <div id="descripcion" style="display:none" class="col-lg-12">

                                <div class="form-group">
                                    <label class="control-label"><?= translate('description_lang'); ?></label>
                                    <textarea name="descrip_espa" class="form-control textarea" required placeholder="<?= translate('description_lang'); ?>">
                                <?= $subasta_object->descrip_espa; ?>
                            </textarea>
                                </div>
                            </div>


                        </div>
                        <!--cierre del col 12-->
                    </div>
                    <!--cierre del ro-->


                    <div class="col-lg-12" style="text-align: right;">
                        <br>
                        <button type="button" onclick="guardar_subasta()" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                    </div>
                    <?= form_close(); ?>




                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
    function change_categoria() {

        var a = $("select[name=categoria]").val();
        $('#subcategoria').empty();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('front/get_subcate_subasta') ?>",
            data: {
                categoria_id: a

            },

            success: function(result) {
                result = JSON.parse(result);
                var cadena = "";
                for (let i = 0; i < result.length; i++) {
                    cadena = cadena + "<option value='" + result[i].subcat_id + "'>" + result[i].nombre + "</option>";
                }
                $('#subcategoria').html(cadena);
            }





        });

    }
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        var tipo_subasta = "<?= $subasta_object->tipo_subasta ?>";
        if (tipo_subasta == 1) {
            $('#inicial').show();
            $('#fecha').show();
            $('#entrada').show();
        } else {
            $('#cantidad').show();
            $('#intervalo').show();
            $('#maximo').show();
            $('#minimo').show();
            $('#porcentaje').show();
            $('#articulos').show();
        }
        $('#nombre').show();
        $('#categoria').show();
        $('#city').show();
        $('#estado').show();
        $('#imagen').show();
        $('#fecha').show();
        //$('#entrada').show();
        $('#descripcion').show();
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
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>