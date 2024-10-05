<?php

	error_reporting(0);
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
		class Page extends MY_Controller {

			function __construct() 
			{
				parent::__construct();	
				
				$this->site_settings = $this->db->query("SELECT * FROM sitemst WHERE id = 1485")->row();
				$this->meta_title = $this->site_settings->meta_title;
				$this->meta_key = $this->site_settings->meta_key;
				$this->meta_desc = $this->site_settings->meta_desc;
				$this->canonical_code = $this->site_settings->canonical_code;
				$this->extra_meta = $this->site_settings->extra_meta;		

				$this->ftr_cat_list = $this->db->query("SELECT cat_name,slug_url FROM category where status = 1 AND del_status = 0 AND post_type = 'Product'  and parent_id != 0 and subcat_id = 0 ORDER BY sequence ASC")->result();
			}
			

			public function index($param1='')
			{
				$db_pages = $this->db->query("SELECT slug_url FROM page WHERE status = 1 AND del_status = 0")->result();
				$ar_pgs = array();
				foreach ($db_pages as $k => $v) {
					$ar_pgs[] = $v->slug_url;
				}

				$pages = $ar_pgs;
				$array = array('product','news','quote','thankyou','error','search','solution');

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
						else{
							$this->not_found();
						}
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
				$this->data['bannerlist'] = $bannerlist = $this->db->query("SELECT bnr_img,alt_tag															
																 FROM banner  where 1 																 
																 AND status = 1
																 AND del_status = 0
																 ORDER BY sequence ASC")->result();	

				//print_result($bannerlist);exit;


				$this->data['prdlist'] = $prdlist = $this->db->query("SELECT post_name,slug_url,post_img,
																 (SELECT cat_name FROM category where id = P.cat_id) as `Category`,	
																 (SELECT slug_url FROM category where id = P.cat_id) as `Pslug_url`,
																 (select slug_url FROM category WHERE id = P.subcat_id) AS subcategory	
																 FROM post P where 1 AND P.post_type = 'Product' 
																 AND subcat_id != 0
																 AND P.status = 1 AND P.is_featured = 1 
																 AND P.del_status = 0
																 LIMIT 8")->result();			

				$this->data['Site_Settings'] = $this->site_settings;

				$this->data['meta_title'] = $this->meta_title;
				$this->data['meta_key'] = $this->meta_key;
				$this->data['meta_desc'] = $this->meta_desc;
				$this->data['canonical_code'] = $this->canonical_code;
				$this->data['extra_meta'] = $this->extra_meta;

				$this->load->view('front/home',$this->data);
			}

			public function quote()
			{
				$sub = 'Get A Quote From: '.$data['name'];
				$form_name = 'Get A Quote Form';
				$Product = '';

				if(isset($_GET['term']) && $_GET['term'] !='')
				{
					$q = $this->db->query("SELECT post_name,
											  (select cat_name FROM category WHERE id = P.cat_id) AS Cat_name,
											  (select cat_name FROM category WHERE id = P.subcat_id) AS Subcat_name
											  FROM post P WHERE slug_url = '".$_GET['term']."'")->row();	

					$sub = 'Product Enquiry From: '.$data['full_name'];
					$form_name = 'Product Enquiry Form';
					$Product = "Product Name: ".$q->post_name;
				}			

				if(isset($_POST['btn_enquiry']))
				{
					$data = $_POST;

					if(isset($data['g-recaptcha-response']))
					{
			            $captcha = $data['g-recaptcha-response'];
			        }

					$secretKey = "6LfhLpIaAAAAAFNN19yUTqgyoJZMVJKUGgYIFVcd";
			        $ip = $_SERVER['REMOTE_ADDR'];
			        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			        $response = file_get_contents($url);
			        $responseKeys = json_decode($response,true);

			        // should return JSON with success as true
			        if($responseKeys["success"]) 
			        {
			        	 $admin_email = 'rintu111@gmail.com';

			        	 $cat_name = '';

			        	 if(isset($q->Cat_name) && $q->Cat_name !='')
			        	 {
			        	 	 $cat_name .="Category: ".$q->Cat_name;
			        	 }

			        	 $subcat_name = '';

			        	 if(isset($q->Subcat_name) && $q->Subcat_name !='')
			        	 {
			        	 	  $subcat_name .="SubCategory: ".$q->Subcat_name;
			        	 }

			        	 if(isset($_GET['term']) && $_GET['term'] !='')
						 {

				        	 $msg = nl2br("Dear Administrator,

				        	 			   An user sent a product enquiry

				        	 			   Name: ".$data['name']."

				        	 			   Eamil: ".$data['email']."	

				        	 			   Contact No: ".$data['phonenumber']."

				        	 			   $Product 

				        	 			   $cat_name 

				        	 			   $subcat_name

				        	 			   Message: ".$data['message']."

				        	 			   ");	
				          }
				          else 
				          {
				          	   $msg = nl2br("Dear Administrator,

				        	 			   An user sent an enquiry

				        	 			   Name: ".$data['name']."

				        	 			   Eamil: ".$data['email']."	

				        	 			   Contact No: ".$data['phonenumber']."				        	 			 

				        	 			   Message: ".$data['message']."
				        	 			   ");	
				          }

			             $v = $this->sendemailv3($admin_email,$sub,$msg);

			             $status = 0;

			             if($v['msg_status'] == 202)
			             {
			             	$status = 1;
			             }

			             unset($data['g-recaptcha-response']);

			             $ins = $this->db->query("INSERT INTO contacts set form_name = '".$form_name."',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

			             redirect(base_url('thankyou'));   
			        } 
			        else 
			        {
			        	redirect(base_url('error'));   
			        }
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
				$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
				$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
				$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
				$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

				$this->data['subview']='front/subview/prdenquiry';
			    $this->load->view('front/_productmaster',$this->data);
			}

			public function thankyou()
			{
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/thankyou';
				$this->load->view('front/_productmaster',$this->data);
			}

			public function error()
			{			
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/error';
				$this->load->view('front/_productmaster',$this->data);	
			}

			public function innerpage($param1)
			{
				$this->data['category_list'] = $category_list =  $this->db->query("SELECT cat_name,slug_url,id FROM category where 1 AND status = 1 AND del_status = 0 AND post_type = 'Product' and parent_id = 0 AND cat_name !='Product' order by sequence,cat_name asc")->result();

				if(isset($param1) && $param1 !='')
				{
					if($param1 == 'about-us')
					{
						$this->data['Site_Settings'] = $this->site_settings;
						$q = $this->db->query("SELECT * FROM page WHERE slug_url = 'about-us'")->row();

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';

						$this->data['subview']='front/subview/aboutus';
						$this->load->view('front/_productmaster',$this->data);
					    
					}					
					else if($param1 == 'contact-us')
					{
						if($_POST)
						{
							$data = $_POST;

							//print_result($data);exit; 

							if(isset($data['g-recaptcha-response']))
							{
					            $captcha = $data['g-recaptcha-response'];
					        }

							$secretKey = "6LfhLpIaAAAAAFNN19yUTqgyoJZMVJKUGgYIFVcd";
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

					        	 			   An user sent a contact request

					        	 			   Name: ".$data['name']."

					        	 			   Eamil: ".$data['email']."	

					        	 			   Contact No: ".$data['phonenumber']."

					        	 			   Subject: ".$data['subject']."

					        	 			   Message: ".$data['message']."

					        	 			   ");	

					             $v = $this->sendemailv3($admin_email,'Rs. Security Co. LTD Contact Request From: '.$data['name'],$msg);

					             $status = 0;

					             if($v['msg_status'] == 202)
					             {
					             	$status = 1;
					             }

					             unset($data['g-recaptcha-response']);

					             $ins = $this->db->query("INSERT INTO contacts set form_name = 'Contact Us',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

					             redirect(base_url('contact-us'));   
					        } 
					        else 
					        {
					        	redirect(base_url('contact-us'));   
					        }
						}

						$this->data['Site_Settings'] = $this->site_settings;

						$q = $this->db->query("SELECT * FROM page WHERE slug_url = 'contact-us'")->row();

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';


						$this->data['subview']='front/subview/contactus';
					    $this->load->view('front/_productmaster',$this->data);
					}
					else
					{
						$q = $this->db->query("SELECT * FROM page WHERE slug_url = '".$param1."'")->row();
						$this->data['content'] = $q;

						$this->data['meta_title'] = (isset($q->meta_title) && $q->meta_title!='')?$q->meta_title:'';
						$this->data['meta_key'] = (isset($q->meta_key) && $q->meta_key!='')?$q->meta_key:'';
						$this->data['meta_desc'] = (isset($q->meta_desc) && $q->meta_desc!='')?$q->meta_desc:'';
						$this->data['canonical_code'] = (isset($q->canonical_code) && $q->canonical_code!='')?$q->canonical_code:'';
						$this->data['extra_meta'] = (isset($q->extra_meta) && $q->extra_meta!='')?$q->extra_meta:'';
						
						$this->data['Site_Settings'] = $this->site_settings;
						$this->data['subview']='front/subview/common';
						$this->load->view('front/_productmaster',$this->data);
					}
				}
			}			

			public function not_found()
			{
				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['meta_title'] = $this->meta_title;
				$this->data['meta_key'] = $this->meta_key;
				$this->data['meta_desc'] = $this->meta_desc;
				$this->data['canonical_code'] = $this->canonical_code;
				$this->data['extra_meta'] = $this->extra_meta;

				echo 'Not Found';
			}						
		

			public function news($news_url = NULL)	
			{	
				if($_POST)
				{
					$data = $_POST;

					//print_result($data);exit;

					if(isset($data['g-recaptcha-response']))
					{
			            $captcha = $data['g-recaptcha-response'];
			        }

					$secretKey = "6LfhLpIaAAAAAFNN19yUTqgyoJZMVJKUGgYIFVcd";
			        $ip = $_SERVER['REMOTE_ADDR'];
			        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			        $response = file_get_contents($url);
			        $responseKeys = json_decode($response,true);

			        // should return JSON with success as true
			        if($responseKeys["success"]) 
			        {
			        	 $admin_email = 'rintu111@gmail.com';

			        	 $msg = nl2br("Dear Administrator,

			        	 			   An user sent a request

			        	 			   Name: ".$data['name']."

			        	 			   Eamil: ".$data['email']."	

			        	 			   Subject: ".$data['subject']."

			        	 			   Message: ".$data['message']."

			        	 			   ");	

			             $v = $this->sendemailv3($admin_email,'Rs. Security Co. LTD News Page Request From: '.$data['name'],$msg);

			             $status = 0;

			             if($v['msg_status'] == 202)
			             {
			             	$status = 1;
			             }

			             unset($data['g-recaptcha-response']);

			             $ins = $this->db->query("INSERT INTO contacts set form_name = 'News Page',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

			             $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			             redirect($actual_link);   
			        } 
			        else 
			        {
			        	redirect($actual_link);   
			        }
				}			
				if($news_url == NULL)
				{
					$this->data['newslist'] = $newslist = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,
															(SELECT slug_url FROM  category WHERE id = P.cat_id ) as 'Cat_URL'
					 										FROM post P 
					 										where 1 
					 										AND post_type = 'News' 
					 										AND status = 1 
					 										AND del_status = 0")->result();


					$this->data['blog_cat'] = $blog_cat = $this->db->query("SELECT cat_name,slug_url FROM category where 1 AND post_type = 'News' AND status = 1 AND del_status = 0")->result();
					
					$this->data['meta_title'] = $this->meta_title;
					$this->data['meta_key'] = $this->meta_key;
					$this->data['meta_desc'] = $this->meta_desc;
					$this->data['canonical_code'] = $this->canonical_code;
					$this->data['extra_meta'] = $this->extra_meta;

					$this->data['subview']='front/subview/newslisting';
				}
				
				else if($news_url != '')
				{					
					$this->data['blog_cat'] = $blog_cat = $this->db->query("SELECT cat_name,slug_url FROM category where 1 AND post_type = 'News' AND status = 1 AND del_status = 0")->result();

					$this->data['newsdata'] = $newsdata = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,full_desc,news_dtls_bnr,hits,id,news_dtls_bnr FROM post where 1 AND slug_url = '".$news_url."' AND post_type = 'News' AND status = 1 AND del_status = 0")->row();	

					if(isset($news_url))
					{
						$upd = $this->db->query("UPDATE post SET hits = hits+1 where 1 AND id = '".$newsdata->id."'");
					}

					$this->data['recentpost'] = $recentpost = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,
																 (SELECT slug_url FROM  category WHERE id = P.cat_id ) as 'Cat_URL'
																 FROM post P 
																 where 1 
																 AND slug_url != '".$news_url."' 
																 AND post_type = 'News' 
																 AND status = 1 
																 AND del_status = 0 
																 ORDER BY id DESC 
																 LIMIT 4")->result();	
					//print_result($recentpost); exit;
					
				/*	$this->data['meta_title'] = ($newsdata->meta_title!='')?$newsdata->meta_title:'';
					$this->data['meta_key'] = ($newsdata->meta_key!='')?$newsdata->meta_key:'';
					$this->data['meta_desc'] = ($newsdata->meta_desc!='')?$newsdata->meta_desc:'';
					$this->data['canonical_code'] = ($newsdata->canonical_code!='')?$newsdata->canonical_code:'';
					$this->data['extra_meta'] = ($newsdata->extra_meta!='')?$newsdata->extra_meta:'';*/

					$this->data['subview'] = 'front/subview/newsdetails';								
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->load->view('front/_productmaster',$this->data);		

			}	

			public function solution($news_url = NULL)	
			{	
				if($_POST)
				{
					$data = $_POST;

					if(isset($data['g-recaptcha-response']))
					{
			            $captcha = $data['g-recaptcha-response'];
			        }

					$secretKey = "6LfhLpIaAAAAAFNN19yUTqgyoJZMVJKUGgYIFVcd";
			        $ip = $_SERVER['REMOTE_ADDR'];
			        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			        $response = file_get_contents($url);
			        $responseKeys = json_decode($response,true);

			        // should return JSON with success as true
			        if($responseKeys["success"]) 
			        {
			        	 $admin_email = 'rintu111@gmail.com';

			        	 $msg = nl2br("Dear Administrator,

			        	 			   An user sent a request

			        	 			   Name: ".$data['name']."

			        	 			   Eamil: ".$data['email']."	

			        	 			   Subject: ".$data['subject']."

			        	 			   Message: ".$data['message']."

			        	 			   ");	

			             $v = $this->sendemailv3($admin_email,'Rs. Security Co. LTD Solution Page Request From: '.$data['name'],$msg);

			             $status = 0;

			             if($v['msg_status'] == 202)
			             {
			             	$status = 1;
			             }

			             unset($data['g-recaptcha-response']);

			             $ins = $this->db->query("INSERT INTO contacts set form_name = 'Solution Page',request_data = '".json_encode($data)."',added_on = '".date('Y-m-d H:i:s')."', status = '".$status."'");

			             $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			             redirect($actual_link);   
			        } 
			        else 
			        {
			        	redirect($actual_link);   
			        }
				}			
				if($news_url == NULL)
				{
					$this->data['newslist'] = $newslist = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,
															(SELECT slug_url FROM  category WHERE id = P.cat_id ) as 'Cat_URL'
					 										FROM post P 
					 										where 1 
					 										AND post_type = 'Solution' 
					 										AND status = 1 
					 										AND del_status = 0")->result();
					
					$this->data['meta_title'] = $this->meta_title;
					$this->data['meta_key'] = $this->meta_key;
					$this->data['meta_desc'] = $this->meta_desc;
					$this->data['canonical_code'] = $this->canonical_code;
					$this->data['extra_meta'] = $this->extra_meta;

					$this->data['subview']='front/subview/solutionlisting';
				}				
				else if($news_url != '')
				{					
					$this->data['newsdata'] = $newsdata = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,full_desc,news_dtls_bnr,hits,id,news_dtls_bnr FROM post where 1 AND slug_url = '".$news_url."' AND post_type = 'Solution' AND status = 1 AND del_status = 0")->row();	

					if(isset($news_url))
					{
						$upd = $this->db->query("UPDATE post SET hits = hits+1 where 1 AND id = '".$newsdata->id."'");
					}

					$this->data['recentpost'] = $recentpost = $this->db->query("SELECT post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,
																 (SELECT slug_url FROM  category WHERE id = P.cat_id ) as 'Cat_URL'
																 FROM post P 
																 where 1 
																 AND slug_url != '".$news_url."' 
																 AND post_type = 'Solution' 
																 AND status = 1 
																 AND del_status = 0 
																 ORDER BY id DESC 
																 LIMIT 4")->result();	
					//print_result($recentpost); exit;
					
				/*	$this->data['meta_title'] = ($newsdata->meta_title!='')?$newsdata->meta_title:'';
					$this->data['meta_key'] = ($newsdata->meta_key!='')?$newsdata->meta_key:'';
					$this->data['meta_desc'] = ($newsdata->meta_desc!='')?$newsdata->meta_desc:'';
					$this->data['canonical_code'] = ($newsdata->canonical_code!='')?$newsdata->canonical_code:'';
					$this->data['extra_meta'] = ($newsdata->extra_meta!='')?$newsdata->extra_meta:'';*/

					$this->data['subview'] = 'front/subview/solutiondetails';								
				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->load->view('front/_productmaster',$this->data);		

			}	

			public function product($category,$subcategory = NULL,$prd_url = NULL)
			{
				$this->data['category_list'] = $category_list =  $this->db->query("SELECT cat_name,slug_url,id FROM category where 1 AND status = 1 AND del_status = 0 AND post_type = 'Product' and parent_id = 0 AND cat_name !='Product' order by sequence,cat_name asc")->result();

				$this->data['category'] = $categorys =  $this->db->query("SELECT cat_name,slug_url,sml_dsc,full_dsc,meta_title,meta_key,meta_desc,extra_meta,canonical_code,id,subcat_id FROM category where 1 AND slug_url = '".$category."' AND post_type = 'Product' AND status = 1 AND del_status = 0")->row();

				if($category !='')
				{
					$this->data['prdlist'] = $prdlist = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,news_dtls_bnr,bg_img,sml_desc,side_desc,full_desc,q_a,links,
									(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
									 FROM post P where 1 AND cat_id = '".$categorys->id."' AND subcat_id != 0 AND post_type = 'Product' AND status = 1 AND del_status = 0")->result();	
				}
				

				$limit = 30;

				if (isset($_GET['per_page']) && $_GET['per_page'] != '')
			    {
					 $page = $_GET['per_page'];
			         $start = ($page * $limit)- $limit; 			//first item to display on this page
		        }		       	        
			    else
			    {
				  	 $start = 0;	
			    }

				if($category !='' && $subcategory == NULL && $prd_url == NULL)
				{						
					
					$this->data['prdlist'] = $prdlist = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,
									(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
									 FROM post P 
									 where 1 
									 AND cat_id = 1 
									 AND subcat_id = '".$categorys->id."'
									 AND post_type = 'Product' 
									 AND status = 1 
									 AND del_status = 0 
									 LIMIT $start,$limit")->result();	
	

					$this->data['Pcat_list'] = $Pcat_list = $this->db->query("SELECT cat_name,slug_url,post_img,sml_dsc,full_dsc,meta_title,meta_key,meta_desc,extra_meta,canonical_code,id FROM category where 1 AND parent_id = '1' AND post_type = 'Product' AND status = 1 AND del_status = 0")->result();		

		

					$this->data['featured_prd'] = $featured_prd = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,
									(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
									 FROM post P 
									 where 1 
									 AND cat_id = '".$categorys->id."' 
									 AND post_type = 'Product' 
									 AND status = 1 
									 AND del_status = 0 
									 AND P.is_featured  = 1
									 LIMIT $start,$limit")->result();

					$d = $this->db->query("SELECT count(P.id) AS num 
											FROM post P where 1 
												 AND cat_id = '".$categorys->id."' 
											     AND post_type = 'Product' 
											     AND status = 1 
											     AND del_status = 0")->row();  

					////----PAGINATION START----////
					$url = "product/$categorys->slug_url";
					$this->paggination($url,$d->num,$limit);
					////----PAGINATION ENDS----////
					
					$this->data['meta_title'] = (isset($categorys->meta_title) && $categorys->meta_title!='')?$categorys->meta_title:'';
					$this->data['meta_key'] = (isset($categorys->meta_key) && $categorys->meta_key!='')?$categorys->meta_key:'';
					$this->data['meta_desc'] = (isset($categorys->meta_desc) && $categorys->meta_desc!='')?$categorys->meta_desc:'';
					$this->data['canonical_code'] = (isset($categorys->canonical_code) && $categorys->canonical_code!='')?$categorys->canonical_code:'';
					$this->data['extra_meta'] = (isset($categorys->extra_meta) && $categorys->extra_meta!='')?$categorys->extra_meta:'';
							
					$this->data['subview']='front/subview/productlisting2';						
				}
				else if($category !='' && $subcategory !='' && $prd_url == NULL)
				{
						$this->data['subcategory'] = $subcategorys =  $this->db->query("SELECT cat_name,slug_url,sml_dsc,full_dsc,meta_title,meta_key,meta_desc,extra_meta,canonical_code,id FROM category where 1 AND slug_url = '".$subcategory."' AND post_type = 'Product' AND status = 1 AND del_status = 0")->row();

						if(countz($subcategorys) > 0 )
						{							
							$this->data['prdlist'] = $prdlist = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img
								FROM post 
								where 1 
								AND cat_id = '".$categorys->id."' 
								AND subcat_id = '".$subcategorys->id."' 
								AND post_type = 'Product' 
								AND status = 1 
								AND del_status = 0 
								ORDER BY sequence asc, created_on desc
								LIMIT $start,$limit
								")->result();

							$this->data['featured_prd'] = $featured_prd = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,
									(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
									 FROM post P 
									 where 1 
									 AND cat_id = '".$categorys->id."' 
									 AND subcat_id = '".$subcategorys->id."' 
									 AND post_type = 'Product' 
									 AND status = 1 
									 AND del_status = 0 
									 AND P.is_featured  = 1
									 LIMIT $start,$limit")->result();

							$d = $this->db->query("SELECT count(P.id) AS num 
												FROM post P where 1 
													 AND cat_id = '".$categorys->id."' 
													 AND subcat_id = '".$subcategorys->id."'
												     AND post_type = 'Product' 
												     AND status = 1 
												     AND del_status = 0")->row();  

							////----PAGINATION START----////
							$url = "product/$categorys->slug_url".'/'.$subcategorys->slug_url;
							$this->paggination($url,$d->num,$limit);
							////----PAGINATION ENDS----////

							$this->data['meta_title'] = (isset($subcategorys->meta_title) && $subcategorys->meta_title!='')?$subcategorys->meta_title:'';
							$this->data['meta_key'] = (isset($subcategorys->meta_key) &&  $subcategorys->meta_key!='')?$subcategorys->meta_key:'';
							$this->data['meta_desc'] = (isset($subcategorys->meta_desc) && $subcategorys->meta_desc!='')?$subcategorys->meta_desc:'';
							$this->data['canonical_code'] = (isset($subcategorys->canonical_code) && $subcategorys->canonical_code!='')?$subcategorys->canonical_code:'';
							$this->data['extra_meta'] = (isset($subcategorys->extra_meta) && $subcategorys->extra_meta!='')?$subcategorys->extra_meta:'';	

							$this->data['Pcat_list'] = '';						

							$this->data['subview']='front/subview/productlisting2';
						}	
						else
						{							
							
							$this->data['prddata'] = $prddata = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,news_dtls_bnr,bg_img,sml_desc,side_desc,full_desc,q_a,links,specs,
								(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory_URL,
								(select cat_name FROM category WHERE id = P.subcat_id) AS subcategory_nm
								 FROM post P where 1 AND slug_url = '".$subcategory."' AND post_type = 'Product' AND status = 1 AND 
								 del_status = 0 ORDER BY sequence asc, created_on desc")->row();

						    $this->data['relprd'] = $relprd = $this->db->query("SELECT slug_url,post_img,post_name,id,
															(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
															 FROM post P where 1 
															 AND id != '".$prddata->id."' 
															 AND cat_id = '".$prddata->cat_id."'
															 AND subcat_id = '".$prddata->subcat_id."'
															 AND post_type = 'Product' 
															 AND status = 1 
															 AND del_status = 0 
															 AND P.slug_url !='".$subcategory."'
															 ORDER BY sequence ASC LIMIT 3 ")->result();	

							$this->data['gallery'] = $gallery = $this->db->query("SELECT post_id,gallery_img,img_tag,is_first FROM post_gallery where 1 AND post_id = '".$prddata->id."' AND status = 1 ORDER BY sequence ASC")->result();

							$this->data['prdmeta'] = $prdmeta = $this->db->query("SELECT * FROM post_meta where post_id = $prddata->id")->row();

							$this->data['meta_title'] = (isset($prdmeta->meta_title) && $prdmeta->meta_title!='')?$prdmeta->meta_title:'';
							$this->data['meta_key'] = (isset($prdmeta->meta_key) &&  $prdmeta->meta_key!='')?$prdmeta->meta_key:'';
							$this->data['meta_desc'] = (isset($prdmeta->meta_desc) &&  $prdmeta->meta_desc!='')?$prdmeta->meta_desc:'';
							$this->data['canonical_code'] = (isset($prdmeta->canonical_code) &&  $prdmeta->canonical_code!='')?$prdmeta->canonical_code:'';
							$this->data['extra_meta'] = (isset($prdmeta->extra_meta) &&  $prdmeta->extra_meta!='')?$prdmeta->extra_meta:'';		
						
							$this->data['subview']='front/subview/productdetails';		
						}				
											
				}
				else if($category !='' && $subcategory != '' && $prd_url != '')
				{

					$this->data['prddata'] = $prddata = $this->db->query("SELECT id,cat_id,subcat_id,post_name,slug_url,post_img,news_dtls_bnr,bg_img,sml_desc,side_desc,full_desc,q_a,links,specs,
						(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory_URL,
						(select cat_name FROM category WHERE id = P.subcat_id) AS subcategory_nm
					 FROM post P where 1 AND slug_url = '".$prd_url."' AND post_type = 'Product' AND status = 1 AND del_status = 0 ORDER BY sequence asc, created_on desc")->row();	

					$this->data['relprd'] = $relprd = $this->db->query("SELECT slug_url,post_img,post_name,id,
														(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory
														 FROM post P where 1 
														 AND id != '".$prddata->id."' 
														 AND cat_id = '".$prddata->cat_id."'
														 AND subcat_id = '".$prddata->subcat_id."'
														 AND post_type = 'Product' AND status = 1 
														 AND del_status = 0 
														 AND P.slug_url !='".$prd_url."'
														 ORDER BY sequence ASC LIMIT 3 ")->result();	

					$this->data['gallery'] = $gallery = $this->db->query("SELECT post_id,gallery_img,img_tag,is_first FROM post_gallery where 1 AND post_id = '".$prddata->id."' AND status = 1 ORDER BY sequence ASC")->result();

					$this->data['prdmeta'] = $prdmeta = $this->db->query("SELECT * FROM post_meta where post_id = $prddata->id")->row();

					$this->data['meta_title'] = (isset($prdmeta->meta_title) && $prdmeta->meta_title!='')?$prdmeta->meta_title:'';
					$this->data['meta_key'] = (isset($prdmeta->meta_key) &&  $prdmeta->meta_key!='')?$prdmeta->meta_key:'';
					$this->data['meta_desc'] = (isset($prdmeta->meta_desc) &&  $prdmeta->meta_desc!='')?$prdmeta->meta_desc:'';
					$this->data['canonical_code'] = (isset($prdmeta->canonical_code) &&  $prdmeta->canonical_code!='')?$prdmeta->canonical_code:'';
					$this->data['extra_meta'] = (isset($prdmeta->extra_meta) &&  $prdmeta->extra_meta!='')?$prdmeta->extra_meta:'';	

					$this->data['subview']='front/subview/productdetails';								
				}
				else
				{
					 $this->data['prd_catlist'] = $cc = $this->db->query("SELECT id,cat_name,slug_url,post_img FROM category where 1 AND status = 1 AND del_status = 0 AND post_type = 'Product' and parent_id != 0 and subcat_id = 0  order by sequence,cat_name asc")->result();

					 $this->data['subview']='front/subview/catlisting';	
				}
				

				$this->data['Site_Settings'] = $this->site_settings;
				$this->load->view('front/_productmaster',$this->data);				
			}	

			public function search()
			{
				$term = $_GET['term'];

				if($term !='')
				{				
					 $this->data['prdlist'] = $prdlist = $this->db->query("SELECT post_name,slug_url,post_img,
									(select slug_url FROM category WHERE id = P.cat_id) AS category_url,
									(select slug_url FROM category WHERE id = P.subcat_id) AS subcategory_url
									 FROM post P 
									 WHERE 1 
									 AND ( post_name LIKE '%".$term."%'  OR  slug_url LIKE '%".$term."%' )
									 AND post_type = 'Product' 
									 AND status = 1 
									 AND del_status = 0")->result();	

				}

				$this->data['Site_Settings'] = $this->site_settings;
				$this->data['subview']='front/subview/productlistingsearch';	
				$this->load->view('front/_master',$this->data);
			}
		}
?>