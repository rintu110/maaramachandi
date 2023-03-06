<?php
	class Faq_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'faq';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetAll()
	 	{	 					 		
	 		$q = $this->db->get('faq')->result();
	 		return $q;
	 	}
	}

?>