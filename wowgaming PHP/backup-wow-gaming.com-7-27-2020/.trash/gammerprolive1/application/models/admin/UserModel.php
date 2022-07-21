<?php 
	/**
	 * 
	 */
	class UserModel extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		// Get User Listing
		public function getUserDetails(){
			$this->db->select('*');
			$this->db->from('user_details');
			$this->db->order_by('id','DESC');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>