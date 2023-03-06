 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Live Member List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_livemembers')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
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
                                        <th>#</th> 
                                        <th>Date Of Booking</th>
                                        <th>Purpose</th>                                       
                                        <th>Name</th>
                                        <th>Address</th>                                        
                                        <th>Gotra</th>                                        
                                        <th>Donation (Rs.)</th>                                        
                                        <th class="center">Status</th>                                        
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?
                                    $m = '';
                                    $v = 0;
                                    $j = 1; 
                                    
                                    if(sizeof($members,1)>0)
                                    {
                                        foreach($members as $z)
                                        {
                                            $v++;
                                            if($z->status == 1){
                                                $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/live_members/0').'">Active</a> ';             
                                            }else if($z->status == 0){
                                                $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/live_members/1').'" >Block</a></span>';                    
                                            }                                                  
                                            
                                            $m .= '<tr>
                                                        <td class="tdmiddle">'.$j.'</td>
                                                        <td class="tdmiddle">'.date('d M, Y',strtotime($z->dates)).'</td>    
                                                        <td class="tdmiddle">'.$z->purpose.'</td>                                       
                                                        <td class="tdmiddle">'.$z->name.'</td>                                       
                                                        <td class="tdmiddle">'.$z->address.'</td>                                       
                                                        <td class="tdmiddle">'.$z->gotra.'</td>                                       
                                                        <td class="tdmiddle">'.number_format($z->yrly_donation,2,'.','').'</td>                                       
                                                        <td class="center tdmiddle">
                                                            '.$vc.'
                                                        </td>                     
                                                        <td class="center tdmiddle">';                                                        

                                                        $m .="<a title='Click To Edit' href='".base_url('admin/edit_livemembers/'.$z->id)."'>
                                                               <i class='fa fa-pencil'></i>
                                                            </a>&nbsp;&nbsp;";

                                             // $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/category/$z->id'}\" style='cursor:pointer'>
                                             //                   <i class='fa fa-trash-o'></i>
                                             //                </a>";
                                             $m .= '</td>
                                                   </tr>';
                                        $j++;       
                                        }
                                    }else{
                                        $m = '<tr>
                                                <td colspan="9">No Data Found</td>
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
         $.get("<?=base_url('admin/update_sequence')?>/live_members/"+ids+"/"+val, function(data){

            if(data == 1)
            {
                $(".loader").fadeOut(500);
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
    