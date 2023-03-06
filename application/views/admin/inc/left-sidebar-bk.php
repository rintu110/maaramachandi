            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">                    
                    <!-- sidebar menu -->
                    <ul class="sidebar-menu">                                       
                        <li class="active">
                            <a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span>                               
                            </a>
                        </li>
                         <li class="active">
                            <a href="<?=base_url()?>" target="_blank"><i class="fa fa-desktop"></i> <span>Visit My Site</span>                               
                            </a>
                        </li>
                        <li class="treeview <?=($this->uri->segment(2) == 'add_page' || $this->uri->segment(2) == 'edit_page' || $this->uri->segment(2) == 'pages'  || $this->uri->segment(2) == 't_pages')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-file-text"></i><span>Page</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_page')?'class="active"':''?>><a href="<?=base_url('admin/add_page')?>">Add Page</a></li>
                                <li <?=($this->uri->segment(2) == 'pages' || $this->uri->segment(2) == 'edit_page')?'class="active"':''?>><a href="<?=base_url('admin/pages')?>">View Page</a></li>
                            </ul>
                       </li>
               
                        <li class="treeview <?=($this->uri->segment(2) == 'add_category' || $this->uri->segment(2) == 'edit_category' || $this->uri->segment(2) == 'add_product' || $this->uri->segment(2) == 'edit_product' || $this->uri->segment(2) == 'product'  || $this->uri->segment(2) == 'category' || $this->uri->segment(2) == 't_category' || $this->uri->segment(2) == 't_product' || $this->uri->segment(2) == 'prd_gallery'   || $this->uri->segment(2) == 'edit_seo'  || $this->uri->segment(2) == 'edit_desc'  || $this->uri->segment(2) == 'edit_spec'  || $this->uri->segment(2) == 'edit_qa' || $this->uri->segment(2) == 'edit_links')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-product-hunt"></i><span>Product</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_category')?'class="active"':''?>><a href="<?=base_url('admin/add_category')?>">Add Category</a></li>
                                <li <?=($this->uri->segment(2) == 'category' || $this->uri->segment(2) == 'edit_category')?'class="active"':''?>><a href="<?=base_url('admin/category')?>">View Category</a></li>
                                <li <?=($this->uri->segment(2) == 'add_product')?'class="active"':''?>><a href="<?=base_url('admin/add_product')?>">Add Product</a></li>
                                <li <?=($this->uri->segment(2) == 'product' || $this->uri->segment(2) == 'edit_product'  || $this->uri->segment(2) == 'edit_seo'  || $this->uri->segment(2) == 'edit_feature'  || $this->uri->segment(2) == 'edit_tech' || $this->uri->segment(2) == 'prd_gallery' || $this->uri->segment(2) == 'edit_composition')?'class="active"':''?>><a href="<?=base_url('admin/product')?>">View Products</a></li>
                            </ul>
                        </li>
                        <!-- <li class="treeview <?=($this->uri->segment(2) == 'add_ncategory' || $this->uri->segment(2) == 'edit_ncategory' ||  $this->uri->segment(2) == 'add_news'  ||  $this->uri->segment(2) == 'ncategory'  || $this->uri->segment(2) == 'edit_news'   || $this->uri->segment(2) == 'newslist'   || $this->uri->segment(2) == 't_newslist')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-newspaper-o"></i><span>Blog</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_ncategory')?'class="active"':''?>><a href="<?=base_url('admin/add_ncategory')?>">Add Blog Category</a></li>
                                <li <?=($this->uri->segment(2) == 'ncategory' || $this->uri->segment(2) == 'edit_ncategory')?'class="active"':''?>><a href="<?=base_url('admin/ncategory')?>">View Blog Category</a></li>                               
                                <li <?=($this->uri->segment(2) == 'add_news')?'class="active"':''?>><a href="<?=base_url('admin/add_news')?>">Add Blog</a></li>
                                <li <?=($this->uri->segment(2) == 'newslist' || $this->uri->segment(2) == 'edit_news')?'class="active"':''?>><a href="<?=base_url('admin/newslist')?>">View Blog</a></li>
                            </ul>
                        </li> -->  
                                    
                       <!--  <li class="treeview <?=($this->uri->segment(2) == 'add_menu' || $this->uri->segment(2) == 'edit_menu' || $this->uri->segment(2) == 'menu')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-list-ul"></i><span>Menu</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">                               
                                <li <?=($this->uri->segment(2) == 'menu' || $this->uri->segment(2) == 'edit_menu')?'class="active"':''?>><a href="<?=base_url('admin/menu')?>">View Menu</a></li>
                            </ul>
                        </li> -->

                        <li class="treeview <?=($this->uri->segment(2) == 'add_banner' || $this->uri->segment(2) == 'edit_banner' || $this->uri->segment(2) == 'banner' || $this->uri->segment(2) == 't_banner')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-image"></i><span>Banner</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_banner')?'class="active"':''?>><a href="<?=base_url('admin/add_banner')?>">Add Banner</a></li>
                                <li <?=($this->uri->segment(2) == 'banner' || $this->uri->segment(2) == 'edit_banner')?'class="active"':''?>><a href="<?=base_url('admin/banner')?>">View Banner</a></li>
                            </ul>
                        </li>  
                       <!--   <li class="treeview <?=($this->uri->segment(2) == 'add_testimonial' || $this->uri->segment(2) == 'edit_testimonial' || $this->uri->segment(2) == 'testimonial' || $this->uri->segment(2) == 't_testimonial')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-list-alt"></i><span>Testimonial</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_testimonial')?'class="active"':''?>><a href="<?=base_url('admin/add_testimonial')?>">Add Testimonial</a></li>
                                <li <?=($this->uri->segment(2) == 'testimonial' || $this->uri->segment(2) == 'edit_testimonial' || $this->uri->segment(2) == 't_testimonial')?'class="active"':''?>><a href="<?=base_url('admin/testimonial')?>">View Testimonial</a></li>
                            </ul>
                        </li> -->
                        <!-- <li class="treeview <?=($this->uri->segment(2) == 'add_partners' || $this->uri->segment(2) == 'edit_partners' || $this->uri->segment(2) == 'partners' || $this->uri->segment(2) == 't_partners')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-image"></i><span>Partners</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_partners')?'class="active"':''?>><a href="<?=base_url('admin/add_partners')?>">Add Partners</a></li>
                                <li <?=($this->uri->segment(2) == 'partners' || $this->uri->segment(2) == 'edit_partners')?'class="active"':''?>><a href="<?=base_url('admin/partners')?>">View Partners</a></li>
                            </ul>
                        </li>    -->                     
                        <li <?=($this->uri->segment(2) == 'site_setting')?'class="active"':''?>><a href="<?=base_url('admin/site_setting/1485')?>" target="_blank"><i class="fa fa-cogs"></i><span>Site Setting</span></a></li>
                        <li <?=($this->uri->segment(2) == 'page_meta')?'class="active"':''?>>
                            <a href="<?=base_url('admin/page_meta')?>">
                                <i class="fa fa-tag"></i> <span>Page Meta</span>                               
                            </a>
                        </li>
                         <li><a href="<?=base_url('admin/logout')?>"><i class="fa fa-mail-forward"></i><span>Logout</span></a></li>
                       
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>
