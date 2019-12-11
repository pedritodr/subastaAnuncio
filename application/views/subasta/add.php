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

                        <?= form_open_multipart("subasta/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control input-sm" name="nombre_espa" placeholder="<?= translate('nombre_lang'); ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("valor_inical_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control input-sm" name="valor_inicial" placeholder="<?= translate('valor_inical_lang'); ?>">
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("cate_list_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="name_espa" name="name_espa" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                            <?php
                                            if (isset($all_categoria))
                                                foreach ($all_categoria as $item) { ?>
                                                <option value="<?= $item->categoria_id; ?>"><?= $item->name_espa; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <label><?= translate("listar_city_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </span>
                                        <select id="ciudad" name="ciudad" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                            <?php
                                            if (isset($all_ciudad))
                                                foreach ($all_ciudad as $item) { ?>
                                                <option value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                </div>


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
                                        <input type="datetime-local" class="form-control input-sm" name="fecha_cierre" placeholder="<?= translate('date_cierre_lang'); ?>">
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("valor_pagado_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control input-sm" name="valor_pago" placeholder="<?= translate('valor_pagado_lang'); ?>">
                                    </div>

                                </div>



                                <div class="col-lg-3">
                                    <label><?= translate("state_subasta"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="is_open" name="is_open" class="form-control select2 input-sm" placeholder="<?= translate('state_subasta'); ?>" style="width: 100%">

                                            <option value=1>Abierta</option>
                                            <option value=2>Cerrada</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <label class="control-label"><?= translate('description_lang'); ?></label>
                                        <textarea name="descrip_espa" class="form-control textarea" required placeholder="<?= translate('description_lang'); ?>">

                            </textarea>
                                    </div>
                                </div>


                            </div>
                            <!--cierre del col 12-->
                        </div>
                        <!--cierre del ro-->










                        <div class="col-lg-12" style="text-align: right;">
                            <br>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
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

    });
</script>