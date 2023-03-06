<?php
   // print_result($cnt_data);
?>
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
                        <h4>Product & Market Conent</h4>
                    </div>
                </div>

                <div class="row">
                        <form method="post" name="frm_page" enctype="multipart/form-data">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <?
                                if(sizeof($category) > 0 && is_array($category))
                                {
                                    $i = 1;
                                    foreach ($category as $k => $v) 
                                    {
                                        $class = '';
                                        if($i == 1)
                                        {
                                            $class = 'class="active"';
                                        }
                              ?>
                                        <li <?=$class?>>
                                          <a href="#tab<?=$i?>" data-toggle="tab"><?=$v->category?></a>
                                        </li>
                              <?          
                                       $i++;    
                                    }
                                }
                              ?>                                                         
                            </ul>
                            <!-- Tab panels -->                            

                            <div class="tab-content">

                                <div class="tab-pane fade in active" id="tab1">                                
                                  <div class="panel-body">
                                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>  
                                    <div id="ftr_div">    
                                     <div class="row">
                                        <div class="col-md-12">
                                          <fieldset>                                              
                                              <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Content&nbsp;<span class="red">*</span></label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" name="content[]" id="editor3"><?=(isset($cnt_data[0]['content']) && $cnt_data[0]['content'] !='')?$cnt_data[0]['content']:''?></textarea>
                                                        <script>
                                                           var editor = CKEDITOR.replace('editor3');                                                            
                                                      </script>
                                                  </div>                                              
                                              </div>                                           
                                              
                                               <div class="form-group row">
                                                   <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                                   <div class="col-sm-7">
                                                      <input type="file" class="form-control"  name="image[]" id="fileInput2">
                                                       <input type="hidden" id="x2" name="x2" />
                                                        <input type="hidden" id="y2" name="y2" />
                                                        <input type="hidden" id="w2" name="w2" />
                                                        <input type="hidden" id="h2" name="h2" />
                                                      <p><img id="imagePreview2" style="display:none;"/></p> 
                                                       <?php  if(isset($cnt_data[0]['image']) && $cnt_data[0]['image'] !='')  {  ?>
                                                         <img src="<?=base_url('post/'.$cnt_data[0]['image'])?>" style="max-width: 1200px;">
                                                         <br>  
                                                         <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$cnt_data[0]['id']?>'" tbl="page_category_cnt" col_name="image" dest="post" dest_thumb="post/thumb" style="margin-top: 5px;">   
                                                       <? } ?>
                                                  </div>                                                            
                                              </div>                                                             
                                          </fieldset>
                                       </div>
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
                                         <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Content&nbsp;<span class="red">*</span></label>
                                           <div class="col-sm-10">
                                            <textarea class="form-control" name="content[]" id="editor4"><?=(isset($cnt_data[1]['content']) && $cnt_data[1]['content'] !='')?$cnt_data[1]['content']:''?></textarea>
                                             <script>
                                               var editor = CKEDITOR.replace('editor4');                                                            
                                             </script>
                                            </div>                                              
                                          </div>
                                           <div class="form-group row">
                                             <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                              <div class="col-sm-7">
                                                <input type="file" class="form-control"  name="image[]" id="fileInput3">
                                                 <input type="hidden" id="x3" name="x3" />
                                                  <input type="hidden" id="y3" name="y3" />
                                                  <input type="hidden" id="w3" name="w3" />
                                                  <input type="hidden" id="h3" name="h3" />
                                                <p><img id="imagePreview3" style="display:none;"/></p> 
                                                 <?php  if(isset($cnt_data[0]['image']) &&  $cnt_data[1]['image'] !='')  {  ?>
                                                   <img src="<?=base_url('post/'.$cnt_data[1]['image'])?>" style="max-width: 1200px;">
                                                   <br>  
                                                   <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$cnt_data[1]['id']?>'" tbl="page_category_cnt" col_name="image" dest="post" dest_thumb="post/thumb" style="margin-top: 5px;">   
                                                 <? } ?>
                                            </div>
                                           </div>                                                                    
                                          </fieldset>
                                       </div>
                                     </div> 
                                    </div>  
                                   </div>
                                 </div>                             

                                <div class="tab-pane fade" id="tab3">
                                  <div class="panel-body">
                                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>  
                                    <div id="ftr_div">    
                                     <div class="row">
                                        <div class="col-md-12">
                                          <fieldset>
                                              <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Content&nbsp;<span class="red">*</span></label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" name="content[]" id="editor5"><?=(isset($cnt_data[2]['content']) && $cnt_data[2]['content'] !='')?$cnt_data[2]['content']:''?></textarea>
                                                        <script>
                                                           var editor = CKEDITOR.replace('editor5');                                                            
                                                      </script>
                                                  </div>                                              
                                              </div> 
                                              <div class="form-group row">
                                                 <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                                  <div class="col-sm-7">
                                                    <input type="file" class="form-control"  name="image[]" id="fileInput4">
                                                     <input type="hidden" id="x4" name="x4" />
                                                      <input type="hidden" id="y4" name="y4" />
                                                      <input type="hidden" id="w4" name="w4" />
                                                      <input type="hidden" id="h4" name="h4" />
                                                    <p><img id="imagePreview4" style="display:none;"/></p> 
                                                     <?php  if(isset($cnt_data[0]['image']) && $cnt_data[2]['image'] !='')  {  ?>
                                                         <img src="<?=base_url('post/'.$cnt_data[2]['image'])?>" style="max-width: 1200px;">
                                                         <br>  
                                                         <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$cnt_data[2]['id']?>'" tbl="page_category_cnt" col_name="image" dest="post" dest_thumb="post/thumb" style="margin-top: 5px;">   
                                                       <? } ?>
                                                </div>
                                             </div>                                                                         
                                          </fieldset>
                                       </div>
                                     </div> 
                                    </div>  
                                   </div>
                                 </div>                            
                                <div class="tab-pane fade" id="tab4">
                                    <div class="panel-body">
                                     <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>  
                                      <div id="ftr_div">    
                                       <div class="row">
                                          <div class="col-md-12">
                                            <fieldset>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Content&nbsp;<span class="red">*</span></label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="content[]" id="editor6"><?=(isset($cnt_data[3]['content']) && $cnt_data[3]['content'] !='')?$cnt_data[3]['content']:''?></textarea>
                                                          <script>
                                                             var editor = CKEDITOR.replace('editor6');                                                            
                                                        </script>
                                                    </div>                                              
                                                </div> 
                                                <div class="form-group row">
                                                   <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                                    <div class="col-sm-7">
                                                      <input type="file" class="form-control"  name="image[]" id="fileInput5">
                                                       <input type="hidden" id="x5" name="x5" />
                                                        <input type="hidden" id="y5" name="y5" />
                                                        <input type="hidden" id="w5" name="w5" />
                                                        <input type="hidden" id="h5" name="h5" />
                                                      <p><img id="imagePreview5" style="display:none;"/></p> 
                                                      <?php  if(isset($cnt_data[0]['image']) && $cnt_data[3]['image'] !='')  {  ?>
                                                         <img src="<?=base_url('post/'.$cnt_data[3]['image'])?>" style="max-width: 1200px;">
                                                         <br>  
                                                         <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="'<?=$cnt_data[3]['id']?>'" tbl="page_category_cnt" col_name="image" dest="post" dest_thumb="post/thumb" style="margin-top: 5px;">   
                                                       <? } ?>
                                                  </div>
                                               </div>                                                                         
                                            </fieldset>
                                         </div>
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