 <!--PAGE CONTENT START-->
 <div class="page-content">

     <!--PAGE HEADER START-->
     <header class="page-header">
         <div class="inner-wrapper" style="background-image: url('<?= base_url(); ?>assets_front/assets/img/page-header/contact.jpg')">
             <div class="breadcrumbs-wrapper">
                 <h1 class="page-title">Registrarse</h1>
                 <ul class="breadcrumbs-list">
                     <li>
                         <a href="<?= site_url('front/index'); ?>">
                             Home
                         </a>
                     </li>
                     <li>
                         Registro
                     </li>
                 </ul>
             </div>
         </div>
     </header>
     <!--PAGE HEADER END-->

     <!--CONTACT SECTION START-->
     <section class="contact-section">
         <div class="contact-information default-container">
             <div class="contact-info-row">
                 <div class="contact-info-block">
                     <i class="fa fa-map-pin"></i>
                     <h5>Nuestra ubicación</h5>
                     <p class="contact-info block-reveal-wrapper" data-fx="5">
                         <a class="contact-item reveal-block-link" data-img="<?= base_url(); ?>assets_front/assets/img/reveal/reveal-img-15.jpg">
                             <?= $empresa_object->direccion ?>
                         </a>
                     </p>
                 </div>
                 <div class="contact-info-block">
                     <i class="fa fa-phone"></i>
                     <h5>Llamenos</h5>
                     <p class="contact-info">
                         <a class="contact-item">
                             <?= $empresa_object->telefonos ?>
                         </a>
                     </p>
                 </div>
                 <div class="contact-info-block">
                     <i class="fa fa-envelope"></i>
                     <h5>Email</h5>
                     <p class="contact-info block-reveal-wrapper" data-fx="1">
                         <a class="contact-item reveal-block-link" data-img="<?= base_url(); ?>assets_front/assets/img/reveal/reveal-img-15.jpg">
                             <?= $empresa_object->email ?>
                         </a>

                     </p>
                 </div>
                 <div class="contact-info-block">
                     <i class="fa fa-clock"></i>
                     <h5>Horas laborales</h5>
                     <p class="contact-info">
                         <a class="contact-item">
                             <?= $empresa_object->horario ?>
                         </a>
                     </p>
                 </div>
             </div>
         </div>

         <div class="contact-form-wrapper default-container">
             <div class="contact-form-form">
                 <form class="contact-form" id="form_registrarse" method="post" action="<?= site_url('front/add'); ?>">
                     <input type="text" name="name" placeholder="Escriba su nombre*" id="name" required>
                     <input type="email" name="email" placeholder="Escriba su E-mail*" id="email" required>
                     <input type="password" name="password" placeholder="Escriba su contraseña*" id="password" required>
                     <input type="password" name="repetir_contraseña" required placeholder="<?= translate('repeat_password_lang'); ?>" id="pass2" required>
                     <button id="enviar" type="submit" class="button button-type-2">
                         Enviar <i class="fa fa-paper-plane"></i>
                     </button>
                 </form>
                 <div id="form-messages">
                     <?= get_message_from_operation(); ?>
                 </div>
             </div>
             <div class="contact-form-info">
                 <p class="upper-text"><?= $empresa_object->info_general ?> </p>
                 <h2 class="title">¡Complete el formulario de registro para ingresar!</h2>
                 <p class="subtitle"><?= $empresa_object->descripcion_corta ?></p>

             </div>

         </div>
     </section>
     <!--CONTACT SECTION END-->

 </div>
 <!--PAGE CONTENT END-->