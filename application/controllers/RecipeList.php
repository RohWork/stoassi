<?php
class RecipeList extends CI_Controller {
	
	function __construct() {
            parent ::__construct();
            
            $this->head_data = header_set("recipe_list");

            $this->load->model('Recipe_model', 'recipe_md', TRUE);
            
        }

        
        function recipe_list(){
            
            
            
            $this->load->view(LANGUAGE.'/header', $this->head_data);
        }
        
}
