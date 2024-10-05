<?php
	class Post_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'post';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}

	 	/**
     	   # Fetch Product List for home page those are featured with limit
     	**/

	 	public function GetPost()
	 	{
	 		$where = array(
	 			        'status' => 1,
	 			        'is_featured' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'Product'
	 				 );
	 		
 			$this->db->limit(6);	
 			$this->db->order_by('rand()');	 		
	 		$this->db->where($where);
	 		$this->db->select("post_name,slug_url,post_img,model,cat_id");
	 		$q = $this->db->get('post')->result();	

	 		//echo $this->db->last_query(); exit; 		

	 		return $q;
	 	}

	 	/**
     	   # Fetch Product List for listing page with specific category 
     	**/

	 	public function GetProductList($limit = null,$start = null, $Cat_ID = Null)
	 	{

	 		if($Cat_ID != '')
	 		{
	 			$this->db->where('cat_id',$Cat_ID);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'Product',
	 			        'subcat_id' => 0
	 				 );
	 		
	 		$this->db->where($where);
	 		$this->db->select("id,post_name,slug_url,post_img,model,cat_id");	 		

	 		if ($limit != '' && $start != '')
	 		{	 			
       			$this->db->limit($limit, $start);
    		}
	 		
	 		$q = $this->db->get('post')->result();	

	 		//echo $this->db->last_query(); exit; 		

	 		return $q;
	 	}

	 	/**
     	   # Fetch Product List for listing page with specific category 
     	**/

	 	public function GetProductDetails($Product_URL = Null)
	 	{
	 		if($Product_URL != '')
	 		{
	 			$this->db->where('slug_url',$Product_URL);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'Product'
	 				 );
	 		
	 		$this->db->order_by('sequence Asc','created_on Desc');
	 		$this->db->where($where);
	 		$this->db->select("id,cat_id,post_name,slug_url,post_img,news_dtls_bnr,bg_img,sml_desc,side_desc,full_desc,q_a,links,specs");	 		
	 		
	 		$q = $this->db->get('post')->row();	
	 		return $q;
	 	}

	 	/**
     	   # Fetch Related Product of Same category other than current porduct
     	**/

	 	public function RelatedProduct($Product_URL = Null,$Product_ID = Null,$Category_ID = Null)
	 	{
	 		if($Product_URL != '')
	 		{
	 			$this->db->where('slug_url !=', $Product_URL);
	 		}

	 		if($Product_ID != '')
	 		{
	 			$this->db->where('id !=', $Product_ID);
	 		}

	 		if($Category_ID != '')
	 		{
	 			$this->db->where('cat_id', $Category_ID);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'Product'
	 				 );	 		
	 		$this->db->where($where);
	 		//$this->db->limit(4);
	 		$this->db->order_by('sequence','ASC');
	 		$this->db->select("slug_url,post_img,post_name,id,cat_id");	 		
	 		$q = $this->db->get('post')->result();	

	 		//echo $this->db->last_query();exit;
	 		return $q;
	 	}



	 	/**
     	   # Fetch Blog List for homepage 
     	**/
	 	public function GetBlog($limit = null)
	 	{	

	 		if($limit !='')
	 		{
	 			$this->db->limit($limit);
	 			$this->db->order_by('rand()');
	 		}

	 		$where = array(
		 			        'status' => 1,
		 			        'is_featured' => 1,
		 			        'del_status' => 0,
		 			        'post_type' => 'News'		 			       
	 				      );
	 		
	 		 		
	 		$this->db->where($where);
	 		$this->db->select("post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,cat_id");
	 		$q = $this->db->get('post')->result();	

	 		return $q;
	 	}


	 	public function GetBlogListing($newcategory = Null)
	 	{	
	 		
	 		if($newcategory !='')
	 		{
	 			$where1 = array('slug_url'=> $newcategory);
	 			$this->db->where($where1);
	 			$this->db->select("id");
	 			$d = $this->db->get('category')->row();

	 			$where = array(
		 			        'status' => 1,
		 			        'is_featured' => 1,
		 			        'del_status' => 0,
		 			        'post_type' => 'News',
		 			        'cat_id' => $d->id
	 				      );	
	 		}
	 		else if($newcategory == Null)
	 		{
	 			$where = array(
		 			        'status' => 1,
		 			        'is_featured' => 1,
		 			        'del_status' => 0,
		 			        'post_type' => 'News'		 			       
	 				      );
	 		}
	 		 		
	 		$this->db->where($where);
	 		$this->db->select("post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,cat_id");
	 		$q = $this->db->get('post')->result();	

	 		return $q;
	 	}


	 	/**
     	   # count total number of product for pagination in product listing page
     	**/

	 	public function CountPost($Cat_ID)
	 	{
	 		if($Cat_ID != '')
	 		{
	 			$this->db->where('cat_id',$Cat_ID);
	 		}
	 		
 			$where = array(
	 			        'status' => 1,
	 			        'del_status' => 0,
	 			        'post_type' => 'Product',
	 			        'subcat_id' => 0
	 				 );		
	 		$this->db->where($where);	 		
	 		$q  = $this->db->get('post')->num_rows();		 		

	 		return $q;
	 	}

	 	/**
     	   # Search Product 
     	**/

	 	public function SearchProduct($term = Null)
	 	{

	 		if($term != '')
	 		{
	 			$this->db->like('post_name', $term);
				$this->db->like('slug_url', $term);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'Product'
	 				 );
	 		
	 		$this->db->where($where);
	 		$this->db->select("id,post_name,slug_url,post_img,model,cat_id");
	 		
	 		$q = $this->db->get('post')->result();	
	 		return $q;
	 	}

	 	public function SearchNews($term = Null)
	 	{

	 		if($term != '')
	 		{
	 			$this->db->like('post_name', $term);
				$this->db->like('slug_url', $term);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'News'
	 				 );
	 		
	 		$this->db->where($where);
	 		$this->db->select("*");
	 		
	 		$q = $this->db->get('post')->result();	
	 		return $q;
	 	}

	 	/**
     	   # Blog Details
     	**/

	 	public function BlogDetails($BlogUrl = Null)
	 	{
	 		if($BlogUrl != '')
	 		{
	 			$this->db->where('slug_url', $BlogUrl);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'News'
	 				 );	 		
	 		$this->db->where($where);
	 		$this->db->select("post_name,slug_url,post_img,sml_desc,posted_by,posted_on,full_desc,news_dtls_bnr,hits,id,news_dtls_bnr,cat_id");	 		
	 		$q = $this->db->get('post')->result();	

	 		//echo $this->db->last_query();exit;
	 		return $q;
	 	}


	 	public function RecentBlogPost($BlogUrl = Null)
	 	{
	 		if($BlogUrl != '')
	 		{
	 			$this->db->where('slug_url !=', $BlogUrl);
	 		}

	 		$where = array(
	 			        'status' => 1,	 			        
	 			        'del_status' => 0,
	 			        'post_type' => 'News'
	 				 );	 		
	 		$this->db->where($where);
	 		$this->db->limit(4);
	 		$this->db->order_by('id','Desc');
	 		$this->db->select("post_name,slug_url,post_img,sml_desc,posted_by,posted_on,hits,cat_id");	 		
	 		$q = $this->db->get('post')->result();	
	 		return $q;
	 	}

	 	public function GetCategoryName($catid)
	 	{
	 		$where = array('id'=>$catid);
	 		$this->db->where($where);
	 		$this->db->select('cat_name');	 		
	 		$q = $this->db->get('category')->row();
	 		return $q->cat_name;

	 	}
	}

?>