 <script src='https://www.google.com/recaptcha/api.js' async defer></script>
 <!-- Start main-content -->
  <div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Mandap Booking</h2>
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
           
            <div class="col-md-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
              <h3 class="title text-black-666 line-bottom">Book Mandap <span class="text-theme-colored"> Now!</span></h3>
              <form method="post">
                <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                      <label><strong>Name</strong></label> <br>
                       <input type="text" name="name" class="form-control" maxlength="30" />
                     </div> 
                  </div> 
                  <div class="col-md-12">
                     <div class="form-group">
                      <label><strong>Email</strong></label> <br>
                       <input type="email" name="email" class="form-control" maxlength="30" />
                     </div> 
                  </div>  
                   <div class="col-md-6">
                     <div class="form-group">
                        <label><strong>Cotnact No</strong></label> <br>
                        <input type="text" name="mobile" class="form-control" maxlength="10" />
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label><strong>Date Of Booking</strong></label> <br>
                        <input type="text" name="dob" class="form-control date-picker" maxlength="8" readonly="readonly" />
                     </div>
                   </div>   
                  <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <label><strong>No Of Person</strong></label>
                      <select name="nop" class="form-control">
                        <option value="1-100">1-100</option>
                        <option value="1-250">1-250</option>
                        <option value="1-500">1-500</option>
                        <option value="1-1000">1-1000</option>
                        <option value="Above ">1000</option>
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
                     <div class="form-group">
                        <label><strong>Purpose</strong></label> <br>
                        <input type="text" name="purpose" class="form-control" maxlength="30" />
                     </div>
                   </div>
                   
                    <!-- <div class="col-md-12">
                     <div class="form-group">
                      <label><strong>Room Type</strong></label> <br>
                       <select name="room_type" class="form-control">
                        <option value="Single Bed">Single Bed</option>
                        <option value="Double Bed">Double Bed</option>
                        <option value="Triple Bed">Triple Bed</option>                        
                      </select>
                     </div> 
                  </div> 
 -->

                    <div class="col-md-12">
                     <div class="form-group">
                        <label><strong>Address</strong></label> <br>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                     </div>
                   </div>

                   <div class="col-md-12">
                     <div class="form-group">
                      <label><strong>Adhaar OR PAN Card No</strong></label> <br>
                       <input type="text" name="adhaar_Pan" class="form-control" maxlength="12" />
                     </div> 
                  </div> 
                   
                  <div class="col-md-12">
                    <div class="form-group mb-20">
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
                   <div class="col-md-12">
                    <div class="form-group mb-20">
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

                  <div class="col-md-12">
                     <div class="form-group">
                        <label><strong>Additional Information ( If any )</strong></label> <br>
                        <textarea name="additional" class="form-control" rows="3"></textarea>
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
            <div class="col-md-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
              <h3 class="title text-black-666 line-bottom">Mandap <span class="text-theme-colored"> Model</span></h3>
              <div class="row mt-20 multi-row-clearfix">
                <div class="owl-carousel-2col" data-nav="true">
                  <div class="item">
                      <div class="box-hover-effect effect1 mb-sm-30">
                        <div class="thumb"> <a href="<?=base_url('frontassets/')?>images/room.jpg"><img class="img-fullwidth mb-20" src="<?=base_url('frontassets/')?>images/room.jpg" alt="..."></a> </div>
                        <div class="caption">
                          <h4 class="text-uppercase letter-space-1 mt-0"><span class="text-theme-colored"> Room 1</span></h4>                          
                        </div>
                      </div>
                  </div>
                  <div class="item">
                      <div class="box-hover-effect effect1 mb-sm-30">
                        <div class="thumb"> <a href="<?=base_url('frontassets/')?>images/room.jpg"><img class="img-fullwidth mb-20" src="<?=base_url('frontassets/')?>images/room.jpg" alt="..."></a> </div>
                        <div class="caption">
                          <h4 class="text-uppercase letter-space-1 mt-0"><span class="text-theme-colored"> Room 2</span></h4>                         
                        </div>
                      </div>
                  </div>
                  <div class="item">
                      <div class="box-hover-effect effect1 mb-sm-30">
                        <div class="thumb"> <a href="<?=base_url('frontassets/')?>images/room.jpg"><img class="img-fullwidth mb-20" src="<?=base_url('frontassets/')?>images/room.jpg" alt="..."></a> </div>
                        <div class="caption">
                          <h4 class="text-uppercase letter-space-1 mt-0"><span class="text-theme-colored"> Room 3</span></h4>                           
                        </div>
                      </div>
                  </div>
                  <div class="item">
                      <div class="box-hover-effect effect1 mb-sm-30">
                        <div class="thumb"> <a href="<?=base_url('frontassets/')?>images/room.jpg"><img class="img-fullwidth mb-20" src="<?=base_url('frontassets/')?>images/room.jpg" alt="..."></a> </div>
                        <div class="caption">
                          <h4 class="text-uppercase letter-space-1 mt-0"><span class="text-theme-colored"> Room 4</span></h4>                           
                        </div>
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
  <!-- end main-content -->