 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Edit Members</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/donation')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_members')?>'">
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
                            <input class="form-control" type="text" placeholder="Category" name="name" value="<?=$all_data->name?>" required>
                        </div>
                        <label class="col-sm-2 col-form-label">Designation&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" placeholder="Designation" name="desg" value="<?=$all_data->desg?>">                             
                        </div>
                    </div>                   
                    
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Member Type</label>
                        <div class="col-sm-3">
                            <select name="member_type" class="form-control">
                                <option value="">Select</option>                             
                                <option value="1" <?=($all_data->member_type == 1)?'SELECTED':''?>>Trustee</option>
                                <option value="2" <?=($all_data->member_type == 2)?'SELECTED':''?>>Committee</option>
                                <option value="3" <?=($all_data->member_type == 3)?'SELECTED':''?>>Temple Management</option>
                                <option value="4" <?=($all_data->member_type == 4)?'SELECTED':''?>>Chandi Patha</option>
                                <option value="5" <?=($all_data->member_type == 5)?'SELECTED':''?>>Founder</option> 
                            </select>
                        </div>
                    </div>                  
                   

                     <div class="form-group row">
                        <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control"  name="img" id="fileInput">       
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <p><img id="imagePreview" style="display:none; max-width: 1200px;"/></p>                            
                                <?php  if($all_data->img !='')  {  ?>
                                   <img src="<?=base_url('post/members/'.$all_data->img)?>" style="max-width: 1200px;">
                                   <br>  
                                   <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="members" col_name="img" dest="post/members" dest_thumb="post/members/thumb">   
                               <? } ?>
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
</script>