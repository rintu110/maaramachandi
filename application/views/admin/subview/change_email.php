<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Change Email</h1>  
        <small>&nbsp;</small>   
       <!--  <div class="breadcrumb">           
             <button type="submit" class="btn btn-success submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>             
        </div> -->
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
                        <label class="col-sm-2 col-form-label">Enter New Email ID&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="email" placeholder="abc@example.com" name="sec_email" id="sec_email" required="required" onblur="return check_previous(this.value);">
                             <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Email ID is already exist. Please provide another Email ID.</span> 
                             <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">Email available.</span> 
                        </div>
                    </div>                                      
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success submit">Verify</button>
                        </div>    
                    </div>                  
            </div>
        </div>
    </div>
</section>
</form>
<script language="javascript">
   
    $('.submit').attr('disabled',false);    

    function check_previous(emailID)
    {
        if(emailID != '')
        {
             var emailID = encodeURIComponent(emailID);
             var urls = "<?=base_url('admin/check_previous?key=')?>"+emailID;
             var urls = encodeURI(urls);

             $.get( urls, function( data ) {
                if(data == 0)
                {
                   $('#inline_green').hide();                
                   $('#inline_red').show();        
                   $('#sec_email').css('border-color', 'red');
                   $('#sec_email').focus();
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
    
</script>    