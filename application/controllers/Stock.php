<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	
	public function __construct() {
		
		parent ::__construct();
		$this->allow=array();
                
		$this->load->model('Stock_model', 'stock_md', TRUE);
		
		$this->head_data = array(
			"main"	=> "",
                        "stock" => "active",
                        "stock_drop" => "show",
			"stock_list" => "class='active'",
			"stock_category" => "",
			"stock_seller" => "",
		);
	
		
	}
	
	public function stock_list()
	{		

		$this->load->library('pagination');

		$search_vo  = new stdClass();
		
		$config['per_page'] = 10;
		$offset = $this->input->get('per_page');
		$config['base_url'] = current_url() . '?' . reset_GET('per_page');
		
		$search_vo->config_per_page = $config['per_page'];
		$config['total_rows'] = $this->stock_md->count_stock_list($search_vo);

		$config = setPagination($config);
		$this->pagination->initialize($config);
		
 		$data['pagination'] = $this->pagination->create_links();
		
		
		if ($config['total_rows'] > 0) {
            $rows = $this->stock_md->get_stock_list($offset, $search_vo);
        } else {
            $rows = false;
        }
		
		
		$data['rows'] = $rows;
		$data['offset'] = $offset;
		$data['base_url'] = $config['base_url'];

		
		$this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/stock_list', $data);
	}
	
		
    public function set_stock(){


        $code = '';
        $message = '';

        $vo = array();
        $vo['name'] = $this->input->post("insert_stock_name");
        $vo['stock_category_idx'] = $this->input->post("insert_stock_category_idx");
        $vo['stock_seller_idx'] = $this->input->post("insert_stock_seller_idx");
        $vo['count'] = $this->input->post("insert_stock_count");
        $vo['unit'] = $this->input->post("insert_stock_unit");
        $vo['memo'] = $this->input->post("insert_stock_comment");
        
		$image  = $this->image_upload("insert_stock_image");
        
        if($image){
            $vo['image'] = $image;
        }
        
        
        if (empty($vo['name'])){
            $code = 400;
            $message = 'insert_stock_name 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['unit'])) {
            $code = 400;
            $message = 'insert_stock_unit 변수의 요청이 올바르지 않습니다.';
        } else {
            $this->db->trans_begin();
            
            $this->stock_md->insert_stock($vo);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "재고 추가 실패";
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
    function get_stock_info(){
        
        $stock_idx = $this->input->post("idx");
        
        $where_arr = array(
                "idx" => $stock_idx,
        );
	
        $result = $this->stock_md->get_stock_info($where_arr);
        
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
	
    function get_stock_seller(){
		
        $data = $this->stock_md->get_stock_seller();

        header("Content-Type: application/json;");
        echo json_encode($data);
    }
    
    public function set_update_stock(){
        
        $code = '';
        $message = '';
        
        $vo = array();
        
        $stock_idx = $this->input->post("update_stock_idx");
        $vo['name'] = $this->input->post("update_stock_name");
        $vo['stock_category_idx'] = $this->input->post("update_stock_category_idx");
        $vo['stock_seller_idx'] = $this->input->post("update_stock_seller_idx");
        $vo['unit'] = $this->input->post("update_stock_unit");
        $vo['memo'] = $this->input->post("update_stock_comment");
        $image = $this->image_upload("update_stock_image");
        
        if($image){
            $vo['image'] = $image;
        }
        
        if (empty($vo['name'])){
            $code = 400;
            $message = 'insert_stock_name 변수의 요청이 올바르지 않습니다.';
        } else if (empty($vo['unit'])) {
            $code = 400;
            $message = 'insert_stock_unit 변수의 요청이 올바르지 않습니다.';
        } else{
            
            $this->db->trans_begin();
            
            $this->stock_md->stock_update($vo, $stock_idx);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "상품 수정 실패";
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
    

	
    function image_upload($filename){
        
        $config['upload_path']          = '/var/www/html/file_upload/image/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $config['max_size']     = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
        if (!$this->upload->do_upload($filename))
        {
            return false;
        }else{
            return "/file_upload/image/"."".$this->upload->data('file_name');
        }
        
    }
}		
?>