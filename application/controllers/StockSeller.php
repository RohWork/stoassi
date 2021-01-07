<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockSeller extends CI_Controller {
	
	public function __construct() {
		
		parent ::__construct();
		
		$this->load->model('Stock_model', 'stock_md', TRUE);
		
		$this->head_data = array(
			"main"	=> "",
			"stock_list" => "",
			"stock_category" => "",
			"stock_seller" => "class='active'",
		);
	
		
	}
	
	public function list(){
		
		$this->load->library('pagination');

		$search_vo  = new stdClass();
		
		$config['per_page'] = 10;
		$offset = $this->input->get('per_page');
		$config['base_url'] = current_url() . '?' . reset_GET('per_page');
		
		$search_vo->config_per_page = $config['per_page'];
		$config['total_rows'] = $this->stock_md->count_seller_list($search_vo);

		$config = setPagination($config);
		$this->pagination->initialize($config);
		
 		$data['pagination'] = $this->pagination->create_links();
		
		
		if ($config['total_rows'] > 0) {
            $rows = $this->stock_md->get_seller_list($offset, $search_vo);
        } else {
            $rows = false;
        }
		
		
		$data['rows'] = $rows;
		$data['offset'] = $offset;
		$data['base_url'] = $config['base_url'];
		
		$this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/stock_seller_list', $data);
	}
        
    public function set_seller(){


        $code = '';
        $message = '';

        $vo = array();
        $vo['name'] = $this->input->post("insert_seller_name");
        $vo['addr'] = $this->input->post("insert_seller_addr");
        $vo['email'] = $this->input->post("insert_seller_email");
        $vo['tel'] = $this->input->post("insert_seller_tel1")."-".$this->input->post("insert_seller_tel2")."-".$this->input->post("insert_seller_tel3");
        $vo['memo'] = $this->input->post("insert_seller_memo");
        
        $vo['writer'] = "shxodwk";      //추후 로그인 연동시 작업 예정
        
        if (empty($vo['name'])){
            $code = 400;
            $message = 'insert_seller_name 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['addr'])) {
            $code = 400;
            $message = 'insert_seller_addr 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['email'])) {
            $code = 400;
            $message = 'insert_seller_email 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['tel'])) {
            $code = 400;
            $message = 'update_seller_tel 변수의 요청이 올바르지 않습니다.';
        }
        else {
            $this->db->trans_begin();
            
            $this->stock_md->insert_seller($vo);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "업체 추가 실패";
            } else {
                $this->db->trans_commit();
                $code = 200;
                $message = '추가 완료';
            }
        }

        $data = array(
            'code' => $code,
            'message' => $message,
        );

        header("Content-Type: application/json;");
        echo json_encode($data);
    }
    
    function get_seller_info(){
        
        $seller_idx = $this->input->post("idx");
        
        $where_arr = array(
                "idx" => $seller_idx,
        );
	
        $result = $this->stock_md->get_seller_info($where_arr);
        
        if(empty($result)){
            $code = 400;
            $message = '잘못된 상품정보입니다..';
        }else{
            $code = 200;
            $message = '성공.';
        }
        
        $data = array(
            'code' => $code,
            'message' => $message,
            'result'  => $result,
        );

        header("Content-Type: application/json;");
        echo json_encode($data);
           
    }
    
    public function set_update_seller(){
        
        $code = '';
        $message = '';
        
        $vo = array();
        
        $seller_idx = $this->input->post("update_seller_idx");
        $vo['name'] = $this->input->post("update_seller_name");
        $vo['addr'] = $this->input->post("update_seller_addr");
        $vo['email'] = $this->input->post("update_seller_email");
        $vo['tel'] = $this->input->post("update_seller_tel1")."-".$this->input->post("update_seller_tel2")."-".$this->input->post("update_seller_tel3");
        $vo['memo'] = $this->input->post("update_seller_memo");
        
        $vo['modifier'] = "shxodwk";      //추후 로그인 연동시 작업 예정
        
        if (empty($vo['name'])){
            $code = 400;
            $message = 'update_seller_name 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['addr'])) {
            $code = 400;
            $message = 'update_seller_addr 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['email'])) {
            $code = 400;
            $message = 'update_seller_email 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['tel'])) {
            $code = 400;
            $message = 'update_seller_tel 변수의 요청이 올바르지 않습니다.';
        }else{
            
            $this->db->trans_begin();
            
            $this->stock_md->seller_update($vo, $seller_idx);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "업체정보 수정 실패";
            } else {
                $this->db->trans_commit();
                $code = 200;
                $message = '성공';
            }
            
        }
            
        $data = array(
            'code' => $code,
            'message' => $message
        );
        
        header("Content-Type: application/json;");
        echo json_encode($data);
    }	
}

?>