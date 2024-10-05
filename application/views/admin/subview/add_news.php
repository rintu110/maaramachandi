<link href="<?=base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add News</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/newslist')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_news')?>'">
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
                  <input type="hidden" name="post_type" value="News">
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Blog Title&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Blog Title" onkeyup="mytext(this.value,this.id);" onblur="makeurl(this.value);check_duplicate(document.getElementById('slug_url').value);" required="required" types = 'News' ids='post'>
                                     <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Page Already Exist. Please try another Page Name.</span> 
                                    <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">URL Available</span> 
                                </div>
                            </div>                                      
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="URL" name="slug_url" id="slug_url" required="required">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-3">
                                    <select name="cat_id" class="form-control" onchange="get_subcat(this.value)">
                                        <option value="">Select Category</option> 
                                         <?php foreach ($category as $v) { ?>                               
                                           <option value="<?=$v->id?>"><?=$v->cat_name?></option> 
                                         <?  } ?>                              
                                    </select>
                                </div>
                            </div>                                       
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Posted By&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="posted_by"  placeholder="Posted By" required="required">
                                </div>
                                <label class="col-sm-2 col-form-label">Posted On&nbsp;<span class="red">*</span></label>
                                  <div class="col-sm-2" id="datepick">
                                    <input class="form-control" type="text" name="posted_on"  placeholder="Posted On" required="required">
                                </div>
                            </div>                   
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="sml_desc" rows="3" placeholder="Short Description"></textarea>
                                </div>
                            </div>                          


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Full Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="full_desc" id="editor1" placeholder="Full Description"></textarea>
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
                                          <p><img id="imagePreview" class="img_prv_bg"  style="display:none; max-width: 1200px;"/></p> 
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
                                          <p><img id="imagePreview2" class="img_prv_bg"  style="display:none; max-width: 1200px;"/></p> 
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
                                      <p><img id="imagePreview1" class="img_prv_bg" style="display:none;  max-width: 1200px;"/></p> 
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
                            <hr >
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;&nbsp;                                 
                                <button type="button" class="btn btn-default" onclick="window.location='<?=base_url('admin/add_page')?>'">Cancel</button>
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

     $('#submit').prop('disabled',false);

     function check_duplicate(vals)
     {       
         if(vals != '')
         {
             var field_nm = 'slug_url'; 
             var ids = $('#field_name').attr("ids"); 
             var types = $('#field_name').attr("types"); 

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

     $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });
</script>    