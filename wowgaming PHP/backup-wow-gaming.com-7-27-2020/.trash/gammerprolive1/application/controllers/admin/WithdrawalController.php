<?php 
/**
 * 
 */
class WithdrawalController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/WithdrawalModel');
		$this->load->model('admin/Admin_model');
	}

	public function viewWithdrawal(){
		$data['title']		=	"Withdaral Listing | Gammer Pro";
		$data['data']		= 	$this->WithdrawalModel->getWithdarwalData();
		$this->load->view('admin/withdrawal/listing',$data);
	}

	public function getWithdarwalDataById($id){
		$updateData = array(
			'status'	=> '1'
		);
		$this->db->where("order_id",$id);
		$this->db->update('transaction_details',$updateData);
		
		$data['details']		= 	$this->WithdrawalModel->getWithdarwalDataById($id);
	
		$this->load->view('admin/withdrawal/show-withdrawal-detail',$data);	
	}

	public function userStatistic(){
		$this->load->view('admin/withdrawal/user-statistic');		
	}
	public function getWithdrawalDetails()
	{
	    $userId = null;
	    if($_SERVER['REQUEST_METHOD'] === 'POST')
	    {
	      $userId = $this->input->post('user_id');  
	    } 
	    $data['title']		=	"Withdaral Listing | Gammer Pro";
	    $data["userList"] = $this->Admin_model->getDataArray(USER_DETAILS, $where=array('status'=>'1'), $orderKey='id,fname,lname');
	    
		$data['withdrawalRequest'] = $this->WithdrawalModel->getWalletWithdrawalReqquest($userId);
		$this->load->view('admin/withdrawal/view-withdrawal-list',$data);
	}
}

?>