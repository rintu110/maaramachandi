  <div class="main-content">    
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-50 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Committee Members</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-content">
          <div class="row mb-30">
            <?php
              if(is_array($Committee) && sizeof($Committee,1) > 0)
              {
                  foreach($Committee as $v)
                  {

                        if($v->img !='')
                        {
                            $img = base_url('post/members/').$v->img;
                        }
                        else
                        {
                             $img = base_url('post/members/male_default.png');
                        }
                        
            ?>
                      <div class="col-md-2">
                        <div class="team-member">
                          <div class="thumb">
                            <img alt="<?=$v->name?>" src="<?=$img?>" class="img-fullwidth">
                          </div>
                          <div class="info">
                            <h6 class="mb-0"><?=$v->name?> 
                            <br><small><?=$v->desg?></small></h6>
                          </div>
                        </div>
                      </div>
            <?php        
                  }
              }
            ?>             
          </div>            
        </div>
      </div>
    </section>

    <!-- Divider: Call To Action  -->
    <section class="bg-theme-colored">
      <div class="container pt-0 pb-0">
          <div class="call-to-action sm-text-center">
          <div class="row">
            <div class="col-md-9">
              <h3 class="mt-5 text-white">Maa Ramachandi Temple Trust</h3>
            </div>
            <div class="col-md-3 text-right flip sm-text-center"> 
              <a href="tel:7684982330" class="btn btn-default btn-circled btn-lg mt-5">Call Now<i class="fa fa-angle-double-right font-16 ml-10"></i></a> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>