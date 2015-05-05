<?php namespace components\user\userbox;


class Component {
    
    
    
    static function Display( $data ){

        global $core;
        global $session;
        
        $strView = $core->load->view('components/user/userbox/index', $data, true);
        
        return $strView;
        
    }
}