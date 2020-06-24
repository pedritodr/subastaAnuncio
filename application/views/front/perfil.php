<div id="carousel-example-generic" class="carousel slide banner2" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <?php if (count($all_banners) > 1) { ?>

            <?php for ($i = 1; $i < count($all_banners); $i++) { ?>

                <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"></li>
            <?php } ?>
        <?php } ?>


    </ol>
    <div class="carousel-inner">
        <?php if (count($all_banners) > 0) { ?>
            <div class="item active">
                <img style="width:100% !important" class="img-responsive" src="<?= base_url($all_banners[0]->foto) ?>" alt="First slide">
                <!--   <div class="carousel-caption">
               <h3>
                  First slide</h3>
               <p>
                  Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> -->
            </div>
        <?php } ?>
        <?php if (count($all_banners) > 1) { ?>
            <?php for ($j = 1; $j < count($all_banners); $j++) { ?>
                <div class="item">
                    <img style="width:100% !important" src="<?= base_url($all_banners[$j]->foto) ?>" alt="Second slide">
                    <!--  <div class="carousel-caption">
               <h3>
                  Second slide</h3>
               <p>
                  Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> -->
                </div>
            <?php } ?>
        <?php } ?>


    </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
        </span></a>
</div>
<!-- Small Breadcrumb -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding gray">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-4 col-sm-12 col-xs-12 leftbar-stick blog-sidebar">
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
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <?php if (get_message_from_operation()) { ?>
                        <div class="alert">

                            <?= get_message_from_operation(); ?>
                        </div>
                    <?php } ?>
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

                                                        <img class="img-responsive" src="<?= base_url($item->photo) ?>" alt="">
                                                    <?php } else { ?>
                                                        <img class="img-responsive" src="<?= $item->photo ?>" alt="">

                                                    <?php } ?>

                                                </a>
                                                <?php if ($item->destacado == 1) { ?>
                                                    <div class="ribbon popular"><?= translate("featured_lang") ?></div>
                                                <?php } ?>
                                            </div>
                                            <!--descripcion -->
                                            <div style="height:199px !important" class="short-description-1 ">
                                                <!-- subcategoria  -->
                                                <div class="category-title"><?= $item->subcate->nombre; ?> </div>

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
                                                            <a title="Actilet anuncio" onclick="cargar_modal_desactivar('<?= $item->anuncio_id ?>','2');"><i class="fa fa-check delete"></i></a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ($item->destacado == 0) { ?>
                                                        <li>
                                                            <a title="Destacar anuncio" onclick="cargar_modal_destacar('<?= base64_encode(json_encode($item)) ?>');"><i class="fa fa-star delete"></i></a>
                                                        </li>

                                                    <?php } ?>
                                                    <li>
                                                        <a title='Subir imagenes' onclick="cargar_modal_imagen('<?= $item->anuncio_id ?>');"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                                <!--fin primer anuncio-->

                            </div>

                            <!-- Ads Archive End -->

                            <!-- Pagination -->

                            <!-- Pagination End -->
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
                                                    <!--    <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">

                                                        <div class="img-box">
                                                            <img src="<?= base_url($item->photo) ?>" class="img-responsive" alt="">
                                                            <div class="total-images"><strong><?= $item->contador_fotos + 1 ?></strong> <?= translate("photos_lang"); ?> </div>

                                                        </div>

                                                    </div> -->
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
                                                                    <h6 class="text-center"><?= "Valor de entreda" ?></h6>
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
                                <li id="membresia_tab"><a href="#membresia" data-toggle="tab"><?= translate('menbresi_lang') ?></a></li>

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
                                <?php if ($all_membresia) { ?>
                                    <div class="profile-edit tab-pane fade" id="membresia">

                                        <br>
                                        <!--Checkout-Form-->
                                        <dl class="dl-horizontal">

                                            <dt><strong><?= translate('membresia_act_lang') ?>: </strong></dt>
                                            <dd>
                                                <?= $all_membresia->nombre ?>
                                            </dd>
                                            <dt><strong><?= translate('date_compra_lang') ?>: </strong></dt>
                                            <dd>
                                                <?= $all_membresia->fecha_inicio ?>
                                            </dd>
                                            <dt><strong><?= translate('fecha_vencimiento_lang') ?>: </strong></dt>
                                            <dd>
                                                <?= $all_membresia->fecha_fin ?>
                                            </dd>

                                        </dl>
                                        <strong><?= translate('cant_anuncios_lang') ?> </strong>
                                        <?= $all_membresia->cant_anuncio ?>
                                        <br>
                                        <strong><?= translate('descripcion_lang') ?> </strong>
                                        <?= $all_membresia->descripcion ?>

                                    </div>
                                <?php } else { ?>
                                    <div class="profile-edit tab-pane fade" id="membresia">

                                        <br>
                                        <!--Checkout-Form-->
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
                                        <!--End Checkout-Form-->

                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                    <!-- Row End -->
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
    <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
    <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
    <script type="text/javascript">
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
            } else if (validando == 2) {
                $("#listado_anuncio").show();
                $('#listado_directas').hide();
                $('#listado_inversas').hide();
                $("#listado_payments").hide();
                $("#panel_perfil").hide();
                $("#perfil").removeClass('active');
                $("#ads").addClass('active');
            } else {
                $('#listado_inversas').hide();
                $('#listado_directas').hide();
                $("#listado_anuncio").hide();
                $("#panel_perfil").show();
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
            $("#perfil").addClass('active');

        });
        $("#ads").click(function() {

            $("#subs").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $("#ads").addClass('active');
            $('#listado_inversas').hide();
            $("#listado_directas").hide();
            $("#listado_payments").hide();
            $("#listado_anuncio").show();
            $("#panel_perfil").hide();
        });
        $("#subs").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs_inversas").removeClass('active');
            $("#historial").removeClass('active');
            $("#subs").addClass('active');
            $('#listado_inversas').hide();
            $("#listado_payments").hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").show();
            $("#panel_perfil").hide();
        });
        $("#subs_inversas").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#historial").removeClass('active');
            $("#subs_inversas").addClass('active');
            $('#listado_inversas').show();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#listado_payments").hide();
            $("#panel_perfil").hide();
        });
        $("#historial").click(function() {

            $("#ads").removeClass('active');
            $("#perfil").removeClass('active');
            $("#subs").removeClass('active');
            $("#historial").addClass('active');
            $("#subs_inversas").removeClass('active');
            $('#listado_inversas').hide();
            $("#listado_anuncio").hide();
            $("#listado_directas").hide();
            $("#panel_perfil").hide();
            $("#listado_payments").show();
        });

        function change_pais() {

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
    <style>
        h6 a:hover {
            color: #8c1822 !important;
        }

        h6 a {
            color: #000 !important;
        }

        /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 58px;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            z-index: 1;
        }

        /* Declare heights because of positioning of img element */
        .carousel .item {
            height: 500px;
            background-color: #555;
        }

        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 500px;
        }

        .banner2 {
            padding-top: 107px !important
        }

        @media screen and (max-width: 992px) {
            /*      .banner2 {
            margin-top: 0
         } */

            .carousel .item {
                height: 300px;
                background-color: #555;
            }

            .carousel img {
                position: absolute;
                top: 0;
                left: 0;
                min-height: 300px;
            }
        }

        @media screen and (max-width: 400px) {
            /*   .banner2 {
   margin-top: 29% !important
} */

            .carousel .item {
                height: 300px;
                background-color: #555;
            }

            .carousel img {
                position: absolute;
                top: 0;
                left: 0;
                min-height: 300px;
            }
        }
    </style>