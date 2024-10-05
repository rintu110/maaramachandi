 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Page List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_page')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_pages')?>'">
              <i class="hvr-buzz-out fa fa-remove"></i>&nbsp;Trash
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
        <table id="dataTableExample1" class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>SlNo</th>
                    <th>Page Name</th>
                    <th>URL</th>                                       
                    <th>Parent Page</th>                                       
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                                  
      <?php

                $m = '';
                $v = 0;
                $j = 1; 
        
                if(count($pages)>0){
                    foreach($pages as $z){
                        $v++;
                        if($z->status == 1){
                            $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/page/0').'">Active</a> ';             
                        }else if($z->status == 0){
                            $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/page/1').'" >Block</a></span>';                    
                        }

                        $parent = '<span class="label label-primary-outline">Parent</span>';

                        if($z->parent_pg !='0')
                        {
                            $q = $this->db->query("SELECT pg_name FROM page where id = '".$z->parent_pg."'")->row();

                            $parent =  '<span class="label label-primary">'.$q->pg_name.'</span>';
                        }               
                        
                        $m .= '<tr>
                                    <td>'.$j.'</td>
                                    <td>'.$z->pg_name.'</td>                                        
                                    <td>'.$z->slug_url.'</td>   
                                    <td>'.$parent.'</td>                                                                    
                                    <td class="center tdmiddle">
                                        '.$vc.'
                                    </td>                               
                                    <td class="center tdmiddle">
                                        <a title="Click To Edit" href="'.base_url("admin/edit_page/".$z->id).'">
                                           <i class="fa fa-pencil"></i>
                                        </a>&nbsp;&nbsp;';

                         $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/page/$z->id'}\" style='cursor:pointer'>
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