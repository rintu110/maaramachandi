<?php
	class Banner_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'banner';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function getAll()
	 	{
	 		$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0	 			       
	 				 );
	 		$this->db->order_by('sequence', 'asc');
	 		$this->db->where($where);	 		
	 		$q = $this->db->get('banner')->result();

	 		return $q;
	 	}
	}

?>