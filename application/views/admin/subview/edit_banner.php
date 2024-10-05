 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Edit Banner</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/banner')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_banner')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel
             </button>
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
                        <p class="highlt"><code class="highlighter-rouge">* Fields Are Mandatory</code></p>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Banner Heading&nbsp;</label>
                          <div class="col-sm-9">
                              <input class="form-control" type="text" name="bnr_heading" placeholder="Banner Heading" value="<?=$all_data->bnr_heading?>">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Banner Description</label>
                          <div class="col-sm-9">
                              <textarea class="form-control" name="description" placeholder="Banner Description"><?=$all_data->description?></textarea>
                          </div>
                      </div>                                     
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Read More Link</label>
                          <div class="col-sm-9">
                              <input class="form-control" type="url" name="readmore_url" placeholder="https://www.example.com" value="<?=$all_data->readmore_url?>">
                          </div>
                      </div>
                       <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Banner Alt Tag&nbsp;<span class="red">*</span></label>
                          <div class="col-sm-9">
                              <input class="form-control" type="text" name="alt_tag" placeholder="Alt Tag" value="<?=$all_data->alt_tag?>">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner&nbsp;<span class="red">*</span></label>
                          <div class="col-sm-9">                                                              
                             <input type="file" class="form-control"  name="bnr_img" id="fileInput">       
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <p><img id="imagePreview" /></p>                            
                                <?php  
                                    if($all_data->bnr_img !='')  
                                    {  
                                ?>
                                           <img src="<?=base_url('banner_img/'.$all_data->bnr_img)?>" width="1000">
                                           <br>  
                                           <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="banner" col_name = "bnr_img" dest = "banner_img" dest_thumb = "banner_img/thumb">   
                                <? 
                                   } 
                              ?>                                
                          </div>
                      </div>
                  </div>                     
              </div>
          </div>
      </div>
  </section> <!-- /.content -->
 </form> 
<button id='success'  onclick="javascript: toastr.success('Success - Image Delete Successfully.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button> 

