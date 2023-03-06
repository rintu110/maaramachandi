<style>
        ul.cvf_uploaded_files {list-style-type: none; padding: 0;}
        ul.cvf_uploaded_files li {background-color: #fff; border: 1px solid #ccc; border-radius: 5px; float: left; margin: 20px 20px 0 0; padding: 2px; width: 150px; height: 150px; line-height: 150px; position: relative;}
        ul.cvf_uploaded_files li img.img-thumb {width: 150px; height: 150px;}
        ul.cvf_uploaded_files .ui-selected {background: red;}
        ul.cvf_uploaded_files .highlight {border: 1px dashed #000; width: 150px; background-color: #ccc; border-radius: 5px;}
        ul.cvf_uploaded_files .delete-btn {width: 24px; border: 0; position: absolute; top: -12px; right: -14px;}
        .bg-success {padding: 7px;}
        .single-image{
            border: 2px solid #CCC;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }


.name{
    padding: 20px 0px 0px 0px;
    color: black;
    height: 75px;
    font-size: 18px;
}

.img-wrap{
    padding-bottom: 50px;
    padding-top: 25px;
}

.first-image{
    width: 200px;
}

.second-image{
    width: 150px;
}

.extra-info{
    border-top: 1px solid orange;
    align-self: bottom;
}

.bottom-text{
    padding-top: 15px;
    height: 50px;
    letter-spacing: 0.1em;
}            

.images-wrap{
display: block;
}

.single-image-wrap {
    height: 100%;
    margin-bottom: 15px;
}
</style>
<link rel="stylesheet" href="<?=base_url('assets/')?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?=base_url('assets/')?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Product Gallery&nbsp;&nbsp;
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_product/'.$all_data->id)?>'">Edit Product</button>
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_desc/').$all_data->id?>'">Edit Description</button>
          <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/edit_seo/'.$all_data->id)?>'">Edit SEO</button>
        </h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/product')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="button" id="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Upload</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_product')?>'">
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
               <!--  <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Product Gallery Form
                    </div>
                </div> -->
                  <input type="hidden" name="post_type" value="Product">
                        <div class="panel-body">
                            <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name:</label>
                                <div class="col-sm-4">
                                   <input type="text" readonly="readonly" class="form-control" value="<?=$all_data->post_name?>">  
                                </div>                                          
                                <label class="col-sm-2 col-form-label">Product URL:</label>
                                <div class="col-sm-4">
                                   <input type="text" readonly="readonly" class="form-control" value="<?=$all_data->slug_url?>">  
                                </div>    
                           </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Upload Image&nbsp;<span class="red">*</span></label>
                                <div class="col-sm-9">
                                  <input type="file" id='files' class = "form-control user_picked_files" name="files[]" multiple>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Image Will Be here</label>
                                <div class="col-sm-9">
                                    <ul class = "cvf_uploaded_files"></ul>
                                </div>
                             </div>  
                        </div>
                 
            </div>
        </div>
    </div>
    <div id='load'></div>
</section>    
</form>

       <?
         if(is_array($gallery) && countz($gallery) > 0)
         {
           
        ?>
           <section class="content">
             <div class="row images-wrap">  
               <?php
                   if(is_array($gallery) && sizeof($gallery) > 0)
                   {
                     $i = 0;
                     $class = '';
                     foreach ($gallery as $k => $v) 
                     {
                         if($i > 5)
                         {
                            $class = 'style="margin-top: 10px;"';
                         }
                        ?>
                           <div class="col-md-2" <?=$class?>>                          
                             <div class="single-image-wrap">
                                <div class="single-image gallery">
                                 <a href="<?=base_url()?>gallery_img/<?=$v->gallery_img?>" rel="prettyPhoto[gallery1]">
                                   <div class="img-wrap"> 
                                        <img src="<?=base_url()?>/gallery_img/thumb/<?=$v->gallery_img?>" loading="lazy">    
                                   </div>    
                                  <!-- <div class="bg-cover"></div> -->
                                </a> 
                               </div> 
                              </div>
                              <div class="row" style="margin-top:5px">    
                                <div class="col-sm-8">      
                                  <input type="text" placeholder="Image Title" class = "form-control" name="img_title[]" id="img_title<?=$v->id?>" value="<?=$v->img_tag?>" onblur="save_imgtag(this.value,'<?=$v->id?>','post_gallery')">
                                </div>
                              
                                <div class="col-sm-4">                                                              
                                     <input type="text" class = "form-control" name="sequence[]" style="text-align:center;" value="<?=$v->sequence?>" onblur="set_sequence(this.value,'<?=$v->id?>','post_gallery')" id="sequence<?=$v->id?>" size="3">
                                </div>
                              </div> 
                          <div class="row" style="margin:5px 0px">
                           <div class="col-md-9">   
                              <input type="radio" name="cover_image" id="cover_image" <?=($v->is_first == 1)?'CHECKED':''?> value="1" onclick="set_cover_img(this.value,<?=$v->id?>,'post_gallery')">&nbsp;Set As First Image
                            </div>
                            <div class="col-md-3">   
                            <a onclick="if(confirm('Would You Like To Delete This Record')){self.location='<?=base_url('admin/')?>delete_gallery/<?=$v->post_id?>/<?=$v->id?>'}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor: pointer;">
                                <span class="label label-danger">Delete</span>
                          </a>
                             </div> 
                           </div> 
                         </div>
                        <?
                         $i++;
                      } 
                   }   
               ?> 
             </div>
           </section> 
        <?
         }
       ?>        
    
    
<script type="text/javascript">

        jQuery(document).ready(function() { 

            $("area[rel^='prettyPhoto']").prettyPhoto();    

           // $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
            $(".gallery a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true, theme: 'dark_square'});   
           
            var storedFiles = [];            
                   
            $('body').on('change', '.user_picked_files', function() {
               
                var files = this.files;
                var i = 0;
                           
                for (i = 0; i < files.length; i++) {
                    var readImg = new FileReader();
                    var file = files[i];

                    if (file.type.match('image.*')){
                        storedFiles.push(file);
                        readImg.onload = (function(file) {
                            return function(e) {
                                $('.cvf_uploaded_files').append(
                                "<li file = '" + file.name + "'>" +                                
                                    "<img class = 'img-thumb' src = '" + e.target.result + "' />" +
                                    "<a href = '#' class = 'cvf_delete_image' title = 'Cancel'><img class = 'delete-btn' src = '<?=base_url()?>assets/img/delete-btn.png' /></a>" +
                                "</li>"
                                );     
                            };
                        })(file);
                        readImg.readAsDataURL(file);
                       
                    } else {
                        alert('the file '+ file.name + ' is not an image<br/>');
                    }
                }
            });
           
            // Delete Image from Queue
            $('body').on('click','a.cvf_delete_image',function(e){
                e.preventDefault();
                $(this).parent().remove('');       
               
                var file = $(this).parent().attr('file');
                for(var i = 0; i < storedFiles.length; i++) {
                    if(storedFiles[i].name == file) {
                        storedFiles.splice(i, 1);
                        break;
                    }
                }               
            });        

                   
          $('#submit').click(function(){

                $("#load").show();
                var form_data = new FormData();
                var ids = '<?=$this->uri->segment(3)?>';

                // Read selected files
                var totalfiles = document.getElementById('files').files.length;
                for (var index = 0; index < totalfiles; index++) {
                    form_data.append("files[]", document.getElementById('files').files[index]);
                    form_data.append("ids[]",ids);
                }   
               
                // AJAX request
                $.ajax({
                    url: '<?=base_url()?>admin/upload_prd_gallery/'+ids,
                    type: 'post',
                    data: form_data,                    
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        result = data;                           
                        if(result == 1)                          
                        {    
                             $("#load").delay(5000).hide();
                             $("#success").click();
                             location.reload();     
                        }
                        else if(result == 0)
                        {
                            $("#error").click(); 
                        }                         
                    }
                });
            });  
        });

        function set_sequence(sequence_no,id,tbl_nm)
        {
            $.get('<?=base_url('admin/')?>sequence_gallery/'+sequence_no+'/'+id+'/'+tbl_nm, function(data) 
            { 
                  if(data == 1)                               
                     $("#scs").click();                  
                  else
                     $("#error").click();        

            });
        }

        function set_cover_img(val,id,table_name)
        {
            $.get('<?=base_url('admin/')?>set_cover_img/'+val+'/'+id+'/'+table_name, function(data) 
            {                             
                  if(data == 1)   
                     $("#scs").click();  
                  else
                     $("#error").click();                     
            });
        }

        function save_imgtag(img_title,id,table_name)
        {
            var img_title = encodeURI(img_title);

            $.post('<?=base_url('admin/')?>imgtag/'+img_title+'/'+id+'/'+table_name, function(data) 
            {
                if(data == 1)   
                    $("#scs").click();  
                else
                     $("#error").click();   

            });
        }
        
    </script>
    <button id='success'  onclick="javascript: toastr.success('Success - Image(s) Uploaded Successfully'); return false;" style="display:none" >Success</button>
     <button id='scs'  onclick="javascript: toastr.success('Success - Data Uploaded Successfully'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button>