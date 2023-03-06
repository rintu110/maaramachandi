 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>FAQ List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_faq')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_faq')?>'">
              <i class="hvr-buzz-out fa fa-remove"></i>&nbsp;Trash
            </button>
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
                                    <th>Status</th>
                                    <th>Sequence</th>
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
                                        if($z->status == 1){
                                            $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/faq/0').'">Active</a> ';              
                                        }else if($z->status == 0){
                                            $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/faq/1').'" >Block</a></span>';                 
                                        }                   
                                        
                                        $m .= '<tr>
                                                    <td class="center">'.$j.'</td>
                                                    <td>'.$z->qns.'</td>                                        
                                                    <td>'.$z->ans.'</td>                                        
                                                    <td class="center tdmiddle">
                                                        '.$vc.'
                                                    </td>
                                                    <td class="center tdmiddle">
                                                      <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                    </td>   
                                                    <td class="center tdmiddle">
                                                        <a target="_blank" title="Click To Edit" href="'.base_url("admin/edit_faq/".$z->id).'">
                                                           <i class="fa fa-pencil"></i>
                                                        </a>&nbsp;&nbsp;';

                                         $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/faq/$z->id'}\" style='cursor:pointer'>
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
<script type="text/javascript">
    function sequence(val,ids)
    {      
         $.get("<?=base_url('admin/update_sequence')?>/faq/"+ids+"/"+val, function(data){

            if(data == 1)
            {
                $("#success").click();
            }
            else if(data == 0)
            {
                $("#error").click(); 
            }
        });        
    }   
</script>
<button id='success'  onclick="javascript: toastr.success('Success - Record has sequenced.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button>
