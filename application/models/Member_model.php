<?php
class Member_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    function get_member_info($user_id,$user_pw){
        $this->db->select('idx');
        $this->db->from('member_info');
        $this->db->where('id', $user_id);
        $this->db->where('pwd', $user_pw);
        
        return $this->db->get()->row_array();
    }
    
    function count_member_id($user_id){
        
        $this->db->select('idx');
        $this->db->from('member_info');
        $this->db->where('id', $user_id);
        
        return $this->db->count_all_results();
    }
    
    function set_member($data){
        
        $data['regi_date'] = date('Y-m-d H:i:s');
        $data['modi_date'] = date('Y-m-d H:i:s');

        $this->db->insert('member_info', $data);

        return $this->db->insert_id();
    }
    
}

?>

