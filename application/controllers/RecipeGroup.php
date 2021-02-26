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

        $search_vo->shop_idx = $this->session->userdata("shop_idx");

        $config['total_rows'] = $this->recipe_md->count_group_list($search_vo);
        $config = setPagination($config);
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        if ($config['total_rows'] > 0) {
            $rows = $this->recipe_md->get_group_list($offset, $search_vo);
        } else {
            $rows = false;
        }

        $data['rows'] = $rows;
        $data['base_url'] = $config['base_url'];
        $data['offset'] = $offset;


        $this->load->view(LANGUAGE.'/header', $this->head_data);
        $this->load->view(LANGUAGE.'/recipe_group_list', $data);
    }
    
    
    public function set_group(){
        $code = '';
        $message = '';
        
        $vo = array();
        
        $vo['name'] = $this->input->post("insert_group_name");
        $vo['shop_idx'] = $data['writer'] = $this->session->userdata("shop_idx");
                
        if (empty($vo['name'])){
            $code = 400;
            $message = 'insert_group_name 변수의 요청이 올바르지 않습니다.';
        }else{
            
            $this->db->trans_begin();
			
            $this->recipe_md->insert_group($vo);

            if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $code = 400;
                    $message = "타입 추가 실패";
            } else {
                    $this->db->trans_commit();
                    $code = 200;
                    $message = '타입 추가 완료';
            }

            
        }
            
        $data = array(
            'code' => $code,
            'message' => $message
        );
        
        header("Content-Type: application/json;");
        echo json_encode($data);
    }	

    public function get_group_info(){
        
        $group_idx = $this->input->post("idx");
        
        $where_arr = array(
                "idx" => $group_idx,
        );
	
        $result = $this->recipe_md->get_group_info($where_arr);
        
        if(empty($result)){
            $code = 400;
            $message = '잘못된 그룹정보입니다..';
        }else{
            $code = 200;
            $message = '성공.';
        }
        
        $data = array(
            'code' => $code,
            'message' => $message,
            'result'  => $result,
        );

        header("Content-Type: application/json;");
        echo json_encode($data);
        
    }
    
    public function set_update_group(){

        $code = '';
        $message = '';
        
        $vo = array();
        
        $group_idx = $this->input->post("update_group_idx");
        $vo['name'] = $this->input->post("update_group_name");
        $vo['state'] = $this->input->post("update_group_useyn");
                
        if (empty($vo['name'])){
            $code = 400;
            $message = 'update_group_name 변수의 요청이 올바르지 않습니다.';
        } else{
            
            $this->db->trans_begin();
            
            $this->recipe_md->group_update($vo, $group_idx);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $code = 400;
                $message = "타입 수정 실패";
            } else {
                $this->db->trans_commit();
                $code = 200;
                $message = '타입 수정 완료';
            }
            
        }
            
        $data = array(
            'code' => $code,
            'message' => $message
        );
        
        header("Content-Type: application/json;");
        echo json_encode($data);


    }
        
}
