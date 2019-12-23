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
<div class="main-content-area clearfix">
    <section class="custom-padding">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Heading Area -->
                <div class="heading-panel">
                    <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                        <!-- Main Title -->
                        <h1><?= translate('menbresi_descrip_lang') ?> <span class="heading-color"><?= translate('name_plan_lang') ?></span></h1>
                        <!-- Short Description -->
                        <p class="heading-text"></p>
                    </div>
                </div>
                <!-- Middle Content Box -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row pricing">
                        <?php foreach ($all_membresia as $item) { ?>
                            <div class="col-sm-6 col-lg-4 col-md-4">
                                <div class="block">

                                    <h3><?= $item->nombre ?></h3>

                                    <span class="price">$<?= number_format($item->precio, 2); ?></span>
                                    <span class="time"><?= translate('cant_anuncios_lang') ?> <?= $item->cant_anuncio; ?></span>

                                    <?php if ($this->session->userdata('user_id')) { ?>
                                        <a style="cursor:pointer" onclick="seleccionar_membresia('<?= $item->membresia_id; ?>','<?= $item->precio; ?>');" class="btn btn-theme"><?= translate('select_plan_lang') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>

            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
</div>
<!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->
<div class="custom-modal">
    <div id="modal_membresia" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header rte">
                    <h2 class="modal-title text-center"><?= translate('menbresi_lang'); ?></h2>
                </div>
                <?= form_open("front/pagar_membresia") ?>

                <div class="modal-body">
                    <div class="block">
                        <h3 class="text-center" id="nombre"></h3>
                        <h4 class="text-center" id="precio"></h4>
                        <input name="membresia" id="membresia" type="hidden" value="">
                        <h4 class="text-center"><span id="cantidad" class="time"></span></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default"><?= translate('pagar_lang'); ?></button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?= translate('cancelar_lang'); ?></button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-= Share Modal =-=-=-=-=-=-= -->
<style>
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