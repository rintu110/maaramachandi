<div class="content-wrapper">
  <form method="post" name="frm_page" enctype="multipart/form-data">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Dashboard</h1>  
        <small>&nbsp;</small>           
    </div>
   </section>
                <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-body">
                       <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                           <h3><strong>Welcome To Admin Panel</strong></h3>
                           <br>
                           <input type="button" class="btn btn-inverse w-md m-b-5" value="Master Settings" onclick="window.location.href='<?=base_url('admin/site_setting/1485')?>'">
                       </div> 
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                          <h4>Links</h4>
                            <address>
                                <a href="<?=base_url()?>" target='_blank'><i class="hvr-buzz-out fa fa-globe"></i>&nbsp;&nbsp; Visit My Site</a>
                                <br> <br>
                                <a href="<?=base_url('admin/pages')?>"><i class="fa fa-file-text"></i>&nbsp;&nbsp; Visit Pages</a>
                                <br> <br>
                                <a href="<?=base_url('admin/category')?>"><i class="hvr-buzz-out fa fa-check"></i>&nbsp;&nbsp; Visit Category</a>
                                <br> <br>
                                <a href="<?=base_url('admin/product')?>"><i class="fa fa-product-hunt"></i>&nbsp;&nbsp; Visit Products</a>
                                <br>
                            </address>                            
                         </ol>
                       </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                           <h4>More Actions</h4>
                           <address>
                                 <a href="<?=base_url('admin/testimonial')?>"><i class="hvr-buzz-out fa fa-list"></i>&nbsp;&nbsp; Manage Reviews</a>
                                <br> <br>
                                <a target="_blank" href="<?=base_url('admin/site_setting/1485')?>"><i class="hvr-buzz-out fa fa-key"></i>&nbsp;&nbsp; Site Settings</a>
                                <br> <br>
                                <a href="<?=base_url('admin/logout')?>"><i class="hvr-buzz-out fa fa-share"></i>&nbsp;&nbsp; Logout</a>
                                <br>
                            </address>
                       </div>
                    </div>
                </div>
            </div>
           <!--  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="QHadqj5Etn">
                <div class="panel panel-bd lobidisable lobipanel lobipanel-sortable" data-inner-id="QHadqj5Etn" data-index="0">
                    <div class="panel-heading ui-sortable-handle">
                        <div class="panel-title" style="max-width: calc(100% - 90px);">
                            <h4>Recent Activities</h4>
                        </div>
                        <div class="dropdown"></div>
                    </div>
                    <div class="panel-body">
                        <ul class="activity-list list-unstyled">
                            <li class="activity-purple">
                                <small class="text-muted">9 minutes ago</small>
                                <p>You <span class="label label-success label-pill">recommended</span> Karen Ortega</p>
                            </li>
                            <li class="activity-danger">
                                <small class="text-muted">15 minutes ago</small>
                                <p>You followed Olivia Williamson</p>
                            </li>
                            <li class="activity-warning">
                                <small class="text-muted">22 minutes ago</small>
                                <p>You <span class="text-danger">subscribed</span> to Harold Fuller</p>
                            </li>
                            <li class="activity-primary">
                                <small class="text-muted">30 minutes ago</small>
                                <p>You updated your profile picture</p>
                            </li>
                            <li>
                                <small class="text-muted">35 minutes ago</small>
                                <p>You deleted homepage.psd</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="aJE8qXl6RH">
                <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="aJE8qXl6RH" data-index="0">
                    <div class="panel-heading ui-sortable-handle">
                        <div class="panel-title" style="max-width: calc(100% - 180px);">
                            <h4>Contacts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                  <a href="<?=base_url('admin/request_form')?>" class="btn btn-xs btn-danger">
                                     View All 
                                 </a>
                             </h4>
                        </div>
                         <div class="dropdown">
                             
                         </div>
                    </div>                                
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DateTime</th>
                                    <th>FormName</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           <?
                               if(is_array($contacts) && sizeof($contacts,1) > 0)
                               {
                                  $i = 1;
                                  foreach ($contacts as $v)
                                  {
                                     $dcode = json_decode($v->request_data);

                                     //print_result($dcode);
                            ?>
                                     <tr>
                                        <td><?=$i?></td>
                                        <td><?=$v->added_on?></td>
                                        <td><?=$v->form_name?></td>
                                        <td><?=$dcode->name?></td>
                                        <td><?=$dcode->email?></td>
                                        <td><a href="javascript:void(0)" ids ="<?=$v->id?>" class="datas btn btn-success btn-xs">View</a></td>
                                    </tr>
                            <?   
                                    $i++;      
                                  }
                               } 
                           ?>   
                            </tbody>
                        </table>
                    </div>                                
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2>
                                <span class="count-number"><?=$total_pages?></span> 
                            </h2>
                            <div class="small">Pages</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?=$total_prd_cat?></span> </h2>
                            <div class="small">Total Product Category</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?=$total_prd?></span></h2>
                            <div class="small">Total Products</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?=$total_reviews?></span></h2>
                            <div class="small">Total Reviews</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <!--  <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Contacts</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table  class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Street Address</th>
                                        <th>% Share</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Naeem Khan</td>
                                        <td>123 456 7890</td>
                                        <td>294-318 Duis Ave</td>
                                        <td><div class="sparkline5"></div> </td>
                                        <td>Noakhali</td>
                                        <td><a href="#" class="btn btn-success btn-xs">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Tuhin Sarkar</td>
                                        <td>123 456 7890</td>
                                        <td>680-1097 Mi Rd.</td>
                                        <td><div class="sparkline6"></div></td>
                                        <td>Lavoir</td>
                                        <td><a href="#" class="btn btn-success btn-xs active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Tanjil Ahmed</td>
                                        <td>456 789 1230</td>
                                        <td>Ap #289-8161 In Avenue</td>
                                        <td><div class="sparkline7"></div></td>
                                        <td>Dhaka</td>
                                        <td><a href="#" class="btn btn-success btn-xs">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Sourav</td>
                                        <td>789 123 4560</td>
                                        <td>226-4861 Augue. St.</td>
                                        <td><div class="sparkline8"></div></td>
                                        <td>Rongpur</td>
                                        <td><a href="#" class="btn btn-success btn-xs">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Jahangir Alam</td>
                                        <td>(01662) 59083</td>
                                        <td>3219 Elit Avenue</td>
                                        <td><div class="sparkline9"></div></td>
                                        <td>Chittagong</td>
                                        <td><a href="#" class="btn btn-success btn-xs">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4 hidden-sm hidden-md">
                <div class="social-widget">
                    <ul>
                        <li>
                            <div class="fb_inner">
                                <i class="fa fa-facebook"></i>
                                <span class="sc-num">5,791</span>
                                <small>Fans</small>
                            </div>
                        </li>
                        <li>
                            <div class="twitter_inner">
                                <i class="fa fa-twitter"></i>
                                <span class="sc-num">691</span>
                                <small>Followers</small>
                            </div>
                        </li>
                        <li>
                            <div class="g_plus_inner">
                                <i class="fa fa-google-plus"></i>
                                <span class="sc-num">147</span>
                                <small>Followers</small>
                            </div>
                        </li>
                        <li>
                            <div class="dribble_inner">
                                <i class="fa fa-dribbble"></i>
                                <span class="sc-num">3,485</span>
                                <small>Followers</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --> <!-- /.row -->
    </section> <!-- /.content -->
   </div> <!-- /.content-wrapper -->
      
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
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
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
   });  
</script>      