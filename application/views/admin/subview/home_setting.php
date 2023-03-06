 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
       <i class="glyphicon glyphicon-asterisk"></i>
     </div>  
    <div class="header-title">
        <h1>Home Page Setttings</h1>  
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
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Primary Phone</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="prm_contact" placeholder="Primary Phone" value="<?=$all_data->prm_contact?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Secondary Phone</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="sec_contact" placeholder="Secondary Phone" value="<?=$all_data->sec_contact?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Fax</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="fax" placeholder="Fax" value="<?=$all_data->fax?>">
                            </div>
                        </div>                       
                         <div class="form-group row">                            
                            <label class="col-sm-2 col-form-label">Website Email</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="web_email" placeholder="Website Email" value="<?=$all_data->web_email?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Booking Form Email</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="booking_email" placeholder="Booking Form Email" value="<?=$all_data->booking_email?>" style="text-transform: lowercase;">
                            </div>
                            <label class="col-sm-2 col-form-label">Contact Form Email</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="contact_email" placeholder="Contact Form Email" value="<?=$all_data->contact_email?>" style="text-transform: lowercase;">
                            </div>
                        </div>     

                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Business Hours1</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="business_hrs1" placeholder="Business Hours1" value="<?=$all_data->business_hrs1?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Business Hours12</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="business_hrs2" placeholder="Business Hours2" value="<?=$all_data->business_hrs2?>">
                            </div>
                        </div>                     
                     
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Home Page Heading</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="hm_pg_heading" placeholder="Home Page Heading" value="<?=$all_data->hm_pg_heading?>" style="text-transform: lowercase;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Home Page Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="hm_pg_desc" id="editor1" placeholder="Home Page Description"><?=$all_data->hm_pg_desc?></textarea>      
                                <script>
                                    var editor = CKEDITOR.replace( 'editor1' );
                                    CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                            </script>                                     
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Page Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="prd_page_desc" id="editor2" placeholder="Home Page Description"><?=$all_data->prd_page_desc?></textarea>      
                                <script>
                                    var editor = CKEDITOR.replace( 'editor2' );
                                    CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );
                            </script>                                     
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Business Short Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="business_addr" placeholder="Business Short Address"><?=$all_data->business_addr?></textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Business Full Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="business_full_addr" placeholder="Business Full Address"><?=$all_data->business_full_addr?></textarea>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Copyright Context</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="copyright_text" placeholder="Copyright Context"><?=$all_data->copyright_text?></textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Footer About Company</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="footer_abt_cmp" placeholder="Footer About Company"><?=$all_data->footer_abt_cmp?></textarea>                                           
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Map</label>
                            <div class="col-sm-9">
                               <textarea class="form-control" name="map" placeholder="Map"><?=$all_data->map?></textarea>  
                            </div>
                        </div>
                        <div class="form-group row" style="max-height:300px; overflow: hidden;">
                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                            <div class="col-sm-10">
                               <?=$all_data->map?>
                            </div>
                        </div>
                    </div>               
            </div>
        </div>
    </div>
</section>
</form>