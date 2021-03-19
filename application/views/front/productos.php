 <!--PAGE CONTENT START-->
 <div class="page-content">

     <!--PAGE HEADER START-->
     <header class="page-header">
         <div class="inner-wrapper" style="background-image: url('<?= base_url($all_menus[1]->photo_main); ?>')">
             <!--<div class="breadcrumbs-wrapper">
                 <h1 class="page-title">Shop</h1>
                 <ul class="breadcrumbs-list">
                     <li>
                         <a href="<?= site_url('front/index'); ?>">
                             Home
                         </a>
                     </li>
                     <li>
                         Productos
                     </li>
                 </ul>
             </div>-->
         </div>
     </header>
     <!--PAGE HEADER END-->
     <section class="portfolio-section wide-layout grid-section">
         <div class="portfolio-grid-wrapper">
             <div class="portfolio-filtering-button-group grid-filtering-button-group">
                 <button id="0" class="button active-button toque" data-filter="" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                     <span>
                         All
                     </span>
                 </button>
                 <?php foreach ($all_categorias as $item) { ?>
                 <button id="<?= $item->categoria_id ?>" class="button active-button toque" data-filter="" style="opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                     <span>
                         <?= $item->nombre ?>
                     </span>
                 </button>
                 <?php } ?>



             </div>
         </div>
     </section>
     <!--SHOP SECTION START-->
     <section class="shop-section boxed-layout">
         <div class="shop-inner-wrapper">

             <div class="shop-grid">
                 <div class="contact-form-wrapper default-container" id="respuesta">
                     <div id="form-messages">
                         <?= get_message_from_operation(); ?>
                     </div>
                 </div>

                 <?php if ($all_coleccions) { ?>
                 <?php foreach ($all_coleccions as $item) { ?>
                 <?php foreach ($item->productos as $producto) { ?>
                 <div id="product" class="product-item">
                     <div class="img-wrapper tilt-wrapper" data-tilt-value="40" data-tilt-speed="2500" data-tilt-scale="1" data-tilt-perspective="2000">
                         <a href="<?= site_url('front/single_producto/' . $producto->producto_id); ?>">
                             <div class="image" style="background-image: url(<?= base_url($producto->main_photo); ?>)"></div>
                             <?php if ($producto->stock > 0) { ?>
                             <?php if ($producto->descuento > 0) { ?>
                             <div class="product-label">
                                 <span class="sale-label">
                                     Descuento <span><?= $producto->descuento ?>%</span>
                                 </span>
                             </div>
                             <?php } ?>


                             <div class="button-permalink-wrapper">
                                 <a href="#" class="button button-product">
                                     Add to cart
                                 </a>
                             </div>
                             <?php } else { ?>
                             <div class="product-label">
                                 <span class="sale-label">
                                     Agotado
                                 </span>
                             </div>
                             <?php } ?>
                         </a>
                     </div>
                     <div class="product-info">
                         <!-- <h6 class="title"><a href="shop-single-product.html"><?= $item->name; ?></a></h6>-->
                         <span class="price">
                             <?php if ($producto->descuento > 0) { ?>
                             <?php $descuento = $producto->descuento / 100;
                                                $precio_descuento = $producto->price - ($producto->price * $descuento); ?>
                             <h5>$ <?= number_format($precio_descuento, 2); ?> &nbsp</h5>
                             <h5 class="tachar">$ <?= number_format($producto->price, 2); ?></h5>
                             <?php } else { ?>
                             <h5>$ <?= number_format($producto->price, 2); ?></h5>
                             <?php } ?>
                         </span>
                         <br>
                         <?php if ($all_favoritos) { ?>
                         <?php if (!in_array($producto->producto_id, $all_favoritos)) { ?>
                         <a href="<?= site_url('front/add_favorito/0/' . $producto->producto_id); ?>" class="button wishlist-button">
                             <h6><i class="fa fa-heart"></i> AGREGAR A FAVORITOS</h6>
                         </a>
                         <?php  } ?>
                         <?php } else if ($this->session->userdata('role_id') == 3) { ?>

                         <a href="<?= site_url('front/add_favorito/0/' . $producto->producto_id); ?>" class="button wishlist-button">
                             <h6><i class="fa fa-heart"></i> AGREGAR A FAVORITOS</h6>
                         </a>
                         <?php  } ?>

                     </div>
                 </div>

                 <?php } ?>
                 <?php } ?>
                 <?php } ?>
             </div>

         </div>


 </div>
 </section>
 <!--SHOP SECTION END-->
 <section class="shop-section ">
     <div class="shop-inner-wrapper">
         <div class="shop-info-wrapper">
             <div class="info-row">
                 <div class="info-block">
                     <i style="color:#b1acac;" class="fa fa-shopping-basket"></i>
                     <h6>ENTREGA GRATIS</h6>
                     <h5>Si tu compra es mayor a
                         $25, el envío corre por
                         nuestra cuenta!</h5>
                 </div>

                 <div class="info-block">
                     <i style="color:#b1acac;" class="fa fa-lock"></i>
                     <h6>PAGO SEGURO</h6>
                     <h5>Nuestra plataforma
                         garantiza transaciones
                         seguras y tu info
                         encapsulada.</h5>
                 </div>
                 <div class="info-block">
                     <i style="color:#b1acac;" class="far fa-clock"></i>
                     <h6>24 HORAS CIUDADES
                         PRINCIPALES</h6>
                     <h5>Tu objeto con alma te llegará
                         en un máximo de 24 horas.
                         Martes y Jueves cidades
                         satelites. Nuestra cadena aliada
                         UPS . LAAR se contactará
                         contigo para coordinar la
                         entrega. </h5>
                 </div>
                 <div class="info-block">
                     <i style="color:#b1acac;" class="fas fa-tag"></i>
                     <h6>DESCUENTOS Y
                         PROMOSIONES</h6>
                     <h5>Registrate y recibe
                         promociones flash
                         y descuentos de
                         temporada.</h5>
                 </div>
             </div>
         </div>
     </div>

 </section>
 </div>
 <!--PAGE CONTENT END-->