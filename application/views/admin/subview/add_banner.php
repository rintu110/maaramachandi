 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Banner</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/banner')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_banner')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel
             </button>
        </div>
    </div>
   </section>
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
                              <input class="form-control" type="text" name="bnr_heading" placeholder="Banner Heading" >
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Banner Description</label>
                          <div class="col-sm-9">
                              <textarea class="form-control" name="description" placeholder="Banner Description"></textarea>                                           
                          </div>
                      </div>                                     
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Read More Link</label>
                          <div class="col-sm-9">
                              <input class="form-control" type="url" name="readmore_url" placeholder="https://www.example.com">
                          </div>
                      </div>
                       <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Banner Alt Tag&nbsp;<span class="red">*</span></label>
                          <div class="col-sm-9">
                              <input class="form-control" type="text" name="alt_tag" placeholder="Alt Tag" required="required">
                          </div>
                      </div>
                      <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-5">                                                               
                                       <input type="file" class="form-control"  name="bnr_img" id="fileInput" required="required">
                                          <input type="hidden" id="x" name="x" />
                                          <input type="hidden" id="y" name="y" />
                                          <input type="hidden" id="w" name="w" />
                                          <input type="hidden" id="h" name="h" />
                                       <p><img id="imagePreview" style="width: 1000px;" /></p>
                                </div>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </section> 
</form>