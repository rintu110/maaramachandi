<script src="<?=base_url()?>assets/ckeditor/ckeditor.js" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/ckfinder/ckfinder.js"></script>
<link href="<?=base_url();?>assets/slim/slim.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/slim/slim.kickstart.min.js"></script>
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
                        <h4>Edit Product Form&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.open('<?=base_url('admin/product')?>','_blank')">View All</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_product')?>'">Add Product</button></h4>
                    </div>
                </div>
               <form method="post" name="frm_page" enctype="multipart/form-data">
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Product Name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" value="<?=$all_data->post_name?>">
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
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sub Category</label>
                                <div class="col-sm-3">
                                    <select name="subcat_id" class="form-control" id="subcat_id">
                                        <option value="">Subcategory</option>
                                        <?
                                            $q = $this->db->query("SELECT cat_name,id FROM category WHERE parent_id = '".$all_data->cat_id."'")->result();

                                            if(sizeof($q) > 0)
                                            {
                                                foreach ($q as $k => $v) {

                                                     $sel = '';
                                                   
                                                     if($v->id == $all_data->subcat_id)
                                                     {
                                                          $sel = 'SELECTED';
                                                     }

                                                   ?>
                                                        <option value="<?=$v->id?>" <?=$sel?>><?=$v->cat_name?></option>
                                                   <?  
                                                }
                                            }
                                        ?>
                                    </select>
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
                                    <textarea class="form-control" name="side_desc" id="editor2" placeholder="Full Description"><?=$all_data->side_desc?></textarea>
                                      <script>
                                            var editor = CKEDITOR.replace( 'editor2' );
                                            CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                    </script>                                          
                                </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Specification</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="full_desc" id="editor1" placeholder="Specification"><?=$all_data->full_desc?></textarea>
                                      <script>
                                            var editor = CKEDITOR.replace( 'editor1' );
                                            CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                    </script>                                          
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Video</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="prd_vdo" rows="3" placeholder="Product Video"><?=$all_data->prd_vdo?></textarea>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Product Image</label>
                                <div class="col-sm-9">                           
                                     <div class="slim" style="width:500px; height:500px;" data-ratio="1:1" data-size="500,500" data-min-size="500,500">
                                          <?php  if($all_data->post_img !='')  {  ?>
                                                 <img src="<?=base_url('post/'.$all_data->post_img)?>">     
                                          <? } ?>
                                       <input type="file" class="form-control"  name="post_img">
                                    </div>
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner Image</label>
                                <div class="col-sm-9">
                                  <div class="slim" style="width:1300px; height:165px;" data-ratio="11:1" data-size="1920,165" data-min-size="1920,165">
                                      <?php  if($all_data->bg_img !='')  {  ?>
                                           <img src="<?=base_url('background/'.$all_data->bg_img)?>">     
                                       <? } ?>
                                       <input type="file" class="form-control" name="bg_img">
                                    </div>
                                </div>
                            </div>


                          <div class="row">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend>SEO CONTEXT</legend>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Title</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="meta_title" placeholder="Meta Title" value="<?=$all_data->meta_title?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="meta_key" placeholder="Meta Keyword" value="<?=$all_data->meta_key?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Meta Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="meta_desc" rows="3" placeholder="Meta Description"><?=$all_data->meta_desc?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Extra Meta</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="extra_meta" placeholder="Extra Meta"><?=$all_data->extra_meta?></textarea>
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Canonical Code</label>
                                                <div class="col-sm-9">
                                                     <input class="form-control" type="text" name="canonical_code" placeholder="Canonical Code" value="<?=$all_data->canonical_code?>">
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
<script src='<?=base_url()?>assets/js/autosize.js'></script>
<script type="text/javascript">
   autosize(document.querySelectorAll('textarea'));

    function makeurl(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url').val(url);
    }

    function mytext(vals,ids)
    {
       var string = vals.replace(/  +/g, ' ');
       $('#'+ids).val(string);
    }

    function get_subcat(vals)
    {
         var urls = "<?=base_url('admin/get_subcat')?>/"+vals;
         var urls = encodeURI(urls);

         $.post( urls, function( data ) {
          
            $('#subcat_id').val('');
            $('#subcat_id').html(data);
                      
        });
    }
</script>  