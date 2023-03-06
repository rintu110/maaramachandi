 <div class="content-wrapper">
   <section class="fixed content-header">  
     <div class="header-icon">
        <i class="fa fa-file-text"></i>        
     </div>  
    <div class="header-title">
        <h1>Menu</h1>  
        <small>&nbsp;</small>   
        <!-- <div class="breadcrumb">
            <button type="button" class="btn btn-black" onclick="window.location='<?=base_url('admin/pages')?>'">
                <i class="hvr-buzz-out fa fa-list-alt"></i>&nbsp;Back To List
            </button>&nbsp;
             <button type="submit" class="btn btn-success">
                <i class="hvr-buzz-out fa fa-save"></i>&nbsp;Save</button>&nbsp;                              
             <button type="button" class="btn btn-info" onclick="window.location='<?=base_url('admin/add_page')?>'">
                <i class="hvr-buzz-out fa fa-share-square-o"></i>&nbsp;Cancel</button>
        </div> -->
    </div>
   </section>
<section class="content" style="min-height: auto;">
    <div class="row">                                              
        <!-- Textual inputs -->
        <div class="col-sm-6">
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
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Menu Label</h4> 
                    </div>                   
                </div>
                <form method="post" name="frm_label">
                    <div class="panel-body">                       
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Menu Label Name&nbsp;<span class="red">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" placeholder="Menu Label Name" name="menu_labelnm" required="required" value="<?=($id != '')?$idsdata->menu_labelnm:''?>">
                            </div>
                        </div>                      
                        <hr >
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success" name="btnlabel">Add</button>&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-default" onclick="window.location='<?=base_url('admin/menu')?>'">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
           <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Menu Label List</h4> 
                    </div>                   
                </div>
                  <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SlNo</th>
                                <th>Label Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          if(is_array($Mastermenu_list) && sizeof($Mastermenu_list)> 0)
                          {
                            $i = 1;
                            foreach ($Mastermenu_list as $k => $v) 
                            {        
                                if($v->status == 1)
                                    $vc = '<a class="btn btn-success btn-xs" href="'.base_url("admin/update_status/".$v->id.'/master_menu/0').'">Active</a> ';
                                else if($v->status == 0)
                                    $vc = '<a class="btn btn-danger btn-xs" href="'.base_url("admin/update_status/".$v->id.'/master_menu/1').'" >Block</a></span>';          
                       ?>
                            <tr>
                              <td><?=$i?></td>
                              <td><?=$v->menu_labelnm?></td>
                              <td>
                                 <a class="btn btn-xs btn-success" title="Click To Edit" href="<?=base_url("admin/menu/".$v->id)?>">
                                     <i class="fa fa-pencil"></i>
                                </a>&nbsp;&nbsp;
                                 <?=$vc?> 
                              </td>
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
        </div> 
   
  </section>
    <section class="content">
     <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd">
            <form class="form-horizontal" role="form" method="post">
              <div class="col-sm-3">
               <div class="form-group" style="margin-top: 10px;">
                  <div class="col-md-12">                    
                    <div id="first-name-input-wrapper" class="controls col-sm-8">
                      <select name="master_menu_id" class="form-control" required>
                         <option value="">Select Label</option>
                        <?
                          if(is_array($Mastermenu_list) && sizeof($Mastermenu_list)> 0)
                          {
                              $i = 1;
                              foreach ($Mastermenu_list as $k => $v) 
                              {
                        ?>  
                                  <option value="<?=$v->id?>"><?=$v->menu_labelnm?></option>          
                        <?
                              }
                          }    
                        ?>                      
                     </select>
                    </div>
                  </div>
               </div>
                <div id="accordion" class="panel-group">                  
                    <?php
                      if(is_array($pages) && sizeof($pages) > 0)
                      {
                    ?>
                    <div class="panel panel-default">
                      <div class="panel-heading vd_bg-green vd_bd-green">
                          <h4 class="panel-title"> <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class=""> Pages </a> </h4>
                     </div>
                     <div class="panel-collapse collapse in" id="collapseOne" style="">
                      <div class="panel-body">
                       <div class="skin-square">                                                              
                            <?php  
                                  $pg_f = array_search_multidim($pages,'parent_pg',0);

                                  if(is_array($pg_f) && sizeof($pg_f,1) > 0)
                                  {
                                     
                                      foreach ($pg_f as $v)
                                      {
                                        $inner_page = '';
                                         $pg_inr = array_search_multidim($pages,'parent_pg',$v->id);

                                         if(is_array($pg_inr) && sizeof($pg_inr,1) > 0)
                                         {                                              
                                              foreach ($pg_inr as $v1)
                                              {
                            
                                                   $inner_page .= '<div class="i-check">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="page[]" value="table_nm=>\'page\',col_value=>\''.$v1->id.'\',menu_name=>\''.$v1->pg_name.'\',menu_url=>\''.$v1->slug_url.'\',parent_id=>\''.$v1->parent_pg.'\',post_type=>\'Page\'">&nbsp;'.$v1->pg_name.'
                                                      </div>';
                            
                                              }
                                         }
                            ?>                        
                                  <div class="i-check">
                                    <input type="checkbox" name="page[]" value="table_nm=>'page',col_value=><?=$v->id?>,menu_name=>'<?=$v->pg_name?>',menu_url=>'<?=$v->slug_url?>',parent_id=><?=$v->parent_pg?>,post_type=>'Page'">&nbsp;<?=$v->pg_name?>
                                  </div><?=$inner_page?>                         
                            <?php  
                                     }         
                                  }
                            ?> 
                      </div>
                    </div>
                  </div>
                </div>
                    <?php  
                     }                 
                      if(is_array($category) && sizeof($category,1) > 0)
                      {
                      ?>
                       <div class="panel panel-default">
                      <div class="panel-heading vd_bg-green vd_bd-green">
                          <h4 class="panel-title"> <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="collapsed"> Category </a></h4>
                     </div>
                     <div class="panel-collapse collapse in" id="collapseOne" style="">
                      <div class="panel-body">
                       <div class="skin-square">                      
                       <div class="i-check">
                        <input type="checkbox" name="category[]" value="table_nm=>'category',col_value=>1,menu_name=>'Product',menu_url=>'product',parent_id=>0,post_type=>'Category'">
                        &nbsp;Product<br>
                     </div>
                      <?php  

                          $cat_f = array_search_multidim($category,'parent_id',0);

                          //print_result($cat_f);exit;

                          if(is_array($cat_f) && sizeof($cat_f,1) > 0)
                          {
                             foreach ($cat_f as $v) 
                             {
                                $cat_innr = array_search_multidim($category,'parent_id',$v->id);
                                $sub_cat = '';

                                if(is_array($cat_innr) && sizeof($cat_innr,1)>0)
                                {   
                                    foreach ($cat_innr as $v1) 
                                    {
                                        $sub_cat .="<div class='i-check'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type='checkbox' name='category[]' value=\"table_nm=>'category',col_value=>".$v1->id.",menu_name=>'".$v1->cat_name."',menu_url=>'".$v1->slug_url."',parent_id=>".$v1->parent_id.",post_type=>'Category'\">
                                        &nbsp;".$v1->cat_name.'</div>';
                                    }
                                }                                
                    ?>
                   
                    <div class="i-check">
                        <input type="checkbox" name="category[]" value="table_nm=>'category',col_value=><?=$v->id?>,parent_id=><?=$v->parent_id?>,menu_name=>'<?=$v->cat_name?>',menu_url=>'<?=$v->slug_url?>',post_type=>'Category'">
                        &nbsp;<?=$v->cat_name?>                             
                     </div>
                    
                   <?
                            }    
                        }
                  ?>
                     </div>
                    </div>
                  </div>
                </div>
                  
                  <?php      
                     }   
                   ?> 
                                           
                  <div class="row">
                    <div class="col-md-12" style="margin-top:10px; text-align:right">
                      <input class="btn btn-success btn-sm" type="submit" name="add_to_menu" id="add_menu" value="Add Menu">
                    </div>
                  </div>
                  <!-- Panel Widget --> 
                </div>
               </div>
              </form>
             <div class="col-sm-8">
                <div class="form-group">
                  <div class="col-md-12" style="margin: 10px 0px 19px 0px; ">                    
                    <div class="controls col-sm-5">
                      <select name="master_menu_id" class="form-control input-sm">
                         <option value="">Select Menu Label</option>
                        <?php
                          if(is_array($Mastermenu_list) && sizeof($Mastermenu_list,1)> 0)
                          {
                              $i = 1;
                              foreach ($Mastermenu_list as $k => $v) 
                              {
                        ?>  
                                  <option value="<?=$v->id?>"><?=$v->menu_labelnm?></option>          
                        <?
                              }
                          }    
                        ?> 
                    
                      </select>
                    </div>
                </div>
             </div>
     </div>  
     
     <div class="row">
        <div class="col-sm-8">
           <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Menu List</h4> 
                    </div>                   
                </div>
                  <div class="table-responsive">
                   <table class="table table-condensed table-striped">
                <thead>
                  <tr>
                    <th style="width:480px;">Menu Name</th>
                    <th>Post Type</th>
                    <th>Sequence</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $res_menu = $this->db->query("SELECT menu_name,post_type,col_value,id,parent_id,sequence FROM menu_n where 1 ORDER BY sequence ASC")->result();

                  if(is_array($res_menu) && sizeof($res_menu,1) > 0)
                  {
                      $page_mnu = array_search_multidim($res_menu,'post_type','Page');
                      $page_mnuu = array_search_multidim($page_mnu,'parent_id',0);

                      foreach ($page_mnuu as $v)                        
                      {  
                            $url1 = base_url('admin/delete_menu/'.$v->id);
                            $sub_pg = array_search_multidim($page_mnu,'parent_id',$v->col_value);
                            $sub_page = '';
                            $inner_page = '';
                            if(is_array($sub_pg) && sizeof($sub_pg,1) > 0)
                            {
                                foreach ($sub_pg as $v1) 
                                {
                                   $inner_pg = array_search_multidim($page_mnu,'parent_id',$v1->col_value);   
                                   $url2 = base_url('admin/delete_menu/'.$v1->id);

                                   if(is_array($inner_pg) && sizeof($inner_pg,1) > 0)
                                   { 
                                       foreach ($inner_pg as $v2) 
                                       {
                                          $url3 = base_url('admin/delete_menu/'.$v2->id);


                                          $inner_page .= '<tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v2->menu_name.'</td>
                                                    <td>'.$v2->post_type.'</td>
                                                    <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v2->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v2->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                                    <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\''.$url3.'\';}" style="cursor:pointer">Delete</a></td>
                                                  </tr>';
                                       }
                                   }  

                                   $sub_page .= '<tr>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v1->menu_name.'</td>
                                                <td>'.$v1->post_type.'</td>
                                                <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v1->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v1->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                                <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\''.$url2.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                                '. $inner_page.'
                                              </tr>';
                                }
                            }
                            echo '<tr>
                                    <td>&nbsp;'.$v->menu_name.'</td>
                                    <td>'.$v->post_type.'</td>
                                    <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                    <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\''.$url1.'\';}" style="cursor:pointer">Delete</a></td>
                                    '.$sub_page.'
                                  </tr>'; 
                      }    

                      $cat_mnu = array_search_multidim($res_menu,'post_type','Category');
                      $cat_mnuu = array_search_multidim($cat_mnu,'parent_id',0);  

                      foreach ($cat_mnuu as $v)                        
                      {  
                          $sb_cat = array_search_multidim($cat_mnu,'parent_id',$v->col_value);
                          $sub_cat = '';
                          $inner_cat = '';
                          if(is_array($sb_cat) && sizeof($sb_cat,1) > 0)
                          {
                              foreach ($sb_cat as $v1) 
                              {
                                 $url2 =  base_url('admin/delete_menu/'.$v1->id);
                                 $inner_ct = array_search_multidim($cat_mnu,'parent_id',$v1->col_value);   

                                 if(is_array($inner_ct) && sizeof($inner_ct,1) > 0)
                                 { 
                                     foreach ($inner_ct as $v2) 
                                     {
                                        $url1 =  base_url('admin/delete_menu/'.$v2->id);

                                        $inner_cat .= '<tr>
                                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v2->menu_name.'</td>
                                                  <td>'.$v2->post_type.'</td>
                                                  <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v2->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v2->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                                  <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\''.$url1.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                                </tr>';
                                     }
                                 }  


                                 $sub_cat .= '<tr>
                                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v1->menu_name.'</td>
                                              <td>'.$v1->post_type.'</td>
                                              <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v1->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v1->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                              <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\''.$url2.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                              '.$inner_cat.'
                                            </tr>';
                              }
                          }
                          echo '<tr>
                                  <td>&nbsp;'.$v->menu_name.'</td>
                                  <td>'.$v->post_type.'</td>
                                  <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                  <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\'mng_menu.php?action=per_delete&id='.$v->id.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                  '.$sub_cat.'
                                </tr>'; 
                      }
                  }      
                  else
                  {
               ?>
                      <tr>
                          <td colspan="4">No Menu Found</td>
                      </tr>
               <?       
                  }             
               ?>               
               </tbody>
              </table>
                </div>
             </div>
            </div>        
     </div>
</section>

<script language="javascript">

   function set_sequence(val,ids)
  {      
       $.get("<?=base_url('admin/update_sequence')?>/menu_n/"+ids+"/"+val, function(data){

          if(data == '1')
          {
              $("#success").click();
          }
          else if(data == '0')
          {
              $("#error").click(); 
          }
      });        
  }    
  </script>
  <button id='success'  onclick="javascript: toastr.success('Success - Record has sequenced.'); return false;" style="display:none" >Success</button>
<button id='error' onclick="javascript: toastr.error('Error - Unable to process your request! Please try again.'); return false;" style="display:none">Error</button>