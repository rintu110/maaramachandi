<script src='https://www.google.com/recaptcha/api.js' async defer></script>


<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1>News</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>News</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-detail">
                        <div class="inner-box">
                            <div class="image">
                                 <?
                                  if($newsdata[0]->news_dtls_bnr !='')
                                 {
                                ?>
                                    <img src="<?=base_url('post/').$newsdata[0]->news_dtls_bnr;?>" alt="<?=$newsdata[0]->post_name?>">
                                 <?
                                  }
                                ?>   
                                <div class="category"><?=$this->Post_m->GetCategoryName($newsdata[0]->cat_id)?>   </div>
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li><?=date('d F, Y',strtotime($newsdata[0]->posted_on))?></li>
                                    <li>Hits 03</li>
                                </ul>
                                <h3><?=$newsdata[0]->post_name?></h3>
                                <div class="text">
                                  <?=$newsdata[0]->full_desc?>        
                                </div>

                                <!--post-share-options-->
                               <!--  <div class="post-share-options">
                                    <div class="post-share-inner clearfix">
                                        <div class="pull-left tags"><span>Tags: </span><a href="#">payroll,</a> <a href="#">startup</a></div>
                                        <ul class="social-box pull-right">
                                            <li class="facebook"><a href="#"><span class="fa fa-facebook-f"></span></a></li>
                                            <li class="twitter"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                            <li class="linkedin"><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                            <li class="vimeo"><a href="#"><span class="fa fa-pinterest-p"></span></a></li>
                                            <li class="vimeo"><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                        </ul>
                                    </div>
                                </div> -->

                            </div>
                        </div>

                        

                        <!-- Comment Form -->
                        <div class="comment-form">
                            <div class="group-title"><h2>Contact Us</h2></div>
                            <!--Comment Form-->
                            <form method="post" action="#">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="username" placeholder="Name" required>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="text" placeholder="Subject" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea name="message" placeholder="Massage"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="g-recaptcha" data-sitekey="<?=$Site_Key?>"></div>
                                    </div>    

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <button class="theme-btn comment-btn" type="submit" name="submit-form">Send</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <!--End Comment Form -->

                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="sidebar-inner">

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
                                <div class="sidebar-title">
                                    <h2>Categories</h2>
                                    <div class="seperater"></div>
                                </div>
                                <div class="widget-content">
                                    <ul class="blog-cat">
                                        <?php echo NEWSCATLIST()?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Popular Posts -->
                            <div class="sidebar-widget popular-posts">
                                <div class="sidebar-title">
                                    <h2>Popular Posts</h2>
                                    <div class="seperater"></div>
                                </div>
                                <div class="widget-content">
                                    <?php
                                        if(is_array($bloglist) && countz($bloglist) > 0)
                                        {
                                            foreach ($bloglist as $v) 
                                            {
                                                $img  = base_url('post/').$v->post_img;

                                                $caturl = $this->db->query("SELECT slug_url from category where id = $v->cat_id")->row();

                                                $Cat_URL = $caturl->slug_url;
                                      ?>
                                    <article class="post">
                                        <figure class="post-thumb">
                                            <img src="<?=$img?>" alt="<?=$v->post_name?>" />
                                              <a href="<?=base_url('news/').$Cat_URL.'/'.$v->slug_url?>" class="overlay-box">
                                                <span class="icon fa fa-link"></span>
                                               </a>
                                        </figure>
                                        <div class="text">
                                            <a href="<?=base_url('news/').$Cat_URL.'/'.$v->slug_url?>"><?=$v->post_name?></a>
                                        </div>
                                        <div class="post-info">Views <?=$v->hits?></div>
                                    </article>
                                    <?php
                                            }
                                        }    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>