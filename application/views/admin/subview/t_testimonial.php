<!-- Main content -->
<section class="content">
    <div class="row">
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
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Testimonials&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-danger w-md m-b-5" onclick="window.location='<?=base_url('admin/testimonial')?>'">View All</button>&nbsp;&nbsp; 
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_testimonial')?>'">Add Testimonial</button>  </h4>
                    </div>
                </div>
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Name / Desg</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?
                              $m = '';
                                $v = 0;
                                $j = 1; 
                                
                                if(count($testimonials)>0){
                                    foreach($testimonials as $z){
                                        $v++;
                                        

                                        $desg = '';

                                        if($z->desg !='')                   
                                        {
                                             $desg = ' / '.$z->desg;
                                        }
                                        
                                        $m .= '<tr>
                                                    <td class="center tdmiddle">'.$j.'</td>
                                                    <td class="center tdmiddle">'.$z->auth_name.$desg.'</td>                                        
                                                    <td>'.$z->contents.'</td>
                                                    <td class="center tdmiddle">';

                                        $m .="<a title='Click To Restore' onclick=\"if(confirm('Would You Like To Restore This Record')){self.location='".base_url()."admin/restore_record/testimonial/$z->id'}\" style='cursor:pointer'>
                                                           <i class='fa fa-reply'></i>
                                                        </a>&nbsp;&nbsp;
                                                <a title='Click To Delete' onclick=\"if(confirm('Would You Like To Permanently Delete This Record')){self.location='".base_url()."admin/delete_record/testimonial/$z->id'}\" style='cursor:pointer'>
                                                           <i class='fa fa-trash-o'></i>
                                                        </a>";  
                                         $m .= '</td>
                                               </tr>';
                                    $j++;       
                                    }
                                }else{
                                    $m = '<tr>
                                            <td colspan="6">No Data Found</td>
                                          </tr>';
                                }

                                echo $m;
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>                    
</section>

