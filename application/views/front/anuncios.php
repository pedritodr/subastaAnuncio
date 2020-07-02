
<?php
if(empty($mastercat))
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
                    <!-- Form -->
                    <?= form_open_multipart("search_anuncios", array('class' => 'search-form')); ?>
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <select name="ciudad_id" class="category form-control">
                            <option label="<?= translate("select_category_lang"); ?>"></option>
                            <option value="0">TODAS LAS CIUDADES </option>
                            <?php if ($all_ciudad) { ?>
                                <?php foreach ($all_ciudad as $item) { ?>
                                    <?php if ($this->session->userdata('session_ciudad')) { ?>
                                        <option <?php if ($this->session->userdata('session_ciudad') == $item->ciudad_id) { ?> selected <?php } ?> value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                    <?php  } else { ?>
                                        <option value="<?= $item->ciudad_id ?>"><?= $item->name_ciudad ?></option>
                                    <?php } ?>

                                <?php } ?>

                            <?php } ?>

                        </select>
                    </div>
                    <!-- Search Field -->
                    <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                        <input name="anuncio_palabra" type="text" class="form-control" placeholder="<?= translate("buscar_palabra_lang"); ?>" />
                    </div>
                    <!-- Search Button -->
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <button type="submit" class="btn btn-block btn-light"><?= translate("buscar_lang"); ?></button>
                    </div>

                    <?= form_close(); ?>
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
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <!-- Middle Content Area -->
                    <div class="col-md-8 col-md-push-4 col-lg-8 col-sx-12 white-bg">
                        <!-- Row -->
                        <div class="row">
                            <?php if ($all_anuncios) { ?>
                                <?php if (count($all_anuncios) > 0) { ?>
                                    <!-- Sorting Filters -->
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- Sorting Filters Breadcrumb -->
                                        <div class="filter-brudcrums">
                                            <span><?= translate("mostrando_lang"); ?><span class="showed"> <?= $inicio ?> - <?= $fin ?></span> <?= translate("de_lang"); ?> <span class="showed"><?= $resultados ?></span> <?= translate("resultados_lang"); ?></span>
                                        </div>
                                        <!-- Sorting Filters Breadcrumb End -->
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <!-- Sorting Filters End-->
                            <div class="clearfix"></div>
                            <!-- Ads Archive --><?php if ($all_anuncios) { ?>
                                <?php foreach ($all_anuncios as $item) { 
                                    
                                    ?>
                                    <div class="ads-list-archive">
                                        <!-- Image Block -->
                                        <div class="col-lg-3 col-md-3 col-sm-3 no-padding">
                                            <!-- Img Block -->
                                            <div class="ad-archive-img">

                                                <a style="cursor:pointer" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                    <!--   <div class="ribbon popular"></div> -->


                                                    <?php if (strpos($item->anuncio_photo, 'uploads') !== false) { ?>

                                                        <img class="img-responsive" src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                    <?php } else { ?>
                                                        <img class="img-responsive" src="<?= $item->anuncio_photo ?>" alt="">

                                                    <?php } ?>

                                                </a>
                                                <?php if ($item->destacado == 1) { ?>
                                                    <div class="ribbon popular"><?= translate("featured_lang") ?></div>
                                                <?php } ?>
                                            </div>

                                            <!-- Img Block -->
                                        </div>
                                        <!-- Ads Listing -->
                                        <div class="clearfix visible-xs-block"></div>
                                        <!-- Content Block -->
                                        <div class="col-lg-9 col-md-9 col-sm-9 no-padding">
                                            <!-- Ad Desc -->
                                            <div class="ad-archive-desc">
                                                <!-- Price -->
                                                <div class="ad-price">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">$ <?= number_format($item->precio, 2) ?></font>
                                                    </font>
                                                </div>
                                                <!-- Title -->
                                                <a style="cursor:pointer" href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>">
                                                    <h6>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;"><?= $item->corto ?></font>
                                                        </font>
                                                    </h6>
                                                </a>
                                                <!-- Category -->
                                                <div class="category-title"> <span><a href="#">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;"><?= $item->categoria ?>/<?= $item->subcategoria ?></font>
                                                            </font>
                                                        </a></span> </div>
                                                <!-- Short Description -->
                                                <div class="clearfix visible-xs-block"></div>
                                                <p class="hidden-sm">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;"><?= $item->corta ?></font>
                                                    </font>
                                                </p>
                                                <!-- Ad Features -->
                                                <ul class="add_info">
                                                    <!-- Contact Details -->
                                                    <li>
                                                        <div class="custom-tooltip tooltip-effect-4">
                                                            <span class="tooltip-item"><i class="fa fa-phone"></i></span>
                                                            <div class="tooltip-content">
                                                                <span class="label label-success">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">+ <?= $item->whatsapp ?></font>
                                                                    </font>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- Address -->
                                                    <li>
                                                        <div class="custom-tooltip tooltip-effect-4">
                                                            <span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
                                                            <div class="tooltip-content">

                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">
                                                                        <?= $item->direccion ?>
                                                                    </font>
                                                                </font>
                                                            </div>
                                                        </div>
                                                    </li>


                                                </ul>
                                                <!-- Ad History -->
                                                <div>

                                                    <div class="ad-meta"> <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo))) . $item->anuncio_id); ?>" class="btn btn-success"><i class="fa fa-eye"></i>
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;"> <?= translate("ver_info_lang"); ?></font>
                                                            </font>
                                                        </a> </div>
                                                </div>
                                            </div>
                                            <!-- Ad Desc End -->
                                        </div>
                                        <!-- Content Block End -->
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <p class="text-center"><?= translate("n_resultados"); ?></p>
                            <?php } ?>
                            <!-- Ads Archive End -->
                            <div class="clearfix"></div>
                            <!-- Pagination -->
                            <div class="text-center margin-bottom-30">
                                <ul class="pagination ">
                                    <?php echo $this->pagination->create_links(); ?>
                                </ul>
                            </div>
                            <!-- Pagination End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Middle Content Area  End -->
                    <!-- Left Sidebar -->
                    <div class="col-md-4 col-md-pull-8 col-sx-12">
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
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                <?= translate("categories_lang"); ?>
                                            </a>
                                        </h4>
                                        <!-- Title End -->
                                    </div>
                                    <!-- Content -->
                                    <div id="collapseOne" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body categories">
                                        <?= form_open_multipart("search_anuncios", array('class' => 'search-form', 'id' => 'buscar_categoria')); ?>
                                            <ul>
                                                <?php $category_id = $this->session->userdata('session_categoria'); ?>
                                                    <?php if (!$category_id) { ?>
                                                    
                                                        <li>
                                                            
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                    <a style="cursor:pointer; color:#2a3681" href="<?= site_url('anuncios/page'); ?>" >
                                                                    <i style="color:#8c1822ab" class="fa fa-tags"></i>
                                                                    Todas las categorías </a>
                                                                    </h4>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php }
                                                         else { ?>
                                                        
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                <a style="cursor:pointer; color:#2a3681" href="<?= site_url('anuncios/page'); ?>" >
                                                                <i style="color:#8c1822ab" class="fa fa-tags"></i>
                                                                Todas las categorías</a>
                                                                </h4>
                                                            </div>
                                                        </div>

                                                        <?php } ?>
                                                        <?php if (!$category_id) { ?>
                                                        <?php if ($categories) { ?>
                                                            <div class="panel-group" id="accordion2">
                                                            <?php 
                                                                $i =0;
                                                                foreach ($categories as $item) { 
                                                                    $i ++;
                                                                    ?>
                                                                <!--Incia foreach --->
                                                                <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapse<?= $i;?>">
                                                                            <i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i>
                                                                             <?= ucwords($item->nombre); ?> </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapse<?= $i;?>" class="panel-collapse collapse ">
                                                                            <div class="panel-body">
                                                                            <?php
                                                                                foreach($subcategoria as $result)
                                                                                    {
                                                                                        if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                            {
                                                                                            ?>
                                                                                    
                                                                                             <p><a style="color:black;" onclick="cargar_input('<?= $result->subcate_id ?>')">
                                                                                             <?= ucwords($result->nombre); ?>
                                                                                                </a>
                                                                                            </p>
                                                                                            <?php
                                                                                            }
                                                                                    }
                                                                                ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                  

                                                                    <?php } ?>
                                                                <?php } else {
                                                                $i = 0;
                                                                 ?>
                                                                <div class="panel-group" id="accordion2">

                                                                <?php foreach ($categories as $item) {
                                                                    $i++; ?>
                                                                <?php if ($item->cate_anuncio_id == $mastercat) { ?>
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion2"  href="#collapse<?= $i;?>">
                                                                            <i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i>
                                                                              <?= ucwords($item->nombre); ?> </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapse<?= $i;?>" class="panel-collapse collapse in">
                                                                            <div class="panel-body">
                                                                            <?php
                                                                                foreach($subcategoria as $result)
                                                                                {
                                                                                   
                                                                                    if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                        {
                                                                                        ?>
                                                                                            <?php
                                                                                              
                                                                                                if($result->subcate_id == $subcate)
                                                                                                    {
                                                                                                      
                                                                                                        ?>
                                                                                                        <div id="collapse<?= $i;?>" class="panel-collapse collapse in">
                                                                                                            <div class="panel-body">
                                                                                                            <?php
                                                                                                                foreach($subcategoria as $result)
                                                                                                                    {
                                                                                                                        if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                                                            {
                                                                                                                            ?>
                            
                                                                                                                                <?php
                                                                                                                                    if($result->subcate_id == $subcate)
                                                                                                                                        {
                                                                                                                                            ?>
                                                                                                                                            <p><a style="color:red;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                                            <?= ucwords($result->nombre); ?>
                                                                                                                                            </a></p>
                                                                                                                                            <?php
                                    
                                                                                                                                        }
                                                                                                                                    else{
                                                                                                                                        ?>
                                                                                                                                        <p><a style="color:black;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                                        <?= ucwords($result->nombre); ?>
                                                                                                                                        </a></p>
                                                                                                                                        <?php
                                                                                                                                    }
                                                                                                                                    ?>
                            
                                                                                                                            <?php 
                                                                                                                            }
                                                                                                                    }
                                                                                                                ?>

                                                                                                            </div>
                                                                                                        </div>  
                                                                                                        <?php   
                                                                                                    }
                                                                                                else{
                                                                                    ?>
                                                                                    <div id="collapse<?= $i;?>" class="panel-collapse collapse ">
                                                                                        <div class="panel-body">
                                                                                        <?php
                                                                                            foreach($subcategoria as $result)
                                                                                                {
                                                                                                    if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                                        {
                                                                                                        ?>
                                                                                            
                                                                                                        <li>
                                                                                                            <?php
                                                                                                                if($result->subcate_id == $subcate)
                                                                                                                    {
                                                                                                                        ?>
                                                                                                                        <p><a style="color:red;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                            <?= ucwords($result->nombre); ?>
                                                                                                                        </a></p>
                                                                                                                        <?php
                                                                                                    
                                                                                                                    }
                                                                                                                else{
                                                                                                                    ?>
                                                                                                                    <p><a style="color:black;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                        <?= ucwords($result->nombre); ?>
                                                                                                                    </a></p>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                            
                                                                                                        </li>
                                                                                                        <?php 
                                                                                                        }
                                                                                                }
                                                                                            ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                       
                                                                    <?php }
                                                                                
                                                                        else { 
                                                                            
                                                                            ?>
                                                                            <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapse<?= $i;?>">
                                                                                <i><img style="width:10%" src="<?= base_url($item->photo) ?>" alt=""></i>
                                                                                 <?= ucwords($item->nombre); ?> </a>
                                                                                </h4>
                                                                            </div>
                                                                            <?php
                                                                            foreach($subcategoria as $result)
                                                                            {
                                                                                if(($result->cate_anuncio_id == $item->cate_anuncio_id))
                                                                                    {

                                                                                       
                                                                                    ?>
                                                                                        <?php
                                                                                            if($result->subcate_id == $subcate)
                                                                                                {
                                                                                                    ?>
                                                                                                    <div id="collapse<?= $i;?>" class="panel-collapse collapse in">
                                                                                                        <div class="panel-body">
                                                                                                        <?php
                                                                                                            foreach($subcategoria as $result)
                                                                                                                {
                                                                                                                    if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                                                        {
                                                                                                                        ?>
                            
                                                                                                                            <?php
                                                                                                                                if($result->subcate_id == $subcate)
                                                                                                                                    {
                                                                                                                                        ?>
                                                                                                                                        <p><a style="color:red;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                                           <?= ucwords($result->nombre); ?>
                                                                                                                                        </a></p>
                                                                                                                                        <?php
                                    
                                                                                                                                    }
                                                                                                                                else{
                                                                                                                                    ?>
                                                                                                                                    <p><a style="color:black;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                                      <?= ucwords($result->nombre); ?>
                                                                                                                                    </a></p>
                                                                                                                                    <?php
                                                                                                                                }
                                                                                                                                ?>
                            
                                                                                                                        <?php 
                                                                                                                        }
                                                                                                                }
                                                                                                            ?>

                                                                                                        </div>
                                                                                                    </div>  
                                                                                                    <?php   
                                                                                                }
                                                                                            else{
                                                                                ?>
                                                                                <div id="collapse<?= $i;?>" class="panel-collapse collapse ">
                                                                                    <div class="panel-body">
                                                                                    <?php
                                                                                        foreach($subcategoria as $result)
                                                                                            {
                                                                                                if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                                    {
                                                                                                    ?>
                                                                                            
                                                                                                    <li>
                                                                                                        <?php
                                                                                                            if($result->subcate_id == $subcate)
                                                                                                                {
                                                                                                                    ?>
                                                                                                                    <p><a style="color:red;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                        <?= ucwords($result->nombre); ?>
                                                                                                                    </a></p>
                                                                                                                    <?php
                                                                                                    
                                                                                                                }
                                                                                                            else{
                                                                                                                ?>
                                                                                                                <p><a style="color:black;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                    <?= ucwords($result->nombre); ?>
                                                                                                                </a></p>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                            
                                                                                                    </li>
                                                                                                    <?php 
                                                                                                    }
                                                                                            }
                                                                                        ?>

                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                                                }
                    
                                                                                    }
                                                                            }
                                                                            ?>
                                                                            <div id="collapse<?= $i;?>" class="panel-collapse collapse ">
                                                                                <div class="panel-body">
                                                                                <?php
                                                                                    foreach($subcategoria as $result)
                                                                                        {
                                                                                            if($result->cate_anuncio_id == $item->cate_anuncio_id)
                                                                                                {
                                                                                                ?>
                            
                                                                                                    <?php
                                                                                                        if($result->subcate_id == $subcate)
                                                                                                            {
                                                                                                                ?>
                                                                                                                <p><a style="color:red;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                    <?= ucwords($result->nombre); ?>
                                                                                                                </a></p>
                                                                                                                <?php
                                    
                                                                                                            }
                                                                                                        else{
                                                                                                            ?>
                                                                                                            <p><a style="color:black;" onclick="cargar_input_2('<?= $result->subcate_id ?>')">
                                                                                                                <?= ucwords($result->nombre); ?>
                                                                                                            </a></p>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                            
                                                                                                <?php 
                                                                                                }
                                                                                        }
                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                            
                                                                        <?php
                                                                           
                                                                            
                                                                    }  
                                                                   
                                                                    
                                                                 } ?>
                                                       
                                                                </ul>
                                                                <input name="category" id="category" class="" type="hidden" value="">

                                                <?= form_close(); ?>
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
                                                                        <!-- View Details --><a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>" class="view-details"><?= translate("ver_info_lang") ?></a>
                                                                    </div>
                                                                    <!-- Ad Img End -->
                                                                    <div class="short-description">
                                                                        <!-- Ad Category -->
                                                                        <div class="category-title"> <span><a href="#"><?= $item->categoria ?>/<?= $item->subcategoria ?></a></span> </div>
                                                                        <!-- Ad Title -->
                                                                        <h6>
                                                                            <?php if ($item->titulo_corto) { ?>
                                                                                <a href="#"><?= $item->titulo_corto ?></a>
                                                                            <?php } else { ?>
                                                                                <a href="#"><?= $item->titulo ?></a>
                                                                            <?php } ?>
                                                                        </h6>
                                                                        <!-- Price -->
                                                                        <div class="price">$<?= number_format($item->precio, 2) ?></div>
                                                                    </div>
                                                                    <!-- Addition Info -->
                                                                    <div class="ad-info">
                                                                        <ul>
                                                                            <li><i class="fa fa-map-marker"></i><?= $item->ciudad ?></li>
                                                                            <li><i class="fa fa-clock-o"></i><?= translate("publicado_lang"); ?>: <?= $item->fecha ?> </li>
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
                                                        <div class="recent-ads-container">
                                                            <div class="recent-ads-list-image">
                                                                <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>" class="recent-ads-list-image-inner">
                                                                    <img src="<?= base_url($item->anuncio_photo) ?>" alt="">
                                                                </a><!-- /.recent-ads-list-image-inner -->
                                                            </div>
                                                            <!-- /.recent-ads-list-image -->
                                                            <div class="recent-ads-list-content">
                                                                <h4 class="recent-ads-list-title text-justify">
                                                                    <?php if ($item->titulo_corto) { ?>
                                                                        <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"><?= $item->titulo_corto ?></a>
                                                                    <?php } else { ?>
                                                                        <a href="<?= site_url(strtolower('anuncio/' . strtolower(seo_url($item->titulo)))); ?>"><?= $item->titulo ?></a>
                                                                    <?php } ?>
                                                                </h4>
                                                                <ul class="recent-ads-list-location">
                                                                    <li><a href="#"><?= $item->ciudad ?></a></li>

                                                                </ul>
                                                                <div class="recent-ads-list-price">
                                                                    $ <?= number_format($item->precio, 2) ?>
                                                                </div>
                                                                <!-- /.recent-ads-list-price -->
                                                            </div>
                                                            <!-- /.recent-ads-list-content -->
                                                        </div>
                                                        <!-- /.recent-ads-container -->
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <!-- Categories Panel End -->



                                <!-- Featured Ads Panel -->
                                <!--  <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a>
                                            Featured Ads
                                        </a>
                                    </h4>
                                </div>

                                <div class="panel-collapse">
                                    <div class="panel-body recent-ads">
                                        <div class="featured-slider-3">

                                            <div class="item">
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding">

                                                    <div class="category-grid-box">

                                                        <div class="category-grid-img">
                                                            <img class="img-responsive" alt="" src="images/posting/car-3.jpg">

                                                            <div class="user-preview">
                                                                <a href="#"> <img src="images/users/2.jpg" class="avatar avatar-small" alt=""> </a>
                                                            </div>
                                                        <a href="#" class="view-details">View Details</a>
                                                        </div>

                                                        <div class="short-description">

                                                            <div class="category-title"> <span><a href="#">Cars</a></span> </div>

                                                            <h3><a title="" href="single-page-listing.html">2017 Honda Civic EX</a></h3>

                                                            <div class="price">$18,200 <span class="negotiable">(Negotiable)</span></div>
                                                        </div>

                                                        <div class="ad-info">
                                                            <ul>
                                                                <li><i class="fa fa-map-marker"></i>London</li>
                                                                <li><i class="fa fa-clock-o"></i> 15 minutes ago </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Featured Ads Panel End -->
                            <!-- Latest Ads Panel -->

                            <!-- Latest Ads Panel End -->
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
    <script>
     
            $('#category').val('');
       
        function cargar_input_2(params) {
            $('#category').val(params);
            $("#buscar_categoria").submit();
        }
    </script>
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

              .recent-ads .recent-ads-list-image-inner {
                  background-color: rgba(0, 0, 0, 0.0) !important;
                  display: block;
                  height: 60px;
                  margin: 0 16px 0 0;
                  position: relative;
                  width: 100px;
              }
          </style>
