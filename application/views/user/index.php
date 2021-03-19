<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_users_lang'); ?>
            <small><?= translate('users_lang'); ?></small>
            | <a href="<?= site_url('user/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('user_list_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th style="width:10%">&nbsp;</th>
                                    <th>Información del Usuario</th>
                                    <th><?= translate("email_lang"); ?></th>


                                    <th><?= translate("role_lang"); ?></th>
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
                                        <td >
                                           <b> <?= $item->name; ?> 
                                        <?=$item->surname; ?> </b> 
                                        <br>Cedula: <?= $item->cedula; ?>
                                        <br>Teléfono: <?= $item->phone ?> 
                                        <br>Ciudad: <?= $item->ciudad ?> 
                                        <br>Dirección: <?= $item->direccion ?>
                                    </td>
                                        <td><?= $item->email; ?></td>


                                        <td>

                                            <?php if ($item->role_id == 1) { ?>
                                                <span><?= translate("administrador_lang"); ?></span>
                                            <?php } elseif ($item->role_id == 2) { ?>
                                                <span><?= "Cliente"; ?></span>
                                            <?php } elseif ($item->role_id == 3) { ?>
                                                <span><?= "Subastador"; ?></span>
                                            <?php } elseif ($item->role_id == 4) { ?>
                                                <span><?= "Gestor de Contenido"; ?></span>


                                            <?php } ?>

                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <?php if ($item->user_id != 4) { ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?= site_url('user/update_index/' . $item->user_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                        <li><a href="<?= site_url('user/delete/' . $item->user_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>

                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>




                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>&nbsp;</th>
                                    
                                <th>Información del Usuario</th>
                                    <th><?= translate("email_lang");  ?></th>

                                    <th><?= translate("role_lang"); ?></th>
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