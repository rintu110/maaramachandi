 <div class="content-wrapper"> 
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Trash Partner List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/partners')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>
        </div>
    </div>
   </section>
 <!-- Main content -->
 <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">                   
                    <div class="panel-body">                                   
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SlNo</th>
                                        <th>Partners Name</th>
                                        <th>Image Tag</th>
                                        <th>Image</th> 
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
                                            
                                            $m .= '<tr>
                                                        <td>'.$j.'</td>
                                                        <td>'.$z->partner_nm.'</td>                                     
                                                        <td>'.$z->img_tag.'</td>    
                                                        <td class="center tdmiddle">
                                                          <img src="'.base_url().'partners/'.$z->partner_img.'" alt="'.$z->img_tag.'">
                                                        </td>                                                                                       
                                                        <td class="center tdmiddle">';              
                                            $m .="<a title='Click To Restore' onclick=\"if(confirm('Would You Like To Restore This Record')){self.location='".base_url()."admin/restore_record/partners/$z->id'}\" style='cursor:pointer'>
                                                               <i class='fa fa-reply'></i>
                                                            </a>&nbsp;&nbsp;
                                                    <a title='Click To Delete' onclick=\"if(confirm('Would You Like To Permanently Delete This Record')){self.location='".base_url()."admin/delete_record/partners/$z->id'}\" style='cursor:pointer'>
                                                               <i class='fa fa-trash-o'></i>
                                                            </a>";
                                             $m .= '</td>
                                                   </tr>';
                                        $j++;       
                                        }
                                    }else{
                                        $m = '<tr>
                                                <td colspan="5">No Data Found</td>
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