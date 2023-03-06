<?php
	class Gallery_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'img_gallery';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetAll()
	 	{	 
	 		$this->db->order_by('id','DESC');					 		
	 		$q = $this->db->get('img_gallery')->result();
	 		return $q;
	 	}
	}

?>