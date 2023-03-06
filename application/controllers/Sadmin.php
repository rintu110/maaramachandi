<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sadmin extends Admin_Controller {
	function __construct() 
	{
		parent::__construct();  
		$this->load->model('User_m');		
        $this->load->library('email');
		$this->load->helper('string');
        $this->load->library('pagination');	
        $this->load->helper('text');	
        
	}



////////////////----LOK--- NEW FUNCTIONS ON 4th OCT 2018 & ONWORDS---
	public function changepassword()
	{
		$id = $this->session->userdata('user_id');

		$inf = $this->db->query('SELECT * FROM user_mst where user_id = "'.$id.'"')->row();

		if($_POST)
		{			
			$old_pass = sha1(md5($_POST['old_p']));	
			$new_pass = sha1(md5($_POST['new_p']));				

			if(trim($inf->user_password) == trim($old_pass)){
				$data['user_password']= $new_pass;
				$this->db->where('user_id', $id);
				$mx = $this->db->update('user_mst',$data);
				if($mx)
					$this->session->set_flashdata('success','Password Changed Successfully');
				else
					$this->session->set_flashdata('error','Error in process');
				
			}else{
				
				/*echo $old_pass;
				echo '--||--';
				echo $inf->user_password;
				exit;*/

				$this->session->set_flashdata('error','Wrong Old Password');
			}
			redirect(base_url('sadmin/changepassword/'),'refresh');
		}

		$this->data['sub_view']='admin/subview/changepassword';
		$this->load->view('admin/_master',$this->data);
	}	

////////////////----LOK--- NEW FUNCTIONS---	

	public function exportreport($query= array(),$filename= NULL)
 	{
		if($filename != NULL)
		  	$filenm = $filename;
		else
  			$filenm = 'excel_output_';

		if($query && count($query)>0)
		{
			$fstarr = $query[1];	
			$titlearray = array_keys($fstarr);

	        if(!$query)
	            return false;	        

	        $this->load->library('Excel');
	        $objPHPExcel = new PHPExcel();
	        $objPHPExcel->getProperties()->setTitle("Output")->setDescription("none");
	        $objPHPExcel->setActiveSheetIndex(0);
	 
	        // Field names in the first row
	        $fields = $titlearray;
	        $col = 0;
	        foreach ($fields as $field)
	        {
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	            $col++;
        	}
	        $row = 2;
	        foreach($query as $data)
	        {
	            $col = 0;
	            foreach ($fields as $fieldz)
	            {
	            	//echo $row.'<br>';
	                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $data[$fieldz]);
	                $col++;
	            }
	            $row++;           
        	}
	 
	        $objPHPExcel->setActiveSheetIndex(0);	 
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			//ob_clean();

	        // Sending headers to force the user to download the file
	        header('Content-Type: text/csv');
	        header('Content-Disposition: attachment;filename="'.$filenm.'_'.date('dmyHis').'.csv"');
	        header("Cache-Control: no-store no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0");		
			header('Cache-Control: max-age=0');
			header("Pragma: no-cache");
			header("Expires: 0");	       
	        $objWriter->save('php://output');        
	        exit;
        }
        else
			return false;
	}

	public function index()
	{
		redirect(base_url("members/login"), "refresh");
	}

	
	
	public function dashboard()
	{	
		//echo sha1(md5('admin@123'));  exit();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Dashboard';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('sadmin/dashboard').'">
										  <i class="pe-7s-home"></i> Home
										</a>
									  </li>
									 
            						  <li class="active">Dashboard</li>';	
		
		$this->data['sub_view']='sadmin/subview/dashboard';
		$this->load->view('sadmin/_master',$this->data);
	}

	public function email_exists()
	{
		  $email = $this->input->post('email');		  
		  $exists = $this->User_m->get_many_by(array('user_email'=>$email));
		  $count = count($exists);         
		  echo $count;    
	}

	public function admin_list() 
	{	
		$extqry="";

		if(isset($_POST['adper_page']) && $_POST['adper_page'] !='')
	 	    $this->session->set_userdata('pg',$_POST);
	    else
		    $this->data['limit'] = $limit = 10;

	    $pg = $this->session->userdata('pg');

	    if(isset($pg['adper_page'])   && $pg['adper_page']!='')
	    	$this->data['limit']= $limit = $pg['adper_page'];	    

	    if ($this->uri->segment(3) != '')
	    {
		   $page = $this->uri->segment(3);
       	   $start = ($page * $limit)- $limit; 			//first item to display on this page
        }
	    else
		   $start = 0;		    

	   if(isset($_POST['Search']))
	 	   $this->session->set_userdata('post_data',$_POST);				    

	    $post_data = $this->session->userdata('post_data');

		// SEARCH BY LOCATION OR SUGGESSTED NAMES
		$this->data['search_term']='';

		if(isset($post_data['search_term']) && $post_data['search_term'] != ''){
			
			$this->data['search_term']= $v = $post_data['search_term'];			
			$extqry .=" AND (user_name like '%".$v."%' OR user_mname like '%".$v."%' OR user_lname like '%".$v."%' OR user_email like '%".$v."%' OR location like '%".$v."%' OR org_nm like '%".$v."%'  OR address like '%".$v."%')";
		}	
		// ORDER BY ASC/DESC
		$this->data['user_type'] = '';

		if(isset($post_data['user_type']) && $post_data['user_type'] !='')
		{
			$this->data['user_type'] = $user_type = $post_data['user_type'];			
			$extqry .=" AND user_typ = '".$user_type."'";						
		}   

		$this->data['adstatus'] = '';

		if(isset($post_data['adstatus']) &&  $post_data['adstatus'] !='')
		{
			$this->data['adstatus'] = $adstatus =$post_data['adstatus'];			
			$extqry .=" AND status = '".$adstatus."'";						
		}

		if(isset($_GET['action']) && $_GET['action'] =='exportreport')
		{
			$qr = "SELECT user_name,user_email, location,org_nm,address,phone,user_typ,status FROM user_mst WHERE 1 $extqry";
 			$x = $this->db->query($qr)->result_array();

 			$outt= array();
 			$ii=0;

 			$result = array(); 	

 			if(is_array($x) && count($x)>0)
 			{
 				foreach ($x as $k => $xx) {

 					if($xx['status'] == '1')
 						$status = 'Active';
 					else
 						$status = 'Blocked';

 					$k = $k + 1;

	 				$result[$ii]['Slno'] = $k;
	 				$result[$ii]['FullName'] = $xx['user_name'];
	 				$result[$ii]['Email'] = $xx['user_email'];
	 				$result[$ii]['Location'] = $xx['location'];
	 				$result[$ii]['Organization Name'] = $xx['org_nm'];
	 				$result[$ii]['Address'] = $xx['address'];
	 				$result[$ii]['Mobile'] = $xx['phone'];
	 				$result[$ii]['Type'] = $xx['user_typ'];
	 				$result[$ii]['Status'] = $status;

	 				$ii++;
 				}

				$flnm ="Userlist";   
				$this->exportreport($result,$flnm);
			  }
		}

		$q  = "SELECT * FROM user_mst 
								 WHERE 1 $extqry order by id desc LIMIT $start,$limit";
		$this->data['admins']= $admins = $this->db->query($q)->result();
		////----PAGINATION START----////
		
		$d = $this->db->query('SELECT count(*) as num from user_mst WHERE  1 '.$extqry)->row() ;  
		$this->load->library('pagination');
		$config['page_query_string'] = false;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('sadmin/admin_list');
		$config['prefix'] = '';
		$config['suffix'] = ''; 
		$config['num_links'] = 3;
		$config['uri_segment'] = 3;
		$config['offset'] = $limit;
		$config['total_rows'] =  $d->num;
		$config['per_page'] = $limit;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
		$config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';
		$this->pagination->initialize($config);
		////----PAGINATION ENDS----////	
		
		$m='';
		$v=0;
		$j=$start+1; 
		
		if(count($admins)>0){
			foreach($admins as $z){
				$v++;
				if($z->status == 1){
					$vc = '<a class="btn btn-success btn-xs" href="'.base_url("bus/update_status/".$z->id.'/user_mst/2').'" > Active</a> ';				
				}else if($z->status == 2){
					$vc = '<a class="btn btn-maroon btn-xs" href="'.base_url("bus/update_status/".$z->id.'/user_mst/1').'" >Block </a></span>';
					
				}						
				
				$m .= '
				<tr>
					<td class="center">'.$j.'</td>
					<td>'.$z->user_name.'</td>		
					 <td>'.$z->user_typ.'</td>
                     <td>'.$z->org_nm.'</td>
                     <td>'.$z->user_email.'</td>
                     <td>'.$z->location.'</td>
                     <td>'.$z->insert_date.'</td>							
					<td class="center">
						'.$vc.'
					</td>
					<td class="center no-print">
						<a href="'.base_url("sadmin/edit_admin/".$z->id).'" ><i class="fa fa-pencil"></i></a>&nbsp;
						<a href="'.base_url("sadmin/change_pwd/".$z->id).'" class="btn btn-danger btn-xs icon-only white" title="Change Password">
						    <i class="typcn typcn-key-outline"></i>
						</a>
					</td>
				</tr>
				';
			$j++;		
			}
		}else{
			$m = '
				<tr>
					<td colspan="8">No Data Found</td>
				</tr>
			';
		}
		
		//total Records
		# Showing 1 to 10 of 255 entries
		$this->data['total_records'] = $d->num;	
		$this->data['start'] = $start+1;	
		$this->data['page_number'] = $this->uri->segment(4);
		# --- END HERE --- #
		$this->data['meta_title'] = 'Admin :: All Admin';
		$this->data['alldata']=$m;		
		$this->data['activenav']='All Bus Type';		
		$this->data['sub_view']='admin/subview/admin_list';
		$this->load->view('admin/_master',$this->data);
	}


	public function add_admin()
	{
		/*if($_POST)
		{
			$pass = $this->input->post('user_password');
			$data = $this->input->post();
			$data['user_password'] = sha1(md5($pass));
			$data['user_typ'] = $this->input->post('user_typ');
			$data['user_id'] = random_string('alnum', 8);
			$data['rand_key'] = random_string('alnum', 22);
			
			$r = $this->User_m->insert($data);
			if($r)
				$this->session->set_flashdata('success','Admin added Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('sadmin/edit_admin/'.$r),'refresh');
		}*/

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Super Admin :: Add Admin';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('sadmin/dashboard').'">
										  <i class="pe-7s-home"></i> Home
										</a>
									  </li>
									  <li>Admin List</li>
            						  <li class="active">Add Admin</li>';
		
		$this->data['sub_view']='sadmin/subview/add_admin';
		$this->load->view('sadmin/_master',$this->data);
	}


	public function edit_admin($id)
	{
		$this->data['all_data']= $users = $this->User_m->get($id);
		if($_POST)
		{
			$data = $this->input->post();
			$r = $this->User_m->update($id,$data);
			if($r)
				$this->session->set_flashdata('success','Admin updated Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('sadmin/edit_admin/'.$id),'refresh');
		}
		
		$this->data['meta_title'] = 'Admin :: Edit Admin' ;
		$this->data['sub_view']='admin/subview/edit_admin';
		$this->load->view('admin/_master',$this->data);
	 }

	public function agent_list() 
	{	
		$extqry="";

		if(isset($_POST['adper_page']) && $_POST['adper_page'] !='')
	 	    $this->session->set_userdata('pg',$_POST);
	    else
		    $this->data['limit'] = $limit = 10;

	    $pg = $this->session->userdata('pg');

	    if(isset($pg['adper_page'])   && $pg['adper_page']!='')
	    	$this->data['limit']= $limit = $pg['adper_page'];	    

	    if ($this->uri->segment(3) != '')
	    {
		   $page = $this->uri->segment(3);
       	   $start = ($page * $limit)- $limit; 			//first item to display on this page
        }
	    else
		   $start = 0;		    

	   if(isset($_POST['Search']))
	 	   $this->session->set_userdata('post_data',$_POST);				    

	    $post_data = $this->session->userdata('post_data');

		// SEARCH BY LOCATION OR SUGGESSTED NAMES
		$this->data['esearch_term']='';
		if(isset($post_data['esearch_term']) && $post_data['esearch_term'] != ''){
			
			$this->data['esearch_term']= $v = $post_data['esearch_term'];			
			$extqry .=" AND (con_name like '%".$v."%' OR con_email like '%".$v."%' OR con_mobile like '%".$v."%'  OR address like '%".$v."%')";
		}	

		$this->data['adstatus'] = '';
		if(isset($post_data['adstatus']) &&  $post_data['adstatus'] !='')
		{
			$this->data['adstatus'] = $adstatus =$post_data['adstatus'];			
			$extqry .=" AND status = '".$adstatus."'";						
		}		
		
		$q  = "SELECT * FROM conductor 
								 WHERE 1 	
								 AND utype = 'Agent'							
								 $extqry order by con_id desc LIMIT $start,$limit";

		$this->data['admins']= $admins = $this->db->query($q)->result();

		////----PAGINATION START----////
		
		$d = $this->db->query("SELECT count(*) as num from conductor WHERE  1 AND utype = 'Agent'".$extqry)->row() ;  
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('sadmin/admin_list');
		$config['prefix'] = '';
		$config['suffix'] = ''; 
		$config['num_links'] = 3;
		$config['uri_segment'] = 4;
		$config['offset'] = $limit;
		$config['total_rows'] =  $d->num;
		$config['per_page'] = $limit;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#"">';
		$config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';
		$this->pagination->initialize($config);
		////----PAGINATION ENDS----////	
		
		$m='';
		$v=0;
		$j=$start+1; 
		
		if(count($admins)>0){
			foreach($admins as $z){
				$v++;
				if($z->status == 1){
					$vc = '<a class="btn btn-success btn-xs" href="'.base_url("sadmin/update_status/".$z->con_id.'/conductor/0').'" > Active</a>';				
				}else if($z->status == 0){
					$vc = '<a class="btn btn-maroon btn-xs" href="'.base_url("sadmin/update_status/".$z->con_id.'/conductor/1').'" >Block </a></span>';
				}

				$m .= '
				  <tr>
					<td class="tdmiddle">'.$j.'</td>					
			 		<td>'.$z->con_name.'<br>'.$z->con_email.'<br>'.$z->con_mobile.'</td>						 
			 	    <td class="tdmiddle">'.$z->added_on.'</td>							                    
					<td class="tdmiddle">
						'.$vc.'
					</td>
					<td class="tdmiddle no-print">					
						<a title="Click To Edit" href="'.base_url("sadmin/edit_agent/".$z->con_id).'"><i class="fa fa-pencil"></i></a>&nbsp;
						<a title="Change Password" href="'.base_url("sadmin/change_pwd/".$z->con_id).'" class="btn btn-danger btn-xs icon-only white" title="Change Password">
						    <i class="fa fa-key"></i>
						</a>
					</td>
				</tr>
				';
			$j++;		
			}
		}else{
			$m = '<tr>
					<td colspan="8">No Data Found</td>
				  </tr>';
		}		
		//total Records
		# Showing 1 to 10 of 255 entries
		$this->data['total_records'] = $d->num;	
		$this->data['start'] = $start+1;	
		$this->data['page_number'] = $this->uri->segment(4);

		# --- END HERE --- #
		$this->data['alldata']=$m;	
		$this->data['meta_title']= ':: All Employees';	

		$this->data['activenav']='All Bus Type';
		$this->data['sub_view']='admin/subview/agent_list';
		$this->load->view('admin/_master',$this->data);
	}

	public function update_status()
	{	
		$id = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$data['status']  = $this->uri->segment(5);
 		$url= $_SERVER['HTTP_REFERER']; 	
		$r = $this->Conductor_m->change_status($id,$table,$data);
		if($r == 1){			
			$this->session->set_flashdata('success','Record inactive Successfully');
			redirect($url,'refresh');
		}else{			
			$this->session->set_flashdata('error','Error in rocessing request');
			redirect($url,'refresh');
		}		
	}	

	public function add_agent()
	{
		if($_POST)
		{
			$pass = $this->input->post('con_pass');
			$data = $_POST;
			$data['con_pass'] = sha1(md5($pass));
			$data['added_on'] = date('Y-m-d H:i:s');

			$r = $this->Agent_m->insert($data);

			if($r)
				$this->session->set_flashdata('success','Agent added Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('sadmin/edit_agent/'.$r),'refresh');
		}
		$this->data['meta_title']= 'Admin :: Add Agent';	
		$this->data['sub_view'] = 'admin/subview/add_agent';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_agent($id)
	{

		$this->data['all_data'] = $users = $this->Agent_m->get($id);
		if($_POST)
		{		
			#print_result($_POST); exit;	
			$data = $_POST;
			$r = $this->Agent_m->update($id,$data);
			if($r)
				$this->session->set_flashdata('success','Agent updated successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('sadmin/edit_agent/'.$id),'refresh');
		}
		$this->data['meta_title']= 'Admin :: Edit Agent';	
		$this->data['sub_view']='admin/subview/edit_agent';
		$this->load->view('admin/_master',$this->data);
	}

	public function change_pwd($id)
	{
		$this->data['all_data']= $users = $this->User_m->get($id);		
		if($_POST)
		{			
			$pass = sha1(md5($_POST['user_password']));	
			$data['user_password'] = $pass;			
			$r = $this->User_m->update($id,$data);
			if($r){			
				$email = 'chakra.seoinfotechsolution@gmail.com';
				$sub = 'Password Changed - '.$email.'[ '.$users->user_typ.' ]';
				$msg = nl2br(
						'Dear Admin
						 Password has been changed of following user
						 Name : '.$users->user_typ.'
						 Email: '.$users->user_email.'
						 Type:  '.$users->user_typ.'
					');
				$this->load->model('Email_m');
				$this->Email_m->sendemail($email,$sub,$msg);
				$this->session->set_flashdata('success','Admin updated Successfully');
			}else{
				$this->session->set_flashdata('error','Error in processing request');
			}
			redirect(base_url('sadmin/edit_admin/'.$id),'refresh');
		}
		
		$this->data['meta_title'] = 'Admin :: Change Password';
		$this->data['sub_view']='admin/subview/ad_change_pwd';
		$this->load->view('admin/_master',$this->data);
	}
		
	public function operator_list()
	{
		$this->data['admins']= $admins = $this->User_m->get_many_by(array('status'=>1,'user_typ'=>'Operater'));
		$this->data['sub_view']='admin/subview/operator_list';
		$this->load->view('admin/_master',$this->data);
	}


	public function add_operator()
	{
		if($_POST)
		{
			$pass = $this->input->post('user_password');			
			$data['user_password']=md5($pass);
			$data['user_typ']='Operater';
			$data['user_id']=random_string('alnum', 8);
			$data['rand_key']=random_string('alnum', 22);
			
			$r = $this->User_m->insert($data);
			if($r)
				$this->session->set_flashdata('success','Operater added Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('sadmin/operator_list'),'refresh');
		}
		
		$this->data['sub_view']='admin/subview/add_operator';
		$this->load->view('admin/_master',$this->data);
	}
	
	
	public function searchMyArray($in_key,$out_key, $array,$sml_arr) {
		   
		   $out='';
		   if(count($sml_arr)>0  && (count($array)>0) ){
		   		foreach ($array as $key => $val) {
					   if (in_array($val->$in_key, $sml_arr)){
						   $out .=$val->$out_key.',';
					   }
				}
		   }
		   
		   $out=rtrim($out,",");
		   return $out;
	}
	
	
	public function activatebus($id){
		$bak=$_SERVER['HTTP_REFERER'];
		
		$datak['status']= 3;
		$r = $this->Bus_m->update($id,$datak);
		if($r){
				$smsg= "Data Updated Successfully";
				$typ='success';
		}else{
			$smsg= "Error Occurs While processing request";
			$typ='error';
		}
		$this->session->set_flashdata($typ,$smsg);
		redirect($bak);
	}

	public function suspendbus($id){
		$bak=$_SERVER['HTTP_REFERER'];
		
		$datak['status']= 0;
		$r = $this->Bus_m->update($id,$datak);
		if($r){
				$smsg= "Data Updated Successfully";
				$typ='success';
		}else{
			$smsg= "Error Occurs While processing request";
			$typ='error';
		}

		$this->session->set_flashdata($typ,$smsg);
		redirect($bak);
	}

	public function buslistclr()
	{
		
		$cur_url = $_SERVER['HTTP_REFERER']; 
		$url = explode('/',$cur_url);
		$end = end($url);

		$int = is_numeric($end);

		if($int == 1 && $int !='')
		{
			array_pop($url);
			$final_url = implode('/', $url); 
		}
		else
			$final_url = $cur_url;

		redirect($final_url);
	/*	unset($_SESSION['pg']);
		unset($_SESSION['src']);
		redirect(base_url('sadmin/buslist'));*/
	}

	
	public function buslist()
	{
		$board_drop=$this->db->query('select id, name from bus_brding_drping')->result();
		$perpg=10;
		if(isset($_POST['pagelimit'])   && $_POST['pagelimit']!='')
			$this->session->set_userdata('pg',$_POST);

		$pg = $this->session->userdata('pg');

		if(isset($pg['pagelimit'])   && $pg['pagelimit']!='')
			$this->data['pagelimit']= $perpg =$pg['pagelimit'];
		
		if(isset($_POST['search']))
			$this->session->set_userdata('src',$_POST);			
		
		if(isset($_GET['per_page']))
			$offset = $_GET['per_page'];
		else
			$offset =0;
		

		$this->data['offset']=$offset;
		$amn = $this->Busamenities_m->get_all();
		$extqry='';
		
		$srch_data = $this->session->userdata('src');
		if(isset($srch_data)){
						
			 
			if(isset($srch_data['Source']) && $srch_data['Source']!=''){
				$this->data['Source']=$Source = $srch_data['Source'];
				$sc= $srch_data['Source'];
				$extqry .=' AND bus_id in(SELECT bus_id FROM bus_stoppage where from_id='.$sc.')';
				
			}

			if(isset($srch_data['Destination'])  && $srch_data['Destination']!=''){
				$this->data['Destination']=$Destination = $srch_data['Destination'];
				$dst= $srch_data['Destination'];
				$extqry .=' AND bus_id in(SELECT bus_id FROM `bus_stoppage` where  to_id='.$dst.')';
			}
			
			if(isset($srch_data['opr'])){
				$this->data['opr']=$opr = $srch_data['opr'];
				if(count($opr)>0){
					$dd = implode('", "',$opr);
					$extqry .=' AND opr_id in ("'.$dd.'") ';
				}
			}

			if(isset($srch_data['bustypz'])  && $srch_data['bustypz']!=''){
				$this->data['bustypz']= $bustypz = $srch_data['bustypz'];
				$extqry .=' AND bus_type ='.$bustypz.' ';
			}

			if(isset($srch_data['stng_typ'])  && $srch_data['stng_typ']!=''){
				$this->data['stng_typ']= $stng_typ = $srch_data['stng_typ'];
				$extqry .=' AND sitting_type ='.$stng_typ.' ';
			}

			if(isset($srch_data['bstypes'])  && $srch_data['bstypes']!=''){
				$this->data['bstypes']= $bstypes = $srch_data['bstypes'];
				$extqry .=' AND status ='.$bstypes.' ';
			}
		}
		$limitq='   LIMIT '.$offset.', '.$perpg;
		$logs = $this->db->query('
			SELECT 
			b.* , 
			bs.id as bus_stoppage_id, 
			bs.status as bus_stoppage_status, 
			bs.from_id, bs.to_id, bs.dep_time, bs.arr_time, bs.seat_fare, 
			bs.sleeper_fare, bs.brd_pts_tm, bs.drp_pts_tm,
			u.user_id, u.user_name, u.user_lname, u.org_nm,
			um.user_name as um_user_name,
			um.user_lname as um_user_lname,
			(SELECT location_nm from bus_location bl WHERE bl.id = bs.from_id) as from_loc,	
			(SELECT location_nm from bus_location bl WHERE bl.id = bs.to_id) as to_loc,	
			(select bt.bus_type from bus_type bt where bt.id = b.bus_type ) as v_bus_type,
			(select bs.sitting_type from bus_sitting bs where bs.id = b.sitting_type ) as v_sitting_type,
			cond_mob, cnd_send, cond_csend, mngr_mob, mngr_send, mngr_csend, ownr_mob, ownr_send, ownr_csend	
		
			FROM ((select * from bus_master WHERE 1 '.$extqry.'  ORDER BY bus_id desc   '.$limitq.') b)
			LEFT JOIN  bus_stoppage bs ON b.bus_id = bs.bus_id
			LEFT JOIN  user_mst u  ON b.opr_id = u.user_id
			LEFT JOIN  user_mst um  ON b.added_by = um.user_id
			LEFT JOIN bus_contact_info bci on b.bus_id = bci.bus_id
			
			ORDER BY b.bus_id desc, bus_stoppage_id ASC
			
			')->result();
		

		////
		////----PAGINATION START----////
		$q='select count(bus_id) as num from bus_master WHERE 1 '.$extqry;		
		$d = $this->db->query($q)->row();
		$totrow=$d->num;		
		$this->load->library('pagination');
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url('sadmin/buslist/');
		$config['num_links'] = 5;
		$config['offset'] = $offset;
		$config['total_rows'] = $totrow;
		$config['per_page'] = $perpg;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
		$config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';
		$this->pagination->initialize($config);
		////----PAGINATION ENDS----////
		////////////////////////// GROUPING OF ARRAY By A key
		$tmp = array();
		foreach($logs as $arg)
		{
			$tmp[$arg->bus_id]['bus_id'] = $arg->bus_id;
			$tmp[$arg->bus_id]['opr_id'] = $arg->opr_id;
			$tmp[$arg->bus_id]['bus_name'] = $arg->bus_name;
			$tmp[$arg->bus_id]['via'] = $arg->via;
			$tmp[$arg->bus_id]['bus_number'] = $arg->bus_number;
			$tmp[$arg->bus_id]['bus_type'] = $arg->bus_type;
			$tmp[$arg->bus_id]['amenities'] = $arg->amenities;
			$tmp[$arg->bus_id]['sitting_type'] = $arg->sitting_type;			
			$tmp[$arg->bus_id]['seat_layout_id'] = $arg->seat_layout_id;
			$tmp[$arg->bus_id]['seater_seats'] = $arg->seater_seats;
			$tmp[$arg->bus_id]['sleeper_seats'] = $arg->sleeper_seats;
			$tmp[$arg->bus_id]['status'] = $arg->status;
			$tmp[$arg->bus_id]['v_bus_type'] = $arg->v_bus_type;
			$tmp[$arg->bus_id]['v_sitting_type'] = $arg->v_sitting_type;
			$tmp[$arg->bus_id]['user_id'] = $arg->user_id;
			$tmp[$arg->bus_id]['user_name'] = $arg->user_name;
			$tmp[$arg->bus_id]['user_lname'] = $arg->user_lname;
			$tmp[$arg->bus_id]['um_user_name'] = $arg->um_user_name;
			$tmp[$arg->bus_id]['um_user_lname'] = $arg->um_user_lname;
			$tmp[$arg->bus_id]['added_on'] = $arg->added_on;
			$tmp[$arg->bus_id]['org_nm'] = $arg->org_nm;
			$tmp[$arg->bus_id]['cond_mob'] = $arg->cond_mob;
			$tmp[$arg->bus_id]['cnd_send'] = $arg->cnd_send;
			$tmp[$arg->bus_id]['cond_csend'] = $arg->cond_csend;
			$tmp[$arg->bus_id]['mngr_mob'] = $arg->mngr_mob;
			$tmp[$arg->bus_id]['mngr_send'] = $arg->mngr_send;
			$tmp[$arg->bus_id]['mngr_csend'] = $arg->mngr_csend;
			$tmp[$arg->bus_id]['ownr_mob'] = $arg->ownr_mob;
			$tmp[$arg->bus_id]['ownr_send'] = $arg->ownr_send;
			$tmp[$arg->bus_id]['ownr_csend'] = $arg->ownr_csend;
			if($arg->amenities!=''  || $arg->amenities!=NULL){
				$am = unserialize($arg->amenities);
				$tmp[$arg->bus_id]['am_txt'] = $this->searchMyArray('id','amenities',$amn,$am);
			}else
				$tmp[$arg->bus_id]['am_txt'] = '';
			
			$tmp[$arg->bus_id]['from'][] = $arg->from_id;
			$tmp[$arg->bus_id]['to'][] = $arg->to_id;
			$tmp[$arg->bus_id]['dep_time'][] = $arg->dep_time;
			$tmp[$arg->bus_id]['arr_time'][] = $arg->arr_time;
			$tmp[$arg->bus_id]['seat_fare'][] = $arg->seat_fare;
			$tmp[$arg->bus_id]['sleeper_fare'][] = $arg->sleeper_fare;			
			$tmp[$arg->bus_id]['bus_stoppage_id'][] = $arg->bus_stoppage_id;
			$tmp[$arg->bus_id]['bus_stoppage_status'][] = $arg->bus_stoppage_status;			
			$tmp[$arg->bus_id]['from_loc'][] = $arg->from_loc;
			$tmp[$arg->bus_id]['to_loc'][] = $arg->to_loc;
			$tmp[$arg->bus_id]['brd_pts_tm'][] = $arg->brd_pts_tm;
			$tmp[$arg->bus_id]['drp_pts_tm'][] = $arg->drp_pts_tm;
					////////////////////////////////////////
						if($arg->brd_pts_tm){
							$b=unserialize($arg->brd_pts_tm);
							$b_x = $b['pointn'];
							$ix=0;
							foreach($b_x as $px){
								$outxx='';
								foreach($board_drop as $bdp){
									if($bdp->id==$px){
										$outxx = $bdp->name;
									}
								}
								$b['pointn'][$ix]=$outxx;
								$ix++;
							}
						}else{
							$b=NULL;
						}
						
					////////////////////////////////////////
						if($arg->drp_pts_tm){
							$d=unserialize($arg->drp_pts_tm);						
							$d_x = $d['pointn'];
							$iy=0;
							foreach($d_x as $px){
								$outxx='';
								foreach($board_drop as $bdp){
									if($bdp->id==$px){
										$outxx = $bdp->name;
									}
								}
								$d['pointn'][$iy]=$outxx;
								$iy++;
							}
						}else{
							$d=NULL;
						}
						
						
					////////////////////////////////////////
			$tmp[$arg->bus_id]['brd_pts_tm_out'][] = $b;
			$tmp[$arg->bus_id]['drp_pts_tm_out'][] = $d;
		}
		////////////////////////// GROUPING OF ARRAY By A key--ends

		//total Records
		# Showing 1 to 10 of 255 entries
		$this->data['total_records'] = $totrow;	
		#$this->data['start'] = $start+1;	
		$this->data['page_number'] = $this->uri->segment(3);
		
		$this->data['allbus']= $tmp;
		
		$this->db->order_by('org_nm','asc');
		$this->data['operater']=$this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->data['bustyp']= $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
		$this->data['busSeatTyp']= $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
		$this->data['amenity']= $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout']=  $this->SeatLayout_m->get_many_by(array( 'status'=>1));
	//	$this->db->order_by('location_nm','asc');
		$this->data['location']=  $location=  $this->Location_m->get_many_by(array( 'status'=>3));	
		$this->data['meta_title'] = 'Bus :: Bus List';
		$this->data['sub_view']='admin/subview/bus/buslist';
		$this->load->view('admin/_master',$this->data);
	}

	public function buslist_o()
	{		
		$amn = $this->Busamenities_m->get_all();		
		$extqry='';
		if($_POST){
			$this->data['Source']=$Source = $_POST['Source'];
			$this->data['Destination']=$Destination = $_POST['Destination'];
			
			if(isset($_POST['opr'])){
				$this->data['opr']=$opr = $_POST['opr'];
				if(count($opr)>0){
					$dd = implode('", "',$opr);
					$extqry .=' AND opr_id in ("'.$dd.'") ';
				}
			}
			if(isset($_POST['bustypz'])  && $_POST['bustypz']!=''){
				$this->data['bustypz']= $bustypz = $_POST['bustypz'];
				$extqry .=' AND bus_type ='.$bustypz.' ';
			}
			if(isset($_POST['stng_typ'])  && $_POST['stng_typ']!=''){
				$this->data['stng_typ']= $stng_typ = $_POST['stng_typ'];
				$extqry .=' AND sitting_type ='.$stng_typ.' ';
			}
			if(isset($_POST['ament'])  && $_POST['ament']!=''){
				$this->data['ament']= $ament = $_POST['ament'];
			}
		}
		$allbus = $this->db->query('
		SELECT 
		b.* , 
		(select bt.bus_type from bus_type bt where bt.id = b.bus_type ) as v_bus_type,
		(select bs.sitting_type from bus_sitting bs where bs.id = b.sitting_type ) as v_sitting_type,
		u.user_name, u.user_lname, u.org_nm,
		cond_mob, cnd_send, cond_csend, mngr_mob, mngr_send, mngr_csend, ownr_mob, ownr_send, ownr_csend
		
		from bus_master b 
		LEFT JOIN user_mst u on b.opr_id = u.user_id
		LEFT JOIN bus_contact_info bci on b.bus_id = bci.bus_id
		where 1 '.$extqry.'
		ORDER BY b.bus_id desc
		')->result();
		
		
		$out=array();
		$t=0;
		foreach($allbus as $a){
			///////////////////////////////
			$extqn='';
			if(isset($_POST['Source'])   && $_POST['Source']!=''){
				$sc= $_POST['Source'];
				$extqn=' AND from_id='.$sc;
			}
			if(isset($_POST['Destination'])  && $_POST['Destination']!=''){
				$dst= $_POST['Destination'];
				$extqn=' AND to_id='.$dst;
			}
			//////////////////////////////////////
			$out[$t]= $a;
			if($a->amenities!='')
				$am = unserialize($a->amenities);
			else
				$am='';
			
			/////////////////////////
			if(isset($_POST['ament'])  && $_POST['ament']!=''){
				
			}
			///////////////////
			$vv='';
			if($am!=''  || $am!=NULL)
				$vv = $this->searchMyArray('id','amenities',$amn,$am);			
			
			$out[$t]->am_txt=$vv;			
			
			$b_id=$a->bus_id;
			$df = $this->db->query('SELECT bs.*,
				(select location_nm from bus_location bl where bl.id=bs.from_id) as from_loc,
				(select location_nm from bus_location bl where bl.id=bs.to_id) as to_loc
			from bus_stoppage bs  
			where bs.bus_id = '.$b_id.' '.$extqn)->result();
			$out[$t]->stoppages=$df;
			
			
			///////////////////////////////
			if( isset($_POST['Source'])  ||  isset($_POST['Destination'])   ){
				if(count($df)>0){
				}else{
					unset($out[$t]);
				}
			}
			if(isset($_POST['ament'])  && $_POST['ament']!=''){
				$ament = $_POST['ament'];
				
				if($am!=''){
					$ar_intersect= array_intersect($ament, $am);
					if($ament == $ar_intersect){
					}else{
						unset($out[$t]); 
					}
				}else{
					unset($out[$t]);
				}
			}
			//////////////////////////////////////
			$t++;
		}
		
		$this->data['allbus']= $out;
		
		$this->data['operater']=$this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->data['bustyp']= $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
		$this->data['busSeatTyp']= $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
		$this->data['amenity']= $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout']=  $this->SeatLayout_m->get_many_by(array( 'status'=>1));
		$this->data['location']=  $location=  $this->Location_m->get_many_by(array( 'status'=>3));		
		
		$this->data['sub_view']='admin/subview/bus/buslist';
		$this->load->view('admin/_master',$this->data);
	}

	public function filllayout($id,$showchk=NULL,$selected=NULL)
	{
		if($showchk=='ttt'){
			
			$st = $this->session->userdata('seater_seats');
			$slp = $this->session->userdata('sleeper_seats');			
			echo draw_seat_layout_checkbox($id,$st,$slp,$selected);   
		}else
			echo draw_seat_layout_checkbox($id);
		
	}

	public function filllayoute($id,$showchk=NULL,$selected=NULL)
	{
		if($showchk=='ttt'){

			$st = $this->session->userdata('seater_seats');
			$ad_st = $this->session->userdata('ad_seater_seats');
			$slp = $this->session->userdata('sleeper_seats');
			$ad_slp = $this->session->userdata('ad_sleeper_seats');

			///////////////////////////////////// 
			if($st!='' || $st!=NULL)
				$st = $st;
			else
				$st = array();			

			if($ad_st!='' || $ad_st!=NULL)
				$ad_st = $ad_st;
			else
				$ad_st = array();

			if($slp!='' || $slp!=NULL)
				$slp = $slp;
			else
				$slp = array();			

			if($ad_slp!='' || $ad_slp!=NULL)
				$ad_slp = $ad_slp;
			else
				$ad_slp = array();
			
			$myst = array_merge($st,$ad_st);
			$myslp = array_merge($slp,$ad_slp);
			echo draw_seat_layout_checkbox($id,$myst,$myslp,$selected); 

			////////////////////////////			
			//echo draw_seat_layout_checkboxe($id,$st,$slp,$ad_st,$ad_slp,$selected);   
		}else
			echo draw_seat_layout_checkbox($id);
		
	}

	public function locationdrop()
	{
		$this->db->order_by('location_nm','asc');
		$location=  $this->Location_m->get_many_by(array( 'status'=>3));
		
		$m='';
		foreach($location as $l){
			$m .='<option value="'.$l->id.'">'.$l->location_nm.'</option>';
		}
		
		echo $m;
	}

	public function getpoint()
	{
		$ct= $_POST['ct'];
		$typ= $_POST['typ'];
		$selected= $_POST['selected'];		
		
		$points=  $this->Busaboarding_m->get_many_by(array( 'type'=>$typ,'city_id'=>$ct));
		
		if($selected!=''){
			$board= $selected;
			$x = explode('[[~~]]',$board);
			$p = $x[0];
			$t = $x[1];
			$dm['pointn'] =$pp = explode(',',$p);
			$dm['time']= $tt =explode(',',$t);
						
			$point_out = implode(',',$pp);
		}else{
			$point_out ='';
			$dm['pointn'] =array();
			$dm['time']= array();
		}		
		
		$m='';
		if(count($points)>0){
			foreach($points as $l){
				 
				$sel='';
				$tim='';
				$keys='';
				
				if (in_array($l->id, $dm['pointn']))
				{
					$keys = array_search($l->id,$dm['pointn']);
					$sel='checked';
					
					if(isset($dm['time'][$keys])){
						$tim = $dm['time'][$keys];
					}
				}			
				
				$m .='<div class="row">
                         <div class="col-sm-2">&nbsp;</div>
						  <div class="checkbox col-sm-4 left">                          
							<label><input class="colored-danger" value="'.$l->id.'"  '.$sel.'   name="points"   type="checkbox"><span class="text">'.$l->name.'</span></label>
						  </div>
                         <div class="col-sm-2 right"><input class="form-control timepicker input-xs stime"  value="'.$tim.'"  type="text"></div> 
                      </div>
                     ';
			}
		}		
		echo $m;		
	}	
	
	public function board_drop_time_array($arr)
	{
		$board= $arr;
		$x = explode('[[~~]]',$board);
		$p = $x[0];
		$t = $x[1];
		$dm['pointn'] = explode(',',$p);
		$dm['time']= explode(',',$t);
		
		$dm= serialize($dm);
		return $dm;
	}

	public function reverse_board_drop_time_array($data)
	{
		$ddm = unserialize($data);
		
		$dm='';
		if(count($ddm['pointn'])>0){
			$a= implode(',',$ddm['pointn']);
			$b= implode(',',$ddm['time']);
			$dm=$a.'[[~~]]'.$b; 
		}
		return $dm;   
	}

	public function stoppage_sts_chng()
	{
		$myid = $_POST['id'];
		$info= $this->BusStoppage_m->get($myid);
		if($info->status=='3')
			$st=0;
		else
			$st=3;
		
		$datai['status']=$st;
		$r = $this->BusStoppage_m->update($myid,$datai);
		if($r)
			echo  $st;
		else
			echo 'NA';			
	}
	
	public function bus_return($id)
	{
		$this->data['info']= $infom = $this->Bus_m->get($id);
		$sli = $infom->seat_layout_id; 
		$st_s= $infom->seater_seats;    
		$sl_s= $infom->sleeper_seats; 
		$bs_id= $infom->bus_id;
		$this->data['c_info']=  $this->BusContactInfo_m->get_by(array('bus_id'=>$id));
		//////////
		//$s_info = $this->BusStoppage_m->get_many_by(array('bus_id'=>$id));
		$s_info = $this->db->query('select * from bus_stoppage where bus_id ='.$id.'   ORDER BY id ASC')->result();
		$i_out=array();
		$i=0;
		foreach($s_info as $inf){
			$i_out[$i]=$inf;
			$i_out[$i]->brd_loc_tim =$this->reverse_board_drop_time_array($inf->brd_pts_tm);
			$i_out[$i]->drp_loc_tim =$this->reverse_board_drop_time_array($inf->drp_pts_tm);
			
			$i++;
		}		
		$this->data['s_info']= $i_out;
		//////////////////////////////
		if($_POST)
		{
			$dd = $this->input->post();
			$bus = 	$dd['bus_number'];
			if($bus!=''){	
				$data['opr_id']= $dd['opr_id'];
				$data['bus_name']= $dd['bus_name'];
				$data['via']= $dd['via'];
				$data['bus_type']= $dd['bus_type'];
				$data['sitting_type']= $dd['sitting_type'];				
				
				if(isset($dd['amenities'])){
					$data['amenities']= serialize($dd['amenities']);
				}
				$data['bus_number']= $bus;				
				$data['seat_layout_id']= $sli;
				//---------
				
				$data['seater_seats']= $st_s;    
				$data['sleeper_seats']= $sl_s; 
				//-------------
				$data['status']= 3;
				$data['added_on']= date('Y-m-d H:i:s');
				$data['added_by']= $this->session->userdata('user_id');
				$data['has_return_bus']= 1;
				$data['return_bus_id']= $bs_id;
				$r = $this->Bus_m->insert($data);
				
				if($r)
				{
					$dataf['has_return_bus']= 1;
					$dataf['return_bus_id']= $r;					
					$rvx = $this->Bus_m->update($bs_id,$dataf);
					$datal['bus_id']= $r;
					$datal['cond_mob']= (isset($dd['cond_mob'] ))?$dd['cond_mob'] :0;
					$datal['cnd_send']= (isset($dd['cnd_send'] ))?$dd['cnd_send'] :0;
					$datal['cond_csend']= (isset($dd['cond_csend'] ))?$dd['cond_csend'] :0;				
					$datal['mngr_mob']= (isset($dd['mngr_mob'] ))?$dd['mngr_mob'] :0;
					$datal['mngr_send']= (isset($dd['mngr_send'] ))?$dd['mngr_send'] :0;
					$datal['mngr_csend']= (isset($dd['mngr_csend'] ))?$dd['mngr_csend'] :0;				
					$datal['ownr_mob']= (isset($dd['ownr_mob'] ))?$dd['ownr_mob'] :0;
					$datal['ownr_send']= (isset($dd['ownr_send'] ))?$dd['ownr_send'] :0;
					$datal['ownr_csend']= (isset($dd['ownr_csend'] ))?$dd['ownr_csend']:0;
					$datal['added_on']= date('Y-m-d H:i:s');
					$datal['added_by']= $this->session->userdata('user_id');				
					
					$rl = $this->BusContactInfo_m->insert($datal);
					///////////////////////
					
					$frm = $dd['from_id'];
					$cn =0;					

					foreach($frm as $f)
					{
						$datasp['bus_id']= $r;
						$datasp['from_id']= $f;
						$datasp['to_id']= $dd['to_id'][$cn];
						$board= $dd['from_points'][$cn];
						$drop= $dd['to_points'][$cn];

						if(isset($board)&& $board!='')
							$datasp['brd_pts_tm']= $this->board_drop_time_array($board);
						
						if(isset($drop)&& $drop!='')
							$datasp['drp_pts_tm']= $this->board_drop_time_array($drop);						
						
						$datasp['dep_time']= $dd['dep_time'][$cn];
						$datasp['arr_time']= $dd['arr_time'][$cn];
						$datasp['seat_fare']= $dd['seat_fare'][$cn];
						$datasp['sleeper_fare']= $dd['sleeper_fare'][$cn];	
						$datasp['status']= 3;
						$datasp['added_on']= date('Y-m-d H:i:s');
						$datasp['added_by']= $this->session->userdata('user_id');
						$datasp['j_day']= $dd['j_day'][$cn];
						$rsp = $this->BusStoppage_m->insert($datasp);
						$cn++;
					}
				}
				
			}  /*///-- incondition ends $bus!=''*/
			
			////////////////////////////////////////////
						$smsg= "Data Updated Successfully";
						$typ='success';
						$this->session->set_flashdata($typ,$smsg);
						redirect(base_url("sadmin/buslist/"));
			/////////////////
			
		} 
		
		$this->data['operater']=$this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->data['bustyp']= $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
		$this->data['busSeatTyp']= $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
		$this->data['amenity']= $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout']=  $this->SeatLayout_m->get_many_by(array( 'status'=>1));
		$this->data['location']=  $location=  $this->Location_m->get_many_by(array( 'status'=>3));	
		$this->data['meta_title'] = 'Bus :: Clone Bus';
		$this->data['sub_view']='admin/subview/bus/bus_return';
		$this->load->view('admin/_master',$this->data);
	}

	public function bus_copy($id)
	{
		#print_result($_SESSION);  exit;

		$this->data['info'] = $infom = $this->Bus_m->get($id);
		$sli = $infom->seat_layout_id; 
		$st_s = $infom->seater_seats;    
		$sl_s = $infom->sleeper_seats; 
		$bs_id = $infom->bus_id;
		$this->data['c_info'] = $this->BusContactInfo_m->get_by(array('bus_id'=>$id));
		//////////
		//$s_info = $this->BusStoppage_m->get_many_by(array('bus_id'=>$id));
		$s_info = $this->db->query('select * from bus_stoppage where bus_id ='.$id.'   ORDER BY id ASC')->result();
		$i_out=array();
		$i=0;

		#----------------------------------------------------------#
			$dm['seater_seats'] = unserialize($infom->seater_seats);
			$dm['sleeper_seats'] = unserialize($infom->sleeper_seats);
			$this->session->set_userdata($dm);
		#------------------------------------- #

		$infob = $this->db->query('select * from bus_stoppage where bus_id ='.$id.'   ORDER BY id ASC')->result();
		$i_out=array();
		$i=0;
		foreach($infob as $inf){
			$i_out[$i] = $inf;
			$i_out[$i]->brd_loc_tim = $this->reverse_board_drop_time_array($inf->brd_pts_tm);
			$i_out[$i]->drp_loc_tim = $this->reverse_board_drop_time_array($inf->drp_pts_tm);
			
			$i++;
		}		
		$this->data['infob'] = $i_out;	
		
		//////////////////////////////
		if($_POST)
		{
			#print_result($_POST); exit;

			$dd = $this->input->post();
			$bus = 	$dd['bus_number'];
			if($bus!=''){	
				$data['opr_id'] = $dd['opr_id'];
				$data['bus_name'] = $dd['bus_name'];
				$data['via'] = $dd['via'];
				$data['bus_type'] = $dd['bus_type'];
				$data['sitting_type'] = $dd['sitting_type'];				
				
				if(isset($dd['amenities'])){
					$data['amenities'] = serialize($dd['amenities']);
				}
				$data['bus_number'] = $bus;				
				$data['seat_layout_id'] = $sli;
				//---------
				
				$data['seater_seats'] = $st_s;    
				$data['sleeper_seats'] = $sl_s; 
				//-------------
				$data['status'] = 3;
				$data['added_on'] = date('Y-m-d H:i:s');
				$data['added_by'] = $this->session->userdata('user_id');
				$data['has_return_bus'] = 1;
				$data['return_bus_id'] = $bs_id;
				$r = $this->Bus_m->insert($data);
				
				if($r)
				{					
					$datal['bus_id'] = $r;
					$datal['cond_mob'] = (isset($dd['cond_mob'] ))?$dd['cond_mob'] :0;
					$datal['cnd_send'] = (isset($dd['cnd_send'] ))?$dd['cnd_send'] :0;
					$datal['cond_csend'] = (isset($dd['cond_csend'] ))?$dd['cond_csend'] :0;
					$datal['mngr_mob'] = (isset($dd['mngr_mob'] ))?$dd['mngr_mob'] :0;
					$datal['mngr_send'] = (isset($dd['mngr_send'] ))?$dd['mngr_send'] :0;
					$datal['mngr_csend'] = (isset($dd['mngr_csend'] ))?$dd['mngr_csend'] :0;
					$datal['ownr_mob'] = (isset($dd['ownr_mob'] ))?$dd['ownr_mob'] :0;
					$datal['ownr_send'] = (isset($dd['ownr_send'] ))?$dd['ownr_send'] :0;
					$datal['ownr_csend'] = (isset($dd['ownr_csend'] ))?$dd['ownr_csend']:0;
					$datal['added_on'] = date('Y-m-d H:i:s');
					$datal['added_by'] = $this->session->userdata('user_id');
					$rl = $this->BusContactInfo_m->insert($datal);
					///////////////////////
					
					$frm = $dd['from_id'];
					$cn = 0;					

					foreach($frm as $f)
					{
						$datasp['bus_id'] = $r;
						$datasp['from_id'] = $f;
						$datasp['to_id'] = $dd['to_id'][$cn];
						$board = $dd['from_points'][$cn];
						$drop = $dd['to_points'][$cn];

						if(isset($board)&& $board!='')
							$datasp['brd_pts_tm'] = $this->board_drop_time_array($board);
						
						if(isset($drop)&& $drop!='')
							$datasp['drp_pts_tm'] = $this->board_drop_time_array($drop);
						
						$datasp['dep_time'] = $dd['dep_time'][$cn];
						$datasp['arr_time'] = $dd['arr_time'][$cn];
						$datasp['seat_fare'] = $dd['seat_fare'][$cn];
						$datasp['sleeper_fare'] = $dd['sleeper_fare'][$cn];	
						$datasp['status'] = 3;
						$datasp['added_on'] = date('Y-m-d H:i:s');
						$datasp['added_by'] = $this->session->userdata('user_id');
						$datasp['j_day'] = $dd['j_day'][$cn];
						$rsp = $this->BusStoppage_m->insert($datasp);
						$cn++;
					}
				}
				
			}  /*///-- incondition ends $bus!=''*/
			
			////////////////////////////////////////////
						$smsg = "Data Updated Successfully";
						$typ = 'success';
						$this->session->set_flashdata($typ,$smsg);
						redirect(base_url("sadmin/buslist/"));
			/////////////////
			
		} 
		
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->data['bustyp'] = $bustyp = $this->Bustype_m->get_many_by(array('status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array('status'=>3));
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array('status'=>3));
		$this->data['slout'] = $this->SeatLayout_m->get_many_by(array('status'=>1));		
		$this->data['location'] =  $location = $this->Location_m->get_many_by(array('status'=>3));
		$this->data['meta_title'] = 'Bus :: Copy Bus';
		$this->data['sub_view'] = 'admin/subview/bus/bus_copy';
		$this->load->view('admin/_master',$this->data);
	}
	public function bus_seat_fare_edit($id)
	{
		$this->data['info']= $info = $this->Bus_m->get($id);
		$q = $this->db->query("SELECT S.id,M.seater_seats,M.sleeper_seats,S.seat_fare,
									  S.sleeper_fare,S.from_id,S.to_id,M.bus_id,S.add_str_fare,S.add_slpr_fare,
								(SELECT location_nm FROM bus_location WHERE id = S.`from_id`) AS src,
								(SELECT location_nm FROM bus_location WHERE id = S.to_id ) AS dest 
								FROM (( SELECT * FROM bus_master ) AS  M)
								INNER JOIN bus_stoppage S
								ON S.bus_id = M.bus_id
								AND  M.bus_id = $id  ORDER BY S.id ASC
								")->result();
		
		$this->data['table_data'] =  $table_data = $q;
		
		if($_POST)
		{
			$out = $this->input->post();			
			$bst = $this->BusStoppage_m->get_many_by(array('bus_id'=>$id));
			$m = 0;
			foreach($bst as $b){
				$niddle = $b->from_id.'-'.$b->to_id.'-';
				
				$tbl_inp[$m]['bus_stoppage_id']=$b->id;
				
				///////////////////////////////
				$st = 0;
				$sl = 0;
				$seater = array();
				$sleeper = array();
				foreach($out as $o=>$t){
					if (strpos($o, $niddle) !== false) {
					     
					    $exp = explode('-',$o);
					    if($exp[2]=='ST'){
					    	$seater[$st]['ST']=$exp[3];
					    	if ( strpos( $t, "." ) !== false )
					    		$seater[$st]['price'] = $t;					    		  
					    	
					    	$seater[$st]['price'] = number_format((float)$t,2,'.','');	 

					    	if($seater[$st]['price'] == 0.00)
					    		unset($seater[$st]);
					    	
					    	$st++;
					    }
					    if($exp[2]=='SL'){
					    	$sleeper[$sl]['SL'] = $exp[3];
					    	if ( strpos( $t, "." ) !== false ) 
					    		 $sleeper[$sl]['price'] = $t;
					    	
					    	$sleeper[$sl]['price'] = number_format((float)$t,2,'.','');

					    	if($sleeper[$sl]['price'] == 0.00)
					    		unset($sleeper[$sl]);

					    	$sl++;
					    }
					}
				}
							
				////////////////////////////////////////
				$tbl_inp[$m]['seater_arr'] = (count($seater)>0)?serialize($seater):NULL;
				$tbl_inp[$m]['sleaper_arr'] = (count($sleeper)>0)?serialize($sleeper):NULL;
				$m++;
			}
			foreach ($tbl_inp as $value) {

				$add_str_fare = $value['seater_arr'];
			 	$add_slpr_fare = $value['sleaper_arr'];

				if($add_str_fare !='' || $add_slpr_fare !='')
				{	
				 	 $upd_qry = $this->db->query("UPDATE bus_stoppage 
												SET add_str_fare = '".$add_str_fare."',
													add_slpr_fare = '".$add_slpr_fare."'
												WHERE id = '".$value['bus_stoppage_id']."'");	 									
				}
				else
				{
					 $upd_qry = $this->db->query("UPDATE bus_stoppage 
												SET add_str_fare = '',
													add_slpr_fare = ''
												WHERE id = '".$value['bus_stoppage_id']."'");	
				}
			}	

			 $log_data = (array)$bst;
			 $log_array = array();
			 $log_array['table_nm'] = 'bus_stoppage';
			 $log_array['primary_id'] = $log_data[0]->bus_id;
			 $log_array['Ref_info'] = 'Extra Seat Price Updated';
			 $log_array['old_data'] = json_encode($log_data);
			 $log_array['new_data'] = json_encode($tbl_inp);			
			 take_backup($log_array);
							
			if($upd_qry){
				$smsg = "Data Updated Successfully";
				$typ = 'success';
			}else{
				$smsg = "Error Occurs While processing request";
				$typ = 'error';
			}

			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_seat_fare_edit/".$id));	
		}				
		$this->data['sub_view'] = 'admin/subview/bus/bus_seat_fare_edit';
		$this->load->view('admin/_master',$this->data); 
	}

	public function bus_basic_edit($id)
	{
		$this->data['info']= $info = $this->Bus_m->get($id);

		if($_POST)
		{
			$dd = $this->input->post();
			
			$datav['opr_id'] = $dd['opr_id'];
			$datav['bus_type_txt'] = $dd['bus_type_txt'];
			$datav['bus_number'] = $dd['bus_number'];
			$datav['bus_name'] = $dd['bus_name'];
			$datav['via'] = $dd['via'];
			$datav['bus_type'] = $dd['bus_type'];
			$datav['sitting_type'] = $dd['sitting_type'];
			$datav['added_on'] = date('Y-m-d H:i:s');
			$datav['added_by'] = $this->session->userdata('user_id');
			$datav['amenities'] = serialize($dd['amenities']);
			$r = $this->Bus_m->update($id,$datav);

			$log_data = (array)$info;

			$log_array = array();

			$log_array['table_nm'] = 'bus_master';
			$log_array['primary_id'] = $log_data['bus_id'];
			$log_array['Ref_info'] = 'Bus Basic Info Updated';
			$log_array['old_data'] = json_encode($log_data);
			$log_array['new_data'] = json_encode($dd);				

			take_backup($log_array);
			
			if($r){
				$smsg= "Data Updated Successfully";
				$typ='success';
				$this->db->insert('bak_bus_master', $info);
			}else{
				$smsg= "Error Occurs While processing request";
				$typ='error';
			}

			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_basic_edit/".$id));	
		}

				
		
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->data['bustyp'] = $bustyp = $this->Bustype_m->get_many_by(array('status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array('status'=>3));
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array('status'=>3));
		$this->data['slout'] = $this->SeatLayout_m->get_many_by(array('status'=>1));
		$this->data['location'] = $location = $this->Location_m->get_many_by(array('status'=>3));	
		$this->data['meta_title'] = 'Bus :: Basic Info Edit';		
		$this->data['sub_view'] = 'admin/subview/bus/bus_basic_edit';
		$this->load->view('admin/_master',$this->data);
	}
	
	public function bus_contact_edit($id)
	{	
		$this->data['info_bus'] = $this->Bus_m->get($id);
		$this->data['info']= $info = $this->BusContactInfo_m->get_by(array('bus_id'=>$id));

		if($_POST)
		{
			$datav = $this->input->post();			
			$datav['added_on'] = date('Y-m-d H:i:s');
			$datav['added_by'] = $this->session->userdata('user_id');

				$dataold['cond_mob'] = '';
				$dataold['cnd_send'] = '';
				$dataold['cond_csend'] = '';
				
				$dataold['mngr_mob'] = '';
				$dataold['mngr_send'] = '';
				$dataold['mngr_csend'] = '';
				
				$dataold['ownr_mob'] = '';
				$dataold['ownr_send'] = '';
				$dataold['ownr_csend'] = '';
				$r = $this->BusContactInfo_m->update($info->id,$dataold);
				$log_data = (array)$info;
				$log_array = array();
				$log_array['table_nm'] = 'bus_master';
				$log_array['primary_id'] = $log_data['bus_id'];
				$log_array['Ref_info'] = 'Contact Info Updated';
				$log_array['old_data'] = json_encode($log_data);
				$log_array['new_data'] = json_encode($datav);				
				take_backup($log_array);	
				
			$r = $this->BusContactInfo_m->update($info->id,$datav);
			
			if($r){
				$smsg = "Data Updated Successfully";
				$typ = 'success';
				#$this->db->insert('bak_bus_contact_info', $info);
			}else{
				$smsg = "Error Occurs While processing request";
				$typ = 'error';
			}
			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_contact_edit/".$id));	
		}	
		
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operater', 'status'=>1));
		$this->data['bustyp'] = $bustyp = $this->Bustype_m->get_many_by(array('status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array('status'=>3));
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array('status'=>3));
		$this->data['slout'] = $this->SeatLayout_m->get_many_by(array('status'=>1));
		$this->data['location'] =  $location = $this->Location_m->get_many_by(array('status'=>3));	
		$this->data['meta_title'] = 'Bus :: Edit Contact Info';
		$this->data['sub_view'] ='admin/subview/bus/bus_contact_edit';
		$this->load->view('admin/_master',$this->data);
	}

	public function bus_edit_more_seat($id)
	{
		$this->session->unset_userdata('seater_seats');
		$this->session->unset_userdata('ad_seater_seats');
		$this->session->unset_userdata('sleeper_seats');
		$this->session->unset_userdata('ad_sleeper_seats');

		$this->data['info'] = $info = $this->Bus_m->get($id);
		$this->data['info_bus'] = $this->Bus_m->get($id);
		//----------
			if($info->seater_seats !='' && !empty($info->seater_seats))
				$dm['seater_seats'] = unserialize($info->seater_seats);
			if($info->ad_seater_seats !='' && !empty($info->ad_seater_seats))
				$dm['ad_seater_seats'] = unserialize($info->ad_seater_seats);
			if($info->sleeper_seats !='' && !empty($info->sleeper_seats))
				$dm['sleeper_seats'] = unserialize($info->sleeper_seats);
			if($info->ad_sleeper_seats !='' && !empty($info->ad_sleeper_seats))
				$dm['ad_sleeper_seats'] = unserialize($info->ad_sleeper_seats);
			$this->session->set_userdata($dm);
		//----------
		if($_POST)
		{
				$dd = $this->input->post();		
				$datav['duration'] = $dd['duration'];
				//$datav['seat_layout_id']= $dd['seat_layout_id'];
				//---------
				if(isset($dd['seat_st']))
					$datav['ad_seater_seats'] = serialize($dd['seat_st']);       	
				else
					$datav['ad_seater_seats'] = '';				


				if(isset($dd['seat_slipper']))
					$datav['ad_sleeper_seats'] = serialize($dd['seat_slipper']);		
				else
					$datav['ad_sleeper_seats'] = '';				

				# Backup All Data
				# ------------------------ #

					$log_data = (array)$info;
					$log_array = array();	
					$log_array['table_nm'] = 'bus_master';
					$log_array['primary_id'] = $log_data['bus_id'];
					$log_array['Ref_info'] = 'Extra Seats Updated';
					$log_array['old_data'] = json_encode($log_data);
					$log_array['new_data'] = json_encode($datav);	
					take_backup($log_array);	

				# -------------------------- #

				$r = $this->Bus_m->update($id,$datav);
				
				if($r){
					$smsg= "Data Updated Successfully";
					$typ='success';
					$this->db->insert('bak_bus_master', $info);
				}else{
					$smsg= "Error Occurs While processing request";
					$typ='error';
				}
			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_edit_more_seat/".$id));	
		}
		
		
	//	$this->data['operater']=$this->User_m->get_many_by(array('user_typ'=>'Operater', 'status'=>1));
	//	$this->data['bustyp']= $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
	//	$this->data['busSeatTyp']= $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
	//	$this->data['amenity']= $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout']=  $this->SeatLayout_m->get_many_by(array( 'status'=>1));
	//	$this->data['location']=  $location=  $this->Location_m->get_many_by(array( 'status'=>3));	
		$this->data['meta_title'] = 'Bus :: Edit More Seat';
		$this->data['sub_view']='admin/subview/bus/bus_edit_more_seat';
		$this->load->view('admin/_master',$this->data);
	}
	
	public function bus_seat_edit($id)
	{
		$this->data['info'] = $info = $this->Bus_m->get($id);
		$this->data['info_bus'] = $this->Bus_m->get($id);	

		#print_result($info); exit;	
		
		//----------

			$dm['seater_seats'] = unserialize($info->seater_seats);
			$dm['sleeper_seats'] = unserialize($info->sleeper_seats);
			$this->session->set_userdata($dm);
			
		//----------
		
		if($_POST)
		{
				$dd = $this->input->post();		
				$datav['seat_layout_id'] = $dd['seat_layout_id'];
				//---------
				if(isset($dd['seat_st']))
					$datav['seater_seats'] = serialize($dd['seat_st']);       	
				
				if(isset($dd['seat_slipper']))
					$datav['sleeper_seats'] = serialize($dd['seat_slipper']);	
				else
					$datav['sleeper_seats'] = NULL;			
				
				//-------------
				$datav['added_on'] = date('Y-m-d H:i:s');
				$datav['added_by'] = $this->session->userdata('user_id');

				$r = $this->Bus_m->update($id,$datav);

				# Backup All Data
				# ------------------------ #

					$log_data = (array)$info;
					$log_array = array();
					$log_array['table_nm'] = 'bus_master';
					$log_array['primary_id'] = $log_data['bus_id'];
					$log_array['Ref_info'] = 'Bus Seat Updated';
					$log_array['old_data'] = json_encode($log_data);
					$log_array['new_data'] = json_encode($datav);				
					take_backup($log_array);

				# -------------------------- #	
			
			if($r){
				$smsg = "Data Updated Successfully";
				$typ = 'success';
				$this->db->insert('bak_bus_master', $info);
			}else{
				$smsg = "Error Occurs While processing request";
				$typ = 'error';
			}
			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_seat_edit/".$id));	
		}		
		
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operater', 'status'=>1));
		$this->data['bustyp'] =  $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout'] =  $this->SeatLayout_m->get_many_by(array( 'status'=>1));
		$this->data['location'] =  $location=  $this->Location_m->get_many_by(array( 'status'=>3));		
		$this->data['meta_title'] = 'Bus :: Bus Seat Edit';
		$this->data['sub_view'] = 'admin/subview/bus/bus_seat_edit';
		$this->load->view('admin/_master',$this->data);
	}

	public function c_slabs()
	{
		$ids = $_REQUEST['ids'];

		  $q = $this->db->query("SELECT * FROM bus_cncl_durtn WHERE id = '".$ids."'")->row();
	      $slab = unserialize($q->duration);
	      $str = '';

	      $str .= '<table class="table table-hover table-striped table-bordered">
	                <thead class="bordered-blueberry">
	                  <tr>
	                    <th> Sl No </th>
	                    <th> Duration (In Hours) </th>
	                    <th> % CutOff </th>                                          
	                  </tr>
	                </thead>
	              <tbody>';

	      foreach ($slab as $k => $v) {
	            $k = $k+1;                                          
	            $x = explode('#',$v);
	            $str .= '<tr>
	                      <td>'.$k.'</td>
	                      <td>'.$x[0].'</td>
	                      <td>'.$x[1].'</td>
	                    </tr>';
	      }

	    	  $str .='</tbody>
	    	  </table>';
	      echo $str;	
	}

	public function bus_cancellationslab_edit($id)
	{
		$this->data['info'] = $info = $this->Bus_m->get($id);
		$this->data['info_bus'] = $info_bus = $this->Bus_m->get($id);		

		if($_POST)
		{			
			$dd = $this->input->post();					

			//-------------
			# Backup All Data
			# ------------------------ #

				$log_data = (array)$info;
				$log_array = array();
				$log_array['table_nm'] = 'bus_master';
				$log_array['primary_id'] = $log_data['bus_id'];
				$log_array['Ref_info'] = 'Bus Cancellation Slab Updated';
				$log_array['old_data'] = json_encode($log_data);
				$log_array['new_data'] = json_encode($dd);				
				take_backup($log_array);

			# -------------------------- #	

			$r = $this->Bus_m->update($id,$dd);	
			
			if($r){
				$smsg= "Data Updated Successfully";
				$typ='success';
				#$this->db->insert('bak_bus_master', $info);
			}else{
				$smsg= "Error Occurs While processing request";
				$typ='error';
			}
			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_cancellationslab_edit/".$id));	
		}		
		
		$this->data['slab'] =  $this->Bus_cancellation_slab->get_many_by(array('status'=>0));
		
		$this->data['meta_title'] = 'Bus :: Edit Cancellation Slab';
		$this->data['sub_view']='admin/subview/bus/bus_cancellationslab_edit';
		$this->load->view('admin/_master',$this->data);
	}	
	
	public function bus_route_edit($id)
	{
		$this->data['info_bus']=   $this->Bus_m->get($id);
		$info = $this->db->query('select * from bus_stoppage where bus_id ='.$id.'   ORDER BY id ASC')->result();
		$i_out=array();
		$i=0;
		foreach($info as $inf){
			$i_out[$i]=$inf;
			$i_out[$i]->brd_loc_tim =$this->reverse_board_drop_time_array($inf->brd_pts_tm);
			$i_out[$i]->drp_loc_tim =$this->reverse_board_drop_time_array($inf->drp_pts_tm);
			
			$i++;
		}		
		$this->data['info']= $i_out;
		
		if($_POST)
		{
			$dd = $this->input->post();	
			$frm = $dd['from_id'];
			$cn =0;
			$bakdata = $this->BusStoppage_m->get_many_by(array('bus_id'=>$id));

			if(count($frm)>0){

				$this->db->query('DELETE FROM bus_stoppage WHERE bus_id='.$id);	

				foreach($frm as $f){
					$datasp['bus_id'] = $id;
					$datasp['from_id'] = $f;
					$datasp['to_id'] = $dd['to_id'][$cn];
					$board = $dd['from_points'][$cn];
					$drop = $dd['to_points'][$cn];
					$datasp['brd_pts_tm'] = $this->board_drop_time_array($board);
					$datasp['drp_pts_tm'] = $this->board_drop_time_array($drop);				
					$datasp['dep_time'] = $dd['dep_time'][$cn];
					$datasp['arr_time'] = $dd['arr_time'][$cn];
					$datasp['seat_fare'] = $dd['seat_fare'][$cn];
					$datasp['sleeper_fare'] = $dd['sleeper_fare'][$cn];				
					$datasp['status'] = 3;
					$datasp['added_on'] = date('Y-m-d H:i:s');
					$datasp['added_by'] = $this->session->userdata('user_id');
					$datasp['j_day'] = $dd['j_day'][$cn];
					$rsp = $this->BusStoppage_m->insert($datasp);
					$cn++;
				}	

				# Backup All Data
				# ------------------------ #

					$log_data = (array)$bakdata;
					$log_array = array();
					$log_array['table_nm'] = 'bus_stoppage';
					$log_array['primary_id'] = $log_data[0]->bus_id;
					$log_array['Ref_info'] = 'Bus Stoppage Updated';
					$log_array['old_data'] = json_encode($log_data);
					$log_array['new_data'] = json_encode($bakdata);	
					take_backup($log_array);
						
				# -------------------------- #		
				
			}			    
				$smsg= "Data Updated Successfully";
				$typ='success';
			
			$this->session->set_flashdata($typ,$smsg);
			redirect(base_url("sadmin/bus_route_edit/".$id));	
		}
		
		
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operater','status'=>1));
		$this->data['bustyp'] = $bustyp = $this->Bustype_m->get_many_by(array('status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array('status'=>3));
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array('status'=>3));
		$this->data['slout'] = $this->SeatLayout_m->get_many_by(array('status'=>1));
		$this->data['location'] = $location = $this->Location_m->get_many_by(array('status'=>3));
		$this->data['meta_title'] = 'Bus :: Bus Stoppage Edit';
		$this->data['sub_view'] ='admin/subview/bus/bus_route_edit';
		$this->load->view('admin/_master',$this->data);
	}	
	
	
	public function add_bus()
	{	
		if($_POST)
		{
			$dd = $this->input->post();
			$bus_no= $dd['bus_number'];
			$cnt=0;
			foreach($bus_no as $bus)
			{
			if($bus!=''){	
				$data['opr_id'] = $dd['opr_id'];
				$data['bus_name'] = $dd['bus_name'];
				$data['via'] = $dd['via'];
				$data['bus_type'] = $dd['bus_type'];
				$data['sitting_type'] = $dd['sitting_type'];				
				
				if(isset($dd['amenities'])){
					$data['amenities'] = serialize($dd['amenities']);
				}

				$data['bus_number'] = $bus;
				$data['added_on'] = date('Y-m-d H:i:s');
				$data['added_by'] = $this->session->userdata('user_id');
				
				$data['seat_layout_id'] = $dd['seat_layout_id'];
				//---------
				$dx='';
				$dy='';
				if(isset($dd['seat_st'])){
					$dx = serialize($dd['seat_st']); 
				}
				if(isset($dd['seat_slipper'])){
					$dy = serialize($dd['seat_slipper']);
				}
				$data['seater_seats'] = $dx;       
				$data['sleeper_seats'] = $dy; 
				//-------------
				$data['status'] = 3;
				$data['added_on'] = date('Y-m-d H:i:s');
				$data['added_by'] = $this->session->userdata('user_id');
				
				$r = $this->Bus_m->insert($data);
				
				if($r)
				{
					$datal['bus_id'] = $r;
					$datal['cond_mob'] = (isset($dd['cond_mob'][$cnt]))?$dd['cond_mob'][$cnt]:0;
					$datal['cnd_send'] = (isset($dd['cnd_send'][$cnt]))?$dd['cnd_send'][$cnt]:0;
					$datal['cond_csend'] = (isset($dd['cond_csend'][$cnt]))?$dd['cond_csend'][$cnt]:0;
					$datal['mngr_mob'] = (isset($dd['mngr_mob'][$cnt]))?$dd['mngr_mob'][$cnt]:0;
					$datal['mngr_send'] = (isset($dd['mngr_send'][$cnt]))?$dd['mngr_send'][$cnt]:0;
					$datal['mngr_csend'] = (isset($dd['mngr_csend'][$cnt]))?$dd['mngr_csend'][$cnt]:0;
					$datal['ownr_mob'] = (isset($dd['ownr_mob'][$cnt]))?$dd['ownr_mob'][$cnt]:0;
					$datal['ownr_send'] = (isset($dd['ownr_send'][$cnt]))?$dd['ownr_send'][$cnt]:0;
					$datal['ownr_csend'] = (isset($dd['ownr_csend'][$cnt]))?$dd['ownr_csend'][$cnt]:0;
					$datal['added_on'] = date('Y-m-d H:i:s');
					$datal['added_by'] = $this->session->userdata('user_id');
					$rl = $this->BusContactInfo_m->insert($datal);
					///////////////////////
					
					$frm = $dd['from_id'];
					$cn =0;
					foreach($frm as $f)
					{
						$datasp['bus_id'] = $r;
						$datasp['from_id'] = $f;
						$datasp['to_id'] = $dd['to_id'][$cn];
						$board = $dd['from_points'][$cn];
						$drop = $dd['to_points'][$cn];
						$datasp['brd_pts_tm'] = $this->board_drop_time_array($board);
						$datasp['drp_pts_tm'] = $this->board_drop_time_array($drop);					
						$datasp['dep_time'] = $dd['dep_time'][$cn];
						$datasp['arr_time'] = $dd['arr_time'][$cn];
						$datasp['seat_fare'] = $dd['seat_fare'][$cn];
						$datasp['sleeper_fare'] = $dd['sleeper_fare'][$cn];
						$datasp['status'] = 3;
						$datasp['added_on'] = date('Y-m-d H:i:s');
						$datasp['added_by'] = $this->session->userdata('user_id');
						$datasp['j_day'] = $dd['j_day'][$cn];		
						$rsp = $this->BusStoppage_m->insert($datasp);
						$cn++;
					}
				}
				$cnt++;
			}  /*///-- incondition ends $bus!=''*/
			}
			///----foreach ends
			////////////////////////////////////////////
						$smsg = "Data Updated Successfully";
						$typ = 'success';
						$this->session->set_flashdata($typ,$smsg);
						redirect(base_url("sadmin/buslist/"));
			/////////////////
		}		
		
		$this->db->order_by('org_nm','asc');
		$this->data['operater'] = $this->User_m->get_many_by(array('user_typ'=>'Operator', 'status'=>1));
		$this->db->order_by('bus_type','asc');
		$this->data['bustyp'] = $bustyp = $this->Bustype_m->get_many_by(array( 'status'=>3));
		$this->data['busSeatTyp'] = $busSeatTyp = $this->Bussittingtype_m->get_many_by(array( 'status'=>3));
		$this->db->order_by('amenities','asc');
		$this->data['amenity'] = $this->Busamenities_m->get_many_by(array( 'status'=>3));
		$this->data['slout'] = $this->SeatLayout_m->get_many_by(array( 'status'=>1));
		$this->data['location'] = $location = $this->Location_m->get_many_by(array( 'status'=>3));	
		$this->data['meta_title'] = 'Bus :: Add Bus';		
		$this->data['sub_view'] = 'admin/subview/bus/add_bus';
		$this->load->view('admin/_master',$this->data);
	}	
	
	
	public function buslayout()
	{	
		if($_POST)
		{
				$data['layout']=$this->input->post('layout_code');
				$data['layout_nm']=$this->input->post('layout_nm');
				$data['status']=1;
				$data['added_on']= date('Y-m-d H:i:s');
				$data['added_by']=$this->session->userdata('id');
				
				$r=$this->SeatLayout_m->insert($data);
				if($r){
					$smsg= "Data added Successfully";
					$typ='success';
				}else{
					$smsg= "Error Occurs While processing request";
					$typ='error';
				}
				$this->session->set_flashdata($typ,$smsg);
				redirect(base_url("sadmin/buslayout/"));
		}
		
		$this->data['meta_title'] = 'Bus :: Add Seat Layout';	 	
		$this->data['sub_view']='admin/subview/bus_layout';
		$this->load->view('admin/_master',$this->data);
	}

	public function view_bus_layout($id)
	{
		echo draw_seat_layout($id);
		//$this->data['id']=$id ;
		//$this->data['sub_view']='admin/subview/view_bus_layout';
		//$this->load->view('admin/_master',$this->data);
	}
	
	public function convert_array_to_obj_recursive($a) {
		if (is_array($a) ) {
			foreach($a as $k => $v) {
				if (is_integer($k)) {
					// only need this if you want to keep the array indexes separate
					// from the object notation: eg. $o->{1}
					$a['index'][$k] = $this->convert_array_to_obj_recursive($v);
				}
				else {
					$a[$k] = $this->convert_array_to_obj_recursive($v);
				}
			}
			return (object) $a;
		}
		// else maintain the type of $a
		return $a; 
	}	
	
	public function object2array($object) { return @json_decode(@json_encode($object),1); } 

	public function buslayout_list()
	{	
		$logs=$this->db->query('select * from bus_seat_layout where 1')->result();		
		
		$m='';
		if(count($logs)>0){
			$v=0;
			foreach($logs as $ad){
				$v++;
				$stbtn ='';
				if($ad->status==0){
					$stbtn ='<p class="rimary">Pending</p>';
					
				}elseif($ad->status==1){
					$stbtn ='<p class="info">Active</p>';
					
				}
				/////href="'.base_url('sadmin/view_bus_layout/'.$ad->id).'" 
				
				
				$m .= '
                <tr>
                    <td>'.$v.'</td>
                    <td>'.$ad->layout_nm.'</td>
					<td>'.date('M d Y',strtotime($ad->added_on)).'</td>
                    <td>'.$stbtn.'</td>
                    <td class="hidden-xs">
						<a num="'.$ad->id.'"	class="btn btn-primary btn-xs showpop"><i class="fa fa-eye"></i></a>
					</td>
                </tr>
				';
			}
		}	
		
		$this->data['alldata']=$m;		
		$this->data['meta_title'] = 'Bus :: Seat layout List';				
		$this->data['sub_view']='admin/subview/bus_layout_list';
		$this->load->view('admin/_master',$this->data);
	}
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('members/login'),'refresh');
	}
	
   public function do_upload($fieldname, $directory, $width=NULL, $height=NULL, $filename) 
   {    
	    $this->my_upload->upload($_FILES[$fieldname]);
		 if ( $this->my_upload->uploaded == true  ) {
	      //$this->my_upload->allowed         = array('image/*');
	      $this->my_upload->file_new_name_body    = $filename;
	     
		  if($width !=NULL):
		     $this->my_upload->image_resize          = true;
	         $this->my_upload->image_ratio_crop          = true;
	      	$this->my_upload->image_x               = $width;
	      	endif;
	      if($height !=NULL)
	     	 $this->my_upload->image_y         = $height;
		  
	      $this->my_upload->process($directory);
	      if ( $this->my_upload->processed == true ) {
	         $output = $this->my_upload->file_dst_name;
			 
	      } else {
	        $output = NULL;
	      }
	    } else  {
	      $output = NULL;
	    }
		return $output; 
    } 	  

    public function script_page()  
	{
		if($_POST){
			$data=$this->input->post();
			$data['insert_date']=date('Y-m-d');			 
			$i=strip_tags($_POST['info']);
			$i = str_replace("&nbsp;"," ",$i);
			$data['info']=$i;
			$this->db->insert('dynamic_script', $data);

			$this->session->set_flashdata('success','Data added successfully');
			redirect(base_url('sadmin/scriptlist/'),'refresh');
		}
		
		$this->data['dynafld']=$dynafld= $this->db->query('SELECT * from dynamic_fields')->result();
		$this->data['sub_view']='admin/subview/script_page';
		$this->load->view('admin/_master',$this->data);
	}

	public function scriptedit($id)  
	{
		if($_POST){
					 
			$i=strip_tags($_POST['info']);
			$i = str_replace("&nbsp;"," ",$i);
			$info=$i;
			$heading=$_POST['heading'];
			$this->db->set('heading', $heading);
			$this->db->set('info', $info);
			$this->db->where('ds_id', $id);
			$this->db->update('dynamic_script');

			$this->session->set_flashdata('success','Data updated successfully');
			redirect(base_url('sadmin/scriptlist/'),'refresh');
		}

		$this->data['info'] = $info = $this->db->get_where('dynamic_script', array('ds_id' => $id))->row();		
		$this->data['dynafld']=$dynafld= $this->db->query('SELECT * from dynamic_fields')->result();	
		$this->data['sub_view']='admin/subview/scriptedit';
		$this->load->view('admin/_master',$this->data);
	}

	public function scriptlist()  
	{
		$dynafld= $this->db->get('dynamic_script')->result();
		
		$m='';
		$i=1;
		foreach($dynafld as $d){
			$m .='<tr>
                    <th>'.$i.'</th>
                    <th>'.$d->heading.'</th>
                    <th>'.$d->info.'</th>                                
                    <th><a class="btn btn-info" href="'.base_url('sadmin/scriptedit/'.$d->ds_id).'">Edit</a>
                    </th>                                                
                </tr>';

             $i++;
       	}

		$this->data['alldata']=$m;
		$this->data['sub_view']='admin/subview/scriptlist';
		$this->load->view('admin/_master',$this->data);
	}
}
?>