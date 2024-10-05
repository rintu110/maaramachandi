<link href="<?=base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
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
                        <h4>Edit Blog Form&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.location ='<?=base_url('admin/solution')?>'">View All</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_solution')?>'">Add Solution</button></h4>
                    </div>
                </div>
               <form method="post" name="frm_page" enctype="multipart/form-data">
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog Title&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Blog Title" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" value="<?=$all_data->post_name?>" required>
                                </div>
                            </div>                                      
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Product URL" name="slug_url" id="slug_url" value="<?=$all_data->slug_url?>" required>
                                </div>
                            </div>
                            <!--  <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-3">
                                    <select name="cat_id" class="form-control" onchange="get_subcat(this.value)">
                                        <option value="">Select Category</option> 
                                         <?php foreach ($category as $v) {
                                            $sel = '';
                                            if($v->id == $all_data->cat_id)
                                            {
                                                $sel = 'SELECTED';
                                            } ?>                               
                                                 <option value="<?=$v->id?>" <?=$sel?>><?=$v->cat_name?></option> 
                                         <?  } ?>                              
                                    </select>
                                </div>
                            </div>     -->                        

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Posted By&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="posted_by"  placeholder="Posted By" value="<?=$all_data->posted_by?>" required="required">
                                </div>
                                <label class="col-sm-2 col-form-label">Posted On&nbsp;<span class="red">*</span></label>
                                   <div class="col-sm-2" id="datepick">
                                    <input class="form-control" type="text" name="posted_on" value="<?=date('m/d/Y',strtotime($all_data->posted_on))?>"  placeholder="Posted On" required="required">
                                </div>
                            </div>            
                                               
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="sml_desc" rows="3" placeholder="Short Description"><?=$all_data->sml_desc?></textarea>                                           
                                </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Full Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="full_desc" id="editor1" placeholder="Full Description"><?=$all_data->full_desc?></textarea>
                                      <script>
                                            var editor = CKEDITOR.replace( 'editor1' );
                                            CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                    </script>                                          
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-url-input" class="col-sm-2 col-form-label">Upload Blog Image</label>
                              <div class="col-sm-9"> 
                                <input type="file" class="form-control"  name="post_img" id="fileInput">       
                                      <input type="hidden" id="x" name="x" />
                                      <input type="hidden" id="y" name="y" />
                                      <input type="hidden" id="w" name="w" />
                                      <input type="hidden" id="h" name="h" />
                                      <p><img id="imagePreview" style="display:none; max-width: 1000px;"/></p>                            
                                      <?php  if($all_data->post_img !='')  {  ?>
                                         <img src="<?=base_url('post/'.$all_data->post_img)?>">
                                         <br>  
                                         <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$all_data->id?>'" tbl="post" col_name="post_img" dest="post" dest_thumb="post/thumb">   
                                     <? } ?>                                                   
                              </div>
                           </div>

                            <div class="form-group row">
                              <label for="example-url-input" class="col-sm-2 col-form-label">Details Blog Image</label>
                              <div class="col-sm-9"> 
                                <input type="file" class="form-control"  name="news_dtls_bnr" id="fileInput2">       
                                      <input type="hidden" id="x2" name="x2" />
                                      <input type="hidden" id="y2" name="y2" />
                                      <input type="hidden" id="w2" name="w2" />
                                      <input type="hidden" id="h2" name="h2" />
                                      <p><img id="imagePreview2" style="display:none; max-width: 1000px;"/></p>                            
                                      <?php  if($all_data->news_dtls_bnr !='')  {  ?>
                                         <img src="<?=base_url('post/'.$all_data->news_dtls_bnr)?>" style="max-width: 1000px;">
                                         <br>  
                                         <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="post" col_name="news_dtls_bnr" dest="post" dest_thumb="post/thumb">   
                                     <? } ?>                                                   
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="form-control"  name="bg_img" id="fileInput">       
                                  <input type="hidden" id="x1" name="x1" />
                                  <input type="hidden" id="y1" name="y1" />
                                  <input type="hidden" id="w1" name="w1" />
                                  <input type="hidden" id="h1" name="h1" />
                                  <p><img id="imagePreview1" style="display:none; width: 800px;"/></p>                            
                                  <?php  if($all_data->bg_img !='')  {  ?>
                                     <img src="<?=base_url('background/'.$all_data->bg_img)?>" width="1200">
                                     <br>  
                                     <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="post" col_name="bg_img" dest="background" dest_thumb="background/thumb">   
                                 <? } ?> 
                              </div>
                          </div>                            


                          <div class="row">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend>SEO CONTEXT</legend>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Title</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="meta_title" placeholder="Meta Title" value="<?=(isset($post_meta->meta_title) && $post_meta->meta_title!='')?$post_meta->meta_title:''?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="meta_key" placeholder="Meta Keyword" value="<?=(isset($post_meta->meta_key) && $post_meta->meta_key!='')?$post_meta->meta_key:''?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="meta_desc" rows="3" placeholder="Meta Description"><?=(isset($post_meta->meta_desc) && $post_meta->meta_desc!='')?$post_meta->meta_desc:''?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Extra Meta</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="extra_meta" placeholder="Extra Meta"><?=(isset($post_meta->extra_meta) && $post_meta->extra_meta!='')?$post_meta->extra_meta:''?></textarea>
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Canonical Code</label>
                                                <div class="col-sm-9">
                                                     <input class="form-control" type="text" name="canonical_code" placeholder="Canonical Code" value="<?=(isset($post_meta->canonical_code) && $post_meta->canonical_code!='')?$post_meta->canonical_code:''?>">
                                                </div>
                                             </div>                                                   
                                        </fieldset>
                                    </div>
                            </div>
                            <hr >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-success">Update</button>&nbsp;&nbsp;&nbsp;                                 
                                <button type="button" class="btn btn-default" onclick="window.location='<?=base_url('admin/add_page')?>'">Cancel</button>
                            </div>
                        </div>
                 </form>
            </div>
        </div>
    </div>
</section>        
<script type="text/javascript">
     $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });
</script>