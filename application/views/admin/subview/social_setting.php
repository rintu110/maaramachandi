 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
       <i class="glyphicon glyphicon-asterisk"></i>
     </div>  
    <div class="header-title">
        <h1>Social Media Setttings</h1>  
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
                                            <label class="col-sm-2 col-form-label">Facebook URL </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="facebook_url" placeholder="Facebook URL" value="<?=$all_data->facebook_url?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Twitter URL</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="twitter_url" placeholder="Twitter URL" value="<?=$all_data->twitter_url?>">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Linkedin URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="linkedin_url" placeholder="Linkedin URL" value="<?=$all_data->linkedin_url?>">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Instagram URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="instagram_url" placeholder="Instagram URL" value="<?=$all_data->instagram_url?>">
                                            </div>
                                        </div> 
                                       <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Youtube URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="youtube_url" placeholder="Youtube URL" value="<?=$all_data->youtube_url?>">
                                            </div>
                                        </div> 
                                      <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">WhatsApp URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="whatsapp_url" placeholder="WhatsApp URL" value="<?=$all_data->whatsapp_url?>">
                                            </div>
                                        </div> 
                                         <div class="form-group row">
                                           <label class="col-sm-2 col-form-label">Skype URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="skype_url" placeholder="Skype URL" value="<?=$all_data->skype_url?>">
                                            </div>
                                        </div>  
                                       
                                       <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Pintrest URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="pintersest_url" placeholder="Pintrest URL" value="<?=$all_data->pintersest_url?>">
                                            </div>
                                        </div>    
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">RSS URL</label>
                                            <div class="col-sm-9">
                                                 <input class="form-control" type="text" name="rss_url" placeholder="RSS URL" value="<?=$all_data->rss_url?>">
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