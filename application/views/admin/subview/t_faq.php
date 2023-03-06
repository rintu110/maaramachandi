 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>FAQ List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
             <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/faq')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
        </div>
    </div>
   </section>
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
                <div class="panel-body">                 
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SlNo</th>
                                    <th>Question</th>
                                    <th>Answer</th>                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?
                                $m = '';
                                $v = 0;
                                $j = 1; 
                                
                                if(count($faq)>0){
                                    foreach($faq as $z){
                                        $v++;                               
                                        
                                        $m .= '<tr>
                                                    <td class="center">'.$j.'</td>
                                                    <td>'.$z->qns.'</td>                                        
                                                    <td>'.$z->ans.'</td>
                                                    <td class="center tdmiddle">';                      

                                        $m .="<a title='Click To Restore' onclick=\"if(confirm('Would You Like To Restore This Record')){self.location='".base_url()."admin/restore_record/faq/$z->id'}\" style='cursor:pointer'>
                                                           <i class='fa fa-reply'></i>
                                                        </a>&nbsp;&nbsp;
                                                <a title='Click To Delete' onclick=\"if(confirm('Would You Like To Permanently Delete This Record')){self.location='".base_url()."admin/delete_record/faq/$z->id'}\" style='cursor:pointer'>
                                                           <i class='fa fa-trash-o'></i>
                                                        </a>";
                                         $m .= '</td>
                                               </tr>';
                                    $j++;       
                                    }
                                }else{
                                    $m = '<tr>
                                            <td colspan="4">No Data Found</td>
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
<script type="text/javascript">
    function sequence(val,ids)
    {      
         $.get("<?=base_url('admin/update_sequence')?>?table=faq&id="+ids+"&val="+val);
         $("#success").click();
    }
    /* $('.success').on("click", function () {
            toastr.success('Success - This is a Homer success notification');
     });*/
</script>
<button id='success'  onclick="javascript: toastr.success('Success - Record has sequenced.'); return false;" style="display:none" >Success</button>
