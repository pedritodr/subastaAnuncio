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
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding error-page pattern-bg ">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <ul class="accordion">
                        <li class="">
                            <h3 class="accordion-title"><a href="#">Pagos electrónicos?</a></h3>
                            <div class="accordion-content">
                                <h5>1. ¿Qué es PlacetoPay?</h5>
                                <p>
                                    PlacetoPay es la plataforma de pagos electrónicos que usa Subastanuncios.com para procesar en línea las transacciones generadas en la tienda virtual con las formas de pago habilitadas para tal fin.
                                </p>
                                <h5>2. ¿Cómo puedo pagar?</h5>
                                <p>
                                    En la tienda virtual de Subastanuncios.com usted podrá realizar su pago con los medios habilitados para tal fin. Usted, de acuerdo a las opciones de pago escogidas por el comercio, podrá pagar a través (Diners, Discover, Visa y MasterCard); de todos los bancos con pago corriente y en los diferido, únicamente las tarjetas emitidas por Banco Pichincha, Diners, Loja, BGR y Manabí.
                                </p>
                                <h5>3. ¿Es seguro ingresar mis datos bancarios en este sitio web?</h5>
                                <p>
                                    Para proteger tus datos Subastanuncios.com delega en PlacetoPay la captura de la información sensible. Nuestra plataforma de pagos cumple con los más altos estándares exigidos por la norma internacional PCI DSS de seguridad en transacciones con tarjeta de crédito. Además tiene certificado de seguridad SSL expedido por GeoTrust una compañía Verisign, el cual garantiza comunicaciones seguras mediante la encriptación de todos los datos hacia y desde el sitio; de esta manera, te podrás sentir seguro a la hora de ingresar la información de su tarjeta.
                                </p>
                                <p>
                                    Durante el proceso de pago, en el navegador se muestra el nombre de la organización autenticada, la autoridad que lo certifica y la barra de dirección cambia a color verde. Estas características son visibles de inmediato y dan garantía y confianza para completar la transacción en PlacetoPay.
                                </p>
                                <p> PlacetoPay también cuenta con el monitoreo constante de McAfee Secure y la firma de mensajes electrónicos con Certicámara.</p>
                                <p> PlacetoPay es una marca de la empresa colombiana EGM Ingeniería Sin Fronteras S.A.S.</p>
                                <h5>4. PlacetoPay es una marca de la empresa colombiana EGM Ingeniería Sin Fronteras S.A.S.</h5>
                                <p>Sí, en Subastanuncios.com podrás realizar tus compras en línea los 7 días de la semana, las 24 horas del día a sólo un clic de distancia. </p>
                                <h5>5. ¿Puedo cambiar la forma de pago?</h5>
                                <p>Si aún no has finalizado tu pago, podrás volver al paso inicial y elegir la forma de pago que prefieras. Una vez finalizada la compra no es posible cambiar la forma de pago.</p>
                                <h5>6. ¿Pagar electrónicamente tiene algún valor para mí como comprador? </h5>
                                <p>No, los pagos electrónicos realizados a través de PlacetoPay no generan costos adicionales para el comprador. </p>
                                <h5>7. ¿Qué debo hacer si mi transacción no concluyó?</h5>
                                <p>En primera instancia deberás revisar si llegó un mail de confirmación del pago en tu cuenta de correo electrónico (la inscrita en el momento de realizar el pago), en caso de no haberlo recibido, deberás contactar a <a href="pedro@datalabcenter.com">pedro@datalabcenter.com</a> para confirmar el estado de la transacción.</p>
                                <p>En caso que tu transacción haya declinado, debes verificar si la información de la cuenta es válida, está habilitada para compras no presenciales y si tienes cupo o saldo disponible. Si después de esto continua con la declinación debes comunicarte con <a href="pedro@datalabcenter.com">pedro@datalabcenter.com</a>. En última instancia, puedes remitir tu solicitud a <a href="servicioposventa@placetopay.ec">servicioposventa@placetopay.ec</a>. </p>
                                <h5>8. ¿Qué debo hacer si no recibí el comprobante de pago?</h5>
                                <p>Por cada transacción aprobada a través de PlacetoPay, recibirás un comprobante del pago con la referencia de compra en la dirección de correo electrónico que indicaste al momento de pagar. Si no lo recibes, podrás contactar a la línea +593980562425 o al correo electrónico <a href="pedro@datalabcenter.com">pedro@datalabcenter.com</a>, para solicitar el reenvío del comprobante a la misma dirección de correo electrónico registrada al momento de pagar. En última instancia, puedes remitir tu solicitud a <a href="servicioposventa@placetopay.ec">servicioposventa@placetopay.ec</a> . </p>
                                <h5>9. No me llegó el producto que compré ¿qué hago?</h5>
                                <p>Debes verificar si la transacción fue exitosa en tu extracto bancario. En caso de ser así, debes revisar nuestras políticas de envío en el sitio web <a href="https://subastanuncios.com/">https://subastanuncios.com/</a> para identificar los tiempos de entrega.</p>
                            </div>
                        </li>
                        <!--   <li class="">
                            <h3 class="accordion-title"><a href="#">Do memberships include the original PSD files?</a></h3>
                            <div class="accordion-content">
                                <p>Nullam ultricies, tellus id accumsan dictum, erat quam auctor tortor, vitae ullamcorper sapien dui sit amet arcu. Aenean eu sem finibus, iaculis nisi vel, facilisis nunc.</p>
                            </div>
                        </li> -->


                    </ul>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <!-- Sidebar Widgets -->
                    <div class="blog-sidebar">
                        <!-- Categories -->
                        <div class="widget">
                            <div class="widget-heading">
                                <h4 class="panel-title"><a>Consejos de seguridad </a></h4>
                            </div>

                            <div class="widget-content">
                                <!--   <p class="lead">Posting an ad on <a href="#">AdForest.com</a> is free! However, all ads must follow our rules:</p> -->
                                <ol>
                                    <li>Asegúrate de publicar en la categoría correcta.</li>
                                    <li>No ponga su correo electrónico o números de teléfono en el título o la descripción.</li>
                                    <li>No suba fotos con marcas de agua.</li>
                                </ol>
                            </div>
                        </div>
                        <!-- Latest News -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
                <!-- Middle Content Area  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->

    <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>
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