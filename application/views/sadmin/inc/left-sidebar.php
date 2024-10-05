            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
                    
                    <!-- sidebar menu -->
                    <ul class="sidebar-menu"> 
                  
                         <li class="active">
                            <a href="<?=base_url('sadmin/dashboard')?>"><i class="ti-home"></i> <span>Dashboard</span>                               
                            </a>
                        </li>
                         <li class="treeview <?=($this->uri->segment(2) == 'add_admin' || $this->uri->segment(2) == 'edit_admin' || $this->uri->segment(2) == 'adminlist')?'active':''?>">
                            <a href="#">
                                <i class="fa fa-question-circle-o"></i><span>Admin List</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?=($this->uri->segment(2) == 'add_admin')?'class="active"':''?>><a href="<?=base_url('sadmin/add_admin')?>">Add Admin</a></li>
                                <li <?=($this->uri->segment(2) == 'adminlist' || $this->uri->segment(2) == 'edit_admin')?'class="active"':''?>><a href="<?=base_url('sadmin/adminlist')?>">View Admin</a></li>
                            </ul>
                        </li>
                         <li><a href="<?=base_url('sadmin/logout')?>"><i class="fa fa-mail-forward"></i><span>Logout</span></a></li>
                      
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>
