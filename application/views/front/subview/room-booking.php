 <script src='https://www.google.com/recaptcha/api.js' async defer></script>

 <!-- Start main-content -->
  <div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Room Booking</h2>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Section: Donation -->
    <section id="donation">
      <div class="container mt-0 pt-50">
        <div class="section-content">
          <div class="row">
           
            <div class="col-md-12 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
              <h3 class="title text-black-666 line-bottom">Book Your Room <span class="text-theme-colored"> Now!</span></h3>
              <form method="post">
                <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label><strong>Booking Type</strong>  <span class="red">*</span></label> <br>
                      <select name="booking_type" class="form-control input-sm">
                        <option value="0">--select--</option>
                         <option value="1">Room Booking</option>
                         <option value="2">Mandap Booking</option>
                      </select>
                     </div> 
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><strong>Tent Booking</strong></label> <br>
                      <label class="radio-inline">
                        <input type="radio" value="1" name="tent_booking" checked="checked"> 
                        No
                      </label>
                      <label class="radio-inline">
                        <input type="radio" value="2" name="tent_booking"> 
                        Yes
                      </label>
                    </div>
                  </div>  
                   <div class="col-md-4">
                    <div class="form-group">
                      <label><strong>Advance Booking</strong></label> <br>
                      <label class="radio-inline">
                        <input type="radio" value="1" name="adv_booking" > 
                        No
                      </label>
                      <label class="radio-inline">
                        <input type="radio" value="2" name="adv_booking" checked="checked"> 
                        Yes
                      </label>
                    </div>
                  </div>  
                </div>
                  <div class="row">
                  <div class="col-md-4">
                     <div class="form-group form-group-sm">
                      <label><strong>Name</strong>  <span class="red">*</span></label> <br>
                       <input type="text" name="name" class="form-control" maxlength="30" />
                     </div> 
                  </div> 
                  <div class="col-md-4">
                     <div class="form-group  form-group-sm">
                      <label><strong>Email</strong></label> <br>
                       <input type="email" name="email" class="form-control" maxlength="30" />
                     </div> 
                  </div>  
                   <div class="col-md-4">
                     <div class="form-group  form-group-sm">
                        <label><strong>Cotnact No</strong>  <span class="red">*</span></label> <br>
                        <input type="text" name="mobile" class="form-control" maxlength="10" />
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group  form-group-sm">
                        <label><strong>From Date</strong>  <span class="red">*</span></label> <br>
                        <input type="text" name="from_dt" class="form-control date-picker" maxlength="10" readonly="readonly" />
                     </div>
                   </div> 
                    <div class="col-md-4">
                     <div class="form-group  form-group-sm">
                        <label><strong>To Date</strong>  <span class="red">*</span></label> <br>
                        <input type="text" name="to_dt" class="form-control date-picker" maxlength="10" readonly="readonly" />
                     </div>
                   </div>   
                  <div class="col-sm-2">
                    <div class="form-group  form-group-sm">
                      <label><strong>No Of Person</strong>  <span class="red">*</span></label>
                      <select name="no_of_person" class="form-control">
                        <?php
                          for ($i=1; $i <= 20; $i++) 
                          { 
                         ?>
                            <option value="<?=$i?>"><?=$i?></option> 
                         <?php   
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-6">
                     <div class="form-group form-group-sm">
                        <label><strong>Purpose</strong>  <span class="red">*</span></label> <br>
                        <input type="text" name="purpose" class="form-control" maxlength="30" />
                     </div>
                   </div>

                  <div class="col-md-6">
                     <div class="form-group form-group-sm">
                      <label><strong>Adhaar OR PAN Card No</strong></label> <br>
                       <input type="text" name="adhaar_pan" class="form-control" maxlength="12" />
                     </div> 
                  </div> 

                    <div class="col-md-6">
                     <div class="form-group form-group-sm">
                        <label><strong>Address</strong></label> <br>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                     </div>
                   </div>                  
                  

                  <div class="col-md-6">
                     <div class="form-group form-group-sm">
                        <label><strong>Additional Information ( If any )</strong></label> <br>
                        <textarea name="add_info" class="form-control" rows="3"></textarea>
                     </div>
                   </div> 

                    <div class="col-md-12">
                     <div class="form-group">
                       <div class="g-recaptcha" data-sitekey="<?=$Site_Settings->c_site_key?>"></div>            
                     </div>
                   </div>                       

                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30" data-loading-text="Please wait...">Request</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>          
          </div>
        </div>
      </div>
    </section>
  </div>