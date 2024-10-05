<?php 
// if (! defined('BASEPATH')) exit('No direct script access allowed');

// 	require 'sendgrid/sendgrid-php.php';

// 	Class Sendgridmail {

// 		public function __construct(){		

//     	}

//     	public function mail($records)
//     	{
    		
//     			if(isset($records['from_email'])){
//     				$records['from_email']= config_item('sender_email');
//     			}

//     			if(isset($records['from_name'])){
//     				$records['from_name']= config_item('sender_name');
//     			}

//     			/*if(isset($records['to_name'])){

//     				$records['to_name']= 'User';

//     			}*/    			

				

// 				$sengrid_id= config_item('sengrid_id');
// 				$email = new \SendGrid\Mail\Mail();
// 				$email->setFrom($records['from_email'], $records['from_name']);
// 				$email->setSubject($records['subject']);
// 				$email->addTo($records['to_email']);

// 				if(isset($records['replyto_email']))
// 				{
// 					if($records['replyto_email']!="")
// 					{
// 						$email->setReplyTo($records['replyto_email']);	
// 					}
// 				}				

// 				$email->addContent("text/html",$records['content']);
// 				$sendgrid = new \SendGrid(($sengrid_id));
// 				$out=array();

// 				try {

// 				    $response = $sendgrid->send($email);
// 				    $out['msg_status'] = $response->statusCode() . "\n";
// 				    $out['msg_header'] = $response->headers();
// 				    $out['msg'] = $response->body() . "\n";

// 				} catch (Exception $e) {
// 				    $out['msg'] = 'Caught exception: '.  $e->getMessage(). "\n";
// 				}			

// 				return $out;
//     	}
// 	}
?>