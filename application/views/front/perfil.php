<style>
    .btn-wallet {
        background: #fff;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        border-radius: 20px;
        border: 2px solid #8c1822;
        padding: 7px;
        cursor: pointer;
        color: #8c1822;
    }

    .btn-wallet img {
        width: 100px;
        height: 100px;
    }

    .btn-wallet:hover {
        border: 2px solid #293681;
        color: #293681;
    }

    .btn-wallet img:hover {
        width: 101px;
        height: 101px;
    }

    .btn-wallet-disabled {
        background: #fff;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        border-radius: 20px;
        border: 2px solid #8c1822;
        padding: 7px;
        cursor: no-drop;
        color: #8c1822;
    }

    .btn-wallet-disabled:hover {
        border: 2px solid #293681;
        color: #293681;
        background: #ececec;
    }

    .card .tab-pane {
        padding: 1px 0;
    }

    .card .tab-content {
        padding: 1px;
    }

    .btn.app-download-button i {
        display: block;
        font-size: 30px;
        float: left;
        padding: 0 65px 0 0;
    }

    .app-text-section h2 {
        color: #fff;
        margin-bottom: 5px;
        opacity: 0.8;
        text-transform: none;
    }

    .app-text-section h5 {
        color: #fff;
        margin-bottom: 5px;
        opacity: 0.8;
        text-transform: none;
    }

    .app-text-section p {
        color: #fff;
        margin-bottom: 5px;
        opacity: 0.8;
        text-transform: none;
    }

    .app-text-section h6 {
        color: #fff;
        margin-bottom: 5px;
        opacity: 0.8;
        text-transform: none;
    }

    .app-download-section.style-2 .app-download-section-container {
        padding: 1px 0 0 0;
    }

    .thumbnail {
        display: block;
        padding: 2px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: transparent;
        border: 1px solid #fefdfc;
        border-radius: 4px;
        -webkit-transition: border .2s ease-in-out;
        -o-transition: border .2s ease-in-out;
        transition: border .2s ease-in-out;
    }
</style>
<link href="<?= base_url() ?>basic_primitive/primitives.css" media="screen" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/datatables/dataTables.bootstrap.css">
<script src="https://cdn.jsdelivr.net/npm/basicprimitives@6.2.2/dist/primitives.min.js"></script>
<!-- jQuery 2.1.4 -->
<script src="<?= base_url(); ?>admin_lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>admin_lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Master Slider -->
<!--       <?php if (count($all_banners) > 0) { ?>
          <div class="master-slider ms-skin-default banner2" id="masterslider">
              <?php foreach ($all_banners as $item) { ?>
                  <div class="ms-slide slide-1" data-delay="5">
                      <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />
                  </div>
              <?php } ?>
          </div>
      <?php } ?> -->
<!-- end Master Slider -->
<!-- Small Breadcrumb -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix" style="margin-top: 6%;">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding-perfil  gray">
        <!-- Main Container -->
        <div class=" container-fluid">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-3 col-sm-12 col-xs-12 leftbar-stick blog-sidebar">
                    <!-- Sidebar Widgets -->
                    <div style="padding-top: 5%;" class="user-profile">
                        <div class="text-center">
                            <?php if ($user_data->photo == "") { ?>
                                <img style="width:50%" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                            <?php } else { ?>
                                <?php if (strpos($user_data->photo, 'uploads') !== false) { ?>
                                    <img style="width:50%" src="<?= base_url($user_data->photo) ?>" alt="">
                                <?php } else { ?>
                                    <img style="width:50%" src="<?= $user_data->photo ?>" alt="">
                                <?php } ?>
                            <?php } ?>
                        </div>

                        <div class="profile-detail">
                            <h6 class="text-center"><?= $user_data->name ?></h6>

                            <ul class="contact-details">
                                <?php if ($city) { ?>
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        <?= $city->name_ciudad ?>
                                    </li>
                                <?php } ?>
                                <li>
                                    <i class="fa fa-envelope"></i> <?= $user_data->email; ?>
                                </li>

                                <li>
                                    <i class="fa fa-phone"></i> <?= $user_data->phone; ?>
                                </li>
                            </ul>
                        </div>
                        <ul>
                            <li class="forever active" id="perfil" style="cursor:pointer"><a><?= translate('perfil_lang') ?></a></li>
                            <li class="forever" id="beneficio" style="cursor:pointer"><a>Prog. Beneficios</a></li>
                            <li class="forever" id="wallet" style="cursor:pointer"><a>Billetera</a></li>
                            <li class="forever" id="update_password" style="cursor:pointer"><a><?= translate('update_password_lang') ?></a></li>
                            <li class="forever" id="ads" style="cursor:pointer"><a><?= translate('mis_anuncios_lang') ?><span class="badge"><?php if ($contador_anuncios) { ?> <?= ($contador_anuncios) ?><?php } else { ?>0 <?php } ?></span></a></li>
                            <li class="forever" id="subs" style="cursor:pointer"><a><?= translate('mis_subastas_lang') ?><span class="badge"><?php if ($mis_subastas_directas) { ?> <?= (count($mis_subastas_directas)) ?><?php } else { ?>0 <?php } ?></span></a></li>
                            <li class="forever" id="subs_inversas" style="cursor:pointer"><a><?= translate('mis_subastas_inversas_lang') ?><span class="badge"><?php if ($mis_subastas_inversas) { ?> <?= (count($mis_subastas_inversas)) ?><?php } else { ?>0 <?php } ?></span></a></li>
                            <li class="forever" id="historial" style="cursor:pointer"><a><?= translate('historial_payment_lang') ?><span class="badge"><?php if ($payments) { ?> <?= (count($payments)) ?><?php } else { ?>0 <?php } ?></span></a></li>
                            <li><a href="<?= site_url('login/logout') ?>"><?= translate('sign_out_lang') ?></a></li>
                        </ul>
                    </div>
                    <!-- Categories -->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <?= get_message_from_operation(); ?>
                    <?php if ($payments) { ?>
                        <!-- lista de anuncios -->
                        <div id="listado_payments" class="row">

                            <div class="clearfix"></div>
                            <div class="col-md-12 margin-bottom-40">
                                <div class="heading-title">
                                    <h2><?= translate('historial_payment_lang') ?> </h2>
                                </div>
                                <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                                    <?php foreach ($payments as $pago) { ?>
                                        <?php if ($pago->status == 0) { ?>
                                            <?php $estado = "Nuevo pago"; ?>
                                        <?php } elseif ($pago->status == 1) { ?>
                                            <?php $estado = "Aprobado"; ?>
                                        <?php } elseif ($pago->status == 2) { ?>
                                            <?php $estado = "Cancelada por el cliente ó rechazada"; ?>
                                        <?php } elseif ($pago->status == 3) { ?>
                                            <?php $estado = "Pendiente por aprobar"; ?>
                                        <?php } elseif ($pago->status == 4) { ?>
                                            <?php $estado = "Reverso"; ?>
                                        <?php } ?>
                                        <div class="panel panel-default">
                                            <div id="headingOne" role="tab" class="panel-heading">
                                                <h4 class="panel-title"> <a aria-controls="payment_<?= $pago->payment_id ?>" aria-expanded="false" href="#payment_<?= $pago->payment_id ?>" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><strong>Referencia: </strong> <?= $pago->reference ?> <strong> Valor: </strong> $<?= number_format($pago->monto, 2) ?> <strong> Estado: </strong> <?= $estado ?> </a> </h4>
                                            </div>
                                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="payment_<?= $pago->payment_id ?>" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <p class="text-center"> <?= $pago->detalle ?></p>
                                                    <p class="text-center"> <strong>Fecha de la transacción: </strong><?= $pago->date ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div><?php } else { ?>
                        <div id="listado_payments" class="row">
                            <h4 class="text-center">No tiene pagos realizados.</h4>
                        </div>
                    <?php } ?>
                    <?php if ($all_anuncios) { ?>
                        <!-- lista de anuncios -->
                        <div id="listado_anuncio" class="row">
                            <!-- Sorting Filters -->
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <ul class="pagination pagination-lg">
                                    <?php echo $this->pagination->create_links(); ?>
                                </ul>
                            </div>
                            <!-- Sorting Filters End-->
                            <div class="clearfix"></div>
                            <!-- Pagination -->
                            <br>
                            <!-- mis anuncios -->
                            <div class="posts-masonry">
                                <!-- primer anuncio -->
                                <?php $contador = 1;
                                foreach ($all_anuncios as $item) { ?>

                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                        <div class="white category-grid-box-1 ">
                                            <!-- foto -->
                                            <div class="image"> <a title="" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id);  ?>">
                                                    <?php if (strpos($item->photo, 'uploads') !== false) { ?>
                                                        <?php if (file_exists($item->photo)) { ?>
                                                            <img class="img-responsive" src="<?= base_url($item->photo) ?>" alt="">
                                                        <?php } else { ?>
                                                            <img class="img-responsive" src="<?= base_url('assets/sinImagen.jpg') ?>" alt="">
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if (file_exists($item->photo)) { ?>
                                                            <img class="img-responsive" src="<?= $item->photo ?>" alt="">
                                                        <?php } else { ?>
                                                            <img class="img-responsive" src="<?= base_url('assets/sinImagen.jpg') ?>" alt="">
                                                        <?php } ?>
                                                    <?php } ?>
                                                </a>
                                                <?php if ($item->destacado == 1) { ?>
                                                    <div class="ribbon popular"><?= translate("featured_lang") ?></div>
                                                <?php } ?>
                                            </div>
                                            <!--descripcion -->
                                            <div style="height:199px !important" class="short-description-1 ">
                                                <!-- subcategoria  -->
                                                <?php if (isset($item->subcate->nombre)) { ?>
                                                    <div class="category-title"><?= $item->subcate->nombre; ?> </div>
                                                <?php } ?>
                                                <!-- descripcion -->
                                                <h6>
                                                    <a title="" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id);  ?>"><?= $item->titulo_corto; ?></a>
                                                </h6>
                                                <!-- Location -->
                                                <p class="location"><i class="fa fa-map-marker"></i> <?= $item->ciudad->name_ciudad; ?></p>
                                                <!-- Rating -->
                                                <div class="rating">
                                                    <ul class="pull-left">
                                                        <?php if ($item->is_active == 1) { ?>
                                                            <span class="badge"> Publicado</span>
                                                        <?php } else { ?>
                                                            <span class="badge"> Desactivado</span>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <!-- Price --><span class="ad-price">$<?= number_format($item->precio, 2); ?></span>
                                            </div>
                                            <!-- Ad Meta Stats -->
                                            <div class="ad-info-1">
                                                <ul class="pull-right">
                                                    <li> <a title="Editar anuncio" href=" <?= site_url(strtolower('update_anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id);  ?>"><i class="fa fa-pencil edit"></i></a> </li>
                                                    <?php if ($item->is_active == 1) { ?>
                                                        <li> <a title="Desactivar anuncio" onclick="cargar_modal_desactivar('<?= $item->anuncio_id ?>','1');"><i class="fa fa-times delete"></i></a></li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a title="Activar anuncio" onclick="cargar_modal_desactivar('<?= $item->anuncio_id ?>','2');"><i class="fa fa-check delete"></i></a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ($item->destacado == 0) { ?>
                                                        <li>
                                                            <a title="Destacar anuncio" onclick="cargar_modal_destacar('<?= base64_encode(json_encode($item)) ?>');"><i class="fa fa-star delete"></i></a>
                                                        </li>
                                                    <?php } ?>
                                                    <li>
                                                        <a title='Eliminar anuncio' onclick="cargar_modal_eliminar_anuncio('<?= $item->anuncio_id ?>');"><i style="font-size: 20px;" class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--fin primer anuncio-->
                            </div>
                        </div><?php } else { ?>
                        <div id="listado_anuncio" class="row">
                            <h4 class="text-center">No tiene anuncios publicados</h4>
                        </div>
                    <?php } ?>
                    <!-- Row -->
                    <?php if ($mis_subastas_directas) { ?>
                        <div id="listado_directas" class="row">
                            <div class="posts-masonry">
                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                    <ul class="list-unstyled">
                                        <?php foreach ($mis_subastas_directas as $item) { ?>

                                            <li>
                                                <div class="well ad-listing clearfix">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <!-- Ad Content-->
                                                        <div class="row">
                                                            <div class="content-area">
                                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                                    <!-- Category Title -->
                                                                    <div class="category-title"> <span><a><?= $item->categoria ?></a></span>
                                                                        <?php if ($item->is_open == 0) { ?>
                                                                            <span id="span_subasta_<?= $item->subasta_id ?>" class="label label-danger">Finalizada</span>
                                                                        <?php } else { ?>
                                                                            <span style="display:none" id="span_subasta_<?= $item->subasta_id ?>" class="label label-danger">Finalizada</span>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <!-- Ad Title -->
                                                                    <h6><a><?= $item->titulo_corto ?></a> </h6>
                                                                    <!-- Info Icons -->
                                                                    <!-- Ad Meta Info -->
                                                                    <ul class="ad-meta-info">
                                                                        <li> <i class="fa fa-map-marker"></i><a><?= $item->ciudad ?></a> </li>
                                                                        <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                    </ul>
                                                                    <?php if ($item->is_open == 1) { ?>
                                                                        <div class="row" id="cronometro_subasta_<?= $item->subasta_id ?>">
                                                                            <div class="col-md-12">
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="days" id="day_perfil_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("dias_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="hours" id="hour_perfil_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("horas_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="minutes" id="minute_perfil_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("minutos_lang"); ?></div>
                                                                                </div>
                                                                                <div style="margin-left:-19px" class="timer col-md-2 col-xs-3">
                                                                                    <div class="timer conte">
                                                                                        <span class="seconds" id="second_perfil_<?= $item->subasta_id ?>"></span>
                                                                                    </div>
                                                                                    <div class="smalltext"><?= translate("segundos_lang"); ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <!-- Ad Description-->
                                                                    <div class="ad-details">

                                                                        <?= $item->corta ?>


                                                                    </div>
                                                                    <?php if ($this->session->userdata('user_id')) { ?>
                                                                        <div class="row" id="btn_subastas_<?= $item->subasta_id ?>">

                                                                            <?php if (!$item->subasta_user) { ?>
                                                                                <?php if ($item->is_open == 1) { ?>
                                                                                    <div class="col-md-6" style="margin-bottom:5% !important">
                                                                                        <button id="btn_entrar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_entrar('<?= $item->subasta_id ?>','<?= $item->nombre_espa ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> <?= translate("entrar_subasta_lang"); ?></button>

                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                            <?php if ($item->subasta_user) { ?>
                                                                                <?php if ($item->puja_user) { ?>
                                                                                    <?php if ((float) $item->puja_user->valor < (float) $item->puja->valor) { ?>
                                                                                        <?php if ($item->is_open == 1) { ?>
                                                                                            <div class="col-md-6" style="margin-bottom:5% !important">
                                                                                                <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } else { ?>
                                                                                        <?php if ($item->is_open == 1) { ?>
                                                                                            <div class="col-md-6" style="margin-bottom:5% !important">
                                                                                                <button style="display:none" id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                <?php } else { ?>
                                                                                    <?php if ($item->is_open == 1) { ?>
                                                                                        <div class="col-md-6" style="margin-bottom:5% !important">
                                                                                            <button id="btn_pujar_subasta_<?= $item->subasta_id ?>" onclick=" cargarmodal_pujar('<?= $item->subasta_user->subasta_user_id ?>','<?= $item->nombre_espa ?>','<?= $item->puja->valor ?>','<?= $item->valor_inicial ?>');" class="btn btn-block btn-success"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> <?= translate("pujar_lang"); ?></button>

                                                                                        </div>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } ?>

                                                                        </div>
                                                                    <?php } ?>

                                                                </div>
                                                                <div style="margin-bottom:5% !important" class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                                                    <!-- Ad Stats -->

                                                                    <!-- Price -->
                                                                    <?php if ($item->subasta_user &&  $item->puja->valor > 0) { ?>
                                                                        <h6 class="text-center"><?= translate("valor_alto_lang"); ?></h6>
                                                                        <h5 class="text-center" style="font-size:14px !important"><span id="valor_inicial_subasta_<?= $item->subasta_id ?>" class="label label-success"><i class='fa fa-user-o'></i> <?= $item->user_win->name ?> $<?= number_format($item->puja->valor, 2) ?></span></h5>
                                                                    <?php } ?>
                                                                    <h6 class="text-center"><?= "Valor de entrada" ?></h6>
                                                                    <div class="price text-center"> <span>$ <?= number_format($item->valor_pago, 2) ?></span> </div>
                                                                    <h6 class="text-center"><?= "Valor inicial" ?> </h6>
                                                                    <div class="price text-center"><span>$ <?= number_format($item->valor_inicial, 2) ?></span> </div>
                                                                    <!-- Ad View Button -->

                                                                    <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= '' ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Ad Content End -->
                                                    </div>
                                                </div>
                                            </li>

                                        <?php  } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="listado_directas" class="row">
                            <h4 class="text-center">No tiene subastas directas</h4>
                        </div>
                    <?php } ?>
                    <?php if ($mis_subastas_inversas) { ?>
                        <div id="listado_inversas" class="row">
                            <div class="posts-masonry">
                                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                    <ul class="list-unstyled">
                                        <?php foreach ($mis_subastas_inversas as $item) { ?>

                                            <li>
                                                <div class="well ad-listing clearfix">
                                                    <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">

                                                        <div class="img-box">
                                                            <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                            <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-9 col-sm-7 col-xs-12">
                                                        <!-- Ad Content-->
                                                        <div class="row">
                                                            <div class="content-area">
                                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                                    <!-- Category Title -->
                                                                    <div class="category-title"> <span><a href="#"><?= $item->categoria ?></a></span>
                                                                    </div>
                                                                    <!-- Ad Title -->
                                                                    <h6><a><?= $item->titulo_corto ?></a> </h6>
                                                                    <!-- Info Icons -->
                                                                    <!-- Ad Meta Info -->
                                                                    <ul class="ad-meta-info">
                                                                        <li> <i class="fa fa-map-marker"></i><a href="#"><?= $item->ciudad ?></a> </li>
                                                                        <li> <i class="fa fa-clock-o"></i><?= $item->fecha_cierre ?> </li>
                                                                    </ul>
                                                                    <!-- Ad Description-->
                                                                    <div class="ad-details">
                                                                        <?= $item->corta ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-xs-12 col-sm-12">
                                                                    <h6 class="text-center"><?= "Precio" ?></h6>
                                                                    <div class="price text-center"> <span>$ <?= number_format($item->costo, 2) ?></span> </div>
                                                                    <!-- Ad View Button -->
                                                                    <button onclick="cargarmodal_subasta('<?= $item->subasta_id ?>','<?= base64_encode(json_encode($item)) ?>');" class="btn btn-block btn-success"><i class="fa fa-eye" aria-hidden="true"></i><?= translate("ver_info_lang"); ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Ad Content End -->
                                                    </div>
                                                </div>
                                            </li>
                                        <?php  } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="listado_inversas" class="row">
                            <h4 class="text-center">No tiene subastas inversas</h4>
                        </div>
                    <?php } ?>
                    <!--perfil-->
                    <div id="panel_perfil" class="profile-section margin-bottom-20">
                        <div class="profile-tabs">
                            <ul class="nav nav-justified nav-tabs">
                                <li id="perfil_tab" class="active"><a href="#profile" data-toggle="tab"><?= translate('profile_lang') ?></a></li>
                                <li id="editar_tab"><a href="#edit" data-toggle="tab"><?= translate('edit_perfil') ?></a></li>
                                <li id="bank_data_tab"><a href="#bankData" data-toggle="tab">Datos Bancarios</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="profile-edit tab-pane fade in active" id="profile">

                                    <dl class="dl-horizontal">
                                        <dt><strong><?= translate('name_cliente_lang') ?></strong></dt>
                                        <dd>
                                            <?= $user_data->name; ?>
                                        </dd>
                                        <dt><strong>Tu Apellido</strong></dt>
                                        <dd>
                                            <?= $user_data->surname; ?>
                                        </dd>
                                        <dt><strong> <?= translate('email_lang') ?> </strong></dt>
                                        <dd>
                                            <?= $user_data->email; ?>
                                        </dd>
                                        <?php if ($user_data->tipo_documento == 1) { ?>
                                            <dt><strong> <?= "Nro de Cédula" ?> </strong></dt>
                                            <dd>
                                                <?= $user_data->cedula; ?>
                                            </dd>
                                        <?php } else { ?>
                                            <dt><strong> <?= "Nro de Pasaporte" ?> </strong></dt>
                                            <dd>
                                                <?= $user_data->cedula; ?>
                                            </dd>

                                        <?php } ?>
                                        <dt><strong> <?= translate('phone_user__lang') ?> </strong></dt>
                                        <dd>
                                            <?= $user_data->phone ?>
                                        </dd>
                                        <dt><strong> <?= translate('country_lang') ?> </strong></dt>
                                        <dd>
                                            <?php if ($city) { ?>
                                                <?= $city->name_pais ?>
                                            <?php } ?>
                                        </dd>
                                        <dt><strong> <?= translate('name_city_lang') ?> </strong></dt>
                                        <dd>
                                            <?php if ($city) { ?>
                                                <?= $city->name_ciudad ?>
                                            <?php } ?>
                                        </dd>

                                        <dt><strong> <?= translate('direccion_lang') ?> </strong></dt>
                                        <dd>
                                            <?= $user_data->direccion; ?>
                                        </dd>
                                    </dl>
                                </div>
                                <!--editar perfil-->
                                <div class="profile-edit tab-pane fade" id="edit">

                                    <div class="clearfix"></div>

                                    <?php echo form_open_multipart("front/update_cliente") ?>
                                    <?= get_message_from_operation(); ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label><?= translate('name_cliente_lang') ?></label>
                                            <input type="text" value="<?= $user_data->name; ?>" name="name" id="name" class="form-control margin-bottom-20 input-text">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label><?= "Tu Apellido" ?></label>
                                            <input type="text" value="<?= $user_data->surname; ?>" name="surname" id="surname" class="form-control margin-bottom-20 input-text">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label> <?= translate('email_lang') ?> <span class="color-red">*</span></label>
                                            <input disabled type="text" value="<?= $this->session->userdata('email'); ?>" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label> <?= translate('phone_user__lang') ?> <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $user_data->phone ?>" name="phone" class="form-control margin-bottom-20 input-number">
                                        </div>
                                        <div class="col-lg-12">

                                            <div style="background: none;" id="search-section">

                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12 col-md-12">
                                                        <div class="col-md-5 col-xs-12 col-sm-5 no-padding">
                                                            <select class="form-control" name="tipo_documento" id="tipo_documento" required>

                                                                <option <?php if ($user_data->tipo_documento == 1) { ?> selected <?php } ?> value="1">Cédula</option>
                                                                <option <?php if ($user_data->tipo_documento == 2) { ?> selected <?php } ?> value="2">Pasaporte</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-7 col-xs-12 col-sm-7 no-padding">
                                                            <input name="nro_documento" type="number" class="form-control input-number" value="<?= $user_data->cedula ?>" placeholder="Nro de documento de identidad" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20">
                                            <label> <?= translate('country_lang') ?> <span class="color-red">*</span></label>
                                            <select onchange="change_pais();" id="pais" name="pais" class="form-control select2">

                                                <?php
                                                if (isset($all_pais))
                                                    foreach ($all_pais as $item) { ?>
                                                    <?php if ($city) { ?>
                                                        <option <?php if ($city->pais_id == $item->pais_id) { ?>selected <?php } ?> value="<?= $item->pais_id; ?>"><?= $item->name_pais; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $item->pais_id; ?>"><?= $item->name_pais; ?></option>
                                                    <?php } ?>

                                                <?php } ?>

                                            </select>

                                        </div> -->


                                        <div class="col-md-4 col-sm-4 col-xs-12 margin-bottom-20">
                                            <label> <?= translate('name_city_lang') ?> <span class="color-red">*</span></label>
                                            <select id="ciudad" name="ciudad" class="form-control select2">
                                                <option>Seleccione una ciudad</option>
                                                <?php
                                                if (isset($all_ciudad))
                                                    foreach ($all_ciudad as $item) { ?>
                                                    <?php if ($city) { ?>
                                                        <option <?php if ($city->ciudad_id == $item->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $item->ciudad_id; ?>"><?= $item->name_ciudad; ?></option>

                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12 margin-bottom-20">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label> <?= translate('photo_lang') ?> (400x400)</label>
                                                    <input style="width: 104%;" type="file" class="form-control" name="archivo" placeholder="<?= translate('photo_lang'); ?>">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label> <?= translate('direccion_lang') ?> <span class="color-red">*</span></label>
                                            <textarea name="direccion" class="form-control margin-bottom-20" rows="2"><?= $user_data->direccion ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">

                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <div class="skin-minimal">
                                                    <ul class="list">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                                            <button type="submit" class="btn btn-theme btn-sm"><?= translate('update_info_lang') ?></button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>

                                <div class="profile-edit tab-pane fade" id="bankData">

                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Nombre del banco <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->name_bank : '' ?>" id="bankName" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Número de cuenta <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->number_account : '' ?>" name="numberAcount" id="numberAccount" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-lg-6 margin-bottom-20">
                                            <label> Tipo de cuenta <span class="color-red">*</span></label>
                                            <select id="typeAccount" class="form-control">
                                                <option <?php if ($bank_data) {
                                                            if ($bank_data->type_account == 1) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="1">Ahorro</option>
                                                <option <?php if ($bank_data) {
                                                            if ($bank_data->type_account == 2) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="2">Corriente</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Nombre del titular <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->name_titular : '' ?>" id="nameTitular" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Número de identidad del titular <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->number_id : '' ?>" id="numberId" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Email de contacto <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->email : '' ?>" id="emailContact" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-lg-6 col-xs-12">
                                            <label>Teléfono de contacto <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $bank_data ? $bank_data->phone : '' ?>" id="phoneContact" class="form-control margin-bottom-20 ">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                                            <button type="buttom" onclick="handleSubmitBankData()" class="btn btn-theme btn-sm"><?= translate('update_info_lang') ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row End -->
                    <div id="panel_beneficio" class="profile-section margin-bottom-20">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab" aria-expanded="false">General</a></li>
                                        <li role="presentation" class=""><a href="#actual" aria-controls="actual" role="tab" data-toggle="tab" aria-expanded="false">Actual</a></li>
                                        <li role="presentation" class=""><a href="#equipo" aria-controls="equipo" role="tab" data-toggle="tab" aria-expanded="true" onclick="initDiagram();">Equipo</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="general">
                                            <div class="app-download-section style-2">
                                                <!-- app-download-section-wrapper -->
                                                <div class="app-download-section-wrapper">
                                                    <!-- app-download-section-container -->
                                                    <div class="app-download-section-container">
                                                        <!-- container -->
                                                        <div class="container">
                                                            <div class="row app-text-section">
                                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                                    <h5 class="text-center">Patrocinador <spam><img src="<?= base_url('assets/transfer.png') ?>" alt="" style="width:10%"></spam>
                                                                    </h5>
                                                                    <?php if ($user_data->parent) { ?>
                                                                        <p class="text-center"><b>Nombre y apellidos: </b><?= $user_data->parent->name . ' ' . $user_data->parent->surname ?></p>
                                                                        <p class="text-center"><b>Email: </b> <?= $user_data->parent->email ?></p>
                                                                    <?php } else { ?>
                                                                        <h6 class="text-center">No tiene patrocinador</h6>
                                                                    <?php } ?>
                                                                    <div style="margin-top:20px;text-align:center">
                                                                        <h5 style="text-align: center;">Link Personal</h5>
                                                                        <p style="text-align:center;font-size:14px">Este vínculo puede ser utilizado para compartir a través
                                                                            de los
                                                                            canales socilaes y facilitar el proceso de afiliación de tus referidos.</p>
                                                                        <a href="#" onclick="copyToClipboard('<?= site_url('referrer/' . base64_encode($this->session->userdata('email'))); ?>')" class="btn app-download-button">
                                                                            <span class="app-store-btn">
                                                                                <i class="fa fa-link" aria-hidden="true"></i>
                                                                                <span>
                                                                                    <span> Copiar link</span>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                                    <h5 class="text-left">Tipo de membresia <spam><img src="<?= base_url('assets/validation.png') ?>" alt="" style="width:10%"></spam>
                                                                    </h5>
                                                                    <?php if ($all_membresia) { ?>
                                                                        <br>
                                                                        <p><b><?= translate('membresia_act_lang') ?>:</b> <?= $all_membresia->nombre ?></p>

                                                                        <p><b>Subastas Disponibles:</b> <?= $user_membresia->qty_subastas; ?></p>

                                                                        <p><b>Anuncios Disponibles:</b> <?= $user_membresia->anuncios_publi;  ?></p>

                                                                        <p><b><?= translate('descripcion_lang') ?>:</b> </p>
                                                                        <p><?= $all_membresia->descripcion; ?></p>
                                                                    <?php } else { ?>
                                                                        <br>
                                                                        <h4 class="text-center">No tiene membresia</h4>
                                                                        <a href="<?= site_url('membresia') ?>" class="btn btn-block btn-theme">
                                                                            <span><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                            </span>
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">
                                                                                    <?= translate('adquirir_membresia_btn_lang') ?>
                                                                                </font>
                                                                            </font>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                                    <h5 class="text-left">Vigencia de la membresia <spam><img src="<?= base_url('assets/approve.png') ?>" alt="" style="width:10%"></spam>
                                                                    </h5>
                                                                    <?php if ($all_membresia) { ?>
                                                                        <br>
                                                                        <p><strong><?= translate('date_compra_lang') ?>: </strong><?= $user_membresia->fecha_inicio ?></p>
                                                                        <p><strong><?= translate('fecha_vencimiento_lang') ?>: </strong> <?= $user_membresia->fecha_fin ?></p>
                                                                    <?php } else { ?>
                                                                        <br>
                                                                        <h4 class="text-center">No tiene membresia</h4>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="actual">
                                            <div class="app-download-section style-2">
                                                <!-- app-download-section-wrapper -->
                                                <div class="app-download-section-wrapper">
                                                    <!-- app-download-section-container -->
                                                    <div class="app-download-section-container">
                                                        <!-- container -->
                                                        <div class="container app-text-section">
                                                            <!-- row -->
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 130px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"><i class="fa fa-usd" aria-hidden="true"></i> Saldo</h5>
                                                                            <p><i class="fa fa-usd" aria-hidden="true"></i>
                                                                                <?php
                                                                                if ($node) {
                                                                                    if ($node->points_left > $node->points_right) {
                                                                                        $pointToMoney = $node->points_right * 0.15;
                                                                                        echo number_format($pointToMoney, 2);
                                                                                    } else {
                                                                                        $pointToMoney = $node->points_left * 0.15;
                                                                                        echo  number_format($pointToMoney, 2);
                                                                                    }
                                                                                } else {
                                                                                    echo ' 0.00';
                                                                                }
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 130px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"><i class="fa fa-money" aria-hidden="true"></i> Beneficio Total</h5>
                                                                            <p><i class="fa fa-money" aria-hidden="true"></i>
                                                                                <?php
                                                                                if ($node) {
                                                                                    echo '$ ' . number_format($node->charged, 2);
                                                                                } else {
                                                                                    echo '$ 0.00';
                                                                                }
                                                                                ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 130px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"><i class="fa fa-star" aria-hidden="true"></i> Puntos</h5>
                                                                            <p>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $user_data->rank ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $user_data->rank ?>%;">
                                                                                    <?= $user_data->rank . '%' ?>
                                                                                </div>
                                                                            </div>
                                                                            <span class="text-left" style="color:#fff">1000/1000000</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 130px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"><i class="fa fa-shield" aria-hidden="true"></i> Rango</h5>
                                                                            <p><i class="fa fa-shield" aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 219px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"> Equipo izquierdo</h5>
                                                                            <h2 class="text-center"><i class="fa fa-users" aria-hidden="true"></i><span style="font-size:16px"> <?= $team_left ?> usuarios en total</span></h2>
                                                                            <h2 class="text-center"><i class="fa fa-star" aria-hidden="true"></i><span style="font-size:16px">
                                                                                    <?php
                                                                                    if ($node) {
                                                                                        echo $node->points_left . ' Puntos';
                                                                                    } else {
                                                                                        echo '0 Puntos';
                                                                                    }
                                                                                    ?>
                                                                                </span></h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail" style="height: 219px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"> Equipo derecho</h5>
                                                                            <h2 class="text-center"><i class="fa fa-users" aria-hidden="true"></i><span style="font-size:16px"> <?= $team_right ?> usuarios en total</span></h2>
                                                                            <h2 class="text-center"><i class="fa fa-star" aria-hidden="true"></i><span style="font-size:16px">
                                                                                    <?php
                                                                                    if ($node) {
                                                                                        echo $node->points_right . ' Puntos';
                                                                                    } else {
                                                                                        echo '0 Puntos';
                                                                                    }
                                                                                    ?></span></h2>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="thumbnail" style="height: 219px;">
                                                                        <div class="caption">
                                                                            <h5 class="text-left"> Ciclo de plan</h5>
                                                                            <br>
                                                                            <?php
                                                                            $porcentaje = 0;
                                                                            if ($all_membresia) {
                                                                                if ($all_membresia->type == 0) {
                                                                                    $totalAcum = ($all_membresia->precio * 200) / 100;
                                                                                    $totalPuntos = round((($all_membresia->precio * 200) / 100) * 0.15);
                                                                                    $porcentaje = 200;
                                                                                    if ($node) {
                                                                                        $objetive = (($node->points * 100) / $totalPuntos) * 100;
                                                                                        $totalPuntosGet = round((($node->points * 200) / 100) * 0.15);
                                                                                    } else {
                                                                                        $objetive = 0;
                                                                                        $totalPuntosGet = 0;
                                                                                    }
                                                                                } else {
                                                                                    $totalAcum = ($all_membresia->precio * 160) / 100;
                                                                                    $totalPuntos = round((($all_membresia->precio * 160) / 100) * 0.15);
                                                                                    $porcentaje = 160;
                                                                                    if ($node) {
                                                                                        $objetive = (($node->points * 100) / $totalPuntos) * 100;
                                                                                        $totalPuntosGet = round((($node->points * 160) / 100) * 0.15);
                                                                                    } else {
                                                                                        $objetive = 0;
                                                                                        $totalPuntosGet = 0;
                                                                                    }
                                                                                }
                                                                            } else {
                                                                                $totalPuntos = 0;
                                                                                $objetive = 0;
                                                                                $totalPuntosGet = 0;
                                                                            }




                                                                            ?>
                                                                            <p>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $objetive ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $objetive ?>%;">
                                                                                    <?= $objetive ?>%
                                                                                </div>
                                                                            </div>
                                                                            </p>
                                                                            <br>
                                                                            <h6 class="text-center"> <b><span style="color:#fff"> Progreso(<?= $totalPuntosGet / 10 ?>%) $ <?= $totalPuntosGet ?> &nbsp; &nbsp;&nbsp;&nbsp;Objetivo de $ <?= number_format($totalAcum, 2) ?> (<?= $porcentaje ?>%)</span></b></h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /row -->
                                                        </div>
                                                        <!-- /container -->
                                                    </div>
                                                    <!-- /app-download-section-container -->
                                                </div>
                                                <!-- /download-section-wrapper -->
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="equipo">
                                            <div class="app-download-section style-2">
                                                <!-- app-download-section-wrapper -->
                                                <div class="app-download-section-wrapper">
                                                    <!-- app-download-section-container -->
                                                    <div class="app-download-section-container">
                                                        <!-- container -->
                                                        <div class="container app-text-section">
                                                            <div class="row ">
                                                                <div class="col-lg-4 text-center">
                                                                    <div style="margin-top:15px;">
                                                                        <h5 style="text-align:center;">Variable de configuración</h5>
                                                                        <?php if ($node) {
                                                                            if ($node->variable_config == 0) {
                                                                                echo '<p class="text-center"><span class="label label-success" id="labelConfig">Derecha</span></p>';
                                                                            } else {
                                                                                echo '<p class="text-center"><span class="label label-success" id="labelConfig">Izquierda</span></p>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <?php if ($node) {
                                                                        echo ' <button class="btn btn-primary margin-bottom-10" onclick="handleMondalVariebleConfig()" type="buttom">Cambiar configuración</button>';
                                                                    } else {
                                                                        echo ' <button class="btn btn-primary margin-bottom-10" disabled onclick="handleMondalVariebleConfig()" type="buttom">Cambiar configuración</button>';
                                                                    } ?>

                                                                </div>
                                                                <div class="col-lg-8 col-xs-12 col-sm-8 col-md-8">
                                                                    <div style="margin-top:15px;">
                                                                        <h5 style="text-align:center;">Datos generales</h5>
                                                                    </div>
                                                                    <div id="areaDatosGeneralesEquipo"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="bodyEstructura">
                                                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                                                                    <div style="margin-top:15px;">
                                                                        <h5 style="text-align:center;">Estructura organizativa Izquierda</h5>
                                                                    </div>
                                                                    <div id="basicDiagram" style="width: 100%; height: 480px;"></div>
                                                                </div>
                                                                <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                                                                    <div style="margin-top:15px;">
                                                                        <h5 style="text-align:center;">Estructura organizativa Derecha</h5>
                                                                    </div>
                                                                    <div id="basicDiagramRight" style="width: 100%; height: 480px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel_wallet" class="profile-section margin-bottom-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <h1 class="text-left">Billetera</h1>
                                <?php if ($wallet) { ?>
                                    <h4 class="text-left">Saldo actual: <span style="color:#8c1822">$ <?= number_format($wallet->balance, 2) ?></span></h4>
                                <?php } else { ?>
                                    <h4 class="text-left">Saldo actual: <span style="color:#8c1822">$ 0.00</span></h4>
                                <?php } ?>
                            </div>
                            <?php if ($wallet) { ?>
                                <div class="col-lg-4 col-lg-offset-4" style="margin-bottom:10px">
                                    <div class="row">
                                        <div class="col-lg-6 ">
                                            <div class="text-center btn-wallet" onclick="handleModalTransferencia()"><img src="<?= base_url('assets/money-transfer.png') ?>" alt="">
                                                <p class="text-center"> Transferir Saldo</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class='text-center btn-wallet' onclick="handleMondalSolicitud()"><img src="<?= base_url('assets/retirada.png') ?>" alt="">
                                                <p class="text-center"> Solicitar Retiro</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-4 col-lg-offset-4" style="margin-bottom:10px">
                                    <div class="row">
                                        <div class="col-lg-6 ">
                                            <div class="text-center btn-wallet-disabled"><img src="<?= base_url('assets/money-transfer.png') ?>" alt="">
                                                <p class="text-center"> Transferir Saldo</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class='text-center btn-wallet-disabled'><img src="<?= base_url('assets/retirada.png') ?>" alt="">
                                                <p class="text-center"> Solicitar Retiro</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background:#fff">
                                <div class="card">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h5 class="text-left"> Transacciones</h5>
                                            <table id="example" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Detalle</th>
                                                        <th scope="col">Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    foreach ($transacciones as $trx) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $trx->transaction_id; ?></td>
                                                            <td><?= $trx->date_create; ?></td>
                                                            <td><?php if ($trx->type == 1) { ?>
                                                                    <p>Retiro</p>
                                                                <?php } else if ($trx->type == 2) { ?>
                                                                    <p>Transferencia</p>
                                                                <?php } else if ($trx->type == 3) { ?>
                                                                    <p>Comisión de referido</p>
                                                                <?php } else if ($trx->type == 4) { ?>
                                                                    <p>Compra de membresia</p>
                                                                <?php } else if ($trx->type == 5) { ?>
                                                                    <p>Solicitud de transferencia de saldo</p>
                                                                <?php } else if ($trx->type == 6) { ?>
                                                                    <p>Reintegro de la solicitud de transferencia</p>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($trx->wallet_receives == $wallet->wallet_id) {
                                                                    echo '<label style="color:green;font-weight:bold">+ $ ' . number_format($trx->amount, 2) . '</label>';
                                                                } else {
                                                                    echo '<label style="color:red;font-weight:bold">- $ ' . number_format($trx->amount, 2) . '</label>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Middle Content Area  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- Mostrando y ocultando vistas-->
    <div class="modal fade price-quote" id="modal_cambiar_password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title text-center" id="lineModalLabel"><?= translate("update_password_lang"); ?></h3>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <?php echo form_open_multipart("front/update_password_cliente") ?>

                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="password"><?= translate("anterior_password_lang"); ?></label>
                        <input placeholder="<?= translate("anterior_password_lang"); ?>" class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="nueva_password"><?= translate("nueva_password_lang"); ?></label>
                        <input placeholder="<?= translate("nueva_password_lang"); ?>" class="form-control" type="password" name="nueva_password" id="nueva_password">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20">
                        <button type="submit" class="btn btn-theme btn-block"><?= translate('update_password_lang') ?></button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade price-quote" id="modalTransferencia" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title text-center" id="lineModalLabel">Transferir saldo</h3>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-11 col-sm-10 col-10 col-md-11">
                            <div class="form-group">
                                <label>Email del destinatario</label>
                                <input class="form-control" placeholder="Escribe el email de la persona que recibirá los fondos" name="emailDestinatario" id="emailDestinatario" />
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-2 col-2 col-md-1">
                            <div style="margin-top:33px">
                                <a onclick="verificarDatosEmail();" href="#"><svg style="margin-top:10px;margin-left:-10px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fa3f59" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg></a>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Monto a transferir</label>
                                <input class="form-control" placeholder="Escribe el monto a transferir ($.$$)" type="number" min="1" step="0.01" name="montoTransferir" id="montoTransferir" />
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20">
                        <button type="buttom" onclick="completarTransferencia()" class="btn btn-theme btn-block">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade price-quote" id="modalVariableConfiguracion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title text-center" id="lineModalLabel">Variable de configuración</h3>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-offset-2 col-lg-8 ">
                            <div class="form-group">
                                <label>Variable <span class="color-red">*</span></label>
                                <select id="variableConfig" class="form-control select2">
                                    <option <?php if ($node) { ?> <?php if ($node->variable_config == 0) { ?>selected<?php } ?><?php } ?> value="0">Derecha</option>
                                    <option <?php if ($node) { ?> <?php if ($node->variable_config == 1) { ?>selected<?php } ?><?php } ?> value="1">Izquierda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20">
                        <button type="buttom" onclick="updateVariableConfig()" class="btn btn-theme btn-block">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade price-quote" id="modalSolicitud" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title text-center" id="lineModalLabel">Solicitar transferencia de saldo</h3>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <div class="row" style="margin-left: 20px;">
                        <div class="col-lg-12">
                            <h5 style="text-align:center;">Saldo disponible: <?= $wallet ? number_format($wallet->balance, 2) : 0 ?></h5>
                            <div class="form-group">
                                <label>Monto solicitado</label>
                                <input class="form-control" placeholder="Escribe el monto a solicitar ($.$$)" type="number" min="1" step="0.01" id="montoSolicitado" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h5 style="text-align:left;">Datos bancarios</h5>
                            <p class="text-left"><b>Nombre del banco: </b> <?= $bank_data ? $bank_data->name_bank : '' ?></p>
                            <p class="text-left"><b>Número de cuenta: </b> <?= $bank_data ? $bank_data->number_account : '' ?></p>
                            <?php if ($bank_data) {
                                if ($bank_data->type_account == 1) {
                                    echo '<p class="text-left"> <b>Tipo de cuenta :</b> Ahorro</p>';
                                } else {
                                    echo '<p class="text-left"> <b>Tipo de cuenta :</b> Corriente</p>';
                                }
                            } ?>
                            <p class="text-left"> <b>Nombre del titular: </b> <?= $bank_data ? $bank_data->name_titular : '' ?></p>
                            <p class="text-left"><b>Número de identidad del titular: </b> <?= $bank_data ? $bank_data->number_id : '' ?></p>
                            <p class="text-left"><b>Email de contacto:</b> <?= $bank_data ? $bank_data->email : '' ?></p>
                            <p class="text-left"><b>Teléfono de contacto:</b> <?= $bank_data ? $bank_data->phone : '' ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20 text-right" style="margin-left: 20px;">
                        <button type="buttom" onclick="handleSubmitSolicitud()" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <script type="text/javascript">
        const handleMondalSolicitud = () => {
            let bankData = JSON.parse('<?= $bank_data ? json_encode($bank_data) : null ?>');
            let billeteraActual = parseFloat('<?= $wallet ? number_format($wallet->balance, 2) : 0 ?>');
            if (!bankData) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Los datos bancarios son obligatorios para la solicitud de transferencia de saldo',
                    showConfirmButton: true,
                })
            } else if (billeteraActual <= 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Su saldo no es suficiente para realizar esta transacción',
                    showConfirmButton: true,
                })
            } else {
                $('#modalSolicitud').modal('show');
            }
        }

        const handleSubmitSolicitud = () => {
            let montoSolicitado = $('#montoSolicitado').val().trim();
            let billeteraActual = parseFloat('<?= $wallet ? number_format($wallet->balance, 2) : 0 ?>');
            if (montoSolicitado == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El monto es un campo requerido',
                    showConfirmButton: true
                })
            } else if (montoSolicitado <= 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El monto no puede ser 0',
                    showConfirmButton: true
                })
            } else if (billeteraActual < montoSolicitado) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El monto solicitado es mayor que el disponible en la billetera',
                    showConfirmButton: true
                })
            } else {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Procesando  solicitud de transferencia de saldo...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                let data = {
                    montoSolicitado,
                }
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('front/request_transfer_balance') ?>",
                        data: data,
                        success: function(result) {
                            Swal.close();
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Solicitud de transferencia de saldo creada correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                Swal.close();
                                swal({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }
                        }
                    });
                }, 1500)
            }
        }


        const handleSubmitBankData = () => {
            let bankName = $('#bankName').val().trim();
            let numberAcount = $('#numberAccount').val().trim();
            let typeAccount = $('#typeAccount').val();
            let nameTitular = $('#nameTitular').val().trim();
            let emailContact = $('#emailContact').val().trim();
            let phoneContact = $('#phoneContact').val().trim();

            if (bankName == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El nombre del banco es un campo requerido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#bankName').focus();
            } else if (numberAcount == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El número de cuenta es un campo requerido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#numberAcount').focus();
            } else if (nameTitular == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El nombre del titular de la cuenta es un campo requerido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#nameTitular').focus();
            } else if (emailContact == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El email del titular de la cuenta es un campo requerido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#nameTitular').focus();
            } else if (phoneContact == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'El teléfono es un campo requerido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#phoneContact').focus();
            } else {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando datos...',
                    imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                let data = {
                    bankName,
                    numberAcount,
                    typeAccount,
                    nameTitular,
                    emailContact,
                    phoneContact
                }
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('front/update_bank_data') ?>",
                        data: data,
                        success: function(result) {
                            Swal.close();
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Datos bancarios actualizados correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.close();
                                swal({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }
                        }
                    });
                }, 1500)
            }
        }

        const handleMondalVariebleConfig = () => {
            $('#modalVariableConfiguracion').modal('show');
        }

        const handleModalTransferencia = () => {
            $('#modalTransferencia').modal('show');
            $("#emailDestinatario").val('');
            $("#montoTransferir").val('');
        }

        const verificarDatosEmail = () => {
            let userEmail = '<?= $this->session->userdata('email') ?>';
            $('#modalTransferencia').modal('hide');
            let email = $('#emailDestinatario').val();
            let expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (expr.test(email)) {
                if (userEmail !== email) {
                    Swal.fire({
                        title: 'Completando operación',
                        text: 'Actualizando datos...',
                        imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                        imageAlt: 'No realice acciones sobre la página',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        footer: '<a href>No realice acciones sobre la página</a>',
                    });

                    let url = '<?= site_url("front/validate_email") ?>';
                    $.post(url, {
                        email: email
                    }, function(response) {
                        Swal.close();
                        response = JSON.parse(response);
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario encontrado',
                                text: response.data.name + ' ' + response.data.surname + ' ( ' + response.data.email +
                                    ' )',
                                confirmButtonText: 'Confirmado',
                                allowOutsideClick: false
                            }).then((result) => {
                                $('#modalTransferencia').modal('show');
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'No se encuentra un usuario con el email especificado',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                $('#modalTransferencia').modal('show');
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se puede enviar dinero a tu misma cuenta',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {
                        $('#modalTransferencia').modal('show');
                    });
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'El email no tiene un formato correcto',
                    showConfirmButton: false,
                    timer: 2500
                }).then((result) => {
                    $('#modalTransferencia').modal('show');
                });

            }

        }

        const updateVariableConfig = () => {
            let node = '<?= json_encode($node) ?>';
            $('#modalVariableConfiguracion').modal('hide');
            let variableConfig = $('#variableConfig').val();
            Swal.fire({
                title: 'Completando operación',
                text: 'Actualizando datos...',
                imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });

            let url = '<?= site_url("front/variable_config") ?>';
            $.post(url, {
                node: node,
                variable: variableConfig
            }, function(response) {
                Swal.close();
                response = JSON.parse(response);
                if (response.status == 200) {
                    variableConfig == 0 ? $('#labelConfig').text('Derecha') : $('#labelConfig').text('Izquierda');
                    Swal.fire({
                        icon: 'success',
                        title: 'Operación ejecutada',
                        text: 'Variable de configuración actualizada correctamente',
                        confirmButtonText: 'Continuar',
                        allowOutsideClick: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se encuentra un usuario con el email especificado',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {
                        $('#modalVariableConfiguracion').modal('show');
                    });
                }
            });
        }

        const completarTransferencia = () => {
            let emailDestino = $("#emailDestinatario").val().trim();
            let montoEnviar = $("#montoTransferir").val().trim();
            let userEmail = '<?= $this->session->userdata('email') ?>';
            var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (expr.test(emailDestino)) {
                if (userEmail !== emailDestino) {
                    if (!isNaN(montoEnviar)) {
                        let billeteraActual = parseFloat('<?= $wallet ? number_format($wallet->balance, 2) : 0 ?>');
                        if (billeteraActual >= parseFloat(montoEnviar)) {
                            $('#modalTransferencia').modal('hide');
                            Swal.fire({
                                title: 'Escribe tu contraseña',
                                input: 'password',
                                showCancelButton: true,
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.close();
                                    Swal.fire({
                                        title: 'Completando operación',
                                        text: 'Actualizando datos...',
                                        imageUrl: '<?= base_url("assets/cargando.gif") ?>',
                                        imageAlt: 'No realice acciones sobre la página',
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        footer: '<a href>No realice acciones sobre la página</a>',
                                    });
                                    let urlTransferencia = '<?= site_url('front/tranferir_saldo'); ?>'
                                    $.post(urlTransferencia, {
                                        email: emailDestino,
                                        monto: montoEnviar,
                                        password: result.value
                                    }, function(response) {
                                        response = JSON.parse(response);
                                        Swal.close();
                                        if (response.status == 200) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Operación ejecutada',
                                                text: 'Transferencia completada correctamente',
                                                confirmButtonText: 'Confirmado',
                                                allowOutsideClick: false
                                            }).then((result) => {
                                                window.location.reload();
                                            });
                                            //transferencia realizada correctamente
                                        } else if (response.status == 404) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'No se encuentra un usuario con el correo especificado',
                                                showConfirmButton: false,
                                                timer: 2500
                                            }).then((result) => {
                                                $('#modalTransferencia').modal('show');
                                            });
                                        } else if (response.status == 201) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'El saldo en la billetera no es suficiente',
                                                showConfirmButton: false,
                                                timer: 2500
                                            }).then((result) => {
                                                $('#modalTransferencia').modal('show');
                                            });
                                        } else if (response.status == 501) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'La contraseña del usuario no es correcta',
                                                showConfirmButton: false,
                                                timer: 2500
                                            }).then((result) => {
                                                $('#modalTransferencia').modal('show');
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Su sesión ha caducado o no tiene permiso para realizar esta tarea.',
                                                showConfirmButton: false,
                                                timer: 2500
                                            }).then((result) => {
                                                window.location.href = '<?= site_url('entrar'); ?>';
                                            });
                                        }
                                    });

                                } else {
                                    $('#modalTransferencia').modal('show');
                                }
                            })

                        } else {
                            $('#modalTransferencia').modal('hide');
                            Swal.fire({
                                icon: 'error',
                                title: 'No tiene saldo suficiente en la billetera para hacer la transferencia',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                $('#modalTransferencia').modal('show');
                            });
                        }

                    } else {
                        $('#modalTransferencia').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'El monto a enviar debe ser un valor numérico',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            $('#modalTransferencia').modal('show');
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se puede enviar dinero a tu misma cuenta',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {
                        $('#modalTransferencia').modal('show');
                    });
                }

            } else {
                $('#modalTransferencia').modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'El email no tiene un formato correcto',
                    showConfirmButton: false,
                    timer: 2500
                }).then((result) => {
                    $('#modalTransferencia').modal('show');
                });
            }
        }

        const copyToClipboard = (text) => {
            const elem = document.createElement('textarea');
            elem.value = text;
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');
            document.body.removeChild(elem);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Link copiado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        }

        const initDiagram = () => {

            $("#areaDatosGeneralesEquipo").empty();
            $("#areaDatosGeneralesEquipo").html(
                "<div id='cargandoDatosGeneralesEquipo' class='row'><div class='col-lg-12' style='text-align:center;'><a style='color:#fff;font-weight:bold;font-size:16px;'><i class='fa fa-spinner fa-spin'></i> Cargando datos generales del equipo</a></div></div>"
            );

            $("#basicDiagram").empty();
            $("#basicDiagram").html(
                "<div id='cargandoArbol' class='row'><div class='col-lg-12' style='text-align:center;'><a style='color:#fff;font-weight:bold;font-size:16px;'><i class='fa fa-spinner fa-spin'></i> Cargando árbol de afiliados</a></div></div>"
            );
            $("#basicDiagramRight").empty();
            $("#basicDiagramRight").html(
                "<div id='cargandoArbolRight' class='row'><div class='col-lg-12' style='text-align:center;'><a style='color:#fff;font-weight:bold;font-size:16px;'><i class='fa fa-spinner fa-spin'></i> Cargando árbol de afiliados</a></div></div>"
            );
            setTimeout(() => {
                $.post('<?= site_url("front/cargar_arbol_afiliados") ?>', {}, function(response) {
                    let responseJSON = JSON.parse(response);
                    responseJSON.lista_left.length > 0 || responseJSON.lista_right.length ? $('#bodyEstructura').show() : $('#bodyEstructura').hide();

                    $("#cargandoArbol").remove();
                    $("#cargandoArbolRight").remove();
                    $("#cargandoDatosGeneralesEquipo").remove();
                    let options = new primitives.OrgConfig();
                    options.hasSelectorCheckbox = primitives.Enabled.False;
                    options.hasButtons = primitives.Enabled.False;
                    options.templates = [getItemTemplate1()];
                    options.onItemRender = onTemplateRender;
                    options.defaultTemplateName = "itemTemplate1";
                    options.normalItemsInterval = 20;

                    let optionsRight = new primitives.OrgConfig();
                    optionsRight.hasSelectorCheckbox = primitives.Enabled.False;
                    optionsRight.hasButtons = primitives.Enabled.False;
                    optionsRight.templates = [getItemTemplateRight()];
                    optionsRight.onItemRender = onTemplateRender;
                    optionsRight.defaultTemplateName = "itemTemplateRight";
                    optionsRight.normalItemsInterval = 20;

                    $("#areaDatosGeneralesEquipo").append(
                        "<div style='margin-top:15px'><h5 style='text-align:center;margin-bottom:0px;'><label style='background-color: #65438e;color: white;padding: 10px 5px;width:280px;text-align:center;'>Miembros del equipo</label></h5><div style='text-align:center;font-size:18px;font-weight:bold;'><label style='margin-top:-10px;padding: 10px 5px;width:280px;text-align:center;border: 1px solid #65438e;color:#fff;font-weight:bold;'>" +
                        ((responseJSON.lista_left.length > 0 ? responseJSON.lista_left.length - 1 : 0) + (responseJSON.lista_right.length > 0 ? responseJSON.lista_right.length - 1 : 0)) + "</label></div></div>");

                    let items = [];
                    let itemsRight = [];
                    let activos = 0;
                    let inactivos = 0;
                    let contador = 1;
                    let urlImage = '<?= base_url('assets/user.png') ?>';

                    responseJSON.lista_left.forEach(function(item1) {
                        let color = "#ff5970";
                        if (item1.is_active == 1) {
                            color = '#45a766';
                            if (item1.user_id != '<?= $this->session->userdata('user_id') ?>') {
                                activos++;
                            }
                        } else {
                            if (item1.user_id != '<?= $this->session->userdata('user_id') ?>') {
                                inactivos++;
                            }
                        }
                        if (item1.parent != 0) {
                            idPadre = getIdPadre(item1.padre, items);
                            items.push(new primitives.OrgItemConfig({
                                id: contador,
                                parent: idPadre,
                                title: item1.name + ' ' + item1.surname,
                                phone: item1.phone,
                                email: item1.email,
                                usuario_id: item1.user_id,
                                itemTitleColor: color,
                                imagen: urlImage
                            }));
                        } else {
                            if (item1.is_active == '1') {
                                color = '#45a766';
                            }
                            items.push(new primitives.OrgItemConfig({
                                id: contador,
                                parent: null,
                                title: item1.name + ' ' + item1.surname,
                                phone: item1.phone,
                                email: item1.email,
                                usuario_id: '<?= $this->session->userdata("user_id") ?>',
                                itemTitleColor: color,
                                imagen: urlImage
                            }));
                        }
                        contador++;
                    });
                    responseJSON.lista_right.forEach(function(item1) {
                        let color = "#ff5970";
                        if (item1.is_active == 1) {
                            color = '#45a766';
                            if (item1.user_id != '<?= $this->session->userdata('user_id') ?>') {
                                activos++;
                            }
                        } else {
                            if (item1.user_id != '<?= $this->session->userdata('user_id') ?>') {
                                inactivos++;
                            }
                        }
                        if (item1.parent != 0) {
                            idPadre = getIdPadre(item1.padre, itemsRight);
                            itemsRight.push(new primitives.OrgItemConfig({
                                id: contador,
                                parent: idPadre,
                                title: item1.name + ' ' + item1.surname,
                                phone: item1.phone,
                                email: item1.email,
                                usuario_id: item1.user_id,
                                itemTitleColor: color,
                                imagen: urlImage
                            }));
                        } else {
                            if (item1.is_active == '1') {
                                color = '#45a766';
                            }
                            itemsRight.push(new primitives.OrgItemConfig({
                                id: contador,
                                parent: null,
                                title: item1.name + ' ' + item1.surname,
                                phone: item1.phone,
                                email: item1.email,
                                usuario_id: '<?= $this->session->userdata("user_id") ?>',
                                itemTitleColor: color,
                                imagen: urlImage
                            }));
                        }
                        contador++;
                    });
                    options.items = items;
                    options.cursorItem = 0;
                    control = primitives.OrgDiagram(document.getElementById("basicDiagram"), options);
                    optionsRight.items = itemsRight;
                    optionsRight.cursorItem = 0;
                    controlRight = primitives.OrgDiagram(document.getElementById("basicDiagramRight"), optionsRight);
                    let textoAux =
                        '<div class="row" style="margin-top:15px"><div class="col-lg-6 col-sm-6 col-xs-6 col-md-6"><div style="text-align:center;"><label style="background-color: #45a766;color: white;padding: 10px 5px;width:100%;text-align:center;">Activos</label></div><div style="text-align:center"><label style="margin-top:-10px;padding: 10px 5px;width:100%;text-align:center;border: 1px solid #45a766;color:#fff;font-weight:bold;">' +
                        activos +
                        '</label></div></div><div class="col-lg-6 col-sm-6 col-xs-6 col-md-6"><div style="text-align:center;"><label style="background-color: #ff5970;color: white;padding: 10px 5px;width:100%;text-align:center;">Inactivos</label></div><div style="text-align:center"><label style="margin-top:-10px;padding: 10px 5px;width:100%;text-align:center;border: 1px solid #ff5970;color:#fff;font-weight:bold;">' +
                        inactivos +
                        '</label></div></div>';
                    $("#areaDatosGeneralesEquipo").append(textoAux);
                });
            }, 3000);
        }

        const getIdPadre = (padreId, pItems) => {
            let idResult = -1;
            pItems.forEach(function(item) {
                if (item.usuario_id == padreId) {
                    idResult = item.id;
                    return;
                }
            });
            return idResult;
        }

        const getItemTemplate1 = () => {
            let result = new primitives.TemplateConfig();
            result.name = "itemTemplate1";

            result.itemTemplate = '<div style="border: 1px solid #CCC;border-radius:10px">' +
                '<div name="titleBackground" style="border-radius:10px 10px 0px 0px;">' +
                '<div style="color:#FFF;text-align:center;white-space: nowrap;width: 175px;overflow: hidden;text-overflow:ellipsis;" name="title">' +
                '</div>' +
                '</div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;" name="image"><a><img src="" style="width:48px;height:48px" /></a></div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;" name="phone"></div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;white-space: nowrap;width: 175px;overflow: hidden;text-overflow:ellipsis;" name="email"></div>' +
                '</div>';

            result.itemSize = new primitives.Size(180, 130);
            return result;
        }

        const getItemTemplateRight = () => {
            let result = new primitives.TemplateConfig();
            result.name = "itemTemplateRight";

            result.itemTemplate = '<div style="border: 1px solid #CCC;border-radius:10px">' +
                '<div name="titleBackground" style="border-radius:10px 10px 0px 0px;">' +
                '<div style="color:#FFF;text-align:center;white-space: nowrap;width: 175px;overflow: hidden;text-overflow:ellipsis;" name="title">' +
                '</div>' +
                '</div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;" name="image"><a><img src="" style="width:48px;height:48px" /></a></div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;" name="phone"></div>' +
                '<div style="text-align:center;color:#fff;font-weight:bold;white-space: nowrap;width: 175px;overflow: hidden;text-overflow:ellipsis;" name="email"></div>' +
                '</div>';

            result.itemSize = new primitives.Size(180, 130);
            return result;
        }

        const onTemplateRender = (event, data) => {

            switch (data.renderingMode) {
                case primitives.RenderingMode.Create:
                    break;
                case primitives.RenderingMode.Update:
                    /* Update template content here */
                    break;
            }

            let itemConfig = data.context;

            if (data.templateName == "itemTemplate1") {

                let titleBackground = data.element.firstChild;
                titleBackground.style.backgroundColor = itemConfig.itemTitleColor || primitives.Colors.RoyalBlue;

                let title = data.element.firstChild.firstChild;
                title.textContent = itemConfig.title;

                let img = data.element.childNodes[1];
                img.firstChild.firstChild.src = itemConfig.imagen;

                let phone = data.element.childNodes[2];
                phone.textContent = itemConfig.phone;

                let email = data.element.childNodes[3];
                email.textContent = itemConfig.email;

            }
            if (data.templateName == "itemTemplateRight") {

                let titleBackground = data.element.firstChild;
                titleBackground.style.backgroundColor = itemConfig.itemTitleColor || primitives.Colors.RoyalBlue;

                let title = data.element.firstChild.firstChild;
                title.textContent = itemConfig.title;

                let img = data.element.childNodes[1];
                img.firstChild.firstChild.src = itemConfig.imagen;

                let phone = data.element.childNodes[2];
                phone.textContent = itemConfig.phone;

                let email = data.element.childNodes[3];
                email.textContent = itemConfig.email;

            }
        }

        const cargar_modal_eliminar_anuncio = (params) => {
            Swal.fire({
                title: '¿Está seguro (a) de que desea eliminar el anuncio?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('front/delete_ads') ?>",
                        data: {
                            anuncio_id: params
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                Swal.fire(
                                    '¡Eliminado correctamente!',
                                    '',
                                    'success'
                                );
                                location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un problema vuelva a intentarlo.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        }

                    });
                }
            })
        }

        $('#update_password').click(function() {
            $('#modal_cambiar_password').modal('show');
        });

        $('.input-number').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('.input-text').on('input', function() {
            this.value = this.value.replace(/[^a-zA-ZáéíóúñüàèÑ ]/g, '');

        });

        $('#name').change(function() {
            let texto = $('#name').val();
            texto = texto.trim();
            texto = texto.split(" ");
            if (texto.length > 1) {
                texto = texto[0];
            } else {
                texto = texto[0];
            }
            $('#name').val(texto);
        });

        $('#surname').change(function() {
            let texto = $('#surname').val();
            texto = texto.trim();
            texto = texto.split(" ");
            if (texto.length >= 2) {
                texto = texto[0] + " " + texto[1];
            } else {
                texto = texto[0];
            }
            $('#surname').val(texto);
        });

        $(function() {
            $("#example").DataTable();

            let validando = <?= $this->session->userdata('validando') ?>;
            let subastas_directas_perfil = <?= json_encode($mis_subastas_directas); ?>;

            for (let i = 0; i < subastas_directas_perfil.length; i++) {

                let inter = setInterval(function() {
                    let fecha = subastas_directas_perfil[i].fecha_cierre;
                    let deadline = new Date(fecha).getTime();
                    let currentTime = new Date().getTime();
                    let t = deadline - currentTime;
                    let days = Math.floor(t / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((t % (1000 * 60)) / 1000);
                    $('#day_perfil_' + subastas_directas_perfil[i].subasta_id).html(days);
                    $('#hour_perfil_' + subastas_directas_perfil[i].subasta_id).html(hours);
                    $('#minute_perfil_' + subastas_directas_perfil[i].subasta_id).html(minutes);
                    $('#second_perfil_' + subastas_directas_perfil[i].subasta_id).html(seconds);

                    if (t < 0) {

                        clearInterval(inter);

                        $('#day_perfil_' + subastas_directas_perfil[i].subasta_id).html(0);
                        $('#hour_perfil_' + subastas_directas_perfil[i].subasta_id).html(0);
                        $('#minute_perfil_' + subastas_directas_perfil[i].subasta_id).html(0);
                        $('#second_perfil_' + subastas_directas_perfil[i].subasta_id).html(0);

                    }

                }, 1000);

            }
            if (validando == 1) {
                $("#listado_anuncio").hide();
                $("#panel_perfil").show();
                $('#listado_directas').hide();
                $('#listado_inversas').hide();
                $("#listado_payments").hide();
                $('#panel_beneficio').hide();
                $('#panel_wallet').hide();
            } else if (validando == 2) {
                $("#listado_anuncio").show();
                $('#listado_directas').hide();
                $('#listado_inversas').hide();
                $("#listado_payments").hide();
                $("#panel_perfil").hide();
                $("#perfil").removeClass('active');
                $("#ads").addClass('active');
                $('#panel_beneficio').hide();
                $('#panel_wallet').hide();
            } else {
                $('#listado_inversas').hide();
                $('#listado_directas').hide();
                $("#listado_anuncio").hide();
                $('#panel_beneficio').hide();
                $("#panel_perfil").show();
                $('#panel_wallet').hide();
            }

        });

        $("#perfil").click(function() {
            $("#listado_anuncio").hide();
            $('#listado_inversas').hide();
            $("#listado_payments").hide();
            $("#panel_perfil").show();
            $("#listado_directas").hide();
            $("#ads").removeClass('active');
            $("#subs").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").removeClass('active');
            $("#perfil").addClass('active');
            $('#panel_beneficio').hide();
            $('#panel_wallet').hide();
        });
        $("#ads").click(function() {

            $("#subs").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").removeClass('active');
            $("#ads").addClass('active');
            $('#listado_inversas').hide();
            $("#listado_directas").hide();
            $("#listado_payments").hide();
            $("#listado_anuncio").show();
            $("#panel_perfil").hide();
            $('#panel_beneficio').hide();
            $('#panel_wallet').hide();
        });
        $("#subs").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").removeClass('active');
            $("#subs").addClass('active');
            $('#listado_inversas').hide();
            $("#listado_payments").hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").show();
            $("#panel_perfil").hide();
            $('#panel_beneficio').hide();
            $('#panel_wallet').hide();
        });
        $("#subs_inversas").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").removeClass('active');
            $("#historial").removeClass('active');
            $("#subs_inversas").addClass('active');
            $('#listado_inversas').show();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#listado_payments").hide();
            $('#panel_beneficio').hide();
            $("#panel_perfil").hide();
            $('#panel_wallet').hide();
        });
        $("#historial").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").removeClass('active');
            $("#historial").addClass('active');
            $("#subs_inversas").removeClass('active');
            $('#listado_inversas').hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#panel_perfil").hide();
            $('#panel_beneficio').hide();
            $("#listado_payments").show();
            $('#panel_wallet').hide();
        });
        $("#beneficio").click(function() {
            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#beneficio").addClass('active');
            $("#wallet").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $('#listado_inversas').hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#panel_perfil").hide();
            $("#listado_payments").hide();
            $('#panel_beneficio').show();
            $('#panel_wallet').hide();
        });
        $("#wallet").click(function() {
            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#beneficio").removeClass('active');
            $("#wallet").addClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $('#listado_inversas').hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#panel_perfil").hide();
            $("#listado_payments").hide();
            $('#panel_beneficio').hide();
            $('#panel_wallet').show();
        });

        const change_pais = () => {

            let nuevo = $("select[name=pais]").val();

            $('#ciudad').empty();
            $.ajax({

                type: 'POST',
                url: "<?= site_url('front/get_ciudad') ?>",
                data: {

                    pais_id: nuevo
                },

                success: function(result) {
                    result = JSON.parse(result);

                    let cadena = "";
                    cadena = "<label><?= translate('listar_city_lang'); ?></label><div  class='input-group'><span class='input-group-addon'><i class='fa fa-globe></i></span><select id='ciudad' name='ciudad class='form-control select2'>";

                    for (let i = 0; i < result.length; i++) {

                        cadena = cadena + "<option value ='" + result[i].ciudad_id + "'>" + result[i].name_ciudad + "</option>";

                    }

                    cadena = cadena + "</select></div>"

                    $('#ciudad').html(cadena);



                }

            });

        }
    </script>