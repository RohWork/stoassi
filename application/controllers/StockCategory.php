<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockCategory extends CI_Controller {
	
	public function __construct() {
		
		parent ::__construct();
		$this->allow=array();
                
		$this->load->model('Stock_model', 'stock_md', TRUE);
		
		$this->head_data = array(
			"main"	=> "",
                        "stock" => "active",
                        "stock_drop" => "show",
			"stock_list" => "",
			"stock_category" => "class='active'",
			"stock_seller" => "",
		);
	
		
	}
	
	public function category_list(){
		
		$this->load->library('pagination');

		$search_vo  = new stdClass();
		
		$config['per_page'] = 10;
		$offset = $this->input->get('per_page');
		$search_vo->category_level = $this->input->get('category_level');
		
		$config['base_url'] = current_url() . '?' . reset_GET('per_page');
		
		$search_vo->config_per_page = $config['per_page'];
		
		
		$config['total_rows'] = $this->stock_md->count_category_list($search_vo);

		$config = setPagination($config);
		$this->pagination->initialize($config);
		
 		$data['pagination'] = $this->pagination->create_links();
		
		
		if ($config['total_rows'] > 0) {
            $rows = $this->stock_md->get_category_list($offset, $search_vo);
        } else {
            $rows = false;
        }
		
		
		
		$params['category_level'] = $search_vo->category_level;
		
		$data['params'] = $params;
		$data['rows'] = $rows;
		$data['base_url'] = $config['base_url'];
		$data['offset'] = $offset;

		
		$this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/stock_category_list', $data);
	}
	
	function get_category_info(){
        
        $category_idx = $this->input->post("idx");
        
        $where_arr = array(
                "idx" => $category_idx,
        );
	
        $result = $this->stock_md->get_category_info($where_arr);
        
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
	
    function get_stock_category(){

        $data = $this->stock_md->get_stock_category();

        header("Content-Type: application/json;");
        echo json_encode($data);

    }
	function get_category_code(){
		
		$data = new stdClass();
		
		$code = $this->input->post("code");
		$level = $this->input->post("level");
		
		$cnt = $this->stock_md->cnt_stock_category($code, $level);
		$cnt = sprintf('%02d', $cnt+1);
		
		$data->code = CATEGORY_CODE[substr($cnt,0,1)].CATEGORY_CODE[substr($cnt,1,1)];

		header("Content-Type: application/json;");
        echo json_encode($data);
	}
	
	public function set_update_category(){
        
        $code = '';
        $message = '';
        
        $vo = array();
        
        $category_idx = $this->input->post("update_category_idx");
        $vo['name'] = $this->input->post("update_category_name");
		$vo['state'] = $this->input->post("update_category_useyn");
                
        if (empty($vo['name'])){
            $code = 400;
            $message = 'update_category_name 변수의 요청이 올바르지 않습니다.';
        } else{
            
            $this->db->trans_begin();
            
            $this->stock_md->category_update($vo, $category_idx);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "타입 수정 실패";
            } else {
                $this->db->trans_commit();
                $code = 200;
                $message = '타입 수정 완료';
            }
            
        }
            
        $data = array(
            'code' => $code,
            'message' => $message
        );
        
        header("Content-Type: application/json;");
        echo json_encode($data);
    }	
	
	public function set_category(){
        
        $code = '';
        $message = '';
        
        $vo = array();
        
		$vo['name'] = $this->input->post("insert_category_name");
		$category_code_lv1 = $this->input->post("insert_category_code_lv1");
		$category_code_lv2 = $this->input->post("insert_category_code_lv2");
		$category_code_lv3 = $this->input->post("insert_category_code_lv3");
		$category_code_lv4 = $this->input->post("insert_category_code_lv4");
		
		$category_selectlv1 = $this->input->post("insert_category_lv1");
		$category_selectlv2 = $this->input->post("insert_category_lv2");
		$category_selectlv3 = $this->input->post("insert_category_lv3");
			
                
        if (empty($vo['name'])){
            $code = 400;
            $message = 'insert_category_name 변수의 요청이 올바르지 않습니다.';
        }else if(($category_selectlv1 != 0)&&(substr($category_selectlv1,0,1) != $category_code_lv1)){
			$code = 401;
			$message = "1레벨 카테고리값이 서로다릅니다.";
		}else if(($category_selectlv2 != 0)&&(substr($category_selectlv2,1,1) != $category_code_lv2)){
			$code = 402;
			$message = "2레벨 카테고리값이 서로다릅니다.";
		}else if(($category_selectlv3 != 0)&&(substr($category_selectlv3,2,1) != $category_code_lv3)){
			$code = 403;
			$message = "3레벨 카테고리값이 서로다릅니다.";
		}else{
            
            $this->db->trans_begin();
			
			
			
			if(!empty($category_code_lv4)){
				$vo['level'] = 4;
				$vo['stock_code'] = $category_code_lv1.$category_code_lv2.$category_code_lv3.$category_code_lv4;
				
			}else if(!empty($category_code_lv3)){
				$vo['level'] = 3;
				$vo['stock_code'] = $category_code_lv1.$category_code_lv2.$category_code_lv3."00";
			}else if(!empty($category_code_lv2)){
				$vo['level'] = 2;	
				$vo['stock_code'] = $category_code_lv1.$category_code_lv2."0000";
			}else{
				$vo['level'] = 1;
				$vo['stock_code'] = $category_code_lv1."000000";
			}
			
			$cnt_where = new stdClass();
			
			$cnt_where->stock_code = $vo['stock_code'];

			
			$cnt = $this->stock_md->count_category_list($cnt_where);

			if($cnt < 1){            
				$this->stock_md->insert_category($vo);
				
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$code = 400;
					$message = "타입 추가 실패";
				} else {
					$this->db->trans_commit();
					$code = 200;
					$message = '타입 추가 완료';
				}
			}else{
				$code = 501;
				$message = '중복된 코드값입니다.';
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
	