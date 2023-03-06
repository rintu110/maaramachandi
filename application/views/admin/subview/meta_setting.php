 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
       <i class="glyphicon glyphicon-asterisk"></i>
     </div>  
    <div class="header-title">
        <h1>Meta Tag Setttings</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/dashboard')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To Dashboard
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update
            </button>
        </div>
    </div>
   </section>
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
               <!--  <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Site Settings</h4>
                    </div>
                </div> -->
                
                    <div class="panel-body">
                        <p class="highlt"><code class="highlighter-rouge">* Fields Are Mandatory</code></p>
 

                        <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
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
                                                    <p id="Title_txt" class="text-success"><?=($all_data->meta_title!='')?$all_data->meta_title:''?></p>
                                                    <p>Please provide a meta description by editing the snippet below. If you don’t, Google will try to find a relevant part of your post to show in the search results.</p>
                                                </div>                                                       
                                            </div> 
                                           </div>                                                   
                                         </div> 
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Meta Title</label>
                                            <div class="col-sm-10">
                                                <div class="input-group"> <span class="input-group-addon" id="meta_title_1_counter"></span>
                                                <input autocomplete="off" class="form-control" data-maxchar="70" type="text" id="meta_title" name="meta_title" placeholder="Meta Title" value="<?=$all_data->meta_title?>" onkeyup="get_title(this.value);">                                                
                                              </div>
                                              <div class="progress progress-sm" id="progress_title"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                            <div class="col-sm-10">
                                                <div class="input-group"> <span class="input-group-addon" id="meta_key_1_counter"></span>
                                                <input class="form-control" data-maxchar="60" type="text" name="meta_key" id="meta_key" placeholder="Meta Keyword" value="<?=$all_data->meta_key?>">
                                            </div>
                                            <div class="progress progress-sm" id="progress_key"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Meta Description</label>
                                            <div class="col-sm-10">
                                                <div class="input-group"> <span class="input-group-addon" id="meta_desc_1_counter"></span>
                                                <textarea class="form-control" data-maxchar="160" name="meta_desc" id="meta_desc" placeholder="Meta Description"><?=$all_data->meta_desc?></textarea>
                                               </div>
                                               <div class="progress progress-sm" id="progress_desc"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Extra Meta</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="extra_meta" rows="5" placeholder="Extra Meta"><?=$all_data->extra_meta?></textarea>
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

    function get_title(vals)
    {
        $('#Title_txt').html(vals);
    }

    $(document).ready(function(){

       var meta_title = "<?=($all_data->meta_title!='')?$all_data->meta_title:''?>";
           meta_title = meta_title.length;

       var meta_key = "<?=($all_data->meta_key!='')?$all_data->meta_key:''?>";
           meta_key = meta_key.length;

       var meta_desc = "<?=($all_data->meta_desc!='')?$all_data->meta_desc:''?>";
           meta_desc = meta_desc.length;
        
        if(meta_title > 0)
        {
             var max = $('#meta_title').attr("data-maxchar");   

             if(max != 100 && max < 100)
            {
                 if(meta_title <= 100)       
                 {
                    var max_width = meta_title;
                 }
                 else
                 {
                     var max_width = 100;    
                 }  
            }    
            else if(max > 100)
            {
                if(meta_title <= 100)       
                {
                    var max_width = meta_title;
                }
                else
                {
                    var max_width = 100;    
                }                
            }      

            var max_per = (max/100);              

            var Max_40_per = max_per * 60;
                Max_40_per = Math.round(Max_40_per);

            var Max_90_per = max_per * 99;
                Max_90_per = Math.round(Max_90_per);

            if(meta_title >=1 && meta_title <= Max_40_per)
            {    
                 var prg_bar = `<div class="progress-bar progress-bar-warning progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_title+`" aria-valuemin="0" aria-valuemax="`+meta_title+`" style="width: `+max_width+`%;"></div>`;
                  $('#progress_title').html(prg_bar);    
                  $('#meta_title').css("border-color","#ffbd33");     
            }
            else if(meta_title > Max_40_per && meta_title <= Max_90_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-success progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_title+`" aria-valuemin="`+Max_40_per+`" aria-valuemax="`+Max_90_per+`" style="width: `+max_width+`%;"></div>`;
                $('#progress_title').html(prg_bar);
                $('#meta_title').css("border-color","#7ad03a");
            }
            else if(meta_title > Max_90_per)
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_title+`" aria-valuemin="`+Max_90_per+`" aria-valuemax="`+max+`" style="width: `+max_width+`%;"></div>`;
                 $('#progress_title').html(prg_bar);
                 $('#meta_title').css("border-color","#dc3232");
            }           

            if(meta_title <= max)
            {
                $('#meta_title_1_counter').html(meta_title);
            }
            else if(meta_title > max)
            {
                $('#meta_title_1_counter').html(0); 
            }
        } 

        if(meta_key > 0)
        {
             var max = $('#meta_key').attr("data-maxchar");   

             if(max != 100 && max < 100)
            {
                 if(meta_key <= 100)       
                 {
                    var max_width = meta_key;
                 }
                 else
                 {
                     var max_width = 100;    
                 }  
            }    
            else if(max > 100)
            {
                if(meta_key <= 100)       
                {
                    var max_width = meta_key;
                }
                else
                {
                    var max_width = 100;    
                }                
            }      

            var max_per = (max/100);              

            var Max_40_per = max_per * 60;
                Max_40_per = Math.round(Max_40_per);

            var Max_90_per = max_per * 99;
                Max_90_per = Math.round(Max_90_per);

            if(meta_key >=1 && meta_key <= Max_40_per)
            {    
                 var prg_bar = `<div class="progress-bar progress-bar-warning progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_key+`" aria-valuemin="0" aria-valuemax="`+meta_key+`" style="width: `+max_width+`%;"></div>`;
                  $('#progress_key').html(prg_bar);    
                  $('#meta_key').css("border-color","#ffbd33");     
            }
            else if(meta_key > Max_40_per && meta_key <= Max_90_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-success progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_key+`" aria-valuemin="`+Max_40_per+`" aria-valuemax="`+Max_90_per+`" style="width: `+max_width+`%;"></div>`;
                $('#progress_key').html(prg_bar);
                $('#meta_key').css("border-color","#7ad03a");
            }
            else if(meta_key > Max_90_per)
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_key+`" aria-valuemin="`+Max_90_per+`" aria-valuemax="`+max+`" style="width: `+max_width+`%;"></div>`;
                 $('#progress_key').html(prg_bar);
                 $('#meta_key').css("border-color","#dc3232");
            }

            if(meta_key <= max)
            {
                $('#meta_key_1_counter').html(meta_key);
            }
            else if(meta_key > max)
            {
                $('#meta_key_1_counter').html(0); 
            }
        }   

        if(meta_desc > 0)
        {
             var max = $('#meta_desc').attr("data-maxchar");   

             if(max != 100 && max < 100)
            {
                 if(meta_desc <= 100)       
                 {
                    var max_width = meta_desc;
                 }
                 else
                 {
                     var max_width = 100;    
                 }  
            }    
            else if(max > 100)
            {
                if(meta_desc <= 100)       
                {
                    var max_width = meta_desc;
                }
                else
                {
                    var max_width = 100;    
                }                
            }      

            var max_per = (max/100);              

            var Max_40_per = max_per * 60;
                Max_40_per = Math.round(Max_40_per);

            var Max_90_per = max_per * 99;
                Max_90_per = Math.round(Max_90_per);

            if(meta_desc >=1 && meta_desc <= Max_40_per)
            {    
                 var prg_bar = `<div class="progress-bar progress-bar-warning progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_desc+`" aria-valuemin="0" aria-valuemax="`+meta_desc+`" style="width: `+max_width+`%;"></div>`;
                  $('#progress_desc').html(prg_bar);    
                  $('#meta_desc').css("border-color","#ffbd33");     
            }
            else if(meta_desc > Max_40_per && meta_desc <= Max_90_per)
            {
                var prg_bar = `<div class="progress-bar progress-bar-success progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_desc+`" aria-valuemin="`+Max_40_per+`" aria-valuemax="`+Max_90_per+`" style="width: `+max_width+`%;"></div>`;
                $('#progress_desc').html(prg_bar);
                $('#meta_desc').css("border-color","#7ad03a");
            }
            else if(meta_desc > Max_90_per)
            {
                 var prg_bar = `<div class="progress-bar progress-bar-danger progress-bar-striped progress-animated active" role="progressbar" aria-valuenow="`+meta_desc+`" aria-valuemin="`+Max_90_per+`" aria-valuemax="`+max+`" style="width: `+max_width+`%;"></div>`;
                 $('#progress_desc').html(prg_bar);
                 $('#meta_desc').css("border-color","#dc3232");
            }

            if(meta_desc <= max)
            {
                $('#meta_desc_1_counter').html(meta_desc);
            }
            else if(meta_desc > max)
            {
                $('#meta_desc_1_counter').html(0); 
            }
        } 

    });    
   
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