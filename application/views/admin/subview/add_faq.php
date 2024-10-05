 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Category</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/category')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_category')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel</button>
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
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Add FAQ Form&nbsp;&nbsp;
                                <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.location='<?=base_url('admin/faq')?>'">View All</button>&nbsp;&nbsp;
                              </h4>                      
                        </div>                   
                    </div>           
                        <div class="panel-body">
                            <p>
                                <code class="highlighter-rouge">*</code> Fields Are Mandatory
                            </p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Question&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Question" name="qns">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Answer&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                   <textarea class="form-control" name="ans" placeholder="Answer" rows="5" id="ans"></textarea>                                              
                                </div>
                            </div>
                            <hr >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success"><i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;&nbsp;&nbsp;                                 
                                    <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_faq')?>'"><i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel</button>
                                </div>    
                            </div>
                        </div>               
                </div>
            </div>
        </div>
    </section>
  </form>
    
<script src='<?=base_url()?>assets/js/autosize.js'></script>
<script type="text/javascript">
   autosize(document.querySelectorAll('textarea'));
</script>