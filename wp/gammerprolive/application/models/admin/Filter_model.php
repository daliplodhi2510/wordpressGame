<?php 
defined('BASEPATH') or die('No Direct Script Allow');
/**
 * Filter model for get data, insert data, update data
 */
class Filter_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* Get filter data */
	function getFilterList($gameId)
    {
		$this->db->select('t1.*, t2.title as game_title');
        $this->db->from(FILTER_MASTER.' as t1');
        $this->db->join(GAME_DETAILS.' as t2','t2.id = t1.game_id');
        if($gameId)
        {
            $this->db->where('t1.game_id', $gameId);            
        }
        $this->db->order_by('t1.filter_id', "asc");
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