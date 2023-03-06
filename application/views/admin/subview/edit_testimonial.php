 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
    <section class="fixed content-header">  
         <div class="header-icon">
            <i class="hvr-buzz-out fa fa-edit"></i>
         </div>  
        <div class="header-title">
            <h1>Edit Review</h1>  
            <small>&nbsp;</small>   
            <div class="breadcrumb">
                <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/testimonial')?>'">
                    <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
                </button>&nbsp;
                 <button type="submit" class="btn btn-success">
                    <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Update
                 </button>&nbsp;                              
                 <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_testimonial')?>'">
                    <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel
                 </button>
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
                  <div class="panel-body">
                      <p>
                          <code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Author Name&nbsp;<span class="red">*</span></label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" placeholder="Author Name" name="auth_name" value="<?=$all_data->auth_name?>">
                          </div>                          
                      </div>
                      <!-- <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Heading</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Heading" name="title" value="<?=$all_data->title?>">
                            </div>
                      </div> -->
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Testimonial Content</label>
                          <div class="col-sm-9">
                             <textarea class="form-control" rows="4" name="contents" id="editor1" placeholder="Testimonial Content"><?=$all_data->contents?></textarea>
                             <script>
                                        var editor = CKEDITOR.replace( 'editor1' );
                                        CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                                </script>
                          </div>
                      </div>
                      <!--  <div class="form-group row">
                          <label class="col-sm-2 col-form-label">IFrame URL (if any)</label>
                          <div class="col-sm-9">
                             <textarea class="form-control" name="iframe_url" rows="4" placeholder="IFrame URL (if any)"><?=$all_data->iframe_url?></textarea>
                          </div>
                      </div> -->
                       <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Rate this product&nbsp;<span class="red">*</span></label>
                             <div class="col-sm-9"> 
                                <?php
                                    $averageRating = round($all_data->rating, 0);

                                    for ($i = 1; $i <= 5; $i++) 
                                    {
                                        $ratingClass = "btn-default btn-grey";

                                        if($i <= $averageRating) 
                                        {
                                            $ratingClass = "btn-warning";
                                        }
                                ?>
                                <button type="button" class="btn btn-sm <?php echo $ratingClass;?> rateButton" aria-label="Left Align">
                                     <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>
                                <?
                                   }
                                ?>                                
                                <input type="hidden" class="form-control" id="rating" name="rating" value="<?=$all_data->rating?>">
                            </div>    
                       </div>
                      <div class="form-group row">
                          <label for="example-url-input" class="col-sm-2 col-form-label">Upload Image</label>
                          <div class="col-sm-9">                                                              
                             <input type="file" class="form-control"  name="auth_img" id="fileInput">       
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <p><img id="imagePreview" style="display:none;"/></p>                            
                                <?php  if($all_data->auth_img !='')  {  ?>
                                           <img src="<?=base_url('testimonial_img/'.$all_data->auth_img)?>">
                                           <br>  
                                           <input type="button" name="" value="Remove" class="btn btn-sm btn-danger Delete_Img" ids="<?=$all_data->id?>" tbl="testimonial" col_name = "auth_img" dest = "testimonial_img" dest_thumb = "testimonial_img/thumb">   
                                    <? } ?>
                                
                          </div>
                      </div> 
                  </div>
            </div>
        </div>
    </div>
</section> <!-- /.content -->
</form>
<button id='success'  onclick="javascript: toastr.success('Success - Image Delete Successfully.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button> 
<script type="text/javascript" src="<?=base_url('frontassets/js/rating.js')?>"></script>