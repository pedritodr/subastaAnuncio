<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_city_lang'); ?>
            <small> <?= translate('update_city_lang'); ?></small>
            | <a href="<?= site_url('pais/index_ciudad/' . $ciudad_object->pais_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"> <?= translate('update_city_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_city_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("pais/update_ciudades"); ?>
                        <div class="row">

                        <div class="col-lg-6">
                                <label><?= translate("nombre_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="name_ciudad" required value="<?= $ciudad_object->name_ciudad; ?>" placeholder="<?= translate('nombre_lang'); ?>">
                                </div>


                            </div>


                            <input type="hidden" name="ciudad_id" value="<?= $ciudad_object->ciudad_id; ?>" />


                        </div>

                        <div class="row">
                            <div class="col-xs-12" style="text-align: left;">
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
        
    });
</script>