<?php
class Log {
    
    function checkPermission()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        
        if(isset($CI->allow) && (is_array($CI->allow) === false OR in_array($CI->router->method, $CI->allow) === false))
// 여기에 쓰인 if문을 이해하는데 한참 걸렸습니다..
// $CI->allow 는 배열로, 추후 로그인 없이 사용 가능한 것들을 저장할때 사용합니다.
// 가령 로그인 화면이나 문의화면 같이 비로그인으로 열어줄 것들을 넣어주게 됩니다.
        {
            if (!$CI->session->userdata('userid')) // 로그인 여부를 세션을 이용해 체크한다.
            {
                
                redirect('/main'); // 로그인창으로 강제 이동
            }
        }
    }
}
?>