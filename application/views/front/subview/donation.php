 <script src='https://www.google.com/recaptcha/api.js' async defer></script>

 <!-- Start main-content -->
  <div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Donation</h2>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Section: Donation -->
    <section id="donation">
      <div class="container mt-0 pt-10">
        <div class="section-content">
          <div class="row">
           
            <div class="col-md-8 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
              <h3 class="title text-black-666 line-bottom">Donate <span class="text-theme-colored"> Now!</span></h3>

              <form method="post">

                <div class="row">
                  <div class="col-md-8">
                     <div class="form-group form-group-sm">
                      <label><strong>Full Name</strong> <span class="red">*</span></label> <br>
                       <input type="text" name="name" class="form-control" maxlength="30" />
                     </div> 
                  </div>

                   <div class="col-md-4">
                     <div class="form-group form-group-sm">
                        <label><strong>Gotra</strong> <span class="red">*</span></label> <br>
                        <input type="text" name="gotra" class="form-control" maxlength="50" />
                     </div>
                   </div> 

                    <div class="col-md-8">
                     <div class="form-group form-group-sm">
                        <label><strong>Email</strong></label> <br>
                        <input type="email" name="email" class="form-control" />
                     </div>
                   </div> 
               
                   <div class="col-md-4">
                     <div class="form-group form-group-sm">
                        <label><strong>Mobile No</strong> <span class="red">*</span></label> <br>
                        <input type="text" name="mobile_no" class="form-control" maxlength="10" minlength="10" />
                     </div>
                   </div> 

                   <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <label><strong>I Want to Donate for</strong></label>
                      <select name="donatefor" class="form-control input-sm">
                        <option value="1">For Temple</option></option>
                        <option value="2">For Construction</option>                        
                        <option value="3">Other</option>                        
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                      <label><strong>How much do you want to donate?</strong> <span class="red">*</span></label>
                       <input type="number" name="d_amount" class="form-control" maxlength="5" />                      
                    </div>
                  </div>

                   <div class="col-sm-12">
                    <div class="form-group">
                      <label><strong>Mode Of Payment</strong> <span class="red">*</span></label>
                      <select name="d_type" class="form-control input-sm">
                        <option value="0">--select--</option>
                        <option value="1">Cash</option></option>
                        <option value="2">UPI</option>                        
                        <option value="3">Bank Transfer</option>                        
                        <option value="4">Other</option>                        
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                     <div class="form-group form-group-sm">
                        <label><strong>Address</strong></label> <br>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                     </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                       <div class="g-recaptcha" data-sitekey="<?=$Site_Settings->c_site_key?>"></div>            
                    </div>
                  </div>                       

                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30">Donate Now</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-4">
             <div class="sidebar sidebar-left mt-sm-30"> 
              <div class="widget">
                <div class="widget-image-carousel">
                  <div class="item">
                    <img src="<?=base_url('assets/img/scan_pay.jpeg')?>" alt="scan and pay">
                    <h4 class="title">Account Details</h4>
                    <p><b>MAA RAMACHANDI TRUST</b></p>
                    <p><b>A/C NO. - 50200065982378</b></p>
                    <p><b>IFSC CODE - HDFC0009001</b></p>
                    <p><b>HDFC BANK, CHATRAPUR</b></p>
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

  <script type="text/javascript">
    
    function validate()
    {

    }
  </script>