<?php
    $this->load->view('admin/inc/login_header');
?>
        <!-- Content Wrapper -->
        <div class="login-wrapper">           
            <div class="container-center">
                <div style="text-align: center;padding-bottom: 15px;">
                   <a href="<?=base_url('members/login')?>">  
                    <img alt="Logo" style="padding-bottom: 0; display: inline !important;" src="<?=base_url()?>assets/img/t_logo.png">
                   </a>  
                </div>
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>                            
                        </div>
                    </div>
                    <div class="panel-body">                       
                        <form method="post" id="loginForm" novalidate>
                            <div class="form-group">
                                <label class="control-label" for="username">Email ID</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" name="email" class="form-control">
                                <!-- <span class="help-block small">Your unique username to app</span> -->
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" name="password" class="form-control">
                                <!-- <span class="help-block small">Your strong password</span> -->
                            </div>
                            <div class="form-group">
                                <small class="text-danger">Forgot Your Password? <a href="<?=base_url('members/forgot_password')?>" class="text-danger"><strong>Click Here</strong></a></small>
                            </div>    
                            <div>
                                <button class="btn btn-primary" type="submit">Login</button>    
                                <button class="btn btn-warning">Reset</button>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
<?php
    $this->load->view('admin/inc/login_footer');
?>