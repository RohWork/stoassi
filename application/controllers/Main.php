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
                echo "test";
		$this->load->view(LANGUAGE.'/login');
	}
        
        public function main(){
                $this->load->view(LANGUAGE.'/header', $this->head_data);
		$this->load->view(LANGUAGE.'/main');
        }
}
?>