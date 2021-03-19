<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_products_lang'); ?>
            <small><?= translate('listar_products_lang'); ?></small>
            | <a href="<?= site_url('product/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_products_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_products_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("price_lang"); ?></th>
                                    <th><?= translate("coleccion_lang"); ?></th>
                                    <th><?= translate("categorie_lang"); ?></th>
                                    <th><?= translate("descuento_lang"); ?></th>
                                    <th><?= translate("stock_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_productos as $item) { ?>
                                <tr>
                                    <td><?= $item->name; ?></td>
                                    <td style="width:20%"><img style="width:250px;height:100px;" class="img img-rounded img-responsive" src="<?= base_url($item->main_photo); ?>" /></td>
                                    <td><?= $item->description; ?></td>
                                    <td><?= $item->price; ?></td>
                                    <td><?= $item->coleccion; ?></td>
                                    <td><?= $item->categoria; ?></td>
                                    <td><small class="label label-primary"><?= number_format($item->descuento, 2); ?> </small></td>
                                    <td><small class="label label-danger"><?= $item->stock; ?> </small></td>
                                    <td><?php if ($item->is_active == 0) { ?>
                                        <small class="label label-warning">
                                            Desabilitado
                                        </small>
                                        <?php } ?>
                                        <?php if ($item->is_active == 1) { ?>
                                        <small class="label label-success">
                                            Habilitado
                                        </small>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <!-- Single button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= site_url('product/update_index/' . $item->producto_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                <li><a href="<?= site_url('product/change/' . $item->producto_id); ?>"><i class="fa fa-refresh"></i> <?= translate("change_lang"); ?></a></li>
                                                <li><a href="<?= site_url('product/foto_coleccion/' . $item->producto_id); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <?= translate("manage_photo_lang"); ?></a></li>
                                                <li><a href="<?= site_url('product/relacionado/' . $item->producto_id); ?>"><i class="fa fa-book" aria-hidden="true"></i> <?= translate("manage_relacionado_lang"); ?></a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="<?= site_url('product/delete/' . $item->producto_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                            </ul>
                                        </div>




                                    </td>
                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("price_lang"); ?></th>
                                    <th><?= translate("coleccion_lang"); ?></th>
                                    <th><?= translate("categorie_lang"); ?></th>
                                    <th><?= translate("descuento_lang"); ?></th>
                                    <th><?= translate("stock_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
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