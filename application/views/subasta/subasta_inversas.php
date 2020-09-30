<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_subasta_lang'); ?>
            <small><?= translate('listar_subasta_lang'); ?></small>
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
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= "Cliente" ?></th>
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
                                            <p><strong><?= "Fecha de inicio" ?>: </strong></p><label class="label label-success"><?= $item->fecha_inicio; ?></label>
                                            <p><strong><?= translate("date_cierre_lang"); ?>: </strong></p><label class="label label-danger"><?= $item->fecha_cierre; ?></label>
                                            <p><strong><?= translate("name_cate_lang"); ?> : </strong><label class="label label-success"><?= $item->categoria ?></label></p>
                                            <p><strong>Subcategoría : </strong><label class="label label-success"><?= $item->subcategoria ?></label></p>
                                            <p><strong>Ciudad : </strong><label class="label label-success"><?= $item->ciudad ?></label></p>
                                            <?php if ($item->is_open == 1) { ?>

                                                <label class="label label-success">Abierta</label>

                                            <?php } else { ?>
                                                <label class="label label-danger">Cerrada</label>
                                            <?php } ?>
                                        </td>


                                        <td style="width:20%"><img style="width:250px;height:100px;" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" /></td>
                                        <?php $cliente = json_decode($item->cliente); ?>
                                        <td>
                                            <p><strong>Nombre : </strong><label class="label label-info"><?= $cliente->name ?></label></p>
                                            <p><strong>Apellido: </strong><label class="label label-info"><?= $cliente->surname ?></label></p>
                                            <p><strong>Email : </strong><label class="label label-info"><?= $cliente->email ?></label></p>
                                            <p><strong>Teléfono : </strong><label class="label label-info"><?= $cliente->phone ?></label></p>
                                        </td>

                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="<?= site_url('subasta/update_inversa/' . $item->intervalo_subasta_id . '/' . $item->subasta_id . '/' . $item->subasta_user_id); ?>"><i class="fa fa-check"></i> <?= "Activar" ?></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("descripcion_lang"); ?></th>
                                    <th><?= translate("photos_lang"); ?></th>
                                    <th><?= "Cliente" ?></th>
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
                [5, "desc"]
            ]
        });
    });
</script>