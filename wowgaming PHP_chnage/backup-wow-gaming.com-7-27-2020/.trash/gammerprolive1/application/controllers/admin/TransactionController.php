<?php
	/**
	 * 
	 */
	class TransactionController extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("admin/TransactionModel");
			$this->load->model('admin/Admin_model');
		}

		public function transactionView(){
			$data["title"]		=	"Transaction Details | Gammer Pro";
			$data["result"]		=	$this->TransactionModel->getTransactionDetails();

			$this->load->view('admin/transaction/tranaction-listing',$data);
		}
		public function viewWalletTransactionList()
		{
		    $userId = null;
		    if($_SERVER['REQUEST_METHOD'] === 'POST')
		    {
		      $userId = $this->input->post('user_id');  
		    }  
		    $data["title"] = "Transaction Details | Gammer Pro";
		    $data["userList"] = $this->Admin_model->getDataArray(USER_DETAILS, $where=array('status'=>'1'), $orderKey='id,fname,lname');
		    
			$data["transaction"] = $this->TransactionModel->getWalletTransaction($userId);
			$this->load->view('admin/transaction/view-transaction-listing',$data);
		}
	}
?>