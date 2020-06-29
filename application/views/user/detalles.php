<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Perfil de Cliente
            <small><?= translate('users_lang'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('user_list_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <img style="width: 75%; margin: 0 auto;" class="img img-rounded img-responsive" src="<?= site_url($usuarios->photo); ?>"> 
            </div>
            <div class="col-md-3">
                <h4><?= strtoupper($usuarios->name)." ".strtoupper($usuarios->surname); ?></h4>
                <h4><?= strtoupper($usuarios->cedula); ?></h4>
            </div>
            <div class="col-md-4">
                <h4><?= strtoupper("TELÉFONO: ".$usuarios->phone);?></h4>
                <h4> <?= strtoupper("CORREO: ".$usuarios->email); ?></h4>
            </div>
            <div class="col-md-3">
                <h4><?= strtoupper("CIUDAD: ".$ciudad); ?></h4>
                <h4><?= strtoupper("DIRECCIÓN: ".$usuarios->direccion); ?></h4>
            </div>    
        </div>
        <div class="row">
            <br>
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Compras</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Detalles</th>
                                    <th>Monto</th>
                                    <th>Referencia</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allpay as $item) { ?>
                                    <tr>

                                       

                                        <td><?= $item->detalle; ?></td>
                                        <td><?= $item->monto; ?></td>
                                        <td><?= $item->reference; ?></td>
                                        <td><?= $item->date; ?></td>


                                       
                                        
                                    </tr>




                                <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:10%">&nbsp;</th>
                                <tr>
                                        <th>Detalles</th>
                                        <th>Monto</th>
                                        <th>Referencia</th>
                                        <th>Fecha</th>
                                    </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Membresías</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre<br>&nbsp;</th>
                                    <th>Anuncios Disponibles</th>
                                    <th>Cantidad Subasta</th>

                                    <th>Fecha inicio</th>
                                    <th>Fecha finalización</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>

                                        <td><?= $tipomembresia->nombre; ?></td>
                                        <td><?php
                                        $disponible = $tipomembresia->cant_anuncio - $membresia->anuncios_publi;
                                        echo $disponible;
                                        ?></td>
                                        <td><?php
                                        $disponible = $tipomembresia->qty_subastas;
                                        echo $disponible;
                                        ?></td>
                                        <td><?= $membresia->fecha_inicio; ?></td>
                                        <td><?= $membresia->fecha_fin; ?></td>


                                       
                                        
                                    </tr>





                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:10%">&nbsp;</th>
                                <tr>
                                <th>Membresia</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de finalización</th>
                                    </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    

    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $("#example2").DataTable();

    });
</script>