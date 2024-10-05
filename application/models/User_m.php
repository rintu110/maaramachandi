<?php
class User_m extends MY_Model 
{
	protected $primary_key = 'id';
	protected $_table = 'user_mst';
	protected $_order_by = 'id';
	public $rule_login = array(
				'email' => array('field'=>'email','label'=>'Username','rules' => 'trim|required|valid_email'),
				'password' => array('field'=>'password','label'=>'Password', 'rules'=>'trim|required')
				);
	
				
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	public function login()
	{
		$pass =$this->input->post('password');
		$md5_pass = md5($pass);

		//echo $md5_pass; exit;

		$user = $this->get_by(array(
	         'email'=> $this->input->post('email'),
	         'usr_pwd' => $md5_pass,
	         'status'=>1
         ), TRUE);	

		  if(countz($user) > 0)
		  {
			   $data = array(
			        'id'=>$user->id, 
			        'user_id'=>$user->user_id, 
			        'user_email'=>$user->email,
			        'user_typ'=>$user->usr_type,			        
			        'user_name'=>$user->full_name,			       
			        'loggedin'=>TRUE,			        
			        'session_id'=>session_id()
			        );

			 //  print_result($data); exit();
			   $this->session->set_userdata($data);
			   return TRUE;
		 }
		  return FALSE;
  }

	
	public function forgotpass()
	{
		$user = $this->get_by(array('email_id'=> $this->input->post('login_id')), TRUE);
		if(count($user))
		{
			return $user;
		}
		else
		{
			return (bool)FALSE;
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		// session_write_close();
	}
	
	public function isLoggedin()
	{
		return (bool)$this->session->userdata('loggedin');
	}

	
}
?>