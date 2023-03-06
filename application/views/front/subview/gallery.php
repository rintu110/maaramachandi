 <!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
     <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?=base_url('frontassets/')?>images/bg_banner_2.jpg" style="background-image: url('<?=base_url('frontassets/')?>images/bg_banner_2.jpg');">
      <div class="container pt-50 pb-30">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-12">
              <h2 class="text-center text-white font-30 mt-20">Image Gallery</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">             
              <div class="portfolio-filter">
                <a href="#" class="active" data-filter="*">All</a>
                <a href="#Temple" class="" data-filter=".Temple">Temple</a>
                <a href="#Construction" class="" data-filter=".Construction">Construction</a>
                <a href="#Other" class="" data-filter=".Other">Other</a>
              </div>            

              <!-- Portfolio Gallery Grid -->
              <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">                
                <?php
                  if(is_array($gallery) && sizeof($gallery,1) > 0)
                  {
                      foreach($gallery as $v)
                      {
                          $thumb_img = base_url('gallery_img/thumb/').$v->gallery_img;
                          $img = base_url('gallery_img/').$v->gallery_img;
                ?>
                           <div class="gallery-item <?=$v->cat_name?>">
                              <div class="thumb">
                                <img class="img-fullwidth" src="<?=$thumb_img?>" alt="<?=$v->img_tag?>">
                                <div class="overlay-shade"></div>
                                <div class="text-holder">
                                  <div class="title text-center"><?=$v->img_tag?></div>
                                </div>
                                <div class="icons-holder">
                                  <div class="icons-holder-inner">
                                    <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                      <a href="<?=$img?>" data-lightbox-gallery="gallery" title="Your Title Here">
                                        <i class="fa fa-picture-o"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>

                <?           
                      }
                  }

                ?>              
               
              </div>
              <!-- End Portfolio Gallery Grid -->
            </div>
          </div>
        </div>
      </div>
    </section>

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