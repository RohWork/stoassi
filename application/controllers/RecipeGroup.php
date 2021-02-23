<?php
class RecipeGroup extends CI_Controller {
	
	function __construct() {
            parent ::__construct();
            
            $this->head_data = header_set("recipe_group");

            $this->load->model('Recipe_model', 'recipe_md', TRUE);
            
        }
        function recipe_group(){
            

            $this->load->view(LANGUAGE.'/header', $this->head_data);
        }
        
        function recipe_list(){
            
            
            
            $this->load->view(LANGUAGE.'/header', $this->head_data);
        }
        
}
