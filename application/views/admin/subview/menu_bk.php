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
              <div class="col-sm-4">
               <div class="form-group" style="margin-top: 10px;">
                  <div class="col-md-12">
                    <label class="control-label  col-sm-4">Label Name <span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class="controls col-sm-8">
                      <select name="master_menu_id" class="form-control" required>
                         <option value="">Select</option>
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
                                  foreach ($pages as $k => $v)
                                   {
                            ?>                        
                                  <div class="i-check">
                                    <input type="checkbox" name="page[]" value="table_nm=>'page',col_value=><?=$v->id?>,menu_name=>'<?=$v->pg_name?>',menu_url=>'<?=$v->slug_url?>',parent_id=><?=$v->parent_pg?>,post_type=>'Page'">&nbsp;<?=$v->pg_name?>
                                  </div>                         
                            <?php        
                                  }
                            ?> 
                      </div>
                    </div>
                  </div>
                </div>
                    <?php      
                      }
                      if(is_array($tech) && sizeof($tech,1) > 0)
                      {
                    ?>
                    <div class="panel panel-default">
                      <div class="panel-heading vd_bg-green vd_bd-green">
                          <h4 class="panel-title"> <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="collapsed"> Category </a></h4>
                     </div>
                     <div class="panel-collapse collapse in" id="collapseOne" style="">
                      <div class="panel-body">
                       <div class="skin-square">                     
                    <?php    
                          foreach ($tech as $k => $v) {
                    ?>
                   <div class="i-check">
                      <input type="checkbox" name="category[]" value="table_nm=>'category',col_value=><?=$v->id?>,menu_name=>'<?=$v->cat_name?>',menu_url=>'<?=$v->slug_url?>',parent_id=><?=$v->parent_id?>,post_type=>'Technology'">
                      &nbsp;<?=$v->cat_name?>                             
                   </div>
                   <?
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
                          foreach ($category as $k => $v) 
                          {
                             $q = $this->db->query("SELECT id,cat_name,slug_url,parent_id FROM  category WHERE del_status = 0 AND parent_id = '".$v->id."' AND status = 1 AND post_type = 'Product' ORDER BY sequence ASC")->result_array();
                             
                              $sub_menu = '';

                            if(is_array($q) && sizeof($q)>0)
                            {   
                                foreach ($q as $k1 => $v1) 
                                {
                                  
                                    $sub_menu .="&nbsp;&nbsp;&nbsp;
                                          <input type='checkbox' name='category[]' value=\"table_nm=>'category',col_value=>".$v1['id'].",menu_name=>'".$v1['cat_name']."',menu_url=>'".$v1['slug_url']."',parent_id=>".$v1['parent_id'].",post_type=>'Category'\">
                                          &nbsp;".$v1['cat_name'].'<br>';
                                }
                            }
                    ?>
                   
                    <div class="i-check">
                        <input type="checkbox" name="category[]" value="table_nm=>'category',col_value=><?=$v->id?>,parent_id=><?=$v->parent_id?>,menu_name=>'<?=$v->cat_name?>',menu_url=>'<?=$v->slug_url?>',post_type=>'Category'">
                        &nbsp;<?=$v->cat_name.'<br>'.$sub_menu?>                             
                     </div>
                    
                   <?
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
                      <input class="btn vd_btn vd_bg-green btn-sm" type="submit" name="add_to_menu" id="add_menu" value="Add Menu">
                    </div>
                  </div>
                  <!-- Panel Widget --> 
                </div>
               </div>
              </form>
             <div class="col-sm-8">
                <div class="form-group">
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="control-label  col-sm-2">Label Name <span class="vd_red">*</span></label>
                    <div class="controls col-sm-8">
                      <select name="master_menu_id" class="form-control input-sm">
                         <option value="">Select</option>
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
     </div>  
     
     <div class="row">
        <div class="col-md-6">
          <div class="panel panel-bd">
            <div class="panel-heading no-title">
              <div class="vd_panel-menu">
                <div data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class="menu entypo-icon smaller-font" data-action="refresh"> <i class="icon-cycle"></i> </div>
              </div>
              <!-- vd_panel-menu --> 
              
            </div>
            <div class="panel-body  table-responsive">
              <h2 class="mgtp--5"> Menu Listing </h2>
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
                  $res_menu = $this->db->query("SELECT menu_name,post_type,col_value,id,parent_id FROM menu_n where 1 ORDER BY sequence ASC")->result();                 
                  if(sizeof($res_menu)>0)
                  {
                      echo '<tr>';
                      foreach ($res_menu as $k => $v)                        
                      {                     

                          $page_mnu = array_search_multidim($res_menu,'post_type','Page');
                          $page_mnu = array_search_multidim($page_mnu,'parent_id',0);

                          //print_result($page_mnu); exit;

                          $sub_menu = '';

                          foreach ($page_mnu as $k1 => $v1) 
                          {
                                $sub_menu.=' 
                                     <tr>
                                       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v1->menu_name.'</td>
                                        <td>'.$v->post_type.'</td>
                                        <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v1->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v1->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                        <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\'mng_menu.php?action=per_delete&id='.$v1->id.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                     </tr>';
                          }

                          /*$qry_sub = $this->db->query("SELECT * FROM menu_n where del_status = 0 AND parent_id = '".$v->col_value."' AND post_type = 'Page'")->result();

                           if(sizeof($qry_sub)>0)
                           {                               
                              foreach ($qry_sub as $k1 => $v1)                             
                              {   
                                    $sub_menu.=' 
                                     <tr>
                                       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v1->menu_name.'</td>
                                        <td>'.$v->post_type.'</td>
                                        <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v1->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v1->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                        <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\'mng_menu.php?action=per_delete&id='.$v1->id.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                     </tr>';
                                                            
                              }
                                  
                           }       */                
                  ?>
                  <tr>
                    <td><?=$v->menu_name?></td>
                    <td><?=$v->post_type?></td>
                    <td><input class="width-60" type="text"  name="sequence" id="sequence" value="<?php echo $v->sequence;?>"  size="2"  onblur="set_sequence(this.value,<?php echo $v->id;?>,'menu')" maxlength="2" style="text-align:center;height:30px;" /></td>
                    <td><a  onClick="if(confirm('Would You Like To Delete This Record')){self.location='mng_menu.php?action=per_delete&id=<?php echo $v->id;?>';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>      
                    <?=$sub_menu?>             
                  </tr>
                  <?    
                      }                       
                  }                   

                  $res_menu = $this->db->query("SELECT * FROM menu_n where del_status = 0 AND post_type = 'Category' and parent_id = 0 ORDER BY sequence ASC")->result();

                  if(sizeof($res_menu)>0)
                  {
                      echo '<tr>';
                      foreach ($res_menu as $k => $v)                        
                      {
                          $sub_menu = '';

                          $qry_sub = $this->db->query("SELECT * FROM menu_n where del_status = 0 AND parent_id = '".$v->col_value."' AND post_type = 'Category'")->result();                    

                           if(sizeof($qry_sub)>0)
                           {   
                              $sub_cat = '';                             
                              foreach ($qry_sub as $k1 => $v1)                             
                              {   
                                   $q_inr = $this->db->query("SELECT * FROM menu_n where del_status = 0 AND parent_id = '".$v1->col_value."' AND post_type = 'Category'")->result();

                                  // print_result($q_inr);


                                    if(sizeof($q_inr)>0)
                                    {
                                        $inr_cat = '';
                                        foreach ($q_inr as $k2 => $v2) {
                                             
                                             $inr_cat .= '<tr>
                                                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v2->menu_name.'</td>
                                                          <td>'.$v2->post_type.'</td>
                                                          <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v2->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v2->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                                          <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\'mng_menu.php?action=per_delete&id='.$v2->id.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                                       </tr>';
                                         } 
                                    }

                                   $sub_cat.='<tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$v1->menu_name.'</td>
                                            <td>'.$v1->post_type.'</td>
                                            <td><input class="width-60" type="text"  name="sequence" id="sequence" value="'. $v1->sequence.'"  size="2"  onblur="set_sequence(this.value,'.$v1->id.',\'menu\')" maxlength="2" style="text-align:center;height:30px;" /></td>
                                            <td><a  onClick="if(confirm(\'Would You Like To Delete This Record\')){self.location=\'mng_menu.php?action=per_delete&id='.$v1->id.'\';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>
                                         </tr>';
                                                               
                              }
                                  
                           }                       
                  ?>
                  <tr>
                    <td><?=$v->menu_name?></td>
                    <td><?=$v->post_type?></td>
                    <td><input class="width-60" type="text"  name="sequence" id="sequence" value="<?php echo $v->sequence;?>"  size="2"  onblur="set_sequence(this.value,<?php echo $v->id;?>,'menu')" maxlength="2" style="text-align:center;height:30px;" /></td>
                    <td><a  onClick="if(confirm('Would You Like To Delete This Record')){self.location='mng_menu.php?action=per_delete&id=<?php echo $v->id;?>';}" data-original-title="delete" data-toggle="tooltip" data-placement="top" style="cursor:pointer">Delete</a></td>                   
                    <?=$sub_cat?>
                  </tr>
                  <?    
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

<script language="javascript">

   function set_sequence(val,ids)
  {      
       $.get("<?=base_url('admin/update_sequence')?>/menu/"+ids+"/"+val, function(data){

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