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
            <?= translate('manage_membresia_lang'); ?>
            <small><?= translate('update_membresia_lang'); ?></small>
            | <a href="<?= site_url('membresia/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_membresia_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_membresia_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("membresia/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="hidden" name="membresia_id" value="<?= $membresia_object->membresia_id; ?>" />

                                            <input type="text" class="form-control input-sm" name="nombre" required placeholder="<?= translate('nombre_lang'); ?>" value="<?= $membresia_object->nombre; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-4">
                                        <label><?= translate("precios_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                            <input type="number" class="form-control input-sm" name="precio" required placeholder="<?= translate('precios_lang'); ?>" value="<?= $membresia_object->precio; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-2">
                                        <label><?= translate("cant_anuncios_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i><strong>N°</strong></i></i></span>
                                            <input step="any" type="number" class="form-control input-sm" name="cant_anuncio" required placeholder="<?= translate('precios_lang'); ?>" value="<?= $membresia_object->cant_anuncio; ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                        <label>Duración de la membresia</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i><strong>N°</strong></i></i></span>
                                            <input required min="0" type="number" class="form-control input-sm" name="duracion" placeholder="<?= 'Duración de la membresia' ?>" value="<?= $membresia_object->duracion; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('description_lang'); ?></label>
                                            <textarea name="descripcion" rows="4" class="form-control textarea" required placeholder="<?= translate('description_lang'); ?>">
                                            <?= $membresia_object->descripcion; ?>
                                    </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label><?= translate("descuento_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i><strong>%</strong></i></i></span>
                                            <input required type="number" class="form-control input-sm" name="descuento" placeholder="<?= translate('descuento_lang'); ?>" value="<?= $membresia_object->descuento; ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                        <label><?= "Cantidad de subastas"; ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i><strong>N</strong></i></i></span>
                                            <input required type="number" class="form-control input-sm" name="subastas" placeholder="<?= "Cantidad de subastas"; ?>" value="<?= $membresia_object->qty_subastas; ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                        <label><?= translate("sorteo_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select required id="sorteo" name="sorteo" class="form-control  input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                                <option <?php if ($membresia_object->sorteo == 1) { ?> selected <?php } ?> value="1">SI</option>
                                                <option <?php if ($membresia_object->sorteo == 2) { ?> selected <?php } ?> value="2">NO</option>

                                            </select>

                                        </div>
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