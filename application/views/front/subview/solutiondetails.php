<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<div class="banner banner-static banner-medium has-bg lighter-filter has-bg-image">
  <div class="banner-cpn">
    <div class="container">
      <div class="content row">
        <div class="banner-text light style-modern">
          <h1 class="page-title">Solution</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="banner-bg imagebg bg-image-loaded" >
    <img src="<?=base_url('frontassets/')?>img/banner-bg-2.jpg" alt="">
  </div>
</div>


<section id="blog" class="blog" style="margin-top: 60px;">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
                <?
                if($newsdata->news_dtls_bnr !='')
                {
              ?>
              <div class="entry-img">
                <img src="<?=base_url('post/').$newsdata->news_dtls_bnr;?>" alt="<?=$newsdata->post_name?>" class="img-fluid">
              </div>
              <?
                }
              ?>

              <h2 class="entry-title">
                <?=$newsdata->post_name?>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center">
                     <i class="fa fa-user"></i> 
                      <?=$newsdata->posted_by?>
                  </li>
                  <li class="d-flex align-items-center">
                    <i class="fa fa-clock-o"></i> 
                      <time datetime="<?=date('Y-m-d',strtotime($newsdata->posted_on))?>"><?=date('M d, Y',strtotime($newsdata->posted_on))?></time>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Hits: <?=$newsdata->hits?></small>
                  </li>
                  <!-- <li class="d-flex align-items-center">
                    <i class="fa fa-comment"></i> 
                       <a href="blog-single.html">12 Comments</a>
                   </li> -->
                </ul>
              </div>

              <div class="entry-content">
                 <?=$newsdata->full_desc?>               
              </div>
            </article>

            <div class="blog-comments">
              <div class="reply-form">
                <h4>Contact Us</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form method="post" name="frm_soln" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" placeholder="Your Name*" required="required">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="email" class="form-control" placeholder="Your Email*" required="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input name="subject" type="text" class="form-control" placeholder="Your Subject" readonly="readonly" value="<?=$newsdata->post_name?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <textarea name="message" class="form-control" placeholder="Your Comment*" required="required"></textarea>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12 form-group">
                       <div class="g-recaptcha" data-sitekey="6LfhLpIaAAAAAEhYevTpt0eA36QSnclMUungcC6M"></div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
              </div>
            </div><!-- End blog comments -->
          </div><!-- End blog entries list -->

          <div class="col-lg-4">
            <div class="sidebar">
              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">

               <?
                if(is_array($recentpost) && sizeof($recentpost) > 0)
                {
                    foreach ($recentpost as $k => $v) 
                    {
                        $img = base_url('post/').$v->post_img;
               ?>
                          <div class="post-item clearfix">
                              <img src="<?=$img?>" alt="<?=$v->post_name?>">
                              <h4>
                                 <a href="<?=base_url('solution/').$v->slug_url?>">
                                     <?=$v->post_name?>
                                 </a>
                              </h4>
                              <time datetime="<?=date('Y-m-d',strtotime($v->posted_on))?>">
                                  <?=date('M d, Y',strtotime($v->posted_on))?>&nbsp;&nbsp;Hits: <?=$v->hits?>
                              </time>
                          </div>
               <?          
                    }
                }               
               ?>                
              </div>
              </div>


           <div class="sidebar-right">
            <div class="wgs-box wgs-menus">
              <div class="wgs-content">
                <ul class="list list-grouped">
                  <li class="list-heading">
                    <span>Our Products</span>
                    <ul>
                     <?php
                       echo CATLIST();
                      ?>      
                    </ul>
                  </li>
                </ul>                 
              </div>
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
