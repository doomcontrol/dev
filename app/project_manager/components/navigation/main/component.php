<?php namespace components\navigation\main;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        
        $strView = $core->load->view('components/navigation/main/index', $data, true);
        
        return $strView;
        
    }
}
