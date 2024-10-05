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
                                <i class="pe-7s-refresh-2"></i>
                            </div>
                            <div class="header-title">
                                <h3>Password Reset</h3>
                                <small><strong>Please fill the form to recover your password</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post" autocomplete="off">
                            <p>Fill with your mail to receive instructions on how to reset your password.</p>
                            <div class="form-group">
                                <label class="control-label" for="username">New Password</label>                              
                                    <input type="password" placeholder="Enter New Password" title="Enter New Password" required="" id="pwd" name="password" class="form-control" autocomplete="off" maxlength="15" onblur="return check_pwd(this.value,document.getElementById('npwd').value);">
                                    <!--  <span class="input-group-addon"><i class="fa fa-eye"></i></span>                                 -->
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="username">Retype Password</label>
                                <input type="password" placeholder="Retype Above Password" title="Retype Above Password" id="npwd" required="" name="npassword" class="form-control" autocomplete="off" maxlength="15" onblur="return check_pwd(document.getElementById('pwd').value,this.value);">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
<script type="text/javascript">

    function check_pwd(pwd1,pwd2)
    {
        if(pwd1 != '' && pwd2 !='' )
        {
            if(pwd1.length <= 6)
            {
                alert('Enter Password of length 7 to 15 characters');
                return false;
            }
            
            if(pwd2 != pwd1)
            {
                alert('Password and retype password do not match');
                $('#npwd').focus();
                return false;
            }                     

            return true;
        }
    }
    
</script>        
<?php
    include 'inc/login_footer.php';
?>  
