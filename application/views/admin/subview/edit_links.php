 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
     <div class="header-title">
        <h1>
          Edit Links&nbsp;&nbsp;
         <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_product/'.$all_data->id)?>'">Edit Product</button>
         <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_desc/').$all_data->id?>'">Edit Description</button>
         <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_spec/').$all_data->id?>'">Edit Specification</button>
        <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_qa/').$all_data->id?>'">Edit FAQs</button>
        <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_seo/'.$all_data->id)?>'">Edit SEO</button>
        </h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/product')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_product')?>'">
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
            <div class="panel panel-bd ">               
                <div class="row">                   
                      <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">                                                   
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p> 
                               <div class="row">
                                  <div class="col-md-12">
                                    <fieldset>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Downlod Links:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="links" id="editor3"><?=$links->links?></textarea>
                                                  <script>
                                                     var editor = CKEDITOR.replace('editor3');            
                                                     CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );                                                
                                                </script>
                                            </div>                                              
                                        </div>                
                                       </div>  
                                    </fieldset>
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