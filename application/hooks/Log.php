<?php
class Log {
    
    private $CI;
    
    function __construct()
    {
        $this->CI =& get_instance();
        
         
        if(!isset($this->CI->session)){  
              $this->CI->load->library('session');  
        }
    }
    
    function checkPermission(){
       
        $CI =& get_instance();

        $CI->load->library('session');

        $CI->load->helper('url');
       
        echo $CI->session->userdata('user_id');
        if(isset($CI->allow) && (is_array($CI->allow) === false OR in_array($CI->router->method, $CI->allow) === false))
        {
            echo $CI->session->userdata('user_id');
            if (!$CI->session->userdata('user_id')) // 로그인 여부를 세션을 이용해 체크한다.
            {
                
                echo "test";
                exit;
                //redirect('/main'); // 로그인창으로 강제 이동
                //show_error("로그인이 필요합니다.", "로그인 오류");
            }
        }
    }
}
?>