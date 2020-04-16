<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_payment_lang'); ?>
            <small><?= translate('historial_payment_lang'); ?></small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('historial_payment_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('historial_payment_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= "Referencia" ?></th>
                                    <th><?= "RequestID" ?></th>
                                    <th><?= "Cliente" ?></th>
                                    <th><?= "Detalle" ?></th>
                                    <th><?= "Fecha"; ?></th>
                                    <th><?= "Valor" ?></th>
                                    <th><?= translate("state_subasta") ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_payment as $item) { ?>
                                    <tr>
                                        <td> <?= $item->reference; ?></td>
                                        <td> <?= $item->request_id; ?></td>
                                        <td>
                                            <p><strong>Cliente: </strong><?= $item->user->name; ?></p>
                                            <p><strong>Email: </strong><?= $item->user->email; ?></p>
                                        </td>
                                        <td><?= $item->detalle; ?> </td>
                                        <td>
                                            <?= $item->date; ?>
                                        </td>
                                        <td><label class="label label-success">$<?= number_format($item->monto, 2); ?></label></td>
                                        <td> <?php if ($item->status == 0) { ?>
                                                <?php $estado = "Nuevo pago"; ?>
                                            <?php } elseif ($item->status == 1) { ?>
                                                <?php $estado = "Aprobado"; ?>
                                            <?php } elseif ($item->status == 2) { ?>
                                                <?php $estado = "Cancelada por el cliente ó rechazada"; ?>
                                            <?php } elseif ($item->status == 3) { ?>
                                                <?php $estado = "Pendiente por aprobar"; ?>
                                            <?php } elseif ($item->status == 4) { ?>
                                                <?php $estado = "Reverso"; ?>
                                            <?php } ?>
                                            <label class="label label-info"><?= $estado ?></label>
                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <?php if ($item->status == 1) { ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a style="cursor:pointer" onclick="cargar_modal_reverso('<?= base64_encode(json_encode($item)) ?>','0')"><i class="fa fa-edit"></i> <?= "Reverso" ?></a></li>
                                                        <li><a style="cursor:pointer" onclick="cargar_modal_reverso('<?= base64_encode(json_encode($item)) ?>','1')"><i class="fa fa-edit"></i> <?= "Reverso manual" ?></a></li>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>



                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= "Referencia" ?></th>
                                    <th><?= "Cliente" ?></th>
                                    <th><?= "RequestID" ?></th>
                                    <th><?= "Detalle" ?></th>
                                    <th><?= "Fecha"; ?></th>
                                    <th><?= "Valor" ?></th>
                                    <th><?= translate("state_subasta") ?></th>
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
<div class="modal fade" id="modal_reverso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="titulo_detalle">Confirmación</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="requestID">
                    <div class="col-lg-12">
                        <p id="reference" class="text-center"></p>
                        <p id="request_id" class="text-center"></p>
                        <p id="valor" class="text-center"></p>
                        <p id="cliente" class="text-center"></p>
                        <p id="email" class="text-center"></p>

                    </div>
                    <div id="mensaje_reverso" class="col-lg-12">

                    </div>

                </div>
                <div style="display:none" id="cargando_reverso" class="row">

                    <div class="col-lg-12">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin" style="color: green;font-size: 60px; margin-left:45%"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_reverso" onclick="reverso()" type="button" class="btn btn-success">Aceptar</button>
                <button id="btn_reverso_manual" onclick="reverso_manual()" type="button" class="btn btn-success">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "order": [
                [0, "desc"]
            ]
        });

    });

    function cargar_modal_reverso(object, ok) {
        if (ok == 0) {
            $('#btn_reverso').show();
            $('#btn_reverso_manual').hide();
        } else {
            $('#btn_reverso').hide();
            $('#btn_reverso_manual').show();
        }

        $('#mensaje_reverso').html("");
        $('#cargando_reverso').hide();
        object = atob(object);
        object = JSON.parse(object);
        $('#reference').html("<strong>Reference: </strong> " + object.reference);
        $('#request_id').html("<strong>RequestID: </strong> " + object.request_id);
        $('#valor').html("<strong>Valor: </strong> $" + parseFloat(object.monto).toFixed(2));
        $('#cliente').html("<strong>Cliente: </strong> " + object.user.name);
        $('#email').html("<strong>Email: </strong> " + object.user.email);
        $('#requestID').val(object.request_id);
        $('#modal_reverso').modal('show');
    }

    function reverso() {
        $('#btn_reverso').hide();
        $('#cargando_reverso').show();
        let request_id = $('#requestID').val();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('payment/reverso') ?>",

            data: {
                request_id: request_id,
            },
            success: function(result) {
                console.log(result);
                result = JSON.parse(result);
                // console.log(result);
                if (result.status == 500) {
                    $('#cargando_reverso').hide();
                    $('#mensaje_reverso').html("<h3 class='text-center'>" + result.estado + "</h3><p class='text-center'>" + result.mensaje + "</p>");
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                } else if (result.status == 404) {
                    $('#cargando_reverso').hide();
                    $('#mensaje_reverso').html("<h3 class='text-center'>Negada</h3><p class='text-center'>No se pudo proceder porque ya exite un reverso ó esta cancelada.</p>");
                } else if (result.status == 200) {
                    $('#cargando_reverso').hide();
                    $('#mensaje_reverso').html("<h3 class='text-center'>Negada</h3><p class='text-center'>No se pudo proceder, iniciar proceso de reverso manual.</p>");
                }
            }
        });
    }

    function reverso_manual() {
        $('#btn_reverso_manual').hide();
        $('#cargando_reverso').show();
        let request_id = $('#requestID').val();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('payment/reverso_manual') ?>",

            data: {
                request_id: request_id,
            },
            success: function(result) {
                console.log(result);
                result = JSON.parse(result);
                // console.log(result);
                if (result.status == 500) {
                    $('#cargando_reverso').hide();
                    $('#mensaje_reverso').html("<h3 class='text-center'>Actualizado</h3><p class='text-center'>El reverso manual ah sido exitoso</p>");
                    setTimeout(() => {
                        location.reload();
                    }, 4000);

                } else if (result.status == 200) {
                    $('#cargando_reverso').hide();
                    $('#mensaje_reverso').html("<h3 class='text-center'>Negada</h3><p class='text-center'>No se pudo proceder, iniciar proceso de reverso manual.</p>");
                }
            }
        });
    }
</script>