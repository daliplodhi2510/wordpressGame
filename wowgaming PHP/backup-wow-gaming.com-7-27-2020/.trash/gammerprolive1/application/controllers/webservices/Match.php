<?php 
/**
 * Match Controller for webservices
 */
class Match extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservices/Admin_model');
		$this->load->model('webservices/Match_model');
	}
	public function filterList()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        if((trim($request['game_id'])) != "")
	        {
    	        $table = FILTER_MASTER;
                $getFilterList = $this->Admin_model->getDataArrayField($table, $where=array('status'=>'1','game_id'=>trim($request['game_id'])), $orderKey=null, 'filter_id, filter_title');
                //echo "<pre>";print_r($getFilterList);die;
    	        if($getFilterList)
    	        {
    	            $response['success'] = 'True';
        	        $response['message'] = 'Filter list';
        	        $response['data'] = $getFilterList;	            
    	        }else
    	        {
        	        $response['success'] = 'False';
        	        $response['message'] = 'Filter list not found';
    	        }
	        }
	        else
	        {
	            $response['success'] = 'False';
        	    $response['message'] = 'Game id is empty';
	        }
	        
	    }else
	    {
	        $response['success'] = 'False';
    	    $response['message'] = 'Api authentication error';
	    }
		die(json_encode($response));
	}
    public function matchList()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION )
	    {
	        if((trim($request['game_id'])) != "" && (trim($request['filter_id'])) != "" && (trim($request['user_id'])) != "")
	        {
	            $getMatchList = $this->Match_model->getMatchList($matchId=null,$gameId=trim($request['game_id']),$filterId = trim($request['filter_id']));
	            //echo "<pre>";print_r($getMatchList);die;
    	        if($getMatchList)
    	        {
    	            $matchData = array();
    	            $i=0;
    	            foreach($getMatchList as $match)
    	            {
    	                $matchData[$i]['match_id'] = $match['id'];
    	                $matchData[$i]['game_id'] = $match['game_id'];
    	                $matchData[$i]['filter_id'] = $match['filter_id'];
    	                $matchData[$i]['filter_title'] = $match['filter_title'];
    	                $matchData[$i]['entry_type'] = $match['entry_type'];
    	                $entry_title = '';
    	                if($match['entry_type'] == '1'){
    	                    $entry_title = 'Trial';
    	                }elseif($match['entry_type'] == '2')
    	                {
    	                    $entry_title = 'Paid';
    	                }else
    	                {
    	                    $entry_title = '';
    	                }
    	                $matchData[$i]['entry_type_title'] = $entry_title;
    	                $matchData[$i]['game_title'] = $match['game_title'];
    	                $matchData[$i]['match_title'] = $match['match_title'];
    	                $matchData[$i]['cover_img'] = base_url().'assets/images/gameimage/'.$match['cover_image'];
    	                $matchData[$i]['entry_fee'] = $match['entry_fee'];
    	                $matchData[$i]['winning_price'] = $match['winning_price'];
    	                $matchData[$i]['how_to_join_url'] = $match['join_url'];
    	                $matchData[$i]['match_desc'] = $match['match_desc'];
    	                $matchData[$i]['match_rule_id'] = $match['match_rule'];
    	                $matchData[$i]['rule_title'] = $match['rule_title'];
    	                $matchData[$i]['rules'] = $match['rules'];
    	                //$matchData[$i]['play_status'] = '0'; //0: Incomplete, 1: complete,
    	                $getTeanOneMatchPlayStatus = $this->Match_model->getMatchPlayStatus($match['id'],$match['game_id'], $teamOneId=trim($request['user_id']),$teamTwoId=null);
    	                $getTeanTwoMatchPlayStatus = $this->Match_model->getMatchPlayStatus($match['id'],$match['game_id'], $teamOneId=null,$teamTwoId=trim($request['user_id']));
    	                if($getTeanOneMatchPlayStatus)
    	                {
    	                    $matchData[$i]['play_status'] = $getTeanOneMatchPlayStatus[0]['play_status'];
    	                    $matchData[$i]['pair_id'] = $getTeanOneMatchPlayStatus[0]['pair_id'];
    	                    $matchData[$i]['team_id'] = $getTeanOneMatchPlayStatus[0]['team_id'];
    	                    //for update winning and loss id on team assign table
    	                    if($getTeanOneMatchPlayStatus[0]['play_status'] == '3')
    	                    {
    	                        if($getTeanOneMatchPlayStatus[0]['winning_id'] != '')
    	                        {
    	                           if($getTeanOneMatchPlayStatus[0]['winning_id'] != trim($request['user_id']))
    	                           {
    	                               $matchData[$i]['play_status'] = '2';
    	                           }
    	                        }elseif($getTeanOneMatchPlayStatus[0]['loss_id'] != '')
    	                        {
    	                            if($getTeanOneMatchPlayStatus[0]['loss_id'] != trim($request['user_id']))
    	                           {
    	                               $matchData[$i]['play_status'] = '2';
    	                           }
    	                        }else
    	                        {
    	                            $matchData[$i]['play_status'] = $getTeanOneMatchPlayStatus[0]['play_status'];
    	                        }
    	                    }else
    	                    {
    	                        $matchData[$i]['play_status'] = $getTeanOneMatchPlayStatus[0]['play_status'];
    	                    }
    	                }elseif($getTeanTwoMatchPlayStatus)
    	                {
    	                    $matchData[$i]['play_status'] = $getTeanTwoMatchPlayStatus[0]['play_status'];
    	                    $matchData[$i]['pair_id'] = $getTeanTwoMatchPlayStatus[0]['pair_id'];
    	                    $matchData[$i]['team_id'] = $getTeanTwoMatchPlayStatus[0]['team_id'];
    	                    //for update winning and loss id on team assign table
    	                    if($getTeanTwoMatchPlayStatus[0]['play_status'] == '3')
    	                    {
    	                        if($getTeanTwoMatchPlayStatus[0]['winning_id'] != '')
    	                        {
    	                           if($getTeanTwoMatchPlayStatus[0]['winning_id'] != trim($request['user_id']))
    	                           {
    	                               $matchData[$i]['play_status'] = '2';
    	                           } 
    	                        }elseif($getTeanTwoMatchPlayStatus[0]['loss_id'] != '')
    	                        {
    	                            if($getTeanTwoMatchPlayStatus[0]['loss_id'] != trim($request['user_id']))
    	                           {
    	                               $matchData[$i]['play_status'] = '2';
    	                           }
    	                        }else
    	                        {
    	                            $matchData[$i]['play_status'] = $getTeanTwoMatchPlayStatus[0]['play_status'];
    	                        }
    	                    }else
    	                    {
    	                        $matchData[$i]['play_status'] = $getTeanTwoMatchPlayStatus[0]['play_status'];
    	                    }
    	                }else
    	                {
    	                    $matchData[$i]['play_status'] = '0';
    	                    $matchData[$i]['pair_id'] = '';
    	                    $matchData[$i]['team_id'] = '';
    	                    
    	                }
    	                
    	                $i++;
    	            }
        	        $response['success'] = 'True';
        	        $response['message'] = 'Match list';
        	        $response['data'] = $matchData;	            
    	        }else
    	        {
        	        $response['success'] = 'False';
        	        $response['message'] = 'Match list not found';
    	        }
	        }
	        else
	        {
	            $response['success'] = 'False';
        	    $response['message'] = 'Game id is empty';
	            
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