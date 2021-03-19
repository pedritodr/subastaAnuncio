     <!-- =-=-=-=-=-=-= Light Header End  =-=-=-=-=-=-= -->
      <!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="index.html">Home</a></li>
                  <li><a href="#">Pages</a></li>
                  <li><a href="#">Profile</a></li>
                  <li><a class="active" href="#">Active Ads</a></li>
               </ul>
            </div>
         </div>
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
                        <a href="profile.html"><img src="<?= base_url('assets_front/images/users/9.jpg')?>" alt=""></a>

                        <div class="profile-detail">
                        <?= $this->session->userdata('name')?>
                          
                           <ul class="contact-details">
                              
                              <li>
                                 <i class="fa fa-envelope"></i> <?= $this->session->userdata('email')?>
                              </li>
                              <li>
                                 <i class="fa fa-phone"></i> <?= $this->session->userdata('phone')?>
                              </li>
                           </ul>
                        </div>
                        <ul>
                           <li ><a href="profile.html">Profile</a></li>
                           <li  class="active"><a href="active-ads.html">My Ads <span class="badge">45</span></a></li>
                           <li><a href="favourite.html">Favourites Ads <span class="badge">15</span></a></li>
                           <li><a href="archives.html">Archives</a></li>
                           <li ><a href="messages.html">Messages</a></li>
                           <li><a href="#">Logout</a></li>
                        </ul>
                     </div>
                     <!-- Categories --> 
                     <div class="widget">
                        <div class="widget-heading">
                           <h4 class="panel-title"><a>Change Your Plan</a></h4>
                        </div>
                        <div class="widget-content">
                           <select class=" form-control">
                              <option label="Select Option"></option>
                              <option value="0">Free</option>
                              <option value="1">Premium</option>
                              <option value="2">Featured</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8 col-sm-12 col-xs-12">
                     <!-- Row  listado de aununcios-->
                     <div class="row">
                        <!-- Sorting Filters -->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                           <!-- Sorting Filters Breadcrumb -->
                           <!-- Sorting Filters Breadcrumb End -->
                        </div>
                        <!-- Sorting Filters End-->
                        <div class="clearfix"></div>
                        <!-- mis anuncios -->
                        <div class="posts-masonry">
                           <!-- primer anuncio -->
                        <?php foreach ($all_anuncios as $item) { ?>
                           
                         
                           <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12  ">
                              <div class="white category-grid-box-1 ">
                                 <!-- foto -->
                                 <div class="image"> <img alt="Tour Package" src="<?= base_url($item->photo); ?>" class="img-responsive"> </div>
                                 <!--descripcion -->
                                 <div class="short-description-1 ">
                                    <!-- subcategoria  -->
                                    <div class="category-title"><?=$item->subcate->nombre;?> </div>     
                                  
                           <!-- descripcion -->
                                    <h3>
                                  
                                       <a title="" href="<?= site_url('front/detalle_anuncio/'. $item->anuncio_id)?>" ><?= $item->titulo;?></a>
                                    </h3>
                                    <!-- Location -->
                                    <p class="location"><i class="fa fa-map-marker"></i> <?=   $item->ciudad->name_ciudad;?></p>
                                    <!-- Rating -->
                                    <div class="rating">
                                       <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="rating-count">(2)</span>
                                      
                                    </div>
                                     <!-- Price --><span class="ad-price"><?= $item->precio;?></span> 
                                 </div>
                                 <!-- Ad Meta Stats -->
                                 <div class="ad-info-1">
                                    <ul class="pull-left">
                                       <li> <i class="fa fa-eye"></i><a href="#">445 Views</a> </li>
                                       <li> <i class="fa fa-clock-o"></i>15 minutes ago </li>
                                    </ul>
                                    <ul class="pull-right">
                                       <li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit this Ad" href="#"><i class="fa fa-pencil edit"></i></a> </li>
                                       <li> <a  data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Ad" href="#"><i class="fa fa-times delete"></i></a></li> 
                                       <button  data-toggle="modal" data-target=".price-quote" onclick = "cargarmodal('<?= $item->anuncio_id?>');" ><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                           
                                                               
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                             <!--fin primer anuncio-->

                        </div>
                         <!-- Inicio Modal-->
                   
                        <!--fin del modal-->
                        <!-- Ads Archive End -->  
                        <div class="clearfix"></div>
                        <!-- Pagination -->  
                        <div class="col-md-12 col-xs-12 col-sm-12">
                           <ul class="pagination pagination-lg">
                              <li> <a href="#"> <i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
                              <li> <a href="#">1</a> </li>
                              <li class="active"> <a href="#">2</a> </li>
                              <li> <a href="#">3</a> </li>
                              <li> <a href="#">4</a> </li>
                              <li><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                        <!-- Pagination End -->   
                     </div>
                     <!-- Row End -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>



            <!-- Main Container End -->
         </section>