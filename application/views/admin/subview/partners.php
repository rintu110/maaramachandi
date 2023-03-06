 <!-- Main content -->
 <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Partners List&nbsp;&nbsp;                          
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_partners')?>'">Add Partners </button>&nbsp;&nbsp;   
                        <button type="button" class="btn btn-sm btn-danger w-md m-b-5" onclick="window.location='<?=base_url('admin/t_partners')?>'">Trash</button></h4>
                        </div>
                    </div>
                    <div class="panel-body">                                   
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SlNo</th>
                                        <th>Partners Name</th>
                                        <th>Image Tag</th>
                                        <th>Image</th>                                        
                                        <th>Sequence</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?
                                    $m = '';
                                    $v = 0;
                                    $j = 1; 
                                    
                                    if(count($partners)>0){
                                        foreach($partners as $z){
                                            $v++;
                                            if($z->status == 1){
                                                $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/partners/0').'">Active</a> ';             
                                            }else if($z->status == 0){
                                                $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/partners/1').'" >Block</a></span>';                    
                                            }   
                                            
                                            
                                            $m .= '<tr>
                                                        <td class="center tdmiddle">'.$j.'</td>
                                                        <td class="center tdmiddle">'.$z->partner_nm.'</td>                                     
                                                        <td class="center tdmiddle">'.$z->img_tag.'</td>                                        
                                                        <td class="center tdmiddle">
                                                          <img src="'.base_url().'partners/'.$z->partner_img.'" alt="'.$z->img_tag.'">
                                                        </td>   
                                                        <td class="center tdmiddle">
                                                          <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                        </td>
                                                        <td class="center tdmiddle">
                                                            '.$vc.'
                                                        </td>                           
                                                        <td class="center tdmiddle">';                          

                                                        $m .="<a target='_blank' title='Click To Edit' href='".base_url('admin/edit_partners/'.$z->id)."'>
                                                               <i class='fa fa-pencil'></i>
                                                            </a>&nbsp;&nbsp;";

                                             $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/partners/$z->id'}\" style='cursor:pointer'>
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
    </section> <!-- /.content -->
  <script type="text/javascript">
    function sequence(val,ids)
    {      
         $.get("<?=base_url('admin/update_sequence')?>/partners/"+ids+"/"+val, function(data){

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