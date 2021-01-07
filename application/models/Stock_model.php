<?php
class Stock_model extends CI_Model {
	
	public function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE);
    }

    function count_stock_list($search_vo) {

        $this->db->select('si.*');
        $this->db->from('stock_info as si');
        $this->db->join("stock_category as sc", 'si.stock_category_idx = sc.idx', 'left');
        $this->db->join("stock_seller_info as ssi", 'si.stock_seller_idx = ssi.idx', 'left');

        /*if (!empty($search_vo->search_word)) {
            $this->db->like($search_vo->search_key, $search_vo->search_word);
        }

        if (!empty($search_vo->goods_type)) {
            $this->db->where('goods_type', $search_vo->goods_type);
        }*/

        //$this->db->where('c.state', 1);

        return $this->db->count_all_results();
    }
	
    function get_stock_list($offset, $search_vo){
		
		$this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,2),'000000')) as lv1_sc_name");
		$this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,4),'0000')) as lv2_sc_name");
		$this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,6),'00')) as lv3_sc_name");
        $this->db->select('si.* , sc.name as category_name, sc.level as stock_level, sc.state as category_state');
        $this->db->from('stock_info as si');
        $this->db->join("stock_category as sc", 'si.stock_category_idx = sc.idx', 'left');
        $this->db->join("stock_seller_info as ssi", 'si.stock_seller_idx = ssi.idx', 'left');

        /*if (!empty($search_vo->search_word)) {
            $this->db->like($search_vo->search_key, $search_vo->search_word);
        }

        if (!empty($search_vo->goods_type)) {
            $this->db->where('goods_type', $search_vo->goods_type);
        }*/

        //$this->db->where('c.state', 1);
		
        $this->db->order_by("si.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
		
        return $this->db->get()->result();
    }
	
    function count_category_list($search_vo){
        
        $this->db->select('*');
        $this->db->from('stock_category as sc');
        
		if (!empty($search_vo->category_level)) {
            $this->db->where('level', $search_vo->category_level);
        }
		if(!empty($search_vo->stock_code)){
			$this->db->where('stock_code', $search_vo->stock_code);
		}
        
        $this->db->order_by("sc.idx", "desc");
        
        return $this->db->count_all_results();
        
    }

    function get_category_list($offset, $search_vo){
        
        $this->db->select('*');
        $this->db->from('stock_category as sc');
        
		if (!empty($search_vo->category_level)) {
            $this->db->where('level', $search_vo->category_level);
        }
        
        $this->db->order_by("sc.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
        
        return $this->db->get()->result();
        
    }	
    
	function count_seller_list($search_vo){
        
        $this->db->select('*');
        $this->db->from('stock_seller_info as ssi');
        
		/*if (!empty($search_vo->category_level)) {
            $this->db->where('level', $search_vo->category_level);
        }
		if(!empty($search_vo->stock_code)){
			$this->db->where('stock_code', $search_vo->stock_code);
		}*/
        
        $this->db->order_by("ssi.idx", "desc");
        
        return $this->db->count_all_results();
        
    }

    function get_seller_list($offset, $search_vo){
        
        $this->db->select('*');
        $this->db->from('stock_seller_info as ssi');
        
		if (!empty($search_vo->category_level)) {
            $this->db->where('level', $search_vo->category_level);
        }
        
        $this->db->order_by("ssi.idx", "desc");
        $this->db->limit($search_vo->config_per_page, $offset);
        
        return $this->db->get()->result();
        
    }	
    
	
	
	
    function insert_stock($data){
		
            $data['regi_date'] = date('Y-m-d H:i:s');
            $data['modi_date'] = date('Y-m-d H:i:s');

            $this->db->insert('stock_info',$data);
    }
	
    function insert_category($data){

        $data['regi_date'] = date('Y-m-d H:i:s');
        $data['modi_date'] = date('Y-m-d H:i:s');

        $this->db->insert('stock_category',$data);
    }

    function insert_seller($data){

        $data['regi_date'] = date('Y-m-d H:i:s');
        $data['modi_date'] = date('Y-m-d H:i:s');

        $this->db->insert('stock_seller_info',$data);
    }
    
    function get_stock_category(){
                    $this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,2),'000000')) as lv1_sc_name,");
                    $this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,4),'0000')) as lv2_sc_name, ");
                    $this->db->select("(select name from stock_category where stock_code = concat(substring(sc.stock_code,1,6),'00')) as lv3_sc_name,");
        $this->db->select("sc. *");
        $this->db->from("stock_category as sc");
                    $this->db->where("state", "1");
                    $this->db->order_by("stock_code", "asc");
        return $this->db->get()->result();
    }

    function get_category_info($where){
        $this->db->select("sc.*");
        $this->db->from("stock_category sc");
        $this->db->where($where);

        return $this->db->get()->row();
    }
    function cnt_stock_category($code, $level){

            $this->db->select("sc.*");
            $this->db->from("stock_category sc");
            $this->db->where("level", $level);

            if($level > 1){
                    $this->db->like("stock_code", $code, 'after');
            }


            return $this->db->count_all_results();
    }

    function get_stock_seller(){
        $this->db->select("*");
        $this->db->from("stock_seller_info");
        return $this->db->get()->result();
    }

    function get_seller_info($where){
        $this->db->select("ssi.*");
        $this->db->from("stock_seller_info ssi");
        $this->db->where($where);

        return $this->db->get()->row();
    }

    function get_stock_info($where){

        $this->db->select("(select price from stock_history where stock_idx = si.idx limit 1) as history_price");
        $this->db->select("si.*");
        $this->db->from("stock_info si");
        $this->db->where($where);

        return $this->db->get()->row();
    }

    function stock_update($data, $idx){

        $data['modi_date'] = date('Y-m-d H:i:s');
        $this->db->where("idx",$idx);
        $this->db->update('stock_info',$data);
    }

    function category_update($data, $idx){

        $data['modi_date'] = date('Y-m-d H:i:s');
        $this->db->where("idx",$idx);
        $this->db->update('stock_category',$data);
    }

    function seller_update($data, $idx){
        $data['modi_date'] = date('Y-m-d H:i:s');
        $this->db->where("idx",$idx);
        $this->db->update('stock_seller_info',$data);
    }
	
}

?>