 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>News Category List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_ncategory')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
           <!--  <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_ncategory')?>'">
              <i class="hvr-buzz-out fa fa-remove"></i>&nbsp;Trash
            </button> -->
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
                                        <th>Cat/SubCategory </th>
                                        <th>URL</th>
                                        <th>Parent</th>                                        
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
                                    
                                    if(count($category)>0){
                                        foreach($category as $z){
                                            $v++;
                                            if($z->status == 1){
                                                $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/category/0').'">Active</a> ';             
                                            }else if($z->status == 0){
                                                $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/category/1').'" >Block</a></span>';                    
                                            }

                                            $parent = '<span class="label label-primary-outline">Parent</span>';

                                            if($z->parent_id !='0')
                                            {
                                                $q = $this->db->query("SELECT cat_name FROM category where id = '".$z->parent_id."'")->row();

                                                $parent =  '<span class="label label-primary">'.$q->cat_name.'</span>';
                                            }
                                            
                                            
                                            $m .= '<tr>
                                                        <td>'.$j.'</td>
                                                        <td>'.$z->cat_name.'</td>                                       
                                                        <td>'.$z->slug_url.'</td>                                       
                                                        <td>'.$parent.'</td>                                        
                                                        <td class="center tdmiddle">
                                                            '.$vc.'
                                                        </td>   
                                                        <td class="center tdmiddle">
                                                          <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                        </td>                           
                                                        <td class="center tdmiddle">';

                                                        if($z->is_featured == 0)
                                                        {
                                                            $m .="<a title='Click To Featured' onclick=\"if(confirm('Would You Like To Featured This Record')){self.location='".base_url()."admin/update_featured/category/$z->id/1'}\" style='cursor:pointer'>
                                                               <i class='fa fa-star-o'></i>
                                                            </a>&nbsp;&nbsp;";
                                                        } if($z->is_featured == 1)
                                                        {   
                                                            $m .="<a title='Click Not To Featured' onclick=\"if(confirm('Would You Like To Not Featured This Record')){self.location='".base_url()."admin/update_featured/category/$z->id/0'}\" style='cursor:pointer'>
                                                               <i class='fa fa-star'></i>
                                                            </a>&nbsp;&nbsp;";
                                                        }

                                                        $m .="<a title='Click To Edit' href='".base_url('admin/edit_ncategory/'.$z->id)."'>
                                                               <i class='fa fa-pencil'></i>
                                                            </a>&nbsp;&nbsp;";

                                             $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/category/$z->id'}\" style='cursor:pointer'>
                                                               <i class='fa fa-trash-o'></i>
                                                            </a>";
                                             $m .= '</td>
                                                   </tr>';
                                        $j++;       
                                        }
                                    }else{
                                        $m = '<tr>
                                                <td colspan="7">No Data Found</td>
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
         $.get("<?=base_url('admin/update_sequence')?>/category/"+ids+"/"+val, function(data){

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
    