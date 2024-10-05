<?php
	class MediaCoverage_m extends MY_Model
	{
		protected $primary_key = 'id';
		protected $_table = 'm_media_coverage';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function GetAll()
	 	{	 
	 		$this->db->order_by('id','DESC');					 		
	 		$q = $this->db->get('m_media_coverage')->result();
	 		return $q;
	 	}
	}

?>