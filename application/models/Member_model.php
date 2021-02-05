<?php
class Member_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    function get_member_info($user_id,$user_pw){
        $this->db->select('*');
        $this->db->from('member_info');
        $this->db->where('id', $user_id);
        $this->db->where('pwd', $user_pw);
        
        return $this->db->get()->row_array();
    }
    function get_member_info_idx($user_idx){
        
        $this->db->select('mi.idx, mi.shop_idx, mi.id, mi.NAME AS user_name, mi.tel, mi.LEVEL');
        $this->db->select('mi.email, si.addr, si.name AS shop_name, sc.name AS shop_category , si.category_idx');
        $this->db->from('member_info as mi');
        $this->db->join('shop_info as si', 'mi.shop_idx = si.idx', 'left');
        $this->db->join('shop_category as sc', 'si.category_idx = sc.idx', 'left');
        $this->db->where('mi.idx', $user_idx);
        
        return $this->db->get()->row_array();
    
    }
    
    function count_member_list($search_vo){
        
        $this->db->select('idx');
        $this->db->from('member_info');
        

        if(!empty($search_vo->user_id)){
            $this->db->where('id', $search_vo->user_id);
        }

        
        return $this->db->count_all_results();
    }
    
    function get_member_list($offset, $search_vo){
        
        $this->db->select('mi.idx, mi.shop_idx, mi.id, mi.NAME AS user_name, mi.tel, mi.LEVEL');
        $this->db->select('mi.email, si.addr, si.name AS shop_name, sc.name AS shop_category ');
        $this->db->from('member_info as mi');
        $this->db->join('shop_info as si', 'mi.shop_idx = si.idx', 'left');
        $this->db->join('shop_category as sc', 'si.category_idx = sc.idx', 'left');
        
        $this->db->order_by("mi.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
        
        return $this->db->get()->result();
    }
    function set_member($data){
        
        $data['regi_date'] = date('Y-m-d H:i:s');
        $data['modi_date'] = date('Y-m-d H:i:s');

        $this->db->insert('member_info', $data);

        return $this->db->insert_id();
    }
    
    
}

?>

