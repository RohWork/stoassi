<?php
class Log extends CI_Controller{
    

    
    function checkPermission(){
       

        $this->load->helper('url');
       
        if(isset($this->allow) && (is_array($this->allow) === false OR in_array($this->router->method, $this->allow) === false))
        {

            if (!$this->session->userdata('user_id')) // 로그인 여부를 세션을 이용해 체크한다.
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