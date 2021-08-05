<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_cate_anun_lang'); ?>
            <small><?= translate('listar_categoria_lang'); ?></small>
            | <a href="<?= site_url('cate_anuncio/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
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
                                    <th>Banner</th>
                                    <th>Icono</th>
                                    <th>visible</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_cate_anuncio as $item) { ?>
                                    <tr>
                                        <td> <?= $item->nombre; ?></td>
                                        <td style="width:40%">
                                            <?php if (file_exists($item->banner)) {
                                                echo '<img style="width:35%" class="img img-rounded img-responsive" src="' . base_url($item->banner) . '" />';
                                            } else {
                                                echo '<img style="width:10%" class="img img-rounded img-responsive" src="' . base_url("assets/image-no-found.jpg") . '" />';
                                            } ?>
                                        </td>
                                        <td style="width:10%">
                                            <?php if (file_exists($item->photo)) {
                                                echo '<img style="width:35%" class="img img-rounded img-responsive" src="' . base_url($item->photo) . '" />';
                                            } else {
                                                echo '<img style="width:10%" class="img img-rounded img-responsive" src="' . base_url("assets/image-no-found.jpg") . '" />';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($item->is_front == 1) {
                                                echo '<i class="fa fa-eye" aria-hidden="true"></i>';
                                            } else {
                                                echo '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                                            } ?>
                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?= site_url('cate_anuncio/change/' . $item->cate_anuncio_id); ?>"><i class="fa fa-eye"></i> Visible front</a></li>
                                                    <li><a href="<?= site_url('cate_anuncio/update_index/' . $item->cate_anuncio_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('cate_anuncio/delete/' . $item->cate_anuncio_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('cate_anuncio/index_subcate/' . $item->cate_anuncio_id); ?>"><i class="fa fa-folder-open-o" aria-hidden="true"></i> <?= translate("manage_subcate_lang"); ?></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Banner</th>
                                    <th>Icono</th>
                                    <th>visible</th>
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