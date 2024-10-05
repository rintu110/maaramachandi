 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Banner List</h1>  
        <small>&nbsp;</small>   
        <div class="breadcrumb">           
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/add_banner')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_banner')?>'">
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
                                    <th>Heading</th>
                                    <th>Desc</th>
                                    <th>URL</th>
                                    <th>Banner</th>
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
                                
                                if(count($banner)>0){
                                    foreach($banner as $z){
                                        $v++;
                                        if($z->status == 1){
                                            $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$z->id.'/banner/0').'">Active</a> ';               
                                        }else if($z->status == 0){
                                            $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$z->id.'/banner/1').'" >Block</a></span>';                  
                                        }                   
                                        
                                        $m .= '<tr>
                                                    <td class="center tdmiddle">'.$j.'</td>                                                             
                                                    <td class="tdmiddle">'.$z->bnr_heading.'</td>                                                               
                                                    <td class="tdmiddle">'.$z->description.'</td>                                                               
                                                    <td class="tdmiddle">'.$z->readmore_url.'</td>                                                              
                                                    <td>
                                                        <a class="datas" href="javascript:void(0)" ids ="'.$z->id.'">
                                                          <img src="'.base_url().'banner_img/'.$z->bnr_img.'" alt="'.$z->alt_tag.'" width="200">
                                                        </a>  
                                                    </td>  
                                                    <td class="center tdmiddle">
                                                        '.$vc.'
                                                    </td>
                                                    <td class="center tdmiddle">
                                                      <input type="text" size="3" value="'.$z->sequence.'" class="center form-control input-sm" onblur="sequence(this.value,\''.$z->id.'\')" id ="'.$z->id.'" />
                                                    </td>   
                                                    <td class="center tdmiddle">
                                                        <a target="_blank" title="Click To Edit" href="'.base_url("admin/edit_banner/".$z->id).'">
                                                           <i class="fa fa-pencil"></i>
                                                        </a>&nbsp;&nbsp;';

                                         $m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Trash This Record')){self.location='".base_url()."admin/trash_record/banner/$z->id'}\" style='cursor:pointer'>
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
</section>
<div class="modal popmeup fade in" tabindex="-1" role="dialog" style="display: none; text-align: center;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h1 class="modal-title">Banner Image</h1>
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
<!-- <div class="modal popmeup modal-darkorange" role="dialog" >
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close maroon" data-dismiss="modal" aria-hidden="true">x</button>
           <h5 class="modal-title"><strong>Details</strong></h5>
       </div>
      <div class="modal-body">        
           <div id="innerbox"></div>                       
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
              </div> 
           </div>
      </div> 
   </div>  --> 
<script type="text/javascript">

    function get_banner_image(ids)
    {   
         var result = null;
         var scriptUrl = "<?=base_url('admin/get_banner_image')?>";      
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
         $.get("<?=base_url('admin/update_sequence')?>/banner/"+ids+"/"+val, function(data){

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