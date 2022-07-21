<?php 
defined('BASEPATH') or die('No Direct Script Allow');
/**
 * Admin model for get data, insert data, update data
 */
class Admin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* Get data */
	public function getDataArray($table, $where, $orderKey)
	{
		$this->db->select('*');
		$this->db->from($table);
		if($where){
		$this->db->where($where);
		}
		if($orderKey)
		{
    		$this->db->order_by($orderKey, "desc");		    
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0)
		{
			$row =  $query->result_array();
			return $row;
		}
		else
		{
			return array();
		}
	}
	/* Get data with specific field
	  
	*/ 
	public function getDataArrayField($table, $where, $orderKey, $fields)
	{
		if($fields)
		{
			$this->db->select($fields);			
		}else
		{
			$this->db->select('*');			
		}
			$this->db->from($table);
		
		if($where){
			
			$this->db->where($where);
		}
		if($orderKey)
		{
    		$this->db->order_by($orderKey, "desc");		    
		}
		$query = $this->db->get();
		//echo $this->db->last_query();//die;
		if($query->num_rows() > 0)
		{
			$row =  $query->result_array();
			return $row;
		}
		else
		{
			return array();
		}
	}
	/* Insert Data
	*/
	public function insertData($table, $data)
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/* update record
	*/
	public function updateData($table, $data, $where)
	{
	    $this->db->where($where);
		$this->db->update($table, $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
		    return false;
		}
	}
	/* Delete Record
	*/
	public function deleteRecord($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        if($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
		    return false;
		}
    }

}
?>