<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->library('sendgridmail');
		
	}

	public function sendemailv3($toemail,$sub,$content)
	{		
		$emailrecords['from_email']= sender_email;
		$emailrecords['from_name']= sender_name;
		$emailrecords['subject']= $sub; 
		$emailrecords['to_email']= $toemail;
		$emailrecords['content']= $content;
		$emailrecords['replyto_email']= 'info@innovaw.com';
		$email = $this->sendgridmail->mail($emailrecords);
		return $email;	
	} 

	public function paggination($url,$total,$per_page)
	{
		$this->load->library('pagination');
		$config['page_query_string'] = true;
		$config['use_page_numbers'] = true;
		$config['reuse_query_string'] = true;
		$config['base_url'] = base_url($url);
		$config['prefix'] = '';
		$config['suffix'] = ''; 
		$config['num_links'] = 3;
		$config['uri_segment'] = 3;
		$config['offset'] = $per_page;
		$config['total_rows'] = $total;
		$config['per_page'] = 16;
		$config['full_tag_open'] = '<ul class="clearfix">';
		$config['full_tag_close'] ='</ul>';
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
	} 
}
?>