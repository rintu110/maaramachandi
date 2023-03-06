<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1>Product Listing</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li>Product Listing</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

<!-- Sidebar Page Container -->
    <div class="sidebar-page-container product-shop">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div class="row clearfix">

                      <?php
                        //print_result($prdlist);exit;
                        if(is_array($prdlist) && sizeof($prdlist) > 0)
                        {
                           foreach ($prdlist as $k => $v) 
                           {
                              if($v->post_img !='')
                              {
                                  $img = base_url('post/').$v->post_img;  
                              }
                              else
                              {
                                   $img = base_url('frontassets/img/no-image.png');
                              }

                              $Cat_URL = $this->Category_m->GetCatURL($v->cat_id,'Product');
                      ?>

                        <!--Shop Item-->
                        <div class="services-block-two col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="<?=base_url('product/').$Cat_URL->slug_url.'/'.$v->slug_url?>">
                                        <img src="<?=$img?>" alt="<?=$v->post_name?>" />
                                    </a>
                                </div>
                                <div class="lower-content">
                                    <h3>
                                        <a href="<?=base_url('product/').$Cat_URL->slug_url.'/'.$v->slug_url?>">
                                            <?=$v->post_name?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--Shop Item-->
                    <?
                           }
                        }
                    ?>  

                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <!-- Search -->
                        <div class="sidebar-widget search-box">
                            <form method="post" action="<?=base_url('search')?>" autocomplete="off">
                                <div class="form-group">
                                   <input type="search" name="term" value="<?=(isset($_GET['term']) && $_GET['term'] !='')?$_GET['term']:''?>" placeholder="Search Product..." required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar-widget categories-widget">
                            
                            <div class="widget-content">
                                <div class="sidebar-title">
                                <h2>Product Categories</h2>
                                <div class="seperater"></div>
                            </div>
                                <ul class="blog-cat">
                                    <?php echo CATLIST('pg');?>                                     
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>