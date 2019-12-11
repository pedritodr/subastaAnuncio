<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Editar credencial | <?= $user_object->name ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> Pizarra resumen</a></li>

            <li class="active">Editar credencial</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Credenciales del usuario</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="post" action="<?= site_url('user/execute_edit_credencial'); ?>" method="post">
                            <div>
                                <?= get_message_from_operation(); ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">

                                    <div class="form-group">
                                        <label class="control-label">Email</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="text" name="email" value="<?= $user_object->email; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label"><?= translate("password_lang"); ?></label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="password" id="password" name="password" value="<?= $user_object->password; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />
                            <input type="hidden" name="validacion" value=0 />

                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar
                                    </button>
                                    <a class="btn btn-default" href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</div>

<script type="text/javascript">
    $("#password").focus(function() {
        $(this).css("background-color", "#FFFFCC");
        $(this).prop('type', 'text');
        $("#password").val("");
        $('input[name=validacion]').val(1);
    });

    $(function() {
        $(".textarea").wysihtml5();
    });
</script>