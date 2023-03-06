<link href="<?=base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add MediaCoverage</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/mediaCoverage')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_mediaCoverage')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel</button>
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
                        <label class="col-sm-2 col-form-label">Publish Date&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4" id="datepick">
                           <input class="form-control" type="text" name="publish_date"  placeholder="Publish Date" required="required" readonly="readonly">
                        </div>  
                       <label class="col-sm-2 col-form-label">URL (if any)</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="URL" name="link">                             
                        </div>                      
                    </div>                                                                  
                   

                    <div class="form-group row">
                        <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control"  name="cut_img" id="fileInput">
                              <input type="hidden" id="x" name="x" />
                              <input type="hidden" id="y" name="y" />
                              <input type="hidden" id="w" name="w" />
                              <input type="hidden" id="h" name="h" />
                            <p><img id="imagePreview" style="display:none; max-width: 600px; margin-top: 10px;"/></p>
                       </div>                  
                    </div>                   

                                
            </div>
        </div>
    </div>
</section>
</form>
<script language="javascript">  

 $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,       
        format: "dd/mm/yyyy",
    }); 

    function mytext(vals,ids)
    {
       if(vals !='') 
       {
           var string = vals.replace(/  +/g, ' ');
           $('#'+ids).val(string);            
       }
       
    }
    $('#submit').attr('disabled',false);

    function check_duplicate(vals)
    {    
         if(vals != '')
         {   
             var field_nm = 'slug_url'; 
             var ids = $('#cat_name').attr("ids"); 
             var types = $('#cat_name').attr("types"); 
           
             vals = encodeURI(vals);
            
             var urls = "<?=base_url('admin/check_duplicate')?>/"+field_nm+"/"+ids+"/"+vals+"/"+types;
             var urls = encodeURI(urls);

             $.get( urls, function( data ) {
                if(data == 1)
                {
                   $('#slug_url').val('');
                   $('#inline_green').hide();                
                   $('#inline_red').show();        
                   $('#field_name').css('border-color', 'red');
                   $('#field_name').focus();
                   $('#submit').prop('disabled',true);

                }
                else if(data == 0)
                {
                    $('#inline_red').hide();
                    $('#inline_green').show();
                    $('#field_name').css('border-color', 'green');
                    $('#submit').prop('disabled',false);

                }
            });
         }
         else
         {
             $('#inline_red').hide();
             $('#inline_green').hide();
         }    
    }
   
</script>    