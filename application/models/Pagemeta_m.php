<?php
	class Pagemeta_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'page_meta';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>