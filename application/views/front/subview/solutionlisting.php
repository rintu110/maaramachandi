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
    <img src="<?=base_url('frontassets/')?>img/banner-bg-2.jpg" alt="News">
  </div>
</div>
<div class="section section-news section-pad-sm">
    <div class="container">
      <div class="content row">
      <div class="blog-posts">
        <div class="row">
          <div class="col-md-9 no-pd text-left">

                <?php
                   if(is_array($newslist) && sizeof($newslist) > 0)
                   {
                      foreach ($newslist as $v) 
                      {
                         $img = base_url('post/').$v->post_img;
                 ?>
                        <div class="row" style="margin-bottom: 25px;">
                          <div class="post post-boxed res-s-bttm-lg">
                            <div class="col-md-4">
                              <div class="post-thumbs">
                                <a href="<?=base_url('solution/').$v->slug_url?>">
                                  <img alt="<?=$v->post_name?>" src="<?=$img?>">
                                </a>
                                <div class="post-meta">
                                  <span class="pub-date">
                                    <strong><?=date('d',strtotime($v->posted_on))?></strong> <?=date('M',strtotime($v->posted_on))?></span>
                                </div>
                              </div>
                              </div>
                            <div class="col-md-8">
                              <div c="">
                                <h3>
                                  <a href="<?=base_url('solution/').$v->slug_url?>">
                                     <?=$v->post_name?>
                                  </a>
                                </h3>
                                <p>
                                   <?                        
                                    if(strlen($v->sml_desc) > 113)
                                    {
                                        $str = substr($v->sml_desc,0,110).'....';
                                    }
                                    else
                                    {
                                        $str = $v->sml_desc;
                                    }

                                    echo $str;
                                ?>
                                </p>
                                <a class="btn-link link-arrow-sm" href="<?=base_url('solution/').$v->slug_url?>">Read More</a>
                              </div>
                              </div>
                          </div>
                        </div>
                  <?php
                       }
                    }   
                  ?>
          </div>


         <div class="col-md-3 no-pd text-left">
          <div class="sidebar-right">
            <div class="wgs-box wgs-menus">
              <div class="wgs-content">
                <ul class="list list-grouped">
                  <li class="list-heading">
                    <span>Our Products</span>
                     <?php
                       echo CATLIST();
                      ?>
                  </li>
                </ul>                 
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>