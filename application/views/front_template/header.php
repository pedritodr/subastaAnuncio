<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from templates.scriptsbundle.com/addforest/demos/adforest/site-map.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Aug 2019 00:19:51 GMT -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
    <meta name="description" content="">
    <meta name="author" content="ScriptsBundle">
    <title><?= isset($data_seo) ? $data_seo[1] : "Subastas | Anuncios"; ?></title>
    <?php
    if (isset($data_seo))
        meta_tags($e = $data_seo[0], $title = $data_seo[1], $desc = $data_seo[2], $imgurl = $data_seo[3], $url = $data_seo[4]);
    else
        meta_tags();
    ?>
    <!-- =-=-=-=-=-=-= Favicons Icon =-=-=-=-=-=-= -->
    <!--    <link rel="icon" href="<?= base_url('assets_front/favicon/favicon.ico'); ?>" type="image/x-icon" /> -->
    <!-- =-=-=-=-=-=-= Mobile Specific =-=-=-=-=-=-= -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- =-=-=-=-=-=-= Bootstrap CSS Style =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/bootstrap.css') ?>">
    <!-- =-=-=-=-=-=-= Template CSS Style =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/style.css') ?>">
    <!-- =-=-=-=-=-=-= Font Awesome =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/font-awesome.css') ?>" type="text/css">
    <!-- =-=-=-=-=-=-= Flat Icon =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/css/flaticon.css') ?>" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Et Line Fonts =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/et-line-fonts.css') ?>" type="text/css">
    <!-- =-=-=-=-=-=-= Menu Drop Down =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/forest-menu.css') ?>" type="text/css">
    <!-- =-=-=-=-=-=-= Animation =-=-=-=-=-=-= -->
    <link rel="stylesheet" href="<?= base_url('assets_front/css/animate.min.css') ?>" type="text/css">
    <!-- =-=-=-=-=-=-= Select Options =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/css/select2.min.css') ?>" rel="stylesheet" />
    <!-- =-=-=-=-=-=-= noUiSlider =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/css/nouislider.min.css') ?>" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Listing Slider =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/css/slider.css') ?>" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Owl carousel =-=-=-=-=-=-=  -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_front/css/owl.carousel.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_front/css/owl.theme.css') ?>">
    <!-- =-=-=-=-=-=-= Check boxes =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/skins/minimal/minimal.css') ?>" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Responsive Media =-=-=-=-=-=-= -->
    <link href="<?= base_url('assets_front/css/responsive-media.css') ?>" rel="stylesheet">
    <!-- =-=-=-=-=-=-= Template Color =-=-=-=-=-=-= -->
    <link rel="stylesheet" id="color" href="<?= base_url('assets_front/css/colors/defualt.css') ?>">
    <!-- =-=-=-=-=-=-= For Style Switcher =-=-=-=-=-=-= -->
    <link rel="stylesheet" id="theme-color" type="text/css" href="#" />

    <!-- JavaScripts -->
    <script src="<?= base_url('assets_front/js/modernizr.js') ?>"></script>

    <!-- Base MasterSlider style sheet -->
    <script src="<?= base_url('admin_lte/bootstrap/js/alert_notificacion.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets_front/js/masterslider/style/masterslider.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets_front/js/masterslider/skins/default/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets_front/js/masterslider/style/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets_front/css/cropper.css') ?>" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- HTML5 Shim and Respond.js IE8 support  of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicon/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicon/apple-icon-60x60.png') ?> ">
    <link rel="apple-touch-icon" sizes=" 72x72 " href="<?= base_url('favicon/apple-icon-72x72.png') ?> ">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicon/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes=" 114x114 " href="<?= base_url('favicon/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicon/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicon/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes=" 152x152 " href="<?= base_url('favicon/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicon/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16. png') ?>">
    <link rel=" manifest " href="<?= base_url('favicon/manifest.json') ?>">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.css" type="text/css" /> -->

</head>

<body>
    <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- =-=-=-=-=-=-= end Preloader =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= Light Header =-=-=-=-=-=-= -->
    <div class="transparent-header">
        <!-- Top Bar -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Header Top Left -->
                    <div class="header-top-left col-md-8 col-sm-6 col-xs-12 hidden-xs">
                        <ul class="listnone">
                            <li><a href="<?= site_url('nosotros') ?>"><i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <?= translate("acerca_lang") ?></a></li>
                            <!-- <li><a href="faqs.html"><i class="fa fa-folder-open-o" aria-hidden="true"></i><?= translate("preguntas_lang") ?></a></li>-->
                            <!--     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i> Language <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="#"><?= translate('español_lang'); ?></a></li>
                           <li><a href="#"><?= translate('english_lang'); ?></a></li>
                           <li><a href="#"><?= translate('arabe_lang'); ?></a></li>
                        </ul>
                     </li> -->
                        </ul>
                    </div>
                    <!-- Header Top Right Social -->
                    <div class="header-right col-md-4 col-sm-6 col-xs-12 ">
                        <div class="pull-right">
                            <ul class="listnone">
                                <!-- si el usuario no esta autenticado-->
                                <?php if (!$this->session->userdata('role_id')) { ?>

                                    <li><a href="<?= site_url('login') ?>"><i class="fa fa-sign-in"></i>
                                            <?= translate("login_lang"); ?></a></li>
                                    <li><a href="<?= site_url('registrarse') ?>"><i class="fa fa-unlock" aria-hidden="true"></i> <?= translate("registrarse_lang"); ?></a></li>

                                <?php } else { ?>
                                    <!--usuario autenticado-->

                                    <?php if ($this->session->userdata('role_id') != 1) { ?>

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-profile-male" aria-hidden="true"></i> Hola <?= $this->session->userdata('name') ?> <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= site_url('perfil/page'); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?= translate("perfil_lang"); ?> </a></li>

                                                <li><a href="<?= site_url('login/logout') ?>"><i class="fa fa-unlock" aria-hidden="true"></i><?= translate("sign_out_lang"); ?></a></li>
                                            </ul>
                                        </li>
                                    <?php } else { ?>

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-profile-male" aria-hidden="true"></i> Hola <?= $this->session->userdata('name') ?> <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?= translate("administracion_lang"); ?> </a>
                                                </li>

                                                <li><a href="<?= site_url('login/logout') ?>"><i class="fa fa-unlock" aria-hidden="true"></i><?= translate("sign_out_lang"); ?></a></li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Navigation Menu -->
        <nav id="menu-1" class="mega-menu">
            <!-- menu list items container -->
            <section class="menu-list-items">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <!-- menu logo -->
                            <ul class="menu-logo">
                                <li>
                                    <a href="<?= site_url('portada') ?>"><img src="<?= base_url('assets_front/images/subastanuncio-x1.png'); ?>" alt="logo"> </a>
                                </li>
                            </ul>
                            <!-- menu links -->
                            <ul class="menu-links">
                                <!-- active class -->
                                <li>
                                    <a class="text-center" href="<?= site_url('portada') ?>">
                                        <?= translate('inicio_lang') ?> <i></i></a>
                                </li>
                                <li>
                                    <a href="<?= site_url('financiamientos') ?>"> Financiamiento <i></i></a>
                                </li>
                                <!--     <li>
                                    <a href="<?= site_url('subastas_directas') ?>"> <?= translate('subasta_lang') ?>
                                        <i></i></a>
                                </li> -->
                                <li>
                                    <a href="<?= site_url('anuncios') ?>"> <?= translate('Anuncios_lang') ?>
                                        <i></i></a>
                                </li>
                                <?php if (!$this->session->userdata('user_id')) { ?>
                                    <li>
                                        <a href="<?= site_url('membresia') ?>"> <?= translate('menbresi_lang') ?>
                                            <i></i></a>
                                    </li>
                                <?php } else { ?>
                                    <?php if (!$membresia_user) { ?>
                                        <li>
                                            <a href="<?= site_url('membresia') ?>"> <?= translate('menbresi_lang') ?>
                                                <i></i></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <li>
                                    <a href="<?= site_url('contacto') ?>"> <?= translate('contact_lang') ?> <i></i></a>
                                </li>
                                <!--   <li>
                                    <a href="<?= site_url('faqs') ?>"> <?= translate('faq_lang') ?> <i></i></a>
                                </li> -->
                                <?php if ($this->session->userdata('user_id')) { ?>
                                    <li>
                                        <a href="<?= site_url('crear-anuncio') ?>" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true">
                                            </i><?= translate("name_publi_lang"); ?></a>
                                    </li>
                                <?php } ?>

                            </ul>

                        </div>
                    </div>
                </div>

            </section>
        </nav>
    </div>

    <div id="left_menu" style="position: fixed;top:0px;left:0px;height:100%;width:0px;z-index:10000;background-color:#FFF;overflow:hidden scroll;">
        <div id="area_elementos_menu" style="display: none;">
            <div class="row" style="margin-top: 20px;">
                <span style="float:left;margin-left:15%;"><svg id="icono_detalle" onclick="cerrarMenu();" style="float: left; margin-left: 1%;padding-bottom:0px; margin-bottom:0px;cursor:pointer" class="bi bi-x" width="2em" height="2em" viewBox="0 0 16 16" fill="#08374c" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z" />
                        <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z" />
                    </svg></span>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-categoria">Categorías</div>
                </div>
            </div>
            <div style="padding: 0px 35px;" id="area_categoria">
                <div class="row">
                    holasss
                </div>
            </div>

            <div style="padding: 0px 35px;" id="area_subcategoria">
                <div class="col" style="color: #E5390C;font-size:14px;font-weight:bold;text-align:center;" id="selected_category_menu"></div>
                <hr />
                <div id="body_subcategory_menu">
                </div>
            </div>


        </div>
    </div>
    <script>
        function openMenu() {
            $("#container_menu_derecho").html(
                '<a href="javascript:void(0)" onclick="openMenu()"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 40px;color: #08374C;"></i></a>'
            );
            $("#area_elementos_menu").fadeIn(200);
            $('#header').css('filter', 'blur(3px)');
            $('#wrapper').css('filter', 'blur(3px)');
            $('#footer').css('filter', 'blur(3px)');
            $('body').css("overflow", "hidden");
            is_closed = 1;

            $('#left_menu').animate({
                width: '100%'
            }, 200);
        }
        let is_closed = 0;

        function cerrarMenu() {
            $('#header').css('filter', 'blur(0px)');
            $('#wrapper').css('filter', 'blur(0px)');
            $('#footer').css('filter', 'blur(0px)');
            $('body').css("overflow", "scroll");
            $("#area_elementos_menu").fadeOut(200);
            $("#container_menu_derecho").html(
                '<a href="javascript:void(0)" onclick="openMenu2()"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 40px;color: #08374C;"></i></a>'
            );
            is_closed = 1;
            $('#left_menu').animate({
                width: '0px'
            }, 200);
            $("#container_menu_izquierdo").html(
                '<a href="javascript:void(0)" onclick="openMenu()"><i class="fa fa-bars" aria-hidden="true" style="font-size: 41px;color: #08374C;"></i></a>'
            );
        }
    </script>