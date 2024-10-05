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
                        <h4>Add Gallery Category Form</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <p><code class="highlighter-rouge">*</code> Fields Are Mandatory</p>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category Name&nbsp;<span class="red">*</span></label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Category Name">
                        </div>
                    </div>                     
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category URL</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="Category URL">
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="" placeholder="Short Description"></textarea>                                           
                        </div>
                    </div>                  
                     <div class="form-group row">
                        <label for="example-url-input" class="col-sm-2 col-form-label">Upload Banner</label>
                        <div class="col-sm-9">
                           <input type="file" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>SEO CONTEXT</legend>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Meta Title</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="" placeholder="Meta Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Meta Keyword</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="" placeholder="Meta Keyword">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Meta Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="" placeholder="Meta Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Extra Meta</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="" placeholder="Extra Meta"></textarea>
                                        </div>
                                     </div>
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Canonical Code</label>
                                        <div class="col-sm-9">
                                             <input class="form-control" type="text" name="" placeholder="Canonical Code">
                                        </div>
                                     </div>                                                   
                                </fieldset>
                            </div>
                        </div>
                    <hr >
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;&nbsp;                                 
                        <button type="button" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>        