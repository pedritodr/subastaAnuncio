<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_menu_lang'); ?>
            <small><?= translate('listar_menu_lang'); ?></small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_menu_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_menu_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th>"Frase"</th>
                                    <th><?= translate("menu_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_menus as $item) { ?>
                                <tr>
                                    <td><?= $item->menu_id; ?></td>
                                    <td style="width: 30%;"><img class="img img-rounded img-responsive" src="<?= base_url($item->photo_main); ?>" style="width: 200px; height: 150px;" /></td>

                                    <td><?= $item->frase; ?></td>
                                    <td><?= $item->menu; ?></td>
                                    <td>
                                        <a href="<?= site_url('menu/update_index/' . $item->menu_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                    </td>
                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th>"Frase"</th>
                                    <th><?= translate("menu_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
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