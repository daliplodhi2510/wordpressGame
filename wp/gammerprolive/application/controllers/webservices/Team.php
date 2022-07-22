<?php 
/**
 * Team Controller for webservices
 */
class Team extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservices/Admin_model');
		$this->load->model('webservices/Team_model');
	}
    public function createTeam()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION) || true)
	    {
	        if(trim($request['game_id']) != "" && trim($request['match_id']) != "" && trim($request['user_id']) != "" && trim($request['nick_name']) != "" && (trim($request['unique_id'])) != "")
	        {
	            
	            //$checkActiveTeam = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('match_id'=>trim($request['match_id']),'user_id'=>trim($request['user_id']),'active_status'=>'1'), $orderKey='team_id', $fields='team_id');
	            $checkActiveTeam = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('user_id'=>trim($request['user_id']),'active_status'=>'1'), $orderKey='team_id', $fields='team_id');
	            //echo "<pre>";print_r($getMatchList);die;
    	        if($checkActiveTeam)
    	        {
        	        $response['success'] = 'False';
        	        $response['message'] = 'Team already created';

    	        }else
    	        {
    	            /*
    	            * get match winning price and entry fee by match id
    	            */
    	            $getMatchDetails = $this->Admin_model->getDataArrayField($table=MATCH_DETAILS, $where=array('id'=>trim($request['match_id'])), $orderKey=null, $fields='entry_fee, winning_price');
    	            
    	           /*
                    * Create new team  
                    */ 
    	           $data['game_id'] = trim($request['game_id']);  
    	           $data['match_id'] = trim($request['match_id']);
    	           $data['user_id'] = trim($request['user_id']);
    	           $data['nick_name'] = trim($request['nick_name']);
    	           $data['unique_id'] = trim($request['unique_id']);
    	           $data['winning_amount'] = $getMatchDetails[0]['winning_price'];
    	           $data['entry_fee'] = $getMatchDetails[0]['entry_fee'];
    	           $data['assign_with_other_team'] = '0';
    	           $data['active_status'] = '1';
    	           $data['create_datetime'] = date('Y-m-d H:i:s');
    	           $data['assign_datetime'] = '0000-00-00 00:00:00';
    	           
    	           $createTeam_id = $this->Admin_model->insertData($table=CREATE_TEAM_PLAYER, $data); 
    	           /*
                     * End create new team 
                   */
    	           if($createTeam_id)
    	           {
    	               $getSameMatchTeam = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('match_id'=>trim($request['match_id']),'user_id !='=>trim($request['user_id']),'active_status'=>'1','assign_with_other_team'=>'0'), $orderKey=null, $fields='team_id,user_id');
    	               if($getSameMatchTeam)
    	               {
    	                 /*
                         * Assign Team for match, pair two team 
                         */
    	                   $matchTeamData['team_one_id'] = $createTeam_id;
    	                   $matchTeamData['team_two_id'] = $getSameMatchTeam[0]['team_id'];
    	                   $matchTeamData['play_status'] = '1';
    	                   $matchTeamData['created_date'] = date('Y-m-d H:i:s');
    	                   
    	                    $pairId = $this->Admin_model->insertData($table=MATCH_WITH_ASSIGN_TEAM, $matchTeamData);
    	               /*
                         * End assign Team for match, pair two team
                         */ 
    	                    if($pairId)
    	                    {
    	                        $updateTeamData['assign_with_other_team'] = '1';
    	                        $updateTeamData['assign_datetime'] = date('Y-m-d H:i:s');
    	                        /*
    	                         * Update team player table after assign team
    	                         */
    	                        $updateTeamOne = $this->Admin_model->updateData($table=CREATE_TEAM_PLAYER, $updateTeamData, $where=array('team_id'=>$matchTeamData['team_one_id']));
    	                        
    	                        $updateTeamTwo = $this->Admin_model->updateData($table=CREATE_TEAM_PLAYER, $updateTeamData, $where=array('team_id'=>$matchTeamData['team_two_id']));
    	                        /*
    	                         * End Update team player table after assign team
    	                         */
    	                        /*
    	                        * Get assign team user name
    	                        */
    	                        $getAssignTeamUserDetails = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('team_id'=>$matchTeamData['team_two_id']), $orderKey=null, $fields='team_id,nick_name,unique_id');
    	                       
                                $response['success'] = 'True';
            	                $response['message'] = 'Team created and assign new team';
        	                    $response['data'] = array('team_id'=>$createTeam_id, 'assign_team_id'=>$matchTeamData['team_two_id'], 'pair_id'=>$pairId, 'nick_name'=>$getAssignTeamUserDetails[0]['nick_name'],'unique_id'=>$getAssignTeamUserDetails[0]['unique_id']);
    	                    }
    	                    
    	               }else
    	               {
    	                    $response['success'] = 'True';
            	            $response['message'] = 'Team created successfuly';
        	                $response['data'] = array('team_id'=>$createTeam_id, 'assign_team_id'=>'', 'pair_id'=>'');
    	                   
    	               }    	               
    	           }
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
	public function getAssignTeam()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION) || true)
	    {
	        if(trim($request['game_id']) != "" && trim($request['match_id']) != "" && trim($request['team_id']))
	        {
	            sleep(5);
	            /*
	            * Check team two assign id
	            */
	            $getAssignTeam = $this->Team_model->getAssignTeamDetails($teamOneId=null,$teamTwoId=trim($request['team_id']), $gameId=trim($request['game_id']), $matchId= trim($request['match_id']));
	            //echo 'team two';
	            //echo "<pre>";print_r($getAssignTeam);die;
    	        if($getAssignTeam)
    	        {
    	            /*
                    * Get assign team user name
                    */
                    $getAssignTeamUserDetails = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('team_id'=>$getAssignTeam[0]['team_assign_id']), $orderKey=null, $fields='team_id,nick_name,unique_id');
                    
    	            $assignData['team_id'] = $getAssignTeam[0]['self_team_id'];
        	        $assignData['assign_team_id'] = $getAssignTeam[0]['team_assign_id'];
        	        $assignData['pair_id'] = $getAssignTeam[0]['pair_id'];
        	        $assignData['nick_name'] = $getAssignTeamUserDetails[0]['nick_name'];
        	        $assignData['unique_id'] = $getAssignTeamUserDetails[0]['unique_id'];
        	        
        	        $response['success'] = 'True';
        	        $response['message'] = 'Assign new team';
        	        $response['data'] = $assignData;

    	        }else
    	        {
    	            /*
    	            * Check team one assign id
    	            */
    	            $getAssignTeam = $this->Team_model->getAssignTeamDetails($teamOneId=trim($request['team_id']),$teamTwoId=null, $gameId=trim($request['game_id']), $matchId= trim($request['match_id']));
    	                //echo 'team one';
                        //echo "<pre>";print_r($getAssignTeam);die;
                    if($getAssignTeam)
                    {
                        /*
                        * Get assign team user name
                        */
                        $getAssignTeamUserDetails = $this->Admin_model->getDataArrayField($table=CREATE_TEAM_PLAYER, $where=array('team_id'=>$getAssignTeam[0]['team_assign_id']), $orderKey=null, $fields='team_id,nick_name,unique_id');
                        
                        $assignData['team_id'] = $getAssignTeam[0]['self_team_id'];
            	        $assignData['assign_team_id'] = $getAssignTeam[0]['team_assign_id'];
            	        $assignData['pair_id'] = $getAssignTeam[0]['pair_id'];
            	        $assignData['nick_name'] = $getAssignTeamUserDetails[0]['nick_name'];
            	        $assignData['unique_id'] = $getAssignTeamUserDetails[0]['unique_id'];
            	        
            	        $response['success'] = 'True';
            	        $response['message'] = 'Assign new team';
            	        $response['data'] = $assignData;
                        
                    }else
                    {
                        $response['success'] = 'False';
            	        $response['message'] = 'Team not assign';
                    }            
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
	
public function winningLossMatchUpdate()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION) || true)
	    {
	        if(trim($request['user_id']) != "" && trim($request['pair_id']) != "" && trim($request['key']) != "" && trim($request['team_id']) != "")
	        {
	            $table = MATCH_WITH_ASSIGN_TEAM;
	            if(trim($request['key']) == 'win')
	            {
                    $getWinningId = $this->Admin_model->getDataArrayField($table, $where=array('id'=>trim($request['pair_id'])), $orderKey=null, $fields='id,team_one_id,team_two_id,winning_id');
    	            if($getWinningId[0]['winning_id'] != '')
    	            {
    	                $response['success'] = 'False';
        	            $response['message'] = 'Winning already upload';
    	            }else
    	            {
        	                //upload photo
        	            //for winning
    	                if(trim($request['winning_photo']) != '')
    	                {
    	                    $base64Image = trim($request['winning_photo']);
    	                    $data['winning_id'] = trim($request['user_id']);
    	                    $imgdata = base64_decode($base64Image);
                    		$imageName=str_replace(" ","_", 'winning_'. trim($request['user_id']).'_'.trim($request['pair_id']).'_'.uniqid().".".'jpg');
                    		$filePath = './uploads/images/winning/';	    
                    		if(!is_dir($filePath))        
                    		{
                    			mkdir('./uploads/images/winning/', 0777, TRUE);
                    		}
                    		header('Content-Type: bitmap; charset=utf-8');
                    		if(file_put_contents("./uploads/images/winning/".$imageName, $imgdata))
                    		{
                    		    
                    		    $data['winning_photo'] = $imageName;
                    		    $data['play_status'] = '3'; // '1': Process, '2':Playing, '3': End, '4': Closed
        	                    $data['winning_date'] = date('Y-m-d H:i:s');
        	                    $data['updated_date'] = date('Y-m-d H:i:s');
        	                    
        	                    $updatePair = $this->Admin_model->updateData($table, $data, $where=array('id' => trim($request['pair_id'])));
                    	        if($updatePair)
                    	        {
                    	            
                    	            $this->Admin_model->updateData(CREATE_TEAM_PLAYER, array('active_status'=>'0'), $where=array('team_id' => trim($request['team_id'])));// team active status update
                    	            
                    	            $getWinnigAmount = $this->Team_model->getWinnerMatchDetails(trim($request['pair_id']), null);
                    	            /*
                    	               * Check loss_id is update or not, if updated then close the match and send the notification to winner team.
                    	            */
                    	            
                    	            $getLossId = $this->Admin_model->getDataArrayField($table, $where=array('id'=>trim($request['pair_id'])), $orderKey=null, $fields='id,loss_id,team_one_id,team_two_id');
                    	            if($getLossId[0]['loss_id'] != '')
                    	            {
                    	                $data1['play_status'] = '4'; // '1': Process, '2':Playing, '3': End, '4': Closed
                	                    $data1['loss_date'] = date('Y-m-d H:i:s');
                	                    $data1['updated_date'] = date('Y-m-d H:i:s');
                	                    $updatePair = $this->Admin_model->updateData($table, $data1, $where=array('id' => trim($request['pair_id'])));
                	                    
                	                    /* 
                	                        *send notification to winner
                	                   */
                	                   $addwallet['user_id'] = trim($request['user_id']);
                	                   $addwallet['pair_id'] = trim($request['pair_id']);
                	                   $addwallet['amount'] = $getWinnigAmount[0]['winning_amount'];
                	                   $addwallet['transaction_type'] = 'credit';
                	                   $addwallet['transaction_status'] = 'success';
                	                   $addwallet['remark'] = 'winning amount';
                	                   $addwallet['created_date'] = date('Y-m-d H:i:s');
                	                   $insertedWinningAmount = $this->Admin_model->insertData(USER_WALLET_PAYMENT, $addwallet);
                	                   if($insertedWinningAmount)
                	                   {
                    	                    $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                                            $totalAmount = $getWalletAmount[0]['amount'];
                                            $totalAmount = $totalAmount + $addwallet['amount'];
                                            $updateWallet = $this->Admin_model->updateData(USER_WALLET, array('amount'=>$totalAmount), $where=array('user_id' => trim($request['user_id'])));
                                        }            	                   
                	                   
                	                   //write the code below for notification
                	                    
                    	            }
                    	            $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                                    $totalAmount = $getWalletAmount[0]['amount'];
                                    
                                    $getTotalWinning = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('winning_id'=>trim($request['user_id']),'play_status'=>'4'), $orderKey=null);
                                    $getTotalLoss = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('loss_id'=>trim($request['user_id']),'play_status'=>'4'), $orderKey=null);
                                    
                    	            $response['success'] = 'True';
                        	        $response['message'] = 'Record updated successfully';
                        	        $response['data'] = array('total_amount' =>$totalAmount,'total_win'=>$getTotalWinning,'total_loss'=>$getTotalLoss); 
                        	    }else
                    	        {
                                    $response['success'] = 'False';
                            	    $response['message'] = 'Record updated failed';
                                }
                    		}else
                    		{
                    		    $response['success'] = 'False';
                            	$response['message'] = 'Something wrong';
                    		}
    	                }
    	                else
    	                {
    	                    $response['success'] = 'False';
                    	    $response['message'] = 'Winning photo is empty';
    	                }
    	            } 
	            }else
	            {
	                $getLossId = $this->Admin_model->getDataArrayField($table, $where=array('id'=>trim($request['pair_id'])), $orderKey=null, $fields='id,loss_id,team_one_id,team_two_id');
    	            if($getLossId[0]['loss_id'] != '')
    	            {
    	                $response['success'] = 'False';
        	            $response['message'] = 'Loss already upload';
    	            }else
    	            {
    	               //for loss
    	                $data['loss_id'] = trim($request['user_id']);
                        $data['play_status'] = '3'; // '1': Process, '2':Playing, '3': End, '4': Closed
    	                $data['loss_date'] = date('Y-m-d H:i:s');
    	                $data['updated_date'] = date('Y-m-d H:i:s');
    	                
    	                $updatePair = $this->Admin_model->updateData($table, $data, $where=array('id' => trim($request['pair_id'])));
            	        if($updatePair)
            	        {
            	            $this->Admin_model->updateData(CREATE_TEAM_PLAYER, array('active_status'=>'0'), $where=array('team_id' => trim($request['team_id'])));// team active status update
            	            /*
            	               * Check winning_id is update or not, if updated then close the match and send the notification to winner team.
            	            */
            	            
            	            $getWinningId = $this->Admin_model->getDataArrayField($table, $where=array('id'=>trim($request['pair_id'])), $orderKey=null, $fields='id,team_one_id,team_two_id,winning_id');
            	            if($getWinningId[0]['winning_id'] != '')
            	            {
            	                $data1['play_status'] = '4'; // '1': Process, '2':Playing, '3': End, '4': Closed
        	                    $data1['winning_date'] = date('Y-m-d H:i:s');
        	                    $data1['updated_date'] = date('Y-m-d H:i:s');
        	                    $updatePair = $this->Admin_model->updateData($table, $data1, $where=array('id' => trim($request['pair_id'])));
        	                    
        	                    /* 
        	                        *send notification to winner
        	                   */
        	                  //write the code below for notification
        	                }
        	                $getWalletAmount = $this->Admin_model->getDataArrayField(USER_WALLET, $where=array('user_id'=>trim($request['user_id'])), $orderKey=null, 'id,amount');
                            $totalAmount = $getWalletAmount[0]['amount'];
                    	    
                    	    $getTotalWinning = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('winning_id'=>trim($request['user_id']),'play_status'=>'4'), $orderKey=null);
                            $getTotalLoss = $this->Admin_model->countRecord(MATCH_WITH_ASSIGN_TEAM, $where=array('loss_id'=>trim($request['user_id']),'play_status'=>'4'), $orderKey=null);
                                    
                    	    
            	            $response['success'] = 'True';
                	        $response['message'] = 'Record updated successfully';
                	        $response['data'] = array('total_amount' =>$totalAmount,'total_win'=>$getTotalWinning,'total_loss'=>$getTotalLoss);
                	    }else
            	        {
                            $response['success'] = 'False';
                    	    $response['message'] = 'Record updated failed';
                        }
    	            }
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
	public function userMatchHistory()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION) || true)
	    {
	        if(trim($request['user_id']) != "")
	        {
	            $userId = trim($request['user_id']);
	            $getMatchHistory = $this->Team_model->getWinnerMatchDetails(null, $userId);
	            //echo "<pre>";print_r($getMatchHistory);die;
	            if($getMatchHistory)
	            {
	                $i=0;
	                $matchHis = array();
	                foreach($getMatchHistory as $history)
	                {
	                    if($history['winning_id'] == $userId)
	                    {
	                        $matchHis[$i]['pair'] = $history['id']; 
	                        $matchHis[$i]['match-status'] = 'win';
	                        $matchHis[$i]['match-date'] = date('d-m-Y', strtotime($history['created_date']));
	                        $matchHis[$i]['match-time'] = date('H:i:s', strtotime($history['created_date']));
	                        $matchHis[$i]['amount'] = $history['winning_amount'];
	                        $matchHis[$i]['match-title'] = $history['match_title'];
	                        $matchHis[$i]['cover-img'] = base_url().'assets/images/gameimage/'.$history['cover_image'];
	                        $getOponentTeam = $this->Admin_model->getDataArrayField(CREATE_TEAM_PLAYER, $where="`team_id` = ".$history['team_one_id']." or `team_id` = ".$history['team_two_id']." and `user_id` != ".$userId, $orderKey=null, 'nick_name');
	                        if($getOponentTeam)
	                        {
	                           $matchHis[$i]['oponent_name'] = $getOponentTeam[0]['nick_name']; 
	                        }else
	                        {
	                          $matchHis[$i]['oponent_name'] = '';  
	                        }
	                        
	                    }else
	                    {
	                        $matchHis[$i]['pair'] = $history['id']; 
                            $matchHis[$i]['match-status'] = 'loss'; 
	                        $matchHis[$i]['match-date'] = date('d-m-Y', strtotime($history['created_date']));
	                        $matchHis[$i]['match-time'] = date('H:i:s', strtotime($history['created_date']));
	                        $matchHis[$i]['amount'] = $history['entry_fee'];;
	                        $matchHis[$i]['match-title'] = $history['match_title'];
	                        $matchHis[$i]['cover-img'] = base_url().'assets/images/gameimage/'.$history['cover_image'];
	                        $getOponentTeam = $this->Admin_model->getDataArrayField(CREATE_TEAM_PLAYER, $where="`team_id` = ".$history['team_one_id']." or `team_id`= ".$history['team_two_id']." and `user_id` != ".$userId, $orderKey=null, 'nick_name');
	                        if($getOponentTeam)
	                        {
	                           $matchHis[$i]['oponent_name'] = $getOponentTeam[0]['nick_name']; 
	                        }else
	                        {
	                          $matchHis[$i]['oponent_name'] = '';  
	                        }
	                    }
	                    $i++;     
	                }
	                
	                $response['success'] = 'True';
        	        $response['message'] = 'Match history list';
        	        $response['data'] = $matchHis;
	                
	            }else
	            {
	                $response['success'] = 'False';
        	        $response['message'] = 'Match histry not found'; 
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
	/*
	* This function used for play status update. play status should be '2':Playing, '3': End
	*/
	public function updateMatchPlayStatus()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION))
	    {
	        if(trim($request['pair_id']) != "" && trim($request['play_status']) != "")
	        {
	            $table = MATCH_WITH_ASSIGN_TEAM;
	            $data['play_status'] = trim($request['play_status']); // '1': Process, '2':Playing, '3': End, '4': Closed
	            $data['updated_date'] = date('Y-m-d H:i:s');
	                
	            $updatePlayStatus = $this->Admin_model->updateData($table, $data, $where=array('id' => trim($request['pair_id'])));
	            if($updatePlayStatus)
	            {
	                $response['success'] = 'True';
        	        $response['message'] = 'Play Status updated successfully';
                 
	            }else
	            {
	                $response['success'] = 'False';
        	        $response['message'] = 'Play Status updated failed'; 
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
		/*
	* This function used for play status update. play status should be '2':Playing, '3': End
	*/
	public function deleteTeam()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    //echo "<pre>";print_r($request);die;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION))
	    {
	        if(trim($request['team_id']) != "")
	        {
	            $table = CREATE_TEAM_PLAYER;
	            
	            $where['team_id'] = trim($request['team_id']);
	            $where['assign_with_other_team'] = '0'; // '0': Not assign, '1':Assign
	            $where['active_status'] = '1';
	                
	            $deletedTeamRecord = $this->Admin_model->deleteRecord($table, $where);
	            if($deletedTeamRecord)
	            {
	                $response['success'] = 'True';
        	        $response['message'] = 'Match deleted successfully';
                 
	            }else
	            {
	                $response['success'] = 'False';
        	        $response['message'] = 'Something wrong'; 
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
	public function sendNotificationForTeam()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
        if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion']) == APP_VERSION))
	    {
	        if(trim($request['user_id']) != "" && trim($request['team_id']) != "")
	        {
	            $device_tokens = 'c49c432a52eb94ac';
	            $url = 'https://fcm.googleapis.com/fcm/send';
                $title= "Gamepro";
                $message = "Ravisk is looking for an opponent in C Royale win Rupee 10";
                //type - Normal, DeepLink
                  $fields = array('registration_ids' => array($device_tokens),
                      'notification' => array("title" => $title, "body" => $message), 'data' => array('type' => 'N', "message" => "", "click_action" => "FLUTTER_NOTIFICATION_CLICK", "sound" => "default"));
                
                echo $fields = json_encode($fields);
                
                
                $headers = array('Authorization: key=' . "AAAA1-PjeQ4:APA91bEs3PtDLYoeuXeFFgbz3yaHRQqxjmwRF9Skz5zVckacRXcF-C5tZ4g7CE-k6k9UBn5qxpmK6ayxkXeCuULWEKX5kD2-IdbCBX2fpDccRWUlQZNOCXbWPoNCjFq9ERVV_h7I5w6X", 'Content-Type: application/json');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_POST, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                  $result = curl_exec($ch);
                  curl_close($ch);
	            
	            $response['success'] = 'True';
        	    $response['message'] = 'Notification Send';
	            
	        }else
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