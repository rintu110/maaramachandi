<?php
	class Page_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'page';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetSlug()
	 	{
	 		$where = array(
	 			       'status' => 1,
	 			       'del_status' => 0
	 				 );

	 		$this->db->where($where);
	 		$this->db->select('slug_url');
	 		$q = $this->db->get('page')->result();

	 		return $q;
	 	}

	 	public function GetAll($url = Null)
	 	{
	 		if($url != '')
	 		{
	 			$where = array(
	 			       'slug_url' => $url
	 				 );

	 			$this->db->where($where);	
	 		}	 			 		
	 		$q = $this->db->get('page')->row();

	 		return $q;
	 	}
	}

?>