<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?=base_url('frontassets/')?>images/breadcrumb/breadcrumb-1.jpg);">
    
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="<?=base_url()?>">Home</a></li>
                            <li class="active"><?=$content->pg_name?></li>
                        </ul>    
                    </div>
                    
                    <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                       <h2><?=$content->pg_name?></h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<section class="about-style1-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="about-style1-text-box">
                    <div class="sec-title">
                        <h2><span><?=$content->pg_name?></span></h2>
                    </div>
                    <div class="inner-contant">
                        <div class="text-box">
                            <?=$content->full_desc?>
                        </div>
                    </div>    
                </div>
            </div>
        </div> 
    </div>    
</section>