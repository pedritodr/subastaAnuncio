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
                    <div class="col-md-6"><h3 class="box-title">Membresías</h3></div>
                    <div class="col-md-6" align ="right"><a data-toggle="modal" data-target="#modal_membresia" class="btn btn-primary">Cargar Membresía</a></div>
                        
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
                                <?php
                                    foreach($membresia as $item)
                                        {
                                            ?>
                                            <tr>

                                            <td><?= $item->nombre; ?></td>
                                            <td><?php
                                            $disponible = $item->cant_anuncio ;
                                            echo $disponible;
                                            ?></td>
                                            <td><?php
                                            $disponible = $item->qty_subastas;
                                            echo $disponible;
                                            ?></td>
                                            <td><?= $item->fecha_inicio; ?></td>
                                            <td><?= $item->fecha_fin; ?></td>




</tr>
                                            <?php
                                        }
                                        ?>
                                    





                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width:10%">&nbsp;</th>
                                <tr>
                                <th>Nombre<br>&nbsp;</th>
                                        <th>Anuncios Disponibles</th>
                                        <th>Cantidad Subasta</th>

                                        <th>Fecha inicio</th>
                                        <th>Fecha finalización</th>
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
    
    <div class="modal fade" id="modal_membresia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center" id="titulo_detalle">¿Asignar Membresía?</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="requestID">
                        <div class="col-lg-12">
                            <table class="table">
                                <tr>
                                    <th>Nombre</th>
                                    <th colspan="2">Descripcion</th>
                                    <th>Precio</th>
                                    <th>&nbsp;</th>
                                </tr>
                               
                                    <?php
                                    foreach($allmembresia as $mimembresia)
                                    {
                                        ?>
                                       <tr>
                                        <td><div id="n_membresia<?=$mimembresia->membresia_id;?>"><?= $mimembresia->nombre; ?></div></td>
                                        <td colspan="2"><?= $mimembresia->descripcion; ?></td>
                                        <td><?= $mimembresia->precio; ?>$</td>
                                        <td><a href="#" onclick="myfunction(<?=$mimembresia->membresia_id; ?>);" class="form-control btn btn-info">Seleccionar</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                            </table>
                            
                        </div>
                        

                    </div>
                    
                </div>
                <div id="asignar">
                    <h2 style="color:black;"><div id="nombreplan"></div></h2>
                </div>
                <div class="modal-footer">
                <?= form_open("membresia/asignar_membresia");?>
                    <input type="hidden" id="id_usuario" readonly name="id_usuario" value="<?= $usuarios->user_id ?>">
                    <input type="hidden" id="idmembresia" readonly name="idmembresia">
                    
                    <input type="submit"  class="btn btn-success" value="Confirmar">
                    <button type="button" class="btn" style="color:white; background-color:red;" data-dismiss="modal">Cancelar</button>
                    <?=form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $("#example2").DataTable();

    });

    function myfunction(valor)
    {

       var nombre =  document.getElementById("n_membresia"+valor).innerHTML;
       document.getElementById("nombreplan").innerHTML = "¿Desea asignar el " +nombre + "?";
       //document.getElementById("idmembresia").val = valor;
       $('#idmembresia').val(valor);
       
    }
</script>