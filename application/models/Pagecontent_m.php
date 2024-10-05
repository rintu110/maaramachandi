<?php
	class Pagecontent_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'page_content';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>