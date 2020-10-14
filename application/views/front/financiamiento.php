<?php if (count($all_banners) > 0) { ?>
    <div class="master-slider ms-skin-default banner2" id="masterslider">
        <?php foreach ($all_banners as $item) { ?>
            <!--    <div class="ms-slide slide-1 imagen-banner" data-delay="5">
                  <img style="margin-top: 0px;" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="" alt="<?= $item->foto ?>" />
               </div> -->

            <div class="ms-slide">

                <!-- slide background -->
                <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" />

            </div>
        <?php } ?>
    </div>
<?php } ?>
<!-- end Master Slider -->
<!-- end Master Slider -->
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
                        <h1><span class="heading-color">TIPO DE FINANCIAMIENTO</span></h1>
                        <!-- Short Description -->
                        <p class="heading-text"></p>
                    </div>
                </div>
                <!-- Middle Content Box -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">AUTOMOTRIZ</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">CONSUMO</a></li>
                                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">INMOBILIARIO</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <?= form_open('front/solicitar_financiamiento'); ?>
                                        <?= get_message_from_operation(); ?>
                                        <input name="tipo" id="" class="btn btn-primary" type="hidden" value="1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> <label for="selectAuto">Auto</label>
                                                    <select class="form-control" id="selectAuto" name="tipo_auto" required>
                                                        <option value="1">Nuevo</option>
                                                        <option value="2">Usado</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="monto">Monto</label>
                                                    <input type="number" class="form-control" id="monto" name="monto" placeholder="Ejm:1000" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="entrada">Entrada</label>
                                                    <input type="number" class="form-control" id="entrada" name="entrada" placeholder="Ejm:1000" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cedula">Cédula</label>
                                                    <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ejm:000000000" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombres</label>
                                                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombres" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="apellido">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellidos" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono movil</label>
                                                    <input type="tel" class="form-control" id="telefono" placeholder="" name="telefono" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Correo Personal</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ejm:name@example.com" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="estado_civil">Estado civil</label>
                                                    <select class="form-control" id="estado_civil" name="estado_civil" required>
                                                        <option value="1">SOLTERO</option>
                                                        <option value="2">CASADO SIN SEPARACION DE BIENES</option>
                                                        <option value="3">CASADO CON SEPARACION DE BIENES</option>
                                                        <option value="4">DIVORCIADO </option>
                                                        <option value="5">VIUDO </option>
                                                        <option value="6">UNION LIBRE </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="datosConyuge">Datos cónyuge</label>
                                                    <textarea class="form-control" id="datosConyuge" name="datos_conyuge" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="datos">Datos laborales</label>
                                                    <select class="form-control" id="datos" name="datos_laborales" required>
                                                        <option value="1">EMPLEADO PÚBLICO</option>
                                                        <option value="2">EMPLEADO PRIVADO</option>
                                                        <option value="3">NEGOCIO PROPIO -RUC -RISE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="fechaNacimiento">Fecha de nacimiento</label>
                                                    <input style="padding:9px" type="date" class="form-control" id="fechaNacimiento" name="fecha_nacimiento" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ingreso">Ingreso mensuales</label>
                                                    <input type="number" class="form-control" id="ingreso" placeholder="Ejm:1000" name="ingreso" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gasto">Gasto mensuales</label>
                                                    <input type="number" class="form-control" id="gasto" placeholder="Ejm:1000" name="gasto" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="vivienda">Tipo de vivienda</label>
                                                    <select class="form-control" id="vivienda" name="tipo_vivienda" required>
                                                        <option value="1">PROPIA</option>
                                                        <option value="2">RENTADA</option>
                                                        <option value="3">FAMILIAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p style="text-align:center"><b>Autorización para revisión de Buro de Crédito</b></p>
                                            <p style="text-align:justify;padding:6px">
                                                Al llenar la solicitud de financiamiento constante del presente formulario libre y voluntariamente, con
                                                pleno conocimiento de causa y aceptando las consecuencias de ello, el (los) referido (s) como EL
                                                CLIENTE, expresa e irrevocablemente y declara(n) que conoce que las las IINSTITUCIONES FINANCIERAS
                                                o compañías de generación de cartera, confirmarán, recabarán y obtendrán, según lo consideren
                                                necesario, información sobre EL CLIENTE de fuentes lícitas tales como agencias informales de
                                                consumidores y de referencias de crédito, burós de información crediticia, empleadores, compañías y
                                                corredores de seguros y otras agencias o personas naturales o jurídicas, públicas o privadas, con el fin de
                                                verificar su capacidad de pago, comportamiento y crédito comercial, hábitos de pago de obligaciones,
                                                manejo de cuentas bancarias, cumplimiento de obligaciones financieras, crediticias o comerciales,
                                                historial de empleos y demás información que permita a las INSTITUCIONES FINANCIERAS o compañías
                                                de generación de cartera procesar debidamente el presente Formulario, y por lo tanto autoriza las
                                                INSTITUCIONES FINANCIERAS o compañías de generación de cartera para así proceder.
                                                De igual manera expreso que certifico que toda la información proporcionada es correcta y veraz,
                                                entendiendo el perjurio que pueda la falsedad de la misma.
                                            </p>
                                            <p onclick="terminosCondiciones()" style="text-align:center;cursor:pointer"><b>Términos y condiciones</b></p>
                                            <div style="text-align:center" class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="acepto" required>
                                                <label class="form-check-label" for="acepto">
                                                    Acepcto
                                                </label>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-theme btn-lg btn-block">Solicitar crédito</button>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <?= form_open('front/solicitar_financiamiento'); ?>
                                        <input name="tipo" id="" class="btn btn-primary" type="hidden" value="2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="destinoCredito">Destino crédito</label>
                                                <textarea class="form-control" id="destinoCredito" rows="3" name="destino_credito" required></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="monto">Monto</label>
                                                    <input type="number" class="form-control" id="monto" placeholder="Ejm:1000" name="monto" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cedula">Cédula</label>
                                                    <input type="number" class="form-control" id="cedula" placeholder="Ejm:000000000" name="cedula" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombres</label>
                                                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombres" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="apellido">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellidos" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono movil</label>
                                                    <input type="tel" class="form-control" id="telefono" placeholder="" name="telefono" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Correo Personal</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Ejm:name@example.com" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="estado">Estado civil</label>
                                                    <select class="form-control" id="estado" name="estado_civil" required>
                                                        <option value="1">SOLTERO</option>
                                                        <option value="2">CASADO SIN SEPARACION DE BIENES</option>
                                                        <option value="3">CASADO CON SEPARACION DE BIENES</option>
                                                        <option value="4">DIVORCIADO </option>
                                                        <option value="5">VIUDO </option>
                                                        <option value="6">UNION LIBRE </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="datosConyuge">Datos cónyuge</label>
                                                    <textarea class="form-control" id="datosConyuge" rows="3" name="datos_conyuge"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="datos">Datos laborales</label>
                                                    <select class="form-control" id="datos" name="datos_laborales" required>
                                                        <option value="1">EMPLEADO PÚBLICO</option>
                                                        <option value="2">EMPLEADO PRIVADO</option>
                                                        <option value="3">NEGOCIO PROPIO -RUC -RISE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="fechaNacimiento">Fecha de nacimiento</label>
                                                    <input style="padding:9px" type="date" class="form-control" id="fechaNacimiento" name="fecha_nacimiento" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ingreso">Ingreso mensuales</label>
                                                    <input type="number" class="form-control" id="ingreso" placeholder="Ejm:1000" name="ingreso" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gasto">Gasto mensuales</label>
                                                    <input type="number" class="form-control" id="gasto" placeholder="Ejm:1000" name="gasto" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="vivienda">Tipo de vivienda</label>
                                                    <select class="form-control" id="vivienda" name="tipo_vivienda" required>
                                                        <option value="1">PROPIA</option>
                                                        <option value="2">RENTADA</option>
                                                        <option value="3">FAMILIAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p style="text-align:center"><b>Autorización para revisión de Buro de Crédito</b></p>
                                            <p style="text-align:justify;padding:6px">
                                                Al llenar la solicitud de financiamiento constante del presente formulario libre y voluntariamente, con
                                                pleno conocimiento de causa y aceptando las consecuencias de ello, el (los) referido (s) como EL
                                                CLIENTE, expresa e irrevocablemente y declara(n) que conoce que las las IINSTITUCIONES FINANCIERAS
                                                o compañías de generación de cartera, confirmarán, recabarán y obtendrán, según lo consideren
                                                necesario, información sobre EL CLIENTE de fuentes lícitas tales como agencias informales de
                                                consumidores y de referencias de crédito, burós de información crediticia, empleadores, compañías y
                                                corredores de seguros y otras agencias o personas naturales o jurídicas, públicas o privadas, con el fin de
                                                verificar su capacidad de pago, comportamiento y crédito comercial, hábitos de pago de obligaciones,
                                                manejo de cuentas bancarias, cumplimiento de obligaciones financieras, crediticias o comerciales,
                                                historial de empleos y demás información que permita a las INSTITUCIONES FINANCIERAS o compañías
                                                de generación de cartera procesar debidamente el presente Formulario, y por lo tanto autoriza las
                                                INSTITUCIONES FINANCIERAS o compañías de generación de cartera para así proceder.
                                                De igual manera expreso que certifico que toda la información proporcionada es correcta y veraz,
                                                entendiendo el perjurio que pueda la falsedad de la misma.
                                            </p>
                                            <p onclick="terminosCondiciones()" style="text-align:center;cursor:pointer"><b>Términos y condiciones</b></p>
                                            <div style="text-align:center" class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="acepto" required>
                                                <label class="form-check-label" for="acepto">
                                                    Acepcto
                                                </label>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-theme btn-lg btn-block">Solicitar crédito</button>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="messages">
                                        <?= form_open('front/solicitar_financiamiento'); ?>
                                        <input name="tipo" id="" class="btn btn-primary" type="hidden" value="3">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> <label for="selectInmobiliario">Inmobiliario</label>
                                                    <select class="form-control" id="selectInmobiliario" name="tipo_inmobiliario" required>
                                                        <option value="1">Nueva</option>
                                                        <option value="2">Usada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="monto">Monto</label>
                                                    <input type="number" class="form-control" id="monto" placeholder="Ejm:1000" name="monto" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="entrada">Entrada</label>
                                                    <input type="number" class="form-control" id="entrada" placeholder="Ejm:1000" name="entrada" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cedula">Cédula</label>
                                                    <input type="number" class="form-control" id="cedula" placeholder="Ejm:000000000" name="cedula" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombres</label>
                                                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombres" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="apellido">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellidos" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono movil</label>
                                                    <input type="tel" class="form-control" id="telefono" placeholder="" name="telefono" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Correo Personal</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Ejm:name@example.com" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="estado">Estado civil</label>
                                                    <select class="form-control" id="estado" name="estado_civil" required>
                                                        <option value="1">SOLTERO</option>
                                                        <option value="2">CASADO SIN SEPARACION DE BIENES</option>
                                                        <option value="3">CASADO CON SEPARACION DE BIENES</option>
                                                        <option value="4">DIVORCIADO </option>
                                                        <option value="5">VIUDO </option>
                                                        <option value="6">UNION LIBRE </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="datosConyuge">Datos cónyuge</label>
                                                    <textarea class="form-control" id="datosConyuge" name="datos_conyuge" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="datos">Datos laborales</label>
                                                    <select class="form-control" id="datos" name="datos_laborales" required>
                                                        <option value="1">EMPLEADO PÚBLICO</option>
                                                        <option value="2">EMPLEADO PRIVADO</option>
                                                        <option value="3">NEGOCIO PROPIO -RUC -RISE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="fechaNacimiento">Fecha de nacimiento</label>
                                                    <input style="padding:9px" type="date" class="form-control" id="fechaNacimiento" name="fecha_nacimiento" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ingreso">Ingreso mensuales</label>
                                                    <input type="number" class="form-control" id="ingreso" placeholder="Ejm:1000" name="ingreso" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gasto">Gasto mensuales</label>
                                                    <input type="number" class="form-control" id="gasto" placeholder="Ejm:1000" name="gasto" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <label for="vivienda">Tipo de vivienda</label>
                                                    <select class="form-control" id="vivienda" name="tipo_vivienda" required>
                                                        <option value="1">PROPIA</option>
                                                        <option value="2">RENTADA</option>
                                                        <option value="3">FAMILIAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p style="text-align:center"><b>Autorización para revisión de Buro de Crédito</b></p>
                                            <p style="text-align:justify;padding:6px">
                                                Al llenar la solicitud de financiamiento constante del presente formulario libre y voluntariamente, con
                                                pleno conocimiento de causa y aceptando las consecuencias de ello, el (los) referido (s) como EL
                                                CLIENTE, expresa e irrevocablemente y declara(n) que conoce que las las IINSTITUCIONES FINANCIERAS
                                                o compañías de generación de cartera, confirmarán, recabarán y obtendrán, según lo consideren
                                                necesario, información sobre EL CLIENTE de fuentes lícitas tales como agencias informales de
                                                consumidores y de referencias de crédito, burós de información crediticia, empleadores, compañías y
                                                corredores de seguros y otras agencias o personas naturales o jurídicas, públicas o privadas, con el fin de
                                                verificar su capacidad de pago, comportamiento y crédito comercial, hábitos de pago de obligaciones,
                                                manejo de cuentas bancarias, cumplimiento de obligaciones financieras, crediticias o comerciales,
                                                historial de empleos y demás información que permita a las INSTITUCIONES FINANCIERAS o compañías
                                                de generación de cartera procesar debidamente el presente Formulario, y por lo tanto autoriza las
                                                INSTITUCIONES FINANCIERAS o compañías de generación de cartera para así proceder.
                                                De igual manera expreso que certifico que toda la información proporcionada es correcta y veraz,
                                                entendiendo el perjurio que pueda la falsedad de la misma.
                                            </p>
                                            <p onclick="terminosCondiciones()" style="text-align:center;cursor:pointer"><b>Términos y condiciones</b></p>
                                            <div style="text-align:center" class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="acepto" required>
                                                <label class="form-check-label" for="acepto">
                                                    Acepcto
                                                </label>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-theme btn-lg btn-block">Solicitar crédito</button>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
</div>
<div class="modal fade price-quote" id="modalTerminosCondiciones" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title text-center" id="lineModalLabel">Términos y condiciones</h3>
            </div>
            <div class="modal-body">
                <p style="text-align:left"><b>Política de Privacidad
                    </b></p>
                <p style="text-align:justify">El presente Política de Privacidad establece los términos en que subastanuncios usa y
                    protege la información que es proporcionada por sus usuarios al momento de utilizar su
                    sitio web www.subastanuncios.com Esta está comprometida con la seguridad de los
                    datos de sus usuarios. Cuando le pedimos llenar los campos de información personal
                    con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará
                    de acuerdo con los términos de este documento. Sin embargo, esta Política de
                    Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos
                    y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo
                    con dichos cambios.</p>
                <p style="text-align:left"><b>Información que es recogida</b></p>
                <p style="text-align:justify">Nuestro sitio web podrá recoger información personal, por ejemplo:
                    Nombre, información de contacto como su dirección de correo electrónica e información
                    demográfica. Así mismo cuando sea necesario podrá ser requerida información
                    específica para procesar algún pedido o realizar una entrega o facturación.</p>
                <p style="text-align:left"><b>Uso de la información recogida</b></p>
                <p style="text-align:justify">Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio
                    posible, particularmente para mantener un registro de usuarios, de pedidos en caso
                    que aplique, y mejorar nuestros productos y servicios. Es posible que sean enviados
                    correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales,
                    nuevos productos y otra información publicitaria que consideremos relevante para
                    usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados
                    a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.</p>
                <p style="text-align:left"><b>Cookies</b></p>
                <p style="text-align:justify">Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso
                    para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve
                    entonces para tener información respecto al tráfico web, y también facilita las futuras
                    recurrentes. Otra función que tienen las cookies es que con ellas las webs pueden
                    reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su
                    web.</p>
                <p style="text-align:justify">Nuestro sitio web emplea las cookies para poder identificar las páginas que son
                    visitadas y su frecuencia. Esta información es empleada únicamente para análisis
                    estadístico y después la información se elimina de forma permanente. Usted puede
                    eliminar las cookies en cualquier momento desde su ordenador. Sin embargo, las
                    cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso
                    a información de su ordenador ni de usted, a menos de que usted así lo quiera y la
                    proporcione directamente. Usted puede aceptar o negar el uso de cookies, sin
                    embargo, la mayoría de navegadores aceptan cookies automáticamente pues sirve
                    para tener un mejor servicio web. También usted puede cambiar la configuración de su
                    ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar
                    algunos de nuestros servicios.</p>
                <p style="text-align:left"><b>Acuerdo de Autorización.</b></p>
                <p style="text-align:justify">Subastanuncios se reserva el derecho de cambiar los términos de la presente Política de
                    Privacidad en cualquier momento, El usuario acepta que Subastanuncios envíe
                    notificaciones, incluyendo las relativas a cambios en los Términos y Condiciones,
                    mediante e-mail, correo ordinario o publicando dichas modificaciones en el Sitio Web.</p>
                <p style="text-align:justify">A través del uso de nuestra pagina web www.subastanuncios.com. el usuario autoriza
                    de manera exclusiva, transferible, perpetua e irrevocable a subastanuncios, a hacer uso
                    del contenido que este otorgue opublique a través de la nuestra pagina web
                    www.subastanuncios.com o sus derivados, y por tanto autoriza a su reproducción,
                    modificación, publicación, edición, traducción, distribución y otros, de manera total o
                    parcial y en cualquier tipo de medio, sea o no tecnológico, existente actual o en el futuro.
                    Está autorización se realiza de manera expresa al aceptar estos términos y condiciones
                    y permite el uso mencionado por motivos comerciales o no comerciales. Esta
                    autorización se extiende a subastanuncios o cualquier otra persona, natural o jurídica
                    que se asociara con subastanuncios para el uso de la pagina web
                    www.subastanuncios.com y se realiza reconociendo que no existirá ningún tipo de
                    compensación a favor del usuario.</p>

            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-= Forget Password Modal =-=-=-=-=-=-= -->
<script>
    function terminosCondiciones() {
        $('#modalTerminosCondiciones').modal('show');
    }
</script>
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