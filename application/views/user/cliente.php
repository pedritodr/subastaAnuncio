<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= "Gestión de Clientes"; ?>
            <small><?= translate('users_lang'); ?></small>
            | <a href="<?= site_url('user/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active">Clientes</li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Clientes</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th style="width:10%">&nbsp;</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th>Cédula</th>
                                    <th>Dirección</th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th>Telefono</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_users as $item) { ?>
                                    <tr>

                                        <?php
                                            if($item->photo == "")
                                                {
                                                    ?>
                                                    <td>&nbsp;</td>
                                                    <?php
                                                }
                                            else
                                            {
                                                ?>
                                                <td> <img style="width: 75%; margin: 0 auto;" class="img img-rounded img-responsive" src="<?= site_url($item->photo); ?>"></td>
                                                <?php
                                            }
                                        ?>
                                       

                                        <td><?= $item->name; ?> <?= $item->surname; ?></td>
                                        <td><?= $item->cedula; ?></td>
                                        <td><?= $item->direccion; ?></td>
                                        <td><?= $item->email; ?></td>


                                        <td>

                                            <a style="color:black;" href="tel:<?=$item->phone ?>"><?= $item->phone; ?></a>

                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <?php if ($item->user_id != 4) { ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?= site_url('user/detalles/' . $item->user_id); ?>"><i class="fa fa-search"></i>Detalles</a></li>

                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>




                                <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:10%">&nbsp;</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th>Cédula</th>
                                    <th>Dirección</th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th>Telefono</th>
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