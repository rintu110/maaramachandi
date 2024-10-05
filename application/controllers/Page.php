<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
		class Page extends MY_Controller 
		{
			function __construct() 
			{
				parent::__construct();	

				$this->load->model('Sitemaster_m');	
				$this->load->model('Category_m');					
				$this->load->model('Page_m');	
				$this->load->model('Banner_m');
				$this->load->model('Post_m');				
				$this->load->model('Page_m');				
				$this->load->model('Post_Gallery_m');				
				$this->load->model('Post_Meta_m');				
				$this->load->model('Faq_m');				
				$this->load->model('Gallery_m');				
								
				$this->site_settings = $this->Sitemaster_m->getAll();
				$this->ftr_cat_list = $this->Category_m->GetCategory();

				$this->meta_title = $this->site_settings->meta_title;
				$this->meta_key = $this->site_settings->meta_key;
				$this->meta_desc = $this->site_settings->meta_desc;
				$this->canonical_code = $this->site_settings->canonical_code;
				$this->extra_meta = $this->site_settings->extra_meta;					
			}	
		
			public function index($param1='')
			{
				$db_pages = $this->Page_m->GetSlug();
				$ar_pgs = array();
				foreach ($db_pages as $k => $v) {
					$ar_pgs[] = $v->slug_url;
				}

				$pages = $ar_pgs;
				$array = array('product','thankyou','error','search','news','enquiry','newssearch');

				$initial_url=$this->uri->segment(0);
				$phase1 = $this->uri->segment(1);
				$phase2 = $this->uri->segment(2);
				$phase3 = $this->uri->segment(3);
				$phase4 = $this->uri->segment(4);

				/*if($this->mst_asstn->is_live == 1)
				{*/				
					if($phase1!="")
					{
						if (in_array($phase1,$array))
						{
						  	$pp = str_replace('-', '_', $phase1);
						  	$this->{$pp}($phase2,($phase3!='')?$phase3:'',($phase4!='')?$phase4:'');
						}
						else if (in_array($phase1, $pages))
						{
							$this->innerpage($phase1);   
						}
						// else{
						// 	$this->not_found();
						// }
					}			
					else if($phase1 =="")
					{
						$this->home();
					}

				/*}
				else
				{
					$this->maintenance();
				}*/
			}

			public function home()
			{	
				$this->data['bannerlist'] = $bannerlist = $this->Banner_m->getAll();
				//print_result($bannerlist); exit;	
				//$this->data['category'] = $this->Category_m->GetCategoryImg();
				//$this->data['prdlist'] = $prdlist = $this->Post_m->GetPost();
				//$this->data['bloglist'] = $bloglist = $this->Post_m->GetBlog('4');
				//$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');

				//print_result($bloglist);exit;

				$this->data['Site_Settings'] = $this->site_settings;

				$this->data['meta_title'] = $this->meta_title;
				$this->data['meta_key'] = $this->meta_key;
				$this->data['meta_desc'] = $this->meta_desc;
				$this->data['canonical_code'] = $this->canonical_code;
				$this->data['extra_meta'] = $this->extra_meta;

				$this->load->view('front/home',$this->data);
			}			

			public function innerpage($param1)
			{			
				//$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				if(isset($param1) && $param1 !='')
				{
					if($param1 == 'about-us')
					{
						$this->data['Site_Settings'] = $this->site_settings;
						$q = $this->Page_m->GetAll('about-us');

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/aboutus';
						$this->load->view('front/_master',$this->data);
					    
					}	
					else if($param1 == 'committee-members')
					{
						//echo 11;exit;
						$this->data['Site_Settings'] = $this->site_settings;

						$q = $this->db->query("SELECT name,desg,img FROM  members where status = 1 AND member_type = 2 order by sequence asc")->result();
						$this->data['Committee'] = $q;


						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/committee-members';
						$this->load->view('front/_master',$this->data);
					    
					}

					else if($param1 == 'trustee-members')
					{
						$this->data['Site_Settings'] = $this->site_settings;
						
						$q = $this->db->query("SELECT name,desg,img FROM  members where status = 1 AND member_type = 1 order by sequence asc")->result();
						$this->data['Trustee'] = $q;

						//print_result($q);exit;

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/trustee-members';
						$this->load->view('front/_master',$this->data);
					    
					}	
					else if($param1 == 'temple-mgmt-members')
					{
						//echo 11;exit;
						$this->data['Site_Settings'] = $this->site_settings;
						$q = $this->db->query("SELECT name,desg,img FROM  members where status = 1 AND member_type = 3 order by sequence asc")->result();
						$this->data['MGMT'] = $q;

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/temple-mgmt-members';
						$this->load->view('front/_master',$this->data);
					    
					}		
					else if($param1 == 'live-members')
					{
						//echo 11;exit;
						$this->data['Site_Settings'] = $this->site_settings;

						$q = $this->db->query("SELECT * FROM  live_members where status = 1 order by dates desc")->result();
						$this->data['liveMembers'] = $q;

						

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/live-members';
						$this->load->view('front/_master',$this->data);
					    
					}	
					else if($param1 == 'booking')
					{
						$this->data['Site_Settings'] = $s =  $this->site_settings;


						if($_POST)
						{
							$data = $_POST;

							//print_result($data);exit;

							if(isset($data['g-recaptcha-response']))
							{
					            $captcha = $data['g-recaptcha-response'];
					        }

							$secretKey = $this->site_settings->c_secret_key;
					        $ip = $_SERVER['REMOTE_ADDR'];
					        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
					        $response = file_get_contents($url);
					        $responseKeys = json_decode($response,true);

					        // should return JSON with success as true
					        if($responseKeys["success"]) 
					        {
					        	 $admin_email = 'rintu111@gmail.com';

					        	 $email = ($data['email'] !='')?$data['email']:'';

					        	 $booking_type = ($data['booking_type'] == 1)? 'Room':'Mandap';
					        	 $tent_booking = ($data['tent_booking'] == 1)? 'Yes':'No';
					        	 $adv_booking = ($data['adv_booking'] == 1)? 'Yes':'No';

					        	 $adhaar_pan = '';

					        	 if($data['adhaar_pan'] !='')
					        	 {
					        	 	  $adhaar_pan = "Adhar Or PAN Number: ".$data['adhaar_pan'];
					        	 }
					        	 $address = '';
					        	 if($data['address'] !='')
					        	 {
					        	 	  $address = "\n Address: ".$data['address'];
					        	 }

					        	 $add_info = "";
					        	 if($data['add_info'] !='')
					        	 {
					        	 	  $add_info = " \n Additional Information: ".$data['add_info'];
					        	 }

					        	 $msg = nl2br("Dear Administrator,

					        	 			   An user sent a ".$booking_type." booking request

					        	 			   Name: ".$data['name']."
					        	 			   Tent Booking: ".$tent_booking."	
					        	 			   Advance Booking: ".$adv_booking."
					        	 			   Email: ".$email."
					        	 			   Contact No: ".$data['mobile']."
					        	 			   Date Range: ".date('d-M-Y',strtotime($data['from_dt']))." - ".date('d-M-Y',strtotime($data['to_dt']))."
					        	 			   No Of Person: ".$data['no_of_person']."
					        	 			   Purpose: ".$data['purpose']."
					        	 			   ".$adhaar_pan.$address.$add_info
					        	 			);	

					        	 //echo $msg;exit;

					             $v = $this->sendemailv3($admin_email,$booking_type. ' booking has made by: '.$data['name'].' - '.$data['mobile'],$msg);

					             $status = 0;

					             if($v['msg_status'] == 202)
					             {
					             	$status = 1;
					             }

					             unset($data['g-recaptcha-response']);					           

					             $ins = $this->db->query("INSERT INTO t_booking set booking_type = '".$data['booking_type']."',tent_booking = '".$data['tent_booking']."',adv_booking = '".$data['adv_booking']."', name = '".$data['name']."',mobile = '".$data['mobile']."',email = '".$email."',address='".$address."',from_dt = '".date('Y-m-d',strtotime($data['from_dt']))."',to_dt = '".date('Y-m-d',strtotime($data['to_dt']))."',no_of_person = '".$data['no_of_person']."',purpose = '".$data['purpose']."',adhaar_pan = '".$data['adhaar_pan']."',add_info = '".$data['add_info']."', created_by = 'User'");

					             redirect(base_url('thankyou'));   
					        } 
					        else 
					        {
					        	redirect(base_url('thankyou'));   
					        }
						}
						

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/room-booking';
						$this->load->view('front/_master',$this->data);
					    
					}		
					else if($param1 == 'mandap-booking')
					{
						$this->data['Site_Settings'] = $this->site_settings;

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/mandap-booking';
						$this->load->view('front/_master',$this->data);
					    
					}
					else if($param1 == 'donation')
					{
						$this->data['Site_Settings'] = $this->site_settings;

						if($_POST)
						{
							$data = $_POST;

							//print_result($data);exit;

							if(isset($data['g-recaptcha-response']))
							{
					            $captcha = $data['g-recaptcha-response'];
					        }

							$secretKey = $this->site_settings->c_secret_key;
					        $ip = $_SERVER['REMOTE_ADDR'];
					        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
					        $response = file_get_contents($url);
					        $responseKeys = json_decode($response,true);

					        // should return JSON with success as true
					        if($responseKeys["success"]) 
					        {
					        	 $admin_email = 'rintu111@gmail.com';

					        	 $email = ($data['email'] !='')?$data['email']:'';
					        	 $address = ($data['address'] !='')?$data['address']:'';

					        	 $msg = nl2br("Dear Administrator,

					        	 			   An user sent a donation

					        	 			   Name: ".$data['name']."

					        	 			   Gotra: ".$data['gotra']."	

					        	 			   Contact No: ".$data['mobile_no']."

					        	 			   Donation Amount: ".$data['d_amount']."

					        	 			   Mode of payment: ".$data['d_type']);	

					             $v = $this->sendemailv3($admin_email,'Donation has made by: '.$data['name'].' - '.$data['mobile_no'],$msg);

					             $status = 0;

					             if($v['msg_status'] == 202)
					             {
					             	$status = 1;
					             }

					             unset($data['g-recaptcha-response']);

					             $today = date('Y-m-d');

					             $year = date('Y',strtotime($today));
					             $month = date('m',strtotime($today));

					             $ins = $this->db->query("INSERT INTO donation set name = '".$data['name']."',mobile_no = '".$data['mobile_no']."',email = '".$email."',address='".$address."',d_type = '".$data['d_type']."',d_amount = '".$data['d_amount']."', created_on = '".date('Y-m-d H:i:s')."',dod = '".date('Y-m-d')."',year = '".$year."',month = '".$month."',status = '1', created_by = 'User'");

					             redirect(base_url('thankyou'));   
					        } 
					        else 
					        {
					        	redirect(base_url('thankyou'));   
					        }
						}

						$extqry = '';

						if(isset($_POST['Search']))
						{
                             $extqry .= "AND year = '".$_POST['year']."'
                             			 AND month = '".$_POST['month']."'";  	
						}
						else
						{
							  $extqry .= "AND year = '".date('Y')."'";
						}

						$q = $this->db->query("SELECT id,year,month FROM donation 
																where 1
																AND status = 1																
																AND img is not NULL
																$extqry
																GROUP by year,month
																ORDER BY month DESC")->result();

						$this->data['all_data'] = $q;

						//print_result($q);exit;
						

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/donation';
						$this->load->view('front/_master',$this->data);
					    
					}	
					else if($param1 == 'media-coverage')					
					{
						$this->data['Site_Settings'] = $this->site_settings;

						$extqry = '';

						if(isset($_POST['Search']))
						{
                             $extqry .= "AND year = '".$_POST['year']."'
                             			 AND month = '".$_POST['month']."'";  	
						}
						else
						{
							  $extqry .= "AND year = '".date('Y')."'";
						}

						$q = $this->db->query("SELECT id,publish_date,cut_img,link,info
																FROM m_media_coverage 
																where 1
																AND active_status = 1																
																AND cut_img is not NULL	
																ORDER BY created_on DESC")->result();

						$this->data['all_data'] = $q;

						//print_result($q);exit;
						

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/media_coverage';
						$this->load->view('front/_master',$this->data);
					}
					else if($param1 == 'contact-us')
					{
						if($_POST)
						{
							$data = $_POST;

							if(isset($data['g-recaptcha-response']))
							{
					            $captcha = $data['g-recaptcha-response'];
					        }

							$secretKey = $this->site_settings->c_secret_key;
					        $ip = $_SERVER['REMOTE_ADDR'];
					        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
					        $response = file_get_contents($url);
					        $responseKeys = json_decode($response,true);

					        // should return JSON with success as true
					        if($responseKeys["success"]) 
					        {
					        	 $admin_email = 'rintu111@gmail.com';

					        	 $msg = nl2br("Dear Administrator,

					        	 			   An user sent a contact request

					        	 			   Name: ".$data['name']."

					        	 			   Eamil: ".$data['email']."	

					        	 			   Contact No: ".$data['phonenumber']."

					        	 			   ZipCode: ".$data['zip']."

					        	 			   Message: ".$data['message']);	

					             $v = $this->sendemailv3($admin_email,'Hirelay Contact Request From: '.$data['name'].' - '.$data['phonenumber'],$msg);

					             $status = 0;

					             if($v['msg_status'] == 202)
					             {
					             	$status = 1;
					             }

					             unset($data['g-recaptcha-response']);

					             $ins = $this->db->query("INSERT INTO contacts set form_name = 'Contact Us',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

					             redirect(base_url('thankyou'));   
					        } 
					        else 
					        {
					        	redirect(base_url('thankyou'));   
					        }
						}

						$this->data['Site_Settings'] = $this->site_settings;
						$q = $this->Page_m->GetAll('contact-us');

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['Site_Key'] = $this->site_settings->c_site_key;	
						$this->data['subview']='front/subview/contactus';
					    $this->load->view('front/_master',$this->data);
					}	
					else if($param1 == 'gallery')				
					{

						$q  = $this->db->query("SELECT cat_name,gallery_img,img_tag FROM img_gallery WHERE status = 1 ORDER BY created_on DESC")->result();
						$this->data['gallery'] = $q;
						$this->data['Site_Settings'] = $this->site_settings;
						$this->data['subview']='front/subview/gallery';
						$this->load->view('front/_master',$this->data);
					}
					else
					{
						$q =  $this->Page_m->GetAll($param1);
						$this->data['content'] = $q;

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';
						
						$this->data['Site_Settings'] = $this->site_settings;
						$this->data['subview']='front/subview/common';
						$this->load->view('front/_master',$this->data);
					}
				}
			}	

						
			
			public function product($category,$prd_url = NULL)
			{				
				$this->data['category'] = $categorys =  $this->Category_m->GetPCategory($category);
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');

				$limit = '21';

				if (isset($_GET['per_page']) && $_GET['per_page'] != '')
			    {
					 $page = $_GET['per_page'];
			         $start = ($page * $limit)- $limit; 			//first item to display on this page
		        }		       	        
			    else
			    {
				  	 $start = '0';	
			    }

				if($category !='' && $prd_url == NULL)
				{						
					$this->data['prdlist'] = $prdlist =  $this->Post_m->GetProductList($limit,$start,$categorys->id);	

					$d = $this->Post_m->CountPost($categorys->id);		

					////----PAGINATION START----////
					$url = "product/$categorys->slug_url"; 
					$this->paggination($url,$d,$limit);					
					////----PAGINATION ENDS----////
					///
					# Showing 1 to 10 of 255 entries
					$this->data['total_records'] = $d;	
					$this->data['start'] = $start+1;	
					$this->data['page_number'] = (isset($_GET['per_page'])&& $_GET['per_page'] !='')?$_GET['per_page']:'';
					
					$this->data['meta_title'] = (isset($categorys->meta_title) && $categorys->meta_title!='')?$categorys->meta_title:$categorys->cat_name;
					$this->data['meta_key'] = (isset($categorys->meta_key) && $categorys->meta_key!='')?$categorys->meta_key:'';
					$this->data['meta_desc'] = (isset($categorys->meta_desc) && $categorys->meta_desc!='')?$categorys->meta_desc:'';
					$this->data['canonical_code'] = (isset($categorys->canonical_code) && $categorys->canonical_code!='')?$categorys->canonical_code:'';
					$this->data['extra_meta'] = (isset($categorys->extra_meta) && $categorys->extra_meta!='')?$categorys->extra_meta:'';
							
					$this->data['subview']='front/subview/productlisting2';				
						
				}				
				else if($category !='' && $prd_url != '')
				{	
					if($_POST)
					{
						$data = $_POST;

						//print_result($data);exit; 

						if(isset($data['g-recaptcha-response']))
						{
				            $captcha = $data['g-recaptcha-response'];
				        }

						$secretKey = $this->site_settings->c_secret_key;
				        $ip = $_SERVER['REMOTE_ADDR'];
				        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
				        $response = file_get_contents($url);
				        $responseKeys = json_decode($response,true);

				       // print_result($responseKeys);exit;
				        // should return JSON with success as true
				        if($responseKeys["success"]) 
				        {
				        	 $admin_email = 'rintu111@gmail.com';

				        	 $msg = nl2br("Dear Administrator,

				        	 			   An user sent an enquiry on ".$data['post_name']."

				        	 			   Name: ".$data['name']."

				        	 			   Eamil: ".$data['email']."	

				        	 			   Contact No: ".$data['phonenumber']."

				        	 			   Product Name: ".$data['post_name']."

				        	 			   Subject: ".$data['subject']."

				        	 			   Message: ".$data['message']);	

				             $v = $this->sendemailv3($admin_email,'Product Enquiry Form: '.$data['post_name'],$msg);

				             $status = 0;

				             if($v['msg_status'] == 202)
				             {
				             	$status = 1;
				             }

				             unset($data['g-recaptcha-response']);

				             $ins = $this->db->query("INSERT INTO contacts set form_name = 'Product Enquiry On ".$data['post_name']."',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

				             redirect(base_url('thankyou'));   
				        } 
				        else 
				        {
				        	redirect(base_url('error'));   
				        }
					}

					$this->data['prddata'] = $prddata = $this->Post_m->GetProductDetails($prd_url); 


					/*if(sizeof($prddata,1) > 0)
					{*/
						$this->data['relprd'] = $relprd = $this->Post_m->RelatedProduct($prd_url,$prddata->id,$prddata->cat_id);
						$this->data['gallery'] = $gallery = $this->Post_Gallery_m->GetGallery($prddata->id);
						$this->data['prdmeta'] = $prdmeta = $this->Post_Meta_m->GetMeta($prddata->id);

						$this->data['meta_title'] = (isset($prdmeta->meta_title) && $prdmeta->meta_title!='')?$prdmeta->meta_title:$prddata->post_name;
						$this->data['meta_key'] = (isset($prdmeta->meta_key) &&  $prdmeta->meta_key!='')?$prdmeta->meta_key:'';
						$this->data['meta_desc'] = (isset($prdmeta->meta_desc) &&  $prdmeta->meta_desc!='')?$prdmeta->meta_desc:'';
						$this->data['canonical_code'] = (isset($prdmeta->canonical_code) &&  $prdmeta->canonical_code!='')?$prdmeta->canonical_code:'';
						$this->data['extra_meta'] = (isset($prdmeta->extra_meta) &&  $prdmeta->extra_meta!='')?$prdmeta->extra_meta:'';	

						$this->data['subview'] = 'front/subview/productdetails';
					/*}
					else
					{
						$this->not_found();
					}*/							
				}
				else
				{
					 $this->data['prd_catlist'] = $cc = $this->Category_m->GetCategory();
					 $this->data['subview']='front/subview/catlisting';	
				}

				$this->data['Site_Key'] = $this->site_settings->c_site_key;								 
				$this->data['Secret_Key'] = $this->site_settings->c_secret_key;	

				$this->data['Site_Settings'] = $this->site_settings;
				$this->load->view('front/_productmaster',$this->data);				
			}	

			public function search()
			{
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				$term = $_GET['term'];

				if($term !='')
				{				
					 $this->data['prdlist'] = $prdlist = $this->Post_m->SearchProduct($term);
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/productlistingsearch';	
				$this->load->view('front/_productmaster',$this->data);
			}

			public function newssearch()
			{
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				$term = $_GET['term'];

				if($term !='')
				{				
					 $this->data['newslist'] = $newslist = $this->Post_m->SearchNews($term);
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/newslistingsearch';	
				$this->load->view('front/_productmaster',$this->data);
			}

			public function news($newcategory = NULL,$news_url = NULL)	
			{	
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				$this->data['bloglist'] = $bloglist = $this->Post_m->GetBlog('4');

				if($_POST)
				{
					$data = $_POST;

					//print_result($data);exit;

					if(isset($data['g-recaptcha-response']))
					{
			            $captcha = $data['g-recaptcha-response'];
			        }

					$secretKey = $this->site_settings->c_secret_key;
			        $ip = $_SERVER['REMOTE_ADDR'];
			        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			        $response = file_get_contents($url);
			        $responseKeys = json_decode($response,true);

			        // should return JSON with success as true
			        if($responseKeys["success"]) 
			        {
			        	 $admin_email = 'rintu111@gmail.com';

			        	 $msg = nl2br("Dear Administrator,

			        	 			   An user sent an enqiry on ".$data['post_news']."

			        	 			   Name: ".$data['name']."

			        	 			   Eamil: ".$data['email']."	

			        	 			   Subject: ".$data['subject']."

			        	 			   Message: ".$data['message']);	

			             $v = $this->sendemailv3($admin_email,'Bekizo News Enquiry From: '.$data['name'],$msg);

			             $status = 0;

			             if($v['msg_status'] == 202)
			             {
			             	$status = 1;
			             }

			             unset($data['g-recaptcha-response']);

			             $ins = $this->db->query("INSERT INTO contacts set form_name = 'News Page',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");		            

			             redirect(base_url('thankyou'));   
			        } 
			        else 
			        {
			        	redirect(base_url('error'));   
			        }
				}		


				if($newcategory != '' && $news_url == NULL)
				{
					$this->data['newslist'] = $newslist = $this->Post_m->GetBlogListing($newcategory);
					$this->data['blog_cat'] = $blog_cat = $this->Category_m->BlogCategory();
					
					$this->data['meta_title'] = $this->meta_title;
					$this->data['meta_key'] = $this->meta_key;
					$this->data['meta_desc'] = $this->meta_desc;
					$this->data['canonical_code'] = $this->canonical_code;
					$this->data['extra_meta'] = $this->extra_meta;

					$this->data['subview']='front/subview/newslisting';
				}				
				else if($newcategory!= '' && $news_url != '')
				{		

					$this->data['blog_cat'] = $blog_cat = $this->Category_m->BlogCategory();
					$this->data['newsdata'] = $newsdata = $this->Post_m->BlogDetails($news_url);
					$this->data['Site_Key'] = $this->site_settings->c_site_key;								 
					$this->data['Secret_Key'] = $this->site_settings->c_secret_key;	

					//print_result($newsdata);exit;

					if(sizeof($newsdata,1) > 0)
					{
						$newsdata = $newsdata[0];
						
						if(isset($news_url))
						{
							$upd = $this->db->query("UPDATE post SET hits = hits+1 where 1 AND id = '".$newsdata->id."'");
						}

						//$this->data['recentpost'] = $recentpost = $this->Post_m->RecentBlogPost($news_url);	
						//print_result($recentpost); exit;
						
					/*	$this->data['meta_title'] = ($newsdata->meta_title!='')?$newsdata->meta_title:'';
						$this->data['meta_key'] = ($newsdata->meta_key!='')?$newsdata->meta_key:'';
						$this->data['meta_desc'] = ($newsdata->meta_desc!='')?$newsdata->meta_desc:'';
						$this->data['canonical_code'] = ($newsdata->canonical_code!='')?$newsdata->canonical_code:'';
						$this->data['extra_meta'] = ($newsdata->extra_meta!='')?$newsdata->extra_meta:'';*/

						$this->data['subview'] = 'front/subview/newsdetails';
					}
					else
					{
						$this->not_found();
					}								
				}				
				else
				{
					$this->data['newslist'] = $newslist = $this->Post_m->GetBlogListing();
					$this->data['blog_cat'] = $blog_cat = $this->Category_m->BlogCategory();
					
					$this->data['meta_title'] = $this->meta_title;
					$this->data['meta_key'] = $this->meta_key;
					$this->data['meta_desc'] = $this->meta_desc;
					$this->data['canonical_code'] = $this->canonical_code;
					$this->data['extra_meta'] = $this->extra_meta;

					$this->data['subview']='front/subview/newslisting';
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->load->view('front/_productmaster',$this->data);		

			}

			public function not_found()
			{
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['meta_title'] = $this->meta_title;
				$this->data['meta_key'] = $this->meta_key;
				$this->data['meta_desc'] = $this->meta_desc;
				$this->data['canonical_code'] = $this->canonical_code;
				$this->data['extra_meta'] = $this->extra_meta;

				$this->data['subview']='front/subview/not_found';
				$this->load->view('front/_productmaster',$this->data);
			}

			public function thankyou()
			{
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/thankyou';
				$this->load->view('front/_productmaster',$this->data);
			}

			public function error()
			{			
				$this->data['Footerbloglist'] = $Footerbloglist = $this->Post_m->GetBlog('2');
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/error';
				$this->load->view('front/_productmaster',$this->data);	
			}	
		}
?>