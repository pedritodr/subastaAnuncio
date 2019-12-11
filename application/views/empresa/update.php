<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_empresa_lang'); ?>
            <small><?= translate('update_empresa_lang'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_empresa_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_empresa_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("empresa/update"); ?>
                        <input type="hidden" name="empresa_id" value="<?= $empresa_object->empresa_id; ?>" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-lg-4">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input type="text" class="form-control input-sm" name="nombre" required value="<?= $empresa_object->nombre; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("phone_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control input-sm" name="telef" value="<?= $empresa_object->telefonos; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("email_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i><strong>@</strong></i></span>
                                            <input type="email" class="form-control input-sm" name="email" value="<?= $empresa_object->email; ?>">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("direccion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control input-sm" name="direccion" value="<?= $empresa_object->direccion; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label><?= translate("url_video_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-play"></i></span>
                                            <input type="text" class="form-control input-sm" name="url_video" value="<?= $empresa_object->video; ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('sobre_nosotros_lang'); ?></label>
                                            <textarea name="desc" class="form-control textarea" required>
                                            <?= $empresa_object->sobre_nosotros; ?>
                                    </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('mision_lang'); ?></label>
                                            <textarea name="mision" class="form-control textarea" required>
                                            <?= $empresa_object->mision; ?>
                                    </textarea>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('vision_lang'); ?></label>
                                            <textarea name="vision" class="form-control textarea" required>
                                            <?= $empresa_object->vision; ?>
                                            </textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <label><?= translate("facebook_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-facebook-f"></i></span>
                                            <input type="url" class="form-control input-sm" name="face" value="<?= $empresa_object->facebook; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= "Instagram"; ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                            <input type="url" class="form-control input-sm" name="instagram" value="<?= $empresa_object->instagram; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("youtube_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
                                            <input type="url" class="form-control input-sm" name="you" value="<?= $empresa_object->youtube; ?>">
                                        </div>
                                    </div>

                                    <br>


                                </div>

                                <br>

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