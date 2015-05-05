<?php namespace components\message\footer\post;


class Component {
    
    
    
    public static function display($array){
        
        global $core;
        
        $strView = $core->load->view('components/message/footer/post/single', $array, true);
        
        return $strView;
    }
    
    
    
}