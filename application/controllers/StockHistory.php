<?php
class StockHistory extends CI_Controller {
	
	function __construct() {
            parent ::__construct();
            
            $this->head_data = header_set("stock_history");

            $this->load->model('Recipe_model', 'recipe_md', TRUE);
            
        }

        function history_list(){
            
            
            
            $this->load->view(LANGUAGE.'/header', $this->head_data);
        }
        
}
