<link href="<?=base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Edit Live Members</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/livemembers')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_livemembers')?>'">
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
                        <label class="col-sm-2 col-form-label">Purpose&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="purpose"  placeholder="Purpose" required="required" value="<?=$all_data->purpose?>" />
                        </div>
                        <label class="col-sm-2 col-form-label">Booking Date&nbsp;<span class="red">*</span></label>
                          <div class="col-sm-4" id="datepick">
                            <input class="form-control" type="text" name="dates"  placeholder="Booking Date" required="required" value="<?=date('d/m/Y',strtotime($all_data->dates))?>">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Name" name="name" id="name" value="<?=$all_data->name?>" required="required">
                        </div>
                        <label class="col-sm-2 col-form-label">Gotra&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Gotra" name="gotra" value="<?=$all_data->gotra?>">                             
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Name" name="address"  required="required" value="<?=$all_data->address?>">
                        </div>                        
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Yearly Donation&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" placeholder="Yearly Donation" name="yrly_donation"  required="required" value="<?=$all_data->yrly_donation?>">
                        </div>                        
                    </div>                    
                                
            </div>
        </div>
    </div>
</section>
</form>
<script type="text/javascript">  

    function mytext(vals,ids)
    {
       var string = vals.replace(/  +/g, ' ');
       $('#'+ids).val(string);
    }

     $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        //startDate:new Date(),
        format: "dd/mm/yyyy",
    });
</script>