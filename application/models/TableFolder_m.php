<?php
	class TableFolder_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'table_folder';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>