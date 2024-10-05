<?php
	class Seopage_m extends MY_Model 
	{
		protected $primary_key = 'page_id';
		protected $_table = 'seo_pages';
		protected $_order_by = 'page_id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>