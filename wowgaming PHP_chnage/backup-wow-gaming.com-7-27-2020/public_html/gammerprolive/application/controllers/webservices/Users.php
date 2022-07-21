<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users Controller for webservices 
 */
class Users extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservices/Admin_model');
	}


	public function userRegister()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = USER_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if(!empty(trim($request['fname'])) && !empty(trim($request['lname'])) && !empty(trim($request['username'])) && !empty(trim($request['mobile'])) && !empty(trim($request['email'])) && !empty(trim($request['password'])) &&  !empty(trim($request['device_id'])) && !empty(trim($request['fcm_token'])))
	        {
    	        $getUserName = $this->Admin_model->getDataArray($table, $where=array('username'=>$request['username']), $orderKey='id');
    	        $getEmail = $this->Admin_model->getDataArray($table, $where=array('email'=>$request['email']), $orderKey='id');
    	        $getMobile = $this->Admin_model->getDataArray($table, $where=array('mobile'=>$request['mobile']), $orderKey='id');
    	        
    	        if($getUserName)
    	        {
    	            $response['success'] = 'False';
        	        $response['message'] = 'Username already exist';
        	        
        	    }elseif($getEmail){
        	        
        	        $response['success'] = 'False';
        	        $response['message'] = 'Email already exist';
        	        
        	    }elseif($getMobile){
        	        $response['success'] = 'False';
        	        $response['message'] = 'Mobile already exist';
        	    }else
    	        {
                    $data['fname'] = $request['fname'];
                    $data['lname'] = $request['lname'];
                    $data['username'] = $request['username'];
                    $data['mobile'] = $request['mobile'];
                    $data['email'] = $request['email'];
                    $data['device_id'] = $request['device_id'];
                    $data['password'] =  md5($request['password']);
                    $data['fcm_token'] =  md5($request['password']);
                    $data['created_date'] = date("Y-m-d");
                    if(trim($request['fcm_id']) != '')
                    {
                        $data['fcm_id'] = $request['fcm_id'];
                    }
                    $data['is_block'] = '0';
                    $data['status'] = '1';
                    $insertedId = $this->Admin_model->insertData($table, $data);
                    if($insertedId)
                    {
                        //for user wallet
                        $this->Admin_model->insertData(USER_WALLET, array('user_id'=>$insertedId, 'amount'=>'0'));
                        $response['success'] = 'True';
            	        $response['message'] = 'Your account has been register succesfully.';    
                    }else
                    {
                        $response['success'] = 'False';
            	        $response['message'] = 'Something wrong.';
                        
                    }
        	        
    	        }
	        }else
	        {
	           $response['success'] = 'False';
               $response['message'] = 'Field is empty.'; 
	        }
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function userVerification()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = USER_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if(!empty(trim($request['username'])))
	        {
	            $username = trim($request['username']);
    	        $getUsers = $this->Admin_model->getDataArrayField($table, $where="email = '".$username."' or username = '".$username."'", $orderKey='id', 'id as user_id, mobile');
    	        if($getUsers)
    	        {
    	            $response['success'] = 'True';
        	        $response['message'] = 'Email/username';
        	        $response['data'] = $getUsers[0];
        	        
        	    }else
    	        {
                    $response['success'] = 'False';
            	    $response['message'] = 'Email/username not found';
                }
	        }else
	        {
	           $response['success'] = 'False';
               $response['message'] = 'Field is empty.'; 
	        }
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function resetPassword()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = USER_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if(!empty(trim($request['user_id'])) && !empty(trim($request['password'])))
	        {
	            $data['password'] = md5(trim($request['password']));
    	        $data['modified_date'] = date('Y-m-d');
    	        
    	        $updatePassword = $this->Admin_model->updateData($table, $data, $where=array('id' => trim($request['user_id'])));
    	        if($updatePassword)
    	        {
    	            $response['success'] = 'True';
        	        $response['message'] = 'Password updated successfully';
        	    }else
    	        {
                    $response['success'] = 'False';
            	    $response['message'] = 'Password update failed';
                }
	        }else
	        {
	           $response['success'] = 'False';
               $response['message'] = 'Field is empty.'; 
	        }
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function getTermsConditions()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = TERMS_CONDITIONS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        $getTermsConditions = $this->Admin_model->getDataArray($table, $where=null, $orderKey=null);
	        if($getTermsConditions)
	        {
	            $response['success'] = 'True';
    	        $response['message'] = 'Terms and Conditions';
    	        $response['data'] = $getTermsConditions[0]['content'];	            
	        }else
	        {
    	        $response['success'] = 'False';
    	        $response['message'] = 'Terms and conditions not found';
	        }
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
	public function getPrivacyPolicy()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = PRIVACY_POLICY;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        $getPrivacyPolicy = $this->Admin_model->getDataArray($table, $where=null, $orderKey=null);
	        if($getPrivacyPolicy)
	        {
	            $response['success'] = 'True';
    	        $response['message'] = 'Privacy Policy';
    	        $response['data'] = $getPrivacyPolicy[0]['content'];	            
	        }else
	        {
    	        $response['success'] = 'False';
    	        $response['message'] = 'Privacy Policy not found';
	        }
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
    public function userLogin()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = USER_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if(!empty(trim($request['username'])) && !empty(trim($request['password'])))
	        {
	            $getDetails = $this->Admin_model->getDataArrayField($table, $where=array('username'=>trim($request['username']),'password'=> md5(trim($request['password']))), $orderKey='id', $fields='id,fname,lname,username,email,mobile,user_profile');
	            $getDetails1 = $this->Admin_model->getDataArrayField($table, $where=array('email'=>trim($request['username']),'password'=> md5(trim($request['password']))), $orderKey='id', $fields='id,fname,lname,username,email,mobile,user_profile');
	            if($getDetails)
	            {
	                $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>$getDetails[0]['id']), $orderKey=null, 'id,amount');
                    $totalAmount = $getWalletAmount[0]['amount'];
	                $response['success'] = 'true';
    	            $response['message'] = 'Login successfully';
	                $response['data'] = $getDetails[0];
	                $response['data']['total_amount'] = $totalAmount;
	                if($getDetails[0]['user_profile'] != '')
	                {
	                    $response['data']['user_profile'] = base_url().'uploads/images/profile/'.$getDetails[0]['user_profile'];
	                }
	                $getTotalWinning = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('winning_id'=>$getDetails[0]['id'],'play_status'=>'4'), $orderKey=null);
                    $getTotalLoss = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('loss_id'=>$getDetails[0]['id'],'play_status'=>'4'), $orderKey=null);
	                $response['data']['total_win'] = $getTotalWinning;
	                $response['data']['total_loss'] = $getTotalLoss;
	                
	            }elseif($getDetails1)
	            {
	                $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>$getDetails1[0]['id']), $orderKey=null, 'id,amount');
                    $totalAmount = $getWalletAmount[0]['amount'];
	                $response['success'] = 'true';
        	        $response['message'] = 'Login successfully';
	                $response['data'] = $getDetails1[0];
	                $response['data']['total_amount'] = $totalAmount;
	                if($getDetails1[0]['user_profile'] != '')
	                {
	                    $response['data']['user_profile'] = base_url().'uploads/images/profile/'.$getDetails1[0]['user_profile'];
	                }
	                $getTotalWinning = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('winning_id'=>$getDetails1[0]['id'],'play_status'=>'4'), $orderKey=null);
                    $getTotalLoss = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('loss_id'=>$getDetails1[0]['id'],'play_status'=>'4'), $orderKey=null);
	                $response['data']['total_win'] = $getTotalWinning;
	                $response['data']['total_loss'] = $getTotalLoss;
	            }else
	            {
	                $response['success'] = 'False';
        	        $response['message'] = 'Username and Password is not match';
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
	public function updateProfileImage()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = USER_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if(!empty(trim($request['user_id'])) && !empty(trim($request['profile_photo'])))
	        {
	            $getDetails = $this->Admin_model->getDataArrayField($table, $where=array('id'=>trim($request['user_id'])), $orderKey='id', $fields='id,user_profile');
	            if($getDetails)
	            {
	                $base64Image = trim($request['profile_photo']);
                    $imgdata = base64_decode($base64Image);
            		$imageName=str_replace(" ","_", 'profile_'. trim($request['user_id']).'_'.uniqid().".".'jpg');
            		$filePath = './uploads/images/profile/';	    
            		if(!is_dir($filePath))        
            		{
            			mkdir('./uploads/images/profile/', 0777, TRUE);
            		}
            		header('Content-Type: bitmap; charset=utf-8');
            		if(file_put_contents("./uploads/images/profile/".$imageName, $imgdata))
            		{
            		    
            		    $data['user_profile'] = $imageName;
            		    
                        $updateProfileImg = $this->Admin_model->updateData($table, $data, $where=array('id' => trim($request['user_id'])));
            	        if($updateProfileImg)
            	        {
            	            $response['success'] = 'True';
                	        $response['message'] = 'Profile images updated successfully';
                	        $response['data'] = array('profile_img' => base_url().'uploads/images/profile/'.$imageName); 
                	    }else
            	        {
                            $response['success'] = 'False';
                    	    $response['message'] = 'Profile image updated failed';
                        }
                        
    	            }else
    	            {
    	                $response['success'] = 'False';
            	        $response['message'] = 'Something wrong';
    	            }
	            }else{
	               $response['success'] = 'False';
            	   $response['message'] = 'User not found';
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

}
	
?>