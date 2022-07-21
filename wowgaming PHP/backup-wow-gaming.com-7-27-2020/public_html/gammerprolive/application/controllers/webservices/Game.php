<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Game Controller for webservices 
 */
class Game extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservices/Admin_model');
	}


	public function getGameList()
	{
	    $request = json_decode(file_get_contents("php://input"), true);
	    $table = GAME_DETAILS;
	    if((trim($request['apiusername']) == API_USERNAME) && (trim($request['apipassword']) == API_PASSWORD) && (trim($request['appversion'])) == APP_VERSION)
	    {
	        $getGameList = $this->Admin_model->getDataArray($table, $where=array('type'=>'0'), $orderKey=null);
	        if($getGameList)
	        {
	            $gameData = array();
	            $i=0;
	            foreach($getGameList as $game)
	            {
	                $gameData[$i]['id'] = $game['id'];
	                $gameData[$i]['title'] = $game['title'];
	                $gameData[$i]['banner'] = base_url().'assets/images/gameimage/'.$game['banner'];
	                $gameData[$i]['url'] = $game['url'];
	                $i++;
	            }
    	        $response['success'] = 'True';
    	        $response['message'] = 'Game list';
    	        $response['data'] = $gameData;	            
	        }else
	        {
    	        $response['success'] = 'False';
    	        $response['message'] = 'Game list not found';
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