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
                        <h4>Add Solution Form&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.lcoation = '<?=base_url('admin/solution')?>'">View All</button>&nbsp;&nbsp;</h4>
                    </div>
                </div>
                 <form method="post" name="frm_page" enctype="multipart/form-data">
                  <input type="hidden" name="post_type" value="Solution">
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Title" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" required="required">
                                </div>
                            </div>                                      
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="URL" name="slug_url" id="slug_url" required="required">
                                </div>
                            </div>
                            <!--  <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-3">
                                    <select name="cat_id" class="form-control" onchange="get_subcat(this.value)">
                                        <option value="">Select Category</option> 
                                         <?php foreach ($category as $v) { ?>                               
                                           <option value="<?=$v->id?>"><?=$v->cat_name?></option> 
                                         <?  } ?>                              
                                    </select>
                                </div>
                            </div>  -->                                      
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

     $('#datepick input').datepicker({
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });
</script>    