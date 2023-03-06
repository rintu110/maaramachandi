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
                        <h4>Add Gallery Category Form</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category Name&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="cat" placeholder="Category Name"  id="field_name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" onblur="check_duplicate(this.value);" pg_nm = 'cat' ids = 'gallery_cat' parent = "0">
                        </div>
                    </div>                     
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category URL&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Category URL" name="slug_url" id="slug_url">
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Short Description (If Any)</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="short_desc" placeholder="Short Description"></textarea>                                           
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
                        <button type="button" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script defer="defer" type="text/javascript">
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
       if(vals !='') 
       {
           var string = vals.replace(/  +/g, ' ');
           $('#'+ids).val(string);            
       }
       
    }

    function check_duplicate(vals)
    {       
         var field_nm = $('#field_name').attr("pg_nm"); 
         var ids = $('#field_name').attr("ids"); 
        // var parent = $('#field_name').attr("parent"); 
        
         var urls = "<?=base_url('admin/check_duplicate')?>/"+field_nm+"/"+ids+"/"+vals;
         var urls = encodeURI(urls);

         $.post( urls, function( data ) {
            if(data == 1)
            {
               $('#slug_url').val('');
               $('#inline_green').hide();                
               $('#inline_red').show();        
               $('#field_name').css('border-color', 'red');
               $('#field_name').focus();
            }
            else if(data == 0)
            {
                $('#inline_red').hide();
                $('#inline_green').show();
                $('#field_name').css('border-color', 'green');
            }
        });
    }

</script>