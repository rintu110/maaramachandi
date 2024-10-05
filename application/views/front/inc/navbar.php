  <!-- Header -->
  <header class="header">
    <div class="header-top bg-theme-colored sm-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="widget no-border m-0">
              <ul class="styled-icons icon-dark icon-theme-colored icon-sm sm-text-center">
                <li><a href="https://www.facebook.com/maaramachanditemple/"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>               
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>               
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div class="widget no-border m-0">
              <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                <li class="m-0 pl-10 pr-10"> 
                  <i class="fa fa-phone text-white"></i> 
                  <a class="text-white" href="tel:<?=$Site_Settings->prm_contact?>">
                     <?=$Site_Settings->prm_contact?>                      
                  </a> 
                </li>
                <li class="m-0 pl-10 pr-10"> 
                  <i class="fa fa-envelope-o text-white"></i> 
                  <a class="text-white" href="mailto:<?=$Site_Settings->booking_email?>">
                      <?=$Site_Settings->booking_email?>
                  </a> 
                </li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-2">
            <div class="widget no-border m-0">
              <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                <li class="mt-sm-10 mb-sm-10">                  
                  <a class="btn btn-default btn-flat btn-xs bg-light p-5 font-11 pl-10 pr-10" href="<?=base_url('donation')?>">
                      Donate Now
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
          <nav id="menuzord-right" class="menuzord green no-bg">
            <a class="menuzord-brand pull-left flip" href="<?=base_url()?>">
              <img src="<?=base_url('frontassets/')?>images/logo-sm.png" alt="">
            </a>
            <ul class="menuzord-menu">
              <li class="active">
                <a href="<?=base_url()?>">Home</a>               
              </li>
              <li><a href="#">About Us</a>
                <ul class="dropdown">
                  <!-- <li><a href="about-us">About Temple</a></li> -->
                  <li><a href="<?=base_url('trustee-members')?>">Trustee</a></li>
                  <li><a href="<?=base_url('committee-members')?>">Committee Members</a></li> 
                  <li><a href="<?=base_url('temple-mgmt-members')?>">Temple Management</a></li>                  
                  <li><a href="<?=base_url('live-members')?>">Live Members</a></li>                                                                  
                  <!-- <li><a href="<?=base_url()?>development-work">Development Work</a></li>                                                                   -->
                  <li><a href="<?=base_url('donation')?>">Donations</a></li>
                </ul>
              </li>
              <!--  <li><a href="#">Events</a>
                <ul class="dropdown">
                  <li><a href="<?=base_url('yearly-program')?>">Yearly Programme</a></li>
                  <li><a href="<?=base_url('upcoming-events')?>">Upcoming Events</a></li>
                  <li><a href="<?=base_url('occassional-program')?>">Occassionalyy Program</a></li>
                  <li><a href="<?=base_url('maha-bhog')?>">Maha Bhog</a></li>
                  <li><a href="<?=base_url('maha-puja')?>">Maha Puja</a></li>
                </ul>
              </li> -->
              <li>
                <a href="<?=base_url('booking')?>">Booking</a>               
              </li> 
              <li>
                <a href="<?=base_url('media-coverage')?>">Media Coverage</a>               
              </li> 



             
               <li>
                <a href="<?=base_url('gallery')?>">Gallery</a>               
              </li>
               <li>
                <a href="<?=base_url('contact-us')?>">Contact Us</a>               
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>    
  </header>