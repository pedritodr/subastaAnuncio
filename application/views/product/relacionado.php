<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_relacionado_lang'); ?>
            <small> <?= translate('listar_photo_lang'); ?></small>
            | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('manage_relacionado_lang'); ?>
            </li>


        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_relacionado_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("product/add_relacionado"); ?>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label><?= translate("products_lang"); ?></label>

                                        <div id="producto_body" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows"></i></span>
                                            <select id="productos" name="productos[]" class="form-control select2 input-sm" multiple="multiple" style="width: 100%">
                                                <?php
                                                if (isset($lista_products))
                                                    foreach ($lista_products as $item) { ?>
                                                <option <?php
                                                            if (isset($result_products)) {
                                                                if (in_array($item->producto_id, $result_products)) { ?> selected <?php }
                                                                                                                                        } ?> value="<?= $item->producto_id; ?>"><?= $item->name; ?></option>
                                                <?php } ?>

                                            </select>

                                        </div>




                                    </div>
                                </div>
                                <br>
                                <input type="hidden" name="producto_id" value="<?= $producto_id; ?>" />


                                <div class="row">
                                    <br>
                                    <div class="col-xs-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                    </div>
                                </div>



                            </div>
                            <?= form_close(); ?>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->






    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_variety_lang'); ?>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_products as $item) { ?>
                                <tr>
                                    <td>
                                        <?= $item->name ?>
                                    </td>
                                    <td>
                                        <img style="width:350px;height:150px;" class="img img-rounded img-responsive" src="<?= base_url($item->main_photo); ?>" />
                                    </td>
                                    <td>
                                        <a href="<?= site_url('product/delete_relacionado/' . $item->relacionado_producto_id . '/' . $producto_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                    </td>
                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
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
        $(".textarea").wysihtml5();
        $(".select2").select2();

    });

    var producto_id = <?= json_encode($producto_id); ?>;
    //console.log(all_products);
    $('#categoria_id').change(function() {

        var id = $("select[name=categoria_id]").val();
        // var provider_id = $("select[name=provider_id]").val();
        //  $('#body_varieties').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('provider/get_product_by_category') ?>",
            data: {
                id: id,
                provider_id: provider_id
            },
            success: function(result) {
                result = JSON.parse(result);
                console.log(result);



                for (let i = 0; i < result.length; i++) {
                    cadena = "<option value='" + result[i].product_id + "'>" + result[i].name + "</option>";

                }
                //  cadena = cadena + "</select>"
                $('#variety').html(cadena);
                // $('#variety').addClass("select2");
                // $('#variety').attr('multiple', 'multiple');
            }
        });

    });

    /* $(".box-body").bind("click", function() {
         $('#variety').change(function() {
             $('#body_measure').show();
         });
     });*/
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>