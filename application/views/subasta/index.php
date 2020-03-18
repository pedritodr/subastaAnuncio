<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_subasta_lang'); ?>
            <small><?= translate('listar_subasta_lang'); ?></small>
            | <a href="<?= site_url('subasta/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_subasta_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_subasta_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("descripcion_lang"); ?></th>
                                    <th><?= translate("valor_inical_lang"); ?></th>
                                    <th><?= translate('name_cate_lang'); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= translate("date_cierre_lang"); ?></th>
                                    <th><?= translate("valor_pagado_lang"); ?></th>
                                    <th><?= translate("state_subasta"); ?></th>
                                    <th><?= translate('name_city_lang'); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_subasta as $item) { ?>
                                    <tr>
                                        <td>
                                            <?php if ($item->tipo_subasta == 1) { ?>
                                                <p><?= translate("tipo_subasta_lang") . ": "  ?> <label class="label label-success">Directa</label></p>
                                            <?php } else { ?>
                                                <p> <?= translate("tipo_subasta_lang") . ": "  ?> <label class="label label-info">Inversa </label></p>
                                            <?php } ?>

                                            <br>
                                            <?= $item->nombre_espa; ?>
                                        </td>
                                        <td>
                                            <p>
                                                <?= $item->descrip_espa; ?>
                                            </p>
                                            <?php if ($item->tipo_subasta == 2) { ?>
                                                <p><strong><?= translate("qty_article_lang"); ?> : </strong><label class="label label-danger"><?= $item->qty_articles ?></label></p>
                                                <p><strong><?= translate("valor_maximo_lang"); ?> : </strong><label class="label label-danger">$<?= number_format($item->valor_maximo, 2) ?></label></p>
                                                <p><strong><?= translate("valor_minimo_lang"); ?> : </strong><label class="label label-danger">$<?= number_format($item->valor_minimo, 2) ?></label></p>
                                                <p><strong><?= translate("cant_dias_lang"); ?> : </strong><label class="label label-danger"><?= $item->cantidad_dias ?></label></p>
                                                <p><strong><?= translate("intervalo_dias_lang"); ?> : </strong><label class="label label-danger"><?= $item->intervalo ?></label></p>
                                                <p><strong><?= translate("porcentaje_deducion_lang"); ?> : </strong><label class="label label-danger">%<?= $item->porcentaje ?></label></p>

                                            <?php } ?>


                                        </td>
                                        <td> <label class="label label-info">$<?= number_format($item->valor_inicial, 2); ?></label></td>
                                        <td> <?= $item->categoria->name_espa; ?></td>
                                        <td style="width:20%"><img style="width:250px;height:100px;" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" /></td>
                                        <td> <?= $item->fecha_cierre; ?></td>

                                        <td> <label class="label label-warning">$<?= number_format($item->valor_pago, 2); ?></label></td>
                                        <td> <?php if ($item->is_open == 1) { ?>

                                                <label class="label label-success">Abierta</label>

                                            <?php } else { ?>
                                                <label class="label label-danger">Cerrada</label>
                                            <?php } ?>
                                        </td>
                                        <td> <?= $item->ciudad->name_ciudad; ?></td>

                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="<?= site_url('subasta/update_index/' . $item->subasta_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('subasta/change_open/' . $item->subasta_id); ?>"><i class="fa fa-edit"></i> <?= translate("change_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('subasta/delete/' . $item->subasta_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                                    <li><a href="<?= site_url('subasta/index_foto/' . $item->subasta_id); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <?= translate("manage_photo_lang"); ?></a></li>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>



                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("descripcion_lang"); ?></th>
                                    <th><?= translate("valor_inical_lang"); ?></th>
                                    <th><?= translate('name_cate_lang'); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= translate("date_cierre_lang"); ?></th>
                                    <th><?= translate("valor_pagado_lang"); ?></th>
                                    <th><?= translate("state_subasta"); ?></th>
                                    <th><?= translate('name_city_lang'); ?></th>
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

        $('#example1').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>