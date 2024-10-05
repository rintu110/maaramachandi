 <div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="hvr-buzz-out fa fa-list-alt"></i>
     </div>  
    <div class="header-title">
        <h1>Request User List</h1>  
        <small>&nbsp;</small>   
        <!-- <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/page_meta')?>'">
                <i class="hvr-buzz-out fa fa-plus"></i>&nbsp;Add
            </button>&nbsp;
            <button type="button" class="btn btn-danger" onclick="window.location='<?=base_url('admin/t_pages')?>'">
              <i class="hvr-buzz-out fa fa-remove"></i>&nbsp;Trash
            </button>
        </div> -->
    </div>
   </section>
 <!-- Main content -->
 <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">                   
                    <div class="panel-body">                                   
                        <div class="table-responsive">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-sm-1">
                                  <form role="form" method="post" name="frm_per_page" action="<?=base_url()?>admin/request_form">                                     
                                      <input type="hidden" name="form_name" value="<?=(isset($form_name) && $form_name!='')?$form_name:''?>" />
                                      <input type="hidden" name="date_range" value="<?=(isset($date_range) && $date_range!='')?$date_range:''?>" />
                                    <select name="per_page" class="form-control input-sm" onchange="document.frm_per_page.submit();">
                                        <option value="10"  <?=(isset($limit) && $limit == 10)?'SELECTED':''?>>10</option>
                                        <option value="50"  <?=(isset($limit) && $limit == 50)?'SELECTED':''?>>50</option>
                                        <option value="100" <?=(isset($limit) && $limit == 100)?'SELECTED':''?>>100</option>                     
                                        <option value="250" <?=(isset($limit) && $limit == 250)?'SELECTED':''?>>250</option>
                                        <option value="500" <?=(isset($limit) && $limit == 500)?'SELECTED':''?>>500</option>
                                    </select>
                                   </form> 
                                </div> 
                               
                              <form role="form" method="post" action="<?=base_url()?>admin/request_form"> 
                                <input type="hidden" name="per_page" value="<?=(isset($per_page) && $per_page !='')?$per_page:''?>">  
                                <div class="col-sm-3">
                                  <select class="form-control input-sm" name="form_name">
                                    <option value="">select</option>
                                    <option value="Quick Quote" <?=(isset($form_name) && $form_name == 'Quick Quote')?'SELECTED':''?>>Quick Quote</option>
                                    <option value="Product Enquiry Form" <?=(isset($form_name) && $form_name == 'Product Enquiry Form')?'SELECTED':''?>>Product Enquiry Form</option>
                                    <option value="Contact Us Form" <?=(isset($form_name) && $form_name == 'Contact Us Form')?'SELECTED':''?>>Contact Us Form</option>
                                  </select>  
                                </div>    

                                 <div class="col-sm-2">
                                  <input class="form-control input-sm date-pickerrange" data-date-format="dd-mm-yyyy" type="text" placeholder="Date Range OR Current Date" name="date_range" value='<?=(isset($date_range) && $date_range!='')?$date_range:''?>' autocomplete="off">
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-darkorange shiny btn-sm" name="Search">Search</button>&nbsp;&nbsp;               
                                    <button type="button" class="btn btn-maroon shiny btn-sm" onclick="window.location.href = '<?=base_url('admin/clear_data')?>'">Refresh</button>
                                </div>
                             </form>   

                               <div class="col-sm-4" style="text-align: right;">                              
                                   <a class="btn btn-info btn-sm shiny" href="<?=base_url('admin/request_form?action=exportreport')?>"> <span>Export</span></a>
                               </div> 
                              </div>     

                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Post Date</th>
                                        <th>Form Name</th>                                       
                                        <th>Name</th>                                       
                                        <th>Email</th>                                       
                                        <th>Post Content</th>
                                        <th>Email Sent</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                   <?

                                        $m = '';
                                        $v = 0;
                                        $j = 1; 
                                        
                                        if(sizeof($pages,1)>0)
                                        {
                                            foreach($pages as $z)
                                            {
                                                $v++;

                                                $decode = json_decode($z->request_data);
                                                $str = '';

                                                foreach($decode as $k => $v)
                                                {
                                                   if($k == 'post_name')                 
                                                      $k = 'Product Name';               

                                                   if($k == 'submit-form')
                                                       continue;

                                                     $str .= ucfirst($k).': '.$v.'<br>'; 
                                                }    

                                                $bgcolor = '#ffffce66';
                                                $read = "<span style='cursor:pointer;' ids ='".$z->id."' class='read btn btn-info btn-xs'>Mark As Read</span>";
                                                if($z->status == 1)
                                                {
                                                    $bgcolor = ''; 
                                                    $read = '';   
                                                }  
                                                
                                                $m .= '<tr style="background:'.$bgcolor.'">
                                                            <td class="tdmiddle">'.$j.'</td>
                                                            <td class="tdmiddle">'.$z->added_on.'</td>  
                                                            <td class="tdmiddle">'.$z->form_name.'</td>                                     
                                                            <td class="tdmiddle">'.$decode->name.'</td>                                     
                                                            <td class="tdmiddle">'.$decode->email.'</td>                                        
                                                            <td>'.char_limiter($str,100,150).'</td>                              
                                                            <td class="center tdmiddle">
                                                             <a class="datas" href="javascript:void(0)" ids ="'.$z->id.'">
                                                              <span class="btn btn-success btn-xs">View</span>
                                                             </a>  
                                                            </td>                               
                                                            <td class="center tdmiddle">';

                                                 $m .= $read;
                                                 $m .= '</td>
                                                       </tr>';

                                                 /*$m .="<a title='Click To Delete' onclick=\"if(confirm('Would You Like To Delete This Record')){self.location='".base_url()."admin/del_record/contacts/$z->id'}\" style='cursor:pointer'>
                                                                   <i class='fa fa-trash-o'></i>
                                                                </a>";*/      
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
                <h1 class="modal-title">User Data</h1>
            </div>
            <div class="modal-body" style="text-align: left">
               <div id="innerbox"></div>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>              
                <button type="button" class="btn btn-success" onclick="window.location.href='mailto:rintu111@gmail.com'">Reply</button>              
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
 <!--Bootstrap Date Range Picker-->
<link  href="<?=base_url()?>assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>assets/js/datetime/moment.js"></script>
<script src="<?=base_url()?>assets/js/datetime/daterangepicker.js"></script>
<script type="text/javascript">

    $('.date-pickerrange').daterangepicker({
        "ranges": {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         },
         "alwaysShowCalendars": true,
         'showCustomRangeLabel':true 
    });

    function get_form_data(ids)
    {   
         var result = null;
         var scriptUrl = "<?=base_url('admin/get_form_data')?>";      
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
               var ids = $(this).attr("ids");  
               var banner_img = get_form_data(ids);    
               $("#innerbox").html(banner_img);
               $(".popmeup").modal({backdrop: "static", keyboard: false}) ; 
               //$("#load").delay(2000).hide();
               $(".popmeup").modal("show");

       });      

        $(".read").on("click", function(){

             var ids = $(this).attr("ids");  
             var result = null;
             var scriptUrl = "<?=base_url('admin/read_content')?>";      
             $.ajax({
                  url: scriptUrl,
                  type: 'POST',
                  data:{
                        ids: ids,
                  },
                  dataType: 'html',
                  async: false,
                  success: function(data) {

                      if(data == 1)
                      {
                         location.reload(); 
                      }
                      result = data;
                  } 
             });
            return result;

        });        

   });  
</script>