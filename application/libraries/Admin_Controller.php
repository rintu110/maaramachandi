<?php

class Admin_Controller extends MY_Controller 
{
		
	function __construct() 
	{
		parent::__construct();
		$this->load->model('User_m');
		$exception_url=array("members/login","members/forgot_password","members/reset_password","members/expired","members/success","members/active_emailid","members/email_updated");	
		
		if(($this->User_m->isLoggedin() == FALSE))
		{
			if((in_array(uri_string(),$exception_url) == FALSE) ){
				redirect(base_url("members/login"), "refresh");
			}				
		}
		
	    $typ =$this->session->userdata('user_typ');
	    $sadmin_pages = array('sadmin','admin');

		if($typ=='Super Admin' && !in_array($this->uri->segment(1), $sadmin_pages)){
			redirect(base_url("sadmin/dashboard"));
		}
		
		if($typ=='Admin' && $this->uri->segment(1) !='admin'){
			redirect(base_url("admin/dashboard"));
		}		
	}	
}
?>