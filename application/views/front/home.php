<?php
    $this->load->view('front/inc/metaheader');
?>
  <body class="">
   <div id="wrapper">
 <?     
    //$this->load->view('front/inc/loader');
    $this->load->view('front/inc/navbar');
?>         
  <div class="main-content">
<?php
    $this->load->view('front/inc/slider');
?>

   <section id="services" class="bg-lighter">
      <div class="container pb-60">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="title text-black-666">Maa <span class="text-theme-colored"> Ramchandi Temple</span></h2>
              
            </div>
          </div>
        </div>
        <div class="row mtli-row-clearfix">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="service-block">
              <div class="thumb">
                <img src="<?=base_url('frontassets/')?>images/services/1.jpg" class="img-fullwidth" alt="">               
              </div>
              <div class="content">
                <h4 class="mt-0 text-black">Yearly Events</h4>
                  <div class="mt-10"> <a href="#" class="btn btn-theme-colored btn-sm">Read More</a> </div>
              </div>
            </div>          
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="service-block">
              <div class="thumb">
                <img src="<?=base_url('frontassets/')?>images/services/2.jpg" class="img-fullwidth" alt="">
              </div>
              <div class="content">
                <h4 class="mt-0 text-black">Upcoming Events</h4>
                  <div class="mt-10"> <a href="#" class="btn btn-theme-colored btn-sm">Read More</a> </div>
              </div>
            </div>          
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="service-block">
              <div class="thumb">
                <img src="<?=base_url('frontassets/')?>images/services/3.jpg" class="img-fullwidth" alt="">
              </div>
              <div class="content">
                <h4 class="mt-0 text-black">Maha Bhog</h4>
                  <div class="mt-10"> <a href="#" class="btn btn-theme-colored btn-sm">Read More</a> </div>
              </div>
            </div>          
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="service-block">
              <div class="thumb">
                <img src="<?=base_url('frontassets/')?>images/services/4.jpg" class="img-fullwidth" alt="">               
              </div>
              <div class="content">
                <h4 class="mt-0 text-black">Occassional Program</h4>
                  <div class="mt-10"> <a href="#" class="btn btn-theme-colored btn-sm">Read More</a> </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </section>


    <section class="bg-silver-light">
      <div class="container pb-40">
        <div class="section-title text-center mt-0">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1">What Can <span class="text-theme-colored"> We Do?</span></h2>              
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-make-an-online-donation text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Give Donation</h4>                  
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-shaking-hands-inside-a-heart text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Provide Rent</h4>                 
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-hand-holding-a-gift text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Temple Development</h4>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-dove-of-peace-1 text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Socialism</h4>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> 
                <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-shelter text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Build House</h4>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="icon-box bg-white left media border-3px bg-hover-theme-colored mb-30 p-30 pb-20"> <a class="media-left pull-left flip" href="#"><i class="flaticon-charity-food-donation-1 text-theme-colored"></i></a>
                <div class="media-body">
                  <h4 class="media-heading heading text-uppercase">Provide Prasad</h4>                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   

    
    <!-- Section: Project Start Form -->
    <section class="divider parallax layer-overlay overlay-dark-8" data-bg-img="images/bg/bg4.jpg">
      <div class="container-fluid">
        <div class="row equal-height">
          <div class="col-md-4 col-md-offset-1">
            <h3 class="bg-theme-colored p-15 pl-30 mb-0 text-white">Become a Volunteer</h3>
            <form id="volunteer_apply_form" class="bg-light p-30 pb-15" name="job_apply_form" action="includes/become-volunteer.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_name">Name <small>*</small></label>
                    <input id="form_name" name="form_name" type="text" placeholder="Enter Name" required="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_email">Email <small>*</small></label>
                    <input id="form_email" name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">               
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_sex">Gender <small>*</small></label>
                    <select id="form_sex" name="form_sex" class="form-control required">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="form_branch">Contact No <small>*</small></label>
                    <input name="contact_no" class="form-control required" type="text" placeholder="Enter Contact No">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="form_message">Message <small>*</small></label>
                <textarea id="form_message" name="form_message" class="form-control required" rows="3" placeholder="Your cover letter/message sent to the employer"></textarea>
              </div>             
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Submit</button>
              </div>
            </form>           
          </div>
          <div class="col-md-6 hidden-xs">
            <div class="p-50">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-50 text-white">
                <div class="funfact text-center">
                  <div class="funfact-content">
                    <div class="funfact-icon">
                      <i class="pe-7s-smile font-50 text-white"></i>
                    </div>
                    <h2 data-animation-duration="2000" data-value="754" class="animate-number text-theme-colored font-30 mt-10">0</h2>
                    <h4 class="text-uppercase text-white">Happy Donations</h4>
                  </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-50 text-white">
                <div class="funfact text-center">
                  <div class="funfact-content">
                    <div class="funfact-icon">
                      <i class="pe-7s-rocket font-50 text-white"></i>
                    </div>
                    <h2 data-animation-duration="2000" data-value="4469" class="animate-number text-theme-colored font-30 mt-10">0</h2>
                    <h4 class="text-uppercase text-white">Success Mission</h4>
                  </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-md-50 text-white mt-20">
                <div class="funfact text-center">
                  <div class="funfact-content">
                    <div class="funfact-icon">
                      <i class="pe-7s-add-user font-50 text-white"></i>
                    </div>
                    <h2 data-animation-duration="2000" data-value="324" class="animate-number text-theme-colored font-30 mt-10">0</h2>
                    <h4 class="text-uppercase text-white">Volunteer Reached</h4>
                  </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-md-50 text-white mt-20">
                <div class="funfact text-center">
                  <div class="funfact-content">
                    <div class="funfact-icon">
                      <i class="pe-7s-global font-50 text-white"></i>
                    </div>
                    <h2 data-animation-duration="2000" data-value="698" class="animate-number text-theme-colored font-30 mt-10">0</h2>
                    <h4 class="text-uppercase text-white">Globalization Work</h4>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
       

  </div>
  
 <?php
    $this->load->view('front/inc/footer');
?>
  </div>
  <?php 
    $this->load->view('front/inc/footer_js');
 ?>

</body>
</html> 