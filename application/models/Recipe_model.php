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
    function insert_group($data){
        
        $data['regi_date'] = date('Y-m-d H:i:s');
        $data['modi_date'] = date('Y-m-d H:i:s');
        $data['writer'] = $this->session->userdata("user_id");
        
        $this->db->insert('recipe_group',$data);
    }
    
    function get_group_info($data){
        
        $this->db->select("*");
        $this->db->from("recipe_group");
        $this->db->where($data);

        return $this->db->get()->row();
        
        
    }
    
    function group_update($data, $idx){

        $data['modi_date'] = date('Y-m-d H:i:s');
        $data['modifier'] = $this->session->userdata("user_id");
        
        $this->db->where("idx",$idx);
        $this->db->update('recipe_group',$data);
    }
    
    
    
    function count_recipe_list($search_vo){
        
        $this->db->select('*');
        $this->db->from('recipe_info as ri');
        if(!empty($search_vo->group)){
            $this->db->where('ri.group_idx', $search_vo->group_idx);
        }
        $this->db->order_by("ri.idx", "desc");
        
        return $this->db->count_all_results();
        
    }

    function get_recipe_list($offset, $search_vo){
        
        $this->db->select('ri.*, rg.group_name');
        $this->db->from('recipe_info as ri');
        $this->db->join('recipe_group as rg',"left","ri.group_idx = rg.idx");
        $this->db->where('ri.group_idx', $search_vo->group_idx);
        $this->db->order_by("ri.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
        
        return $this->db->get()->result();
        
    }
    
}    
?>