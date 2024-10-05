<?php
	class Partners_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'partners';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>