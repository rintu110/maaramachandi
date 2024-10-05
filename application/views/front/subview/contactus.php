  <div class="main-content bg-lighter">
  <div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Contact Us</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Contact -->
    <section class="divider">
      <div class="container">
        <div class="row pt-30">
          <div class="col-md-4">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> 
                  <a class="media-left pull-left" href="#"> 
                    <i class="pe-7s-map-2 text-theme-colored"></i>
                  </a>
                  <div class="media-body"> <strong>OFFICE LOCATION</strong>
                    <p><?=$Site_Settings->business_addr?></p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> 
                  <a class="media-left pull-left" href="#"> 
                    <i class="pe-7s-call text-theme-colored"></i>
                  </a>
                  <div class="media-body"> <strong>CONTACT NUMBER</strong>
                    <p>+91 <?=$Site_Settings->prm_contact?></p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> 
                  <a class="media-left pull-left" href="#"> 
                    <i class="pe-7s-mail text-theme-colored"></i>
                  </a>
                  <div class="media-body"> <strong>CONTACT E-MAIL</strong>
                    <p><small><?=$Site_Settings->contact_email?></small></p>
                  </div>
                </div>
              </div>            
            </div>
          </div>
          <div class="col-md-8">
            <!-- <h3 class="line-bottom mt-0 mb-20">Interested in discussing?</h3>           -->
            <!-- Contact Form -->
            <form id="contact_form" name="contact_form" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
                
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
              </div>

              <div class="form-group">
                 <div class="g-recaptcha" data-sitekey="<?=$Site_Settings->c_site_key?>"></div>            
              </div>
             
              <div class="form-group">
                <input name="form_botcheck" class="form-control" type="hidden" value="">
                <button type="submit" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Send Message</button>
                <button type="reset" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
              </div>
            </form>           
          </div>
        </div>
      </div>
    </section>
     <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    
    <!-- Divider: Google Map -->
    <section>
      <div class="container-fluid pt-0 pb-0">
        <div class="row">
          <?=$Site_Settings->map?> 
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->