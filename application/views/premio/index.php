<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_premios_lang'); ?>
            <small><?= translate('listar_premios_lang'); ?></small>
            | <a href="<?= site_url('premio/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_premios_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_premios_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("premios_lang"); ?></th>
                                    <th><?= translate("qty_wins_lang"); ?></th>
                                    <th><?= translate("ganadores_lang"); ?></th>
                                    <th><?= translate("sorteo_lang"); ?></th>
                                    <th><?= translate("date_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_premios as $item) { ?>
                                    <tr>
                                        <td>
                                            <?= $item->premio; ?>
                                        </td>
                                        <td style="width:15% !important">
                                            <label class="label label-danger"> <?= $item->cantidad_ganadores; ?></label>
                                        </td>
                                        <td>
                                            <?php $wins = json_decode($item->ganadores) ?>
                                            <?php foreach ($wins as $win) { ?>
                                                <p><strong>Nombre: </strong><?= $win->name ?> </p>
                                                <p><strong>Email: </strong><?= $win->email ?> </p>
                                                <p><strong>Telefono: </strong><?= $win->phone ?> </p>
                                                <?php if ($win->ciudad) { ?>
                                                    <p><strong>Ciudad: </strong><?= $win->ciudad->name_ciudad ?> </p>
                                                <?php } else { ?>
                                                    <p><strong>Ciudad: </strong> </p>
                                                <?php } ?>
                                                <p><strong>Dirección: </strong><?= $win->direccion ?></p>
                                                <hr>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php if ($item->tipo == 1) { ?>

                                                <label class="label label-info">Mensual</label>
                                            <?php } else { ?>
                                                <label class="label label-info">Anual</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $item->fecha_create; ?>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("premios_lang"); ?></th>
                                    <th><?= translate("qty_wins_lang"); ?></th>
                                    <th><?= translate("ganadores_lang"); ?></th>
                                    <th><?= translate("sorteo_lang"); ?></th>
                                    <th><?= translate("date_lang"); ?></th>
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