<?php
class Recipe extends CI_Controller {
	
	function __construct() {
            parent ::__construct();
            
            $this->head_data = header_set("recipe_group");

            $this->load->model('Recipe_model', 'recipe_md', TRUE);
            
        }
        function recipe_group(){
            

            
        }
        
        function recipe_list(){
            
            
            
            
        }
        
}
