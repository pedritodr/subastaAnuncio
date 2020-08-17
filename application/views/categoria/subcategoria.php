<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestionar Subcategorías
            <small>Listar Subcategorías</small>
            | <a href="<?= site_url('categoria/index'); ?>" class="btn btn-primary">Ir Atras </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active">Lista de Subcategorías</li>


        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_category_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("categoria/add2", array('id' => 'formSubcategoria')); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input id="nombreSub" type="text" class="form-control input-sm" name="name_espa" placeholder="<?= translate('nombre_lang'); ?>">
                                            <input type="hidden" readonly class="form-control input-sm" name="idcategoria" value="<?= $idcategoria ?>">
                                            <input name="sub_categoria" id="subCategoria" type="hidden" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="text-align: right;">
                                <br>
                                <button id="btnSubcategoria" type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                <button id="btnCancelar" type="button" class="btn btn-info">Cancelar</button>
                            </div>
                        </div>
                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categorias as $item) { ?>
                                    <tr>
                                        <td> <?= $item->nombre; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a style="cursor:pointer" onclick="cargarEditar('<?= base64_encode(json_encode($item)) ?>')"><i class="fa fa-edit"></i>Editar</a></li>
                                                    <li><a data-toggle="modal" data-target="#modal_delete" data-id="<?= $item->subcat_id; ?>"><i class="fa fa-remove"></i>Quitar</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
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

<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Subcategoría de Subasta?</h4>
            </div>
            <div class="modal-body">
                <p>¿Confirma que desea eliminar la subcategoría de subastas?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button id="btn-confirm2" type="button" class="btn bg-olive" onclick="" ;>Confirmar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(function() {
        $('#btnCancelar').hide();
        // action modal confirm
        $('#modal_delete').on('shown.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            let id = $(e.relatedTarget).data('id');
            let url = "<?= site_url('categoria/delete2/') ?>" + id;
            // console.log('la caca es ' + category_id);
            $("#btn-confirm2").attr('onclick', "window.location.href = '" + url + "'");
        });
        $("#example1").DataTable({
            "order": [
                [1, "asc"]
            ],
            "ordering": true,
            "columnDefs": [{
                "width": "5%",
                "targets": 3,
                "className": "text-center",
                "targets": "_all",
            }],
        });

    });

    function cargarEditar(params) {
        let obj = atob(params);
        obj = JSON.parse(obj);
        $('#subCategoria').val(obj.subcat_id);
        $('#nombreSub').val(obj.nombre);
        $('#btnCancelar').show();
        $('#formSubcategoria').prop('action', '<?= site_url("categoria/update_subcategoria") ?>');
        $('#btnSubcategoria').html('<i class="fa fa-edit"></i> Actualizar');
        $('html, body').animate({
            scrollTop: 0
        }, 1250);
    }
    $('#btnCancelar').click(function() {
        $('#btnCancelar').hide();
        $('#formSubcategoria').prop('action', '<?= site_url("categoria/add2") ?>');
        $('#subCategoria').val("");
        $('#nombreSub').val("");
        $('#btnSubcategoria').html('<i class="fa fa-check-square"></i> <?= translate("guardar_info_lang"); ?>');
    })
</script>