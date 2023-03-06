<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1>Products</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li>Products</li>
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
            <div class="content-side col-lg-12 col-md-12 col-sm-12">
                <div class="row clearfix">
            <?
            if(is_array($prd_catlist) && sizeof($prd_catlist) > 0)
            {           
                 foreach ($prd_catlist as $k => $v) 
                 {
                    if($v->post_img !='')
                    {
                        $img = base_url('post/').$v->post_img;  
                    }
                    else
                    {
                         $img = base_url('frontassets/img/no-image.png');
                    }
                ?>      
                 <div class="services-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="<?=base_url('product/').$v->slug_url?>">
                                <img src="<?=$img?>" alt="<?=$v->cat_name?>" />
                            </a>
                        </div>
                        <div class="lower-content">
                            <h3>
                                <a href="<?=base_url('product/').$v->slug_url?>">
                                   <?=ucwords($v->cat_name)?>
                                </a>
                            </h3>
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
    </div>    
</section>
<!--End Blog single Area-->