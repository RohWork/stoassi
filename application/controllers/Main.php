<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct() {
		parent ::__construct();

                $this->allow=array('index', 'login_process');
                 
		$this->head_data = array(
			"main"	=> "class='active'",
                        "stock" => "",
                        "stock_drop" => "",
			"stock_list" => "",
			"stock_category" => "",
			"stock_seller" => "",
		);
                
                $this->load->model('Member_model', 'member_md', TRUE);
               
	}
	
	public function index()
	{
		$this->load->view(LANGUAGE.'/login');
	}
        
        public function login_process()
        {
            $user_id = $this->input->post("user_id");
            $user_pw = base64_encode(hash('sha512',$this->input->post("user_pw"),true));
            
            

            
            $result = $this->member_md->get_member_info($user_id, $user_pw);
            
            
            if(!$result){
                $message = "아이디나 비밀번호를 확인해주세요.";
            }else{
                
                $session_data = array(    //로그인 성공시 session 생성
                                    'user_idx'      => $result['idx'],
			            'user_id'       => $result['id'],
			            'user_name'     => $result['name'],
			       );

                $this->session->set_userdata($session_data);	//session 등록
                
                echo $this->session->user_data('user_id');
                $message = "";
            }
            
            $data = array(
                "result" => $result,
                "message"   => $message
            );
                    
            header("Content-Type: application/json;");
            echo json_encode($data);
        }
        
        
        
        public function main_info(){
                $this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/main');
        }
}
?>