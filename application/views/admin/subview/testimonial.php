 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Review List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_testimonial')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_testimonial')?>'">
              <i class="hvr-buzz-out fa fa-remove"></i>&nbsp;Trash
            </button>
        </div>
    </div>
   </section>
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
                <div class="panel-body">                   
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>AuthName</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Rating</th>
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
                                
                                if(count($testimonials)>0){
                                    foreach($testimonials as $z)
                                    {
                                        $v++;
                                        if($z->status == 1){
                                            $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/testimonial/0').'">Active</a> ';              
                                        }else if($z->status == 0){
                                            $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/testimonial/1').'" >Block</a></span>';                 
                                        }

                                        $desg = '';

                                        if($z->desg !='')                   
                                        {
                                             $desg = ' / '.$z->desg;
                                        }

                                        $img = base_url('testimonial_img/').$z->auth_img;
                                        
                                        $m .= '<tr>
                                                    <td class="center tdmiddle">'.$j.'</td>
                                                    <td class="center tdmiddle" >'.$z->auth_name.'</td> 
                                                    <td class="tdmiddle">
                                                      <img src="'.$img.'" width="100">
                                                    </td>                                   
                                                    <td>'.$z->contents.'</td>                                       
                                                    <td class="center tdmiddle">';

                                                     $averageRating = round($z->rating, 0);
                                                     for ($i = 1; $i <= 5; $i++) 
                                                     {
                                                        $ratingClass = "btn-default btn-grey";
                                                        if($i <= $averageRating) {
                                                            $ratingClass = "btn-warning";
                                                        }

                                                        $m .= '<button type="button" class="btn btn-sm '.$ratingClass.'" aria-label="Left Align">
                                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                              </button>';
                                                     }        

                                                $m .='</td>                                     
                                                    <td class="center tdmiddle">
                                                        '.$vc.'
                                                    </td>
                                                    <td class="center tdmiddle">
                                                      <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                    </td>   
                                                    <td class="center tdmiddle">
                                                        <a title="Click To Edit" href="'.base_url("admin/edit_testimonial/".$z->id).'">
                                                           <i class="fa fa-pencil"></i>
                                                        </a>&nbsp;&nbsp;';

                                         $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/testimonial/$z->id'}\" style='cursor:pointer'>
                                                           <i class='fa fa-trash-o'></i>
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
</section>

<script type="text/javascript">
    function sequence(val,ids)
    {      
         $.post("<?=base_url('admin/update_sequence')?>/testimonial/"+ids+"/"+val , function(data){

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