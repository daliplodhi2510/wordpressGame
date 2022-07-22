<?php 
	/**
	 * 
	 */
	class WithdrawalModel extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function getWithdarwalData(){
			$this->db->select('transaction_details.id,transaction_details.user_id,transaction_details.order_id,transaction_details.request_name,transaction_details.req_from,transaction_details.req_amount,transaction_details.coins_used,transaction_details.getway_name,transaction_details.remark,transaction_details.status,transaction_details.date,user_details.id,user_details.fname,user_details.lname');
			$this->db->from('transaction_details');
			$this->db->join('user_details','transaction_details.user_id = user_details.id');
			$this->db->order_by('transaction_details.id','DESC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function getWithdarwalDataById($id){
			$this->db->select('transaction_details.id,transaction_details.user_id,transaction_details.order_id,transaction_details.request_name,transaction_details.req_from,transaction_details.req_amount,transaction_details.coins_used,transaction_details.getway_name,transaction_details.remark,transaction_details.status,transaction_details.date,user_details.id,user_details.fname,user_details.lname,user_details.mobile');
			$this->db->from('transaction_details');
			$this->db->where('order_id',$id);
			$this->db->join('user_details','transaction_details.user_id = user_details.id');
			$this->db->order_by('transaction_details.id','DESC');
			$query = $this->db->get();
			return $query->result_array();
		}
		/* Get wallet withdrawal request */
    	public function getWalletWithdrawalReqquest($userId)
        {
    		$this->db->select('t1.*, t2.fname, t2.lname');
            $this->db->from(WALLET_WITHDRAWAL_REQUEST.' as t1');
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