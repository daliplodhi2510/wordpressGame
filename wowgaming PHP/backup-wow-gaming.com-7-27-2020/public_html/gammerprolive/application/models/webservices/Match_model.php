<?php 
defined('BASEPATH') or die('No Direct Script Allow');
/**
 * Match model for weservices
 */
class Match_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getMatchList($matchId,$gameId, $filterId)
    {
		$this->db->select('t1.*, t2.title as game_title,t3.image as cover_image, t4.rule_title,t4.rules,t5.filter_title');
        $this->db->from(MATCH_DETAILS.' as t1');
        $this->db->join(GAME_DETAILS.' as t2','t2.id = t1.game_id');
        $this->db->join(COVER_IMAGES.' as t3','t3.img_id = t1.cover_image');
        $this->db->join(MATCH_RULES.' as t4','t4.rule_id = t1.match_rule');
        $this->db->join(FILTER_MASTER.' as t5','t5.filter_id = t1.filter_id');
        if($matchId)
        {
            $this->db->where('t1.id', $matchId);            
        }
        if($gameId)
        {
            $this->db->where('t1.game_id', $gameId);            
        }
        if($filterId)
        {
            $this->db->where('t1.filter_id', $filterId);            
        }
        $this->db->order_by('t1.id', "desc");
        $query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0)
		{
			$row =  $query->result_array();
			return $row;
		}
		else
		{
			return array();
		}
    }
    function getMatchPlayStatus($matchId,$gameId, $teamOneId, $teamTwoId)
    {
        if($teamOneId)
        {
            $this->db->select('t1.*,t2.play_status,t2.id as pair_id,t2.winning_id,t2.loss_id,t2.winning_photo');
            $this->db->from(CREATE_TEAM_PLAYER.' as t1');
            $this->db->join(MATCH_WITH_ASSIGN_TEAM.' as t2','t2.team_one_id = t1.team_id','right');   
            $this->db->where('t1.user_id', $teamOneId);
        
        }elseif($teamTwoId)
        {
            $this->db->select('t1.*,t2.play_status,t2.id as pair_id,t2.winning_id,t2.loss_id,t2.winning_photo');
            $this->db->from(CREATE_TEAM_PLAYER.' as t1');
            $this->db->join(MATCH_WITH_ASSIGN_TEAM.' as t2','t2.team_two_id = t1.team_id','right');
            $this->db->where('t1.user_id', $teamTwoId);
        
        }
		
        $this->db->where('t1.match_id', $matchId);
        $this->db->where('t1.game_id', $gameId);
        $this->db->where('t1.assign_with_other_team', '1');
        $this->db->where('t1.active_status', '1');
        $this->db->order_by('t1.team_id', "desc");
        $query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0)
		{
			$row =  $query->result_array();
			return $row;
		}
		else
		{
			return array();
		}
    }

}
?>