<?php
class Member extends CI_Controller {
	
	function __construct() {
            parent ::__construct();

            $this->head_data = array(
                    "main"	=> "class='active'",
                    "stock_list" => "",
                    "stock_category" => "",
                    "stock_seller" => "",
            );

            $this->load->model('Member_model', 'member_md', TRUE);
            $this->load->model('Shop_model', 'shop_md', TRUE);
	}
        
        public function join(){
            
            $this->load->view(LANGUAGE.'/join');
        }
        
        public function get_shop_category(){
            
            $result = $this->shop_md->get_shop_category();
            
            header("Content-Type: application/json;");
            echo json_encode($result);
        }
        
        public function check_id(){
            
            $user_id = $this->input->post("user_id");
            $result = false;
            $params =  array("user_id" => $user_id);
            
            
            $cnt = $this->member_md->count_member_list($params);
            
            
            if($cnt < 1){
                $result = true;
            }
            
            $data = array(
                "result" => $result
            );
            
            header("Content-Type: application/json;");
            echo json_encode($data);
        }
        
        public function join_process(){
            
            $result = false;
            $data = array();
            $confirm_id = $this->input->post("confirm_id");
            $user_id = $this->input->post("user_id");
            
            $params = array("user_id" => $user_id);
            
            $cnt = $this->member_md->count_member_list($params);
            
            
            
            if($cnt > 1){
                $data["message"]= "중복된 ID 입니다.";
            }else if ($confirm_id != $user_id){
                $data["message"]= "중복체크되지 않은 ID입니다.";
            }else{
            
                $member_params = array(
                    "id" => $this->input->post("confirm_id"),
                    "pwd" => base64_encode(hash('sha512',$this->input->post("user_pw1"),true)),
                    "name" => $this->input->post("user_name"),
                    "tel" => $this->input->post("user_tel"),
                    "email" => $this->input->post("user_email"),
                    "email_confirm" => $this->input->post("email_confirm"),
                    "writer" => $this->input->post("confirm_id"),
                    "state" => "Y",
                );
                
                $shop_params = array(
                    "id"    => $member_params['id'],
                    "name"  => $this->input->post("shop_name"),
                    "tel"   => $member_params['tel'],
                    "email" => $member_params['email'],
                    "addr"  => $this->input->post("shop_addr"),
                    "category_idx" => $this->input->post("shop_category"),
                    "writer"    => $member_params["writer"],
                );
                $result_shop_idx = $this->shop_md->set_shop($shop_params);
                
                if($result_shop_idx){
                    
                    $member_params['shop_idx'] = $result_shop_idx;
                    
                    if($this->member_md->set_member($member_params)){
                        $data["message"]= "가입완료";
                        $data["result"] = true;
                    }else{
                        $data["message"]= "데이터처리(회원데이터) 실패";
                    }
                }else{
                    $data["message"]= "데이터처리(상점데이터) 실패";
                }
            }
            
            header("Content-Type: application/json;");
            echo json_encode($data);
            
        }
        
        public function manage_member_list(){
            
                $this->load->library('pagination');

		$search_vo  = new stdClass();
		
		$config['per_page'] = 10;
		$offset = $this->input->get('per_page');
		$config['base_url'] = current_url() . '?' . reset_GET('per_page');
		
		$search_vo->config_per_page = $config['per_page'];
		$config['total_rows'] = $this->stock_md->count_member_list($search_vo);

		$config = setPagination($config);
		$this->pagination->initialize($config);
		
 		$data['pagination'] = $this->pagination->create_links();
		
		
		if ($config['total_rows'] > 0) {
                    $rows = $this->member_md->get_stock_list($offset, $search_vo);
                } else {
                    $rows = false;
                }
		
		
		$data['rows'] = $rows;
		$data['offset'] = $offset;
		$data['base_url'] = $config['base_url'];

		
		$this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/stock_list', $data);
            
            
        }
}
?>