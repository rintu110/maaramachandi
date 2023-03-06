 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Product List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
             <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_product')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_product')?>'">
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
                    <!-- <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Product List&nbsp;&nbsp;                          
                            <button type="button" class="btn btn-sm btn-primary w-md m-b-5" onclick="window.location='<?=base_url('admin/add_product')?>'">Add Product </button>&nbsp;&nbsp;   
                            <button type="button" class="btn btn-sm btn-danger w-md m-b-5" onclick="window.location='<?=base_url('admin/t_product')?>'">Trash</button></h4>
                        </div>
                    </div> -->
                    <div class="panel-body">                                   
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name/URL</th>                                     
                                        <th>Category</th>                                        
                                        <th>Image</th>                                        
                                        <th class="center">Sequence</th>
                                        <th class="center">Status</th>
                                        <th class="center">Gallery</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?
                                    $m = '';
                                    $v = 0;
                                    $j = 1; 
                                    
                                    if(count($productlist)>0){
                                        foreach($productlist as $z){
                                            $v++;
                                            if($z->status == 1){
                                                $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/post/0').'">Active</a> ';             
                                            }else if($z->status == 0){
                                                $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/post/1').'" >Block</a></span>';                    
                                            }   

                                            $c = $this->db->query("SELECT cat_name,slug_url FROM category where id = '".$z->cat_id."'")->row();

                                            $cat = $c->cat_name;

                                            $img = base_url('post/').$z->post_img;
                                            
                                            
                                            $m .= '<tr>
                                                        <td class="tdmiddle">'.$j.'</td>
                                                        <td class="tdmiddle">'.$z->post_name.'<br>'.$z->slug_url.'</td>     
                                                        <td class="tdmiddle">'.$cat.'</td>                              
                                                        <td><img src="'.$img.'" width="150"></td>                                                                   
                                                        <td class="center tdmiddle">
                                                          <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                        </td>
                                                        <td class="center tdmiddle">
                                                            '.$vc.'
                                                        </td>   
                                                        <td class="center tdmiddle">
                                                            <a class="btn btn-danger btn-xs" href="'.base_url('admin/prd_gallery/'.$z->id).'" target="_blank">Gallery</a>
                                                        </td>                           
                                                        <td class="center tdmiddle">';

                                                        $m .= '<a href="'.base_url('admin/edit_product/'.$z->id).'" title="Edit">
                                                                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;
                                                               </a>'; 

                                                        if($z->is_featured == 0)
                                                        {
                                                            $m .="<a title='Click To Featured' onclick=\"if(confirm('Would You Like To Featured This Record')){self.location='".base_url()."admin/update_featured/post/$z->id/1'}\" style='cursor:pointer'>
                                                               <i class='fa fa-star-o'></i>
                                                            </a>&nbsp;&nbsp;";
                                                        } 
                                                        else if($z->is_featured == 1)
                                                        {   
                                                            $m .="<a title='Click Not To Featured' onclick=\"if(confirm('Would You Like To Not Featured This Record')){self.location='".base_url()."admin/update_featured/post/$z->id/0'}\" style='cursor:pointer'>
                                                               <i class='fa fa-star'></i>
                                                            </a>&nbsp;&nbsp;";
                                                        }                   
                                                            

                                             $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/post/$z->id'}\" style='cursor:pointer'>
                                                               <i class='fa fa-trash-o'></i>
                                                            </a>&nbsp; <a target='_blank' title='Click To View' href='".base_url('product/'.$c->slug_url)."'>
                                                               <i class='fa fa-eye'></i>
                                                            </a>";
                                             $m .= '</td>
                                                   </tr>';
                                        $j++;       
                                        }
                                    }else{
                                        $m = '<tr>
                                                <td colspan="8">No Data Found</td>
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
         $.get("<?=base_url('admin/update_sequence')?>/post/"+ids+"/"+val, function(data){

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