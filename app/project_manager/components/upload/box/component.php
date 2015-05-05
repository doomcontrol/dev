<?php namespace components\upload\box;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        
        $strView = $core->load->view('components/upload/box/index', $data, true);
        
        return $strView;
        
    }
}