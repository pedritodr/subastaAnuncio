<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_colecciones_lang'); ?>
            <small><?= translate('update_coleccion_lang'); ?></small>
            | <a href="<?= site_url('coleccion/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_coleccion_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_coleccion_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("coleccion/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="name" required placeholder="<?= translate('nombre_lang'); ?>" value="<?= $coleccion_object->name; ?>">
                                        <input name="coleccion_id" id="" class="btn btn-primary" type="hidden" value="<?= $coleccion_object->coleccion_id; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label><?= translate("image_lang"); ?> (768x768)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input type="file" class="form-control" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">Descripción</label>
                                        <textarea name="desc" class="form-control textarea" placeholder="Descripción">
                                   <?= $coleccion_object->description; ?>
                                    </textarea>

                                        <br>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                    </div>
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

    });
</script>