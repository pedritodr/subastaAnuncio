<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_products_lang'); ?>
            <small><?= translate('add_products_lang'); ?></small>
            | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_products_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_products_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("product/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="name" required placeholder="<?= translate('nombre_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("price_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" step="any" name="price" min="0" class="form-control" required />

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label><?= translate("image_lang"); ?> (768x768)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input type="file" class="form-control" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <label><?= translate("colecciones_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                        <select id="colecciones" name="colecciones" required class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                            <?php
                                            if (isset($all_colecciones))
                                                foreach ($all_colecciones as $item) { ?>
                                            <option value="<?= $item->coleccion_id; ?>"><?= $item->name; ?></option>
                                            <?php } ?>
                                        </select>



                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <label><?= translate("categorie_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                        <select id="categoria" name="categoria" required class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">

                                            <?php
                                            if (isset($all_categorias))
                                                foreach ($all_categorias as $item) { ?>
                                            <option value="<?= $item->categoria_id; ?>"><?= $item->nombre; ?></option>
                                            <?php } ?>
                                        </select>



                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("stock_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" step="any" name="stock" min="0" class="form-control" required />

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("descuento_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">%
                                        </span>
                                        <input type="number" step="any" name="descuento" min="0" class="form-control" required />

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">Descripción</label>
                                        <textarea name="desc" class="form-control textarea" placeholder="Descripción">

                                    </textarea>

                                        <br>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">
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
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();

    });
</script>