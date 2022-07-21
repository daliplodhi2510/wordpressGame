<?php 
/**
 * Match Controller
 */
class MatchController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Admin_model');
		$this->load->model('admin/Match_model');
	}

	public function matchList()
	{
	    $data["title"]		=	"Match List | Gammer Pro";
	    $data["result"]		=	$this->Match_model->getMatchList($matchId=null);
        //echo "<pre>";print_r($data);die;
		$this->load->view('admin/match/match-list',$data);
	}
	public function addMatch()
	{
	    if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
		    $post = $this->input->post();
		    $data1['game_id'] = $post['game_id'];
		    $data1['filter_id'] = $post['filter_id'];
		    $data1['entry_type'] = $post['entry_type'];
		    $data1['match_title'] = $post['match_title']; 
		    $data1['match_desc'] = $post['match_desc']; 
		    $data1['cover_image'] = $post['cover_image']; 
		    $data1['platform'] = $post['platform']; 
		    $data1['entry_fee'] = $post['entry_fee']; 
		    $data1['winning_price'] = $post['winning_prize']; 
		    $data1['map'] = $post['map']; 
		    $data1['match_rule'] = $post['match_rule']; 
		    $data1['join_url'] = $post['join_url'];
		    $data1['match_status'] = '1';
		    $data1['created_date'] = date('Y-m-d H:i:s');
		    $result = $this->Admin_model->insertData(MATCH_DETAILS, $data1);
			if($result)
			{
			    $response = array(
                           "type" 	 => "success",
                           "message" => "Match added Succssfully!"
                        );
                $this->session->set_flashdata('message', $response);
                $this->session->set_flashdata('alert-class', 'alert-success');
                redirect(base_url() . "admin/match/match-list");     
                
			}else
			{
			    $response = array(
                     "type" => "error",
                     "message" => "Something wrong."
                );
                $this->session->set_flashdata('message', $response);
                $this->session->set_flashdata('alert-class', 'alert-warning');
                redirect($_SERVER['HTTP_REFERER']);
			}
		}
	    $data["title"]		=	"Add Match | Gammer Pro";
	    $data["gameList"] = $this->Admin_model->getDataArrayField($table=GAME_DETAILS, $where=array('type'=>'0'), $orderKey=null, $fields='id,title');
	    $data["filterList"] = $this->Admin_model->getDataArrayField($table=FILTER_MASTER, $where=array('status'=>'1'), $orderKey=null, $fields='filter_id,filter_title');
	    $data["coverList"] = $this->Admin_model->getDataArrayField($table=COVER_IMAGES, $where=array('img_type'=>'0'), $orderKey=null, $fields='img_id,image_name');
	    $data["matchRuleList"] = $this->Admin_model->getDataArrayField($table=MATCH_RULES, $where=array('rule_type'=>'0'), $orderKey=null, $fields='rule_id,rule_title');
	    
	    
	    //echo "<pre>";print_r($data);die;
	    $this->load->view('admin/match/add-match',$data);
	}
	public function getFilterDetails()
	{
	    $gameId = $this->input->post('game_id');
	    $getFilter = $this->Admin_model->getDataArray(FILTER_MASTER, $where=array('game_id'=>$gameId,'status'=>'1'), $orderKey='filter_id,filter_title,game_id');  
        
        $option = '<option value="">--Select Filter--</option>';
        foreach($getFilter as $filter)
		{
			
			$option .= '<option value="'.$filter['filter_id'].'">'.$filter['filter_title'].'</option>';
		}
		$response['success'] = 'true';
		$response['option'] = $option;
		echo json_encode($response);
	}

}

?>