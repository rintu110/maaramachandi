 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Donation List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/gallery')?>'">
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
                                        <th>#</th>                                       
                                        <th>Category</th>                                        
                                        <th>Image Tag</th>                                        
                                        <th>Image</th>
                                        <th>Status</th>                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?
                                    $m = '';
                                    $v = 0;
                                    $j = 1; 
                                    
                                    if(is_array($gallery) && sizeof($gallery,1)>0)
                                    {
                                        foreach($gallery as $z)
                                        {
                                            $v++;
                                            if($z->status == 1){
                                                $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/img_gallery/0').'">Active</a> ';             
                                            }else if($z->status == 0){
                                                $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/img_gallery/1').'" >Block</a></span>';                    
                                            }    

                                            if($z->gallery_img !='')
                                            {
                                                $img = base_url('gallery_img/thumb1/').$z->gallery_img;
                                            }                                         
                                            
                                            $m .= '<tr>
                                                        <td class="tdmiddle">'.$j.'</td>
                                                        <td class="tdmiddle">'.$z->cat_name.'</td>
                                                        <td class="tdmiddle">'.$z->img_tag.'</td>    
                                                        <td class="tdmiddle">';
                                                       if($z->gallery_img !='')
                                                       { 
                                                           $m .='<a class="datas" href="javascript:void(0)" ids ="'.$z->id.'">
                                                                        <img src="'.$img.'" width="75"></td>
                                                                  </a>';

                                                       }   
                                                                                               
                                                      $m .='<td class="center tdmiddle">'.$vc.'</td>
                                                            <td class="center tdmiddle">';                                                        

                                                        $m .="<a title='Click To Edit' href='".base_url('admin/edit_gallery/'.$z->id)."'>
                                                               <i class='fa fa-pencil'></i>
                                                            </a>&nbsp;&nbsp;";

                                             // $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/category/$z->id'}\" style='cursor:pointer'>
                                             //                   <i class='fa fa-trash-o'></i>
                                             //                </a>";
                                             //                <td class="center tdmiddle">
                                                         /* <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                        </td> */
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
    <div class="modal popmeup fade in" tabindex="-1" role="dialog" style="display: none; text-align: center;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h1 class="modal-title">Gallery Image</h1>
            </div>
            <div class="modal-body">
               <div id="innerbox"></div>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>              
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
   <script type="text/javascript">
    function get_banner_image(ids)
    {   
         var result = null;
         var scriptUrl = "<?=base_url('admin/get_gallery_image')?>";      
         $.ajax({
              url: scriptUrl,
              type: 'POST',
              data:{
                    ids: ids,
              },
              dataType: 'html',
              async: false,
              success: function(data) {
                  result = data;
              } 
         });
        return result;
    }

     $(document).ready(function(){  

        $(".datas").on("click", function(){

               //$("#load").show();                     
               var ids =$(this).attr("ids");  
               var banner_img = get_banner_image(ids);    
               $("#innerbox").html(banner_img);
               $(".popmeup").modal({backdrop: "static", keyboard: false}) ; 
               //$("#load").delay(2000).hide();
               $(".popmeup").modal("show");

          });      
   });  
    function sequence(val,ids)
    {      
         $.get("<?=base_url('admin/update_sequence')?>/members/"+ids+"/"+val, function(data){

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
    