<?php namespace components\server\info;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        
        $strView = $core->load->view('components/server/info/index', $data, true);
        
        return $strView;
        
    }
}