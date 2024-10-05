<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Admin_Controller 
{
	function __construct() 
	{
		parent::__construct();
		//phpinfo(); exit;
		$this->load->helper('directory');
		$this->load->model('User_m');	
		$this->load->model('Sitemaster_m');	
		$this->load->model('Faq_m');	
		$this->load->model('Partners_m');	
		$this->load->model('Testimonial_m');	
		$this->load->model('Banner_m');	
		$this->load->model('TableFolder_m');	
		$this->load->model('Page_m');	
		$this->load->model('Page_Meta_m');	
		$this->load->model('Template_m');	
		$this->load->model('Category_m');	
		$this->load->model('Post_m');	
		$this->load->model('Contacts_m');	
		$this->load->model('Members_m');	
		$this->load->model('Live_Members_m');	
		$this->load->model('Donation_m');	
		$this->load->model('Gallery_m');	
		$this->load->model('MediaCoverage_m');	
		//$this->load->model('Mastermenu_m');	
		
        $this->load->library('email');
		$this->load->helper('string');
        $this->load->library('pagination');	
		//$this->load->library('Excel');
		//$this->load->library('my_upload');	 
		//$this->load->library('Slim');	
		$this->load->library('Compress');
			
	}

	
	public function index()
	{
		redirect(base_url("members/login"), "refresh");
	}	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('members/login'),'refresh');
	}

	public function custom_function()
	{
		update_status();
	}

	public function exportcsvdata1($data,$filename)
	{
        $array = array();

        foreach ($data as $row)
	    {
	        $line = array();

	        foreach ($row as $item)
	        {
	            $line[] = $item;			            
	        }
	        $array[] = $line;
	    }

	    #print_result($array); exit;

        header('Content-type: application/csv');
        header("Content-Disposition: attachment; filename=\"$filename".".csv\"");
        header('Pragma: no-cache');
        header('Expires: 0');
        $handle = fopen('php://output', 'w');

        $ns = count($array);
        $t = 0;


        fputcsv($handle, array_keys($data[1]));
        
        foreach ($array as $k => $array) 
        {
            $t++;
            if($t==$ns){
            	echo implode(',',$array);
            }else{
            	echo implode(',',$array)."\r\n";
            }			                       
        }
        fclose($handle);
        exit;              
    }
	
	public function dashboard()
	{
		$where = array('status' => 1);		
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$this->db->limit(9);		
		$q = $this->db->get('contacts');

		$this->data['contacts'] = $contacts = $q->result();

		$where = array('del_status' => 0, 'status' => 1);
		$this->db->where($where);
		$total_pgs = $this->db->count_all_results('page');

		$this->data['total_pages'] = $total_pgs;

		$where = array('del_status' => 0, 'status' => 1, 'post_type' => 'Product');
		$this->db->where($where);
		$total_prd_cat = $this->db->count_all_results('category');

		$this->data['total_prd_cat'] = $total_prd_cat;

		$where = array('del_status' => 0, 'status' => 1, 'post_type' => 'Product');
		$this->db->where($where);
		$total_prd = $this->db->count_all_results('post');

		$this->data['total_prd'] = $total_prd;

		$where = array('del_status' => 0, 'status' => 1);
		$this->db->where($where);
		$total_reviews = $this->db->count_all_results('testimonial');

		$this->data['total_reviews'] = $total_reviews;

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Dashboard';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>									 
            						  <li class="active">Dashboard</li>';         						  	
		
		$this->data['sub_view']='admin/subview/dashboard';
		$this->load->view('admin/_master',$this->data);
	}

	public function check_duplicate()
	{
		$field_nm = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$val = urldecode($this->uri->segment(5));
		$type = urldecode($this->uri->segment(6));

		$extqry = '';

		if(isset($type) && $type !='')
		{
			$extqry .= " AND post_type = '".$type."'";
		}

		$q = $this->db->query("SELECT id FROM $table WHERE $field_nm = '".trim($val)."' $extqry")->row();

		//echo $this->db->last_query();

		if(isset($q->id) && $q->id !='')
			$data = 1;
		else
			$data = 0;

		echo $data;
	}

	public function add_members()
	{

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			$r = $this->Members_m->insert($data);
			$insert_id = $this->db->insert_id();

			if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))		
			{	
				$org_path = 'post/members/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['img']['tmp_name'],$org_path.$fileName);
				
				$dd['img'] = $fileName;

				$this->Members_m->update($insert_id,$dd);
			}
			
			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_members/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Members';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Members</li>
            						  <li class="active">Add Members</li>';
		
		$this->data['sub_view']='admin/subview/add_members';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_members($id)
	{
		$this->data['all_data']= $page_data = $this->Members_m->get($id);

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Members_m->update($id,$data);

			if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/members/';

				$fileName = $_FILES['img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->img !='')
					{
						$filenms = $org_path.$page_data->img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['img'] = $fileName;
					$this->Members_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_members/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Members';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Edit Members</li>';
		
		$this->data['sub_view']='admin/subview/edit_members';
		$this->load->view('admin/_master',$this->data);
	}

	public function members()
	{		

		$this->data['members'] = $members = $this->Members_m->GetAll();

		//print_result($members); exit;
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Members List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Members</li>
            						  <li class="active">Members List</li>';

		$this->data['sub_view']='admin/subview/memberlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function mediaCoverage()
	{		

		$this->data['mediaCoverage'] = $d = $this->MediaCoverage_m->GetAll();

		//print_result($members); exit;
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'MediaCoverage List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>MediaCoverage</li>
            						  <li class="active">MediaCoverage List</li>';

		$this->data['sub_view']='admin/subview/media_coverage_list.php';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_mediaCoverage()
	{

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);

			$data['publish_date'] = ($data['publish_date'] !='')?date('Y-m-d',strtotime($data['publish_date'])):NULL;

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('id');

			//print_result($data);exit;
			$r = $this->MediaCoverage_m->insert($data);

			$insert_id = $this->db->insert_id();

			if(isset($_FILES['cut_img']['name']) && !empty($_FILES['cut_img']['name']))		
			{	
				$org_path = 'post/mediaCoverage/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['cut_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['cut_img']['tmp_name'],$org_path.$fileName);
				
				$dd['cut_img'] = $fileName;

				$this->MediaCoverage_m->update($insert_id,$dd);
			}
			
			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_mediaCoverage/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add MediaCoverage';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>MediaCoverage</li>
            						  <li class="active">Add MediaCoverage</li>';
		
		$this->data['sub_view']='admin/subview/add_mediaCoverage';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_mediaCoverage($id)
	{
		$this->data['all_data']= $page_data = $this->MediaCoverage_m->get($id);

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$data['publish_date'] = ($data['publish_date'] !='')?date('Y-m-d',strtotime($data['publish_date'])):NULL;
			$data['updated_on'] = date('Y-m-d H:i:s');
			$data['update_by'] = $this->session->userdata('id');

			// print_result($data); exit();
			$r = $this->MediaCoverage_m->update($id,$data);

			if(isset($_FILES['cut_img']['name']) && !empty($_FILES['cut_img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/mediaCoverage/';

				$fileName = $_FILES['cut_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->cut_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->cut_img !='')
					{
						$filenms = $org_path.$page_data->cut_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['cut_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['cut_img'] = $fileName;
					$this->Members_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_mediaCoverage/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit MediaCoverage';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>MediaCoverage</li>
            						  <li class="active">Edit MediaCoverage</li>';
		
		$this->data['sub_view']='admin/subview/edit_mediaCoverage';
		$this->load->view('admin/_master',$this->data);
	}


	public function add_livemembers()
	{

		if($_POST)
		{
			$data = $_POST;		
			$dates = str_replace('/','-',$data['dates']);	

			$data['dates'] = date('Y-m-d',strtotime($dates));
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			$r = $this->Live_Members_m->insert($data);
			$insert_id = $this->db->insert_id();			
			
			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_livemembers/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Live Members';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Live Members</li>
            						  <li class="active">Add Live Members</li>';
		
		$this->data['sub_view']='admin/subview/add_live_members';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_livemembers($id)
	{
		$this->data['all_data']= $page_data = $this->Live_Members_m->get($id);

		if($_POST)
		{
			$data = $_POST;		

			$dates = str_replace('/','-',$data['dates']);	

			$data['dates'] = date('Y-m-d',strtotime($dates));
			$data['updated_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$r = $this->Live_Members_m->update($id,$data);						

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_livemembers/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Live Members';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Live Members</li>
            						  <li class="active">Edit Live Members</li>';
		
		$this->data['sub_view']='admin/subview/edit_live_members';
		$this->load->view('admin/_master',$this->data);
	}

	public function livemembers()
	{		
		$this->data['members'] = $members = $this->Live_Members_m->GetAll();

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Live Members List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Live Members</li>
            						  <li class="active">Live Members List</li>';

		$this->data['sub_view']='admin/subview/livememberlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_donation()
	{
		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);

			$dates = str_replace('/','-',$data['dod']);	

			$data['dod'] = date('Y-m-d',strtotime($dates));
			$data['year'] = date('Y',strtotime($dates));
			$data['month'] = date('m',strtotime($dates));

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			print_result($data);exit;
			$r = $this->Donation_m->insert($data);
			$insert_id = $this->db->insert_id();

			if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))		
			{	
				$org_path = 'post/donation/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['img']['tmp_name'],$org_path.$fileName);
				
				$dd['img'] = $fileName;

				$this->Donation_m->update($insert_id,$dd);
			}
			
			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_donation/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Donation';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Donation</li>
            						  <li class="active">Add Donation</li>';
		
		$this->data['sub_view']='admin/subview/add_donation';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_donation($id)
	{
		$this->data['all_data']= $page_data = $this->Donation_m->get($id);

		//print_result($page_data);exit;

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$dates = str_replace('/','-',$data['dod']);	

			$data['dod'] = date('Y-m-d',strtotime($dates));
			$data['year'] = date('Y',strtotime($dates));
			$data['month'] = date('m',strtotime($dates));
			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Donation_m->update($id,$data);

			if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/donation/';

				$fileName = $_FILES['img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->img !='')
					{
						$filenms = $org_path.$page_data->img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['img'] = $fileName;
					$this->Donation_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_donation/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Donation';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Donation</li>
            						  <li class="active">Edit Donation</li>';
		
		$this->data['sub_view']='admin/subview/edit_donation';
		$this->load->view('admin/_master',$this->data);
	}

	public function donation()
	{		
		$this->data['members'] = $members = $this->Donation_m->GetAll();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Donation List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Donation</li>
            						  <li class="active">Donation List</li>';

		$this->data['sub_view']='admin/subview/donationlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function gallerylist()
	{		
		$this->data['gallery'] = $gallery = $this->Gallery_m->GetAll();

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Gallery List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Gallery</li>
            						  <li class="active">Gallery List</li>';

		$this->data['sub_view']='admin/subview/gallerylist';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_gallery($id)
	{
		$this->data['all_data']= $page_data = $this->Gallery_m->get($id);

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Gallery_m->update($id,$data);

			if(isset($_FILES['gallery_img']['name']) && !empty($_FILES['gallery_img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'gallery_img/';

				$fileName = $_FILES['gallery_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->gallery_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->gallery_img !='')
					{
						$filenms = $org_path.$page_data->gallery_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    // if(file_exists($img_path))
				    // {
				      
				    //}

				    $fileName = rand().'_'.date('YmdHis').'.'.$extension;   
				    move_uploaded_file($_FILES['gallery_img']['tmp_name'],$org_path.$fileName);

					$thumb_width = 283;
					$thumb_height = 157;
					$upload_dir_thumbs = $org_path.'thumb/';

					createThumbnail($fileName, $thumb_width, $thumb_height, $org_path, $upload_dir_thumbs);

					$thumb_width1 = 120;
					$thumb_height1 = 80;
					$upload_dir_thumbs1 = $org_path.'thumb1/';

					createThumbnail($fileName, $thumb_width1, $thumb_height1, $org_path, $upload_dir_thumbs1);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['gallery_img'] = $fileName;
					$this->Gallery_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_gallery/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Gallery';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Gallery</li>
            						  <li class="active">Edit Gallery</li>';
		
		$this->data['sub_view']='admin/subview/edit_gallery';
		$this->load->view('admin/_master',$this->data);
	}


	public function add_page()
	{
		$this->data['templates'] = $templates = $this->Template_m->get_all();

		if($_POST)
		{
			$data = $_POST;	

			//print_result($_POST);exit;

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);		

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			if(isset($data['slug_url']) && $data['slug_url'] !='' )
			{
				 $data['slug_url'] = rtrim($data['slug_url'],'-');
			}

			$r = $this->Page_m->insert($data);
			$insert_id = $this->db->insert_id();

			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))							
			{	
				$org_path = 'background/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['bg_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);
				
				$dd['bg_img'] = $fileName;

				$this->Page_m->update($insert_id,$dd);
			}			

			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_page/'.$r),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Page';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">Add Page</li>';
		
		$this->data['sub_view']='admin/subview/add_page';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_page($id)
	{
		$this->data['all_data']= $page_data = $this->Page_m->get($id);
		$this->data['templates'] = $templates = $this->Template_m->get_all();

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			if(isset($data['slug_url']) && $data['slug_url'] !='' )
			{
				 $data['slug_url'] = rtrim($data['slug_url'],'-');
			}
			
			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Page_m->update($id,$data);


			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))							
			{	
				//print_result($_FILES); exit;
				$org_path = 'background/';

				$fileName = $_FILES['bg_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->bg_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->bg_img !='')
					{
						$filenms = $org_path.$page_data->bg_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['bg_img'] = $fileName;

					$this->Page_m->update($id,$dd);
				}
			}	

			update_menu_url_nm('Page',$id,$data['pg_name'],$data['slug_url']);
			
			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_page/'.$id),'refresh');			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Page';			
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">Eddit Page</li>';		
		$this->data['sub_view']='admin/subview/edit_page';
		$this->load->view('admin/_master',$this->data);
	}

	public function pages()
	{	
		$where = array('del_status' => 0);
				 $this->db->order_by('id','Desc');	 
				 $this->db->where($where);
		$q = $this->db->get('page');

		$this->data['pages'] = $pages = $q->result();

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Page List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">PageList</li>';

		$this->data['sub_view']='admin/subview/pagelist';
		$this->load->view('admin/_master',$this->data);
	}

	public function t_pages()
	{	
		$where = array('del_status' => 1);
				 $this->db->order_by('id','Desc');	 
				 $this->db->where($where);
		$q = $this->db->get('page');

		$this->data['pages'] = $pages = $q->result();	
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Page List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">Trash PageList</li>';

		$this->data['sub_view']='admin/subview/t_pagelist';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_category()
	{
		$where = array(
			 			'del_status' => 0,
			 			'parent_id'  => 0,
			 			'post_type'  => 'Product'
					  );
				 	 
	    $this->db->where($where);
		$q = $this->db->get('category');

		$this->data['category'] = $category = $q->result(); 

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);	

			//print_result($data); exit();
			$data['post_type'] = 'Product';
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$q = $this->Category_m->insert($data); 
			$insert_id = $q;

			if(isset($_FILES['post_img']['name']) && !empty($_FILES['post_img']['name']))				
			{	
				$org_path = 'post/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'post/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['post_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('post/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['post_img'] = $fileName;

				$this->Category_m->update($insert_id,$dd);
			}		


			if(isset($_FILES['bg_img']) && !empty($_FILES['bg_img']['name']))				
			{	
				$org_path = 'background/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['bg_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);
				
				$dd['bg_img'] = $fileName;

				$this->Category_m->update($insert_id,$dd);
			}	

			if($insert_id)	
			{
				$this->session->set_flashdata('success','Record Updated Successfully.');
			}
			else
			{
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			}
			
			redirect(base_url('admin/edit_category/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Product Category';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Add Product Category</li>';
		
		$this->data['sub_view']='admin/subview/add_prd_cat';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_category($id)
	{
		$this->data['all_data']= $page_data = $this->Category_m->get($id);
		$this->data['category'] = $category = $this->Category_m->get_many_by(array('del_status'=>0,'parent_id'=>0,'post_type'=>'Product'));

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);	

			unset($data['post_img']);
			unset($data['bg_img']);

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Category_m->update($id,$data);

			update_menu_url_nm('Category',$id,$data['cat_name'],$data['slug_url']);

			if(isset($_FILES['post_img']['name']) && $_FILES['post_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/';
				$thumb_path = 'post/thumb/';

				$fileName = $_FILES['post_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->post_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($page_data->post_img !='')
					{
						$filenms = $org_path.$page_data->post_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$page_data->post_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['post_img'] = $fileName;

					$this->Category_m->update($id,$dd);
				}
			}


			if(isset($_FILES['bg_img']['name']) && $_FILES['bg_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'background/';
				$thumb_path = 'background/thumb/';

				$fileName = $_FILES['bg_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->bg_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($page_data->bg_img !='')
					{
						$filenms = $org_path.$page_data->bg_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$page_data->bg_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['bg_img'] = $fileName;

					$r = $this->Category_m->update($id,$dd);
				}
			}			
		
			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_category/'.$id),'refresh');
			
		}	

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Product Category';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Edit Product Category</li>';
		
		$this->data['sub_view']='admin/subview/edit_prd_cat';
		$this->load->view('admin/_master',$this->data);
	}

	public function category()
	{
		$where = array(
			            'del_status' => 0,
			            'post_type'  => 'Product'
					  );
				 $this->db->order_by('id','Desc');	 
				 $this->db->where($where);
		$q = $this->db->get('category');		

		$this->data['category'] = $category = $q->result();

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Category List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Category List</li>';

		$this->data['sub_view']='admin/subview/categorylist';
		$this->load->view('admin/_master',$this->data);
	}

	public function t_category()
	{	
		$where = array('del_status' => 1);
		$this->db->order_by('id','Desc');	 
		$this->db->where($where);
		$q = $this->db->get('category');

		$this->data['category'] = $category = $q->result();	

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Category List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">TrashCategory List</li>';

		$this->data['sub_view']='admin/subview/t_categorylist';
		$this->load->view('admin/_master',$this->data);
	}

	public function get_subcat($catid)
	{
		$where = array('parent_id' => $catid);
		$this->db->where($where);
		$this->db->select('cat_name,id');
		$d = $this->db->get('category');

		$q = $d->result();
		$str = ''; 

		if(countz($q) > 0)
		{
			 $str .= '<option value="">Select Subcategory</option>';
			 //echo $str; exit; 
			 foreach ($q as $v) {
			 	 $str .= '<option value ="'.$v->id.'">'.$v->cat_name.'</option>';
			 }
		}
		/*else
		{
			$str .= '<option value ="">No SubCategory Found</option>';
		}*/

		echo $str;  exit;
	}

	public function add_product()
	{
		$where = array(
			   			'del_status' => 0,
			   			'post_type'  => 'product',
			   			'parent_id!='  => 0 
						);
				
		$this->db->where($where);
		$this->db->select('id,cat_name,slug_url');
		$q = $this->db->get('category');

		$this->data['category'] = $category = $q->result();
		
		if($_POST)
		{
			$data = $_POST;		

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);	

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');			

			if($data['post_name'] !='' && $data['slug_url'] !='' && $data['cat_id'] !='' || $data['full_desc'] !=''  || $data['side_desc'] !=''  || $data['model'] !='')
			{
				$post_array = array();				

				$post_array['post_type'] = ($data['post_type'] !='')?$data['post_type']:Null;
				$post_array['post_name'] = ($data['post_name'] !='')?$data['post_name']:Null;
				$post_array['slug_url'] = ($data['slug_url'] !='')?rtrim($data['slug_url'],'-'):Null;
				$post_array['cat_id'] = ($data['cat_id'] !='')?$data['cat_id']:0;
				$post_array['full_desc'] = ($data['full_desc'] !='')?$data['full_desc']:Null;
				$post_array['side_desc'] = ($data['side_desc'] !='')?$data['side_desc']:Null;
//				$post_array['model'] = ($data['model'] !='')?$data['model']:Null;
				$post_array['created_on'] = date('Y-m-d H:i:s');	
				$post_array['created_by'] = $this->session->userdata('user_id');

				//print_result($post_array); exit;

				$this->db->insert('post',$post_array);
				$insert_id = $this->db->insert_id();	
				
			}	

				// SEO CONTENT ENTRY
			if($data['meta_title'] !='' || $data['meta_key'] !='' || $data['meta_desc'] !='' || $data['extra_meta'] !='' || $data['canonical_code'] !='')
			{
				$meta_array = array();

				$meta_array['post_id'] = $insert_id;
				$meta_array['meta_title'] = ($data['meta_title'] !='')?$data['meta_title']:Null;
				$meta_array['meta_key'] = ($data['meta_key'] !='')?$data['meta_key']:Null;
				$meta_array['meta_desc'] = ($data['meta_desc'] !='')?$data['meta_desc']:Null;
				$meta_array['extra_meta'] = ($data['extra_meta'] !='')?$data['extra_meta']:Null;
				$meta_array['canonical_code'] = ($data['canonical_code'] !='')?$data['canonical_code']:Null;
				$meta_array['created_on'] = date('Y-m-d H:i:s');	
				$meta_array['created_by'] = $this->session->userdata('user_id');	

				$this->db->insert('post_meta',$meta_array);	
			}			
			
			if(isset($_FILES['post_img']['name']) && !empty($_FILES['post_img']['name']))		
			{	
				$org_path = 'post/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'post/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['post_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('post/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['post_img'] = $fileName;

				$this->Post_m->update($insert_id,$dd);
			}		


			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))		
			{	
				$org_path = 'background/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['bg_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

				
				$dd['bg_img'] = $fileName;

				$this->Post_m->update($insert_id,$dd);
			}	

			if(isset($data['full_desc']))
			{
				$this->db->set('full_desc', $data['full_desc']);
				$this->db->where('id', $insert_id);
				$this->db->update('post');

				// $this->db->query("UPDATE post SET full_desc = '".$data['full_desc']."' WHERE id = '".$insert_id."'");
			}					

			if($insert_id)	
			{
				$this->session->set_flashdata('success','Record Updated Successfully.');
			}
			else
			{
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			}
			
			redirect(base_url('admin/edit_product/'.$insert_id),'refresh');			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Product';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Add Product</li>';
		
		$this->data['sub_view']='admin/subview/add_product';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_product($id)
	{
		$this->data['all_data']= $post_data = $this->Post_m->get($id);
		$where = array(
			   			'del_status' => 0,
			   			'post_type'  => 'product',
			   			'parent_id'  => 0 
						);
				
		$this->db->where($where);
		$this->db->select('id,cat_name,slug_url');
		$q = $this->db->get('category');

		$this->data['category'] = $category = $q->result();

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);	

			unset($data['post_img']);
			unset($data['bg_img']);

		
			if(isset($data['slug_url']) && $data['slug_url'] !='' )
			{
				 $data['slug_url'] = rtrim($data['slug_url'],'-');
			}			

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$upd = $this->Post_m->update($id,$data);
			update_menu_url_nm('Post',$id,$data['post_name'],$data['slug_url']);


			if(isset($_FILES['post_img']['name']) && $_FILES['post_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/';
				$thumb_path = 'post/thumb/';

				$fileName = $_FILES['post_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->post_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($post_data->post_img !='')
					{
						$filenms = $org_path.$post_data->post_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->post_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['post_img'] = $fileName;

					$this->Post_m->update($id,$dd);
				}
			}


			if(isset($_FILES['bg_img']['name']) && $_FILES['bg_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'background/';
				$thumb_path = 'background/thumb/';

				$fileName = $_FILES['bg_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->bg_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($post_data->bg_img !='')
					{
						$filenms = $org_path.$post_data->bg_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->bg_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['bg_img'] = $fileName;

					$this->Post_m->update($id,$dd);
				}
			}		

			if($upd)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_product/'.$id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Product';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Edit Product</li>';
		
		$this->data['sub_view']='admin/subview/edit_product';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_desc($id)
	{
		$this->data['all_data']= $post_data = $this->Post_m->get($id);

		$where = array(
			   			'id' => $id
						);
				
		$this->db->where($where);
		$this->db->select('full_desc');
		$q = $this->db->get('post');

		$this->data['desc']  = $desc = $q->row();

		//print_result($desc);exit;
		$this->data['prd_det']  = $prd_det = $this->db->query("SELECT post_name,
			 														  (SELECT cat_name FROM category where id = P.cat_id ) as `Category_Name`,	
			 														  (SELECT cat_name FROM category where id = P.subcat_id ) as `Subcategory_Name`	
																	  FROM post P WHERE id = $id")->row();
		if($_POST)
		{
			$data = $_POST;	

			$upd = $this->db->query("UPDATE post SET full_desc = '".$data['full_desc']."' WHERE id = $id");		
			
			if($upd)
			{
				$this->session->set_flashdata('success','Record Updated Successfully.');	
			}			
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_desc/'.$id),'refresh');			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Description';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Edit Description</li>';
		
		$this->data['sub_view']='admin/subview/edit_desc';
		$this->load->view('admin/_master',$this->data);
	}	

	public function edit_seo($id)
	{
		$this->data['all_data']= $post_data = $this->Post_m->get($id);

		$where = array(
			   			'post_id' => $id
						);
				
		$this->db->where($where);
		$q = $this->db->get('post_meta');		
		$this->data['meta']  = $meta = $q->row();
		
		if($_POST)
		{
			$data = $_POST;						

			// SEO CONTENT ENTRY
			if($data['meta_title'] !='' || $data['meta_key'] !='' || $data['meta_desc'] !='' || $data['extra_meta'] !='' || $data['canonical_code'] !='')
			{
				$meta_array = array();
				
				$meta_array['meta_title'] = ($data['meta_title'] !='')?$data['meta_title']:Null;
				$meta_array['meta_key'] = ($data['meta_key'] !='')?$data['meta_key']:Null;
				$meta_array['meta_desc'] = ($data['meta_desc'] !='')?$data['meta_desc']:Null;
				$meta_array['extra_meta'] = ($data['extra_meta'] !='')?$data['extra_meta']:Null;
				$meta_array['canonical_code'] = ($data['canonical_code'] !='')?$data['canonical_code']:Null;
				$meta_array['created_on'] = date('Y-m-d H:i:s');	
				$meta_array['created_by'] = $this->session->userdata('user_id');
				$meta_array['post_id'] = $id;				
			}	
				
				if(is_array($meta) && sizeof($meta) == 0) 	
				{
					$upd = $this->db->insert('post_meta',$meta_array);
					$this->session->set_flashdata('success','Record Updated Successfully.');
				}
				else if(is_array($meta) && sizeof($meta) > 0)
				{
					$this->db->where('post_id', $id);
					$upd = $this->db->update('post_meta',$meta_array);
					$this->session->set_flashdata('success','Record Updated Successfully.');	
					
				}
				
				redirect(base_url('admin/edit_seo/'.$id),'refresh');			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit SEO';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Edit SEO</li>';
		
		$this->data['sub_view']='admin/subview/edit_seo';
		$this->load->view('admin/_master',$this->data);
	}

	public function product()
	{	
		$where = array(
			 			'del_status' => 0,
			   			'post_type' => 'Product'
						);				
		$this->db->where($where);
		$this->db->order_by('created_on','Desc');	 
		$q = $this->db->get('post');			

		$this->data['productlist'] = $productlist = $q->result();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Product List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Product List</li>';
		
		$this->data['sub_view']='admin/subview/productlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function gallery()
	{
		//$this->data['gallery'] = $gallery = $this->Gallery_m->GetAll();		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Image Gallery';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Gallery</li>
            						  <li class="active">Image Gallery</li>';
		$this->data['sub_view']='admin/subview/imagegallery';
		$this->load->view('admin/_master',$this->data);
	}

	public function imgtag($img_tag,$id,$tbl_nm)
	{
		if(isset($img_tag) && isset($id) && isset($tbl_nm))
		{
			$img_tag = urldecode($img_tag);

			$this->db->set('img_tag', $img_tag);
			$this->db->where('id', $id);
			$q = $this->db->update($tbl_nm);

			//$q = $this->db->query("UPDATE $tbl_nm SET img_tag = '".$img_tag."' WHERE id = '".$id."'");

			if($q)
				$data = 1;
			else		
				$data = 0;
		}
		else
			$data = 0;

		echo $data;
	}

	public function sequence_gallery($sequence_no,$id,$tbl_nm)
	{
		if(isset($sequence_no) && isset($id) && isset($tbl_nm))
		{
			$this->db->set('sequence', $sequence_no);
			$this->db->where('id', $id);
			$q = $this->db->update($tbl_nm);

			//$q = $this->db->query("UPDATE $tbl_nm SET sequence = '".$sequence_no."' WHERE id = '".$id."'");

			if($q)
				$data = 1;
			else		
				$data = 0;
		}
		else
			$data = 0;

		echo $data;
	}

	public function delete_gallery($post_id,$id)
	{
		$last_url = $_SERVER['HTTP_REFERER'];

		if(isset($post_id) && isset($id))
		{
			$where = array('post_id'=>$post_id,'id'=> $id);
			$this->db->where($where);
			$this->db->select('gallery_img');
			$q = $this->db->get('post_gallery');

			$d = $q->row();

			if($d->gallery_img !='')
			{
				$img_path = 'gallery_img/'.$d->gallery_img;

				if(file_exists($img_path))
				{
					unlink($img_path);
				}
			}

			$this->db->where(array('post_id'=> $post_id,'id' => $id));
			$q = $this->db->delete('post_gallery');	

			//$q = $this->db->query("DELETE FROM post_gallery WHERE post_id = '".$post_id."' AND id = '".$id."'");

			$d = $this->db->affected_rows();

			if($d == 1)
				$this->session->set_flashdata('success','Record Deleted Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
		}
		   redirect(($last_url),'refresh');		
		
	}

	public function set_cover_img($val,$id,$tbl_nm)
	{
		if(isset($val) && isset($id) && isset($tbl_nm))
		{
			$q1 = $this->db->query("UPDATE $tbl_nm SET is_first = 0 WHERE id != '".$id."'");
			$q = $this->db->query("UPDATE $tbl_nm SET is_first = '".$val."' WHERE id = '".$id."'");


			if($q)
				$data = 1;
			else		
				$data = 0;
		}
		else
			$data = 0;

		echo $data; exit;
	}

	public function t_product()
	{	
		$where = array('del_status' => 1);
		$this->db->order_by('id','Desc');	 
		$this->db->where($where);
		$q = $this->db->get('post');		

		$this->data['productlist'] = $q->result();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Product List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Trash Product List</li>';

		$this->data['sub_view']='admin/subview/t_productlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_ncategory()
	{
		$where = array('del_status'=>0,'parent_id'=>0,'post_type'=>'News');
		$this->db->where($where);
		$q = $this->db->get('category');

		$this->data['category'] = $category = $q->result();

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);

			//print_result($data); exit();
			$data['post_type'] = 'News';
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			#	print_result($data); exit();
			$r = $this->Category_m->insert($data);
			$insert_id = $this->db->insert_id();

			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))		
			{	
				$org_path = 'background/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['bg_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);
				
				$dd['bg_img'] = $fileName;

				$this->Category_m->update($insert_id,$dd);
			}
			
			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_ncategory/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Product Category';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Product</li>
            						  <li class="active">Add Product Category</li>';
		
		$this->data['sub_view']='admin/subview/add_ncategory';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_ncategory($id)
	{
		$this->data['all_data']= $page_data = $this->Category_m->get($id);

		$this->data['category'] = $category = $this->Category_m->get_many_by(array('del_status'=>0,'parent_id'=>0,'post_type'=>'News'));

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Category_m->update($id,$data);

			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'background/';

				$fileName = $_FILES['bg_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $page_data->bg_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $page_data->partner_img; exit;
					if($page_data->bg_img !='')
					{
						$filenms = $org_path.$page_data->bg_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}						
					}					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['bg_img'] = $fileName;
					$this->Category_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_ncategory/'.$id),'refresh');
			
		}		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit News Category';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Edit News Category</li>';
		
		$this->data['sub_view']='admin/subview/edit_ncategory';
		$this->load->view('admin/_master',$this->data);
	}

	public function ncategory()
	{	
		$where = array('del_status'=>0,'post_type'=>'News');
		$this->db->where($where);
		$q = $this->db->get('category');		

		$this->data['category'] = $category = $q->result();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'News Category List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">News Category List</li>';

		$this->data['sub_view']='admin/subview/ncategorylist';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_news()
	{
		$this->data['category'] = $category = $this->Category_m->get_many_by(array('del_status'=>0,'parent_id'=>0,'post_type'=>'News'));

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);

			unset($data['x2']);
			unset($data['y2']);
			unset($data['w2']);
			unset($data['h2']);		

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data);exit;
			

			if($data['post_name'] !='' && $data['slug_url'] !='' || $data['cat_id'] !=''  || $data['post_type'] !=''  || $data['sml_desc'] !=''  || $data['posted_by'] !='' || $data['full_desc'] !='' )
			{
				$post_array = array();

				$post_array['post_type'] = ($data['post_type'] !='')?$data['post_type']:Null;
				$post_array['post_name'] = ($data['post_name'] !='')?$data['post_name']:Null;
				$post_array['slug_url'] = ($data['slug_url'] !='')?rtrim($data['slug_url'],'-'):Null;
				$post_array['cat_id'] = ($data['cat_id'] !='')?$data['cat_id']:0;
				$post_array['posted_by'] = ($data['posted_by'] !='')?$data['posted_by']:'Admin';
				$post_array['posted_on'] = ($data['posted_on'] !='')?date('Y-m-d',strtotime($data['posted_on'])):date('Y-m-d');
				$post_array['sml_desc'] = ($data['sml_desc'] !='')?$data['sml_desc']:Null;
				$post_array['full_desc'] = ($data['full_desc'] !='')?$data['full_desc']:Null;
				$post_array['created_on'] = date('Y-m-d H:i:s');	
				$post_array['created_by'] = $this->session->userdata('user_id');

				$this->db->insert('post',$post_array);
				$insert_id = $this->db->insert_id();					
			}			


			if(isset($_FILES['post_img']['name']) && !empty($_FILES['post_img']['name']))						
			{	
				$org_path = 'post/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'post/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['post_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('post/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['post_img'] = $fileName;

				$this->Post_m->update($insert_id,$dd);
			}		

			if(isset($_FILES['news_dtls_bnr']['name']) && !empty($_FILES['news_dtls_bnr']['name']))						
			{	
				$org_path = 'post/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'post/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['news_dtls_bnr']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['news_dtls_bnr']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('post/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['news_dtls_bnr'] = $fileName;

				$this->Post_m->update($insert_id,$dd);
			}

			if(isset($_FILES['bg_img']['name']) && !empty($_FILES['bg_img']['name']))									
			{	
				$org_path = 'background/';

				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				
				$fileName = $_FILES['bg_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

				
				$dd['bg_img'] = $fileName;

				$this->Post_m->update($insert_id,$dd);
			}	

			// SEO CONTENT ENTRY
			if($data['meta_title'] !='' || $data['meta_key'] !='' || $data['meta_desc'] !='' || $data['extra_meta'] !='' || $data['canonical_code'] !='')
			{
				$meta_array = array();

				$meta_array['post_id'] = $insert_id;
				$meta_array['meta_title'] = ($data['meta_title'] !='')?$data['meta_title']:Null;
				$meta_array['meta_key'] = ($data['meta_key'] !='')?$data['meta_key']:Null;
				$meta_array['meta_desc'] = ($data['meta_desc'] !='')?$data['meta_desc']:Null;
				$meta_array['extra_meta'] = ($data['extra_meta'] !='')?$data['extra_meta']:Null;
				$meta_array['canonical_code'] = ($data['canonical_code'] !='')?$data['canonical_code']:Null;
				$meta_array['created_on'] = date('Y-m-d H:i:s');	
				$meta_array['created_by'] = $this->session->userdata('user_id');	

				$qq = $this->db->query("SELECT post_id FROM post_meta WHERE post_id = $insert_id")->row();

				if(countz($qq) > 0)
				{
					$this->db->where('post_id', $insert_id);
					$this->db->update('post_meta', $meta_array);
				}
				else
				{
					$this->db->insert('post_meta',$meta_array);		
				}				
			}			

			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_news/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add News';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Add News</li>';
		
		$this->data['sub_view']='admin/subview/add_news';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_news($id)
	{
		$this->data['all_data']= $post_data = $this->Post_m->get($id);
		$this->data['category'] = $category = $this->Category_m->get_many_by(array('del_status'=>0,'parent_id'=>0));

		$where = array('post_id'=>$id);
		$this->db->where($where);
		$q = $this->db->get('post_meta');		

		$this->data['post_meta'] = $post_meta = $q->row();

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			unset($data['x1']);
			unset($data['y1']);
			unset($data['w1']);
			unset($data['h1']);	

			unset($data['x2']);
			unset($data['y2']);
			unset($data['w2']);
			unset($data['h2']);		

			unset($data['news_dtls_bnr']);
			unset($data['bg_img']);
			unset($data['post_img']);


			if($data['post_name'] !='' && $data['slug_url'] !='' || $data['cat_id'] !=''  || $data['post_type'] !=''  || $data['sml_desc'] !=''  || $data['posted_by'] !='' || $data['full_desc'] !='' )
			{
				$post_array = array();

				$post_array['post_type'] = 'News';
				$post_array['post_name'] = ($data['post_name'] !='')?$data['post_name']:Null;
				$post_array['slug_url'] = ($data['slug_url'] !='')?rtrim($data['slug_url'],'-'):Null;
				$post_array['cat_id'] = ($data['cat_id'] !='')?$data['cat_id']:0;
				$post_array['posted_by'] = ($data['posted_by'] !='')?$data['posted_by']:'Admin';
				$post_array['posted_on'] = ($data['posted_on'] !='')?date('Y-m-d',strtotime($data['posted_on'])):date('Y-m-d');
				$post_array['sml_desc'] = ($data['sml_desc'] !='')?$data['sml_desc']:Null;
				$post_array['full_desc'] = ($data['full_desc'] !='')?$data['full_desc']:Null;
				$post_array['modified_on'] = date('Y-m-d H:i:s');	
				$post_array['created_by'] = $this->session->userdata('user_id');

				$this->db->where('id', $id);
				$r = $this->db->update('post',$post_array);
				
			}

			// SEO CONTENT ENTRY
			/*if($data['meta_title'] !='' || $data['meta_key'] !='' || $data['meta_desc'] !='' || $data['extra_meta'] !='' || $data['canonical_code'] !='')
			{*/
				$meta_array = array();

				$meta_array['post_id'] = $id;
				$meta_array['meta_title'] = ($data['meta_title'] !='')?$data['meta_title']:Null;
				$meta_array['meta_key'] = ($data['meta_key'] !='')?$data['meta_key']:Null;
				$meta_array['meta_desc'] = ($data['meta_desc'] !='')?$data['meta_desc']:Null;
				$meta_array['extra_meta'] = ($data['extra_meta'] !='')?$data['extra_meta']:Null;
				$meta_array['canonical_code'] = ($data['canonical_code'] !='')?$data['canonical_code']:Null;
				$meta_array['modified_on'] = date('Y-m-d H:i:s');	
				$meta_array['created_by'] = $this->session->userdata('user_id');	

				//print_result($meta_array); exit;

				$qq = $this->db->query("SELECT post_id FROM post_meta WHERE post_id = $id")->row();

				if(countz($qq) > 0)
				{
					$this->db->where('post_id', $id);
					$this->db->update('post_meta', $meta_array);
				}
				else
				{
					$this->db->insert('post_meta',$meta_array);		
				}				
		//	}
			

			if(isset($_FILES['post_img']['name']) && $_FILES['post_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/';
				$thumb_path = 'post/thumb/';

				$fileName = $_FILES['post_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->post_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($post_data->post_img !='')
					{
						$filenms = $org_path.$post_data->post_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->post_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['post_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['post_img'] = $fileName;

					$this->Post_m->update($id,$dd);
				}
			}

			if(isset($_FILES['news_dtls_bnr']['name']) && $_FILES['news_dtls_bnr']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'post/';
				$thumb_path = 'post/thumb/';

				$fileName = $_FILES['news_dtls_bnr']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->news_dtls_bnr; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($post_data->news_dtls_bnr !='')
					{
						$filenms = $org_path.$post_data->news_dtls_bnr; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->news_dtls_bnr; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['news_dtls_bnr']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['news_dtls_bnr'] = $fileName;

					$this->Post_m->update($id,$dd);
				}
			}

			if(isset($_FILES['bg_img']['name']) && $_FILES['bg_img']['name'] !='')		
			{	
				//print_result($_FILES); exit;
				$org_path = 'background/';
				$thumb_path = 'background/thumb/';

				$fileName = $_FILES['bg_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->bg_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->post_img; exit;
					if($post_data->bg_img !='')
					{
						$filenms = $org_path.$post_data->bg_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->bg_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bg_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['bg_img'] = $fileName;

					$this->Post_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_news/'.$id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit News';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Edit News</li>';
		
		$this->data['sub_view']='admin/subview/edit_news';
		$this->load->view('admin/_master',$this->data);
	}

	public function newslist()
	{	
		$where = array('del_status'=>0,'post_type'=>'News');
		$this->db->where($where);
		$q = $this->db->get('post');		

		$this->data['productlist'] = $productlist = $q->result();

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'News List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">News List</li>';

		$this->data['sub_view']='admin/subview/newslist';
		$this->load->view('admin/_master',$this->data);
	}

	public function t_news()
	{	
		$where = array('del_status'=>1,'post_type'=>'News');
		$this->db->where($where);
		$q = $this->db->get('post');	

		$this->data['productlist'] = $productlist = $q->result();

		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Product List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Trash News List</li>';

		$this->data['sub_view']='admin/subview/t_newslist';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_partners()
	{
		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);			

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			#	print_result($data); exit();
			$this->Partners_m->insert($data);
			$insert_id = $this->db->insert_id();

			if(isset($_FILES['partner_img']['name']) && !empty($_FILES['partner_img']['name']))		
			{	
				$org_path = 'partners/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'partners/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['partner_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['partner_img']['tmp_name'],$org_path.$fileName);

				if($extension !='webp')
				{
					make_thumb(base_url('banner_img/').$fileName, $thumb_path, 100);				
				}				

				$data['partner_img'] = $fileName;

				$this->Partners_m->update($insert_id,$data);
			}

			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_partners/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Partners';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Partners</li>
            						  <li class="active">Add Partners</li>';
		
		$this->data['sub_view']='admin/subview/add_partners';
		$this->load->view('admin/_master',$this->data);
	}

	public function edit_partners($id)
	{

		$this->data['all_data']= $post_data = $this->Partners_m->get($id);

		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	
			//print_result($data);exit;

			unset($data['partner_img']);

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Partners_m->update($id,$data);

			if(isset($_FILES['partner_img']['name']) && !empty($_FILES['partner_img']['name']))		
			{	
				//print_result($_FILES); exit;
				$org_path = 'partners/';
				$thumb_path = 'partners/thumb/';

				$fileName = $_FILES['partner_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->partner_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->partner_img; exit;
					if($post_data->partner_img !='')
					{
						$filenms = $org_path.$post_data->partner_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->partner_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['partner_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['partner_img'],$fileName,$org_path,$thumb_path);

					$dd['partner_img'] = $fileName;

					$this->Partners_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_partners/'.$id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Partners';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Partners</li>
            						  <li class="active">Edit Partners</li>';
		
		$this->data['sub_view']='admin/subview/edit_partners';
		$this->load->view('admin/_master',$this->data);
	}

	public function partners()
	{	
		$where = array('del_status'=>0);
		$this->db->where($where);
		$q = $this->db->get('partners');

		$this->data['partners'] = $partners = $q->result();		

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Partners';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Partners</li>
            						  <li class="active">Partners List</li>';

		$this->data['sub_view']='admin/subview/partners';
		$this->load->view('admin/_master',$this->data);
	}

	public function t_partners()
	{	
		$where = array('del_status'=>1);
		$this->db->where($where);
		$q = $this->db->get('partners');

		$this->data['partners'] = $q->result();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Partners List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>News</li>
            						  <li class="active">Trash Partners List</li>';

		$this->data['sub_view']='admin/subview/t_partners';
		$this->load->view('admin/_master',$this->data);
	}

	
	public function upload_gallery()
	{
		if(isset($_FILES))
		{
			// Count total files
			$countfiles = count($_FILES['files']['name']);

			// Upload directory
			$upload_location = 'gallery_img/';

			// To store uploaded files path
			$files_arr = array();

			// Loop all files
			for($index = 0;$index < $countfiles;$index++)
			{

				// File name
				$filename = $_FILES['files']['name'][$index];

				// Get extension
			    $ext = pathinfo($filename, PATHINFO_EXTENSION);

			    // Valid image extension
			    $valid_ext = array("png","jpeg","jpg");

			    // Check extension
			    if(in_array($ext, $valid_ext)){

			    	// File path
			    	$path = $upload_location.$filename;

			        // Upload file
					if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
						$files_arr[] = $path;
					}
			    }
						   	
			}

			if(isset($files_arr))
			{
				$data = 1;
			}
			else
			{
				$data = 0;
			}

			echo $data;
	  	}
	}

	public function upload_img_gallery()
	{
		//print_result($_FILES); exit;
		if(isset($_FILES))
		{
			// Count total files
			$countfiles = count($_FILES['files']['name']);

			// Upload directory
			$upload_location = 'gallery_img/';

			// To store uploaded files path
			$files_arr = array();

			$i = 0;
			$gl_array = array();
			$cat_id = $this->uri->segment(3);

			if($cat_id == 1)
			{
				$cat_name = 'Temple';
			}
			else if($cat_id == 2)
			{
				$cat_name = 'Construction';
			}
			else if($cat_id == 3)
			{
				$cat_name = 'Other';
			}

			$created_on = date('Y-m-d H:i:s');
			$created_by = $this->session->userdata('user_id');

			//exit;

			// Loop all files
			for($index = 0;$index < $countfiles;$index++)
			{
				// File name
				$filename = $_FILES['files']['name'][$index];

				$ext = strrchr($filename,'.');

				$base_filename = basename($filename,$ext); 

				$new_filename = rand().'_'.date('YmdHis').$ext;		
				
				// Get extension
			    $ext = pathinfo($filename, PATHINFO_EXTENSION);

			    // Valid image extension
			    $valid_ext = array("png","jpeg","jpg","webp");

			    // Check extension
			    if(in_array($ext, $valid_ext)){

			    	// File path
			    	$path = $upload_location.$new_filename;

			        // Upload file
					if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path))
					{
						$filename = $new_filename;
						$thumb_width = 283;
						$thumb_height = 157;
						$upload_dir = $upload_location;
						$upload_dir_thumbs = $upload_dir.'thumb/';

						createThumbnail($filename, $thumb_width, $thumb_height, $upload_dir, $upload_dir_thumbs);

						$thumb_width1 = 120;
						$thumb_height1 = 80;
						$upload_dir1 = $upload_location;
						$upload_dir_thumbs1 = $upload_dir1.'thumb1/';

						createThumbnail($filename, $thumb_width1, $thumb_height1, $upload_dir1, $upload_dir_thumbs1);

						$files_arr[] = $path;
					}
			    }

			    $gl_array[$i]['cat_id'] = $cat_id;
			    $gl_array[$i]['cat_name'] = $cat_name;
			    $gl_array[$i]['gallery_img'] = $new_filename;
			    $gl_array[$i]['status'] = 1;
			    $gl_array[$i]['created_on'] = $created_on;
			    $gl_array[$i]['created_by'] = $created_by;

			    $i++;						   	
			}

			//print_result($gl_array);exit;

			$rr = $this->db->insert_batch('img_gallery',$gl_array);

			if(isset($files_arr))
			{
				$data = 1;
			}
			else
			{
				$data = 0;
			}

			echo $data;
	  	}
	}		

	public function add_banner()
	{
		if($_POST)
		{
			$data = $_POST;

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);			

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');	

			$this->Banner_m->insert($data);
			$insert_id = $this->db->insert_id();
			
			if(isset($_FILES['bnr_img']['name']) && !empty($_FILES['bnr_img']['name']))		
			{	
				$org_path = 'banner_img/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'banner_img/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['bnr_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'-1'.'.'.$extension; 
			    }

				move_uploaded_file($_FILES['bnr_img']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('auth_img/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['bnr_img'] = $fileName;

				$this->Banner_m->update($insert_id,$dd);
			}		

			if($insert_id)
				$this->session->set_flashdata('success','Printing added Successfully');
			else
				$this->session->set_flashdata('error','Error in processing request');
			
			redirect(base_url('admin/edit_banner/'.$insert_id),'refresh');	
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Banner';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Banner</li>
            						  <li class="active">Add Banner</li>';

		$this->data['sub_view']='admin/subview/add_banner';
		$this->load->view('admin/_master',$this->data);
	}	

	public function edit_banner($id)
	{	
		$this->data['all_data']= $bnr_listing = $this->Banner_m->get($id);

		if($_POST)
		{	
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);			

			unset($data['bnr_img']);

			$r = $this->Banner_m->update($id,$data);
		
			
			if(isset($_FILES['bnr_img']['name']) && !empty($_FILES['bnr_img']['name']))		
			{	
				$org_path = 'banner_img/';
				$thumb_path = 'banner_img/thumb/';

				$fileName = $_FILES['bnr_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $bnr_listing->bnr_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					if($bnr_listing->bnr_img !='')
					{
						$filenms = $org_path.$bnr_listing->bnr_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$bnr_listing->bnr_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'-1'.'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['bnr_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['auth_img'],$fileName,$org_path,$thumb_path);

					$dd['bnr_img'] = $fileName;

					$this->Banner_m->update($id,$dd);
				}
			}						

			if($r)
				$this->session->set_flashdata('success','Record Updated Successfully');
			else
				$this->session->set_flashdata('error','Error in processing your request');
			
			redirect(base_url('admin/edit_banner/'.$id),'refresh');
		}	
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Banner';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Banner</li>
            						  <li class="active">Edit Banner</li>';
            						  		
		$this->data['sub_view']='admin/subview/edit_banner';
		$this->load->view('admin/_master',$this->data);
	}	

	public function banner()
	{
		$where = array('del_status'=>0);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('banner');

		$this->data['banner'] = $banner = $q->result();	

		//print_result($banner); exit;

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Banner List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Banner</li>
            						  <li class="active">Banner List</li>';

		$this->data['sub_view']='admin/subview/bannerlist';
		$this->load->view('admin/_master',$this->data);
	}

	public function get_banner_image()
	{
		$id = $_REQUEST['ids'];

		$q = $this->Banner_m->get($id);
		$str =  '<img src="'.base_url('banner_img/').$q->bnr_img.'" width="800">';
		echo $str;		
	}

	public function get_donation_image()
	{
		$id = $_REQUEST['ids'];

		$q = $this->Donation_m->get($id);
		$str =  '<img src="'.base_url('post/donation/').$q->img.'" width="800">';
		echo $str;		
	}

	public function get_gallery_image()
	{
		$id = $_REQUEST['ids'];

		$q = $this->Gallery_m->get($id);
		$str =  '<img src="'.base_url('gallery_img/').$q->gallery_img.'" width="800">';
		echo $str;		
	}

	public function t_banner()
	{
		$where = array('del_status'=>1);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('banner');	

		$this->data['banner'] = $q->result();	

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Banner List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Banner</li>
            						  <li class="active">Trash Banner List</li>';

		$this->data['sub_view'] = 'admin/subview/t_bannerlist';
		$this->load->view('admin/_master',$this->data);
	}	

	public function add_testimonial()
	{
		if($_POST)
		{
			$data = $_POST;	

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);		

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			#	print_result($data); exit();
			$r = $this->Testimonial_m->insert($data);
			$insert_id = $this->db->insert_id();


			if(isset($_FILES['auth_img']['name']) && !empty($_FILES['auth_img']['name']))				
			{	
				$org_path = 'testimonial_img/';
				if(!is_dir($org_path))
				{
           			 mkdir($org_path,0755,true);
				}
				$thumb_path = 'testimonial_img/thumb/';
				if(!is_dir($org_path))
				{
					mkdir($thumb_path,0755,true);
				}

				$fileName = $_FILES['auth_img']['name'];

				$nm_ext = explode('.', $fileName);              
			    $extension = end($nm_ext);

			    //check any duplicate file exist
			    $img_path = $org_path.$fileName;

			    if(file_exists($img_path))
			    {
			        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension; 
			    }

				move_uploaded_file($_FILES['auth_img']['tmp_name'],$org_path.$fileName);

				/*if($extension !='webp')
				{
					make_thumb(base_url('auth_img/').$fileName, $thumb_path, 100);				
				}*/				

				$dd['auth_img'] = $fileName;

				$this->Testimonial_m->update($insert_id,$dd);
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_testimonial/'.$insert_id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Testimonial';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Testimonial</li>
            						  <li class="active">Add Testimonial</li>';

		$this->data['sub_view']='admin/subview/add_testimonial';
		$this->load->view('admin/_master',$this->data);
	}	

	public function edit_testimonial($id)
	{
		$this->data['all_data']= $post_data = $this->Testimonial_m->get($id);

		if($_POST)
		{
			$data = $_POST;

			//print_result($data);exit;

			unset($data['x']);
			unset($data['y']);
			unset($data['w']);
			unset($data['h']);	

			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Testimonial_m->update($id,$data);

			if(isset($_FILES['auth_img']['name']) && !empty($_FILES['auth_img']['name']))	
			{	
				//print_result($_FILES); exit;
				$org_path = 'testimonial_img/';
				$thumb_path = 'testimonial_img/thumb/';

				$fileName = $_FILES['auth_img']['name'];

				$current_imagename = $fileName; 	
			 	$dbimage = $post_data->auth_img; 

			 	if($current_imagename == $dbimage)
				{					
					//Do Nothing					
				}
				else
				{
					//echo $post_data->partner_img; exit;
					if($post_data->auth_img !='')
					{
						$filenms = $org_path.$post_data->auth_img; 

						if(file_exists($filenms))
						{						
							unlink($filenms);				
						}

						$thumb_filenms = $thumb_path.$post_data->auth_img; 

						if(file_exists($thumb_filenms))
						{						
							unlink($thumb_filenms);				
						}
					}
					

					$nm_ext = explode('.', $fileName);              
				    $extension = end($nm_ext);

				    //check any duplicate file exist
				    $img_path = $org_path.$fileName;

				    if(file_exists($img_path))
				    {
				        $fileName = $nm_ext[0].'_'.date('YmdHis').'.'.$extension;  
				    }

				    move_uploaded_file($_FILES['auth_img']['tmp_name'],$org_path.$fileName);

					//upload_img($_FILES['auth_img'],$fileName,$org_path,$thumb_path);

					$dd['auth_img'] = $fileName;

					$r = $this->Testimonial_m->update($id,$dd);
				}
			}			

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_testimonial/'.$id),'refresh');
			
		}
		
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit Testimonial';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Testimonial</li>
            						  <li class="active">Edit Testimonial</li>';
            						  		
		$this->data['sub_view']='admin/subview/edit_testimonial';
		$this->load->view('admin/_master',$this->data);
	}	

	public function testimonial()
	{	
		$where = array('del_status'=>0);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('testimonial');	

		$this->data['testimonials'] = $t = $q->result();	

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Testimonial List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Testimonial</li>
            						  <li class="active">Testimonial List</li>';

		$this->data['sub_view']='admin/subview/testimonial';
		$this->load->view('admin/_master',$this->data);
	}	

	public function t_testimonial()
	{	
		$where = array('del_status'=>1);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('testimonial');	

		$this->data['testimonials'] = $t = $q->result();	
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Trash Testimonial List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Testimonial</li>
            						  <li class="active">Trash Testimonial List</li>';

		$this->data['sub_view']='admin/subview/t_testimonial';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_faq()
	{
		if($_POST)
		{
			$data = $_POST;	

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$r = $this->Faq_m->insert($data);

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_faq/'.$r),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add FAQ';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>FAQ</li>
            						  <li class="active">Add FAQ</li>';

		$this->data['sub_view']='admin/subview/add_faq';
		$this->load->view('admin/_master',$this->data);
	}	

	public function edit_faq($id)
	{	
		$this->data['all_data'] = $faq = $this->Faq_m->get($id);

		if($_POST)
		{
			$data = $_POST;		
			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			//print_result($data); exit();
			$r = $this->Faq_m->update($id,$data);

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_faq/'.$id),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Edit FAQ';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>FAQ</li>
            						  <li class="active">Edit FAQ</li>';
            						  		
		$this->data['sub_view']='admin/subview/edit_faq';
		$this->load->view('admin/_master',$this->data);
	}	

	public function faq()
	{	
		$where = array('del_status'=>0);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('faq');

		$this->data['faq'] = $q->result();			

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'FAQ List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>FAQ</li>
            						  <li class="active">FAQ List</li>';
        
		$this->data['sub_view']='admin/subview/faq';
		$this->load->view('admin/_master',$this->data);
	}

	public function t_faq()
	{	
		$where = array('del_status'=>1);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('faq');

		$this->data['faqs'] = $faq = $q->result();	


		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'FAQ List';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>FAQ</li>
            						  <li class="active">Trash FAQ List</li>';
        
        $this->data['alldata'] = $m;	    						  		
		$this->data['sub_view']='admin/subview/t_faq';
		$this->load->view('admin/_master',$this->data);
	}

	public function trash_record()
	{	
		$last_url = $_SERVER['HTTP_REFERER'];

		$id = $this->uri->segment(4);
		$table = $this->uri->segment(3);

		$this->db->set('del_status', 1);
		$this->db->where('id', $id);
		$q = $this->db->update($table);

		//$q = $this->db->query("UPDATE $table set del_status = 1 where id = '".$id."'");

		$d = $this->db->affected_rows();

		if($d == 1)
			$this->session->set_flashdata('success','Record Moved To Trash.');
		else
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');

		redirect(($last_url),'refresh');		
	}

	public function restore_record()
	{	
		$last_url = $_SERVER['HTTP_REFERER'];

		$id = $this->uri->segment(4);
		$table = $this->uri->segment(3);

		$this->db->set('del_status', 0);
		$this->db->where('id', $id);
		$q = $this->db->update($table);

		//$q = $this->db->query("UPDATE $table set del_status = 0 where id = '".$id."'");

		$d = $this->db->affected_rows();

		if($d == 1)
			$this->session->set_flashdata('success','Record Has Restored.');
		else
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');

		redirect(($last_url),'refresh');		
	}

	public function delete_record()
	{	
		$last_url = $_SERVER['HTTP_REFERER'];

		$table = $this->uri->segment(3);
		$id = $this->uri->segment(4);	

		$chk = $this->TableFolder_m->get_all();	

		//print_result($chk);  exit;

		foreach ($chk as $k => $v) 
		{
			 if($table != $v->tbl_nm)
			 {
			 	continue;
			 }

			 if($table == $v->tbl_nm)
			 {
			 	 $field_nm =  json_decode($v->field_nm); 

			 	 foreach ($field_nm as $v1) 
			 	 {
			 	 	$where = array('id' => $id);
			 	 	$this->db->where($where);
			 	 	$this->db->select($v1);
			 	 	$dd = $this->db->get($table);
			 	 	// echo "SELECT $v1 FROM $table WHERE id = $id"; exit;
			 	 	 //$dd = $this->db->query("SELECT $v1 FROM $table WHERE id = $id")->row();	 	 	 


			 	 	 /*if($v->folder !='')
			 	 	 {
			 	 	 	$folder_nm =  json_decode($v->folder); 
			 	 	 	$folder_dir = $folder_nm[0].'/'.$dd->Field_Name; 

			 	 	 	 if (file_exists($folder_dir))  
						 {
							 unlink($folder_dir); 
						 }
			 	 	 }*/
			 	 	 
			 	 	/* if($v->thumb !='')
			 	 	 {
			 	 	 	$thumb_nm =  json_decode($v->thumb); 
			 	 	 	$thumb_dir = $folder_nm[0].'/'.$thumb_nm[0].'/'.$dd->bnr_img;

			 	 	 	if (file_exists($thumb_dir))  
						{
						   unlink($thumb_dir); 
						}  
			 	 	 }*/
			 	 }
			 }		 
		}

		$this->db->where('id', $id);
		$q = $this->db->delete($table);		
		
		//$q = $this->db->query("DELETE FROM $table where id = '".$id."'");

		$d = $this->db->affected_rows();

		if($d == 1)
			$this->session->set_flashdata('success','Record Has Permanently Deleted.');
		else
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');

		redirect(($last_url),'refresh');		
	}


	public function update_status()
	{
	//echo 11;exit;	
		$last_url = $_SERVER['HTTP_REFERER'];

		$id = $this->uri->segment(3);
		$table = $this->uri->segment(4);
		$data['status']  = $this->uri->segment(5);

		// $this->db->set('status', $data['status']);
		// $this->db->where('id', $id);
		// $q = $this->db->update($table);

		$q = $this->db->query("UPDATE $table SET status = '".$data['status']."' where id = '".$id."'");	

		if($q)
		{
			$this->session->set_flashdata('success','Record Updated Successfully.');
			redirect(($last_url),'refresh');
		}
		else
		{
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
		}

		//redirect(($last_url),'refresh');		
	}

	public function update_featured()
	{	
		$last_url = $_SERVER['HTTP_REFERER'];

		$id = $this->uri->segment(4);
		$table = $this->uri->segment(3);
		$is_featured  = $this->uri->segment(5);

		$this->db->set('is_featured', $is_featured);
		$this->db->where('id', $id);
		$q = $this->db->update($table);

		//$q = $this->db->query("UPDATE $table SET is_featured = '".$is_featured."' where id = '".$id."'");

		$d = $this->db->affected_rows();

		if($d == 1)
			$this->session->set_flashdata('success','Record Updated Successfully.');
		else
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');

		redirect(($last_url),'refresh');		
	}

	public function update_sequence()
	{
		$table = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$val = $this->uri->segment(5);

		$this->db->set('sequence', $val);
		$this->db->where('id', $id);
		$r = $this->db->update($table);

		//$r = $this->db->query("UPDATE ".$table." SET sequence='".$val."' WHERE id = $id");

		if($r)
			echo 1;
		else
			echo 0;
	}

	public function home_setting($id)
	{
		$this->data['all_data']= $sitemst = $this->Sitemaster_m->get($id);		
		if($_POST)
		{
			$data = $_POST;		
			//print_result($data); exit();
			$r = $this->Sitemaster_m->update($id,$data);

			//echo $this->db->affected_rows(); exit;

			if($r){			
				$this->session->set_flashdata('success','Record Updated Successfully.');
			}else{
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			}

			redirect(base_url('admin/home_setting/'.$id),'refresh');
			
		}
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Home Page Setting';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Site Master</li>
            						  <li class="active">Home Page Setting</li>';
            						  		
		$this->data['sub_view']='admin/subview/home_setting';
		$this->load->view('admin/_master',$this->data);
	}

	public function meta_setting($id)
	{
		$this->data['all_data']= $sitemst = $this->Sitemaster_m->get($id);		
		if($_POST)
		{
			$data = $_POST;		
			$r = $this->Sitemaster_m->update($id,$data);

			if($r){			
				$this->session->set_flashdata('success','Record Updated Successfully.');
			}else{
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			}

			redirect(base_url('admin/meta_setting/'.$id),'refresh');
			
		}
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Meta Tag Setting';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Site Settings</li>
            						  <li class="active">Meta Tag Setting</li>';
            						  		
		$this->data['sub_view']='admin/subview/meta_setting';
		$this->load->view('admin/_master',$this->data);
	}

	public function social_setting($id)
	{
		$this->data['all_data']= $sitemst = $this->Sitemaster_m->get($id);		
		if($_POST)
		{
			$data = $_POST;		
			//print_result($data); exit();
			$r = $this->Sitemaster_m->update($id,$data);

			//echo $this->db->affected_rows(); exit;

			if($r){			
				$this->session->set_flashdata('success','Record Updated Successfully.');
			}else{
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			}

			redirect(base_url('admin/social_setting/'.$id),'refresh');
			
		}
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Social Content Setting';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Site Setting</li>
            						  <li class="active">Social Content Setting</li>';
            						  		
		$this->data['sub_view']='admin/subview/social_setting';
		$this->load->view('admin/_master',$this->data);
	}

	public function menu($id = Null)
	{
		if(isset($_POST['btnlabel']))
		{
			$dd = $_POST;
			$dd['status'] = 1;
			unset($dd['btnlabel']);
			if($id == Null)
			{
				$r = $this->Mastermenu_m->insert($dd);
			}
			else
			{
				$this->db->set('menu_labelnm', $dd['menu_labelnm']);
				$this->db->where('id', $id);
				$r = $this->db->update('master_menu');
				//$r = $this->db->query("UPDATE master_menu SET menu_labelnm = '".$dd['menu_labelnm']."' WHERE id = $id");
				$r = $this->db->affected_rows();
			}	

			if($r)	
				$this->session->set_flashdata('success','Record Updated Successfully.');

			redirect(base_url('admin/menu'),'refresh');
		}

			if(isset($_POST['add_to_menu']))
			{
				$dd = $_POST;
				unset($dd['add_to_menu']);
				
				$q = $this->db->query("SELECT group_concat(menu_url) as menu_url FROM menu_n")->row();

				if(isset($_POST['page']))
				{
					if(is_array($_POST['page']) && sizeof($_POST['page'],1) > 0)
					{	
						foreach($_POST['page']  as $v)
						{				
						    //print_result($v);			    			
						    $array = explode(",",$v);
							$all_rows = '';							
							$i = 0;	
							$menu_ary = array();								

							//print_result($array);	
							foreach($array as  $v1)					
							{								
								$menu_name = explode('=>',$v1);	
     							$v1 = str_replace("=>","=",$v1);									  
								$all_rows .= ($v1!='')?$v1.",":$v1;
     							$i++;								
							}

							$all_rows = rtrim($all_rows,',');

							/*echo $all_rows;

							echo '<br>';*/

							$rc = $this->db->query("INSERT INTO menu_n SET master_menu_id = '".$_POST['master_menu_id']."',".$all_rows);	

							//echo $this->db->last_query();		
						}						
					}
			}	

						
			
			if(isset($_POST['category']))
			{
				if(is_array($_POST['category']) && sizeof($_POST['category']) > 0)
				{	
					foreach($_POST['category']  as $value)
					{				
					    $array = explode(",",$value);										
						
						$all_rows = '';		
												
						foreach($array as $value1)					
						{
							  $value1 = str_replace("=>","=",$value1);							  
							  $all_rows .= ($value1!='')?$value1.",":$value1;
						}	

						$all_rows = rtrim($all_rows,',');							
						
						$record12 = $this->db->query("INSERT INTO menu_n SET master_menu_id = '".$_POST['master_menu_id']."',".$all_rows);
					}	
				}
			}

			//exit;

			$this->session->set_flashdata('success','Record Updated Successfully.');
			redirect(base_url('admin/menu'),'refresh');	
		}

		$this->data['id'] =  '';
		if($id !='')
		{
			$where = array('id'=>$id);
			$this->db->where($where);
			$q = $this->db->get('master_menu');

			$this->data['idsdata'] = $v = $q->row();
			$this->data['id'] = $id;
		}

			$where = array('del_status'=>0, 'status' => 1);
			$this->db->where($where);
			$this->db->select('id,template_id,parent_pg,pg_name,slug_url');
			$qq = $this->db->get('page');

		$this->data['pages'] = $pages = $qq->result();

			$where = array('del_status'=>0, 'status' => 1,'parent_id' => 0,'post_type' => 'Product');
			$this->db->where($where);
			$this->db->select('id,parent_id,cat_name,slug_url');
			$this->db->order_by('sequence','asc');
			$qc = $this->db->get('category');

		$this->data['category'] = $category = $qc->result();

		$this->data['Mastermenu_list'] = $this->db->query("SELECT * FROM master_menu ORDER BY id ASC")->result();
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Menu Setting';	
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Menu</li>
            						  <li class="active">Menu Setting</li>';
		$this->data['sub_view']='admin/subview/menu';
		$this->load->view('admin/_master',$this->data);
	}

	public function add_page_meta()
	{
		if($_POST)
		{
			$data = $_POST;				
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');			

			$r = $this->Page_Meta_m->insert($data);
			$insert_id = $this->db->insert_id();						

			if($insert_id)	
				$this->session->set_flashdata('success','Record Updated Successfully.');
			else
				$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');
			
			redirect(base_url('admin/edit_page/'.$r),'refresh');
			
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Add Page';		
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">Add Page</li>';
		
		$this->data['sub_view']='admin/subview/add_page_meta';
		$this->load->view('admin/_master',$this->data);
	}

	public function page_meta()
	{	
		$where = array('del_status'=>0);
		$this->db->where($where);
		$this->db->order_by('id','Desc');
		$q = $this->db->get('page_meta');

		$this->data['pages'] = $pages = $q->result();	
		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'PageMeta List';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Pages</li>
            						  <li class="active">Page Meta List</li>';

		$this->data['sub_view'] = 'admin/subview/pagemetalist';
		$this->load->view('admin/_master',$this->data);
	}

	public function clear_data()
	{	
		if(isset($_SESSION['pg']))
			unset($_SESSION['pg']);
		if(isset($_SESSION['post_data']))
			unset($_SESSION['post_data']);			
		
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
	}

	public function request_form()
	{	

		if(isset($_POST['per_page']) && $_POST['per_page'] !='')
	 	    $this->session->set_userdata('pg',$_POST);
	    else
		    $this->data['limit'] = $limit = 10;

	    $pg = $this->session->userdata('pg');

	    if(isset($pg['per_page'])   && $pg['per_page']!='')
	    	$this->data['limit']= $limit =$pg['per_page'];

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
		$ext_qry = '';	

		//search by Form Name
		$this->data['form_name'] = '';
		$extqry = '';
		if(isset($post_data['form_name']) &&  $post_data['form_name'] !='')
		{
			$this->data['form_name'] = $form_name = $post_data['form_name'];				
			$extqry .=" AND form_name = '".$form_name."'";						
		}  


		//search by source
		if((isset($post_data['date_range']) && $post_data['date_range'] !='')) 
		{
			$this->data['date_range'] = $date_range = $post_data['date_range'];

			if(strpos($date_range,' - ') !== false)
			{
				$date_range = explode(' - ',$date_range);

				$extqry .= " AND added_on BETWEEN '".date('Y-m-d 00:00:00',strtotime($date_range[0]))."' AND '".date('Y-m-d 23:59:59',strtotime($date_range[1]))."'";
					
			}							 	
		}	

		if(isset($_GET['action']) && $_GET['action'] == 'exportreport')
		{
		    $qr = "SELECT * FROM contacts
				 		WHERE 1
					    $extqry 
						ORDER BY added_on Desc"; 

			$xx = $this->db->query($qr)->result_array();

			$kk = 1;
 			$ii = 0;
 			$result = array(); 

				if(is_array($xx) && count($xx)>0)
				{		 				
 				foreach ($xx as $k => $z)
 				{		
 					$decode = json_decode($z['request_data']);
                    $name = '';
                    $email = '';
                    $contact = '';

                    foreach($decode as $k => $v)
                    {
                       if($k == 'post_name')                 
                          $k = 'Product Name';               

                       if($k == 'submit-form')
                           continue;

                        $name .= ucfirst($k).': '.$v.'\n'; 
                    }  

				    $added_on = date('Y-m-d H:i:s',strtotime($z['added_on'])); 		
	      	 	    $result[$ii]['Sl No'] = $kk;
	      	 	    $result[$ii]['Created On'] = $added_on;			 				
	      	 	    $result[$ii]['Form Name'] = $z['form_name'];			 				
	 				$result[$ii]['Form Data'] = $str;			 				

	 				$kk++;	 				
	 				$ii++;
 				}	 

 				//print_result($result);exit;				
				$flnm = "Form_Request_".date('YmdHis');   
				$this->exportcsvdata1($result,$flnm);
		 	}
 		} 

		/*$where = array('status'=> 1);
		$this->db->where($where);*/
		/*$this->db->order_by('id','Desc');
		$q = $this->db->get('contacts');*/

		 $q = $this->db->query("SELECT * FROM contacts
				 		WHERE 1
					    $extqry 
						ORDER BY added_on Desc"); 

		$this->data['pages'] = $pages = $q->result();	

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Request Users';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Admin</li>
            						  <li class="active">Request Users</li>';

		$this->data['sub_view'] = 'admin/subview/request_form';
		$this->load->view('admin/_master',$this->data);
	}

	public function read_content()
	{
		$id = $_REQUEST['ids'];

		$this->db->set('status', '1');
		$this->db->where('id', $id);
		$upd = $this->db->update('contacts');

		if($upd)
		{
			$data = 1;
		}
		else
		{
			$data = 0;
		}

		echo $data;
	}

	public function get_form_data()
	{
		$id = $_REQUEST['ids'];

		$q = $this->Contacts_m->get($id);

		$data = $q->request_data;

		$str = '';

		if($data !='')
		{
			 $decode = json_decode($data);

			 foreach($decode as $k => $v)
			 {
			 	   if($k == 'post_name')
			 	   {
			 	   	  $k = 'Product Name';
			 	   }	

			 	   if($k == 'submit-form')
			 	   	   continue;

			 	   if($k == 'btn_enquiry')
			 	   	   continue;
	

			 	   $str .= ucfirst($k).': '.$v.'<br>'; 	
			 }
		}

		echo $str;
	}

	public function del_record()
	{	
		$last_url = $_SERVER['HTTP_REFERER'];

		$id = $this->uri->segment(4);
		$table = $this->uri->segment(3);

		$this->db->where('id', $id);
		$q = $this->db->delete($table);	

		if($d)
			$this->session->set_flashdata('success','Record Has Deleted Successfully.');
		else
			$this->session->set_flashdata('error','Error in processing request! Please try again after sometime.');

		redirect(($last_url),'refresh');		
	}

	 public function setpage()
	 {
	  	  if($_POST)
	  	  {
	         $file = 'assets/css/test.css';
	         //$file = '.htacess';

	         // Open the file to get existing content
	         $myfile  = fopen($file,'w+');
	         $current = $_POST["textdata"];
	         fwrite($myfile, $current);
	         fclose($myfile);
		  }   

	  	  //  $file = file_get_contents('.htaccess');
	  	  $file = file_get_contents('assets/css/test.css');
	  	  $this->data['FileData'] = $file;

	      //$this->data['map'] =  $map = directory_map('./assets/css/');

	  	  $this->data['sub_view'] = 'admin/subview/setpage';
		  $this->load->view('admin/_master',$this->data);
	 }

	 public function change_password()
	 {
		$id = $this->session->userdata('id');
		$inf = $this->db->query('SELECT usr_pwd,email FROM user_mst where id = "'.$id.'"')->row();

		if($_POST)
		{			
			$old_pass = md5($_POST['old_pwd']);	
			$new_pass = md5($_POST['pwd']);				

			if(trim($inf->usr_pwd) == trim($old_pass))
			{
				$data['usr_pwd']= $new_pass;
				$this->db->where('id', $id);
				$mx = $this->db->update('user_mst',$data);

				if($mx)
				{
					$url = base_url('members/login');
        			$txt = '';
					$txt .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<title>Hotel Email Template - Quickai</title>
								<style type="text/css">
								@media only screen and (max-width: 600px) {
								table[class="contenttable"] {
									width: 320px !important;
									border-width: 3px!important;
								}
								table[class="tablefull"] {
									width: 100% !important;
								}
								table[class="tablefull"] + table[class="tablefull"] td {
									padding-top: 0px !important;
								}
								table td[class="tablepadding"] {
									padding: 15px !important;
								}
								}
								</style>
								</head>
								<body style="margin:0; border: none; background:#f5f7f8">';

					$txt .= '<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
							  <tr>
							    <td align="center" valign="top"><table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family:Arial, Helvetica, sans-serif">
							        <tr>
							          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
							              <tbody>
							                <tr>
							                  <td width="100%" height="30">&nbsp;</td>
							                </tr>
							                <tr>
							                  <td valign="top" align="center">
							                     <a href="'.base_url().'">
							                       <img alt="" src="'.base_url('assets/img/t_logo.png').'" style="padding-bottom: 0; display: inline !important;">
							                     </a>
							                  </td>
							                </tr>
							                <tr>
							                  <td width="100%" height="30">&nbsp;</td>
							                </tr>
							                <tr>
							              </tbody>
							            </table>
							          </td>
							        </tr>
							        <tr>
							          <td class="tablepadding" style="border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;padding:25px 20px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
							              <tbody>
							                <tr>
							                  <td colspan="4" valign="top" style="font-size:14px; line-height:20px; padding-bottom:5px;">
							                    <span style="color:#000; font-size:13px; font-weight: bold;">Hi Admin,</span><br />
							                    <br />
							                    <span style="color:#333;display:inline-block">You password has Changed successfully.</span>
							                   </td>                 
							                </tr>   
							                <tr>
							                  <td>
							                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
							                      <tbody>
							                        <tr>
							                          <td class="tablepadding" align="center" style="font-size:14px; line-height:32px; padding:5px 20px 10px 5px;"> 
							                            <a href="'.$url.'" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:14px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">Click Here To Login</a>
							                          </td>
							                        </tr>
							                        <tr>
							                       </tr>
							                      </tbody>
							                    </table>
							                  </td>
							                </tr>     
							                
							                <tr>
							                  <td>
							                   <br> <span style="color: #000; font-weight: 400; font-size: 13px;">Regards,</span><br>
							                    <span style="color: #000; font-weight: bold">Team Hirelay</span>
							                  </td>
							                </tr>               
							              </tbody>
							            </table>
							          </td>
							        </tr>
							      </table>
							    </td>
							  </tr>  
							</table>
							</body>
							</html>';		

					//email sending process...
					$this->sendemailv3($inf->email,'Password Changed Successfully',$txt);
					$this->session->set_flashdata('success','Password Changed Successfully');
				}
				else
					$this->session->set_flashdata('error','Error in process');				
			}
			else
			{
				$this->session->set_flashdata('error','Wrong Old Password');
			}
			redirect(base_url('admin/change_password'),'refresh');
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Change Password';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Admin</li>
            						  <li class="active">Change Password</li>';

		$this->data['sub_view']='admin/subview/changepassword';
		$this->load->view('admin/_master',$this->data);
	}

	public function check_pwd()
	{
	  	$pwd = $_GET['key'];		
		$pwds = rawurldecode($pwd);  
		$pwds = md5($pwds);

		$q = $this->db->query("SELECT id FROM user_mst WHERE usr_pwd = '".$pwds."'")->row();

		if(isset($q->id) && $q->id !='')
			$data = 1;
		else
			$data = 0;

		echo $data;
	}	

	public function check_previous()
	{
	  	$pwd = $_GET['key'];		
		$email = rawurldecode($pwd);  

		$q = $this->db->query("SELECT id FROM user_mst WHERE 1 AND email = '".$email."'")->row();

		if(isset($q->id) && $q->id !='')
			$data = 0;
		else
			$data = 1;

		echo $data;
	}	

	 public function change_email()
	 {
		$id = $this->session->userdata('id');
		$inf = $this->db->query('SELECT usr_pwd,email FROM user_mst where id = "'.$id.'"')->row();

		if($_POST)
		{			
			$sec_email = $_POST['sec_email'];
			
			$key = md5(sha1(time()));
			$data_ary['rand_key'] = $key;
			$data_ary['sec_email'] = $sec_email;
			$where = array('id'=>$id);
			$this->db->where($where);						
			$this->db->update('user_mst',$data_ary);

			$url = base_url('members/active_emailid?action=update&email='.$sec_email.'&key='.$key);
			$txt = '';
			$txt .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
							<meta name="viewport" content="width=device-width, initial-scale=1.0">
							<title>Hotel Email Template - Quickai</title>
							<style type="text/css">
							@media only screen and (max-width: 600px) 
							{
								table[class="contenttable"] {
									width: 320px !important;
									border-width: 3px!important;
								}
								table[class="tablefull"] {
									width: 100% !important;
								}
								table[class="tablefull"] + table[class="tablefull"] td {
									padding-top: 0px !important;
								}
								table td[class="tablepadding"] {
									padding: 15px !important;
								}
							}
							</style>
							</head>
							<body style="margin:0; border: none; background:#f5f7f8">';

			$txt .= '<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
						  <tr>
						    <td align="center" valign="top"><table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family:Arial, Helvetica, sans-serif">
						        <tr>
						          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
						              <tbody>
						                <tr>
						                  <td width="100%" height="30">&nbsp;</td>
						                </tr>
						                <tr>
						                  <td valign="top" align="center">
						                     <a href="'.base_url().'">
						                       <img alt="" src="'.base_url('assets/img/t_logo.png').'" style="padding-bottom: 0; display: inline !important;">
						                     </a>
						                  </td>
						                </tr>
						                <tr>
						                  <td width="100%" height="30">&nbsp;</td>
						                </tr>
						                <tr>
						              </tbody>
						            </table>
						          </td>
						        </tr>
						        <tr>
						          <td class="tablepadding" style="border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;padding:25px 20px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
						              <tbody>
						                <tr>
						                  <td colspan="4" valign="top" style="font-size:14px; line-height:20px; padding-bottom:5px;">
						                    <span style="color:#000; font-size:13px; font-weight: bold;">Hi Admin,</span><br />
						                    <br />
						                    <span style="color:#333;display:inline-block">You recently requested to change email ID for your Hirelay account. Click the button below to activate it.</span>
						                   </td>                 
						                </tr>   
						                <tr>
						                  <td>
						                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
						                      <tbody>
						                        <tr>
						                          <td class="tablepadding" align="center" style="font-size:14px; line-height:32px; padding:5px 20px 10px 5px;"> 
						                            <a href="'.$url.'" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:14px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">Update Email</a>
						                          </td>
						                        </tr>
						                        <tr>
						                       </tr>
						                      </tbody>
						                    </table>
						                  </td>
						                </tr>      
						                <tr>
						                  <td  style="font-size:14px; line-height:20px; padding-bottom:5px;">
						                     <span style="color:#333;display:inline-block">If above is not working, please copy following line and paste it into your web browser address bar.
						                      <br><br>
						                      <a href="'.$url.'">'.$url.'</a>
						                      <br><br>
						                      If you didn’t request a password rest, just ignore this email. 
						                     </span>
						                  </td>
						                </tr>  
						                <tr>
						                  <td>
						                   <br> <span style="color: #000; font-weight: 400; font-size: 13px;">Regards,</span><br>
						                    <span style="color: #000; font-weight: bold">Team Hirelay</span>
						                  </td>
						                </tr>               
						              </tbody>
						            </table>
						          </td>
						        </tr>
						      </table>
						    </td>
						  </tr>  
						</table>
						</body>
						</html>';		

					//email sending process...
				$this->sendemailv3($sec_email,'Email Update request',$txt);				
				$this->session->set_flashdata('success','An email update link has sent to your email id');					
			
				redirect(base_url('admin/change_email'),'refresh');
		}

		$this->data['User_Type'] = $this->session->userdata('user_typ');
		$this->data['Meta_title'] = 'Change Email';
		$this->data['BreadCrumb'] = '<li>
										<a href="'.base_url('admin/dashboard').'">
										  <i class="fa fa-home"></i> Home
										</a>
									  </li>
									  <li>Admin</li>
            						  <li class="active">Change Email</li>';

		$this->data['sub_view']='admin/subview/change_email';
		$this->load->view('admin/_master',$this->data);
	}
}
?>