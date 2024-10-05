<?php
	class Sitemaster_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'sitemst';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function getAll()
	 	{
	 		$q = $this->db->get('sitemst')->row();	 	
	 		return $q;
	 	}
	 	
	}

?>