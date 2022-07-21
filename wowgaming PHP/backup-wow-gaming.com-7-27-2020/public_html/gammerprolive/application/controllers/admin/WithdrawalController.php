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
	public function updateWithdrawalDetails()
	{
	    //echo "<pre>";print_r($this->input->post());die;
	    if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
		    $release_status = $this->input->post('status');
		    if($release_status == 'Pending')
		    {
		       $tran_status = '0'; 
		    }elseif($release_status == 'Success')
		    {
		        $tran_status = '1';
		    }else
		    {
		        $tran_status = '2';
		    }
		    $withdrawal_id = $this->input->post('withdrawal_id');
		    $data['release_status']  = $tran_status;
		    $data['release_date'] = date('Y-m-d H:i:s');
		    $result = $this->Admin_model->updateData(WALLET_WITHDRAWAL_REQUEST, $data, $where=array('id'=>$withdrawal_id));
			if($result)
			{
			    
			    $data1['transaction_status'] = $release_status;
			    $data1['transaction_id'] = 'trn'.time();
			    $this->Admin_model->updateData(USER_WALLET_PAYMENT, $data1, $where=array('withdrawal_request_id'=>$withdrawal_id));
			    $response = array(
                       "type" 	 => "success",
                       "message" => "Withdrawal record updated successfully"
                    );
                $this->session->set_flashdata('message', $response);
                $this->session->set_flashdata('alert-class', 'alert-success');
                redirect('admin/transaction/get-withdrawal-details');
			}
		    
		  }else
		  {
		      redirect('admin/transaction/get-withdrawal-details');
		      
		  }
	    
	}
}

?>