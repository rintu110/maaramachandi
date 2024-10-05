<?php
	class Post_Gallery_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'post_gallery';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	/**
     	   # Fetch Gallery Images
     	**/

	 	public function GetGallery($Post_ID = null)
	 	{
	 		if($Post_ID !='')
	 		{
	 			$this->db->where('post_id',$Post_ID);	
	 		}

	 		$where = array(
		 			        'status' => 1,
	   				 );
	 		$this->db->order_by('sequence', 'asc');
	 		$this->db->where($where);
	 		$this->db->select('post_id,gallery_img,img_tag,is_first');
	 		$q = $this->db->get('post_gallery')->result();	
	 		return $q;
	 	}
	}

?>