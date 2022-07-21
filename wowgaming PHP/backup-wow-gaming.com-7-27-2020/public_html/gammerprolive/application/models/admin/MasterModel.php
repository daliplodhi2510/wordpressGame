<?php 
	/**
	 * 
	 */
	class MasterModel extends CI_Model
	{
			
		function __construct()
		{
			parent::__construct();
		}
		
		public function insert($tblname,$data){
			$this->db->insert($tblname,$data);
			echo $this->db->last_query();
			return true;
		}

		public function getGameData(){
			$this->db->select('*');
			$this->db->from('game_details');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function getRules(){
			$this->db->select('*');
			$this->db->from('tbl_rules');
			$query = $this->db->get();
			return $query->result_array();	
		}
		public function getImages(){
			$this->db->select('*');
			$this->db->from('tbl_image');
			$query = $this->db->get();
			return $query->result_array();	
		}
		public function delete($where,$tbl_name){
			$this->db->where($where);
			$this->db->delete($tbl_name);
			return true;
		}
		public function updateData($whereCon,$tblName,$updateData){
			$this->db->where($whereCon);
			$this->db->update($tblName, $updateData);
			return true;
		}
	}
?>