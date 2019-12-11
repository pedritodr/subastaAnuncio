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

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("subasta/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-lg-3">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control input-sm" name="nombre_espa" required value="<?= $subasta_object->nombre_espa; ?>" placeholder="<?= translate('nombre_lang'); ?>">
                                            <input name="subasta_id" id="" class="btn btn-primary" type="hidden" value="<?= $subasta_object->subasta_id; ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-3">
                                        <label><?= translate("valor_inical_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control input-sm" name="valor_inicial" required value="<?= $subasta_object->valor_inicial; ?>" placeholder="<?= translate('valor_inical_lang'); ?>">
                                        </div>

                                    </div>


                                    <div class="col-lg-3">

                                        <label><?= translate("cate_list_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select id="name_espa" name="name_espa" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                                <?php
                                                if (isset($all_categoria))
                                                    foreach ($all_categoria as $item) { ?>
                                                    <option <?php if ($item->categoria_id == $subasta_object->categoria_id) { ?> selected <?php } ?> value="<?= $item->categoria_id; ?>"><?= $item->name_espa; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-lg-3">

                                        <label><?= translate("listar_city_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select id="ciudad" name="ciudad" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                                <?php
                                                if (isset($all_ciudad))
                                                    foreach ($all_ciudad as $item) { ?>
                                                    <option <?php if ($item->ciudad_id == $subasta_object->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>

                                    <br>

                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <label><?= translate("image_lang"); ?> (768x768)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                                    <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                                </div>

                                            </div>


                                            <div class="col-lg-3">

                                                <label><?= translate("date_cierre_lang"); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    <input type="date" class="form-control input-sm" name="fecha_cierre" required value="<?= $subasta_object->fecha_cierre; ?>" placeholder="<?= translate('date_cierre_lang'); ?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-3">
                                                <label><?= translate("valor_pagado_lang"); ?></label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control input-sm" name="valor_pago" requiered value="<?= $subasta_object->valor_pago; ?>" placeholder="<?= translate('valor_pagado_lang'); ?>">
                                                </div>

                                            </div>




                                            <div class="col-lg-3">
                                                <label><?= translate("state_subasta"); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                    <select id="is_open" name="is_open" class="form-control  input-sm" placeholder="<?= translate('state_subasta'); ?>" style="width: 100%">

                                                        <option <?php if ($subasta_object->is_open == 1) { ?> selected <?php } ?> value="1">Abierta</option>
                                                        <option <?php if ($subasta_object->is_open == 0) { ?> selected <?php } ?> value="0">Cerrada</option>
                                                    </select>
                                                </div>
                                            </div>





                                        </div>

                                        <br>


                                        <div class="col-lg-12">
                                            <div class="row">

                                                <div class="form-group">
                                                    <label class="control-label">Descripción</label>
                                                    <textarea name="descrip_espa" class="form-control textarea" placeholder="Descripcion">
                                   <?= $subasta_object->descrip_espa; ?>
                                </textarea>

                                                </div>

                                            </div>

                                        </div>









                                        <div class="col-lg-12" style="text-align: right;">
                                            <br>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                        </div>


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
        $(".select2").select2();
        $('#reservation').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>