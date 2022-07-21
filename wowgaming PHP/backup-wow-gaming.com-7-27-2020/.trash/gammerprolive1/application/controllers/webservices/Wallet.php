<?php 
/**
 * Wallet Controller for webservices
 */
class Wallet extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservices/Admin_model');
	}
    public function createWalletTransaction()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if((trim($request['user_id'])) != "" && (trim($request['amount'])) != "" && (trim($request['transaction_id'])) != "" && (trim($request['transaction_type'])) != "" && (trim($request['transaction_status'])) != "")
	        {
    	        $table = USER_WALLET_PAYMENT;
    	        $data['user_id'] = trim($request['user_id']);
    	        $data['amount'] = trim($request['amount']);
    	        $data['transaction_id'] = trim($request['transaction_id']);
    	        $data['transaction_type'] = trim($request['transaction_type']);
    	        $data['transaction_status'] = trim($request['transaction_status']);
    	        $data['created_date'] = date('Y-m-d H:i:s');
                $insertedId = $this->Admin_model->insertData($table, $data);
                if($insertedId)
                {
                    $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                    
                    $totalAmount = $getWalletAmount[0]['amount'];
                    if((trim($request['transaction_type'])) == 'credit')
                    {
                        $totalAmount = $totalAmount + $data['amount'];
                        $message = 'Amount credited successfully';
                    }elseif((trim($request['transaction_type'])) == 'debit')
                    {
                        $totalAmount = $totalAmount - $data['amount'];
                        $message = 'Amount withdrawal successfully';
                    }
                    $updateWallet = $this->Admin_model->updateData(USER_WALLET, array('amount'=>$totalAmount), $where=array('user_id' => trim($request['user_id'])));
                    
                    $response['success'] = 'True';
        	        $response['message'] = $message;
        	        $response['data'] = array('total_amount'=>$totalAmount);
                }else
                {
                    $response['success'] = 'False';
        	        $response['message'] = 'Something wrong.';
                }
	        }
	        else
	        {
	            $response['success'] = 'False';
        	    $response['message'] = 'Field is empty';
	        }
	        
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function walletTransactionHistory()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if((trim($request['user_id'])) != "")
	        {
    	        $table = USER_WALLET_PAYMENT;
                $getFilterList = $this->Admin_model->getDataArrayField($table, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id, user_id,amount,transaction_id,transaction_type,transaction_status,created_date');
                //echo "<pre>";print_r($getFilterList);die;
    	        if($getFilterList)
    	        {
    	            $response['success'] = 'True';
        	        $response['message'] = 'Wallet transaction list';
        	        $response['data'] = $getFilterList;	            
    	        }else
    	        {
        	        $response['success'] = 'False';
        	        $response['message'] = 'Wallet transaction history not found';
    	        }
	        }
	        else
	        {
	            $response['success'] = 'False';
        	    $response['message'] = 'user id is empty';
	        }
	        
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function walletWithdrawalRequest()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if((trim($request['user_id'])) != "" && (trim($request['upi_id'])) != "" && (trim($request['amount'])) != "" && (trim($request['platform'])) != "" && (trim($request['mobile_no'])) != "")
	        {
    	        $table = WALLET_WITHDRAWAL_REQUEST;
                $data['user_id'] = trim($request['user_id']);
    	        $data['upi_id'] = trim($request['upi_id']);
                $data['amount'] = trim($request['amount']);
                $data['platform'] = trim($request['platform']);
                $data['mobile_no'] = trim($request['mobile_no']);
                $data['release_status'] = '0';
                $data['request_date'] = date('Y-m-d H:i:s');
                $insertedId = $this->Admin_model->insertData($table, $data);
                if($insertedId)
                {
                    $table1 = USER_WALLET_PAYMENT;
        	        $data1['user_id'] = trim($request['user_id']);
        	        $data1['amount'] = trim($request['amount']);
        	        $data1['withdrawal_request_id'] = $insertedId;
        	        $data1['transaction_type'] = 'debit';
        	        $data1['transaction_status'] = 'Pending';
        	        $data1['created_date'] = date('Y-m-d H:i:s');
                    $insertedId1 = $this->Admin_model->insertData($table1, $data1);
                    if($insertedId1)
                    {
                        $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                        $totalAmount = $getWalletAmount[0]['amount'];
                        $totalAmount = $totalAmount - trim($request['amount']);
                        $updateWallet = $this->Admin_model->updateData(USER_WALLET, array('amount'=>$totalAmount), $where=array('user_id' => trim($request['user_id'])));
                    }
                    $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                    $totalAmount = $getWalletAmount[0]['amount'];
                    
                    $response['success'] = 'True';
            	    $response['message'] = 'Your request is being processed';
            	    $response['data'] = array('total_amount' =>$totalAmount);
                }else
                {
                    $response['success'] = 'False';
            	    $response['message'] = 'Something wrong';
                }
                
	        }
	        else
	        {
	            $response['success'] = 'False';
        	    $response['message'] = 'user id is empty';
	        }
	        
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
}

?>