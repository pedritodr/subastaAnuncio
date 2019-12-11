<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_color_product_lang'); ?>
            <small><?= translate('listar_color_products_lang'); ?></small>
            | <a href="<?= site_url('color_product/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_color_products_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_color_products_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_colores as $item) { ?>
                                    <tr>

                                        <td><?= $item->color_producto_id; ?></td>
                                        <td> <?= $item->nombre; ?></td>
                                        <td>
                                            <a href="<?= site_url('color_product/update_index/' . $item->color_producto_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                            <a href="<?= site_url('color_product/delete/' . $item->color_producto_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("nombre_lang"); ?></th>
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
        $("#example1").DataTable({
            "order": [
                [0, "desc"]
            ]
        });

    });
</script>