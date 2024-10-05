<link href="<?=base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Donation</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/donation')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_donation')?>'">
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
                        <label class="col-sm-2 col-form-label">Name&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Name" name="name" onkeyup="mytext(this.value,this.id);" required="required">
                        </div>
                        <label class="col-sm-2 col-form-label">Email ID</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Email ID" name="email">                             
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mobile No&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" placeholder="Mobile No" name="mobile_no" required="required" maxlength="10">
                        </div>
                        <label class="col-sm-2 col-form-label">Address&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" placeholder="Address" name="address" required="required">                             
                        </div>
                    </div>                   
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Donation Type&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <select name="d_type" class="form-control" required="required">
                                <option value="">Select</option>                             
                                <option value="1">Cash</option>
                                <option value="2">Other</option>                                
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Donation Amount" name="d_amount">                             
                        </div>
                    </div>                                          

                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Donation Date&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4" id="datepick">
                           <input class="form-control" type="text" name="dod"  placeholder="Donation Date" required="required" readonly="readonly">
                        </div>                        
                    </div> 

                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Donation Description&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-10">
                           <input class="form-control" type="text" name="description" placeholder="Donation Description" required="required">
                        </div>                        
                    </div>
                   

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload Image</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control"  name="img" id="fileInput">
                              <input type="hidden" id="x" name="x" />
                              <input type="hidden" id="y" name="y" />
                              <input type="hidden" id="w" name="w" />
                              <input type="hidden" id="h" name="h" />
                            <p><img id="imagePreview" style="display:none; max-width: 1200px; margin-top: 10px;"/></p>
                       </div>                  
                    </div>                   

                                
            </div>
        </div>
    </div>
</section>
</form>
<script language="javascript">   

    function mytext(vals,ids)
    {
       if(vals !='') 
       {
           var string = vals.replace(/  +/g, ' ');
           $('#'+ids).val(string);            
       }
       
    } 

     $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,       
        format: "dd/mm/yyyy",
    });
   
</script>    