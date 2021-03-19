<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_photo_lang'); ?>
            <small><?= translate('add_photo_lang'); ?></small>
            | <a href="<?= site_url('product/foto_coleccion/' . $producto_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('manage_photo_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_photo_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("product/add_foto"); ?>

                        <div class="row">
                            <div class="col-lg-12">

                                <input type="hidden" name="producto_id" value="<?= $producto_id; ?>" />
                                <label><?= translate("image_lang"); ?> (768x768)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control" name="archivo" required placeholder="<?= translate('image_lang'); ?>">
                                </div>

                                <div class="row">
                                    <br>
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