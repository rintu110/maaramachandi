<?php
    include 'inc/login_header.php';
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
                                <i class="pe-7s-close"></i>
                            </div>
                            <div class="header-title">
                                <h3>Success</h3>
                                <small><strong>Password Reset Successfully. Please login below to continue.</strong></small><br>
                                <br>
                                <span>
                                    <button class="btn btn-primary" onclick="window.location.href='<?=base_url('members/login')?>'">Back To Login</button>
                                </span>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
<?php
    include 'inc/login_footer.php';
?>  