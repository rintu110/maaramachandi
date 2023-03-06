 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Edit Page Meta</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/page_meta')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_page_meta')?>'">
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
                     echo '<div class="alert alert-sm alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Success!</strong> '.$scs.'
                          </div>';
                  }

                  $err = $this->session->flashdata('error');
                  if(!empty($err))
                  {
                      echo '<div class="alert alert-sm alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Danger!</strong>'.$err.'
                            </div>';
                  }
            ?>
            <div class="panel panel-bd">              
              <div class="row">  
                   <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">                          
                      <div class="tab-content"> 
                       <div class="tab-pane fade in active" id="tab1">                    
                            <div class="panel-body">
                                <p class="highlt"><code class="highlighter-rouge">* Fields Are Mandatory</code></p>                                             
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Page URL&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Page URL" name="page_url">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="meta_title" placeholder="Meta Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="meta_key" placeholder="Meta Keyword">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="meta_desc" rows="3" placeholder="Meta Description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Extra Meta</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="extra_meta" placeholder="Extra Meta"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Canonical Code</label>
                                    <div class="col-sm-9">
                                         <input class="form-control" type="text" name="canonical_code" placeholder="Canonical Code">
                                    </div>
                                 </div>                                                              
                            </div>
                       </div>                      
                      </div>   
                   </div>  
                 </div>  
              </div>
            </div>
        </div>
    </div>
  </section>   
 </form>