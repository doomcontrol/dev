<?php namespace components\user\useravatar\cartview;


class Component {
    
    
    
    public static function display( $imagePath, $id){
        
        global $core;
        
        $data['image'] = $imagePath;
        
        $ext = @pathinfo($imagePath, PATHINFO_EXTENSION);
        
        if(!$ext){
            $data['image'] = null;
        }
        
        $data['id'] = $id;
        
        return $core->load->view('components/user/useravatar/cartview/index', $data, true);
        
    }
    
    
    
}
