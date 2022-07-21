<?php 
	/**
	 * 
	 */
	class PagesModel extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function store($tblName,$dataArray){
			$this->db->insert($tblName,$dataArray);
			return true;
		}

		public function getData($tableName){
			$this->db->select('*');
			$this->db->from($tableName);
			$this->db->order_by('id','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			return $query->result_object();

		}
		
		public function getDataFromContactUs($tableName){
			$this->db->select('*');
			$this->db->from($tableName);
			$query = $this->db->get();
			return $query->result_object();
		}

		public function updateData($whereCon,$tblName,$updateData){
			$this->db->where($whereCon);
			$this->db->update($tblName, $updateData);
			return true;
		}
	}
?>