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
	}
        
        public function join(){
            
            $this->load->view(LANGUAGE.'/join');
        }
}
?>