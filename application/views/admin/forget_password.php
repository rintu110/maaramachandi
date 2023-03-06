<?
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
               <?php
                 $scs = $this->session->flashdata('success');
                  if(!empty($scs))
                  {
                     echo '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Success!</strong> '.$scs.'
                          </div>';
                  }

                  $err = $this->session->flashdata('error');
                  if(!empty($err))
                  {
                      echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Error !</strong> '.$err.'
                            </div>';
                  }
               ?>
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-refresh-2"></i>
                            </div>
                            <div class="header-title">
                                <h3>Password Reset</h3>
                                <small><strong>Please fill the form to recover your password</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post" name="forgot_password" autocomplete="off">
                            <p>Fill with your mail to receive instructions on how to reset your password.</p>
                            <div class="form-group">
                                <label class="control-label" for="username">Email</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you email adress" name="email" class="form-control" required value="<?=(isset($_POST['email']) && $_POST['email'] !='')?$_POST['email']:''?>">
                                <span class="help-block small">Your registered email address</span>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success btn-block">Reset password</button><br>
                                <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='<?=base_url('members/login')?>'">Back To Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
<?
    include 'inc/login_footer.php';
?> 