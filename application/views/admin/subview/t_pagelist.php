 <div class="content-wrapper"> 
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Trash Page</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/pages')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;                        
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
                                        <th>Page Name</th>
                                        <th>URL</th>                                                                              
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                 <?
                                    $m = '';
                                    $v = 0;
                                    $j = 1; 
                                    
                                    if(count($pages)>0){
                                        foreach($pages as $z){
                                            $v++;               
                                            
                                            
                                            $m .= '<tr>
                                                        <td>'.$j.'</td>
                                                        <td>'.$z->pg_name.'</td>                                        
                                                        <td>'.$z->slug_url.'</td>   
                                                        <td class="center tdmiddle">';

                                             $m .="<a title='Click To Restore' onclick=\"if(confirm('Would You Like To Restore This Record')){self.location='".base_url()."admin/restore_record/page/$z->id'}\" style='cursor:pointer'>
                                                               <i class='fa fa-reply'></i>
                                                            </a>&nbsp;&nbsp;
                                                    <a title='Click To Delete' onclick=\"if(confirm('Would You Like To Permanently Delete This Record')){self.location='".base_url()."admin/delete_record/page/$z->id'}\" style='cursor:pointer'>
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