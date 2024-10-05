<?php
	class Live_Members_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'live_members';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetAll()
	 	{	 
	 		$this->db->order_by('id','DESC');					 		
	 		$q = $this->db->get('live_members')->result();
	 		return $q;
	 	}
	}

?>