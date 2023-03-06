<?php
	class Donation_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'donation';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetAll()
	 	{	 
	 		$this->db->order_by('id','DESC');					 		
	 		$q = $this->db->get('donation')->result();
	 		return $q;
	 	}
	}

?>