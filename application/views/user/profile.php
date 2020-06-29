<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Editar perfil | <?= $user_object->name ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> Pizarra resumen</a></li>

            <li class="active">Editar perfil</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Formulario para editar perfil de usuario</h3>
                        <?php
                        if($user_object->photo != "")
                            {
                            ?>
                            <img style="width: 25%; margin: 0 auto;" class="img img-rounded img-responsive" src="<?= site_url($user_object->photo); ?>">                    
                            <?php
                            }
                        ?>
                      </div>
                    
                        <!-- /.box-header -->
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("user/execute_edit_profile"); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Nombres</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="fullname" required value="<?= $user_object->name; ?>" placeholder="<?= translate('fullname_lang'); ?>">
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <label>Apellidos</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="surname" required value="<?= $user_object->surname; ?>" placeholder="Apellidos">
                                </div>


                            </div>
                            <div class="col-lg-6">
                                <label>Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="phone" required value="<?= $user_object->phone; ?>" placeholder="Teléfono">
                                </div>


                            </div>
                            <div class="col-lg-6">
                                <label>Cédula</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="cedula" required value="<?= $user_object->cedula; ?>" placeholder="Cédula">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label>Ciudad</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <select class="form-control" name="ciudad" required>
                                        <option selected value="<?= $city->ciudad_id; ?>"><?= $city->name_ciudad; ?></option>
                                        <?php
                                        foreach($cityall as $result)
                                            {
                                                if($city->name_ciudad == $result->name_ciudad)
                                                    {

                                                    }
                                                else{
                                                    ?>
                                                    <option  value="<?= $result->ciudad_id; ?>"><?= $result->name_ciudad; ?></option>

                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="direccion" required value="<?= $user_object->direccion; ?>" placeholder="Dirección">
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <label>Imagen de Perfil</label>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input id="image_upload" accept=".jpg,.jpeg,.png,.bmp,.gif" type="file" class="form-control"  name="archivo" placeholder="Foto de Perfil">
                                
                                    <input type="hidden" readonly name="user_id" value="<?= $user_object->user_id; ?>" />

                                </div>
                            </div>
                            <div class="col-lg-2" style="text-align: left;">
                            <br>
                                <center><button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button></center>
                            </div>
                           

                           
                        </div>


                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</div>

<script type="text/javascript">
    $(function() {
        $(".textarea").wysihtml5();
    });
</script>