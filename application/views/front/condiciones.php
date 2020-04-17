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
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<h1 class="text-left"><?= translate('condiciones_lang') ?></h1>
					<h5 class="text-left">PRODUCTOS</h5>
					<p class="text-justify">SUBASTANUNCIOS se dedica a la publicación y promoción de anuncios y subastas sobre productos y/o servicios propiedad de terceros (Clientes Registrados) en Jacinto Egas #1459 y Río Morona, Ibarra, Ecuador. Desde la aplicación móvil “SUBASTANUNCIOS” bajo ninguna circunstancia se llevará a cabo la venta o promoción de productos o servicios ajenos a nuestro modelo de negocio, sobre todo aquellos productos que sean de venta prohibida por la legislación ecuatoriana. </p>
					<h5 class="text-left">FINALIDAD DEL PORTAL <a href="<?= site_url() ?>">WWW. SUBASTANUNCIOS.COM</a> Y APP MÓVIL </h5>
					<p class="text-justify">En nuestra página web y aplicaciones móviles damos información sobre todo aquello que puede interesar al cliente: promociones y ofertas de productos, anuncios, subastas directas e inversas, horarios y fechas, eventos, ubicación de comercios anunciantes, etc.</p>
					<h5 class="text-left">CONDICIONES DE ACCESO Y UTILIZACIÓN</h5>
					<p class="text-justify">El efectuar un acceso a la web y a aplicaciones móviles, e interactuar con los contenidos e información que en ellas se exponen, es responsabilidad exclusiva de los usuarios, y supone aceptar y conocer las advertencias legales, condiciones y términos de uso contenidos en ella. La Administración de SUBASTANUNCIOS no garantiza que los artículos, productos y/o servicios comercializados, estén disponibles en cualquier momento que se realice una compra. Si se diera el caso en que un cliente realizara la compra de un artículo en subasta, acepta que en caso de no proceder con la posterior compra (pago por el mismo) podría ser penalizado por SUBASTANUNCIOS.</p>
					<h5 class="text-left">PAGOS</h5>
					<p class="text-justify">El comprador podrá realizar los pagos por Transferencia Bancaria, o pago en línea con tarjetas de crédito o débito, para lo cual se emplea una pasarela de pago que realice operaciones dentro de Ecuador. De igual forma el usuario podrá utilizar PayPal, a la hora de realizar una compra. Para lograr estos fines, el usuario/cliente acepta que el prestador obtenga datos para efecto de la correspondiente autenticación de los controles de acceso. Todo proceso de contratación o que conlleve la introducción de datos personales, serán siempre transmitidos mediante protocolo de comunicación segura (HTTPS://) de tal forma que ningún tercero tenga acceso a la información transmitida vía electrónica. </p>
					<h5 class="text-left">CALIDAD DE LOS DATOS </h5>
					<p class="text-justify">Los usuarios deberán garantizar la veracidad, exactitud, autenticidad y vigencia de los datos de carácter personal que les hayan sido recogidos.</p>
					<h5 class="text-left">PROTECCIÓN DE MENORES </h5>
					<p class="text-justify">No recogemos datos personales ni aceptamos compras de menores. Es responsabilidad del padre/madre/tutor legal velar por la privacidad de los menores, haciendo todo lo posible para asegurar que han autorizado la recogida y el uso de los datos personales del menor.</p>
					<h5 class="text-left">CONDICIONES DE COMPRA </h5>
					<p class="text-justify">Los precios y condiciones de venta tienen un carácter meramente informativo y pueden ser modificados en atención a las fluctuaciones del mercado. No obstante, la realización del pedido (puja) en una subasta se confirmará una vez terminado el plazo de la misma. El castellano será la lengua utilizada para formalizar el contrato (en caso de requerirlo la operación). El documento electrónico en que se formalice el contrato se archivará y el usuario tendrá acceso a él por los diferentes medios de contacto. </p>
					<h5 class="text-left">ENVÍO DE NOTIFICACIONES </h5>
					<p class="text-justify">Los plazos de envío para una notificación antes el término de una subasta o evento de premios, oscilan entre las 72 horas y los 15 días. No podemos garantizar con exactitud la materialización de un plazo especifico pues depende en gran parte de la ubicación geográfica donde se encuentre el usuario a la cual se le hará llegar en formato físico las descripciones del procedimiento de subasta para proceder con la materialización de la compra-venta. </p>
					<h5 class="text-left">DEVOLUCIONES </h5>
					<p class="text-justify">SUBASTANUNCIOS no se responsabiliza por la calidad de los productos o servicios adquiridos mediante su plataforma, una vez que el cliente acepte que tiene la responsabilidad de garantizar y evaluar la calidad de los mismos durante el proceso de compra. </p>
					<h5 class="text-left">CANCELACIONES DE PEDIDOS </h5>
					<p class="text-justify">En aquellas cancelaciones de pedidos que impliquen una devolución de los derechos de compra por parte del usuario al cliente y que sean aceptadas por SUBASTANUNCIOS, se notificará vía correo electrónico al Usuario el hecho de que SUBASTANUNCIOS dispondrá de un plazo máximo de 30 días por trámites administrativos, si bien intentamos que el plazo no sea superior a 7 días.</p>
					<h5 class="text-left">RESPONSABILIDADES DEL CLIENTE</h5>
					<p class="text-justify">El Cliente se obliga a realizar un uso lícito de los servicios brindados en la aplicación, sin contravenir la legislación vigente, ni lesionar los derechos e intereses de terceras personas.
						El Cliente garantiza la veracidad y exactitud de los datos facilitados al cumplimentar los formularios de contratación, evitando que por su causa ocurran perjuicios en contra de los intereses de SUBASTANUNCIOS, especialmente como consecuencia de la incorrección de los mismos.
						El incumplimiento de cualquiera de las Condiciones de Uso podrá dar lugar a la retirada o cancelación de los servicios por parte de SUBASTANUNCIOS, sin necesidad de previo aviso al Cliente y sin que ello dé derecho a indemnización alguna (incluyendo cancelación de Perfiles de Usuario).
					</p>
					<h5 class="text-left">SERVICIOS POSTVENTA</h5>
					<p class="text-justify">Para cualquier consulta, incidencia, queja o reclamación tras la adquisición de los productos o servicios, SUBASTANUNCIOS pone a disposición del Cliente un Servicio de Atención al Cliente en el correo electrónico <a href="info@subastanuncios.com">info@subastanuncios.com</a> y el teléfono +(593) 967133720.</p>
					<h5 class="text-left">PROPIEDAD INDUSTRIAL E INTELECTUAL</h5>
					<p class="text-justify">Los derechos de propiedad intelectual e industrial sobre las obras, marcas, logos, y cualquier otro susceptible de protección, contenidos en la Plataforma SUBASTANUNCIOS, propiedad de SUBASTANUNCIOS corresponden en exclusiva a SUBASTANUNCIOS (o a terceros autorizantes), a quien corresponde el ejercicio exclusivo de los derechos de explotación de los mismos en cualquier forma y, en especial, con carácter enunciativo y no limitativo, los derechos de reproducción, copia, distribución, transformación, comercialización, y comunicación pública. La reproducción, distribución, comercialización o transformación no autorizadas de tales obras, marcas, logos, etc., constituye una infracción de los derechos de propiedad intelectual e industrial de SUBASTANUNCIOS o del titular de los mismos, y podrá dar lugar al ejercicio de cuantas acciones judiciales o extrajudiciales les pudieran corresponder en el ejercicio de sus derechos.</p>
					<p class="text-justify">Mediante la aceptación de las presentes Condiciones Generales de Contratación, el Cliente se compromete a respetar los derechos de Propiedad Industrial e Intelectual titularidad de SUBASTANUNCIOS y de terceros.</p>
					<h5 class="text-left">JURISDICCIÓN Y LEY APLICABLE</h5>
					<p class="text-justify">En el supuesto de que surja cualquier conflicto o discrepancia en la interpretación o aplicación de las presentes condiciones contractuales, los Juzgados y Tribunales que, en su caso, conocerán del asunto, serán los que disponga la normativa legal aplicable en materia de jurisdicción competente, en la que se atiende, tratándose de consumidores finales, al lugar del cumplimiento de la obligación o al del domicilio de la parte compradora.</p>
					<h5 class="text-left">Nivel del Servicio</h5>
					<p class="text-justify">SUBASTANUNCIOS realizará los esfuerzos necesarios para mantener el Servicio de Subastas y Anuncios se encuentre operativo en todo momento. Sin embargo, problemas técnicos pueden provocar interrupciones esporádicamente. Hay que tener en cuenta que la disponibilidad y la calidad del Servicio pueden variar en función de diversos factores, como pueden ser el dispositivo que se utilice, la ubicación geográfica del usuario, el ancho de banda disponible y/o la velocidad de la conexión a Internet, por lo que será responsabilidad del usuario asegurar que los sistemas e infraestructuras de los que dispone son los adecuados y necesarios para la correcta recepción del Servicio, así como la configuración de los mismos. SUBASTANUNCIOS no será responsable por las deficiencias o falta de disponibilidad del Servicio causadas por el usuario, por las deficiencias en el acceso a Internet o por cualquier otra causa fuera del control de SUBASTANUNCIOS</p>
					<p class="text-justify">SUBASTANUNCIOS realizará de forma esporádica actualizaciones y tareas de mantenimiento del Servicio, durante las cuales es posible que el Servicio no esté disponible. SUBASTANUNCIOS intentará establecer las actualizaciones y tareas de mantenimiento fuera de las horas punta, nunca superior a 30 minutos y no más de dos veces al mes. La falta de disponibilidad debido a actualizaciones y tareas de mantenimiento no dan derecho al usuario a ningún tipo de reembolso o compensación.</p>
					<!-- <h5 class="text-left"></h5>
					<p class="text-justify"></p> -->

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