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
                    <div class="user-profile">
                        <div class="text-center">
                            <?php if ($this->session->userdata('photo') == "") { ?>
                                <img style="width:50%" src="<?= base_url('assets/camera-png-transparent-background-8-original.png') ?>" alt="">
                            <?php } else { ?>
                                <?php if (strpos($this->session->userdata('photo'), 'uploads') !== false) { ?>
                                    <img style="width:50%" src="<?= base_url($this->session->userdata('photo')) ?>" alt="">
                                <?php } else { ?>
                                    <img style="width:50%" src="<?= $this->session->userdata('photo') ?>" alt="">
                                <?php } ?>
                            <?php } ?>
                        </div>


                        <div class="profile-detail">
                            <h6 class="text-center"><?= $this->session->userdata('name'); ?></h6>

                            <ul class="contact-details">
                                <li>
                                    <i class="fa fa-map-marker"></i> <?php if ($city) { ?>
                                        <?= $city->name_ciudad ?>
                                    <?php } ?>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> <?= $this->session->userdata('email'); ?>
                                </li>

                                <li>
                                    <i class="fa fa-phone"></i> <?= $this->session->userdata('phone'); ?>
                                </li>
                            </ul>
                        </div>
                        <ul>
                            <li class="active" id="perfil" style="cursor:pointer"><a><?= translate('perfil_lang') ?></a></li>
                            <li class="" id="ads" style="cursor:pointer"><a><?= translate('mis_anuncios_lang') ?><span class="badge"><?php if ($contador_anuncios) { ?> <?= ($contador_anuncios) ?><?php } else { ?>0 <?php } ?></span></a></li>
                            <li class="" id="subs" style="cursor:pointer"><a><?= translate('mis_subastas_lang') ?><span class="badge"><?php if ($contador_anuncios) { ?> <?= ($contador_anuncios) ?><?php } else { ?>0 <?php } ?></span></a></li>

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

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12  ">
                                        <div class="white category-grid-box-1 ">
                                            <!-- foto -->
                                            <div class="image"> <a title="" href="<?= site_url('front/detalle_anuncio/' . $item->anuncio_id) ?>">

                                                    <?php if (strpos($item->photo, 'uploads') !== false) { ?>

                                                        <img class="img-responsive" src="<?= base_url($item->photo) ?>" alt="">
                                                    <?php } else { ?>
                                                        <img class="img-responsive" src="<?= $item->photo ?>" alt="">

                                                    <?php } ?>

                                                </a></div>
                                            <!--descripcion -->
                                            <div class="short-description-1 ">
                                                <!-- subcategoria  -->
                                                <div class="category-title"><?= $item->subcate->nombre; ?> </div>

                                                <!-- descripcion -->
                                                <h6>
                                                    <a title="" href="<?= site_url('front/detalle_anuncio/' . $item->anuncio_id) ?>"><?= $item->titulo; ?></a>
                                                </h6>
                                                <!-- Location -->
                                                <p class="location"><i class="fa fa-map-marker"></i> <?= $item->ciudad->name_ciudad; ?></p>
                                                <!-- Rating -->
                                                <div class="rating">


                                                </div>
                                                <!-- Price --><span class="ad-price">$<?= number_format($item->precio, 2); ?></span>
                                            </div>
                                            <!-- Ad Meta Stats -->
                                            <div class="ad-info-1">
                                                <ul class="pull-left">
                                                    <?php if ($item->is_active == 1) { ?>
                                                        <span class="badge"> Publicado</span>
                                                    <?php } else { ?>
                                                        <span class="badge"> Desactivado</span>
                                                    <?php } ?>
                                                </ul>
                                                <ul class="pull-right">
                                                    <li> <a href=" <?= site_url('front/update_anuncio_index/' . $item->anuncio_id) ?>"><i class="fa fa-pencil edit"></i></a> </li>
                                                    <?php if ($item->is_active == 1) { ?>
                                                        <li> <a title="desactivar" onclick="cargar_modal_desactivar('<?= $item->anuncio_id ?>','1');"><i class="fa fa-times delete"></i></a></li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a title="Activar" onclick="cargar_modal_desactivar('<?= $item->anuncio_id ?>','2');"><i class="fa fa-check delete"></i></a>
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
                                            <?= $this->session->userdata('name'); ?>
                                        </dd>
                                        <dt><strong> <?= translate('email_lang') ?> </strong></dt>
                                        <dd>
                                            <?= $this->session->userdata('email'); ?>
                                        </dd>
                                        <dt><strong> <?= translate('phone_user__lang') ?> </strong></dt>
                                        <dd>
                                            <?= $this->session->userdata('phone'); ?>
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
                                            <?= $this->session->userdata('direccion'); ?>
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

                                            <input type="text" value="<?= $this->session->userdata('name'); ?>" name="name" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label> <?= translate('email_lang') ?> <span class="color-red">*</span></label>
                                            <input disabled type="text" value="<?= $this->session->userdata('email'); ?>" class="form-control margin-bottom-20">
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label> <?= translate('phone_user__lang') ?> <span class="color-red">*</span></label>
                                            <input type="text" value="<?= $this->session->userdata('phone'); ?>" name="phone" class="form-control margin-bottom-20">
                                        </div>


                                        <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20">
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

                                        </div>


                                        <div class="col-md-6 col-sm-12 col-xs-12 margin-bottom-20">
                                            <label> <?= translate('name_city_lang') ?> <span class="color-red">*</span></label>
                                            <select id="ciudad" name="ciudad" class="form-control select2">

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
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label> <?= translate('direccion_lang') ?> <span class="color-red">*</span></label>
                                            <textarea name="direccion" class="form-control margin-bottom-20" rows="2"><?= $this->session->userdata('direccion'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label> <?= translate('photo_lang') ?> (400x400)</label>
                                                <input type="file" class="form-control" name="archivo" placeholder="<?= translate('photo_lang'); ?>">
                                            </div>

                                        </div>
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

                                            <dt><strong><?= translate('membresia_act_lang') ?></strong></dt>
                                            <dd>
                                                <?= $all_membresia->nombre ?>
                                            </dd>
                                            <dt><strong><?= translate('date_compra_lang') ?> </strong></dt>
                                            <dd>
                                                <?= $all_membresia->fecha ?>
                                            </dd>
                                            <dt><strong><?= translate('cant_anuncios_lang') ?> </strong></dt>
                                            <dd>
                                                <?= $all_membresia->cant_anuncio ?>
                                            </dd>
                                        </dl>


                                        <!--End Checkout-Form-->

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
    <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
    <script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
    <script type="text/javascript">
        var validando = <?= $this->session->userdata('validando') ?>

        $(function() {

            if (validando == 1) {
                $("#listado_anuncio").hide();
                $("#panel_perfil").show();
            } else if (validando == 2) {
                $("#listado_anuncio").show();
                $("#panel_perfil").hide();
                $("#perfil").removeClass('active');
                $("#ads").addClass('active');
            } else {
                $("#listado_anuncio").hide();
                $("#panel_perfil").show();
            }

        });

        $("#perfil").click(function() {
            $("#listado_anuncio").hide();
            $("#panel_perfil").show();
            $("#perfil").addClass('active');
            $("#ads").removeClass('active');
        });
        $("#ads").click(function() {
            $("#perfil").removeClass('active');
            $("#ads").addClass('active');

            $("#listado_anuncio").show();
            $("#panel_perfil").hide();
        });


        function change_pais() {

            var nuevo = $("select[name=pais]").val();

            $('#ciudad').empty();
            $.ajax({

                type: 'POST',
                url: "<?= site_url('front/get_ciudad') ?>",
                data: {

                    pais_id: nuevo
                },

                success: function(result) {
                    result = JSON.parse(result);

                    var cadena = "";
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