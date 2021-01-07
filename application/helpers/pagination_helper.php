<?php


if ( ! function_exists('setPagination')){
    function setPagination($config){
        
        $config['first_link'] = '◁';
        $config['last_link'] = '▷';

        $config['prev_link'] = '◀';
        $config['next_link'] = '▶';


        $config['prev_tag_open'] = '<li class="paging_left" style="cursor: pointer;">';
        $config['prev_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="paging_right" style="cursor: pointer;">';
        $config['next_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li class="paging_left" style="cursor: pointer;">';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="paging_left" style="cursor: pointer;">';
        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="pageindex active" style="cursor: pointer;"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $config['num_tag_open'] = '<li class="pageindex" style="cursor: pointer;">';
        $config['num_tag_close'] = '</li>';

        $config['per_page'] = isset($config['per_page']) ? $config['per_page']:10;

        $config['page_query_string'] = true;
        
        return $config;
        
    }
}

?>