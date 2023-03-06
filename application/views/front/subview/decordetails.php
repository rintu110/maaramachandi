 <!-- Page Title -->
    <section class="page-title" style="background-image: url(images/background/6.jpg)">
        <div class="auto-container">
            <div class="clearfix">
                <div class="pull-left">
                    <h3><?=$prddata->post_name?></h3>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><?=$prddata->post_name?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12">
                    <!--Shop Single-->
                    <div class="shop-section">
                        <div class="our-shops">                            
                            <div class="row clearfix">                                
                                <!-- Shop Item -->
                                <?php
                                    if(is_array($gallery) && sizeof($gallery,1) > 0)
                                    {   
                                          $gl = '';

                                          $first_img = array_search_multidim($gallery,'is_first',1);

                                          $f_tag = ($first_img[0]->img_tag !='')?$first_img[0]->img_tag:'';

                                          $f_img =  base_url('gallery_img/').$first_img[0]->gallery_img;

                                          foreach ($gallery as $v) 
                                          {
                                              $img = base_url('gallery_img/').$v->gallery_img;
                                              $img_tag = ($v->img_tag !='')?$v->img_tag:'';

                                              echo '<div class="single-product-item col-lg-3 col-md-6 col-sm-12 text-center">
                                                         <div class="img-holder">
                                                            <img height="300" src="'.$img.'" class="" alt="'.$img_tag.'" loading="lazy">
                                                        </div>
                                                        <div class="title-holder text-center">
                                                            <div class="static-content">
                                                                <h3 class="title text-center"  class="lightbox-image" title="'.$img_tag.'">
                                                                    <a href="'.$img.'">
                                                                      '.$img_tag.'
                                                                    </a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>';
                                              
                                          }
                                      }
                               ?>                     
                                                                
                            </div>                            
                        </div>
                        
                       <!-- Post Share Options -->
                      <!--   <div class="styled-pagination text-center">
                            <ul class="clearfix">
                                <li class="prev"><a href="#"><span class="fa fa-angle-left"></span> </a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li class="active"><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li class="next"><a href="#"><span class="fa fa-angle-right"></span> </a></li>
                            </ul>
                        </div>   -->                      
                    </div>
                </div>
            </div>
        </div>
    </div> 