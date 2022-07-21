<?php 
defined('BASEPATH') or die('No Direct Script Allow');
/**
 * Match model
 */
class Match_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getMatchList($matchId)
    {
		$this->db->select('t1.*, t2.title as game_title,t3.image as cover_image,t4.filter_title');
        $this->db->from(MATCH_DETAILS.' as t1');
        $this->db->join(GAME_DETAILS.' as t2','t2.id = t1.game_id');
        $this->db->join(COVER_IMAGES.' as t3','t3.img_id = t1.cover_image');
        $this->db->join(FILTER_MASTER.' as t4','t4.filter_id = t1.filter_id');
        if($matchId)
        {
            $this->db->where('t1.id', $matchId);            
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