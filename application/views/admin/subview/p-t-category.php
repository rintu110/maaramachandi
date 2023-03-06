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
                        <h4>Prodduction & Technology Category</h4>
                    </div>
                </div>

                <div class="row">
                        <form method="post" name="frm_page" enctype="multipart/form-data">
                        <input type="hidden" name="post_type" value="Product">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Category</a></li>                               
                            </ul>
                            <!-- Tab panels -->                            

                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="tab1">
                                <div class="panel-body">                                        
                                 <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category Name1&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="cat_name" id="field_name1" placeholder="Category Name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" required>
                                        </div>
                                         <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" placeholder="Category URL" name="slug_url" id="slug_url" required>
                                        </div>
                                    </div>    
                           
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                          <div class="col-sm-4">                      
                                            <input type="file" class="form-control"  name="post_img" id="fileInput">
                                                  <input type="hidden" id="x" name="x" />
                                                  <input type="hidden" id="y" name="y" />
                                                  <input type="hidden" id="w" name="w" />
                                                  <input type="hidden" id="h" name="h" />
                                                <p><img id="imagePreview" style="display:none;"/></p> 
                                          </div>
                                      </div> 
                                      <hr>
                                       <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category Name2&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="cat_name" id="field_name2" placeholder="Category Name" onkeyup="mytext(this.value,this.id);makeurl1(this.value,document.getElementById('slug_url1'))" required>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" placeholder="Category URL" name="slug_url" id="slug_url1" required>
                                            </div>
                                       </div>                                      
                                     
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                            <div class="col-sm-4">                      
                                              <input type="file" class="form-control"  name="post_img" id="fileInput6">
                                                    <input type="hidden" id="x6" name="x" />
                                                    <input type="hidden" id="y6" name="y" />
                                                    <input type="hidden" id="w6" name="w" />
                                                    <input type="hidden" id="h6" name="h" />
                                                  <p><img id="imagePreview6" style="display:none;"/></p> 
                                            </div>
                                        </div> 
                                         <hr>
                                       <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category Name3&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="cat_name" id="field_name2" placeholder="Category Name" onkeyup="mytext(this.value,this.id);makeurl2(this.value,document.getElementById('slug_url2'))" required>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                          <div class="col-sm-4">
                                              <input class="form-control" type="text" placeholder="Category URL" name="slug_url" id="slug_url2" required>
                                          </div>
                                       </div>                                      
                                               
                               
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                            <div class="col-sm-4">                      
                                              <input type="file" class="form-control"  name="post_img" id="fileInput7">
                                                    <input type="hidden" id="x7" name="x" />
                                                    <input type="hidden" id="y7" name="y" />
                                                    <input type="hidden" id="w7" name="w" />
                                                    <input type="hidden" id="h7" name="h" />
                                                  <p><img id="imagePreview7" style="display:none;"/></p> 
                                            </div>
                                        </div> 

                                         <hr>
                                       <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category Name4&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="cat_name" id="field_name2" placeholder="Category Name" onkeyup="mytext(this.value,this.id);makeurl3(this.value,document.getElementById('slug_url3'))" required>
                                        </div>
                                         <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" placeholder="Category URL" name="slug_url" id="slug_url3" required>
                                            </div>
                                       </div>                                                                                     
                               
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                            <div class="col-sm-4">                      
                                              <input type="file" class="form-control"  name="post_img" id="fileInput8">
                                                    <input type="hidden" id="x8" name="x" />
                                                    <input type="hidden" id="y8" name="y" />
                                                    <input type="hidden" id="w8" name="w" />
                                                    <input type="hidden" id="h8" name="h" />
                                                  <p><img id="imagePreview8" style="display:none;"/></p> 
                                            </div>
                                        </div>                                     
                                   </div>
                                 </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group" style="margin:15px;">                                
                                <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;&nbsp;                                 
                                <button type="button" class="btn btn-default" onclick="window.location='<?=base_url('admin/add_page')?>'">Cancel</button>
                              </div>
                           </div>
                         </div>
                        </div>
                       </form>
                    </div> 

            </div>
        </div>
    </div>
</section>        
<script type="text/javascript">  
    function makeurl(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url').val(url);
    }

    function makeurl1(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url1').val(url);
    }

    function makeurl2(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url2').val(url);
    }

    function makeurl3(vals) 
    {
        var hd = vals.trim();
        var newhd = hd.replace(/[.]/gi, '').toLowerCase();
        var urls = newhd.replace(/[^a-z0-9]/gi, '-').toLowerCase();
        var url = urls.replace(/[\. ,:-]+/g, "-");
        $('#slug_url3').val(url);
    }

    function mytext(vals,ids)
    {
       var string = vals.replace(/  +/g, ' ');
       $('#'+ids).val(string);
    }  
</script>    