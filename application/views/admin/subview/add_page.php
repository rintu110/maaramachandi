 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Add Page</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/pages')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success" id="submit">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_page')?>'">
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
                     echo '<div class="alert alert-sm alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Success!</strong> '.$scs.'
                          </div>';
                  }

                  $err = $this->session->flashdata('error');
                  if(!empty($err))
                  {
                      echo '<div class="alert alert-sm alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">×</span>
                                </button>
                             <strong>Danger!</strong>'.$err.'
                            </div>';
                  }
            ?>
            <div class="panel panel-bd">              
              <div class="row">        
                  <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">                         
                     <div class="tab-content"> 
                       <div class="tab-pane fade in active" id="tab1">                    
                            <div class="panel-body">
                                <p class="highlt"><code class="highlighter-rouge">* Fields Are Mandatory</code></p>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Page Name&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Page Name" name="pg_name" id="field_name" onkeyup="mytext(this.value,this.id);" onblur="makeurl(this.value,document.getElementById('slug_url'));check_duplicate(document.getElementById('slug_url').value);" pg_nm='pg_name' ids='page' parent="0" required="required">
                                        <span style="color: rgb(153, 0, 0); display: none;"  id="inline_red">Page Already Exist. Please try another Page Name.</span> 
                                        <span style="color: rgb(0, 102, 0); display: none;" id="inline_green">URL Available</span> 
                                    </div>
                                </div>                   
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Page URL&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Page URL" name="slug_url" id="slug_url" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Parent Page&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-4">
                                       <select name="parent_pg" class="form-control">
                                           <option value="">Select</option>
                                           <?php
                                            $q = $this->db->query("SELECT id,pg_name FROM page WHERE 1  AND parent_pg ='0' AND  status = 1 AND del_status = 0 ORDER BY pg_name ASC")->result();

                                            if(count($q) > 0 )
                                            {
                                                 foreach ($q as $v) 
                                                 {                                

                                                    $in = $this->db->query("SELECT id,pg_name FROM page WHERE 1 AND parent_pg = '".$v->id."' AND parent_pg !='0' AND  status = 1 AND del_status = 0 ORDER BY pg_name ASC")->result();
                                                    $str = '';

                                                    if(sizeof($in) > 0)
                                                    {                                            
                                                        foreach ($in as $v1) {
                                                            
                                                            $str .='<option value="'.$v->id.'">&nbsp;&nbsp;--'.$v1->pg_name.'</option>';
                                                        }
                                                    }                               
                                           ?>
                                                <option value="<?=$v->id?>"><?=$v->pg_name?></option>
                                                <?=$str?>
                                           <?php         
                                                   }
                                            }
                                           ?>                               
                                       </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Template&nbsp;<span class="red">*</span></label>
                                    <div class="col-sm-4">
                                       <select name="template_id" class="form-control">
                                           <option value="">Select</option>
                                           <?php
                                            foreach ($templates as $v) {
                                           ?>
                                                <option value="<?=$v->id?>"><?=$v->page_template?></option>
                                           <?php         
                                            }
                                           ?>                               
                                       </select>
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sub Heading</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" name="sub_title" placeholder="Sub Heading" rows="3"></textarea>
                                    </div>
                                     <label class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" name="sml_desc" placeholder="Short Description" rows="3"></textarea>
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Full Description</label>
                                    <div class="col-sm-10">
                                        <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
                                       <textarea name="full_desc" id="editor1"></textarea>
                                        <script>
                                                 CKEDITOR.replace( 'editor1' );
                                        </script>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Extra Notes</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="ext_notes" rows="3" placeholder="Extra Notes"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Background Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control"  name="bg_img" id="fileInput">
                                          <input type="hidden" id="x" name="x" />
                                          <input type="hidden" id="y" name="y" />
                                          <input type="hidden" id="w" name="w" />
                                          <input type="hidden" id="h" name="h" />
                                        <p><img id="imagePreview" style="display:none; max-width: 1200px;"/></p>
                                     </div>
                                </div>     

                                <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend>Meta Tag Setup</legend>
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
                                                    <label class="col-sm-2 col-form-label">Extra Meta</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="5" name="extra_meta" placeholder="Extra Meta"></textarea>
                                                    </div>
                                                 </div>
                                                 <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Canonical Code</label>
                                                    <div class="col-sm-10">
                                                         <textarea class="form-control" rows="3" name="canonical_code" id="canonical_code" placeholder="<link rel=“canonical” href=“<?=base_url('pagename')?>” />"></textarea>
                                                    </div>
                                                 </div>                                                   
                                            </fieldset>
                                        </div>
                                </div>                                
                            </div>
                       </div>                       
                      </div>   
                   </div>  
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

    function get_title(vals)
    {
        $('#Title_txt').html(vals);
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
             var ids = $('#field_name').attr("ids"); 
           
             vals = encodeURI(vals);
            
             var urls = "<?=base_url('admin/check_duplicate')?>/"+field_nm+"/"+ids+"/"+vals;
             var urls = encodeURI(urls);

             $.get( urls, function( data ) {
                if(data == 1)
                {
                   $("#canonical_code").val('');
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
                    $("#canonical_code").val('');
                    $("#canonical_code").val('<link rel=“canonical” href=“<?=base_url()?>'+vals+'" />'); 
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
                var prg_bar = `<div class="progress-bar progress-bar-warning progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="0" aria-valuemax="`+Max_40_per+`" style="width: `+max_width+`%;">                      
                      </div>`;
                $($progress_bar).html(prg_bar);
                $($source).css("border-color","#ffbd33");
            }
            else if($source.val().length > Max_40_per && $source.val().length <= Max_90_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-success progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="`+Max_40_per+`" aria-valuemax="`+Max_90_per+`" style="width: `+max_width+`%;">                       
                      </div>`;
                $($progress_bar).html(prg_bar);
                $($source).css("border-color","#7ad03a");
            }
            else if($source.val().length > Max_90_per)
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+$source.val().length+`" aria-valuemin="`+Max_90_per+`" aria-valuemax="`+max+`" style="width: `+max_width+`%;">
                       
                      </div>`;
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