<?php
	class Template_m extends MY_Model 
	{
		protected $primary_key = 'id';
		protected $_table = 'template';
		protected $_order_by = 'id';

		function __construct()
	 	{
	 		parent::__construct();
	 	}
	}

?>