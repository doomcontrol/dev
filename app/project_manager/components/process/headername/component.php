<?php namespace components\process\headername;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        
        $data['processData'] = \processData::getProcessData();
        
        $strView = $core->load->view('components/process/headername/index', $data, true);
        
        return $strView;
        
    }
}