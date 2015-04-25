<?php namespace components\user\quick_user;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        global $session;
        
        $data['user'] = $session->get_session('userSes');
        
        $strView = $core->load->view('components/user/quick_user/index', $data, true);
        
        return $strView;
        
    }
}