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
                        <h4>Add Product &nbsp;&nbsp;
                            
                             <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.location='<?=base_url('admin/product')?>'">Add New</button>
                             <button type="button" class="btn btn-sm btn-success w-md m-b-5" onclick="window.location='<?=base_url('admin/product')?>'">View All</button>

                          &nbsp;&nbsp;</h4>
                    </div>
                </div>

                <div class="row">
                        <form method="post" name="frm_page" enctype="multipart/form-data">
                        <input type="hidden" name="post_type" value="Product">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Product Form</a></li>
                                <li><a href="#tab2" data-toggle="tab">Description</a></li>
                                <li><a href="#tab3" data-toggle="tab">Specification</a></li>
                                <li><a href="#tab4" data-toggle="tab">SEO Context</a></li>
                            </ul>
                            <!-- Tab panels -->                            

                            <div class="tab-content">
                               <div class="tab-pane fade in active" id="tab1">
                                <div class="panel-body">                                        
                                 <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Product Name&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="post_name" id="field_name" placeholder="Product Name" onkeyup="mytext(this.value,this.id);makeurl(this.value,document.getElementById('slug_url'))" required>
                                        </div>
                                    </div>                                      
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Slug URL&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Product URL" name="slug_url" id="slug_url" required>
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
                                         <label class="col-sm-2 col-form-label">Sub Category</label>
                                        <div class="col-sm-3">
                                            <select name="subcat_id" class="form-control" id="subcat_id">
                                                <option value="">Subcategory</option>
                                            </select>
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
                                                  <textarea class="form-control" name="full_desc" id="editor2" placeholder="Full Description"></textarea>
                                                    <script>
                                                          var editor = CKEDITOR.replace( 'editor2' );
                                                          CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                                   </script>                                          
                                              </div>
                                        </div>                          
                           
                                        <div class="form-group row">
                                          <label for="example-url-input" class="col-sm-2 col-form-label">Upload Post Image</label> 
                                          <div class="col-sm-9">                      
                                            <input type="file" class="form-control"  name="post_img" id="fileInput">
                                                  <input type="hidden" id="x" name="x" />
                                                  <input type="hidden" id="y" name="y" />
                                                  <input type="hidden" id="w" name="w" />
                                                  <input type="hidden" id="h" name="h" />
                                                <p><img id="imagePreview" style="display:none;"/></p> 
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
                                          </div>
                                       </div> 
                                   </div>
                                 </div>



                                <div class="tab-pane fade" id="tab2">
                                  <div class="panel-body">
                                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>  
                                    <div id="ftr_div">    
                                     <div class="row">
                                        <div class="col-md-12">
                                          <fieldset>
                                              <legend style="text-align: center; font-weight: bold;background: #f2c9ab;">Section 1</legend> 
                                              <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Heading&nbsp;<span class="red">*</span></label>
                                                  <div class="col-sm-10">
                                                      <input class="form-control" type="text" name="heading[]" placeholder="Content">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Content&nbsp;<span class="red">*</span></label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" name="content[]" id="editor3"></textarea>
                                                        <script>
                                                           var editor = CKEDITOR.replace('editor3');                                                            
                                                      </script>
                                                  </div>                                              
                                              </div>
                                              <!-- <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                  <div class="col-sm-10">
                                                        <input type="radio" name="cnt_position[]" value="0">&nbsp;Left&nbsp;&nbsp;
                                                        <input type="radio" name="cnt_position[]" value="1">&nbsp;Right&nbsp;&nbsp;
                                                        <input type="radio" name="cnt_position[]" value="2">&nbsp;Center                                                         
                                                  </div>
                                              </div>   -->  
                                              
                                               <div class="form-group row">
                                                   <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                                   <div class="col-sm-7">
                                                      <input type="file" class="form-control"  name="image[]" id="fileInput2">
                                                       <input type="hidden" id="x2" name="x" />
                                                        <input type="hidden" id="y2" name="y" />
                                                        <input type="hidden" id="w2" name="w" />
                                                        <input type="hidden" id="h2" name="h" />
                                                      <p><img id="imagePreview2" style="display:none;"/></p> 
                                                  </div> 
                                                  <div class="col-sm-3" style="text-align: right;">
                                                    <input type="button" name="" value="+" id="cnt_add" class="btn btn-success">
                                                  </div> 
                                                 <!--  <div class="col-sm-3" style="text-align: right;">
                                                       <input type="radio" name="img_position[]" value="0">&nbsp;Left&nbsp;&nbsp;
                                                       <input type="radio" name="img_position[]" value="1">&nbsp;Right&nbsp;&nbsp;
                                                       <input type="radio" name="img_position[]" value="2">&nbsp;Center 
                                                  </div> -->                                     
                                              </div>  
                                           <!--    <div class="form-group row">
                                                   <label for="example-url-input" class="col-sm-2 col-form-label">Footer Line (if Any)</label>
                                                  <div class="col-sm-9">
                                                       <input class="form-control" type="text" name="footer_line[]" placeholder="Footer Line (if Any)">
                                                  </div>   
                                                 
                                             </div>     -->                                                                                   
                                          </fieldset>
                                       </div>
                                     </div> 
                                    </div>  
                                   </div>
                                 </div>                            
                               
                                <div class="tab-pane fade" id="tab3">
                                  <div class="panel-body">
                                    <div id="new_spec">    
                                       <div class="row">
                                          <div class="col-md-12">   
                                               <div class="form-group row">
                                                 <div class="col-sm-12" style="text-align: right;">
                                                    <input type="button" value="+ Add New Specs" id="new_specs" class="btn btn-warning new_specs">
                                                 </div> 
                                               </div>                                     
                                               <div class="form-group row">
                                                  <div class="col-sm-2">
                                                      <label>Category</label>                                                
                                                      <input class="form-control" type="text" name="category[]" placeholder="Category" >
                                                   </div>   
                                                   <div class="col-sm-2">
                                                      <label>SubCategory</label>                                                
                                                      <input class="form-control" type="text" name="subcategory[]" placeholder="SubCategory">
                                                  </div>                                            
                                                  <div class="col-sm-2">
                                                      <label>Property</label>                                                
                                                      <input class="form-control" type="text" name="property[]" placeholder="Property">
                                                  </div>
                                                  <div class="col-sm-3">
                                                      <label>Attribute</label>                                                
                                                      <input class="form-control" type="text" name="attribute[]" placeholder="Attribute">
                                                  </div>

                                                  <div class="col-sm-1">
                                                     <label>&nbsp;</label><br>    
                                                     <input type="button" name="" value="+" id="attr_add" class="btn btn-success attr_add">
                                                  </div> 
                                                  <div class="col-sm-2">
                                                     <label>&nbsp;</label><br>    
                                                     <input type="button" value="+ Add SubCategory" id="subcat_add" class="btn btn-black add_subcats">
                                                  </div>  
                                               </div>
                                          </div>
                                       </div>
                                    </div>
                                  </div> 
                                </div> 
                            
                                <div class="tab-pane fade" id="tab4">
                                    <div class="panel-body">
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

   var rowCount = 1;
   var rowCnt = 2;
   var editorss = 25;
   var kk = 0;
  // $(document).ready(function(){
     $("#cnt_add").click(function(){
        rowCount ++;
        rowCnt ++;
        editorss++;
        kk++;

        //Append Script File
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "<?=base_url();?>assets/js/imgareaselect.js";
        $("ftr_div").append(s);

        $("#ftr_div").append('<div id="ftr_div'+rowCount+'">'
                               +`<div class="row">
                                 <div class="col-md-12">
                                  <fieldset>`           
                                     +'<legend style="text-align: center; font-weight: bold;background: #f2c9ab;">Section '+rowCount+'</legend>'                                  
                                   +`<div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Heading</label>
                                      <div class="col-sm-10">
                                          <input class="form-control" type="text" name="heading[]" placeholder="Heading">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Content</label>
                                      <div class="col-sm-10">`
                                          +'<textarea class="form-control" name="content[]" id="editor'+editorss+'"></textarea>'
                                           +'<script>'
                                           +'var editor = CKEDITOR.replace("editor'+editorss+'");'                                                           
                                          +`<\/script>
                                      </div>                                              
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">&nbsp;</label>
                                      <div class="col-sm-10">`
                                            +'<input type="radio" name="cnt_position['+kk+'][]" value="0">&nbsp;Left&nbsp;&nbsp;'
                                            +'<input type="radio" name="cnt_position['+kk+'][]" value="1">&nbsp;Right&nbsp;&nbsp;'                                                         
                                            +'<input type="radio" name="cnt_position['+kk+'][]" value="2">&nbsp;Center'                                                         
                                      +`</div>
                                    </div>    
                                    <div class="form-group row">
                                      <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                      <div class="col-sm-7">`
                                            +'<input type="file" class="form-control"  name="image[]" id="fileInput'+rowCnt+'">'
                                             +'<input type="hidden" id="x'+rowCnt+'" name="x" />'
                                             +'<input type="hidden" id="y'+rowCnt+'" name="y" />'
                                             +'<input type="hidden" id="w'+rowCnt+'" name="w" />'
                                             +'<input type="hidden" id="h'+rowCnt+'" name="h" />'
                                            +'<p><img id="imagePreview'+rowCnt+'" style="display:none;"/></p>' 
                                        +`</div> 
                                        <div class="col-sm-3" style="text-align: right;">`
                                         +'<input type="radio" name="img_position['+kk+'][]" value="0">&nbsp;Left&nbsp;&nbsp;'
                                         +'<input type="radio" name="img_position['+kk+'][]" value="1">&nbsp;Right&nbsp;&nbsp;'
                                         +'<input type="radio" name="img_position['+kk+'][]" value="2">&nbsp;Center'
                                      +`</div>                                    
                                  </div> 
                                  <div class="form-group row">
                                       <label for="example-url-input" class="col-sm-2 col-form-label">Footer Line (if Any)</label>
                                      <div class="col-sm-9">
                                           <input class="form-control" type="text" name="footer_line[]" placeholder="Footer Line (if Any)">
                                      </div>
                                       <div class="col-sm-1" style="text-align: right;">`
                                        +'<input type="button" name="" value="X" onClick = "removeDiv(\'ftr_div'+rowCount+'\')" id="remove_btn" class="btn btn-danger">'
                                      +`</div>
                                  </div>                                                                                       
                                 </fieldset>
                                </div>
                             </div>`);
        
      
              // Prepare instant image preview      
              
              var _URL = window.URL || window.webkitURL;

              var p = 'p'+rowCnt;

              var p = $("#imagePreview"+rowCnt);

              $("#fileInput"+rowCnt).change(function(){   

                  var file = $(this)[0].files[0];

                  img = new Image();
                  var imgwidth = 0;
                  var imgheight = 0;          

                  img.src = _URL.createObjectURL(file);
                  img.onload = function() {
                     imgwidth = this.width;
                     imgheight = this.height;

                     $('#x'+rowCnt).val(1);
                     $('#y'+rowCnt).val(1);
                     $('#w'+rowCnt).val(imgwidth);
                     $('#h'+rowCnt).val(imgheight);
                  }         
                 
                  //fadeOut or hide preview
                  p.fadeOut();         
              
                  //prepare HTML5 FileReader
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("fileInput"+rowCnt).files[0]);
              
                  oFReader.onload = function(oFREvent){
                      p.attr('src', oFREvent.target.result).fadeIn();
                  };         
              });
       

          // Set image coordinates
          var updateCoords = 'updateCoords'+rowCnt;

          function updateCoords(im,obj){
              var img = document.getElementById("imagePreview3");
              var orgHeight = img.naturalHeight;
              var orgWidth = img.naturalWidth;
            
              var porcX = orgWidth/im.width;
              var porcY = orgHeight/im.height;
            
              $('input#x'+rowCnt).val(Math.round(obj.x1 * porcX));
              $('input#y'+rowCnt).val(Math.round(obj.y1 * porcY));
              $('input#w'+rowCnt).val(Math.round(obj.width * porcX));
              $('input#h'+rowCnt).val(Math.round(obj.height * porcY));
          }

          // Implement imgAreaSelect plugin
          $('#imagePreview'+rowCnt).imgAreaSelect({
              minWidth: '600',
              minHeight: '400',
              onSelectEnd: updateCoords
          });

     });

          //New Specification Add
           $(".new_specs").click(function(){
              rowCount ++;
              rowCnt ++;
              $("#new_spec").append('<div id="new_spec'+rowCount+'">'
                                    +`<div class="row">
                                      <div class="col-md-12">                   
                                            <div class="form-group row">
                                              <div class="col-sm-2">
                                                  <label>Category</label>                                                
                                                  <input class="form-control" type="text" name="category[]" placeholder="Category">
                                               </div>   
                                               <div class="col-sm-2">
                                                  <label>SubCategory</label>                                                
                                                  <input class="form-control" type="text" name="subcategory[]" placeholder="SubCategory">
                                              </div>
                                              <div class="col-sm-2">
                                                  <label>Property</label>                                                
                                                  <input class="form-control" type="text" name="property[]" placeholder="Property">
                                              </div>
                                              <div class="col-sm-3">
                                                  <label>Attribute</label>                                                
                                                  <input class="form-control" type="text" name="attribute[]" placeholder="Attribute">
                                              </div>
                                              <div class="col-sm-1">
                                                 <label>&nbsp;</label><br>`    
                                                 +'<input type="button" name="" value="+" id="attr_add'+rowCount+'" class="btn btn-success attr_adds">'
                                              +`</div> 
                                              <div class="col-sm-2">
                                                   <label>&nbsp;</label><br>`    
                                                 +'<input type="button" value="X" onClick = "removeDiv(\'new_spec'+rowCount+'\')" id="remove_btn" class="btn btn-danger">'
                                              +`</div>  
                                            </div>
                                      </div>
                                    </div>`);
           });


               //New Attribute Add
               $(".attr_add").click(function(){
                  rowCount ++;
                  rowCnt ++;
                  $("#new_spec").append('<div id="new_spec'+rowCount+'">'
                                        +`<div class="row">
                                           <div class="col-md-12">                   
                                                <div class="form-group row">
                                                <div class="col-sm-2">                   
                                                  <input class="form-control" type="hidden" name="category[]" placeholder="Category">
                                               </div>   
                                               <div class="col-sm-2">                        
                                                  <input class="form-control" type="hidden" name="subcategory[]" placeholder="SubCategory">
                                              </div>
                                                  <div class="col-sm-2">
                                                      <label>Property</label>                                                
                                                      <input class="form-control" type="text" name="property[]" placeholder="Property">
                                                  </div>
                                                  <div class="col-sm-3">
                                                      <label>Attribute</label>                                                
                                                      <input class="form-control" type="text" name="attribute[]" placeholder="Attribute">
                                                  </div>
                                                  <div class="col-sm-1">
                                                     <label>&nbsp;</label><br>`
                                                      +'<input type="button" value="X" onClick = "removeDiv(\'new_spec'+rowCount+'\')" id="remove_btn" class="btn btn-danger">'
                                                  +`</div>                                                
                                                </div>
                                          </div>
                                        </div>`);
                }); 
        //  }); 

          
           //New Attribute Add In nested 
           var nested_div = '<div id="new_spec'+rowCount+'">'
                                          +`<div class="row">
                                            <div class="col-md-12">                   
                                             <div class="form-group row">
                                               <div class="col-sm-2">                                                                                       
                                                  <input class="form-control" type="hidden" name="category[]" placeholder="Category">
                                               </div>   
                                               <div class="col-sm-2">                                                                                              
                                                  <input class="form-control" type="hidden" name="subcategory[]" placeholder="SubCategory">
                                              </div>
                                               <div class="col-sm-2">
                                                 <label>Property</label>                                                
                                                 <input class="form-control" type="text" name="property[]" placeholder="Property">
                                               </div>
                                               <div class="col-sm-3">
                                                 <label>Attribute</label>                                                
                                                 <input class="form-control" type="text" name="attribute[]" placeholder="Attribute">
                                               </div>
                                               <div class="col-sm-1">
                                                 <label>&nbsp;</label><br>`
                                                +'<input type="button" value="X" onClick = "removeDiv(\'new_spec'+rowCount+'\')" id="remove_btn" class="btn btn-danger">'
                                               +`</div>                                                
                                               </div>
                                              </div>
                                        </div>`;
          
           $(document).on("click",".attr_adds",function(){                                                                    
                  rowCount ++;
                  rowCnt ++;
                  $("#new_spec").append(nested_div);
            });

          //New Attribute Add In nested 
           var subcat_div = '<div id="new_spec'+rowCount+'">'
                                +`<div class="row">
                                  <div class="col-md-12">                   
                                  <div class="form-group row">
                                    <div class="col-sm-2">
                                     <input class="form-control" type="hidden" name="category[]" placeholder="Category">
                                     </div>   
                                     <div class="col-sm-2">
                                        <label>SubCategory</label>                                                
                                        <input class="form-control" type="text" name="subcategory[]" placeholder="SubCategory">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Property</label>                                                
                                        <input class="form-control" type="text" name="property[]" placeholder="Property">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Attribute</label>                                                
                                        <input class="form-control" type="text" name="attribute[]" placeholder="Attribute">
                                    </div>
                                    <div class="col-sm-1">
                                       <label>&nbsp;</label><br>`    
                                       +'<input type="button" name="" value="+" id="attr_add'+rowCount+'" class="btn btn-success attr_adds">'
                                    +`</div> 
                                    <div class="col-sm-2">
                                       <label>&nbsp;</label><br>`                                          
                                       +'<input type="button" value="X" onClick = "removeDiv(\'new_spec'+rowCount+'\')" id="remove_btn" class="btn btn-danger">'
                                    +`</div>  
                                  </div>
                                    </div>
                              </div>`; 


           $(document).on("click",".add_subcats",function(){                                                                    
                  rowCount ++;
                  rowCnt ++;
                  $("#new_spec").append(subcat_div);
            });                

          function removeDiv(divId) 
          {
              $("#"+divId).remove();
          }
</script>    