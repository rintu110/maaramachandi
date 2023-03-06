 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Edit Category</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/ncategory')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_ncategory')?>'">
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
                        <label class="col-sm-2 col-form-label">Category&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Category" name="cat_name" id="cat_name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" value="<?=$all_data->cat_name?>" required>
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Page URL" name="slug_url" id="slug_url" value="<?=$all_data->slug_url?>" required>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Parent</label>
                        <div class="col-sm-3">
                            <select name="parent_id" class="form-control">
                                <option value="">Select</option>                             
                                <?php 
                                    foreach ($category as $v) {
                               
                                       $q = $this->db->query("SELECT * FROM category WHERE parent_id = '".$v->id."' and status = 1 and del_status = 0")->result();

                                       $str = '';
                                       if(sizeof($q) > 0)
                                       {
                                           foreach ($q as $v1) {

                                              $sel = '';

                                               if($v1->id == $all_data->parent_id)
                                               {
                                                   $sel = 'SELECTED';
                                               }
                                         
                                              $str .='<option value="'.$v1->id.'" '.$sel.'>&nbsp;&nbsp;--&nbsp;&nbsp;'.$v1->cat_name.'</option>';
                                          
                                           }
                                       }
                                  
                                      $sel = '';
                                      if($v->id == $all_data->parent_id)
                                      {
                                          $sel = 'SELECTED';
                                      }
                                   ?>
                                    <option value="<?=$v->id?>" <?=$sel?>><?=$v->cat_name?></option>
                                    <?=$str?>
                               <?php } ?>  
                            </select>
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="sml_dsc" rows="3" placeholder="Short Description"><?=$all_data->sml_dsc?></textarea>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner Image</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control"  name="bg_img" id="fileInput">       
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <p><img id="imagePreview" style="display:none; max-width: 1200px;"/></p>                            
                                <?php  if($all_data->bg_img !='')  {  ?>
                                   <img src="<?=base_url('background/'.$all_data->bg_img)?>" style="max-width: 1200px;">
                                   <br>  
                                   <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$all_data->id?>'" tbl="category" col_name="bg_img" dest="background" dest_thumb="background/thumb">   
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
                  </div>                 
            </div>
        </div>
    </div>
</section>
</form>
<script type="text/javascript">
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
</script>