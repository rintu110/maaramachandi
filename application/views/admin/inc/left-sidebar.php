            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">                    
                    <!-- sidebar menu -->
                    <ul class="sidebar-menu">                                       
                        <li <?=($this->uri->segment(2) == 'dashboard')?'class="active"':''?>>
                            <a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span>                               
                            </a>
                        </li>
                         <li>
                            <a href="<?=base_url()?>" target="_blank"><i class="fa fa-desktop"></i> <span>Visit My Site</span>                               
                            </a>
                        </li>
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
                       <li class="treeview <?=($this->uri->segment(2) == 'add_members' || $this->uri->segment(2) == 'edit_members' || $this->uri->segment(2) == 'members'  || $this->uri->segment(2) == 't_members'   || $this->uri->segment(2) == 'livemembers'   || $this->uri->segment(2) == 'edit_livemembers'   || $this->uri->segment(2) == 'add_livemembers'  || $this->uri->segment(2) == 'donation'  || $this->uri->segment(2) == 'add_donation'  || $this->uri->segment(2) == 'edit_donation' || $this->uri->segment(2) == 'gallerylist' || $this->uri->segment(2) == 'gallery' || $this->uri->segment(2) == 'edit_gallery' )?'active':''?>">
                            <a href="#">
                                <i class="fa fa-file-text"></i><span>Misc</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">                              
                                <li <?=($this->uri->segment(2) == 'members' || $this->uri->segment(2) == 'edit_members'  || $this->uri->segment(2) == 'add_members')?'class="active"':''?>><a href="<?=base_url('admin/members')?>">Members</a></li>
                                 <li <?=($this->uri->segment(2) == 'livemembers' || $this->uri->segment(2) == 'edit_livemembers'  || $this->uri->segment(2) == 'add_livemembers')?'class="active"':''?>><a href="<?=base_url('admin/livemembers')?>">Live Members</a></li>
                                 <li <?=($this->uri->segment(2) == 'donation' || $this->uri->segment(2) == 'edit_donation'  || $this->uri->segment(2) == 'add_donation')?'class="active"':''?>><a href="<?=base_url('admin/donation')?>">Donation</a></li>
                                  <li <?=($this->uri->segment(2) == 'gallerylist' || $this->uri->segment(2) == 'gallery' || $this->uri->segment(2) == 'edit_gallery')?'class="active"':''?>><a href="<?=base_url('admin/gallerylist')?>">Gallery</a></li>
                                  <li <?=($this->uri->segment(2) == 'mediaCoverage' || $this->uri->segment(2) == 'add_mediaCoverage' || $this->uri->segment(2) == 'edit_mediaCoverage')?'class="active"':''?>><a href="<?=base_url('admin/mediaCoverage')?>">Media Coverage</a></li>
                            </ul>
                       </li>
               
                       <!--  <li class="treeview <?=($this->uri->segment(2) == 'add_category' || $this->uri->segment(2) == 'edit_category' || $this->uri->segment(2) == 'add_product' || $this->uri->segment(2) == 'edit_product' || $this->uri->segment(2) == 'product'  || $this->uri->segment(2) == 'category' || $this->uri->segment(2) == 't_category' || $this->uri->segment(2) == 't_product' || $this->uri->segment(2) == 'prd_gallery'   || $this->uri->segment(2) == 'edit_seo'  || $this->uri->segment(2) == 'edit_desc'  || $this->uri->segment(2) == 'edit_spec'  || $this->uri->segment(2) == 'edit_qa' || $this->uri->segment(2) == 'edit_links')?'active':''?>">
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
                     
 -->
                       
                          <!--                            
                           <li class="treeview <?=($this->uri->segment(2) == 'add_ncategory' || $this->uri->segment(2) == 'edit_ncategory' ||  $this->uri->segment(2) == 'add_news'  ||  $this->uri->segment(2) == 'ncategory'  || $this->uri->segment(2) == 'edit_news'   || $this->uri->segment(2) == 'newslist'   || $this->uri->segment(2) == 't_newslist')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-newspaper-o"></i><span>News</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_ncategory')?'class="active"':''?>><a href="<?=base_url('admin/add_ncategory')?>">Add News Category</a></li>
                                <li <?=($this->uri->segment(2) == 'ncategory' || $this->uri->segment(2) == 'edit_ncategory')?'class="active"':''?>><a href="<?=base_url('admin/ncategory')?>">View News Category</a></li>                               
                                <li <?=($this->uri->segment(2) == 'add_news')?'class="active"':''?>><a href="<?=base_url('admin/add_news')?>">Add News</a></li>
                                <li <?=($this->uri->segment(2) == 'newslist' || $this->uri->segment(2) == 'edit_news')?'class="active"':''?>><a href="<?=base_url('admin/newslist')?>">View News</a></li>
                            </ul>
                        </li> -->
                           <!-- <li class="treeview <?=($this->uri->segment(2) == 'add_faq' || $this->uri->segment(2) == 'edit_faq' || $this->uri->segment(2) == 'faq' || $this->uri->segment(2) == 't_faq')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-list-alt"></i><span>Faq's</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_faq')?'class="active"':''?>><a href="<?=base_url('admin/add_faq')?>">Add Faq</a></li>
                                <li <?=($this->uri->segment(2) == 'faq' || $this->uri->segment(2) == 'edit_faq' || $this->uri->segment(2) == 't_faq')?'class="active"':''?>><a href="<?=base_url('admin/faq')?>">View Faq</a></li>
                            </ul>
                        </li> -->
                       <!-- <?=base_url('admin/site_setting/1485')?> -->
                        <li <?=($this->uri->segment(2) == 'home_setting' || $this->uri->segment(2) == 'social_setting' || $this->uri->segment(2) == 'meta_setting')?'class="active"':''?>>
                            <a href="#">
                                <i class="fa fa-cogs"></i><span >Site Setting</span>
                                 <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'home_setting')?'class="active"':''?>><a href="<?=base_url('admin/home_setting/1485')?>">Home Page Settings</a></li>
                                <li <?=($this->uri->segment(2) == 'social_setting')?'class="active"':''?>><a href="<?=base_url('admin/social_setting/1485')?>">Social Media Settings</a></li>
                                <li <?=($this->uri->segment(2) == 'meta_setting')?'class="active"':''?>><a href="<?=base_url('admin/meta_setting/1485')?>">Meta Tag Settings</a></li>
                            </ul>
                        </li>
                        <li <?=($this->uri->segment(2) == 'change_email' || $this->uri->segment(2) == 'change_password')?'class="active"':''?>>
                            <a href="#">
                                <i class="fa fa-user"></i><span >Profile</span>
                                 <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'change_email')?'class="active"':''?>><a href="<?=base_url('admin/change_email')?>">Change Email ID</a></li>
                                <li <?=($this->uri->segment(2) == 'change_password')?'class="active"':''?>><a href="<?=base_url('admin/change_password')?>">Change Password</a></li>
                            </ul>
                        </li>
                      <!--  <li <?=($this->uri->segment(2) == 'page_meta')?'class="active"':''?>>
                            <a href="<?=base_url('admin/page_meta')?>">
                                <i class="fa fa-tag"></i> <span>Page Meta</span>                               
                            </a>
                        </li> -->

                         <li <?=($this->uri->segment(2) == 'request_form')?'class="active"':''?>>
                            <a href="<?=base_url('admin/request_form')?>">
                                <i class="fa fa-user-plus"></i> <span>Request Users</span>                               
                            </a>
                        </li>
                         <li><a href="<?=base_url('admin/logout')?>"><i class="fa fa-mail-forward"></i><span>Logout</span></a></li>
                       
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>
