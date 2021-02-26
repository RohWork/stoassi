<?php
class Recipe_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    function count_group_list($search_vo){
        
        $this->db->select('*');
        $this->db->from('recipe_group as rg');
        $this->db->where('rg.shop_idx', $search_vo->shop_idx);
        $this->db->order_by("rg.idx", "desc");
        
        return $this->db->count_all_results();
        
    }

    function get_group_list($offset, $search_vo){
        
        $this->db->select('*');
        $this->db->from('recipe_group as rg');
        $this->db->where('rg.shop_idx', $search_vo->shop_idx);
        $this->db->order_by("rg.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
        
        return $this->db->get()->result();
        
    }	
}    
?>