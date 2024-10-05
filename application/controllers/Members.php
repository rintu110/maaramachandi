<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends Admin_Controller {
	function __construct() 
	{
		parent::__construct();
		$this->load->model('User_m');
        $this->load->library('email');
        $this->load->library('pagination');		
	}
	
	public function index()
	{	
		redirect(base_url("members/login"), "refresh");
	}
	
	public function login()
	{
		$rules = $this->User_m->rule_login;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
			if($this->User_m->login() == TRUE)
			{
				$typ =$this->session->userdata('user_typ');

				#echo $typ.'1'; exit;
								
				if($typ=='Super Admin'){
					redirect(base_url("sadmin/dashboard"));
				}elseif($typ=='Admin'){
					redirect(base_url("sadmin/dashboard"));
				}				
			}
			else
			{				
				$this->session->set_flashdata('error','Email ID / Password Combination Doesn\'t Exist');
				redirect(base_url("members/login"), "refresh");
			}
		}
		if($this->User_m->isLoggedin() == TRUE)
		{
				$typ =$this->session->userdata('user_typ');

				//echo $typ.'2'; exit;
				
				if($typ=='Super Admin'){
					redirect(base_url("sadmin/dashboard"));
				}elseif($typ=='Admin'){
					redirect(base_url("sadmin/dashboard"));
				}
		}	
		$this->data['title'] = 'Login';	
		$this->data['sub_view']='';
		$this->load->view('admin/_login',$this->data);
	}
	
	
	
	
	public function email_exists($email_id)
	{
		$users=$this->User_m->get_by(array('email'=>$email_id));
		 if (count($users) > 0)
		 {
		 	 $this->form_validation->set_message('email_exists', 'Email id already exists ');
		        return false;
		 }
		 else
		 {
		    return true;
		  }
	}
	
	public function random_generate($random_string_length=6)
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		 $max = strlen($characters) - 1;
		 for ($i = 0; $i < $random_string_length; $i++) {
		      $string .= $characters[mt_rand(0, $max)];
		 }
		 return $string;
	}
	
	public function user_verification($user_id,$key)
	{
		$check_user=$this->User_m->get_by(array('user_id'=>$user_id,'keyw'=>$key,'status'=>0));
		if(count($check_user) > 0)
		{
			$this->User_m->update($user_id,array('status'=>1));
			$smsg= " Please check your mail box to active your account ";
			$typ='success';
			
		}
		else
		{
			$smsg= "Sorry.This url is not active any more";
			$typ='error';
		}
		$this->session->set_flashdata($typ,$smsg);
	     redirect(base_url("members/login/"));
	}	
	
	
	public function dashboard()
	{		
		$this->data['sub_view']='members/subview/dashboard';
		$this->load->view('members/_master',$this->data);
	}	
	
  
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('members/login'),'refresh');
	} 

	public function forgot_password()
	{
		if($_POST)
		{
			//print_result($_POST);exit;

			$rules['email']= array('field'=>'email','label'=>'Email', 'rules'=>'trim|required');
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == TRUE)
			{
				$email = $this->input->post('email');
				$iseml = $this->User_m->get_by(array('email'=>$email),TRUE);
				
				if(countz($iseml)>0)
				{
					if($iseml->status !=0)
					{						
						$key = md5(sha1(time()));

						$data_ary['rand_key'] = $key;

						$where = array('email'=>$email);
						$this->db->where($where);						
						$this->db->update('user_mst',$data_ary);

						$url = base_url('members/reset_password?action=reset&email='.$email.'&key='.$key);
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
								                    <span style="color:#333;display:inline-block">You recently requested to reset your Password for your Hirelay account. Click the button below to reset it.</span>
								                   </td>                 
								                </tr>   
								                <tr>
								                  <td>
								                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
								                      <tbody>
								                        <tr>
								                          <td class="tablepadding" align="center" style="font-size:14px; line-height:32px; padding:5px 20px 10px 5px;"> 
								                            <a href="'.$url.'" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:14px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">Reset Password</a>
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
						$this->sendemailv3($email,'Forgot password request',$txt);
						$msg = 'A reset password link has sent to your registered email id';
					    $typ = 'success';
				    }
				    else
				    {
					  	$msg = 'Seems like your account is not active yet.';
						$typ = 'error';
				    }
				}
				else
				{
					$msg = 'We dont have such email id with us.';
					$typ = 'error';
				}			
				
			}
			else
			{
				$data['errors']=validation_errors();
			}
			$this->session->set_flashdata($typ,$msg);
			redirect(base_url("members/forgot_password"));
		}
		$this->data['title'] = 'Forgot Password';	
		$this->data['sub_view']='';
		$this->load->view('admin/forget_password',$this->data);
	}	

	public function reset_password()
	{
		$action = (isset($_GET['action']) && $_GET['action'] !='')?$_GET['action']:'';
		$email = (isset($_GET['email']) && $_GET['email'] !='')?$_GET['email']:'';
		$key = (isset($_GET['key']) && $_GET['key'] !='')?$_GET['key']:'';

		if($action == '' || $email == '' || $key == '')		
		{
			redirect(base_url("members/login"));
		}

		$where = array('email'=>$email,'rand_key'=>$key);
		$this->db->where($where);
		$this->db->select('id');
		$q = $this->db->get('user_mst')->result();

        if(countz($q) > 0)
        {
        	if($_POST)
        	{
        		$pwd = $this->input->post('password');
	        	$npwd = $this->input->post('npassword');

	        	if($pwd == $npwd)
	        	{
	        		$data['usr_pwd'] = md5($pwd);
	        		$data['rand_key'] = Null;

	        		$id = $q[0]->id;

	        		$this->db->where('id',$id);
	        		$upd = $this->db->update('user_mst',$data);

	        		if($upd)
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
								                    <span style="color:#333;display:inline-block">You password has reset successfully.</span>
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
						$this->sendemailv3($email,'Password reset Successfully',$txt);

	        			redirect(base_url("members/success"));
	        		}
	        	}
	        	else
	        	{
	        		//Code here
	        	}
        	}        	
        }
        else
        {
        	redirect(base_url("members/expired"));
        }

        $this->data['title'] = 'Reset Password';	
		$this->data['sub_view']='';
		$this->load->view('admin/reset-password',$this->data);
	}

	public function expired()
	{
		$this->data['title'] = 'Link Expired';
		$this->data['sub_view']='';
		$this->load->view('admin/link_expired',$this->data);
	}

	public function success()
	{
		$this->data['title'] = 'Passsword Reset Successfully';
		$this->data['sub_view']='';
		$this->load->view('admin/success',$this->data);
	}

	public function email_updated()
	{
		$this->data['title'] = 'Email Updated Successfully';
		$this->data['sub_view'] = '';
		$this->load->view('admin/email_update',$this->data);
	}

	public function active_emailid()
	{	
		$action = (isset($_GET['action']) && $_GET['action'] !='')?$_GET['action']:'';
		$sec_email = (isset($_GET['email']) && $_GET['email'] !='')?$_GET['email']:'';
		$key = (isset($_GET['key']) && $_GET['key'] !='')?$_GET['key']:'';

		if($action == '' || $sec_email == '' || $key == '')		
		{
			redirect(base_url("members/login"));
		}

		$where = array('sec_email'=>$sec_email,'rand_key'=>$key);
		$this->db->where($where);
		$this->db->select('id,email');
		$q = $this->db->get('user_mst')->row();

        if(countz($q) > 0)
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
					    <td align="center" valign="top">
					       <table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family:Arial, Helvetica, sans-serif">
					        <tr>
					          <td>
					            <table border="0" cellpadding="0" cellspacing="0" width="100%">
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
					          <td class="tablepadding" style="border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;padding:25px 20px;">
					            <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					              <tbody>
					                <tr>
					                  <td colspan="4" valign="top" style="font-size:14px; line-height:20px; padding-bottom:5px;">
					                    <span style="color:#000; font-size:13px; font-weight: bold;">Hi Admin,</span><br />
					                    <br />
					                    <span style="color:#333;display:inline-block">Your email ID has changed successfully.</span>
					                   </td>                 
					                </tr>   
					                <tr>
					                  <td>
					                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
					                      <tbody>
					                        <tr>
					                          <td class="tablepadding" align="center" style="font-size:14px; line-height:32px; padding:5px 20px 10px 5px;"> 
					                            <a href="'.$url.'" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:14px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">CLick Here To Login
					                            </a>
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
			$this->sendemailv3($q->email,'Email Updated',$txt);

			$new_ary['email'] = $sec_email;
			$new_ary['rand_key'] = Null;
			$new_ary['sec_email'] = Null;
			$where = array('id'=>$q->id);
			$this->db->where($where);
			$this->db->update('user_mst',$new_ary);		
				
			redirect(base_url("members/email_updated"));
        }		
	
		$this->data['sub_view']='';
		$this->load->view('admin/forget_password',$this->data);
	}
}
?>