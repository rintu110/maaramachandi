<!--Page Title-->
    <section class="page-title" style="background-image:url(<?=base_url('frontassets/')?>images/background/22.jpg)">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="pull-left">
                    <h1>News</h1>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?=base_url()?>">Home</a></li>
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
                    <div class="blog-classic">


                        <?
                        if(is_array($newslist) && sizeof($newslist,1) > 0)
                        {
                           foreach ($newslist as $v) 
                           {
                               $img = base_url('post/').$v->post_img;
                                                      
                                if(strlen($v->sml_desc) > 60)
                                {
                                    $str = substr($v->sml_desc,0,230).'....';
                                }
                                else
                                {
                                    $str = $v->sml_desc;
                                }    

                                $caturl = $this->db->query("SELECT slug_url from category where id = $v->cat_id")->row();

                                $Cat_URL = $caturl->slug_url;                
                        ?>

                        <!-- News Block Seven -->
                        <div class="news-block-seven">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="<?=base_url('news/').$Cat_URL.'/'.$v->slug_url?>">
                                        <img src="<?=$img?>" alt="<?=$v->post_name?>" />
                                    </a>
                                    <div class="overlay">
                                        <a href="<?=base_url('news/').$Cat_URL.'/'.$v->slug_url?>" class="read-more">Read More</a>
                                    </div>
                                    <div class="category">
                                        <?=$this->Post_m->GetCategoryName($v->cat_id)?>                                            
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="post-meta">
                                        <li><?=date('d F, Y',strtotime($v->posted_on))?></li>                                        
                                    </ul>
                                    <h3><a href="<?=base_url('news/').$Cat_URL.'/'.$v->slug_url?>"><?=$v->post_name?></a></h3>
                                    <div class="text"><?=$str?></div>
                                </div>
                            </div>
                        </div>

                        <?
                            }
                         }   

                        ?>

                        <!--Post Share Options-->
                       <!--  <div class="styled-pagination text-center">
                            <ul class="clearfix">
                                <li class="prev"><a href="#"><span class="flaticon-back"></span> </a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li class="active"><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li class="next"><a href="#"><span class="flaticon-right-arrow"></span> </a></li>
                            </ul>
                        </div> -->

                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="sidebar-inner">

                            <!-- Search -->
                            <div class="sidebar-widget search-box">
                                <form method="get" action="<?=base_url('newssearch')?>">
                                    <div class="form-group">
                                        <input type="search" name="term" value="<?=(isset($_GET['term']) && $_GET['term'] !='')?$_GET['term']:''?>" placeholder="Search News..." required>
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