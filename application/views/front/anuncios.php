<?php
if (empty($mastercat))
    $mastercat = "";
?>

<!-- Master Slider -->
<?php if (count($all_banners) > 0) { ?>
    <div class="master-slider ms-skin-default banner2" id="masterslider">
        <?php foreach ($all_banners as $item) { ?>
            <div class="ms-slide slide-1" data-delay="5">
                <img class="img-master" src="<?= base_url('assets_front/js/masterslider/style/blank.gif') ?>" data-src="<?= base_url($item->foto) ?>" alt="<?= $item->foto ?>" />
                <!--  <h3 class="ms-layer title4 font-white font-uppercase font-thin-xs" style="left:90px; top:170px;" data-type="text" data-delay="2000" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)">2017 Ducati Panigale 959 </h3>
                <h3 class="ms-layer title4 font-white font-thin-xs" style="left:90px; top:220px;" data-type="text" data-delay="2500" data-duration="2000" data-ease="easeOutExpo" data-effect="skewleft(30,80)"><span class="font-color">Brand new 0 kms</span></h3>

                <h5 class="ms-layer text1 font-white" style="left: 92px; top: 295px;" data-type="text" data-effect="bottom(45)" data-duration="2500" data-delay="3000" data-ease="easeOutExpo">Lorem Ipsum is simply dummy text of the printing typesetting<br>
                    industry is proident sunt in culpa officia deserunt mollit.
                </h5>
                <a class="ms-layer btn3 uppercase" style="left:95px; top: 405px;" data-type="text" data-delay="3500" data-ease="easeOutExpo" data-duration="2000" data-effect="scale(1.5,1.6)"> Get Started Now!</a> -->
            </div>
        <?php } ?>
    </div>
<?php } ?>
<!-- end Master Slider -->

<div id="search-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12">
                <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                    <select name="cityId" id="cityId" onchange="handleSearch()" class="category form-control">
                        <option label="<?= translate("select_category_lang"); ?>"></option>
                        <option value="0">TODAS LAS CIUDADES </option>
                        <?php if ($all_ciudad) { ?>
                            <?php foreach ($all_ciudad as $item) { ?>
                                <?php if (isset($city)) { ?>
                                    <option <?php if ($city == $item->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                <?php  } else { ?>
                                    <option value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                <?php } ?>

                            <?php } ?>

                        <?php } ?>

                    </select>
                </div>

                <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                    <input name="textSearch" id="textSearch" type="text" class="form-control" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
                </div>

                <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                    <button type="button" onclick="handleSearch()" class="btn btn-block btn-light"><?= translate("buscar_lang"); ?></button>
                </div>
                <!-- end .search-form -->
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding gray">
        <!-- Main Container -->
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-9 col-md-push-3 col-lg-9 col-sx-12 white-bg">
                    <!-- Row -->
                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="row" id="bodyAds">
                            <?php if ($all_anuncios) {
                                foreach ($all_anuncios as $item) {

                                    echo ' <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                                    echo '<div class="category-grid-box-1">';
                                    echo '<a style="cursor:pointer" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">';
                                    echo ' <div class="image">';
                                    if (file_exists($item->anuncio_photo)) {
                                        if (strpos($item->anuncio_photo, 'uploads') !== false) {
                                            echo '<img alt="Tour Package" src="' . base_url($item->anuncio_photo) . '" class="img-responsive">';
                                        } else {
                                            echo '<img alt="Tour Package" src="' . $item->anuncio_photo . '" class="img-responsive">';
                                        }
                                    } else {
                                        echo '<img alt="Tour Package" src="' . base_url("assets/image-no-found.jpg") . '" class="img-responsive">';
                                    }
                                    if ($item->destacado == 1) {
                                        echo '<div class="ribbon popular">Destacado</div>';
                                    }
                                    echo ' <div class="price-tag">';
                                    echo '<div class="price"><span>$' . number_format($item->precio, 2) . '</span></div>';
                                    echo '</div>';
                                    echo ' </div>';
                                    echo '</a>';
                                    echo ' <div class="short-description-1 clearfix">';
                                    echo '<div class="category-title"> <span>' . $item->categoria . ' / ' . $item->subcategoria . '</span> </div>';
                                    echo ' <p><a title="" href="' . site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . '-' . $item->anuncio_id) . '">' . $item->corto . '</a></p>';
                                    echo ' <span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-whatsapp"></i> ' . $item->whatsapp . ' </span> ';
                                    if (isset($item->url)) {
                                        if ($item->url != '' || $item->url != null) {
                                            echo '<a href="' . $item->url . '" class="btn btn-outline btn-default btn-sm" style="margin-left:4px">Comprar</a>';
                                        }
                                    }
                                    echo '</div>';
                                    echo '<div class="ad-info-1">';
                                    echo ' <ul>';
                                    echo '  <li> <i class="fa fa-map-marker"></i>' . $item->ciudad . ' </li>';
                                    echo ' <li> <i class="fa fa-clock-o"></i>' . $item->fecha . ' </li>';
                                    echo ' </ul>';
                                    echo '</div>';
                                    echo ' </div>';
                                    echo ' </div>';
                                }
                            } else {
                                echo '<h1 class="text-center">No hay resultados</h1>';
                            }
                            ?>
                        </div>

                        <!-- Ads Archive End -->
                        <div class="clearfix"></div>
                        <!-- Pagination -->
                        <div id="bodyBtnLoad" class="text-center margin-bottom-30">
                            <button id="btnLoadAds" class="btn btn-success btn-sm margin-bottom-10" onclick="handleLoadAds()" type="button"><i id="loadindAds" class="fa fa-spinner fa-spin"></i>Cargar más</button>
                        </div>
                        <!-- Pagination End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Middle Content Area  End -->
                <!-- Left Sidebar -->
                <div class="col-md-3 col-md-pull-9 col-sx-12">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Panel group -->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Categories Panel -->
                            <div class="panel panel-default">
                                <!-- Heading -->
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <!-- Title -->
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Categorias
                                        </a>
                                    </h4>
                                    <!-- Title End -->
                                </div>
                                <!-- Content -->
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body categories">
                                        <ul>
                                            <?php if ($categories) {
                                                echo '<li>';
                                                echo '<a id="category_0"  onclick="handleSearch(this)" >Todas las categorías </a>';
                                                echo '</li>';
                                                foreach ($categories as $category) {
                                                    echo '<li>';
                                                    echo '<a id="category_' . $category->cate_anuncio_id . '"  onclick="handleSearch(this)" ><i><img style="width: 25px;height: 25px;" src="' . base_url($category->photo) . '" alt=""></i> ' . $category->nombre . ' </a>';
                                                    echo '</li>';
                                                    if (count($category->subCategories) > 0) {
                                                        echo '<ul>';
                                                        foreach ($category->subCategories as $sub) {
                                                            echo '<li><a id="subCategory_' . $sub->subcate_id . '" onclick="handleSearch(this)" style="margin-left:20px;cursor:pointer">';
                                                            echo  '<i style="font-size:8px" class="fa fa-circle" aria-hidden="true"></i> ' . $sub->nombre;
                                                            echo '</a></li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                }
                                            } ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Featured Ads -->
                            <?php if ($destacados) { ?>
                                <?php if (count($destacados) > 0) { ?>
                                    <div class="widget" style="margin-top:8% !important">
                                        <div class="widget-heading">
                                            <h4 class="panel-title"><a><?= translate("anuncios_destacados_lang") ?></a></h4>
                                        </div>
                                        <div class="widget-content">
                                            <div class="featured-slider-3">
                                                <!-- Featured Ads -->
                                                <?php foreach ($destacados as $item) { ?>
                                                    <div class="item">
                                                        <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                                                            <!-- Ad Box -->
                                                            <div class="category-grid-box">
                                                                <!-- Ad Img -->
                                                                <div class="category-grid-img">
                                                                    <img class="img-responsive" alt="" src="<?= base_url($item->anuncio_photo) ?>">
                                                                    <!-- Ad Status -->
                                                                    <!-- User Review -->
                                                                    <!--    <div class="user-preview">
                                                                        <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"> <img src="" class="avatar avatar-small" alt=""> </a>
                                                                    </div> -->
                                                                    <!-- View Details --><a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>" class="view-details"><?= translate("ver_info_lang") ?></a>
                                                                </div>
                                                                <!-- Ad Img End -->
                                                                <div class="short-description">
                                                                    <!-- Ad Category -->
                                                                    <div class="category-title"> <span><a href="#"><?= $item->categoria ?>/<?= $item->subcategoria ?></a></span>
                                                                    </div>
                                                                    <!-- Ad Title -->
                                                                    <h6>
                                                                        <?php if ($item->titulo_corto) { ?>
                                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo_corto ?></a>
                                                                        <?php } else { ?>
                                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo ?></a>
                                                                        <?php } ?>
                                                                    </h6>
                                                                    <!-- Price -->
                                                                    <div class="price">$<?= number_format($item->precio, 2) ?></div>
                                                                </div>
                                                                <!-- Addition Info -->
                                                                <div class="ad-info">
                                                                    <ul>
                                                                        <li><i class="fa fa-map-marker"></i><?= $item->ciudad ?>
                                                                        </li>
                                                                        <li><i class="fa fa-clock-o"></i><?= translate("publicado_lang"); ?>:
                                                                            <?= $item->fecha ?> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- Ad Box End -->
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div> <?php } ?>
                            <?php } ?>
                            <!-- Recent Ads -->
                            <?php if ($recientes) { ?>
                                <?php if (count($recientes) > 0) { ?>
                                    <div class="widget">
                                        <div class="widget-heading">
                                            <h4 class="panel-title"><a><?= translate("anuncios_recientes_lang") ?></a></h4>
                                        </div>
                                        <div class="widget-content recent-ads">
                                            <?php foreach ($recientes as $item) { ?>
                                                <!-- Ads -->
                                                <div class="recent-ads-list">

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                                            <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                                <img src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                                            <h4 class="recent-ads-list-title text-justify">
                                                                <?php if ($item->titulo_corto) { ?>
                                                                    <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo_corto ?></a>
                                                                <?php } else { ?>
                                                                    <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>"><?= $item->titulo ?></a>
                                                                <?php } ?>
                                                            </h4>
                                                            <ul class="recent-ads-list-location">
                                                                <li><a href="#"><?= $item->ciudad ?></a></li>

                                                            </ul>
                                                            <div class="recent-ads-list-price">
                                                                $ <?= number_format($item->precio, 2) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <!-- Categories Panel End -->
                        </div>
                        <!-- panel-group end -->
                    </div>
                    <!-- Sidebar Widgets End -->
                </div>
                <!-- Left Sidebar End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>

</div>
<script src="<?= base_url('assets_front/js/jquery.min.js') ?>"></script>
<script>
    const countAds = parseInt('<?= $count_ads ?>');
    const ads = <?= json_encode($all_anuncios) ?>;
    const baseUrl = '<?= base_url() ?>';
    const siteUrl = '<?= site_url('anuncio/') ?>';
    const searchParams = new URLSearchParams(window.location.search);
    const search = searchParams.get('search');
    const category = searchParams.get('category');
    const subcategory = searchParams.get('subCategory');
    const city = searchParams.get('city');
    let offset = 0;

    $(() => {
        if (category) {
            $('#collapseOne').collapse({
                toggle: true
            });
            $('#category_' + category).css('color', '#8c1822');
        } else {
            $('#category_0').css('color', '#8c1822');
        }
        if (subcategory) {
            $('#subCategory_' + subcategory).css('color', '#8c1822');
        }
        if (search) {
            $('#textSearch').val(search)
        }
    })

    const encodeB64Utf8Ads = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8Ads = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const handleSearch = (ev) => {
        let parents = [];
        let control = false;
        const textSearch = $('#textSearch').val();
        const cityId = $('#cityId').val();
        if (textSearch !== '') {
            parents.push('search=' + textSearch);
        }
        if (cityId > 0) {
            parents.push('city=' + cityId);
        }

        if (ev !== undefined && ev.id) {
            let arrayParams = ev.id.split('_');
            if (arrayParams[0] === 'category') {
                control = true;
                parents.push('category=' + arrayParams[1]);
            } else {
                parents.push('subCategory=' + arrayParams[1]);
            }
        }

        if (category) {
            if (category !== '0') {
                const pCategory = parents.find(p => {
                    const attr = p.split('=');
                    return attr[0] === 'category';
                });
                if (pCategory === undefined) {
                    parents.push('category=' + category);
                }
            }
        }
        if (!control) {
            if (subcategory) {
                if (category !== '0') {
                    const pSubcategory = parents.find(p => {
                        const attr2 = p.split('=');
                        return attr2[0] === 'subCategory';
                    });
                    if (pSubcategory === undefined) {
                        parents.push('subCategory=' + subcategory);
                    }
                }
            }
        }
        let params = [];
        parents.forEach((element, index) => {
            if (index == 0) {
                params.unshift('?' + element);
            } else {
                params.push('&' + element);
            }
        });
        let stringParams = '';
        params.forEach(element => {
            stringParams += element;
        });
        // console.log(stringParams)
        window.location = '<?= site_url('anuncios') ?>' + stringParams;
    }

    const main = () => {
        const visible = countAds - ads.length;
        $('#loadindAds').hide();
        if (visible > 0) {
            $('#bodyBtnLoad').show();
        } else {
            $('#bodyBtnLoad').hide();
        }



    }


    main();

    const handleLoadAds = () => {
        $('#loadindAds').show();
        $('#btnLoadAds').prop('disabled', true);
        const textSearch = $('#textSearch').val();
        const cityId = $('#cityId').val();
        offset += 21;
        $.ajax({
            type: 'POST',
            url: "<?= site_url('front/load_ads') ?>",
            data: {
                offset,
                textSearch,
                cityId,
                category,
                subcategory
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.status == 200) {
                    setTimeout(() => {
                        loadAds(result.data);
                        $('#loadindAds').hide();
                        $('#btnLoadAds').prop('disabled', false);
                    }, 3000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un problema vuelva a intentarlo',
                        showConfirmButton: true
                    });
                }
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error en el servidor vuelva a intentarlo',
                    showConfirmButton: true
                });
            }
        });
    }

    const seo_url = function($text) {
        return $text.toString() // Convert to string
            .normalize('NFD') // Change diacritics
            .replace(/[\u0300-\u036f]/g, '') // Remove illegal characters
            .replace(/\s+/g, '-') // Change whitespace to dashes
            .toLowerCase() // Change to lowercase
            .replace(/&/g, '-') // Replace ampersand
            .replace(/[^a-z0-9\-]/g, '') // Remove anything that is not a letter, number or dash
            .replace(/-+/g, '-') // Remove duplicate dashes
            .replace(/^-*/, '') // Remove starting dashes
            .replace(/-*$/, '');
    }

    const loadAds = (data = []) => {
        if (data.length > 0) {
            let stringAds = '';
            data.forEach(item => {
                const linkPage = siteUrl + seo_url(item.titulo).toLowerCase() + '-' + item.anuncio_id;
                stringAds += ' <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                stringAds += '<div class="category-grid-box-1">';
                stringAds += '<a style="cursor:pointer" href="' + linkPage + '">';
                stringAds += ' <div class="image">';
                if (item.anuncio_photo) {
                    stringAds += '<img alt="Tour Package" src="' + baseUrl + item.anuncio_photo + '" class="img-responsive">';
                } else {
                    stringAds += '<img alt="Tour Package" src="' + baseUrl + 'assets/image-no-found.jpg" class="img-responsive">';
                }
                if (item.destacado == 1) {
                    stringAds += '<div class="ribbon popular">Destacado</div>';
                }
                stringAds += ' <div class="price-tag">';
                stringAds += '<div class="price"><span>$' + parseFloat(item.precio).toFixed(2) + '</span></div>';
                stringAds += '</div>';
                stringAds += ' </div>';
                stringAds += '</a>';
                stringAds += ' <div class="short-description-1 clearfix">';
                stringAds += '<div class="category-title"> <span>' + item.categoria + ' / ' + item.subcategoria + '</span> </div>';
                stringAds += ' <p><a title="" href="' + linkPage + '">' + item.corto + '</a></p>';
                stringAds += ' <span class="text-left" style="font-size:14px;color:#fff"> <i class="fa fa-whatsapp"></i> ' + item.whatsapp + ' </span> ';
                if (item.url !== undefined) {
                    if (item.url != '' || item.url != null) {
                        stringAds += '<a href="' + item.url + '" class="btn btn-outline btn-default btn-sm" style="margin-left:4px">Comprar</a>';
                    }
                }
                stringAds += '</div>';
                stringAds += '<div class="ad-info-1">';
                stringAds += ' <ul>';
                stringAds += '  <li> <i class="fa fa-map-marker"></i>' + item.ciudad + ' </li>';
                stringAds += ' <li> <i class="fa fa-clock-o"></i>' + item.fecha + ' </li>';
                stringAds += ' </ul>';
                stringAds += '</div>';
                stringAds += ' </div>';
                stringAds += ' </div>';
            });
            $('#bodyAds').append(stringAds);
        }
    }
    //  $('#category').val('');

    /*     function cargar_input_2(params) {
            $('#category').val(params);
            $("#buscar_categoria").submit();
        } */
</script>
<style>
    .banner2 {
        padding-top: 107px !important
    }

    .recent-ads .recent-ads-list-image-inner {
        background-color: rgba(0, 0, 0, 0.0) !important;
        display: block;
        height: 60px;
        margin: 0 16px 0 0;
        position: relative;
        width: 100px;
    }

    .section-padding {
        padding: 30px 30px;
    }

    @media (min-width: 768px) and (max-width: 1279px) {
        .sidebar #accordion {
            margin-top: 0px;
        }

    }
</style>