<?php
class Log extends CI_Controller{
    
    private $CI;
    
    function __construct()
    {
        //$this->CI =& get_instance();
        
         
        if(!isset($this->CI->session)){  
           //   $this->CI->load->library('session');  
        }
    }
    
    function checkPermission(){
       
        $CI =& get_instance();
        
        //$CI->load->library('session');  
        $CI->load->helper('url');
       
        if(isset($CI->allow) && (is_array($CI->allow) === false OR in_array($CI->router->method, $CI->allow) === false))
        {

            if (!$CI->session->userdata('user_id')) // 로그인 여부를 세션을 이용해 체크한다.
            {
                

                //redirect('/main'); // 로그인창으로 강제 이동
                show_error("로그인이 필요합니다.<br/><a href='/'>이동하기</a>", "로그인 오류", "Session Error");
            }
        }
    }
    
    function checkAPISession() {
        $CI = & get_instance(); 
                
        $CI->load->helper('url');
        log_message('debug', current_url()); 
        log_message('debug', var_export($_POST, TRUE)); 
        
        if(isset($CI->allow) && (is_array($CI->allow) === false || in_array($CI->router->method, $CI->allow) === false)) {
            
            $CI->load->model("Member_model", "mem_md", TRUE);

            $returnCode = "200"; 
            $returnStatus = "OK";
            $returnMessage = ""; 
            $returnData = null; 

            $session_id = $CI->input->post("session_id"); 
            
            $ip = $_SERVER['REMOTE_ADDR']; 
            if(array_key_exists('HTTP_X_FORWARD_FOR', $_SERVER)) {
                $ip = $_SERVER["HTTP_X_FORWARD_FOR"]; 
            }
            
            if(!$session_id) {
                $returnCode = "400"; 
                $returnStatus = "Bad Request Session"; 
                $returnMessage = "session_id 변수의 요청이 올바르지 않습니다. "; 

                $data['code']       = $returnCode; 
                $data['status']     = $returnStatus; 
                $data['message']    = $returnMessage; 
                $data['data']       = $returnData; 

                header("Content-Type: application/json; "); 
                echo json_encode($data);  
                
                exit; 

            } else {
                $session_info = $CI->mem_md->check_session_live($session_id, $ip); 
            //    log_message('debug', var_export($session_info, TRUE)); 
                if(!$session_info) {
                    $returnCode = "401"; 
                    $returnStatus = "Unauthorized"; 
                    $returnMessage = "세션이 만료되었습니다. "; 

                    $data['code']       = $returnCode; 
                    $data['status']     = $returnStatus; 
                    $data['message']    = $returnMessage; 
                    $data['data']       = $returnData; 
                  
                    $write_data = array(
                        "session_id"    => $session_id,
                        "ip_address"    => $ip,
                        "return_code"   => $returnCode,
                        "return_status" => $returnStatus,
                        "return_message"=> $returnMessage,
                        "wdate"         => date("Y-m-d H:i:s")
                    ); 
                  
                    $CI->mem_md->set_ci_session_disconnect_log($write_data); 

                    header("Content-Type: application/json; "); 
                    echo json_encode($data);  
                    
                    exit; 
                } else if($session_info["use_yn"] == "N") {
                    $returnCode = "401"; 
                    $returnStatus = "Unauthorized"; 
                    $returnMessage = "다른 장비에서 로그인 되어 강제 로그아웃 되었습니다. "; 
                    
                    // 세션 제거
                    $CI->mem_md->destroy_session($session_id);

                    $data['code']       = $returnCode; 
                    $data['status']     = $returnStatus; 
                    $data['message']    = $returnMessage; 
                    $data['data']       = $returnData; 
                    
                    $write_data = array(
                        "session_id"    => $session_id,
                        "ip_address"    => $ip,
                        "return_code"   => $returnCode,
                        "return_status" => $returnStatus,
                        "return_message"=> $returnMessage,
                        "wdate"         => date("Y-m-d H:i:s")
                    ); 
                    
                    $CI->mem_md->set_ci_session_disconnect_log($write_data); 

                    header("Content-Type: application/json; "); 
                    echo json_encode($data);  

                    exit; 
                }
            }
        }
    }
}
?>