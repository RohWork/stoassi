<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct() {
		parent ::__construct();
		
		$this->head_data = array(
			"main"	=> "class='active'",
			"stock_list" => "",
			"stock_category" => "",
			"stock_seller" => "",
		);
	}
	
	public function index()
	{
		$this->load->view(LANGUAGE.'/login');
	}
        
        public function login_process()
        {
            $user_id = $this->input->post("user_id");
            $user_pw = $this->input->post("user_pw");
            
            
            
            $data = array(
                "test" => "test",
            );
                    
            header("Content-Type: application/json;");
            echo json_encode($data);
        }
        
        public function main(){
                $this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/main');
        }
}
?>