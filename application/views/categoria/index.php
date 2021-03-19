<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_categories_lang'); ?>
            <small><?= translate('listar_categoria_lang'); ?></small>
            | <a href="<?= site_url('categoria/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_categoria_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_categoria_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>         
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categorias as $item) { ?>
                                <tr>

                                    <td> <?= $item->name_espa; ?></td>
                                    <td style="width:5%; background:#000000;"><img style="width:60px;height:60px;" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" /></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="<?= site_url('categoria/subcategoria/' .$item->categoria_id); ?>"><i class="fa fa-check"></i> Gestionar Subcategorias</a></li>
                                                <li><a href="<?= site_url('categoria/update_index/' . $item->categoria_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                <li><a href="<?= site_url('categoria/delete/' .$item->categoria_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
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