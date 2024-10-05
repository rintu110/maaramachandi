<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model 
{
	protected $_table_name = '';
	protected $_primary_key = '';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules =  array();
	protected $_timestamp = '';
	
	function __construct() {
		parent::__construct();
	}
	
	public function get($id = NULL, $single = FALSE)
	{
		if($id != NULL)
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE)
		{
			$method = 'row';
		}
		else
		{
			$method = 'result';
		}
		if(!count($this->db->ar_orderby))
		{
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	public function get_by($where, $single = FALSE,$print = FALSE)
	{
		//print_r($where);
		$this->db->where($where);
		$res= $this->get(NULL, $single);
		//echo $this->db->last_query();
		if($print)
		{
			echo $this->db->last_query();  exit();
		}
		return $res;
	}
	
	public function save($data, $id = NULL)
	{
		
		if($id == NULL)
		{
			//echo 'hi';exit;
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
			$this->session->set_flashdata('success','New Record Created Successfully');
		}
		else
		{
			//echo 'hix';exit;
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
			$this->session->set_flashdata('success','Record Updated Successfully');
		}
		return $id;
	}
	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if(!$id)
		{
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
		if ($this->db->_error_number() == 1451)
		{
			$this->session->set_flashdata('dberror','You can\'t Delete this record. Dependency Already Exist');
		}
		return TRUE;
	}
	public function array_from_post($fileds)
	{
		$data = array();
		foreach($fileds as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
}
?>