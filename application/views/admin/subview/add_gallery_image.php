<style>
        ul.cvf_uploaded_files {list-style-type: none; padding: 0;}
        ul.cvf_uploaded_files li {background-color: #fff; border: 1px solid #ccc; border-radius: 5px; float: left; margin: 20px 20px 0 0; padding: 2px; width: 150px; height: 150px; line-height: 150px; position: relative;}
        ul.cvf_uploaded_files li img.img-thumb {width: 150px; height: 150px;}
        ul.cvf_uploaded_files .ui-selected {background: red;}
        ul.cvf_uploaded_files .highlight {border: 1px dashed #000; width: 150px; background-color: #ccc; border-radius: 5px;}
        ul.cvf_uploaded_files .delete-btn {width: 24px; border: 0; position: absolute; top: -12px; right: -14px;}
        .bg-success {padding: 7px;}
</style>
<!-- Main content -->
<section class="content">
    <div class="row">                                              
        <!-- Textual inputs -->
        <div class="col-sm-12">
            
            <div class="panel panel-bd ">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Add Gallery Category Form</h4>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="panel-body">
                        <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category Name&nbsp;<span class="red">*</span></label>
                            <div class="col-sm-3">
                                  <select name="" class="form-control">
                                    <option value="">Select Subcategory</option>
                                    <option value="">Cat1</option>
                                    <option value="">Cat2</option>
                                </select>
                            </div>
                        </div> 

                                   
                         <div class="form-group row">
                            <label for="example-url-input" class="col-sm-2 col-form-label">Upload Images</label>
                            <div class="col-sm-3">
                               <input type="file" id='files' class = "form-control user_picked_files" name="files[]" multiple>  
                            </div>
                       </div>
                          <div class="form-group row">
                            <label for="example-url-input" class="col-sm-2 col-form-label">Image Will Be here</label>
                            <div class="col-sm-9">
                                <ul class = "cvf_uploaded_files"></ul>
                            </div>
                        </div>        
                       
                        <hr >
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                            <button type="button" class="btn btn-success cvf_upload_btn" id="submit">Upload</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <div id='load'></div>
</section>  
<script type="text/javascript">
        jQuery(document).ready(function() {        
           
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

                // Read selected files
                var totalfiles = document.getElementById('files').files.length;
                for (var index = 0; index < totalfiles; index++) {
                    form_data.append("files[]", document.getElementById('files').files[index]);
                }

               

                // AJAX request
                $.ajax({
                    url: '<?=base_url()?>admin/upload_gallery',
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
    </script>
    <button id='success'  onclick="javascript: toastr.success('Success - Image(s) Uploaded Successfully'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button>