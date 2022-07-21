<?php 
	/**
	 * 
	 */
	class Dashboard extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->model('admin/Admin_model');
			$this->load->model('admin/UserModel');
		}
		
		public function dashboard(){
			if (($this->session->userdata && $this->session->userdata['logged_in']['is_admin']== '1')):
			$data["title"] 	=	"Dashboard";
			$data["totalUsers"] = $this->Admin_model->countRecord(USER_DETAILS, $where=null, $orderKey=null);
			$data["totalMatch"] = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=null, $orderKey=null);
			$data["totalWithdrawal"] = $this->Admin_model->countRecord(WALLET_WITHDRAWAL_REQUEST, $where=array('release_status'=>'0'), $orderKey=null);
			$data["getUsers"] = $this->UserModel->getNewRegUsers();
			//echo "<pre>";print_r($data);die;
			$this->load->view('admin/dashboard/index',$data);
		else:
			redirect(base_url().'admin');
		endif;
		}
	}
?>