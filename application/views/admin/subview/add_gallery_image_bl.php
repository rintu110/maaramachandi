<style>
        ul.cvf_uploaded_files {list-style-type: none; padding: 0;}
        ul.cvf_uploaded_files li {background-color: #fff; border: 1px solid #ccc; border-radius: 5px; float: left; margin: 20px 20px 0 0; padding: 2px; width: 150px; height: 150px; line-height: 150px; position: relative;}
        ul.cvf_uploaded_files li img.img-thumb {width: 150px; height: 150px;}
        ul.cvf_uploaded_files .ui-selected {background: red;}
        ul.cvf_uploaded_files .highlight {border: 1px dashed #000; width: 150px; background-color: #ccc; border-radius: 5px;}
        ul.cvf_uploaded_files .delete-btn {width: 24px; border: 0; position: absolute; top: -12px; right: -14px;}
        .bg-success {padding: 7px;}
</style>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>    
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui.js"></script>

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
                              <input type = "file" name = "upload[]" multiple="multiple" class = "form-control user_picked_files" id="uploads" />  
                              <input type = "hidden" class = "form-control cvf_hidden_field" />   
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
                            <button type="button" class="btn btn-success cvf_upload_btn">Save</button>&nbsp;&nbsp;&nbsp;                                 
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>  
<script type="text/javascript">
        jQuery(document).ready(function() {        
           
            var storedFiles = [];      
            //$('.cvf_order').hide();
           
            // Apply sort function 
            function cvf_reload_order() {
                var order = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'value'});
                $('.cvf_hidden_field').val(order);
            }
           
            function cvf_add_order() {
                $('.cvf_uploaded_files li').each(function(n) {
                    $(this).attr('item', n);
                });
                console.log('test');
            }
           
           
            $(function() {
                $('.cvf_uploaded_files').sortable({
                    cursor: 'move',
                    placeholder: 'highlight',
                    start: function (event, ui) {
                        ui.item.toggleClass('highlight');
                    },
                    stop: function (event, ui) {
                        ui.item.toggleClass('highlight');
                    },
                    update: function () {
                        //cvf_reload_order();
                    },
                    create:function(){
                        var list = this;
                        resize = function(){
                            $(list).css('height','auto');
                            $(list).height($(list).height());
                        };
                        $(list).height($(list).height());
                        $(list).find('img').load(resize).error(resize);
                    }
                });
                $('.cvf_uploaded_files').disableSelection();
            });
                   
            $('body').on('change', '.user_picked_files', function() {
               
                var files = this.files;
                var i = 0;

                //alert(files);
                           
                for (i = 0; i < files.length; i++) {
                    var readImg = new FileReader();
                    var file = files[i];

                   //  alert(this.files[i].name);
                   
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
                   
                    if(files.length === (i+1)){
                        setTimeout(function(){
                            cvf_add_order();
                        }, 1000);
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
               
                //cvf_reload_order();
               
            });
                   
            // AJAX Upload
            $('body').on('click', '.cvf_upload_btn', function(e){
               
                e.preventDefault();

                //cvf_reload_order();
               /* cvf_add_order();
               
                $(".cvf_uploaded_files").html('<p><img src = "<?=base_url()?>loader.gif" class = "loader" /></p>');
                var data = new FormData();
               
                var items_array = $('.cvf_hidden_field').val();
                var items = items_array.split(',');

                for (var i in items){
                    var item_number = items[i];
                    data.append('files' + i, storedFiles[item_number]);
                }
*/
                var form_data = new FormData();

                 /*var totalfiles = document.getElementById('uploads').files.length;
                 for (var index = 0; index < totalfiles; index++) {
                      form_data.append("upload[]", document.getElementById('uploads').files[index]);
                   }

                   alert(form_data);*/
                   
                $.ajax({
                    url: '<?=base_url()?>admin/upload_gallery',
                    type: 'POST',
                    contentType: false,
                    data: form_data,
                    processData: false,
                    cache: false,
                    success: function(response, textStatus, jqXHR) {
                       // $(".cvf_uploaded_files").html('');                                               
                       // bootbox.alert('<br /><p class = "bg-success">File(s) uploaded successfully.</p>');
                        //alert(jqXHR.responseText);
                    }
                });
               
            });        

        });
    </script>