<?php
	class Category_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'category';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	public function save($data)
	 	{
	 		$q = $this->db->insert($data);
	 		return $q;
	 	}

	 	public function GetCategory()
	 	{
	 		$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'Product',
	 			        'subcat_id' => 0,
	 			        'parent_id!=' => 0
	 				 );
	 		$this->db->order_by('sequence', 'asc');
	 		$this->db->where($where);
	 		$this->db->select('id,cat_name,slug_url,post_img');
	 		$q = $this->db->get('category')->result();

	 		return $q;
	 	}

	 	public function GetPCategory($Cat_URL =  Null)
	 	{
	 		if($Cat_URL !='')
	 		{
	 			$this->db->where('slug_url',$Cat_URL);
	 		}

	 		$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'Product'
	 				 );
	 		$this->db->where($where);
	 		$this->db->select('cat_name,slug_url,sml_dsc,full_dsc,meta_title,meta_key,meta_desc,extra_meta,canonical_code,id,subcat_id');
	 		$q = $this->db->get('category')->row();

	 		return $q;
	 	}


	 	public function GetCategoryImg()
	 	{
	 		$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'Product',
	 			        'is_featured' => 1	 			        
	 				 );
	 		$this->db->order_by('sequence', 'asc');
	 		$this->db->where($where);
	 		$this->db->select('id,cat_name,slug_url,post_img');
	 		$q = $this->db->get('category')->result();

	 		return $q;
	 	}

	 	public function GetCatURL($CatID = Null,$type = Null)
	 	{
	 		if($CatID !='' && $type != '')
	 		{
	 			$this->db->where('id',$CatID);	
	 			$this->db->where('post_type',$type);	
	 		}	 		
	 		$this->db->select('slug_url');
			$q = $this->db->get('category')->row();

			return $q;	 		
	 	}

	 	public function BlogCategory()
	 	{
	 		$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'News'
	 				 );
	 		$this->db->order_by('sequence', 'asc');
	 		$this->db->where($where);
	 		$this->db->select('cat_name,slug_url');
	 		$q = $this->db->get('category')->result();

	 		return $q;
	 	}
	}

?>