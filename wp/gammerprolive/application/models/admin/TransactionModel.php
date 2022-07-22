<?php 
	/**
	 * 
	 */
	class TransactionModel extends CI_Model
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
		}

		public function getTransactionDetails(){
			$this->db->select('user_details.id,user_details.fname,user_details.lname,transaction_details.user_id,transaction_details.order_id,transaction_details.coins_used,transaction_details.req_amount,transaction_details.type,transaction_details.getway_name,transaction_details.remark,transaction_details.date');
			$this->db->from('user_details');
			$this->db->join('transaction_details','user_details.id = transaction_details.user_id');
			$query = $this->db->get();
			return $query->result_array();
			
		}
	/* Get wallet transaction */
	public function getWalletTransaction($userId)
    {
		$this->db->select('t1.*, t2.fname, t2.lname');
        $this->db->from(USER_WALLET_PAYMENT.' as t1');
        $this->db->join(USER_DETAILS.' as t2','t2.id = t1.user_id');
        if($userId)
        {
            $this->db->where('t1.user_id', $userId);            
        }
        $this->db->order_by('t1.id', "desc");
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
	}
?>