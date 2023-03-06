<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1><?=$prddata->post_name?></h1>
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
    <!--End Page Title-->

<!-- Sidebar Page Container -->
    <div style="padding-bottom: 0;" class="sidebar-page-container product-shop">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <!-- Search -->
                        <div class="sidebar-widget search-box">
                            <form method="get" action="<?=base_url('search')?>" autocomplete="off">
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

                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="services-detail-section">
        
            <div class="lower-content">
                <div class="row">
                    <div class="col-lg-6">  
                    <?
                        if(is_array($gallery) && sizeof($gallery) > 0)
                        {
                    ?>
                              <div class="bd2">
                                <div class="testimonial-carousel owl-carousel owl-theme">
                                  <?php
                                      foreach($gallery as $v)
                                      {

                                        $img = base_url('gallery_img/').$v->gallery_img;
                                        $img_tag = ($v->img_tag !='')?$v->img_tag:'';
                                  ?>    
                                         <div class="slide">
                                            <div class="image">
                                                <img src="<?=$img?>" alt="<?=$img_tag?>" />
                                            </div>
                                         </div>    
                                  <?php       
                                      }
                                   ?>                                     
                                </div>
                             </div>
                    <?        

                        }
                        else
                        {
                    ?>
                          <div class="bd2">
                              <img src="<?=base_url('frontassets/')?>images/resource/service-1.jpg" alt="" />
                          </div>  
                    <?        
                        }
                    ?>
                     </div>                 

                    <div class="col-lg-6">
                        <h2><?=$prddata->post_name?></h2>
                     <div class="text">
                       <p><?=$prddata->side_desc?></p>
                    
                        <div class="btn-box">
                            <a href="<?=base_url('enquiry?term='.$prddata->slug_url)?>" class="theme-btn btn-style-1"><span class="txt"> Inquiry Now</span></a>
                            <a href="mailto:<?=$Site_Settings->web_email?>" class="theme-btn btn-style-1"><span class="txt">Send Email</span></a>
                            <a href="#" class="theme-btn btn-style-1"><span class="txt">Download PDF</span></a>
                        </div>                        
                     </div>
                    </div>
                </div>                

                <!--Services Info Tabs-->
                <div class="services-info-tabs">
                    <!--Service Tabs-->
                    <div class="service-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn active-btn">Description</li>
                            <li data-tab="#prod-spec" class="tab-btn">Inquiry Us</li>                            
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">
                            <!--Tab / Active Tab-->
                            <div class="tab active-tab" id="prod-details">
                                <div class="content">
                                   <?=$prddata->full_desc?>
                                </div>
                            </div>

                            <!--Tab-->
                            <div class="tab" id="prod-spec">
                                <div class="content">  
                                    <!-- Form Column -->
                                    <div class="form-column">
                                        <div class="inner-column">
                                            <!-- Sec Title -->
                                            <div class="sec-title">
                                                
                                                <h2>Enter Your Inquiry</h2>
                                                <div class="seperater style-two"></div>
                                            </div>

                                            <!-- Default Form -->
                                            <div class="default-form">
                                                <form method="post">
                                                    <div class="row clearfix">

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">  
                                                            <input type="text" name="post_name" placeholder="Product Name" value="<?=$prddata->post_name?>" readonly required="">
                                                            <span class="icon fa fa-user"></span>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <input type="text" name="name" placeholder="Full Name" required="">
                                                            <span class="icon fa fa-user"></span>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                            <input type="email" name="email" placeholder="Email" required="">
                                                            <span class="icon fa fa-envelope"></span>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                            <input type="tel" name="phonenumber" placeholder="Phone No" required="">
                                                            <span class="icon fa fa-phone"></span>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <input type="text" name="subject" placeholder="Subject" required="">
                                                            <span class="icon fa fa-user"></span>
                                                        </div>                                                      

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <textarea name="message" placeholder="Message"></textarea>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                             <div class="g-recaptcha" data-sitekey="<?=$Site_Key?>"></div>
                                                        </div>    

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <button class="theme-btn btn-style-four" type="submit" name="submit-form"><span class="txt">Submit Now</span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
                <!--End Product Info Tabs-->
            </div>
           </div>
          </div>
         </div>
        </div>
    </div>  
<!-- Services Section -->
    <section class="services-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <!-- <div class="title">Industry SERVICES</div> -->
                <h2>Our Related Products</h2>
                <div class="seperater style-two"></div>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme">

              <?
                if(is_array($relprd) && countz($relprd) > 0)
                {  
                    foreach ($relprd as $v)
                    {
                         $img = base_url('post/').$v->post_img;                        
              ?>
                <!-- Services Block Two -->
                <div class="services-block-two">
                    <div class="inner-box">
                        <div class="image">
                            <img src="<?=$img?>" alt="<?=$v->post_name?>" />
                        </div>
                        <div class="lower-content">
                            <h3>
                                <a href="<?=base_url('product/').$category->slug_url.'/'.$v->slug_url?>">
                                    <?=$v->post_name?>                                        
                                </a>
                            </h3>                          
                        </div>
                    </div>
                </div>
                <?
                    }

                 }   
                ?> 
            </div>
        </div>
    </section>
    <!-- End Services Section -->   