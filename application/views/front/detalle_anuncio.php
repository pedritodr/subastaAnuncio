<section class="breadcrumb-1 small-hero">
   <div class="bg-overlay">
      <div class="container">
         <!-- Main Content -->
         <div class="content-section">
            <!-- Title -->

         </div>
         <!-- Main Content End -->
      </div>
   </div>
</section>
<!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
<!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
<div class="main-content-area clearfix">
   <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
   <section class="section-padding error-page pattern-bgs gray ">
      <!-- Main Container -->
      <div class="container">
         <!-- Row -->
         <div class="row">
            <!-- Middle Content Area -->
            <div class="col-md-8 col-xs-12 col-sm-12">
               <!-- Single Ad -->


               <div class="single-ad">
                  <!-- Titulo -->
                  <div class="ad-box">
                     <h1><?= $all_anuncios->titulo; ?></h1>

                     <div class="short-history">
                        <ul>


                        </ul>
                     </div>


                  </div>
                  <!-- Listing Slider  -->
                  <div class="flexslider single-page-slider">
                     <div class="flex-viewport">
                        <ul class="slides slide-main">
                           <li class="flex-active-slide"><img src="<?= base_url($all_anuncios->photo) ?>"></li>
                           <?php foreach ($fotos_object as $item) { ?>
                              <li><img alt="" draggable="false" src="<?= base_url($item->photo_anuncio) ?>"></li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>

                  <!-- Listing Slider Thumb -->
                  <div class="flexslider" id="carousels">
                     <div class="flex-viewport">
                        <ul class="slides slide-thumbnail">
                           <li class="flex-active-slide"><img src="<?= base_url($all_anuncios->photo) ?>"></li>
                           <?php foreach ($fotos_object as $item) { ?>
                              <li><img alt="" draggable="false" src="<?= base_url($item->photo_anuncio) ?>"></li>
                           <?php } ?>
                           <!-- items mirrored twice, total of 12 -->
                        </ul>
                     </div>
                  </div>



                  <!-- Share Ad  -->
                  <div class="ad-share text-center">
                     <div data-toggle="modal" data-target=".share-ad" class="ad-box col-md-4 col-sm-4 col-xs-12">
                        <i class="fa fa-share-alt"></i> <span class="hidetext">Share</span>
                     </div>
                     <a class="ad-box col-md-4 col-sm-4 col-xs-12" href="#"><i class="fa fa-star active"></i> <span class="hidetext">Add to watchlist</span></a>
                     <div data-target=".report-quote" data-toggle="modal" class="ad-box col-md-4 col-sm-4 col-xs-12">
                        <i class="fa fa-warning"></i> <span class="hidetext">Report</span>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- Short Description  -->
                  <div class="ad-box">
                     <div class="short-features">
                        <!-- Heading Area -->
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                              <?= translate('descripcion_lang') ?>
                           </h3>
                        </div>

                        <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                           <span><strong><?= translate('precios_lang'); ?> <?= $all_anuncios->precio; ?></strong></span>
                        </div>
                     </div>
                     <!-- Short Features  -->
                     <div class="desc-points">
                        <ul>
                           <li>
                              <?= $all_anuncios->descripcion; ?>
                           </li>

                        </ul>
                     </div>
                     <!-- Related Image  -->
                     <div class="ad-related-img">
                        <img src="images/car-img1.png" alt="" class="img-responsive center-block">
                     </div>
                     <!-- Ad Specifications -->

                     <div class="clearfix"></div>
                  </div>
               </div>
               <!-- Single Ad End -->

               <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
               <div class="grid-panel margin-top-30">
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12">
                        <h3 class="main-title text-left">
                           Related Ads
                        </h3>
                     </div>
                  </div>
                  <!-- Ads Archive -->
                  <div class="posts-masonry">
                     <div class="col-md-12 col-xs-12 col-sm-12">

                        <!-- Ads Listing -->
                        <div class="ads-list-archive">
                           <!-- Image Block -->
                           <div class="col-lg-5 col-md-5 col-sm-5 no-padding">
                              <!-- Img Block -->
                              <div class="ad-archive-img">
                                 <a href="#"> <img class="img-responsive" src="images/posting/1.jpg" alt=""> </a>
                              </div>
                              <!-- Img Block -->
                           </div>
                           <!-- Ads Listing -->
                           <div class="clearfix visible-xs-block"></div>
                           <!-- Content Block -->
                           <div class="col-lg-7 col-md-7 col-sm-7 no-padding">
                              <!-- Ad Desc -->
                              <div class="ad-archive-desc">
                                 <!-- Price -->
                                 <div class="ad-price">$350</div>
                                 <!-- Title -->
                                 <h3>Sony Xperia Z5 Waterproof</h3>
                                 <!-- Category -->
                                 <div class="category-title"> <span><a href="#">Mobiles</a></span> </div>
                                 <!-- Short Description -->
                                 <div class="clearfix visible-xs-block"></div>
                                 <p class="hidden-sm">Lorem ipsum dolor sit amet, quem convenire interesset ut vix, maiestatis inciderint no, eos in elit dicat.....</p>
                                 <!-- Ad Features -->
                                 <ul class="add_info">
                                    <!-- Contact Details -->
                                    <li>
                                       <div class="custom-tooltip tooltip-effect-4">
                                          <span class="tooltip-item"><i class="fa fa-phone"></i></span>
                                          <div class="tooltip-content">
                                             <h4>Call Timings</h4>
                                             <strong>Monday to Friday</strong> 09.00 AM - 5.30 PM
                                             <br> <strong>Saturday</strong> 09.00 AM - 5.30 PM
                                             <br> <strong>Sunday</strong> <span class="label label-success">+92-123-4567</span>
                                          </div>
                                       </div>
                                    </li>
                                    <!-- Address -->
                                    <li>
                                       <div class="custom-tooltip tooltip-effect-4">
                                          <span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
                                          <div class="tooltip-content">
                                             <h4>Address</h4>
                                             Musee du Louvre, 75058 Paris - France
                                          </div>
                                       </div>
                                    </li>
                                    <!-- Ad Type -->
                                    <li>
                                       <div class="custom-tooltip tooltip-effect-4">
                                          <span class="tooltip-item"><i class="fa fa-cog"></i></span>
                                          <div class="tooltip-content"> <strong>Condition</strong> <span class="label label-danger">Used</span> </div>
                                       </div>
                                    </li>
                                    <!-- Ad Type -->
                                    <li>
                                       <div class="custom-tooltip tooltip-effect-4">
                                          <span class="tooltip-item"><i class="fa fa-check-square-o"></i></span>
                                          <div class="tooltip-content"> <strong>Warrinty</strong> <span class="label label-danger">No </span> </div>
                                       </div>
                                    </li>
                                 </ul>
                                 <!-- Ad History -->
                                 <div class="clearfix archive-history">
                                    <div class="last-updated">Last Updated: 1 day ago</div>
                                    <div class="ad-meta"> <a class="btn save-ad"><i class="fa fa-heart-o"></i> Save Ad.</a> <a class="btn btn-success"><i class="fa fa-phone"></i> View Details.</a> </div>
                                 </div>
                              </div>
                              <!-- Ad Desc End -->
                           </div>
                           <!-- Content Block End -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Latest Ads End =-=-=-=-=-=-= -->
            </div>
            <!-- Right Sidebar -->
            <div class="col-md-4 col-xs-12 col-sm-12">
               <!-- Sidebar Widgets -->
               <div class="sidebar">
                  <!-- Contact info -->
                  <div class="contact white-bg">
                     <!-- Email Button trigger modal -->
                     <button class="btn-block btn-contact contactEmail" data-toggle="modal" data-target=".price-quote">contactar al vendedor</button>
                     <!-- Email Modal -->
                     <button class="btn-block btn-contact contactPhone number"><?= $this->session->userdata('phone'); ?><span></span></button>
                  </div>
                  <!-- Price info block -->
                  <div class="ad-listing-price">
                     <p>Rs. 22,000</p>
                  </div>
                  <!-- User Info -->
                  <div class="white-bg user-contact-info">
                     <div class="user-info-card">
                        <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                           <img src="images/users/3.jpg" alt="">
                        </div>
                        <div class="user-information no-padding col-md-8 col-sm-9 col-xs-8">
                           <span class="user-name"><a class="hover-color"><?= $this->session->userdata('name'); ?></a></span>
                           <div class="item-date">
                              <span class="ad-pub">Published on: 10 Dec 2017</span><br>
                              <a href="#" class="link">More Ads</a>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="ad-listing-meta">
                        <ul>

                           <li>Categories: <span class="color">Used Cars</span></li>
                           <li>Visits: <span class="color">9</span></li>
                           <li id="direccion">Location: <span class="color">New York, USA</span></li>
                        </ul>
                     </div>
                     <!--mapa -->
                     <br>
                     <div id="map" class="google-maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d89553.25418528763!2d9.19406272678945!3d45.458941223623455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c1493f1275e7%3A0x3cffcd13c6740e8d!2sMilan!5e0!3m2!1sen!2s!4v1403031740860" width="370" height="150"></iframe>
                     </div>
                  </div>

                  <!-- Recent Ads -->
                  <div class="widget">
                     <div class="widget-heading">
                        <h4 class="panel-title"><a>Recent Ads</a></h4>
                     </div>
                     <div class="widget-content recent-ads">


                        <!-- Ads -->
                        <div class="recent-ads-list">
                           <div class="recent-ads-container">
                              <div class="recent-ads-list-image">
                                 <a href="#" class="recent-ads-list-image-inner">
                                    <img src="images/posting/thumb-5.jpg" alt="">
                                 </a><!-- /.recent-ads-list-image-inner -->
                              </div>
                              <!-- /.recent-ads-list-image -->
                              <div class="recent-ads-list-content">
                                 <h3 class="recent-ads-list-title">
                                    <a href="#">Apple Wrist Watches</a>
                                 </h3>
                                 <ul class="recent-ads-list-location">
                                    <li><a href="#">New York</a>,</li>
                                    <li><a href="#">Brooklyn</a></li>
                                 </ul>
                                 <div class="recent-ads-list-price">
                                    $ 20,000
                                 </div>
                                 <!-- /.recent-ads-list-price -->
                              </div>
                              <!-- /.recent-ads-list-content -->
                           </div>
                           <!-- /.recent-ads-container -->
                        </div>
                     </div>
                  </div>

               </div>
               <!-- Sidebar Widgets End -->
            </div>
            <!-- Middle Content Area  End -->
         </div>
         <!-- Row End -->
      </div>
      <!-- Main Container End -->
   </section>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jIY1DdGJ7yWZrPDmhCiupu_K2En_4HY&amp;callback=initMap"></script>

   <script type="text/javascript">
      function initMap() {
         var lat = '<?php echo $all_anuncios->lat; ?>';
         var lng = '<?php echo $all_anuncios->lng; ?>';
         getReverseGeocodingData(lat, lng);
         var location = {
            lat: parseFloat(lat),
            lng: parseFloat(lng)
         };
         var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: location,
            scrollwheel: false
         });
         var marker = new google.maps.Marker({
            position: location,
            map: map

         });



         /*  map.addListener('click', function(e) {
    placeMarkerAndPanTo(e.latLng, map);
  });*/


      }

      setTimeout(function() {
         $("#form-messages").fadeOut(1500);
      }, 3000);

      function getReverseGeocodingData(lat, lng) {

         var latlng = new google.maps.LatLng(lat, lng);
         // This is making the Geocode request
         var geocoder = new google.maps.Geocoder();
         geocoder.geocode({
            'latLng': latlng
         }, function(results, status) {
            if (status !== google.maps.GeocoderStatus.OK) {
               alert(status);
            }
            // This is checking to see if the Geoeode Status is OK before proceeding
            if (status == google.maps.GeocoderStatus.OK) {

               var address = (results[0].formatted_address);
               $('#direccion').html("Direccion:<span class='color'>" + address + "</span>");
            }
         });
      }
      /* varios marcadores
      function placeMarkerAndPanTo(latLng, map) {
        var marker = new google.maps.Marker({
          position: latLng,
          map: map
        });
        map.panTo(latLng);
      }
      */
   </script>