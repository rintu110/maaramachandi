<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add News Category</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/ncategory')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
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
                            <input class="form-control" type="text" placeholder="News Category" name="cat_name" id="cat_name" onkeyup="mytext(this.value,this.id);" onblur="makeurl(this.value);check_duplicate(document.getElementById('slug_url').value);" pg_nm='cat_name' ids='category' types = 'News' required="required">
                             <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Category Already Exist. Please try another Page Name.</span> 
                             <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">URL Available</span>
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">URL&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Page URL" name="slug_url" id="slug_url" required="required">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Parent</label>
                        <div class="col-sm-3">
                            <select name="parent_id" class="form-control">
                                <option value="">Select</option>                             
                                <?php foreach ($category as $v) { ?>
                                   
                               <?php 
                                       $q = $this->db->query("SELECT * FROM category WHERE parent_id = '".$v->id."'")->result();

                                       $str = '';
                                       if(sizeof($q) > 0)
                                       {
                                           foreach ($q as $v1) {
                                         
                                              $str .='<option value="'.$v1->id.'">&nbsp;&nbsp;--&nbsp;&nbsp;'.$v1->cat_name.'</option>';
                                          
                                           }
                                       }
                                   ?>
                                   <option value="<?=$v->id?>"><?=$v->cat_name?></option> 
                                   <?=$str?>         
                           <?  } ?>  
                            </select>
                        </div>
                    </div>     
                                      
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="sml_dsc" rows="3" placeholder="Short Description"></textarea>                                           
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
                            <p><img id="imagePreview" style="display:none; max-width: 1200px; margin-top: 10px;"/></p>
                       </div>                  
                    </div>   
                   

                    <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>SEO CONTEXT</legend>
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
                                </fieldset>
                            </div>
                        </div>
                  </div>                
            </div>
        </div>
    </div>
</section>
</form>
<script language="javascript">
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
       if(vals !='') 
       {
           var string = vals.replace(/  +/g, ' ');
           $('#'+ids).val(string);            
       }
       
    }
    $('#submit').attr('disabled',false);

    function check_duplicate(vals)
    {    
         if(vals != '')
         {   
             var field_nm = 'slug_url'; 
             var ids = $('#cat_name').attr("ids"); 
             var types = $('#cat_name').attr("types"); 
           
             vals = encodeURI(vals);
            
             var urls = "<?=base_url('admin/check_duplicate')?>/"+field_nm+"/"+ids+"/"+vals+"/"+types;
             var urls = encodeURI(urls);

             $.get( urls, function( data ) {
                if(data == 1)
                {
                   $('#slug_url').val('');
                   $('#inline_green').hide();                
                   $('#inline_red').show();        
                   $('#field_name').css('border-color', 'red');
                   $('#field_name').focus();
                   $('#submit').prop('disabled',true);

                }
                else if(data == 0)
                {
                    $('#inline_red').hide();
                    $('#inline_green').show();
                    $('#field_name').css('border-color', 'green');
                    $('#submit').prop('disabled',false);

                }
            });
         }
         else
         {
             $('#inline_red').hide();
             $('#inline_green').hide();
         }    
    }
   
</script>    