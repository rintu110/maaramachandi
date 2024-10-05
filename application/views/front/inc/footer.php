<!-- Footer -->
  <footer id="footer" class="bg-black-222">
    <div class="container pt-80 pb-30">
      <div class="row border-bottom-black">
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <img class="mb-20" alt="" src="images/logo-sm_1.png">
            <p>Maa RamaChandi Temple</p>
            <p>Niladripur, karapada, Chatrapur, Odisha-761026</p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i> 
                <a class="text-gray" href="tel:<?=$Site_Settings->prm_contact?>">
                  <?=$Site_Settings->prm_contact?>
                </a> 
              </li>
              <li class="m-0 pl-10 pr-10"> 
                <i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a class="text-gray" href="mailto:<?=$Site_Settings->booking_email?>"><?=$Site_Settings->booking_email?></a> </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Useful Links</h5>
            <ul class="list angle-double-right list-border">
              <li><a href="<?=base_url('booking')?>">Booking</a></li>
              <li><a href="<?=base_url('gallery')?>">Gallery</a></li>
              <li><a href="<?=base_url('contact-us')?>">Contact Us</a></li>
              <li><a href="<?=base_url('media-coverage')?>">Media Coverage</a></li>

              <li><a href="<?=base_url('donation')?>">Donate Now</a></li>
            </ul>
          </div>
        </div>      
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Scan & Pay</h5>
             <div class="latest-posts">
               <img src="https://www.maaramachanditemple.com/assets/img/scan_pay.jpeg" width="250" alt="Scan & Pay">
            </div>
          </div>
        </div>
      </div>
     
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright &copy;<?=date('Y')?> <a href="https://www.fabdigitaltech.com/">FabDigitalTech</a>. All Rights Reserved</p>
          </div>
<!--           <div class="col-md-6 text-right">
            <div class="widget no-border m-0">
              <ul class="list-inline sm-text-center mt-5 font-12">              
               <li>
                  <a href="<?=base_url('contact-us')?>">Contact Us</a>
                </li>               
              </ul>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<!-- end wrapper --> 
