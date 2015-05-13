<?php namespace components\upload\box;


class Component {
    
    
    
    static function Display($uploadService, $id){
        
        global $core;
        
        $data               = [];
        $data['id']         = $id;
        $data['service']    = $uploadService;
        
        $strView = $core->load->view('components/upload/box/index', $data, true);
        
        return $strView;
        
    }
}