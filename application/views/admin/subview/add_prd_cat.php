 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Category</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/category')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_category')?>'">
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
               <div class="row"> 
                 <form method="post" name="frm_page" enctype="multipart/form-data">
                  <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Category Form</a></li>                            
                            <li><a href="#tab2" data-toggle="tab">SEO Context</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="tab1">
                            <div class="panel-body">
                                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" placeholder="Category" name="cat_name" id="cat_name" onkeyup="mytext(this.value,this.id);" onblur="makeurl(this.value);check_duplicate(document.getElementById('slug_url').value);" required="required" ids='category' types = 'Product'>
                                         <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Page Already Exist. Please try another Page Name.</span> 
                                        <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">URL Available</span> 
                                    </div>
                                    </div>                   
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category URL&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Page URL" name="slug_url" id="slug_url" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Heading&nbsp;<span class="red">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Heading" name="heading">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Parent</label>
                                      <div class="col-sm-3">
                                          <select name="parent_id" class="form-control">
                                              <option value="">Select</option>                             
                                              <?php 
                                                foreach ($category as $v) 
                                                {   
                                                      $str = '';  
                                                      $q = $this->db->query("SELECT id,cat_name,parent_id FROM category WHERE parent_id = '".$v->id."' AND post_type = 'Product'")->result();

                                                       $str = '';
                                                       if(sizeof($q) > 0)
                                                       {
                                                           foreach ($q as $v1) 
                                                           {
                                                               $str .= '<option value="'.$v1->id.'" '.$sel.'>&nbsp;&nbsp;--&nbsp;&nbsp;'.$v1->cat_name.'</option>';
                                                           }
                                                       }
                                               ?>
                                                 <option value="<?=$v->id?>"><?=$v->cat_name?></option>
                                                 <?=$str?> 
                                              <?  } ?>  
                                          </select>
                                      </div>
                                      <!--  <label class="col-sm-3 col-form-label">Sub Category</label>
                                       <div class="col-sm-3">
                                          <select name="subcat_id" class="form-control" id="subcat_id">
                                              <option value="">Sub Category</option>                                                                         
                                          </select>
                                      </div> -->
                                   </div>     
                                              
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Short Description</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="sml_dsc" rows="3" placeholder="Short Description"></textarea>
                                      </div>
                                  </div>

                                   <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Full Description</label>
                                      <div class="col-sm-9">
                                          <textarea class="form-control" name="full_dsc" id="editor2"></textarea>
                                            <script>
                                                  var editor = CKEDITOR.replace( 'editor2' );
                                                  CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                          </script>                                          
                                      </div>
                                   </div>

                                   <div class="form-group row">
                                      <label for="example-url-input" class="col-sm-2 col-form-label">Upload Category Image</label> 
                                      <div class="col-sm-9">                      
                                      <input type="file" class="form-control"  name="post_img" id="fileInput">
                                            <input type="hidden" id="x" name="x" />
                                            <input type="hidden" id="y" name="y" />
                                            <input type="hidden" id="w" name="w" />
                                            <input type="hidden" id="h" name="h" />
                                          <p><img id="imagePreview" style="display:none;"/></p> 
                                   </div>
                               
                               <div class="form-group row">
                                  <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner Image</label>
                                  <div class="col-sm-9">
                                      <input type="file" class="form-control"  name="bg_img" id="fileInput1">
                                        <input type="hidden" id="x1" name="x1" />
                                        <input type="hidden" id="y1" name="y1" />
                                        <input type="hidden" id="w1" name="w1" />
                                        <input type="hidden" id="h1" name="h1" />
                                      <p><img id="imagePreview1" class="img_prv_bg" style="display:none;"/></p> 
                                  </div>
                               </div> 
                              </div>
                             </div>
                            </div>  

                            <div class="tab-pane fade" id="tab2">
                                <div class="panel-body">
                                  <div class="row">
                                 <div class="col-md-12">  
                                        <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">&nbsp;</label>
                                          <div class="col-sm-5">  
                                            <div class="panel panel-primary lobidisable lobipanel lobipanel-sortable" data-index="0" style="position: relative; opacity: 1; left: 0px; top: 0px;">
                                                <div class="panel-heading ui-sortable-handle">
                                                    <div class="panel-title" style="max-width: calc(100% - 90px);">
                                                        <h4>Google Preview</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <p><small><i class="glyphicon glyphicon-globe"></i>&nbsp;&nbsp;<?=base_url()?></small></p>
                                                    <p id="Title_txt" class="text-success"></p>
                                                    <p>Please provide a meta description by editing the snippet below. If you don’t, Google will try to find a relevant part of your post to show in the search results.</p>
                                                </div>                                                       
                                            </div> 
                                           </div>                                                   
                                         </div>                                    
                                               <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Meta Title</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group"> <span class="input-group-addon" id="meta_title_1_counter"></span>
                                                        <input autocomplete="off" class="form-control" data-maxchar="70" type="text" id="meta_title" name="meta_title" placeholder="Meta Title" onkeyup="get_title(this.value);">
                                                      </div>
                                                      <div class="progress progress-sm" id="progress_title"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group"> <span class="input-group-addon" id="meta_key_1_counter"></span>
                                                        <input class="form-control" data-maxchar="60" type="text" name="meta_key" id="meta_key" placeholder="Meta Keyword">
                                                    </div>
                                                    <div class="progress progress-sm" id="progress_key"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Meta Description</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group"> <span class="input-group-addon" id="meta_desc_1_counter"></span>
                                                        <textarea class="form-control" data-maxchar="160" rows="3" name="meta_desc" id="meta_desc" placeholder="Meta Description"></textarea>
                                                       </div>
                                                       <div class="progress progress-sm" id="progress_desc"></div>
                                                    </div>
                                                </div>
                                               <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Canonical Code</label>
                                                  <div class="col-sm-10">
                                                     <textarea class="form-control" rows="3" name="canonical_code" id="canonical_code" placeholder="<link rel=“canonical” href=“<?=base_url('categoryname')?>” />"></textarea>
                                                  </div>
                                               </div> 
                                              <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">Extra Meta</label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" name="extra_meta" rows="3" placeholder="Extra Meta"></textarea>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                         </div>
                                        </div>           
                        <!-- Tab panels -->                            
                     </div>                
            </div>
        </div>
    </div>
</section>  
</form>
<script src='<?=base_url()?>assets/js/autosize.js'></script>
<script type="text/javascript">
  autosize(document.querySelectorAll('textarea'));

  function get_title(vals)
  {
      $('#Title_txt').html(vals);
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


    $('#submit').prop('disabled',false);

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
     
   
     function countDown($source, $target,$progress_bar) 
     {
        var max = $source.attr("data-maxchar");             

        $target.html(max-$source.val().length); 

        $source.keyup(function()
        {
            var max_per = (max/100);              

            var Max_40_per = max_per * 60;
                Max_40_per = Math.round(Max_40_per);

            var Max_90_per = max_per * 99;
                Max_90_per = Math.round(Max_90_per); 

            if(max != 100 && max < 100)
            {
                 if($source.val().length <= 100)       
                 {
                    var max_width = $source.val().length;
                 }
                 else
                 {
                     var max_width = 100;    
                 }  
            }    
            else if(max > 100)
            {
                if($source.val().length <= 100)       
                {
                    var max_width = $source.val().length;
                }
                else
                {
                    var max_width = 100;    
                }                
            }           
           
            if($source.val().length >=1 && $source.val().length <= Max_40_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-warning progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="0" aria-valuemax="`+Max_40_per+`" style="width: `+max_width+`%;"></div>`;
                $($progress_bar).html(prg_bar);
                $($source).css("border-color","#ffbd33");
            }
            else if($source.val().length > Max_40_per && $source.val().length <= Max_90_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-success progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="`+Max_40_per+`" aria-valuemax="`+Max_90_per+`" style="width: `+max_width+`%;"></div>`;
                $($progress_bar).html(prg_bar);
                $($source).css("border-color","#7ad03a");
            }
            else if($source.val().length > Max_90_per)
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="`+Max_90_per+`" aria-valuemax="`+max+`" style="width: `+max_width+`%;"></div>`;
                 $($progress_bar).html(prg_bar);
                 $($source).css("border-color","#dc3232");
            }
            else
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="" style="width: 0%;"></div>`;
                 $($progress_bar).html(prg_bar);
                 $($source).css('border-color','');
            }

            if(max-$source.val().length > 0)
            {
                $target.html(max-$source.val().length);
            }
            else if(max-$source.val().length < 0)            
            {
                 $target.html(0);
            }
        });
    }
    
    countDown($("#meta_title"), $("#meta_title_1_counter"),$('#progress_title'));
    countDown($("#meta_key"), $("#meta_key_1_counter"),$('#progress_key'));
    countDown($("#meta_desc"), $("#meta_desc_1_counter"),$('#progress_desc')); 

</script>