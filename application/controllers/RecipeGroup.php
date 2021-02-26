<?php
class RecipeGroup extends CI_Controller {
	
	function __construct() {
            parent ::__construct();
            
            $this->head_data = header_set("recipe_group");

            $this->load->model('Recipe_model', 'recipe_md', TRUE);
            
        }
        public function group_list(){
            
            $this->load->library('pagination');
            $search_vo  = new stdClass();
            $config['per_page'] = 10;
            $offset = $this->input->get('per_page');
            $config['base_url'] = current_url() . '?' . reset_GET('per_page');
            $search_vo->config_per_page = $config['per_page'];
            
            $config['total_rows'] = $this->recipe_md->count_recipe_list($search_vo);
            $config = setPagination($config);
            $this->pagination->initialize($config);
		
            $data['pagination'] = $this->pagination->create_links();
            
            if ($config['total_rows'] > 0) {
                $rows = $this->recipe_md->get_recipe_list($offset, $search_vo);
            } else {
                $rows = false;
            }
            
            $data['params'] = $params;
            $data['rows'] = $rows;
            $data['base_url'] = $config['base_url'];
            $data['offset'] = $offset;


            $this->load->view(LANGUAGE.'/header', $this->head_data);
            $this->load->view(LANGUAGE.'/recipe_group_list', $data);
            

        }
       

        
}
