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
            <div class="panel panel-bd ">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Add Partners Form&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.open('<?=base_url('admin/partners')?>','_blank')">View All</button>&nbsp;&nbsp;</h4>
                    </div>
                </div>
                 <form method="post" name="frm_page" enctype="multipart/form-data">
                        <div class="panel-body" id="DivId">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Partners Name&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="partner_nm" id="field_name" placeholder="Partners Name" onkeyup="mytext(this.value,this.id);" required="required" value="<?=$all_data->partner_nm?>">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image Tag&nbsp;</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="img_tag" id="field_names" placeholder="Image Tag" onkeyup="mytext(this.value,this.id);" value="<?=$all_data->img_tag?>">
                                </div>
                            </div>  
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL (If Any)&nbsp;</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="url"  placeholder="URL (If Any)" value="<?=$all_data->url?>">
                                </div>
                            </div> 

                             <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Image&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">                                                              
                                   <input type="file" class="form-control"  name="partner_img" id="fileInput">       
                                      <input type="hidden" id="x" name="x" />
                                      <input type="hidden" id="y" name="y" />
                                      <input type="hidden" id="w" name="w" />
                                      <input type="hidden" id="h" name="h" />
                                      <p><img id="imagePreview" style="display:none;"/></p>                            
                                      <?php  if($all_data->partner_img !='')  {  ?>
                                                 <img src="<?=base_url('partners/'.$all_data->partner_img)?>">
                                                 <br>  
                                                 <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="partners" col_name = "partner_img" dest = "partners" dest_thumb = "partners/thumb">   
                                          <? } ?>
                                      
                                </div>
                            </div>                       
                        
                            <hr >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-success">Update</button>&nbsp;&nbsp;&nbsp;                                 
                                <button type="button" class="btn btn-default" onclick="window.location='<?=base_url('admin/add_partners')?>'">Cancel</button>
                            </div>
                        </div>
                 </form>
            </div>
        </div>
    </div>
</section>       
  
<button id='success'  onclick="javascript: toastr.success('Success - Image Delete Successfully.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button> 