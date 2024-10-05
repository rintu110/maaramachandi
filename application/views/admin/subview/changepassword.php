<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Change Password</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">           
             <button type="submit" class="btn btn-success submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>             
        </div>
    </div>
   </section>
<!-- Main content -->
<section class="content">
    <div class="row">                                              
        <!-- Textual inputs -->
        <div class="col-sm-12">
             <?
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
                             <strong>Danger!</strong>'.$err.'
                            </div>';
                  }
            ?>
            <div class="panel panel-bd">
                  <div class="panel-body">
                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Old Password&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="password" placeholder="*********" name="old_pwd" id="old_pwd" required="required" onblur="return check_oldpwd(this.value);">
                             <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Password you entered is wrong.</span> 
                             <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">Password Matched</span> 
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">New Password&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="password" placeholder="*********" name="pwd" id="pwd" required="required" onblur="return check(this.value,document.getElementById('npwd').value);" maxlength="15">
                        </div>
                    </div>                     
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Retype New Password&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="password" placeholder="*********" name="npwd" id="npwd" required="required" onblur="return check(document.getElementById('pwd').value,this.value);" maxlength="15">
                        </div>
                    </div>   
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success submit">Update</button>
                        </div>    
                    </div>                  
            </div>
        </div>
    </div>
</section>
</form>
<script language="javascript">
   
    $('.submit').attr('disabled',false);    

    function check_oldpwd(pwd)
    {
        if(pwd != '')
        {
             var pwd = encodeURIComponent(pwd);
             var urls = "<?=base_url('admin/check_pwd?key=')?>"+pwd;
             var urls = encodeURI(urls);

             $.get( urls, function( data ) {
                if(data == 0)
                {
                   $('#inline_green').hide();                
                   $('#inline_red').show();        
                   $('#old_pwd').css('border-color', 'red');
                   $('#old_pwd').focus();
                   $('.submit').prop('disabled',true);
                }
                else if(data == 1)
                {
                    $('#inline_red').hide();
                    $('#inline_green').show();
                    $('#old_pwd').css('border-color', 'green');
                    $('.submit').prop('disabled',false);
                }
            });
         }
         else
         {
             $('#inline_red').hide();
             $('#inline_green').hide();
             $('.submit').prop('disabled',false);
         }   
         $('.submit').prop('disabled',false);        
    }

    function check(pwd1,pwd2)
    {
        if(pwd1 != '' && pwd2 !='' )
        {
            if(pwd1.length <= 6)
            {
                alert('Enter Password of length 7 to 15 characters');
                $('.submit').prop('disabled',true);
                return false;
            }  
          
            if(pwd2 != pwd1)
            {
                alert('Password and retype password do not match');
                $('#npwd').focus();
                $('.submit').prop('disabled',true);
                return false;
            }                     
            $('.submit').prop('disabled',false);
            return true;
        }
    }
   
</script>    