<?php
	class Post_Meta_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'post_meta';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	/**
     	   # Fetch Post Meta
     	**/

	 	public function GetMeta($Post_ID = null)
	 	{
	 		if($Post_ID !='')
	 		{
	 			$this->db->where('post_id',$Post_ID);	
	 		}
	 	
	 		$q = $this->db->get('post_meta')->row();	
	 		return $q;
	 	}
	}

?>