<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_membresia_lang'); ?>
            <small><?= translate('listar_membresia_lang'); ?></small>
            | <a href="<?= site_url('membresia/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_membresia_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_membresia_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("precios_lang"); ?></th>
                                    <th><?= translate("sorteo_lang"); ?></th>
                                    <th><?= translate("descuento_lang"); ?></th>
                                    <th><?= translate("cant_anuncios_lang") ?></th>
                                    <th>Duración de la membresia</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_membresia as $item) { ?>
                                    <tr>
                                        <td> <?= 'Nombre: ' . $item->nombre; ?>
                                            <br>
                                            <?= 'Orden: ' . $item->orden; ?>
                                            <br>
                                            <h3 style="background: #<?= $item->color; ?>; border:1px solid;color:#000"> <?= 'Color: #' . $item->color; ?></h3>
                                        </td>
                                        <td> <?= $item->descripcion; ?>
                                            <p><b>Bono: </b>$ <?= number_format($item->bono, 2) ?></p>
                                            <?php if ($item->type == 1) { ?>
                                                <label class="label label-primary">Emprendedor</label>
                                            <?php } else { ?>
                                                <label class="label label-success">Inversionista</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <p>$<?= number_format($item->precio, 2); ?></p>
                                        </td>
                                        <td>
                                            <?php if ($item->sorteo == 1) { ?>
                                                <label class="label label-primary">SI</label>
                                            <?php } else { ?>
                                                <label class="label label-danger">NO</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <p><?= $item->descuento; ?>%</p>
                                        </td>
                                        <td>
                                            <p><?= $item->cant_anuncio; ?></p>
                                        </td>
                                        <td>
                                            <p><?= $item->duracion; ?> días</p>
                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?= site_url('membresia/update_index/' . $item->membresia_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('membresia/delete/' . $item->membresia_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("precios_lang"); ?></th>
                                    <th><?= translate("sorteo_lang"); ?></th>
                                    <th><?= translate("descuento_lang"); ?></th>
                                    <th><?= translate("cant_anuncios_lang") ?></th>
                                    <th>Duración de la membresia</th>
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