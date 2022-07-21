<?php 
defined('BASEPATH') or die('No Direct Script Allow');
/**
 * Team model for weservices
 */
class Team_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAssignTeamDetails($teamOneId,$teamTwoId , $gameId, $matchId)
    {
        if($teamOneId)
        {
            $this->db->select('t1.*, t2.id as pair_id,t2.team_one_id as self_team_id, t2.team_two_id as team_assign_id, t2.play_status');
            $this->db->from(CREATE_TEAM_PLAYER.' as t1');
            $this->db->join(MATCH_WITH_ASSIGN_TEAM.' as t2','t2.team_one_id = t1.team_id','right');
            $this->db->where('t1.team_id', $teamOneId);
            
        }
        elseif($teamTwoId)
        {
            $this->db->select('t1.*, t2.id as pair_id, t2.team_one_id as team_assign_id,t2.team_two_id as self_team_id, t2.play_status');
            $this->db->from(CREATE_TEAM_PLAYER.' as t1');
            $this->db->join(MATCH_WITH_ASSIGN_TEAM.' as t2','t2.team_two_id = t1.team_id','right');
            $this->db->where('t1.team_id', $teamTwoId);
        }

        if($gameId)
        {
            $this->db->where('t1.game_id', $gameId);            
        }
        if($matchId)
        {
            $this->db->where('t1.match_id', $matchId);            
        }
        $this->db->where('t1.assign_with_other_team', '1');
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
    function getWinnerMatchDetails($pairId, $userId)
    {
        $this->db->select('t1.*,t2.winning_amount, t2.entry_fee');
        $this->db->from(MATCH_WITH_ASSIGN_TEAM.' as t1');
        $this->db->join(CREATE_TEAM_PLAYER.' as t2','t2.team_id = t1.id','left');
        //$this->db->join(MATCH_DETAILS.' as t3','t3.id = t2.match_id','left');

        if($pairId)
        {
            $this->db->where('t1.id', $pairId);            
        }
        if($userId){
            $this->db->where('t1.winning_id', $userId);
            $this->db->or_where('t1.loss_id',$userId); 
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

}
?>