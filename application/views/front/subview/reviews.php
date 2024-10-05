<!-- Page Title -->
    <section class="page-title" style="background-image: url(<?=base_url('frontassets/')?>images/background/6.jpg)">
        <div class="auto-container">
      <div class="clearfix">
        <div class="pull-left">
          <h3>What Customers Say</h3>
        </div>
        <div class="pull-right">
          <ul class="bread-crumb clearfix">
            <li><a href="<?=base_url()?>">Home</a></li>
            <li>Reviews</li>
          </ul>
        </div>
      </div>
        </div>
    </section>
    <!-- End Page Title -->

   
   <!-- Testimonial Page Section -->
  <section class="testimonial-page-section">
    <div class="auto-container">
      <div class="row clearfix">
        
        <!-- Testimonial Block Two -->
        <?
          if(is_array($reviews) && sizeof($reviews,1) > 0)
          {
               foreach($reviews as $v)
               {
                   $img = base_url().'testimonial_img/'.$v->auth_img;
             
        ?>
        <div class="testimonial-block-two col-lg-12 col-md-12 col-sm-12">
          <div class="inner-box clearfix">
            <div class="row clearfix">
              <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="<?=$img?>" style="width: 100%;" loading="lazy">
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="quote-icon fa fa-quote-left"></div>
                <div class="text">
                  <?=$v->contents?>
                </div>
                <div class="rating">
                  <?
                      for($i = 1;$i <= $v->rating; $i++)
                      {
                          echo '<span class="fa fa-star"></span>';
                      }
                  ?>
                </div>
                 <div class="author-name"><?=ucwords($v->auth_name)?></div>            
              </div>
            </div>            
          </div>
        </div>
        <?php
              }
          }
        ?>        
      </div>
    </div>
  </section>
  <!-- End Testimonial Page Section -->
  