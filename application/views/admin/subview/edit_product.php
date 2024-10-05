 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>
          Edit Product&nbsp;&nbsp; 
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_desc/'.$all_data->id)?>'">Edit Description</button>
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_seo/'.$all_data->id)?>'">Edit SEO</button>
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/prd_gallery/'.$all_data->id)?>'">Edit Galley</button>
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
              <div class="panel panel-bd">             
                  <div class="row">
                           <input type="hidden" name="post_type" value="Product">                              
                             <div class="panel-body">          
                                   <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Product Name&nbsp;<span class="red">*</span></label>
                                          <div class="col-sm-9">
                                              <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Product Name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))"  value="<?=$all_data->post_name?>">
                                          </div>
                                      </div>                                      
                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                          <div class="col-sm-9">
                                              <input class="form-control" type="text" placeholder="Product URL" name="slug_url" id="slug_url" value="<?=$all_data->slug_url?>">
                                          </div>
                                      </div>
                                       <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Category</label>
                                          <div class="col-sm-4">
                                              <select name="cat_id" class="form-control">
                                                  <option value="">Select Category</option> 
                                                   <?php 
                                                   foreach ($category as $v) 
                                                   { 
                                                      $sel = '';
                                                      if($v->id == $all_data->cat_id)
                                                      {
                                                          $sel = 'SELECTED';
                                                      }
                                                    ?>                               
                                                     <option value="<?=$v->id?>" <?=$sel?>><?=$v->cat_name?></option> 
                                                   <?  } ?>                              
                                              </select>
                                          </div>      
                                           <label class="col-sm-2 col-form-label">Item No.</label>
                                          <div class="col-sm-3">
                                              <input class="form-control" type="text" placeholder="Item No." name="model" id="model" value="<?=$all_data->model?>">
                                          </div>                                    
                                         </div>     
                                         <div class="form-group row">
                                             <label class="col-sm-2 col-form-label">Side Description</label>
                                              <div class="col-sm-9">
                                                  <textarea class="form-control" name="side_desc" id="editor2" placeholder="Side Description"><?=$all_data->side_desc?></textarea>
                                                    <script>
                                                          var editor = CKEDITOR.replace( 'editor2' );
                                                          CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                                   </script>                                          
                                              </div>
                                        </div>                              
                                         <!--  <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">Short Description</label>
                                              <div class="col-sm-9">
                                                  <textarea class="form-control" name="sml_desc" rows="3" placeholder="Short Description"><?=$all_data->sml_desc?></textarea>
                                              </div>
                                          </div> -->                                                               
                             
                                          <div class="form-group row">
                                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                            <div class="col-sm-9">                      
                                              <input type="file" class="form-control"  name="post_img" id="fileInput">
                                                    <input type="hidden" id="x" name="x" />
                                                    <input type="hidden" id="y" name="y" />
                                                    <input type="hidden" id="w" name="w" />
                                                    <input type="hidden" id="h" name="h" />
                                                  <p><img id="imagePreview" style="display:none;"/></p> 
                                                   <?php  if($all_data->post_img !='')  {  ?>
                                                   <img src="<?=base_url('post/'.$all_data->post_img)?>">
                                                   <br>  
                                                   <input type="button"value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="post" col_name="post_img" dest="post" dest_thumb="post/thumb">   
                                                   <? } ?>
                                            </div>
                                        </div>    
                                   
                                         <div class="form-group row">
                                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control"  name="bg_img" id="fileInput1">
                                                  <input type="hidden" id="x1" name="x1" />
                                                  <input type="hidden" id="y1" name="y1" />
                                                  <input type="hidden" id="w1" name="w1" />
                                                  <input type="hidden" id="h1" name="h1" />
                                                <p><img id="imagePreview1" style="display:none; width: 1200px;"/></p> 
                                                 <?php  if($all_data->bg_img !='')  {  ?>
                                                   <img src="<?=base_url('background/'.$all_data->bg_img)?>">
                                                   <br>  
                                                   <input type="button" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="post" col_name="bg_img" dest="background" dest_thumb="background/thumb">   
                                                  <? } ?>
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
<script src='<?=base_url()?>assets/js/autosize.js'></script>